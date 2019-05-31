<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011,  Cake Software Foundation,  Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright         Copyright 2005-2011,  Cake Software Foundation,  Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Model',  'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below,  your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

  public function equalToField($check = array(),  $field = null) {
    if (isset($this->data[$this->name])  &&  is_array($this->data[$this->name])  &&  array_key_exists($field,  $this->data[$this->name])) {
      foreach ($check as $key => $value) {
        if ($value  !==  $this->data[$this->name][$field]) {
          return false;
        } else {
          continue;
        } 
      }
      return true;
    } else {
      return false;
    }
  }

  public function inferiorOrEqualToField($check = array(),  $field = null) {
    if (isset($this->data[$this->name])  &&  is_array($this->data[$this->name])  &&  array_key_exists($field,  $this->data[$this->name])) {
      foreach ($check as $key => $value) {
        if (is_numeric($value)  &&  is_numeric($this->data[$this->name][$field])) {
          if ($value > $this->data[$this->name][$field]) {
            return false;
          } else {
            continue;
          }
        }
      }
      return true;
    } else {
      return false;
    }
  }

  public function equalFieldDiff($check = array(),  $firstfield = null,  $secondfield = null) {
    if (isset($this->data[$this->name])  &&  is_array($this->data[$this->name])  &&  array_key_exists($firstfield,  $this->data[$this->name])) {
      if (isset($this->data[$this->name])  &&  is_array($this->data[$this->name])  &&  array_key_exists($secondfield,  $this->data[$this->name])) {
        if (is_numeric($this->data[$this->name][$firstfield])  &&  is_numeric($this->data[$this->name][$secondfield])) {
          foreach ($check as $key => $value) {
            if (is_numeric($value)) {
              if (intval($value)  !==  (intval($this->data[$this->name][$firstfield]) - intval($this->data[$this->name][$secondfield]))) {
                return false;
              } else {
                continue;
              }
            } else {
              return false;
            }
          }
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

  public function isNotBlacklistedIp($check = array()) {
    if (is_array($check)  &&  count($check)) {
      $check = current($check);
      if (empty($check)) {
        return true;
      } else {
        if (in_array('BlacklistedIp',  App::objects('Model'))) {
          if (!isset($this->BlacklistedIp) || !is_object($this->BlacklistedIp)) {
            App::uses('BlacklistedIp',  'Model');
            $this->BlacklistedIp = new BlacklistedIp();
          }
          $blacklisted_ip = $this->BlacklistedIp->find('first', array(
            'conditions' => array(
              'BlacklistedIp.ip_address' => $check, 
              'BlacklistedIp.is_blacklisted_ip_address' => true
           ), 
            'recursive' => -1
         ));
          if (empty($blacklisted_ip)) {
            return true;
          } else {
            return false;
          }
        } else {
          return true;
        }
      }
    } else {
      return true;
    }
  }

  public function isNotBlacklistedMail($check = array()) {
    if (is_array($check)  &&  count($check)) {
      $check = current($check);
      if (empty($check)) {
        return true;
      } else {
        if (in_array('BlacklistedMail',  App::objects('Model'))) {
          if (!isset($this->BlacklistedMail) || !is_object($this->BlacklistedMail)) {
            App::uses('BlacklistedMail',  'Model');
            $this->BlacklistedMail = new BlacklistedMail();
          }
          $blacklisted_mail = $this->BlacklistedMail->find('first', array(
            'conditions' => array(
              'BlacklistedMail.mail_account' => $check, 
              'BlacklistedMail.is_blacklisted_mail_account' => true
           ), 
            'recursive' => -1
         ));
          if (empty($blacklisted_mail)) {
            return true;
          } else {
            return false;
          }
        } else {
          return true;
        }
      }
    } else {
      return true;
    }
  }

  public function isNotBlacklistedProvider($check = array()) {
    if (is_array($check)  &&  count($check)) {
      $check = current($check);
      if (empty($check)) {
        return true;
      } else {
        $pos = strripos($check, '@');
        if ($pos  == = false) {
          return true;
        } else {
          $check = substr($check,  $pos + 1);
          if (strlen($check)<1||strlen($check)>255) {
            return true;
          } else {
            if (in_array('BlacklistedProvider', App::objects('Model'))) {
              if (!isset($this->BlacklistedProvider) || !is_object($this->BlacklistedProvider)) {
                App::uses('BlacklistedProvider', 'Model');
                $this->BlacklistedProvider = new BlacklistedProvider();
              }
              $blacklisted_provider = $this->BlacklistedProvider->find('first', array(
                'conditions' => array(
                  'BlacklistedProvider.provider_host' => $check,
                  'BlacklistedProvider.is_blacklisted_host' => true
               ),
                'recursive' => -1
             ));
              if (empty($blacklisted_provider)) {
                return true;
              } else {
                return false;
              }
            } else {
              return true;
            }
          }
        }
      }
    } else {
      return true;
    }
  }
}
