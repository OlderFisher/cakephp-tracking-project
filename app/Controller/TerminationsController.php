<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class TerminationsController extends AppController {

	var $helpers = array('Html');

	public function beforeFilter() {
		$this->Auth->allow();
		parent::beforeFilter();
	}

	//call mozzie webservice for terminations
	public function terminate($data = null, $url = null) {
		$HttpSocket = new HttpSocket(array(
			'ssl_verify_peer' => false,
			'ssl_verify_host' => false
		));
		$results = $HttpSocket->post($url, $data);
		return $results->body;
	}

	//function to display termination page
	public function index() {

		$title_for_layout = __('meta.title.termination');
		$this->set('title_for_layout', $title_for_layout.' - '.Configure::read('Site.name'));

		$meta_description = __('meta.description.termination', Configure::read('Site.name'));
		$this->set(compact('meta_description'));

		App::import('Vendor', 'recaptchalib', array('file' => 'recaptchalib.php'));

		// your secret key
		$secret = Configure::read('recaptcha.checkbox.secret');

		// empty response
		$response = null;

		// check secret key
		$reCaptcha = new ReCaptcha($secret);

		if($this->request->isPost()){
			$response = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]
			);
			$this->loadModel('Customer');
			// $this->Customer->setCaptcha($this->Captcha->getVerCode());
			$this->Customer->set($this->request->data);
			if($this->Customer->validates()){
				if($response != null && $response->success){
					$this->loadModel('Customer');
					$conditions = array('Customer.email' => $this->request->data['Customer']['email']);
					$result = $this->Customer->find('first', array('conditions' => $conditions));

					if(!empty($result)){
						$this->set('validated', true);

						//find the payment code associated to customer
						$this->loadModel('Payment');
						$paymentConditions = array(
							'Payment.payment_status_id' => array(Configure::read('Payment.status_paye'),
							Configure::read('Payment.status_abonne'),
							Configure::read('Payment.status_resilie')),
							'Customer.email' => $result['Customer']['email']
						);
						$payment = $this->Payment->find('first', array('conditions' => $paymentConditions, 'contain' => 'Customer'));

						if(empty($payment)) {

							//return error if paymentCode not found
							$this->Session->setFlash(__('message.error.unknown_customer_service'), 'default', array('class' => 'alert alert-danger'));
							$this->redirect(array('controller' => 'terminations', 'action' => 'index', 'language' => $this->Session->read('Config.language')));

						} else {

							$payment_code = $payment['Payment']['payment_code'];
							//parse payment.xml file
							if (isset($result['Currency']['code']) && !empty($result['Currency']['code'])) {
								if ($result['Currency']['code'] == 'eur') {
									$xmlConfig = configure::read('currencies')['eurit']['xml_config'];
								} else {
									$xmlConfig = configure::read('currencies')[$result['Currency']['code']]['xml_config'];
								}
							} else {
								$xmlConfig = configure::read('currencies')['eurit']['xml_config'];
							}
							$xmlPayment = Xml::build( $xmlConfig );

							$ip = (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) ? htmlspecialchars((string) $_SERVER['HTTP_CF_CONNECTING_IP']) : '';

							$xmlArray = array(
								'mozzie' => array(
									'site' => array(
										'normalized' => $xmlPayment->site->normalized,
										'key' => $xmlPayment->site->key
									),
									'payment_id' => $payment_code,
									'infos' => array(
										'ip' => $ip,
										'sender' => $this->request->header('referer'),
										'web_agent' => $this->request->header('User-Agent'),
										'description' => 'SAV'
									)
								)
							);
							$xmlData = Xml::fromArray($xmlArray);
							$xmlString = $xmlData->asXML();

							$data = array('xml' => $xmlString);

							$response = $this->terminate($data, (string) $xmlPayment->url->unsubscribe);

							$xmlResponse = Xml::build($response);
							$messageResponse = $xmlResponse->message;

							if($messageResponse == 'OK' || $messageResponse == "Already") {

								//set payment code to terminate
								$this->Payment->id = $payment['Payment']['id'];
								$this->Payment->save(array('payment_status_id' => Configure::read('Payment.status_resilie')));

								$emailSAV = Configure::read('Contact.email');
								$nameSAV = Configure::read('Contact.name_sav');

								//create mail for customer
								$email = new CakeEmail();
								$email->config('default');
								$email->from(array($emailSAV => $nameSAV))
								->template('termination', 'default')
								->emailFormat('html')
								->to($result['Customer']['email'])
								->subject(__('email.termination.subject', Configure::read('Site.name')))
								->helpers(array('Html'))
								->viewVars(array(
									'firstName' => $payment['Customer']['first_name'],
									'lastName' => $payment['Customer']['last_name'],
									'email' => $payment['Customer']['email'],
									'emailSAV' => $emailSAV,
									'nameSAV' => $nameSAV))
									->send();

							} else {
								$this->Session->setFlash(__('message.error.cannot_terminate'), 'default', array('class' => 'alert alert-danger'));
								$this->redirect(array('controller' => 'terminations', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
							}
						}
					} else {
						$this->Session->setFlash(__('message.error.no_subscription_found'), 'default', array('class' => 'alert alert-danger'));
						$this->redirect(array('controller' => 'terminations', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
					}
				} else {
					$this->Session->setFlash(__('message.error.captcha'), 'default', array('class' => 'alert alert-danger'));
				}
			}
		}
	}
}
