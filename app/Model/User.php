<?php
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property ReqTicket $ReqTicket
 * @property ReqMessage $ReqMessage
 */
class User extends AppModel {


  //The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	* hasOne associations
	*
	* @var array
	*/
	public $hasOne = array(
		'ReqTicket' => array(
			'className' => 'ReqTicket',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ReqMessage' => array(
			'className' => 'ReqMessage',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);


}
