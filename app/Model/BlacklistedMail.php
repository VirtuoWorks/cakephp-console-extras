<?php
App::uses('AppModel',  'Model');
/**
 * BlacklistedMail Model
 *
 */
class BlacklistedMail extends AppModel {

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
  public $displayField = 'mail_account';

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
    'mail_account' => array(
      'notEmpty' => array(
        'rule' => array('notEmpty'), 
        'message' => 'Mail Account cannot be left blank.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'email' => array(
        'rule' => array('email',  true,  NULL), 
        'message' => 'Mail Account must be a valid email address.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'minLength' => array(
        'rule' => array('minLength',  8), 
        'message' => 'Mail Account must be at least %d characters long.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'maxLength' => array(
        'rule' => array('maxLength',  255), 
        'message' => 'Mail Account must be no larger than %d characters long.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
      'isUnique' => array(
        'rule' => array('isUnique'), 
        'message' => 'Mail Account has already been taken.', 
        'allowEmpty' => false, 
        'required' => true, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
    'is_blacklisted_mail_account' => array(
      'boolean' => array(
        'rule' => array('boolean'), 
        'message' => 'Incorrect value for Is Blacklisted Mail.', 
        'allowEmpty' => true, 
        'required' => false, 
        //'last' => false,  // Stop validation after this rule
        //'on' => 'create',  // Limit validation to 'create' or 'update' operations
     ), 
   ), 
 );
}