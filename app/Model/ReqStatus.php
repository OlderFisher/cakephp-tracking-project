<?php
App::uses('AuthComponent', 'Controller/Component');
/**
* ReqStatus Model
*
* @property ReqTicket $ReqTicket
*/
class ReqStatus extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	* hasOne associations
	*
	* @var array
	*/
	public $hasOne = array(
		'ReqTicket' => array(
			'className' => 'ReqTicket',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
