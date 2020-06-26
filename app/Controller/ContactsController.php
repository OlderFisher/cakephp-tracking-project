<?php
class ContactsController extends AppController {

	public $name = 'Contacts';
	public $components = array('Email');
	public $helpers = array('Html', 'Form');

	public function beforeFilter() {
		$this->Auth->allow();
		parent::beforeFilter();
	}

	public function index() {

		$this->set('noRobot', true);

		$title_for_layout = __('meta.title.contact');
		$this->set('title_for_layout', Configure::read('Site.name') . ' : ' . $title_for_layout);

		$meta_description = __('meta.description.contact', Configure::read('Site.name'));
		$this->set(compact('meta_description'));

		if(!empty($this->data)) {
			// RECAPTCHA V2 VALIDATION
			$secret_recaptcha = Configure::read('recaptcha.secret');
			$response_recaptcha = null;
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_recaptcha) .  '&response=' . urlencode($this->request->data['g-recaptcha-response']);
			$response_recaptcha = file_get_contents($url);
			$response_recaptcha_returned = json_decode($response_recaptcha,true);
			if($response_recaptcha_returned["success"]) {}
			else {
				$this->Session->setFlash(__('captcha.error'), 'default', array('class' => 'alert-danger'));
				$this->redirect(array('action' => 'index', 'language' => $this->Session->read('Config.language')));
			}
			// END RECAPTCHA V2 VALIDATION

			$this->Contact->create($this->data);

			if( !$this->Contact->validates() ) {
				$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
				$this->validateErrors($this->Contact);
			}
			else {

				$email = new CakeEmail();
				$email->config('default');
				$email->from($this->request->data['Contact']['email'])
				->template('contact', 'default')
				->emailFormat('html')
				->to(Configure::read('Contact.email'))
				->subject(__('email.subject.new_message', Configure::read('Site.name')))
				->helpers(array('Html'))
				->viewVars(array('data' => $this->request->data))
				->send();

				$emailConfig = 'default';
				$from = Configure::read('Contact.email');

				$email = new CakeEmail();
				$email->config($emailConfig);
				$email->from($from)
				->template('contact', 'default')
				->emailFormat('html')
				->to($this->data['Contact']['email'])
				->subject(__('email.subject.new_message', Configure::read('Site.name')))
				->helpers(array('Html'))
				->viewVars(array('data' => $this->request->data))
				->send();

				$this->Session->setFlash(__('message.success.message_sent'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('action' => 'index', 'language' => $this->Session->read('Config.language')));
			}
		}
	}

	public function claim() {

		$title_for_layout = __('meta.title.claim');
		$this->set('title_for_layout', Configure::read('Site.name') . ' : ' . $title_for_layout);

		$meta_description = __('meta.description.claim', Configure::read('Site.name'));
		$this->set(compact('meta_description'));

		if(!empty($this->data)) {
			// RECAPTCHA V2 VALIDATION
			$secret_recaptcha = Configure::read('recaptcha.secret');
			$response_recaptcha = null;
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_recaptcha) .  '&response=' . urlencode($this->request->data['g-recaptcha-response']);
			$response_recaptcha = file_get_contents($url);
			$response_recaptcha_returned = json_decode($response_recaptcha,true);
			if($response_recaptcha_returned["success"]) {}
			else {
				$this->Session->setFlash(__('captcha.error'), 'default', array('class' => 'alert-danger'));
				$this->redirect(array('action' => 'index', 'language' => $this->Session->read('Config.language')));
			}
			// END RECAPTCHA V2 VALIDATION

			$this->loadModel('Claim');
			$this->Claim->create($this->data);

			if( !$this->Claim->validates() ) {
				$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
				$this->validateErrors($this->Claim);
			}
			else {

				$email = new CakeEmail();
				$email->config('default');
				$email->from($this->request->data['Claim']['email'])
				->template('claim', 'default')
				->emailFormat('html')
				->to(Configure::read('Contact.email'))
				->subject(__('email.subject.new_claim', Configure::read('Site.name')))
				->helpers(array('Html'))
				->viewVars(array('data' => $this->request->data))
				->send();

				$this->Session->setFlash(__('message.success.message_sent'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('action' => 'claim', 'language' => $this->Session->read('Config.language')));
			}
		}
	}

}
