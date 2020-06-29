<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); // Loads a single plugin named DebugKit
 */

/**
 * To prefer app translation over plugin translation, you can set
 *
 * Configure::write('I18n.preferApp', true);
 */

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyCacheFilter' => array('prefix' => 'my_cache_'), //  will use MyCacheFilter class from the Routing/Filter package in your app with settings array.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 *		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));


Configure::write(
  array(
		'Site.id' => 23,
		'Variable.css_js' => 49,

		'recaptcha.site' => '6LeQNc4UAAAAAJwB93_Fy52t5lUaZ8DAWcwM3ZdL',
		'recaptcha.secret' => '6LeQNc4UAAAAAK-LGkP_4oBwv3nl13h37qMTkwMu',
		'recaptcha.checkbox.site' => '6Lcjb9IUAAAAAFmII3jwZMyLL3tOdWGziaU55ylj',
		'recaptcha.checkbox.secret' => '6Lcjb9IUAAAAALgXPTrPUyjUYbYj_ZMnu8eJFSZa',

		'Site.name' => 'Trackerly',
		'Site.name2' => 'Trackerly',
		'Site.name_upper' => 'TRACKERLY',
		'Site.url' => 'trackerly.net',
		'Site.url2' => 'trackerly.net',
		'Site.wurl' => 'www.trackerly.net',
		'Contact.link_site' => 'https://trackerly.net/',
		'Contact.link_login' => 'https://trackerly.net/en/login',

		'Site.pxp_name' => 'PXP-trackerly',
		'Site.pxp_url' => 'PXP-trackerly.net',
		'Site.pxp_name2' => 'PX-trackerly',
		'Site.pxp_url2' => 'PX-trackerly.net',

		'Company.name' => '',
		'Company.name_ltd' => '',
		'Company.vat_number' => ' ',
		'Company.address' => '',
		'Company.inc_number' => '',

		'Contact.email_site' => 'contact@trackerly.net',

		'Contact.link_sav' => 'https://trackerly.net',
		'Contact.url_resil' => 'https://trackerly.net/termination',
		'Contact.name_sav' => 'TRACKERLY.net',
		'Contact.email' => 'contact@trackerly.net',

		'Site.denied_legal_countries' => array('FR', 'BE'),

		'languages' => [
			'en' => 'English',
			'fr' => 'Français',
			//'es' => 'Español',
			//'it' => 'Italiano',
			// 'pl' => 'Polski',
			// 'pt' => 'Português'
		],

		'Tab_vad' => [
			'eurit' => [
				'vad_payxpert_a_verisav_bnp_3ds' => [
					'name' => 'PayxpertAVerisavBnp3DS',
					'posProductXML' => 0,
					'3DS' => 1
				],
				'vad_vikingpay_mwm_mobitracker_korta' => [
					'name' => 'VikingpayMWMMobitrackerKorta',
					'posProductXML' => 1,
					'3DS' => null
				]
			],
			'gbp' => [
				'vad_vikingpay_mwm_mobitracker_korta_gbp' => [
					'name' => 'VikingpayMWMMobitrackerKortaGBP',
					'posProductXML' => 0,
					'3DS' => null
				]
			],
			'cad' => [
				'vad_vikingpay_mwm_mobitracker_korta_cad' => [
					'name' => 'VikingpayMWMMobitrackerKortaCAD',
					'posProductXML' => 0,
					'3DS' => null
				],
				'vad_payxpert_test_cad' => [
					'name' => 'PayxpertTestCAD',
					'posProductXML' => 1,
					'3DS' => 1
				],
				'vad_payxpert_sw_kioskmanual_sab_3ds_cad' => [
					'name' => 'PayxpertSWKioskmanualSab3DSCAD',
					'posProductXML' => 2,
					'3DS' => 1
				]
			],
			'aud' => [
				'vad_vikingpay_mwm_mobitracker_korta_aud' => [
					'name' => 'VikingpayMWMMobitrackerKortaAUD',
					'posProductXML' => 0,
					'3DS' => null
				]
			],
			'usd' => [
				'vad_vikingpay_mwm_mobitracker_korta_usd' => [
					'name' => 'VikingpayMWMMobitrackerKortaUSD',
					'posProductXML' => 0,
					'3DS' => null
				]
			],
		],

		'currencies' => [
			'eurit' => [
				'code' => 'eur',
				'product_id' => 7,
				'vat' => 20,
				'symbol' => '€',
				'name' => 'Euro',
				'price' => [
					'month' => '24,90€',
					'trial' => '0,35€'
				],
				'xml_config' => ''
			],
			'cad' => [
				'code' => 'cad',
				'product_id' => 8,
				'vat' => 5,
				'symbol' => '$',
				'name' => 'Canadian Dollar',
				'price' => [
					'month' => 'CA$32.90',
					'trial' => 'CA$1.49'
				],
				'xml_config' => ''
			],
			'aud' => [
				'code' => 'aud',
				'product_id' => 9,
				'vat' => 10,
				'symbol' => '$',
				'name' => 'Australian Dollar',
				'price' => [
					'month' => 'AU$34.90',
					'trial' => 'AU$1.49'
				],
				'xml_config' => ''
			],
			'usd' => [
				'code' => 'usd',
				'product_id' => 3,
				'vat' => 0,
				'symbol' => '$',
				'name' => 'United States Dollar',
				'price' => [
					'month' => '$29.90',
					'trial' => '$1.49'
				],
				'xml_config' => ''
			],
			'gbp' => [
				'code' => 'gbp',
				'product_id' => 6,
				'vat' => 20,
				'symbol' => '£',
				'name' => 'Pound sterling',
				'price' => [
					'month' => '£24.90',
					'trial' => '£1.00'
				],
				'xml_config' => ''
			]
		],

		'countries' => [
			'fr' => [
				'name' => 'France',
				'default_currency' => 'eurit',
				// 'default_currency' => 'eur',
				'phone' => '+33 805 081 904',
				'vat' => 20
			],
			'ie' => [
				'name' => 'Ireland',
				'default_currency' => 'eurit',
				// 'default_currency' => 'eur',
				'phone' => '+44 2 039 910 387',
				'vat' => 23
			],
			'gb' => [
				'name' => 'United Kingdom',
				'default_currency' => 'gbp',
				'phone' => '+44 2 039 910 387',
				'vat' => 20
			],
			'au' => [
				'name' => 'Australia',
				'default_currency' => 'aud',
				'phone' => '+44 2 039 910 387',
				'vat' => 10
			],
			'ca' => [
				'name' => 'Canada',
				'default_currency' => 'cad',
				'phone' => '+44 2 039 910 387',
				'vat' => 5
			],
			'it' => [
				'name' => 'Italia',
				'default_currency' => 'eurit',
				// 'default_currency' => 'eur',
				'phone' => '+44 2 039 910 387',
				'vat' => 22
			],
			/*'es' => [
				'name' => 'España',
				'default_currency' => 'eur',
				'phone' => '+0 000 000 00 00',
				'vat' => 21
			]*/
		],

		'default_country' => 'gb',
		'default_language' => 'en',

		'Url.key' => 'test',

		'Card.test_number' => '',
		'Card.cvv' => '',
		'Card.hash_card' => '',
		'Payment.taux_tva' => 20,

		'Payment.description' => 'Trackerly.net',
		'Payment.periodical_description' => 'Trackerly.net',

		'Payment.description2' => 'PXP-Trackerly.net',
		'Payment.description3' => 'PXP*Trackerly.net',

		'Payment.status_en_cours' => 1,
		'Payment.status_echoue' => 2,
		'Payment.status_paye' => 3,
		'Payment.status_abonne' => 4,
		'Payment.status_non_abonne' => 5,
		'Payment.status_resilie' => 6,
		'Payment.status_sans_choix' => 7,

		'ApplicationType.oneShot' => 1,
		'ApplicationType.abonnement' => 2,

		'Maxmind.id' => '',
		'Maxmind.key' => '',

		'trackingmore.logo_url' => 'https://s.trackingmore.com/images/icons/express/{code}.png',

		'aftership.key' => '9e445345-09f5-4a1a-a34a-775bb9211079',
		'aftership.logo_url' => 'https://assets.aftership.com/couriers/svg/{code}.svg'
	)
);
