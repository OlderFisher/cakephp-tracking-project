<?php
App::uses('AuthComponent', 'Controller/Component');
/**
* ReqTicket Model
*
* @property Customer $Customer
* @property User $User
* @property ReqCategorie $ReqCategorie
* @property ReqStatus $ReqStatus
* @property ReqMessage $ReqMessage
*/
class ReqTicket extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	* belongsTo associations
	*
	* @var array
	*/
	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ReqCategorie' => array(
			'className' => 'ReqCategorie',
			'foreignKey' => 'categorie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ReqStatus' => array(
			'className' => 'ReqStatus',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	* hasMany associations
	*
	* @var array
	*/
	public $hasMany = array(
		'ReqMessage' => array(
			'className' => 'ReqMessage',
			'foreignKey' => 'ticket_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
