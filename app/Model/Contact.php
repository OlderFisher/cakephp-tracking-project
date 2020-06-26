<?php

class Contact extends AppModel {

	var $name = 'Contact';

	// Nous n'utiliserons pas de table dans la base
	var $useTable = false;

	// Nous donnons donc à Cake la structure d'un enregistrement
	var $_schema = array(
		'first_name' => array(
			'type' => 'string',
			'length' => 30
		),
		'last_name' => array(
			'type' => 'string',
			'length' => 30
		),
		'email' => array(
			'type' => 'string',
			'length' => 50
		),
		'subject' => array(
			'type' => 'string',
			'length' => 50
		),
		'message' => array(
			'type' => 'text'
		)
	);

	// Règles de validation des données
	public $validationDomain = 'default';
	var $validate = array(
		'last_name' => array(
			'rule' => 'notBlank',
			'required' => true,
			'allowEmpty' => false,
			'message' =>'validation.required.lastname'
		),
		'first_name' => array(
			'rule' => 'notBlank',
			'required' => true,
			'allowEmpty' => false,
			'message' =>'validation.required.firstname'
		),
		'email' => array(
			'rule' => 'email',
			'required' => true,
			'allowEmpty' => false,
			'message' =>'validation.email'
		),
		'subject' => array(
			'rule' => 'notBlank',
			'required' => true,
			'allowEmpty' => false,
			'message' =>'validation.required.subject'
		),
		'message' => array(
			'rule' => 'notBlank',
			'required' => true,
			'allowEmpty' => false,
			'message' =>'validation.required.message'
		)
	);
}
