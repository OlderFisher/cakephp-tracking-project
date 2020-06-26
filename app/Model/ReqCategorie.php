<?php
App::uses('AuthComponent', 'Controller/Component');
/**
* ReqCategorie Model
*
* @property ReqTicket $ReqTicket
*/
class ReqCategorie extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	* hasOne associations
	*
	* @var array
	*/
	public $hasOne = array(
		'ReqTicket' => array(
			'className' => 'ReqTicket',
			'foreignKey' => 'categorie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
