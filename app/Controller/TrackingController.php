<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('Trackingmore', 'Vendor');

class TrackingController extends AppController {

	public $components = array('Email');

	public function beforeFilter() {
		$this->Auth->allow();
		parent::beforeFilter();
	}

	public function detectCarrier() {
		// NOTE: It happens that a code find multiple transporters so we would take the first one at the moment
		// For example 420483159374869903504802205626 -> USPS & DHL ECommerce & YANWEN & 4PX
		// For example 1Z95548F1380393061 -> UPS
		// https://s.trackingmore.com/images/icons/express/{code}.png

		$this->autoRender = false;

		$trackingNumber = $this->request->params['named']['number'];

		$key = Configure::read('aftership.key');
		$courier = new AfterShip\Couriers($key);

		$response = $courier->detect($trackingNumber);

		if ($response['meta']['code'] != '200' || $response['data']['total'] == '0'){
			return json_encode([
				'success' => false,
				'message' => __('message.error.carrier_not_found')
			]);
		}

		return json_encode([
			'success' => true,
			'code' => $response['data']['couriers'][0]['slug'],
			'name' => $response['data']['couriers'][0]['name']
		]);
	}

	public function dashboard() {
		$title_for_layout = __('meta.title.tracking');
		$this->set('title_for_layout', $title_for_layout.' - '.Configure::read('Site.name'));

		$user = $this->Auth->user();
		if (!$user) {
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}

		$this->loadModel('TrackParcel');
		$trackings = $this->TrackParcel->find('all', array(
			'conditions' => array(
				'TrackParcel.customer_id' => $user['id'],
			),
			'fields' => array('TrackParcel.*'),
			'order' => 'TrackParcel.id DESC'
		));
		$this->set('trackings', $trackings);
	}

	public function new() {
		// NOTE: It happens that a code find multiple transporters so we would take the first one at the moment
		// For example 420483159374869903504802205626 -> USPS & DHL ECommerce & YANWEN & 4PX
		// For example 1Z95548F1380393061 -> UPS

		if ($this->request->is('post')) {
			$this->autoRender = false;

			$trackingNumber = $this->request->params['named']['number'];

			// Get user
			$user = $this->Auth->user();
			if (!$user) {
				return json_encode([
					'success' => false,
					'message' => __('message.error.unauthorized')
				]);
			}

			$api = 'aftership';
			$key = Configure::read('aftership.key');

			// Get carrier
			$courier = new AfterShip\Couriers($key);
			$carriers = $courier->detect($trackingNumber);
			if ($carriers['meta']['code'] != '200'){
				return json_encode([
					'success' => false,
					'message' => __('message.error.carrier_not_found')
				]);
			}

			$carrier = [
				'carrier_code' => $carriers['data']['couriers'][0]['slug'],
				'carrier_name' => $carriers['data']['couriers'][0]['name'],
			];

			// Create tracking
			$trackings = new AfterShip\Trackings($key);
			try {
				$tracking = $trackings->get($carriers['data']['couriers'][0]['slug'], $trackingNumber);
			}
			catch (AfterShip\AfterShipException $e) {
				$tracking = $trackings->create($trackingNumber, ['slug' => $carriers['data']['couriers'][0]['slug']]);
				sleep(5);
				$tracking = $trackings->get($carriers['data']['couriers'][0]['slug'], $trackingNumber);
			}

			if ($tracking['data']['tracking']['tag'] == 'Pending') {
		        $trackingmore = new Trackingmore;
		        $carrier_ = $trackingmore->detectCarrier($trackingNumber);
	            if ($carrier_['meta']['code'] == '200') {
	            	$carriers = $carrier_['data'];
					$tracking_ = $trackingmore->getRealtimeTrackingResults($carriers[0]['code'], $trackingNumber);
					if ($tracking_['meta']['code'] == '200' && $tracking_['data']['items'][0]['status'] != 'notfound') {
						$tracking = $tracking_;
						$api = 'trackingmore';
						$carrier = [
							'carrier_code' => $carriers[0]['code'],
							'carrier_name' => $carriers[0]['name']
						];
					}
				}
			}

			// Save user's parcel in DB
			$this->loadModel('TrackParcel');
			$trackparcel = $this->TrackParcel->save([
				'customer_id' => $user['id'],
				'num_parcel' => $trackingNumber,
				'carrier_code' => $carrier['carrier_code'],
				'carrier_name' => $carrier['carrier_name'],
				'api' => $api
			]);

			// Save in Session for next loading
			$this->Session->write($trackingNumber, [
				'trackparcel' => $trackparcel,
				'tracking' => $tracking
			]);

			// Return tracking HTML element
			$this->set('trackparcel', $trackparcel);
			$this->set('tracking', $tracking);
			$this->layout = 'ajax';
			return $this->render('/Elements/tracking_'.$api);
		}

		return $this->redirect(array('action' => 'dashboard', 'language' => $this->Session->read('Config.language')));
	}

