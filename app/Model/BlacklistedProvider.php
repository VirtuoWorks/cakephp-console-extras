<?php
App::uses('AppModel',  'Model');
/**
 * BlacklistedProvider Model
 *
 */
class BlacklistedProvider extends AppModel {

/**
 * ContainableBehavior
 *
 * @var array
 */
  public $actsAs = array('Containable');

/**
 * Display field
 *
 * @var string
 */
  public $displayField = 'provider_host';

/**
 * Validation domain (for i18n)
 *
 * @var string
 */
  public $validationDomain = 'validation';

/**
 * Validation rules
 *
 * @var array
 */
  public $validate = array(
    'id' => array(
      'notEmpty' => array(
        'rule' => array('notEmpty'), 
        'message' => 'Id cannot be left blank.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        'on' => 'update',  // Limit validation to 'create' or 'update' operations
     ), 
      'numeric' => array(
        'rule' => array('numeric'), 
        'message' => 'Id must be a valid number.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        'on' => 'update',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'provider_host' => array(
      'notEmpty' => array(
        'rule' => array('notEmpty'), 
        'message' => 'Provider Host cannot be left blank.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'url' => array(
        'rule' => array('url',  false), 
        'message' => 'Provider Host must be a valid url.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'isUnique' => array(
        'rule' => array('isUnique'), 
        'message' => 'Provider Host has already been taken.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'is_blacklisted_host' => array(
      'boolean' => array(
        'rule' => array('boolean'), 
        'message' => 'Incorrect value for Is Blacklisted Host.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
 );
}