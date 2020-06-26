<?php
App::uses('AuthComponent', 'Controller/Component');
/**
* TrackParcel Model
*
* @property Customer $Customer
*/
class TrackParcel extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	* belongsto associations
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
		)
	);

}
