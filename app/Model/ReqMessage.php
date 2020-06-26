<?php
App::uses('AuthComponent', 'Controller/Component');
/**
* ReqMessage Model
*
* @property Customer $Customer
* @property User $User
* @property ReqTicket $ReqTicket
*/
class ReqMessage extends AppModel {


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
		'ReqTicket' => array(
			'className' => 'ReqTicket',
			'foreignKey' => 'ticket_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
