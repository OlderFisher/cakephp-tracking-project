<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $components = array('Email');

	public function beforeFilter() {
		$this->Auth->allow('login');
		parent::beforeFilter();
	}

	public function login($id = null, $token = null) {
		if ( $this->Session->Read('Auth.User') != '' ) {
			$this->redirect(array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
		}

		$title_for_layout = __('meta.title.login');
		$this->set('title_for_layout', $title_for_layout.' - '.Configure::read('Site.name'));

		$meta_description = __('meta.description.login', Configure::read('Site.name'));
		$this->set(compact('meta_description'));

		if ($id != null && $token != null) {

			$id = base64_url_decode($id, Configure::read('Url.key'));

			$this->loadModel('Customer');
			$this->Customer->id = $id;
			$user = $this->Customer->findById($id);

			if ($this->Customer->exists() && $token == AuthComponent::password($user['Customer']['email']) ) {

				$this->loadModel('Payment');
				$payment = $this->Payment->find('first', array(
					'conditions' => array(
						'Customer.id' => $id,
						'Payment.payment_status_id' => array(3, 4, 7),
						'Customer.application_type_id' => 2,
						'Customer.site_id' => 23
					)
				));

				if( $payment ) {

					$this->request->data['Customer'] = array_merge(
						$user['Customer'],
						array('id' => $id)
					);
					unset($this->request->data['Customer']['password']);
					$this->Auth->login($this->request->data['Customer']);

					if ($this->Auth->login()) {
						$this->loadModel('Log');
						$this->request->data['Log']['action'] = "Login";
						$this->request->data['Log']['data'] = "IP : ".$_SERVER['REMOTE_ADDR']." , Navigateur : ".$_SERVER['HTTP_USER_AGENT'];
						$this->Log->save($this->request->data);

						$this->redirect(array('controller' => 'tracking', 'action' => 'dashboard', 'language' => $this->Session->read('Config.language')));
					} else {
						$this->Session->setFlash(__('message.error.credentials_not_match'), 'default', array('class' => 'alert alert-danger'));
						$this->redirect(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language')));
					}
				} else {
					$this->Session->setFlash(__('message.error.credentials_not_match'), 'default', array('class' => 'alert alert-danger'));
					$this->redirect(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language')));
				}
			} else {
				$this->Session->setFlash(__('message.error.credentials_not_match'), 'default', array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language')));
			}
		}

		if($this->request->isPost()) {

			if($this->Auth->login()) {
				$this->loadModel('Log');
				$this->request->data['Log']['action'] = "Login";
				$this->request->data['Log']['data'] = "IP : ".$_SERVER['REMOTE_ADDR']." , Navigateur : ".$_SERVER['HTTP_USER_AGENT'];
				$this->Log->save($this->request->data);

				$this->redirect(array('controller' => 'tracking', 'action' => 'dashboard', 'language' => $this->Session->read('Config.language')));
			} else {
				$this->Session->setFlash(__('message.error.credentials_not_match'), 'default', array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language')));
			}

		}
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language')));
	}

	public function index() {
		$title_for_layout = __('meta.title.profile');
		$this->set('title_for_layout', $title_for_layout.' - '.Configure::read('Site.name'));

		$meta_description = __('meta.description.profile');
		$this->set(compact('meta_description'));

		$user = $this->Auth->user();
		$this->loadModel('Customer');
		$customer = $this->Customer->findById($user['id']);
		$this->set('customer', $customer);

		if ($this->request->is('post')) {
			if (empty($this->request->data['Customer']['password'])) {
				unset($this->request->data['Customer']['password']);
			} else {
				$password = $this->request->data['Customer']['password'];
				$uppercase = preg_match('#[A-Z]#', $password);
				$lowercase = preg_match('#[a-z]#', $password);
				$accent = preg_match('#[ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ¢ß¥£™©®ª×÷±²³¼½¾µ¿¶·¸º°¯§…¤¦≠¬ˆ¨‰"%^\\/<> ]#', $password);

				if(!$uppercase || !$lowercase || $accent || strlen($password) < 8) {
					$this->Session->setFlash(__('message.error.password_invalid'), 'default', array('class' => 'alert alert-danger'));
					$this->redirect(array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
				}
			}

			if (empty(trim($this->request->data['Customer']['last_name'])) || empty(trim($this->request->data['Customer']['first_name']))) {
				$this->Session->setFlash(__('validation.required.firstname_and_lastname'), 'default', array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
			}

			$this->request->data['Customer']['id'] = $user['id'];
			if ($customer['Customer']['address_id']) {
				$this->request->data['Address']['id'] = $customer['Customer']['address_id'];
			}

			if ($this->Customer->saveAll($this->request->data)) {
				$this->Session->setFlash(__('message.success.data_saved'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
			} else {
				$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
			}
		}
	}

}
