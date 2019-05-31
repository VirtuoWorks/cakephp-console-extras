<?php
App::uses('AppModel',  'Model');
/**
 * BlacklistedIp Model
 *
 */
class BlacklistedIp extends AppModel {

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
  public $displayField = 'ip_address';

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
    'ip_access_count' => array(
      'notEmpty' => array(
        'rule' => array('numeric'), 
        'message' => 'Ip Access Count must be a valid number.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'ip_address' => array(
      'notEmpty' => array(
        'rule' => array('notEmpty'), 
        'message' => 'Ip Address cannot be left blank.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'ip' => array(
        'rule' => array('ip',  'both'), 
        'message' => 'Ip Address must be a valid IPv4 or IPv6 address.', 
        'allowEmpty' => true, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'is_blacklisted_ip_address' => array(
      'boolean' => array(
        'rule' => array('boolean'), 
        'message' => 'Incorrect value for Is Blacklisted Ip.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
 );
}