	public function get() {
		$this->autoRender = false;

		$trackingNumber = $this->request->params['named']['number'];

		// Get user
		$user = $this->Auth->user();
		if (!$user) {
			return json_encode([
				'success' => false,
				'message' => __('message.error.unauthorized')
			]);
		}

		// Get user's parcel in DB
		$this->loadModel('TrackParcel');
		$trackparcel = $this->TrackParcel->find('first', array(
			'conditions' => array(
				'TrackParcel.customer_id' => $user['id'],
				'TrackParcel.num_parcel' => $trackingNumber,
			),
			'fields' => array('TrackParcel.*')
		));

		$key = Configure::read('aftership.key');
		$api = 'aftership';

		// Check if the shipment is already created
		$trackings = new AfterShip\Trackings($key);

		try {
			$tracking = $trackings->get($trackparcel['TrackParcel']['carrier_code'], $trackingNumber);
		}
		catch (AfterShip\AfterShipException $e) {
			$tracking = $trackings->create($trackingNumber, ['slug' => $trackparcel['TrackParcel']['carrier_code']]);
			sleep(5);
			$tracking = $trackings->get($trackparcel['TrackParcel']['carrier_code'], $trackingNumber);
		}

		// Try with trackingmore if pending
		if ($tracking['data']['tracking']['tag'] == 'Pending') {
			$trackingmore = new Trackingmore;
			$carrier_ = $trackingmore->detectCarrier($trackingNumber);
			if ($carrier_['meta']['code'] == '200') {
				$carriers = $carrier_['data'];
				$tracking_ = $trackingmore->getRealtimeTrackingResults($carriers[0]['code'], $trackingNumber);
				if ($tracking_['meta']['code'] == '200' && $tracking_['data']['items'][0]['status'] != 'notfound') {
					$tracking = $tracking_;
					$api = 'trackingmore';
					$trackparcel['TrackParcel']['carrier_code'] = $carriers[0]['code'];
					$trackparcel['TrackParcel']['carrier_name'] = $carriers[0]['name'];
				}
			}
		}

		// Update API field in case that changed
		$trackparcel['TrackParcel']['api'] = $api;
		$this->TrackParcel->save($trackparcel);

		// Save in Session for next loading
		$this->Session->write($trackingNumber, [
			'trackparcel' => $trackparcel,
			'tracking' => $tracking
		]);

		// Return tracking HTML element
		$this->set('trackparcel', $trackparcel);
		$this->set('tracking', $tracking);
		$this->layout = 'ajax';
		return $this->render('/Elements/tracking_'.$trackparcel['TrackParcel']['api']);
	}

	public function webhookTrackingmore() {
		$this->autoRender = false;

		$response = $this->request->data;

		if ($response->meta->code == '200') {
			$carrier_code = $response->data->carrier_code;
			$tracking_number = $response->data->tracking_number;

			$this->loadModel('TrackParcel');
			$trackparcel = $this->TrackParcel->find('first', array(
				'conditions' => array(
					'TrackParcel.carrier_code' => $carrier_code,
					'TrackParcel.num_parcel' => $tracking_number,
					'TrackParcel.api' => 'trackingmore',
				),
				'fields' => array('TrackParcel.*')
			));
			if (!$trackparcel) { return; }

			$this->loadModel('Customer');
			$customer = $this->Customer->find('first', [
				'condition' => [
					'Customer.id' => $trackparcel['TrackParcel']['customer_id']
				],
				'fields' => array('Customer.*')
			]);

			$trackinfo = isset($response->data->origin_info->trackinfo) ? $response->data->origin_info->trackinfo : (isset($response->data->destination_info->trackinfo) ? $response->data->destination_info->trackinfo : null);
			if (!$trackinfo) { return; }

			$email = new CakeEmail();
			$email->config('default');
			$email->from(Configure::read('Contact.email'))
			->template('tracking_update', 'default')
			->emailFormat('html')
			->to($customer['Customer']['email'])
			->subject(__('email.subject.tracking_update', $tracking_number))
			->helpers(array('Html'))
			->viewVars([
				'carrier' => $trackparcel['TrackParcel']['carrier_name'],
				'tracking_number' => $tracking_number,
				'update' => [
					'date' => $trackinfo[0]->Date,
					'status_description' => $trackinfo[0]->StatusDescription,
					'details' => $trackinfo[0]->Details
				]
			])
			->send();
		}


	}
}
