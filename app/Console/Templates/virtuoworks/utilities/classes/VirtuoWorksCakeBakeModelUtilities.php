<?php
if (!class_exists('VirtuoWorksCakeBakeModelUtilities')) {
  class VirtuoWorksCakeBakeModelUtilities{

    /* Cake datatypes and MySQL datatypes 
    *enum($vals) (Cake) i.e (MySQL) enum
    *float (Cake) i.e (MySQL) decimal or float or double
    *binary (Cake) i.e (MySQL)blob or binary
    *text (Cake) i.e (MySQL) text or unknown
    *string (Cake) i.e (MySQL) varchar
    *integer (Cake) i.e (MySQL) int or bigint
    *boolean (Cake) i.e (MySQL) tinyint
    *date (Cake) i.e (MySQL) self
    *time (Cake) i.e (MySQL) self
    *datetime (Cake) i.e (MySQL) self
    *timestamp (Cake) i.e (MySQL) self
    */

    public static $fieldNameRegex = array(
      'alphaNumeric' => '^((([a-z]+)_) {0, 1})(username|nickname)$',                                       //field name matches "username" or "someprefix_username" or "nickname" or "someprefix_nickname"
      'between' => false,                                                             //
      'blank' => false,                                                             //
      'boolean' => '^(is((_([a-z]+)+)+))|(([a-z]+)_has((_([a-z]+)+)+))$',                                     //field name matches "is_somesuffix" or "is_somesuffix_someothersuffix" or "someprefix_has_somesuffix" or "someprefix_has_somesuffix_somesuffix"
      'cc' => '^((([a-z]+)_) {0, 1})(([a-z]*)(cc|creditcard|credit_card))$',                                   //field name matches "cc" or "someprefix_cc" or "someprefix_someotherprefixcc" or "creditcard" or "credit_card"
      'luhn' => false,                                                             //
      'comparison' => false,                                                           //
      'date' => '^((([a-z]+)_) {0, 1})(([a-z]*)date)$',                                               //field name matches "date" or "someprefix_date" or "someprefix_someotherprefixdate"
      'datetime' => '^((([a-z]+)_) {0, 1})(created|modified|updated)$',                                       //field name matches "created" or "someprefix_created" or "modified" or "updated"
      'time' => '^((([a-z]+)_) {0, 1})(([a-z]*)(hour|time))$',                                           //field name matches "time" or "someprefix_time" or "someprefix_someotherprefixtime" or "hour"
      'decimal' => '^((([a-z]+)_) {0, 1})(([a-z]*)(rate|ratio|percentage))$',                                   //field name matches "rate" or "someprefix_rate" or "someprefix_someotherprefixrate" or "ratio" or "percentage"
      'email' => '^((([a-z]+)_) {0, 1})(([a-z]*)(mail|email))$',                                         //field name matches "mail" or "someprefix_mail" or "someprefix_someotherprefixmail" or "email" or "email"
      'equalTo' => false,                                                             //
      'extension' => '^((([a-z]+)_) {0, 1})(([a-z]*)(filename))$',                                         //field name matches "filename" or "someprefix_filename" or "someprefix_someotherprefixfilename"
      'ip' => false,                                                               //
      'isUnique' => false,                                                           //
      'minLength' => false,                                                           //
      'maxLength' => false,                                                           //
      'money' => '^((([a-z]+)_) {0, 1})(([a-z]*)(amount))$',                                           //field name matches "amount" or "someprefix_amount" or "someprefix_someotherprefixamount"
      'multiple' => false,                                                           //
      'inList' => false,                                                             //
      'numeric' => '^(id)|(([a-z]+)_id)$',                                                   //field name matches "id" or "someprefix_id"
      'notEmpty' => false,                                                           //
      'phone' => '^((([a-z]+)_) {0, 1})(([a-z]*)(phone|telephone|phonenumber|phone_number))$',                           //field name matches "phone" or "someprefix_phone" or "someprefix_someotherprefixphone" or "telephone" or "phonenumber" or "phone_number"
      'postal' => '^((([a-z]+)_) {0, 1})(([a-z]*)(postal|postalcode|postal_code))$',                               //field name matches "postal" or "someprefix_postal" or "someprefix_someotherprefixpostal" or "postalcode" or "postal_code"
      'range' => false,                                                             //
      'ssn' => '^((([a-z]+)_) {0, 1})(([a-z]*)(ssn|socialsecuritynumber|social_security_number))$',                         //field name matches "ssn" or "someprefix_ssn" or "someprefix_someotherprefixssn" or "socialsecuritynumber" or "social_security_number"
      'url' => '^((([a-z]+)_) {0, 1})(([a-z]*)(url|link|host|website))$',                                       //field name matches "url" or "someprefix_url" or "someprefix_someotherprefixurl" or "link" or "website"
      'uuid' => '^((([a-z]+)_) {0, 1})(([a-z]*)(uuid|key|activation|activation_key|activation_code))$',                       //field name matches "uuid" or "someprefix_uuid" or "someprefix_someotherprefixuuid" or "key" or "activation" or "activation_key" or "activation_code"
      'custom' => false,                                                             //
      'userDefined' => false                                                          //
   );

    //Validation::[method] (staticmethod,  in Data Validation)
    public static $fieldRulesMessages = array(
      'alphaNumeric' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must only contain letters and numbers.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must only contain letters and numbers.', 
          'args' => array()
       )
     ), 
      'between' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be between %s and %s characters long.', 
          'sprintf' => array(
            'min' => "'8'",                   //(str)
            'max' => "'128'"                //(str)
         )
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be between %d and %d characters long.', 
          'args' => array(
            'min' => 8,                     //(int)
            'max' => 128                  //(int)
         )
       )
     ), 
      'blank' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be left blank.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be left blank.', 
          'args' => array()
       )
     ), 
      'boolean' => array(
        'i18n' => array(
          'message' => 'Incorrect value for %HumanizedFieldName%.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => 'Incorrect value for %HumanizedFieldName%.', 
          'args' => array()
       )
     ), 
      'cc' => array(
        'i18n' => array(
          'message' => 'The credit card number you supplied was invalid.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => 'The credit card number you supplied was invalid.', 
          'args' => array(
            'type' => 'all',                  //(str) : 'fast',  'all' ;(arr) : 'amex',  'bankcard',  'diners',  'disc',  'electron',  'enroute',  'jcb',  'maestro',  'mc',  'solo',  'switch',  'visa',  'voyager'
            'deep' => false,                  //(bool)
            'regex' => null                 //(str)
         )
       )
     ), 
      'luhn' => array(
        'i18n' => array(
          'message' => 'The identification number you supplied was invalid.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => 'The identification number you supplied was invalid.', 
          'args' => array(
            'deep' => false                  //(bool)
         )
       )
     ), 
      'comparison' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be %s %s.', 
          'sprintf' => array(
            'operator' => "__('greater or equal to')",     //(str)
            'check2' => "'0'"                //(str)
         )
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be greater or equal to %d.', 
          'args' => array(
            'operator' => '>=',                 //(str)
            'check2' => 0                  //(int)
         )
       )
     ), 
      'date' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid date in DD-MM-YY format.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid date in DD-MM-YY format.', 
          'args' => array(
            'format' => 'ymd',                 //(str)
            'regex' => null                  //(str)
         )
       )
     ), 
      'datetime' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid date in DD-MM-YY format and a valid time in HH:MM or (H)H:MM (am or pm) format.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid date in DD-MM-YY format and a valid time in HH:MM or (H)H:MM (am or pm) format.', 
          'args' => array(
            'format' => 'ymd',                 //(str)
            'regex' => null                  //(str)
         )
       )
     ), 
      'time' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid time in HH:MM or (H)H:MM (am or pm) format.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid time in HH:MM or (H)H:MM (am or pm) format.', 
          'args' => array()
       )
     ), 
      'decimal' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid decimal value.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid decimal value.', 
          'args' => array(
            'places' => 2,                   //(int)
            'regex' => null                  //(str)
         )
       )
     ), 
      'email' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid email address.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid email address.', 
          'args' => array(
            'deep' => false,                 //(bool)
            'regex' => null                  //(str)
         )
       )
     ), 
      'equalTo' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be equal to %s.', 
          'sprintf' => array(
            'compareTo' => "'0'"              //(str)
         )
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be equal to %d.', 
          'args' => array(
            'compareTo' => 0                //(mixed)
         )
       )
     ), 
      'extension' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% does not have a valid extension type.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% does not have a valid extension type.', 
          'args' => array(
            'extensions' => array('gif', 'jpeg', 'png', 'jpg')  //(arr)
         )
       )
     ), 
      'ip' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid IP address.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid IP address.', 
          'args' => array(
            'type' => 'both'                //(str) 'both', 'IPv4', 'IPv6'
         )
       )
     ), 
      'isUnique' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% has already been taken.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% has already been taken.', 
          'args' => array()
       )
     ), 
      'minLength' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be at least %s characters long.', 
          'sprintf' => array(
            'min' => "'8'"                  //(str)
         )
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be at least %d characters long.', 
          'args' => array(
            'min' => 8                    //(int)
         )
       )
     ), 
      'maxLength' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be no larger than %s characters long.', 
          'sprintf' => array(
            'max' => "'128'"                //(str)
         )
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be no larger than %d characters long.', 
          'args' => array(
            'max' => 128                  //(int)
         )
       )
     ), 
      'money' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid monetary amount.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid monetary amount.', 
          'args' => array(
            'symbolPosition' => 'right'            //(str) 'left', 'right'
         )
       )
     ), 
      'multiple' => array(
        'i18n' => array(
          'message' => 'You must select at least %s options for %HumanizedFieldName%.', 
          'sprintf' => array(
            'min' => "'1'" 
         )
       ), 
        'rule' => array(
          'message' => 'You must select at least %d options for %HumanizedFieldName%.', 
          'args' => array(
            'options' => array(               //(arr)
              'in'  => array('do',  'ray',  'me',  'fa',  'so',  'la',  'ti'), 
              'min' => 1, 
              'max' => 3
           )
         )
       )
     ), 
      'inList' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be either %EnumValues%.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be either Foo or Bar.', 
          'args' => array(
            'list' => array('Foo', 'Bar'),           //(arr)
            'strict' => true                //(bool)
         )
       )
     ), 
      'numeric' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid number.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid number.', 
          'args' => array()
       )
     ), 
      'notEmpty' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% cannot be left blank.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% cannot be left blank.', 
          'args' => array()
       )
     ), 
      'phone' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid phone number.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid phone number.', 
          'args' => array(
            'regex' => null,                 //(str)
            'country' => 'all'                //(str) 'all', 'us'
         )
       )
     ), 
      'postal' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid postal code.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid postal code.', 
          'args' => array(
            'regex' => null,                 //(str)
            'country' => 'us'                //(str) 'us', 'ca', 'be', 'uk', 'it', 'ge'
         )
       )
     ), 
      'range' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a number between %s and %s.', 
          'sprintf' => array(
            'lower' => "'0'", 
            'upper' => "'10'"
         )
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a number between %d and %d.', 
          'args' => array(
            'lower' => -1,                   //(int)
            'upper' => 11                  //(int)
         )
       )
     ), 
      'ssn' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid social security number.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid social security number.', 
          'args' => array(
            'regex' => null,                 //(str)
            'country' => 'us'                //(str) 'us', 'dk', 'nl'
         )
       )
     ), 
      'url' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid url.', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid url.', 
          'args' => array(
            'strict' => false                //(bool)
         )
       )
     ), 
      'uuid' => array(
        'i18n' => array(
          'message' => '%HumanizedFieldName% must be a valid identifier (Universally Unique IDentifier).', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => '%HumanizedFieldName% must be a valid identifier (Universally Unique IDentifier).', 
          'args' => array()
       )
     ), 
      'custom' => array(
        'i18n' => array(
          'message' => 'Incorrect value for %HumanizedFieldName% (syntax error).', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => 'Incorrect value for %HumanizedFieldName% (syntax error).', 
          'args' => array(
            'regex' => '^[a-zA-Z_]$'            //(str)
         )
       )
     ), 
      'userDefined' => array(
        'i18n' => array(
          'message' => 'Incorrect value for %HumanizedFieldName% (unknown error).', 
          'sprintf' => array()
       ), 
        'rule' => array(
          'message' => 'Incorrect value for %HumanizedFieldName% (unknown error).', 
          'args' => array(
            'object' => null,                 //(obj) object
            'method' => null,                 //(str) method
            'args' => null                  //(arr) args
         )
       )
     )
   );

    public static function getRulesMessages($field = null, $forI18n = false) {
      if (isset($field) && is_string($field)) {
        $fieldRulesMessages = self::$fieldRulesMessages;
        if (isset($fieldRulesMessages) && is_array($fieldRulesMessages) && count($fieldRulesMessages)) {
          $messages = array();
          foreach ($fieldRulesMessages as $ruleName => $ruleMessages) {
            if ($forI18n) {
              if (isset($ruleMessages['i18n']) && isset($ruleMessages['i18n']['message']) && is_string($ruleMessages['i18n']['message'])) {
                $messages[$ruleName] = array('message' => str_replace('%HumanizedFieldName%', Inflector::humanize($field), $ruleMessages['i18n']['message']));
                if (isset($ruleMessages['i18n']['sprintf']) && is_array($ruleMessages['i18n']['sprintf']) && count($ruleMessages['i18n']['sprintf'])) {
                  $messages[$ruleName]['sprintf'] = $ruleMessages['i18n']['sprintf'];
                }
              }
            } else {
              if (isset($ruleMessages['rule']) && isset($ruleMessages['rule']['message']) && is_string($ruleMessages['rule']['message'])) {
                $messages[$ruleName] = array('message' => str_replace('%HumanizedFieldName%', Inflector::humanize($field), $ruleMessages['rule']['message']));
                if (isset($ruleMessages['rule']['args']) && is_array($ruleMessages['rule']['args']) && count($ruleMessages['rule']['args'])) {
                  $messages[$ruleName]['args'] = $ruleMessages['rule']['args'];
                }
              }
            }
          }
          if (isset($messages) && is_array($messages) && count($messages)) {
            return $messages;
          } else {
            return false;
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    public static function checkFieldNameRegex($field = null, $rule = null) {
      if (isset($field) && is_string($field)) {
        if (isset($rule) && isset(self::$fieldNameRegex) && is_array(self::$fieldNameRegex) && isset(self::$fieldNameRegex[$rule]) && (self::$fieldNameRegex[$rule])) {
          if (preg_match('#'.self::$fieldNameRegex[$rule].'#', $field)) {
            return true;
          } else {
            return false;
          }
        } else {
          return false;
        }
        return false;
      } else {
        return false;
      }
    }

    public static function getRulesParsedMessages($rule = null, $field = null) {
      if (isset($rule) && is_string($rule) && isset($field) && is_string($field)) {
        $fieldRulesMessages = self::getRulesMessages($field);
        switch(strtolower($rule)) {
          case 'alphanumeric':
            //Validation::alphaNumeric (staticmethod,  in Data Validation)
            $rule = 'alphaNumeric';
          break;
          case 'equalto':
            //Validation::equalTo (staticmethod,  in Data Validation)
            $rule = 'equalTo';
          break;
          case 'isunique':
            //Validation::isUnique (staticmethod,  in Data Validation)
            $rule = 'isUnique';
          break;
          case 'minlength':
            //Validation::minLength (staticmethod,  in Data Validation)
            $rule = 'minLength';
          break;
          case 'maxlength':
            //Validation::maxLength (staticmethod,  in Data Validation)
            $rule = 'maxLength';
          break;
          case 'inlist':
            //Validation::inList (staticmethod,  in Data Validation)
            $rule = 'inList';
          break;
          case 'notempty':
            //Validation::notEmpty (staticmethod,  in Data Validation)
            $rule = 'notEmpty';
          break;
          case 'userdefined':
            //Validation::userDefined (staticmethod,  in Data Validation)
            $rule = 'userDefined';
          break;
        }
        $output = array();
        $output[] = "'$rule' => array(";
        if (isset($fieldRulesMessages[$rule])) {
          if (isset($fieldRulesMessages[$rule]['args']) && is_array($fieldRulesMessages[$rule]['args']) && count($fieldRulesMessages[$rule]['args'])) {
            $args = null;
            foreach ($fieldRulesMessages[$rule]['args'] as $arg) {
              $arg = var_export($arg,  true);
              $args .= ",  " . str_replace(array(" ", "\n", "\r", "\t", ",)", "=>"),  array("", "", "", "", ")", " => "),  (string)$arg);
            }

            //$args = var_export($fieldRulesMessages[$rule]['args'],  true);
            //$output[] = "'rule' => array('$rule', " . str_replace(array(" ", "\n", "\r", "\t", ",)", "=>"), array("", "", "", "", ")", " => "), (string)$args) . "), ";
            $output[] = "'rule' => array('$rule'" . $args . "), ";
          } else {
            $output[] = "'rule' => array('$rule'), ";
          }
          if (isset($fieldRulesMessages[$rule]['message']) && is_string($fieldRulesMessages[$rule]['message'])) {
            $output[] = "'message' => '" . $fieldRulesMessages[$rule]['message'] . "', ";
          } else {
            $output[] = "//'message' => 'Your custom message here', ";
          }
        } else {
          $output[] = "'rule' => array('$rule'), ";
          $output[] = "//'message' => 'Your custom message here', ";
        }
        return $output;
      } else {
        return false;
      }
    }

  }
}