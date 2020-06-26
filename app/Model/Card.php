<?php

class Card extends AppModel {
  public $name = 'Card';

  public $useTable = false;

  public $validationDomain = 'default';
  public $validate = array(
    'name' => array(
      'rule1' => array(
        'rule'    => 'notBlank',
        'required' => 'true',
        'allowEmpty' => false,
        'message' => 'validation.required.name'
      ),
      'rule2' => array(
        'rule'    => array('minLength', 2),
        'required' => 'true',
        'allowEmpty' => false,
        'message' => 'validation.min.name'
      )
    ),
    'number' => array(
      'rule1' => array(
        'rule'    => array('between', 16, 16), //'rule'    => array('cc', array('bankcard'), false, null),
        'required' => 'true',
        'allowEmpty' => false,
        'message' => 'validation.required.card_number'
      )
    ),
    'date_expire' => array(

    ),
    'cvv' => array(
      'rule1' => array(
        'rule'    => 'notBlank',
        'required' => 'true',
        'allowEmpty' => false,
        'message' => 'validation.required.cvv'
      ),
      'rule2' => array(
        'rule'    => array('between', 3, 3),
        'message' => 'validation.min.cvv'
      )
    ),
    'cgv' => array(
      'required' => array(
        'rule' => 'notBlank',
        'required' => 'true',
        'allowEmpty' => false,
        'message' => 'validation.required.tos'
      )
    ),
    'subscribe' => array(

    )
  );

}
