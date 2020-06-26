<?php

App::uses('AuthComponent', 'Controller/Component');

class CustomersController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Email', 'Session', 'Cookie');

	protected $reasonAccessRefused = '';

	public function beforeFilter() {
		$this->Auth->allow();
		parent::beforeFilter();
	}

	public function acceptCookie() {
		$this->autoRender = false ;

		if (isset($_POST["value"])) {
			$this->Cookie->write('cookie.accept', 1, true, '12 Month');
		}
	}

	public function home() {

		$title_for_layout = __('meta.title.home');
		$this->set('title_for_layout', $title_for_layout.' - '.Configure::read('Site.name'));
		$meta_description = __('meta.description.home', Configure::read('Site.name'));
		$this->set(compact('meta_description'));

		if ($this->request->is('post')) {

			$this->loadModel('Country');
			$this->loadModel('Langue');
			$this->loadModel('Currency');

			$this->request->data['Customer']['site_id'] = Configure::read('Site.id');
			$this->request->data['Customer']['application_type_id'] = Configure::read('ApplicationType.abonnement');
			$this->request->data['Customer']['country_id'] = $this->Country->findByAlpha2(Configure::read('Config.country'))['Country']['id'];
			$this->request->data['Customer']['langue_id'] = $this->Langue->findByCode(Configure::read('Config.language'))['Langue']['id'];
			$this->request->data['Customer']['currency_id'] = $this->Currency->findByCode(Configure::read('currencies')[$this->Session->read('Config.currency')]['code'])['Currency']['id'];

			$this->loadModel('Payment');
			$payment = $this->Payment->find('first', array(
				'conditions' => array(
					'Payment.payment_status_id' => array(Configure::read('Payment.status_paye'),
					Configure::read('Payment.status_abonne') ,
					Configure::read('Payment.status_non_abonne')),
					'Customer.email' => $this->request->data['Customer']['email'],
					'Customer.site_id' => Configure::read('Site.id'),
				)
			));
			if ($payment == null) {
				$this->loadModel('TrackParcel');

				$carrier = json_decode($this->request->data['TrackParcel']['carrier']);
				$this->request->data['TrackParcel']['carrier_code'] = $carrier->code ?? null;
				$this->request->data['TrackParcel']['carrier_name'] = $carrier->name ?? null;
				$this->request->data['TrackParcel']['api'] = 'aftership';
				unset($this->request->data['TrackParcel']['carrier']);

				$this->request->data['TrackParcel']['num_parcel'] = str_replace(' ', '', $this->request->data['TrackParcel']['num_parcel']);

				if ($this->TrackParcel->saveAll($this->request->data)) {
					$this->Session->write('Customer.token', AuthComponent::password($this->request->data['Customer']['email']));
					$this->Session->write('Customer.id', base64_url_encode($this->Customer->id, Configure::read('Url.key')));

					$this->redirect(array('controller' => 'payments', 'action' => 'index', 'language' => $this->Session->read('Config.language')));
				} else {
					$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
				}
			} else {
				$this->Session->setFlash(__('message.error.already_subscribed'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

}
