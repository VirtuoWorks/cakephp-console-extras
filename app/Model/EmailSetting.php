<?php
App::uses('AppModel',  'Model');
/**
 * EmailSetting Model
 *
 */
class EmailSetting extends AppModel {

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
  public $displayField = 'action';

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
    'action' => array(
      'notEmpty' => array(
        'rule' => array('notEmpty'), 
        'message' => 'Action cannot be left blank.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'maxLength' => array(
        'rule' => array('maxLength',  255), 
        'message' => 'Action must be no larger than %d characters long.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'isUnique' => array(
        'rule' => array('isUnique'), 
        'message' => 'Action has already been taken.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'bcc' => array(
      'maxLength' => array(
        'rule' => array('maxLength',  255), 
        'message' => 'Action must be no larger than %d characters long.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'email' => array(
        'rule' => array('email',  false,  NULL), 
        'message' => 'Bcc must be a valid email address.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'replyTo' => array(
      'notEmpty' => array(
        'rule' => array('notEmpty'), 
        'message' => 'Replyto cannot be left blank.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'email' => array(
        'rule' => array('email',  false,  NULL), 
        'message' => 'Replyto must be a valid email address.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'maxLength' => array(
        'rule' => array('maxLength',  255), 
        'message' => 'Replyto must be no larger than %d characters long.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'emailFormat' => array(
      'notEmpty' => array(
        'rule' => array('notEmpty'), 
        'message' => 'Sendas cannot be left blank.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'inList' => array(
        'rule' => array('inList',  array(0 => 'Both', 1 => 'Text', 3 => 'Html')), 
        'message' => 'Sendas must be either Both or Text or Html.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'transport' => array(
      'inList' => array(
        'rule' => array('inList',  array(0 => 'Mail', 1 => 'Smtp')), 
        'message' => 'Delivery must be either Mail or Smtp.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'timeout' => array(
      'numeric' => array(
        'rule' => array('numeric'), 
        'message' => 'Timeout must be a valid number.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'port' => array(
      'numeric' => array(
        'rule' => array('numeric'), 
        'message' => 'Port must be a valid number.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'host' => array(
      'maxLength' => array(
        'rule' => array('maxLength',  255), 
        'message' => 'Host must be no larger than %d characters long.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'url' => array(
        'rule' => array('url',  false), 
        'message' => 'Host must be a valid url.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'username' => array(
      'maxLength' => array(
        'rule' => array('maxLength',  255), 
        'message' => 'Username must be no larger than %d characters long.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'password' => array(
      'maxLength' => array(
        'rule' => array('maxLength',  255), 
        'message' => 'Password must be no larger than %d characters long.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'tls' => array(
      'boolean' => array(
        'rule' => array('boolean'), 
        'message' => 'Incorrect value for Tls.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
 );
}