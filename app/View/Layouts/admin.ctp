<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011,  Cake Software Foundation,  Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright         Copyright 2005-2011,  Cake Software Foundation,  Inc. (http://cakefoundation.org)
 * @link                    http://cakephp.org CakePHP(tm) Project
 * @package             cake
 * @subpackage        cake.cake.console.libs.templates.skel.views.layouts
 * @since                 CakePHP(tm) v 0.10.0.1076
 * @license             MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php
    header('Content-type: text/html;charset=UTF-8');
    echo $this->Html->docType('xhtml-strict');
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo '<head>';
        echo $this->Html->charset();
        echo '<title>';
            echo $title_for_layout;
        echo '</title>';
        echo $this->Html->meta('virtuoworks.favicon.png', 'img/virtuoworks/virtuoworks.favicon.png', array('type' => 'icon'));
        echo '<!--[if IE]>';
        echo $this->Html->meta('virtuoworks.favicon.ico', 'virtuoworks.favicon.ico', array('type' => 'icon'));
        echo '<![endif]-->';
        echo $this->Html->meta(array('name' => 'title',  'content' => $title_for_layout));
        echo $this->Html->meta(array('http-equiv' => 'Pragma',  'content' => 'cache'));
        echo $this->Html->meta(array('name' => 'robots',  'content' => 'index, follow'));
        echo $this->Html->meta('description', 'virtuoworks');
        echo $this->Html->meta('keywords', 'virtuoworks');
        echo $this->Html->meta(array('name' => 'author',  'content' => 'VirtuoWorks'));
        echo $this->Html->meta(array('name' => 'publisher',  'content' => 'VirtuoWorks'));
        echo $this->Html->meta(array('name' => 'copyright',  'content' => date('Y')));
        echo $this->Html->meta(array('name' => 'audience',  'content' => 'Private'));
        echo $this->Html->meta(array('name' => 'page-topic',  'content' => 'Administration'));
        echo $this->Html->meta(array('name' => 'creation_Date',  'content' => '10/02/2014'));
        echo $this->Html->meta(array('name' => 'revisit-after',  'content' => '2 days'));
        echo $this->Html->meta(array('name' => 'doc-rights',  'content' => 'Copywritten work'));
        echo $this->Html->meta(array('name' => 'doc-class',  'content' => 'Published'));
        echo $this->Html->meta(array('http-equiv' => 'content-Language',  'content' => 'fr'));
        echo $this->Html->meta(array('http-equiv' => 'Reply-to',  'content' => 'webmaster@virtuoworks.com'));
        //960gs
        echo $this->Html->css(array(
            'virtuoworks/reset', 
            'virtuoworks/text', 
            'virtuoworks/grid'
       ));
        //custom
        echo $this->Html->css(array(
            'virtuoworks/jquery-ui-1.8.17.custom', 
            'virtuoworks/layout', 
            'virtuoworks/nav'
       ));
        //for ie6 & ie7
        echo '<!--[if IE 6]>'.$this->Html->css('virtuoworks/ie6').'<![endif]-->';
        echo '<!--[if IE 7]>'.$this->Html->css('virtuoworks/ie').'<![endif]-->';
        if (Configure::read('debug')) {
            //echo $this->Html->css('virtuoworks.debug');
            //echo $this->Html->css('cake.generic');
        }
        echo $this->Html->script(array(
            'virtuoworks/jquery-1.7.1.min.js', 
            'virtuoworks/jquery-ui-1.8.17.custom.min.js', 
            'virtuoworks/jquery.validate-1.9.0.min.js', 
            'virtuoworks/jquery.validate-1.9.0.additional-methods.min.js', 
            'virtuoworks/jquery-fluid16.js'
       ));

        if (method_exists($this, 'fetch')) {
            echo $this->fetch('script');
        } else {
            echo $scripts_for_layout;
        }
    echo '</head>';
    echo '<body>';
        echo '<div id="container" class="container_16">';

            echo '<div id="header" class="grid_16">';
                echo '<p id="branding">';
                    echo $this->Html->link(__d('admin',  'VirtuoWorks : Website Administration'),  '/');
                echo '</p>';
            echo '</div>';

            echo '<div class="clear"></div>';

            echo '<div class="grid_16">';
                echo '<ul class="nav main">';
                    echo '<li>';
                        echo $this->Html->link(__d('admin',  'Home'), '/', array('escape' => false));
                    echo '</li>';
                    if ($user_id = $this->Session->read('Auth.User.id')) {
                        echo '<li>';
                            echo $this->Html->link(__d('admin',  '/'), array('controller' => 'Pages' , 'action' => 'home',  'admin' => true), array('escape' => false));
                        echo '</li>';
                        echo '<li>';
                            echo $this->Html->link(__d('admin',  'Logout'), array('controller' => 'users' , 'action' => 'logout',  'admin' => true), array('escape' => false));
                        echo '</li>';
                    }
                echo '</ul>';
            echo '</div>';

            echo '<div class="clear" style="height: 10px;width: 100%;"></div>';

            //flash message
            if (isset($this->Session) && is_object($this->Session) && $this->Session->check('Message.flash')) {
                echo '<div class="grid_16">';
                    echo '<div class="box system-message">';
                        echo '<div class="box-title">';
                            echo '<p>';
                                echo $this->Html->link(__d('admin',  'system message'), '#', array('id' => 'toggle-blockquote', 'escape' => false));
                            echo '</p>';
                        echo '</div>';
                        echo '<div id="blockquote" class="block">';
                            echo '<blockquote>';
                                echo $this->Session->flash();
                                echo '<p class="cite">';
                                    echo __d('admin',  'system');
                                echo '</p>';
                            echo '</blockquote>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

                echo '<div class="clear"></div>';
            }

            if (method_exists($this, 'fetch')) {
                echo $this->fetch('content');
            } else {
                echo $content_for_layout;
            }

            echo '<div class="clear"></div>';

            echo '<div id="footer" class="grid_16">';
                echo '<div class="box box-credits">';
                    echo '<p>';
                        echo __d('admin',  'Website made by ');
                        echo $this->Html->link(__d('admin',  'VirtuoWorks') . ' ' .
                                $this->Html->image('virtuoworks/15x15-logo-virtuoworks.png',  array(
                                    'title' =>    __d('admin',  'VirtuoWorks'), 
                                    'alt'=> __d('admin',  'VirtuoWorks'), 
                               )), 
                                'http://www.virtuoworks.com/', 
                                array('escape' => false)
                           );
                    echo '</p>';
                echo '</div>';
            echo '</div>';

            if (Configure::read('debug')) {

                if (get_class($this) == 'ScaffoldView') {

                    echo '<div class="clear"></div>';

                    echo $this->element('debug/scaffold_vars');
                }

                echo '<div class="clear"></div>';

                echo '<div id="cake-sql-log" class="grid_16">';
                    echo $this->element('debug/sql_dump');
                echo '</div>';
            }

        echo '</div>';
    echo '</body>';
echo '</html>';
?>