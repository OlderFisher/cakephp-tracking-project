<?php
App::uses('AuthComponent', 'Controller/Component');
/**
* Customer Model
*
* @property Payment $Payment
* @property Langue $Langue
* @property Country $Country
* @property Currency $Currency
*/
class Customer extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	* hasOne associations
	*
	* @var array
	*/
	public $hasOne = array(
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ReqTicket' => array(
			'className' => 'ReqTicket',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ReqMessage' => array(
			'className' => 'ReqMessage',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $belongsTo = array(
		'Langue' => array(
			'className' => 'Langue',
			'foreignKey' => 'langue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'TrackParcel' => array(
			'className' => 'TrackParcel',
			'foreignKey' => 'customer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	function matchCaptcha($inputValue)	{
		return $inputValue['captcha']==$this->getCaptcha();
	}

	function setCaptcha($value)	{
		$this->captcha = $value;
	}

	function getCaptcha()	{
		return $this->captcha;
	}

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

}
