<?php
if (is_file(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'VirtuoWorksCakeBakeModelUtilities.php')) {
  require_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'VirtuoWorksCakeBakeModelUtilities.php');
}
if (class_exists('VirtuoWorksCakeBakeModelUtilities') && !class_exists('VirtuoWorksCakeBakeFormUtilities')) {
  class VirtuoWorksCakeBakeFormUtilities extends VirtuoWorksCakeBakeModelUtilities{

    public static $useFieldNameRegex = true;

    /*http://docs.jquery.com/Plugins/Validation*/
    public static $cakeRulesTojQueryRules = array(
      'alphaNumeric' => 'alphanumeric',
      'between' => null,
      'blank' => null,
      'boolean' => null,
      'cc' => 'creditcard', //'creditcardtypes'
      'luhn' => null,
      'comparison' => null,
      'date' => 'date', //'dateITA', 'dateNL'
      'datetime' => 'dateISO',
      'time' => 'time', //'time12h'
      'decimal' => 'number',
      'email' => 'email', //'email2'
      'equalTo' => null,
      'extension' => null,
      'ip' => 'ipv4', //ipv6
      'isUnique' => null,
      'minLength' => 'minlength', //'strippedminlength'
      'maxLength' => 'maxlength',
      'money' => null,
      'multiple' => null,
      'inList' => null,
      'numeric' => 'integer',
      'notEmpty' => 'required',
      'phone' => 'phoneUS', //'phoneUK', 'mobileUK'
      'postal' => 'ziprange',
      'range' => 'range',
      'ssn' => null,
      'url' => 'url', //'url2'
      'uuid' => null,
      'custom' => null, //'pattern'
      'userDefined' => null
   );

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

    public static function isKey($schema = null, $field = null) {
      return self::getKeyType($schema, $field, 'bool');
    }

    public static function isNull($schema = null, $field = null) {
      if (self::isFieldInSchema($schema, $field)) {
        if (isset($schema[$field]['null']) && $schema[$field]['null']) {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    public static function isEnum($schema = null, $field = null) {
      if (self::isFieldInSchema($schema, $field)) {
        if (isset($schema[$field]['type'])) {
          if (preg_match('#^(enum\()((\'[a-zA-Z0-9]+((\'\))|(\',)))+)$#', $schema[$field]['type'])) {
            return true;
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

    public static function hasLength($schema = null, $field = null) {
      return self::getFieldLength($schema, $field, 'bool');
    }

    public static function hasDefault($schema = null, $field = null) {
      return self::getDefault($schema, $field, 'bool');
    }

    public static function isFieldInSchema($schema = null, $field = null) {
      if (isset($field) && isset($schema) && isset($schema[$field]) && is_array($schema[$field]) && count($schema[$field])) {
        return true;
      } else {
        return false;
      }
    }

    public static function getDefault($schema = null, $field = null, $out = 'value') {
      if (self::isFieldInSchema($schema, $field)) {
        if (isset($schema[$field]['default'])  &&  ($schema[$field]['default'] !== ''||$schema[$field]['default'] !== false)) {
          if ($out == 'bool') {
            return true;
          } else {
            return $schema[$field]['default'];
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    /* Cake key types
    *  key =>
    *    'primary'
    *    'index'
    *    'unique'
    */
    public static function getKeyType($schema = null, $field = null, $out = 'value') {
      if (self::isFieldInSchema($schema, $field)) {
        if (isset($schema[$field]['key'])) {
          if ($out == 'bool') {
            return true;
          } else {
            //primary or index or unique (Cake) i.e (MySQL) primary or foreign or unique
            return $schema[$field]['key'];
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    /* Cake datatypes 
    *  type =>
    *    'enum (enum($vals))';
    *    'float';
    *    'binary';
    *    'text';
    *    'string';
    *    'integer';
    *    'boolean';
    *    'date'
    *    'time'
    *    'datetime'
    *    'timestamp'
    */
    public static function getFieldType($schema = null, $field = null) {
      if (self::isFieldInSchema($schema, $field)) {
        if (self::isEnum($schema, $field)) {
          return 'enum';
        } else {
          if (isset($schema[$field]['type'])) {
            return $schema[$field]['type'];
          } else {
            return false;
          }
        }
      } else {
        return false;
      }
    }


    public static function getFieldLength($schema = null, $field = null, $out = 'value') {
      if (self::isFieldInSchema($schema, $field)) {
        if (isset($schema[$field]['length'])) {
          if ($out == 'bool') {
            return true;
          } else {
            //length (Cake) i.e (MySQL) length or size
            return $schema[$field]['length'];
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    public static function getEnumValues($schema = null, $field = null) {
      if (self::isEnum($schema, $field)) {
        $matches = array();
        if (preg_match_all('#\'[a-zA-Z0-9_-]+\'#', $schema[$field]['type'], $matches)) {
          if (isset($matches[0]) && is_array($matches[0]) && count($matches[0])) {
            return $matches[0];
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

    public static function getEnumParsedValues($schema = null, $field = null) {
      if (self::isFieldInSchema($schema, $field)) {
        if (self::isEnum($schema, $field)) {
          $enum = self::getEnumValues($schema, $field);
          if (isset($enum) && is_array($enum) && count($enum)) {
            $values = array();
            foreach ($enum as $value) {
              $value = trim($value,"'");
              switch($value) {
                case 'M':
                  $values[$value] = 'Male';
                break;
                case 'F':
                  $values[$value] = 'Female';
                break;
                case 'Y':
                  $values[$value] = 'Yes';
                break;
                case 'N':
                  $values[$value] = 'No';
                break;
                case 'R':
                  $values[$value] = 'Requested';
                break;
                case 'W':
                  $values[$value] = 'Waiting';
                break;
                case 'B':
                  $values[$value] = 'Blocked';
                break;
                case 'NA':
                  $values[$value] = 'Unspecified';
                break;
                default:
                  if (is_string($value)) {
                    $values[$value] = ucwords(strtolower($value));
                  } else {
                    $values[$value] = $value;
                  }
              }
            }
            return $values;
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

    public static function getRulesI18nMessages($schema = null, $field = null, $useRegex = false) {
      if (self::isFieldInSchema($schema, $field)) {
        $fieldRulesI18nMessages = self::getRulesMessages($field,true);
        if (isset($fieldRulesI18nMessages) && is_array($fieldRulesI18nMessages) && count($fieldRulesI18nMessages)) {
          $messages = array();
          //Validation::alphaNumeric (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['alphaNumeric']) && ($useRegex && self::checkFieldNameRegex($field, 'alphaNumeric'))) {
            $messages['alphaNumeric'] = $fieldRulesI18nMessages['alphaNumeric']['message'];
          }
          //Validation::between (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['between']) && ($useRegex && self::checkFieldNameRegex($field, 'between'))) {
            $messages['between'] = $fieldRulesI18nMessages['between'];
          }
          //Validation::blank (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['blank']) && ($useRegex && self::checkFieldNameRegex($field, 'blank'))) {
            $messages['blank'] = $fieldRulesI18nMessages['blank'];
          }
          //Validation::boolean (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['boolean']) && (($useRegex && self::checkFieldNameRegex($field, 'boolean'))||(self::getFieldType($schema, $field) == 'boolean'))) {
            $messages['boolean'] = $fieldRulesI18nMessages['boolean'];
          }
          //Validation::cc (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['cc']) && ($useRegex && self::checkFieldNameRegex($field, 'cc'))) {
            $messages['cc'] = $fieldRulesI18nMessages['cc'];
          }
          //Validation::luhn (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['luhn']) && ($useRegex && self::checkFieldNameRegex($field, 'luhn'))) {
            $messages['luhn'] =  $fieldRulesI18nMessages['luhn'];
          }
          //Validation::comparison (staticmethod, in Data Validation) //'is greater', 'is less', 'greater or equal', 'less or equal', 'equal to', and 'not equal'
          if (isset($fieldRulesI18nMessages['comparison']) && (($useRegex && self::checkFieldNameRegex($field, 'comparison'))||((self::getFieldType($schema, $field) == 'integer'||self::getFieldType($schema, $field) == 'float') && !self::isNull($schema, $field) && !self::isKey($schema, $field)))) {
            $messages['comparison'] = $fieldRulesI18nMessages['comparison'];
          }
          //Validation::date (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['date']) && (($useRegex && self::checkFieldNameRegex($field, 'date'))||(self::getFieldType($schema, $field) == 'date'))) {
            $messages['date'] = $fieldRulesI18nMessages['date'];
          }
          //Validation::datetime (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['datetime']) && (($useRegex && self::checkFieldNameRegex($field, 'datetime'))||(self::getFieldType($schema, $field) == 'datetime'))) {
            $messages['datetime'] = $fieldRulesI18nMessages['datetime'];
          }
          //Validation::time (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['time']) && (($useRegex && self::checkFieldNameRegex($field, 'time'))||(self::getFieldType($schema, $field) == 'time'))) {
            $messages['time'] = $fieldRulesI18nMessages['time'];
          }
          //Validation::decimal (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['decimal']) && (($useRegex && self::checkFieldNameRegex($field, 'decimal'))||(self::getFieldType($schema, $field) == 'float' && self::hasDefault($schema, $field)))) {
            $default = self::getDefault($schema, $field);
            if ($default && strlen(substr(strrchr(strval($default), '.'), 1))) {
              $messages['decimal'] = $fieldRulesI18nMessages['decimal'];
            }
          }
          //Validation::email (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['email']) && ($useRegex && self::checkFieldNameRegex($field, 'email'))) {
            $messages['email'] = $fieldRulesI18nMessages['email'];
          }
          //Validation::equalTo (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['equalTo']) && ($useRegex && self::checkFieldNameRegex($field, 'equalTo'))) {
            $messages['equalTo'] = $fieldRulesI18nMessages['equalTo'];
          }
          //Validation::extension (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['extension']) && ($useRegex && self::checkFieldNameRegex($field, 'extension'))) {
            $messages['extension'] = $fieldRulesI18nMessages['extension'];
          }
          //Validation::ip (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['ip']) && ($useRegex && self::checkFieldNameRegex($field, 'ip'))) {
            $messages['ip'] = $fieldRulesI18nMessages['ip'];
          }
          //Validation::isUnique (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['isUnique']) && (($useRegex && self::checkFieldNameRegex($field, 'isUnique'))||(self::isKey($schema, $field) && self::getKeyType($schema, $field) == 'unique'))) {
            $messages['isUnique'] = $fieldRulesI18nMessages['isUnique'];
          }
          //Validation::minLength (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['minLength']) && (($useRegex && self::checkFieldNameRegex($field, 'minLength'))||((self::getFieldType($schema, $field) == 'text'||self::getFieldType($schema, $field) == 'string') && !self::isNull($schema, $field)))) {
            $messages['minLength'] = $fieldRulesI18nMessages['minLength'];
          }
          //Validation::maxLength (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['maxLength']) && (($useRegex && self::checkFieldNameRegex($field, 'maxLength'))||((self::getFieldType($schema, $field) == 'text'||self::getFieldType($schema, $field) == 'string') && self::hasLength($schema, $field)))) {
            $messages['maxLength'] = $fieldRulesI18nMessages['maxLength'];
            if (isset($messages['maxLength']['sprintf']) && isset($messages['maxLength']['sprintf']['max'])) {
              $messages['maxLength']['sprintf']['max'] = "'" . self::getFieldLength($schema, $field) . "'";
            }
          }
          //Validation::money (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['money']) && (($useRegex && self::checkFieldNameRegex($field, 'money'))||($useRegex && self::checkFieldNameRegex($field, 'money')))) {
            $messages['money'] = $fieldRulesI18nMessages['money'];
          }
          //Validation::multiple (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['multiple']) && (($useRegex && self::checkFieldNameRegex($field, 'multiple'))||($useRegex && self::checkFieldNameRegex($field, 'multiple')))) {
            $messages['multiple'] = $fieldRulesI18nMessages['multiple'];
          }
          //Validation::inList (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['inList']) && (($useRegex && self::checkFieldNameRegex($field, 'inList'))||(self::isEnum($schema, $field)))) {
            $enum = self::getEnumParsedValues($schema, $field);
            if (isset($enum) && is_array($enum) && count($enum)) {
              $messages['inList'] = $fieldRulesI18nMessages['inList'];
              if (isset($messages['inList']['message'])) {
                $messages['inList']['message'] = str_replace('%EnumValues%',implode(' or ',array_values($enum)), $messages['inList']['message']);
              }
            }
          }
          //Validation::numeric (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['numeric']) && (($useRegex && self::checkFieldNameRegex($field, 'numeric'))||(self::getFieldType($schema, $field) == 'integer'||self::getFieldType($schema, $field) == 'float'))) {
            $messages['numeric'] = $fieldRulesI18nMessages['numeric'];
          }
          //Validation::notEmpty (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['notEmpty']) && (($useRegex && self::checkFieldNameRegex($field, 'notEmpty'))||(!self::isNull($schema, $field)))) {
            $messages['notEmpty'] = $fieldRulesI18nMessages['notEmpty'];
          }
          //Validation::phone (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['phone']) && ($useRegex && self::checkFieldNameRegex($field, 'phone'))) {
            $messages['phone'] = $fieldRulesI18nMessages['phone'];
          }
          //Validation::postal (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['postal']) && ($useRegex && self::checkFieldNameRegex($field, 'postal'))) {
            $messages['postal'] = $fieldRulesI18nMessages['postal'];
          }
          //Validation::range (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['range']) && (($useRegex && self::checkFieldNameRegex($field, 'range'))||((self::getFieldType($schema, $field) == 'integer'||self::getFieldType($schema, $field) == 'float') && self::hasLength($schema, $field) && !self::isKey($schema, $field)))) {
            $messages['range'] = $fieldRulesI18nMessages['range'];
            if (isset($messages['range']['sprintf']) && isset($messages['range']['sprintf']['upper'])) {
              $messages['range']['sprintf']['upper'] = "'" . self::getFieldLength($schema, $field) . "'";
            }
          }
          //Validation::ssn (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['ssn']) && ($useRegex && self::checkFieldNameRegex($field, 'ssn'))) {
            $messages['ssn'] = $fieldRulesI18nMessages['ssn'];
          }
          //Validation::url (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['url']) && ($useRegex && self::checkFieldNameRegex($field, 'url'))) {
            $messages['url'] = $fieldRulesI18nMessages['url'];
          }
          //Validation::uuid (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['uuid']) && ($useRegex && self::checkFieldNameRegex($field, 'uuid'))) {
            $messages['uuid'] = $fieldRulesI18nMessages['uuid'];
          }
          //Validation::custom (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['custom']) && ($useRegex && self::checkFieldNameRegex($field, 'custom'))) {
            $messages['custom'] = $fieldRulesI18nMessages['custom'];
          }
          //Validation::userDefined (staticmethod, in Data Validation)
          if (isset($fieldRulesI18nMessages['userDefined']) && ($useRegex && self::checkFieldNameRegex($field, 'userDefined'))) {
            $messages['userDefined'] = $fieldRulesI18nMessages['userDefined'];
          }
          return $messages;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    public static function getRulesParsedI18nMessages($schema = null, $field = null) {
      if (self::isFieldInSchema($schema, $field)) {
        $messages = self::getRulesI18nMessages($schema, $field,self::$useFieldNameRegex);
        if (is_array($messages) && count($messages)) {
          $output = array();
          foreach ($messages as $rule => $message) {
            if (is_array($message) && isset($message['message'])) {
              if (isset($message['sprintf'])) {
                if (is_array($message['sprintf'])) {
                  $output[$rule] = "'" . $rule . "' => __('" . $message['message'] . "'," . implode(', ', $message['sprintf']) . ")";
                } else {
                  $output[$rule] = "'" . $rule . "' => __('" . $message['message'] . "'," . $message['sprintf'] . ")";
                }
              } else {
                $output[$rule] = "'" . $rule . "' => __('" . $message['message'] . "')";
              }
            } else {
              $output[$rule] = "'" . $rule . "' => __('" . $message . "')";
            }
          }

          return $output;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

  }
}
