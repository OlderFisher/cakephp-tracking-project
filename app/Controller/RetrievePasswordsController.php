<?php
class RetrievePasswordsController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Email');

	public $uses = array('Payment');

	public function beforeFilter() {
		$this->Auth->allow();
		parent::beforeFilter();
	}

	public function index() {

		if ( $this->Session->Read('Auth.User') != '' ) {
			$this->redirect(array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
		}

		$title_for_layout = __('meta.title.retrieve_password.request');
		$this->set('title_for_layout', Configure::read('Site.name') . ' : ' . $title_for_layout);

		$meta_description = __('meta.description.retrieve_password.request');
		$this->set(compact('meta_description'));

		if ( $this->request->is('post') ) {
			$this->loadModel('Payment');
			$payment = $this->Payment->find('first', array(
				'conditions' => array(
					'Payment.payment_status_id' => array(Configure::read('Payment.status_paye'),
					Configure::read('Payment.status_abonne'),
					Configure::read('Payment.status_resilie')),
					'Customer.email' => $this->request->data['RetrievePassword']['email']
				)
			));

			if( $payment != null ) {

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
				$data['Customer']['password'] = $password;

				$this->Payment->Customer->id = $payment['Customer']['id'];
				$this->Payment->Customer->save($data);

				$nameCustomer = $payment['Customer']['last_name'];

				$emailSAV = Configure::read('Contact.email');
				$nameSAV = Configure::read('Contact.name_sav');

				$email = new CakeEmail();
				$email->config('default');
				$email->from(array($emailSAV => $nameSAV))
				->template('password', 'default')
				->emailFormat('html')
				->to($payment['Customer']['email'])
				->subject(__('email.subject.retrieve_password', Configure::read('Site.name')))
				->helpers(array('Html'))
				->viewVars(
					array(
						'name' => $payment['Customer']['first_name'],
						'lastname' => $payment['Customer']['last_name'],
						'email' => $payment['Customer']['email'],
						'password' => $password,
						'emailSAV' => $emailSAV,
						'nameSAV' => $nameSAV,
					)
				)
				->send();

				$this->redirect(array('controller' => 'retrievePasswords', 'action' => 'confirm', 'language' => $this->Session->read('Config.language')));

			}
			else {
				$this->Session->setFlash(__('no_subscription_found_for_email'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

	public function confirm() {

		$this->set('noRobot', true);

		if ( $this->Session->Read('Auth.User') != '' ) {
			$this->redirect(array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
		}

		$title_for_layout = __('meta.title.retrieve_password.sent');
		$this->set('title_for_layout', Configure::read('Site.name') . ' : ' . $title_for_layout);

		$meta_description = __('meta.description.retrieve_password.sent', Configure::read('Site.name'));
		$this->set(compact('meta_description'));

	}

}
