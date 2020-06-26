<?php
App::uses('AuthComponent', 'Controller/Component');
/**
* Currency Model
*
* @property Customer $Customer
*/
class Currency extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	* belongsto associations
	*
	* @var array
	*/
	public $hasOne = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'currency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
