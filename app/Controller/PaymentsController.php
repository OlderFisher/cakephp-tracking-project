<?php
ini_set('memory_limit', '-1');

App::uses('AuthComponent', 'Controller/Component');

class PaymentsController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Email', 'Session', 'Cookie');

	public $uses = array('Payment', 'Card', 'HttpSocket', 'Network/Http');

	public function beforeFilter() {
		$this->Auth->allow();
		parent::beforeFilter();
	}

	//call mozzie webservice for payment
	protected function transac($data = null, $url = null) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POST, 1);
		if($data)
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

		return curl_exec($curl);
	}


	protected function sendMailConfirm($customer) {

		$vat = Configure::read('countries')[$this->Session->read('Config.country')]['vat'];

		$amountHT = $customer['Payment']['subscription_amount'] / ( 1 + ( $vat / 100 ) );

		$data = array(
			'result' => $customer,
			'tva' => $vat,
			'amountHT' => round( $amountHT , 2 )
		);

		$templateConfirm = 'confirm';

		$emailConfig = 'default';

		$email = new CakeEmail();
		$email->config($emailConfig);
		$email->from(array(Configure::read('Contact.email') => Configure::read('Contact.name_sav')))
		->template($templateConfirm, 'default')
		->emailFormat('html')
		->to($customer['Customer']['email'])
		->subject(__('email.subject.paiement_confirmation'))
		->helpers(array('Html'))
		->viewVars($data)
		->send();

	}

	protected function setDataVad($vadOtherSite, $payment_id){

		$payment_id_encoded = base64_url_encode($payment_id, Configure::read('Url.key'));

		// if ($vadOtherSite['kioskmanualVad']) {
		// 	$dataVad['TermUrl'] = Configure::read('Contact.link_kioskmanual')."payments/confirm3ds/".$payment_id_encoded."/".AuthComponent::password($payment_id);
		// 	$dataVad['url'] = Configure::read('Contact.link_kioskmanual')."payments/process3ds";
		// 	$dataVad['redirect3DS'] = "processtoothersite3ds";
		// } else {
			$dataVad['TermUrl'] = 'https://' . env('SERVER_NAME') . Router::url((array('controller' => 'payments', 'action' => 'confirm3ds', $payment_id_encoded, AuthComponent::password($payment_id))));
			$dataVad['url'] = null;
			$dataVad['redirect3DS'] = "process3ds";
		// }
		$dataVad['returnUrl'] = Router::url((array('controller' => 'payments', 'action' => 'confirm3ds', $payment_id_encoded, AuthComponent::password($payment_id))), true);

		return $dataVad;
	}

	public function index() {
		$this->set('noRobot', true);

		$id = $this->Session->read('Customer.id');
		$token = $this->Session->read('Customer.token');

		$id = base64_url_decode($id, Configure::read('Url.key'));

		$title_for_layout = __('meta.title.paiement');
		$this->set('title_for_layout', $title_for_layout.' - '.Configure::read('Site.name'));


		$this->loadModel('Customer');
		$customer = $this->Customer->findById($id);

		if ( !$customer || $token != AuthComponent::password($customer['Customer']['email']) ) {
			$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}

		$payment = $this->Payment->find('first', array(
			'conditions' => array(
				'Customer.id' => $customer['Customer']['id']
			)
		));

		if( $payment && ( $payment['Payment']['payment_status_id'] != Configure::read('Payment.status_en_cours') && $payment['Payment']['payment_status_id'] != Configure::read('Payment.status_echoue') ) ) {
			$this->Session->setFlash(__('message.success.paiement_already_done'), 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}

		if (Configure::read('currencies')[$this->Session->read('Config.currency')]['code'] != $customer['Currency']['code']) {
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}

		$this->loadModel('Product');
		$this->Product->recursive = -1;
		$product = $this->Product->findById( configure::read('currencies')[$this->Session->read('Config.currency')]['product_id'] );
		$this->set('product', $product);

		$this->loadModel('TrackParcel');
		$trackparcel = $this->TrackParcel->find('first', array(
			'conditions' => array(
				'TrackParcel.customer_id' => $customer['Customer']['id']
			),
			'order' => array('TrackParcel.id' => 'desc')
		));
		$this->set('trackparcel', $trackparcel);
		if ( !$trackparcel ) {
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}

		// Vérifie si le customer a déjà envoyer le formulaire (Analytics)
		if ($this->Session->check('PaymentForm.submit') && $this->Session->read('PaymentForm.submit') == 1) {
			$this->set('formAlreadySubmit', 1);
		}

		if ($this->request->is('post')) {

			$this->Session->write('Form.submit', 1);

			$this->request->data['Card']['number'] = str_replace(" ", "", $this->request->data['Card']['number']);
			$this->request->data['Card']['expire']['month'] = substr($this->request->data['Card']['date_expire'], 0, 2);
			$this->request->data['Card']['expire']['year'] = preg_replace('#[0-9].+/#', '', $this->request->data['Card']['date_expire']);

			$this->Card->set($this->request->data);

			if( $this->Card->validates() ) {
				$ip = (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) ? htmlspecialchars((string) $_SERVER['HTTP_CF_CONNECTING_IP']) : '';

				$encoded_ip = inet_pton($ip);
				if (strlen($encoded_ip) == 16) {
					$ipv4 = '';
					for($i = 0; $i < 8; $i += 2) $ipv4 .= chr(ord($encoded_ip[$i]) ^ ord($encoded_ip[$i+1]));
					$ip = inet_ntop($ipv4);
				}
				// $ip="127.0.0.1";

				if( !$payment ) {
					$this->Payment->create();
				}
				else {
					$this->Payment->id = $payment['Payment']['id'];
				}

				$data = array();
				$data['Payment']['customer_id'] = $customer['Customer']['id'];
				$data['Payment']['payment_status_id'] = Configure::read('Payment.status_en_cours');
				$data['Payment']['product_id'] = $product['Product']['id'];
				$data['Payment']['subscription_amount'] = $product['Product']['subscription_price'];
				$data['Payment']['rebill_amount'] = $product['Product']['rebill_price'];
				$data['Payment']['vad'] = $this->Session->read('Vad.used_vad');

				if ($this->Payment->save($data)) {

					$cardName = explode(' ',trim($this->request->data['Card']['name']));
					$cardFirstname = '';
					$cardLastname = '';
					if (isset($cardName[0]) && !empty($cardName[0])){
						$cardFirstname = $cardName[0];
						if (count($cardName) > 1){
							unset($cardName[0]);
							$cardLastname = implode(' ', $cardName);
						}
					}

					if( $cardFirstname == '' ) {
						$cardFirstname = 'N/A';
					}
					if( $cardLastname == '' ) {
						$cardLastname = 'N/A';
					}

					$this->request->data['Customer']['cardFirstname'] = $cardFirstname;
					$this->request->data['Customer']['cardLastname'] = $cardLastname;

					if (isset(Configure::read('currencies')[$this->Session->read('Config.currency')]['code']) && !empty(Configure::read('currencies')[$this->Session->read('Config.currency')]['code'])) {
						$xmlConfig = configure::read('currencies')[$this->Session->read('Config.currency')]['xml_config'];
					} elseif (isset($customer['Currency']['code']) && !empty($customer['Currency']['code'])) {
						$xmlConfig = configure::read('currencies')[$customer['Currency']['code']]['xml_config'];
					} else {
						$xmlConfig = configure::read('currencies')['eurit']['xml_config'];
					}
					$xmlPayment = Xml::build( $xmlConfig );

					$posProductXML = 0;
					$TroisDS = null;
					// Recherche dans le tableau des VAD, le VAD correspondant
					$tab_vad = Configure::read('Tab_vad')[$this->Session->read('Config.currency')];
					foreach ($tab_vad as $key => $value) {
						if ($this->Session->read('Vad.used_vad') == $value['name']) {
							$posProductXML = $value['posProductXML'];
							$TroisDS = $value['3DS'];
							$vadOtherSite = array(
								// 'kioskmanualVad' => $value['kioskmanualVad']
							);
						}
					}

					$addressCountry = strtoupper(Configure::read('Config.country'));

					$expireDateFormat = substr($this->request->data['Card']['date_expire'], 0, 2) . substr($this->request->data['Card']['date_expire'], 3, 2);

					$xmlArray = array(
						'mozzie' => array(
							'site' => array(
								'normalized' => $xmlPayment->site->normalized,
								'key' => $xmlPayment->site->key,
								'currency' => $xmlPayment->site->currency
							),
							'product' => array(
								'normalized' => $xmlPayment->products->product[$posProductXML]->normalized,
								'subscription_price' => $xmlPayment->products->product[$posProductXML]->subscription_price,
								'periodical_price' => $xmlPayment->products->product[$posProductXML]->periodical_price,
								'periodicity' => $xmlPayment->products->product[$posProductXML]->periodicity,
								'delayed' => $xmlPayment->products->product[$posProductXML]->delayed
							),
							'card' => array(
								'first_name' => $cardFirstname,
								'last_name' => $cardLastname,
								'email' => $customer['Customer']['email'],
								'number' => $this->request->data['Card']['number'],
								'expire' => $expireDateFormat,
								'cvv' => $this->request->data['Card']['cvv']
							),
							'infos' => array(
								'ip' => $ip,
								'sender' => $this->request->header('referer'),
								'web_agent' => $this->request->header('User-Agent'),
								'web_agent_accept' => $this->request->header('User-Agent'),
								'description' => Configure::read('Payment.description'),
								'periodical_description' => Configure::read('Payment.periodical_description'),
								//'phone_number' => $customer['Customer']['phone'],
								'first_name' => $cardFirstname,
								'last_name' => $cardLastname,
								'address_country' => $addressCountry,
							)
						)
					);

					if (isset($TroisDS) && !empty($TroisDS)) {
						// Récupère les données du VAD => TermUrl, page pour la redirection 3DS et l'url d'un autre site (si besoin)
						$dataVad = $this->setDataVad($vadOtherSite, $this->Payment->id);
						$xmlArray['mozzie']['infos']['TermUrl'] = $dataVad['TermUrl'];
					}

					if( $this->request->data['Card']['number'] == Configure::read('Card.test_number') &&
					$this->request->data['Card']['cvv'] == Configure::read('Card.cvv') ) {
						$xmlArray['mozzie']['test'] = 1;
					}

					$xmlData = Xml::fromArray($xmlArray);
					$xmlString = $xmlData->asXML();

					$data = array('xml' => $xmlString);
					if (isset($TroisDS) && !empty($TroisDS)) {
						$urlPayment = $xmlPayment->url->add3dsPayxpert;
					} else {
						$urlPayment = $xmlPayment->url->add;
					}
					$response = $this->transac($data, (string) $urlPayment);

					$xmlResponse = Xml::build($response);
					$messageResponse = $xmlResponse->message;

					$ACSUrl = null;
					if (isset($TroisDS) && !empty($TroisDS)) {
						$ACSUrl = (string) $xmlResponse->ACSUrl;
					}

					$payment_id = $this->Payment->id;
					$payment_id_encoded = base64_url_encode($payment_id, Configure::read('Url.key'));

					if( $messageResponse == 'OK' && empty($ACSUrl)) {
						$payment_code = $xmlResponse->payment_id;
						$this->saveIp($ip);
						$this->savePayment($payment_code, $this->request->data, $customer);

						// send mail payment confirm
						$sendCustomer = $this->Customer->findById($customer['Customer']['id']);
						$this->sendMailConfirm($sendCustomer);

						$this->subscribe($payment_id);

						$this->redirect(array('controller' => 'payments', 'action' => 'confirm', 'language' => $this->Session->read('Config.language'), $payment_id_encoded, AuthComponent::password($payment_id)));

					} elseif ($messageResponse == 'OK' && !empty($ACSUrl)) {
						$payment_code = $xmlResponse->payment_id;

						$PaReq = (string) $xmlResponse->PaReq;
						$orderID = (string) $xmlResponse->orderID;
						$MD = $orderID;

						$this->set('TroisDS', 1);
						$this->set('id', $payment_id_encoded);
						$this->set('token', AuthComponent::password($payment_id));
						$this->set('url', $dataVad['url']);
						$this->set('returnUrl', $dataVad['returnUrl']);
						$redirect3DS = $dataVad['redirect3DS'];

						// save session
						$this->Session->write('Payment.' . $payment_code . '.number', $this->request->data['Card']['number']);
						$this->Session->write('Payment.' . $payment_code . '.expire', $expireDateFormat);
						$this->Session->write('Payment.' . $payment_code . '.cvv', $this->request->data['Card']['cvv']);
						$this->Session->write('Payment.' . $payment_code . '.orderID', $orderID);

						$this->savePayment($payment_code, $this->request->data, $customer);

						$this->set('ACSUrl', $ACSUrl);
						$this->set('PaReq', $PaReq);
						$this->set('TermUrl', $dataVad['TermUrl']);
						$this->set('MD', $MD);

						$this->layout = false;
						$this->render($redirect3DS);

					} else {

						$data = array();
						$data['Payment']['payment_status_id'] = Configure::read('Payment.status_echoue');
						$data['Payment']['error_return'] = $xmlResponse->error_details;
						$data['Payment']['processed'] = date('Y-m-d H:i:s');

						$this->Payment->save($data);

						$this->Session->setFlash(__('message.error.paiement_declined'), 'default', array('class' => 'alert alert-danger'));

					}

				} else {
					$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
				}
			}

		}
	}

	public function confirm3ds($id = null, $token = null) {
		$this->layout = false;
		$this->set('noRobot', true);

		$ip = (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) ? htmlspecialchars((string) $_SERVER['HTTP_CF_CONNECTING_IP']) : '';

		$encoded_ip = inet_pton($ip);
		if (strlen($encoded_ip) == 16) {
			$ipv4 = '';
			for($i = 0; $i < 8; $i += 2) $ipv4 .= chr(ord($encoded_ip[$i]) ^ ord($encoded_ip[$i+1]));
			$ip = inet_ntop($ipv4);
		}

		$payment_id = base64_url_decode($id, Configure::read('Url.key'));

		$this->loadModel('Payment');
		$this->Payment->recursive = 2;
		$payment = $this->Payment->findById($payment_id);

		$this->loadModel('Customer');
		$customer = $this->Customer->findById($payment['Customer']['id']);

		if ( !$payment || $token != AuthComponent::password($payment_id) ) {
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}

		if( $payment && ( $payment['Payment']['payment_status_id'] != Configure::read('Payment.status_en_cours') && $payment['Payment']['payment_status_id'] != Configure::read('Payment.status_echoue') ) ) {
			$this->Session->setFlash('Your payment has already been made.', 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}

		$payment_code = $payment['Payment']['payment_code'];

		// recuperation des parametres POST
		if ( empty($this->request->data['PaRes']) || empty($this->request->data['MD']) ) {
			$this->Session->setFlash('A 3DS error has occurred. Try Again.', 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}
		$PaRes = $this->request->data['PaRes'];
		$MD = $this->request->data['MD'];

		$orderID = $this->Session->read('Payment.' . $payment_code . '.orderID');

		if ( $MD != $orderID ) {
			$this->Session->setFlash('A 3DS Check error has occurred. Try Again.', 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'payments', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
		}

		$this->Payment->id = $payment['Payment']['id'];

		if (isset(Configure::read('currencies')[$this->Session->read('Config.currency')]['code']) && !empty(Configure::read('currencies')[$this->Session->read('Config.currency')]['code'])) {
			$xmlConfig = configure::read('currencies')[$this->Session->read('Config.currency')]['xml_config'];
		} elseif (isset($customer['Currency']['code']) && !empty($customer['Currency']['code'])) {
			if ($customer['Currency']['code'] == 'eur') {
				$xmlConfig = configure::read('currencies')['eurit']['xml_config'];
			} else {
				$xmlConfig = configure::read('currencies')[$customer['Currency']['code']]['xml_config'];
			}
		} else {
			$xmlConfig = configure::read('currencies')['eurit']['xml_config'];
		}
		$xmlPayment = Xml::build( $xmlConfig );

		$xmlArray = array(
			'mozzie' => array(
				'site' => array(
					'normalized' => $xmlPayment->site->normalized,
					'key' => $xmlPayment->site->key
				),
				'card' => array(
					'number' => $this->Session->read('Payment.' . $payment_code . '.number'),
					'expire' => $this->Session->read('Payment.' . $payment_code . '.expire'),
					'cvv' => $this->Session->read('Payment.' . $payment_code . '.cvv')
				),
				'infos' => array(
					'orderID' => $orderID,
					'PaRes' => $PaRes
				),
				'payment_id' => $payment_code
			)
		);

		$xmlData = Xml::fromArray($xmlArray);
		$xmlString = $xmlData->asXML();

		$data = array('xml' => $xmlString);
		$urlPayment = $xmlPayment->url->valid3dsPayxpert;
		$response = $this->transac($data, (string) $urlPayment);

		$xmlResponse = Xml::build($response);
		$messageResponse = $xmlResponse->message;

		// send mail payment confirm
		$sendCustomer = $this->Customer->findById($payment['Payment']['customer_id']);

		$payment_id = $sendCustomer['Payment']['id'];
		$payment_id_encoded = base64_url_encode($payment_id, Configure::read('Url.key'));

		if( $messageResponse == 'OK' ) {
			$this->saveIp($ip);

			$data = array();
			$data['Payment']['payment_status_id'] = Configure::read('Payment.status_paye');
			$data['Payment']['processed'] = date('Y-m-d H:i:s');

			$this->Payment->save($data);

			$this->sendMailConfirm($sendCustomer);

			$this->subscribe($payment_id);

			// destruction des sessions
			$this->Session->delete('Payment.' . $payment_code);

			$this->redirect(array('controller' => 'payments', 'action' => 'confirm', 'language' => $this->Session->read('Config.language'), $payment_id_encoded, AuthComponent::password($payment_id)));

		} else {

			$data = array();
			$data['Payment']['payment_status_id'] = Configure::read('Payment.status_echoue');
			$data['Payment']['error_return'] = $xmlResponse->error_details;
			$data['Payment']['processed'] = date('Y-m-d H:i:s');

			$this->Payment->save($data);

			$this->Session->setFlash(__('message.error.paiement_declined'), 'default', array('class' => 'alert alert-danger'));

			$this->redirect(array('controller' => 'payments', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
		}

		$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
	}

	protected function saveIp($ip) {
		$this->loadModel('IpAccepted');
		$this->IpAccepted->recursive = -1;
		$ipAccepted = $this->IpAccepted->find('first', array(
			'conditions' => array(
				'IpAccepted.ip' => $ip
			)
		));
		if( $ipAccepted ) {
			$data = array(
				'IpAccepted' => array('paid' => 1)
			);
			$this->IpAccepted->id = $ipAccepted['IpAccepted']['id'];
			$this->IpAccepted->save($data);
		}
	}

	protected function savePayment($payment_code, $requestData, $customer) {
		$this->loadModel('Customer');
		$data = array();
		$data['Payment']['payment_status_id'] = Configure::read('Payment.status_en_cours');
		$data['Payment']['payment_code'] = $payment_code;
		$data['Payment']['hash_card'] = $requestData['Card']['number'];
		$data['Payment']['processed'] = date('Y-m-d H:i:s');
		if( $requestData['Card']['number'] == Configure::read('Card.test_number') ) {
			$data['Payment']['is_test'] = 1;
		}

		$orderNumber = 0;
		do{
			$orderNumber = generateOrderNumber();
		}while($this->Payment->find('first', array(
			'conditions' => array('Payment.order_number' => $orderNumber),
		)));

		$data['Payment']['order_number'] = $orderNumber;

		$this->Payment->save($data);

		$data = array();
		$data['Customer']['first_name'] = $this->request->data['Customer']['cardFirstname'];
		$data['Customer']['last_name'] = $this->request->data['Customer']['cardLastname'];
		$data['Customer']['card_holder_name'] = $this->request->data['Card']['name'];
		if (isset($this->request->data['Customer']['cgv'])) {
			$data['Customer']['cgv'] = $this->request->data['Customer']['cgv'];
		}
		$this->Customer->id = $customer['Customer']['id'];
		$this->Customer->save($data);
	}

	public function subscribe($id) {

		$payment = $this->Payment->findById($id);

		// on recherche si un paiement avec abonnement a deja ete fait sur la carte
		$paymentsCards = $this->Payment->find('all', array(
			'conditions' => array(
				'Payment.payment_status_id' => array(
					Configure::read('Payment.status_abonne'),
					Configure::read('Payment.status_resilie')
				),
				'Payment.hash_card' => $payment['Payment']['hash_card']
			)
		));
		if( $paymentsCards && count($paymentsCards) > 0 && $payment['Payment']['hash_card'] != Configure::read('Card.hash_card') ) {
			$this->nosubscribe($id);

			return true;
		}

		//Génération d'un mot de passe aléatoire
		$characts    = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$characts   .= '1234567890';
		$characts   .= '1234567890';
		$characts   .= '1234567890';
		$password    = '';
		for($i=0;$i < 8;$i++) {
			$password .= substr($characts,rand()%(strlen($characts)),1);
		}

		$data = array();
		$data['Payment']['payment_status_id'] = Configure::read('Payment.status_abonne');
		$data['Customer']['password'] = $password;

		$this->Payment->id = $payment['Payment']['id'];
		$this->Payment->save($data);

		$this->Payment->Customer->id = $payment['Customer']['id'];

		$this->Payment->Customer->save($data);

		$customer = $this->Payment->Customer->findById($payment['Customer']['id']);

		$emailConfig = 'default';

		$email = new CakeEmail();
		$email->config($emailConfig);
		$email->from(array(Configure::read('Contact.email') => Configure::read('Contact.name_sav')))
		->sender(Configure::read('Contact.email'), Configure::read('Contact.name_sav'))
		->template('application', 'default')
		->emailFormat('html')
		->to($payment['Customer']['email'])
		->subject(__('email.subject.thanks'))
		->helpers(array('Html'))
		->viewVars(
			array(
				'mailClient' => $payment['Customer']['email'],
				'passwordClient' => $password,
				'urlLogin' => Router::url((array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language'))), true),
			)
		)
		->send();

		return true;
	}

	public function nosubscribe($id ) {

		$ip = (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) ? htmlspecialchars((string) $_SERVER['HTTP_CF_CONNECTING_IP']) : '';

		$payment = $this->Payment->findById($id);

		$this->loadModel('Customer');
		$this->Customer->recursive = 2;
		$customer = $this->Customer->findById($payment['Customer']['id']);

		if (isset(Configure::read('currencies')[$this->Session->read('Config.currency')]['code']) && !empty(Configure::read('currencies')[$this->Session->read('Config.currency')]['code'])) {
			$xmlConfig = configure::read('currencies')[$this->Session->read('Config.currency')]['xml_config'];
		} elseif (isset($customer['Currency']['code']) && !empty($customer['Currency']['code'])) {
			if ($customer['Currency']['code'] == 'eur') {
				$xmlConfig = configure::read('currencies')['eurit']['xml_config'];
			} else {
				$xmlConfig = configure::read('currencies')[$customer['Currency']['code']]['xml_config'];
			}
		} else {
			$xmlConfig = configure::read('currencies')['eurit']['xml_config'];
		}
		$xmlPayment = Xml::build( $xmlConfig );

		$xmlArray = array(
			'mozzie' => array(
				'site' => array(
					'normalized' => $xmlPayment->site->normalized,
					'key' => $xmlPayment->site->key
				),
				'payment_id' => $payment['Payment']['payment_code'],
				'infos' => array(
					'ip' => $ip,
					'sender' => $this->request->header('referer'),
					'web_agent' => $this->request->header('User-Agent'),
					'description' => 'No Subscription'
				)
			)
		);
		$xmlData = Xml::fromArray($xmlArray);
		$xmlString = $xmlData->asXML();

		$data = array('xml' => $xmlString);

		$response = $this->transac($data, (string) trim($xmlPayment->url->unsubscribe));

		$xmlResponse = Xml::build($response);
		$messageResponse = $xmlResponse->message;

		if( $messageResponse == 'OK' || $messageResponse == 'Already' ) {
			$data = array();
			$data['Payment']['payment_status_id'] = Configure::read('Payment.status_non_abonne');

			$this->Payment->id = $payment['Payment']['id'];
			$this->Payment->save($data);

			$this->Payment->Customer->id = $payment['Customer']['id'];
			$this->Payment->Customer->save($data);

			$emailConfig = 'default';

			$email = new CakeEmail();
			$email->config($emailConfig);
			$email->from(array(Configure::read('Contact.email') => Configure::read('Contact.name_sav')))
			->template('application', 'default')
			->emailFormat('html')
			->to($payment['Customer']['email'])
			->subject(__('email.subject.thanks'))
			->helpers(array('Html'))
			->viewVars(
				array(
					'customer' => $customer,
				)
			)
			->send();

		}
		else {
			$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));

			return false;
		}

		return true;
	}

	public function noconfirm() {
		$this->set('noRobot', true);

		$id = $this->Session->read('Customer.id');
		$token = $this->Session->read('Customer.token');

		$id = base64_url_decode($id, Configure::read('Url.key'));

		$this->loadModel('Customer');
		$customer = $this->Customer->findById($id);

		if ( !$customer || $token != AuthComponent::password($customer['Customer']['email']) ) {
			$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}
		if (Configure::read('currencies')[$this->Session->read('Config.currency')]['code'] != $customer['Currency']['code']) {
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}
		// $this->loadModel('TrackParcel');
		// $trackparcel = $this->TrackParcel->find('first', array(
		// 	'conditions' => array(
		// 		'TrackParcel.customer_id' => $customer['Customer']['id']
		// 	),
		// 	'order' => array('TrackParcel.id' => 'desc')
		// ));
		// if ( !$trackparcel ) {
		// 	$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		// }
		//
		// if (!$this->Session->check('PaymentForm.submit')) {
		// 	$this->Session->write('PaymentForm.submit', true);
		//
		// 	$this->loadModel('Product');
		// 	$this->Product->recursive = -1;
		// 	$product = $this->Product->findById( configure::read('currencies')[$this->Session->read('Config.currency')]['product_id'] );
		//
		// 	$data['Payment']['customer_id'] = $id;
		// 	$data['Payment']['payment_status_id'] = Configure::read('Payment.status_echoue');
		// 	$data['Payment']['product_id'] = $product['Product']['id'];
		// 	$data['Payment']['subscription_amount'] = $product['Product']['subscription_price'];
		// 	$data['Payment']['rebill_amount'] = $product['Product']['rebill_price'];
		// 	$data['Payment']['vad'] = $this->Session->read('Vad.used_vad');
		//
		// 	$this->Payment->save($data);
		//
		// }

		$title_for_layout = __('header.title.paiement_noconfirmation');
		$this->set('title_for_layout', $title_for_layout.' - '.Configure::read('Site.name'));
	}

	public function confirm($id = null, $token = null) {

		$this->set('noRobot', true);

		$id = base64_url_decode($id, Configure::read('Url.key'));

		$payment = $this->Payment->findById($id);

		if (!$payment || $payment['Payment']['payment_status_id'] == Configure::read('Payment.status_en_cours') || $payment['Payment']['payment_status_id'] == Configure::read('Payment.status_echoue') || $token != AuthComponent::password($id) ) {
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}

		$title_for_layout = __('header.title.paiement_confirmation');
		$this->set('title_for_layout', $title_for_layout.' - '.Configure::read('Site.name'));

 		$idLogin = base64_url_encode($payment['Customer']['id'], Configure::read('Url.key'));
		$tokenLogin = AuthComponent::password($payment['Customer']['email']);
		$this->set('idLogin', $idLogin);
		$this->set('tokenLogin', $tokenLogin);
	}

}
