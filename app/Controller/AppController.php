<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @link                    http://cakephp.org CakePHP(tm) Project
 * @package             app.Controller
 * @since                 CakePHP(tm) v 0.2.9
 * @license             MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller',  'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below,  your controllers
 * will inherit them.
 *
 * @package             app.Controller
 */
class AppController extends Controller {

    var $components = array('Session',  'Cookie',  'Auth');

    function beforeFilter() {
        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
            $lang = strtolower($this->Cookie->read('lang'));
            if (isset($this->params['language']) && (strtolower($this->params['language'])!=$lang)) {
                $lang = strtolower($this->params['language']);
                if (isset($lang) && in_array($lang, array('fre', 'eng'))) {
                    $this->Session->write('Config.language',  $lang);
                    $this->Cookie->write('lang',  $lang,  null,  '20 days');
                    Configure::write('Config.language',  $lang);
                }
            } else {
                $lang = strtolower($this->Cookie->read('lang'));
                if (isset($lang) && in_array($lang, array('fre', 'eng'))) {
                    $this->Session->write('Config.language',  $lang);
                    Configure::write('Config.language',  $lang);
                }
            }
        } else {
            if (isset($this->params['language']) && (strtolower($this->params['language'])!=$this->Session->read('Config.language'))) {
                $lang = strtolower($this->params['language']);
                if (isset($lang) && in_array($lang, array('fre', 'eng'))) {
                    $this->Session->write('Config.language',  $lang);
                    $this->Cookie->write('lang',  $lang,  null,  '20 days');
                    Configure::write('Config.language',  $lang);
                }
            }
        }
        $locale = Configure::read('Config.language');
        if ($this->Session->check('Config.language')) {
            $locale = $this->Session->read('Config.language');
        }
        $this->params['locale'] = $locale;

        if (isset($this->Auth)) {

            $this->Auth->autoRedirect = false;
            $this->Auth->authError =    __('Username or password is incorrect.');
            $this->Auth->loginAction = array('controller' => 'users',  'action' => 'login',  'admin' => true);
            $this->Auth->loginRedirect = array('controller' => 'rules',  'action' => 'index',  'admin' => true);
            $this->Auth->logoutRedirect = array('controller' => 'users',  'action' => 'login',  'admin' => true);

            $this->Auth->authenticate = array(
                'Form' => array(
                    'userModel' => 'User', 
                    'fields' => array(
                        'username' => 'username', 
                        'password' => 'password'
                   ), 
                    'scope' => array(
                        'is_valid_user' => true
                   ), 
                    'passwordHasher' => 'Blowfish', 
                    'realm' => __('VirtuoWorks Software Development Kit Administration System')
               )
           );

            if (isset($this->params['prefix'])  &&  in_array($this->params['prefix'], Configure::read('Routing.prefixes'))) {
                if ($this->Auth->loggedIn()) {
                    $this->Auth->allow();
                } else {
                    if ($this->request->is('post')) {
                        if ($this->Auth->login()) {
                            $this->Session->setFlash(__('You have successfully logged in.'),  'default',  array('class' => 'message'));
                            $this->redirect($this->Auth->loginRedirect);
                            exit();
                        } else {
                            $this->Session->setFlash(__('Username or password is incorrect.'),  'default',  array('class' => 'error'));
                        }
                    }
                }
            } else {
                $this->Auth->deny();
            }
        }
        if (isset($this->params['prefix'])  &&  in_array($this->params['prefix'], Configure::read('Routing.prefixes'))) {
            $this->layout = $this->params['prefix'];
            $this->set('title_for_layout',  __('VirtuoWorks Software Development Kit Administration System'));
        } else {
            $this->set('title_for_layout',  __('VirtuoWorks App'));
        }
    }

    function registerIpAddressAccess() {
        if (in_array('BlacklistedIp',  App::objects('Model'))) {
            if (!isset($this->BlacklistedIp) || !is_object($this->BlacklistedIp)) {
                App::uses('BlacklistedIp',  'Model');
                $this->BlacklistedIp = new BlacklistedIp();
            }
            $blacklisted_ip = $this->BlacklistedIp->find('first', array(
                'conditions' => array(
                    'BlacklistedIp.ip_address' => $_SERVER['REMOTE_ADDR']
               ), 
                'recursive' => -1
           ));
            if (empty($blacklisted_ip)) {
                $blacklisted_ip = array(
                    'BlacklistedIp' => array(
                        'ip_address' => $_SERVER['REMOTE_ADDR'], 
                        'ip_access_count' => 1, 
                        'is_blacklisted_ip_address' => false, 
                   ), 
               );
                $this->BlacklistedIp->create();
            } else {
                $blacklisted_ip['BlacklistedIp']['ip_access_count'] = $blacklisted_ip['BlacklistedIp']['ip_access_count'] + 1;
            }
            $this->BlacklistedIp->save($blacklisted_ip);
        }
    }

    function getIpAddressAccessCount() {
        if (in_array('BlacklistedIp',  App::objects('Model'))) {
            if (!isset($this->BlacklistedIp) || !is_object($this->BlacklistedIp)) {
                App::uses('BlacklistedIp',  'Model');
                $this->BlacklistedIp = new BlacklistedIp();
            }
            $blacklisted_ip = $this->BlacklistedIp->find('first', array(
                'conditions' => array(
                    'BlacklistedIp.ip_address' => $_SERVER['REMOTE_ADDR']
               ), 
                'recursive' => -1
           ));
            if (empty($blacklisted_ip)) {
                return false;
            } else {
                return $blacklisted_ip['BlacklistedIp']['ip_access_count'];
            }
        }
    }

    function beforeRender() {
        $locale = Configure::read('Config.language');
        if ($this->Session->check('Config.language')) {
            $locale = $this->Session->read('Config.language');
        }
        $this->set('locale', $locale);
    }

}
