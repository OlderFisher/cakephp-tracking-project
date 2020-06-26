<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	 $languages = ['language' => implode(array_keys(Configure::read('languages')), '|')];
	 $currencies = ['currency' => implode(array_keys(Configure::read('currencies')), '|')];

	 /** ========== FRENCH ========== */
	 Router::connect('/:language/qui-sommes-nous', ['controller' => 'pages', 'action' => 'about'], ['language' => 'fr']);
	 Router::connect('/:language/faq', array('controller' => 'pages', 'action' => 'faq'), ['language' => 'fr']);
	 Router::connect('/:language/conditions-generales-de-vente', array('controller' => 'pages', 'action' => 'cgv'), ['language' => 'fr']);
	 Router::connect('/:language/cookies', array('controller' => 'pages', 'action' => 'cookie'), ['language' => 'fr']);
	 Router::connect('/:language/utilisation-cookie', array('controller' => 'pages', 'action' => 'mentionsLegales'), ['language' => 'fr']);
	 Router::connect('/:language/politique-de-confidentialite', array('controller' => 'pages', 'action' => 'policy'), ['language' => 'fr']);

	 Router::connect('/:language/contact', array('controller' => 'contacts', 'action' => 'index'), ['language' => 'fr']);
	 Router::connect('/:language/reclamation', array('controller' => 'contacts', 'action' => 'claim'), ['language' => 'fr']);

	 Router::connect('/:language/paiement', array('controller' => 'payments', 'action' => 'index'), ['language' => 'fr']);
	 Router::connect('/:language/confirmation-de-paiement/*', array('controller' => 'payments', 'action' => 'confirm'), ['language' => 'fr']);
	 Router::connect('/:language/annulation-du-paiement/*', array('controller' => 'payments', 'action' => 'noconfirm'), ['language' => 'fr']);

	 Router::connect('/:language/resiliation', array('controller' => 'terminations', 'action' => 'index'), ['language' => 'fr']);

	 Router::connect('/:language/connexion/*', array('controller' => 'users', 'action' => 'login'), ['language' => 'fr']);
	 Router::connect('/:language/deconnexion', array('controller' => 'users', 'action' => 'logout'), ['language' => 'fr']);
	 Router::connect('/:language/profil', array('controller' => 'users', 'action' => 'index'), ['language' => 'fr']);

	 Router::connect('/:language/suivi', array('controller' => 'tracking', 'action' => 'dashboard'), ['language' => 'fr']);

	 Router::connect('/:language/mot-de-passe-oublie', array('controller' => 'retrievePasswords', 'action' => 'index'), ['language' => 'fr']);
	 Router::connect('/:language/nouveau-mot-de-passe', array('controller' => 'retrievePasswords', 'action' => 'confirm'), ['language' => 'fr']);

	 Router::connect('/:language/demande-assistance', array('controller' => 'requests', 'action' => 'formRequest'), ['language' => 'fr']);
	 Router::connect('/:language/detail-requete/*', array('controller' => 'requests', 'action' => 'detailRequest'), ['language' => 'fr']);
	 Router::connect('/:language/fermer-requete/*', array('controller' => 'requests', 'action' => 'closeTicket'), ['language' => 'fr']);
	 /** ========== END FRENCH ========== */

	  /** ========== ENGLISH / DEFAULT ========== */
	 Router::connect('/:language/who-we-are', ['controller' => 'pages', 'action' => 'about'], $languages);
	 Router::connect('/:language/faq', array('controller' => 'pages', 'action' => 'faq'), $languages);
	 Router::connect('/:language/terms-of-use', array('controller' => 'pages', 'action' => 'cgv'), $languages);
	 Router::connect('/:language/cookies', array('controller' => 'pages', 'action' => 'cookie'), $languages);
	 Router::connect('/:language/legal-notices', array('controller' => 'pages', 'action' => 'mentionsLegales'), $languages);
	 Router::connect('/:language/policy', array('controller' => 'pages', 'action' => 'policy'), $languages);

	 Router::connect('/:language/contact', array('controller' => 'contacts', 'action' => 'index'), $languages);
	 Router::connect('/:language/claim', array('controller' => 'contacts', 'action' => 'claim'), $languages);

	 Router::connect('/:language/paiement', array('controller' => 'payments', 'action' => 'index'), $languages);
	 Router::connect('/:language/paiement-confirm/*', array('controller' => 'payments', 'action' => 'confirm'), $languages);
	 Router::connect('/:language/paiement-cancel/*', array('controller' => 'payments', 'action' => 'noconfirm'), $languages);

	 Router::connect('/:language/termination', array('controller' => 'terminations', 'action' => 'index'), $languages);

	 Router::connect('/:language/login/*', array('controller' => 'users', 'action' => 'login'), $languages);
	 Router::connect('/:language/logout', array('controller' => 'users', 'action' => 'logout'), $languages);
	 Router::connect('/:language/profile', array('controller' => 'users', 'action' => 'index'), $languages);

	 Router::connect('/:language/tracking', array('controller' => 'tracking', 'action' => 'dashboard'), $languages);
	 Router::connect('/:language/new-tracking', array('controller' => 'tracking', 'action' => 'new'), $languages);
	 Router::connect('/:language/get-tracking', array('controller' => 'tracking', 'action' => 'get'), $languages);

	 Router::connect('/:language/detect-carrier/:number', ['controller' => 'tracking', 'action' => 'detectCarrier', 'pass' => ['number']], $languages);
	 Router::connect('/webhook/trackingmore', ['controller' => 'tracking', 'action' => 'webhookTrackingmore'], $languages);

	 Router::connect('/:language/forgot-password', array('controller' => 'retrievePasswords', 'action' => 'index'), $languages);
	 Router::connect('/:language/new-password', array('controller' => 'retrievePasswords', 'action' => 'confirm'), $languages);

	 Router::connect('/:language/cookie-accept', array('controller' => 'customers', 'action' => 'acceptCookie'), $languages);

	 Router::connect('/:language/request-assistance', array('controller' => 'requests', 'action' => 'formRequest'), $languages);
	 Router::connect('/:language/request-detail/*', array('controller' => 'requests', 'action' => 'detailRequest'), $languages);
	 Router::connect('/:language/request-list', array('controller' => 'requests', 'action' => 'listRequest'), $languages);
	 Router::connect('/:language/close-request/*', array('controller' => 'requests', 'action' => 'closeTicket'), $languages);


	 Router::connect('/:language', ['controller' => 'customers', 'action' => 'home'], $languages);
	 Router::connect('/:language/:currency', ['controller' => 'customers', 'action' => 'home'], $languages, $currencies);
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
