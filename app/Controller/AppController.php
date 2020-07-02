<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array('Cookie', 'RequestHandler', 'Session', /*'DebugKit.Toolbar',*/
		'Auth' => array(
			'loginAction' => array('controller' => 'tracking', 'action' => 'dashboard'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Customer',
					'fields' => array(
						'username' => 'email',
						'password' => 'password',
					),
					'scope' => array(
						'Payment.payment_status_id' => array(3, 4, 7),
						'Customer.application_type_id' => 2,
						'Customer.site_id' => 23
					)
				)
			)
		)
	);

	public function beforeFilter() {
		App::import('Vendor', 'function');
		App::import('Vendor', 'autoload');

		$this->Cookie->httpOnly = true;
		$this->Cookie->secure = true;

		$this->set('cookieMessage', $this->Cookie->read('cookie.accept'));
		if ($this->Cookie->read('cookie.modal')) {
			$this->set('cookieModal', $this->Cookie->read('cookie.modal'));
		}

		if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] != 'https') {
		  $this->redirect('https://' . env('SERVER_NAME') . $this->here, 301);
		}

		if (strrpos(env('SERVER_NAME'), 'www') !== false) {
			$this->redirect('https://' . substr(env('SERVER_NAME'), 4) . $this->here, 301);
		}

		$showPiwik = true;
		if( isset($_SERVER['HTTP_CF_IPCOUNTRY']) && ($_SERVER['HTTP_CF_IPCOUNTRY'] == 'US' || $_SERVER['HTTP_CF_IPCOUNTRY'] == 'XX')) {
		  $showPiwik = false;
		}
		$this->set('showPiwik', $showPiwik);


		// Detect country with ip, set default country if country not supported by our application
		$country = isset($_SERVER["HTTP_CF_IPCOUNTRY"]) && isset(Configure::read('countries')[strtolower($_SERVER["HTTP_CF_IPCOUNTRY"])]) ? strtolower($_SERVER["HTTP_CF_IPCOUNTRY"]) : Configure::read('default_country');
		Configure::write('Config.country', $country);

		// Detect language with browser, set default language if language not found or not supported by our application
		$prefLocales = array_reduce(
		  explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']),
		  function ($res, $el) {
			list($l, $q) = array_merge(explode(';q=', $el), [1]);
			$res[$l] = (float) $q;
			return $res;
		  }, []);
		arsort($prefLocales);

		$language = Configure::read('default_language');
		foreach ($prefLocales as $locale => $prio) {
			if ( array_key_exists(substr($locale, 0, 2), Configure::read('languages')) ) {
				$language = substr($locale, 0, 2);
				break;
			}
		}
		Configure::write('Config.language', $language);

		// Set default currency
		if (isset($this->params['language']) && $this->params['language'] == "it") {
			Configure::write('Config.currency', Configure::read('countries')["it"]['default_currency'] );
		} else if (isset($this->params['language']) && $this->params['language'] == "fr") {
			Configure::write('Config.currency', Configure::read('countries')["fr"]['default_currency'] );
		} else if (isset($this->params['language']) && $this->params['language'] == "en") {
			Configure::write('Config.currency', Configure::read('countries')["gb"]['default_currency'] );
		} else {
			Configure::write('Config.currency', Configure::read('countries')[$country]['default_currency'] );
		}

		// Set with session if exists
		if ($this->Session->check('Config.country')) {
			Configure::write('Config.country', $this->Session->read('Config.country'));
		}
		if ($this->Session->check('Config.language')) {
			Configure::write('Config.language', $this->Session->read('Config.language'));
		}
		if ($this->Session->check('Config.currency')) {
			Configure::write('Config.currency', $this->Session->read('Config.currency'));
		}

		// Set with params
		if (isset($this->params['language'])) {
			Configure::write('Config.language', $this->params['language']);
		}
		if (isset($this->params['currency'])) {
			$this->Session->write('Vad.used_vad', '');

			if (isset(Configure::read('currencies')[$this->params['currency']]) && !empty(Configure::read('currencies')[$this->params['currency']])) {
				Configure::write('Config.currency', $this->params['currency']);
			} else {
				$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
			}
		}

		// Save in session
		$this->Session->write('Config.country', Configure::read('Config.country'));
		$this->Session->write('Config.language', Configure::read('Config.language'));
		$this->Session->write('Config.currency', Configure::read('Config.currency'));

		if ($this->Session->read('Vad.used_vad') == '') {
			$this->_selectVad();
		}

		$this->_setVadConfig();

		if ($this->Session->read('Config.currency') == 'eurit' && $this->Session->read('Config.language') == 'fr') {
			Configure::write('Config.phone', '0 805 081 904');
		}

		if ($this->here == '/') {
			$this->redirect(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language')));
		}
	}

	protected function _selectVad() {
		if ($this->Session->read('Config.currency') == 'eur') {
			$nb_min = 1;
			$nb_max = 20;
			$nbr_aleat = mt_rand($nb_min, $nb_max);
			if ($nbr_aleat <= 20) {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKorta');
			} else {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKorta');
			}
		} else if ($this->Session->read('Config.currency') == 'eurit') {
			$nb_min = 1;
			$nb_max = 20;
			$nbr_aleat = mt_rand($nb_min, $nb_max);
			if ($nbr_aleat <= 20) {
				$this->Session->write('Vad.used_vad', 'PayxpertAVerisavBnp3DS');
			} else {
				$this->Session->write('Vad.used_vad', 'PayxpertAVerisavBnp3DS');
			}
		} else if ($this->Session->read('Config.currency') == 'gbp') {
			$nb_min = 1;
			$nb_max = 20;
			$nbr_aleat = mt_rand($nb_min, $nb_max);
			if ($nbr_aleat <= 20) {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKortaGBP');
			} else {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKortaGBP');
			}
		} else if ($this->Session->read('Config.currency') == 'cad') {
			$nb_min = 1;
			$nb_max = 60;
			$nbr_aleat = mt_rand($nb_min, $nb_max);
			if ($nbr_aleat <= 20) {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKortaCAD');
			} else {
				$this->Session->write('Vad.used_vad', 'PayxpertSWKioskmanualSab3DSCAD');
			}
		} else if ($this->Session->read('Config.currency') == 'aud') {
			$nb_min = 1;
			$nb_max = 20;
			$nbr_aleat = mt_rand($nb_min, $nb_max);
			if ($nbr_aleat <= 20) {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKortaAUD');
			} else {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKortaAUD');
			}
		} else if ($this->Session->read('Config.currency') == 'usd') {
			$nb_min = 1;
			$nb_max = 20;
			$nbr_aleat = mt_rand($nb_min, $nb_max);
			if ($nbr_aleat <= 20) {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKortaUSD');
			} else {
				$this->Session->write('Vad.used_vad', 'VikingpayMWMMobitrackerKortaUSD');
			}
		}

		$ip = (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) ? htmlspecialchars((string) $_SERVER['HTTP_CF_CONNECTING_IP']) : '';
		if ($ip == '95.154.241.90' || $ip == '86.143.16.239') {
			$this->Session->write('Vad.used_vad', 'PayxpertAVerisavBnp3DS');
		}
	}

	protected function _setVadConfig() {
		// Config special
		if ($this->Session->read('Vad.used_vad') == 'PayxpertAVerisavBnp3DS') {
			Configure::write(
				array(
				  'Contact.link_sav' => 'https://trackerly.net/it',
				  'Contact.name_sav' => 'Trackerly.net',
				  'Contact.email' => 'support.it@trackerly.net',

				  'Payment.description' => 'trackerly.net',
				  'Payment.periodical_description' => 'trackerly.net'
				)
			);
			Configure::write('Config.phone', '+33 805 081 904');
		} elseif ($this->Session->read('Vad.used_vad') == 'VikingpayMWMMobitrackerKorta') {
			Configure::write(
				array(
				  'Contact.link_sav' => 'https://trackerly.net',
				  'Contact.name_sav' => 'trackerly.net',
				  'Contact.email' => 'contact@trackerly.net',

				  'Payment.description' => 'trackerly.net',
				  'Payment.periodical_description' => 'trackerly.net'
				)
			);
			Configure::write('Config.phone', '+33 805 081 904');
		} elseif ($this->Session->read('Vad.used_vad') == 'VikingpayMWMMobitrackerKortaGBP') {
			Configure::write(
				array(
				  'Contact.link_sav' => 'https://trackerly.net',
				  'Contact.name_sav' => 'trackerly.net',
				  'Contact.email' => 'contact@trackerly.net',

				  'Payment.description' => 'trackerly.net',
				  'Payment.periodical_description' => 'trackerly.net'
				)
			);
			Configure::write('Config.phone', '+44 2 039 910 387');
		} elseif ($this->Session->read('Vad.used_vad') == 'VikingpayMWMMobitrackerKortaCAD' || $this->Session->read('Vad.used_vad') == 'PayxpertSWKioskmanualSab3DSCAD' || $this->Session->read('Vad.used_vad') == 'PayxpertTestCAD') {
			Configure::write(
				array(
				  'Contact.link_sav' => 'trackerly.net',
				  'Contact.name_sav' => 'trackerly.net',
				  'Contact.email' => 'contact@trackerly.net',

				  'Payment.description' => 'trackerly.net',
				  'Payment.periodical_description' => 'trackerly.net'
				)
			);
			Configure::write('Config.phone', '+33 805 081 904');
		} elseif ($this->Session->read('Vad.used_vad') == 'VikingpayMWMMobitrackerKortaAUD') {
			Configure::write(
				array(
				  'Contact.link_sav' => 'https://trackerly.net',
				  'Contact.name_sav' => 'trackerly.net',
				  'Contact.email' => 'contact@trackerly.net',

				  'Payment.description' => 'trackerly.net',
				  'Payment.periodical_description' => 'trackerly.net'
				)
			);
			Configure::write('Config.phone', '+33 805 081 904');
		} elseif ($this->Session->read('Vad.used_vad') == 'VikingpayMWMMobitrackerKortaUSD') {
			Configure::write(
				array(
				  'Contact.link_sav' => 'https://trackerly.net',
				  'Contact.name_sav' => 'trackerly.net',
				  'Contact.email' => 'contact@trackerly.net',

				  'Payment.description' => 'trackerly.net',
				  'Payment.periodical_description' => 'trackerly.net'
				)
			);
			Configure::write('Config.phone', '+33 805 081 904');
		}
	}

	public function afterFilter() {
		if (!$this->Cookie->read('cookie.modal')) {
			$this->Cookie->write('cookie.modal', 1, false, '2 Days');
		}
	}

}
