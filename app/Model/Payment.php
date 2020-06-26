<?php
App::uses('AuthComponent', 'Controller/Component');
/**
* Payment Model
*
* @property Customer $Customer
* @property PaymentStatus $PaymentStatus
* @property Product $Product
*/
class Payment extends AppModel {


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
		'PaymentStatus' => array(
			'className' => 'PaymentStatus',
			'foreignKey' => 'payment_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $validationDomain = 'default';
	public $validate = array(
		'customer_id' => array(
			'required' => array(
				'rule' => array('notBlank'),
				'message' => 'validation.required.captcha'
			)
		),
		'payment_status_id' => array(
			'required' => array(
				'rule' => array('notBlank'),
				'message' => 'validation.required.payment_status'
			)
		),
		'payment_code' => array(

		),
		'error_return' => array(

		),
		'hash_card' => array(

		),
		'product_id' => array(
			'required' => array(
				'rule' => array('notBlank'),
				'message' => 'validation.required.product'
			)
		),
		'subscription_amount' => array(

		),
		'rebill_amount' => array(

		),
		'created' => array(
			'required' => array(
				'rule' => array('notBlank'),
				'message' => 'validation.required.creation_date'
			)
		),
		'processed' => array(

		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['hash_card'])) {
			$this->data[$this->alias]['hash_card'] = AuthComponent::password($this->data[$this->alias]['hash_card']);
		}
		return true;
	}
}
