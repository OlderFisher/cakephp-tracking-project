<?php

class Unsubscribe extends AppModel {

	var $name = 'Unsubscribe';

	var $useTable = false;

	var $_schema = array(
		'email' => array(
			'type' => 'string',
			'length' => 50
		),
		'captcha' => array(
			'type' => 'string',
			'length' => 15
		)
	);

	// Règles de validation des données
	var $validate = array(
		'email' => array(
			'rule' => 'email',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'validation.email'
		),
		'captcha' => array(
			'rule' => 'notBlank',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'validation.required.captcha'
		)
	);
}
