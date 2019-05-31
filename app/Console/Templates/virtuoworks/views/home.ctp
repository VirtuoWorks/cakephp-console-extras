<?php
$output = "
echo '<div class=\"grid_16\">';

  echo '<div class=\"box pages home pages-home pages-home-box\">';

    echo '<div class=\"block\">';
      echo '<h1>';
        echo __d('cake_dev', 'Sweet, \"" . Inflector::humanize($app) . "\" got Baked by CakePHP with VirtuoWorks SDK for CakePHP 2.0.1!');
      echo '</h1>';
    echo '</div>';

  echo '</div>';

echo '</div>';

App::uses('Debugger', 'Utility');
if (Configure::read('debug') > 0) :
  Debugger::checkSecurityKeys();
endif;

echo '<div class=\"grid_4\">';

  echo '<div class=\"box pages home pages-home pages-home-box\">';

    echo '<div class=\"box-title\">';
      echo '<p>';
        echo \$this->Html->link(__d('cake_dev', 'PHP version'), '#', array('id' => 'toggle-section-menu', 'escape' => false));
      echo '</p>';
    echo '</div>';

    echo '<div class=\"block\">';
      echo '<p>';
        if (version_compare(PHP_VERSION, '5.2.8', '>=')) :
          echo '<span class=\"notice success\">';
            echo __d('cake_dev', 'Your version of PHP is 5.2.8 or higher.');
          echo '</span>';
        else :
          echo '<span class=\"notice\">';
            echo __d('cake_dev', 'Your version of PHP is too low. You need PHP 5.2.8 or higher to use CakePHP.');
          echo '</span>';
        endif;
      echo '</p>';
    echo '</div>';

  echo '</div>';

echo '</div>';
echo '<div class=\"grid_4\">';

  echo '<div class=\"box pages home pages-home pages-home-box\">';

    echo '<div class=\"box-title\">';
      echo '<p>';
        echo \$this->Html->link(__d('cake_dev', 'TMP directory permissions and cache settings'), '#', array('id' => 'toggle-section-menu', 'escape' => false));
      echo '</p>';
    echo '</div>';

    echo '<div class=\"block\">';
      echo '<p>';
        if (is_writable(TMP)) :
          echo '<span class=\"notice success\">';
            echo __d('cake_dev', 'Your tmp directory is writable.');
          echo '</span>';
        else :
          echo '<span class=\"notice\">';
            echo __d('cake_dev', 'Your tmp directory is NOT writable.');
          echo '</span>';
        endif;
      echo '</p>';
    echo '</div>';

    echo '<div class=\"block\">';
      echo '<p>';
        \$settings = Cache::settings();
        if (!empty(\$settings)) :
          echo '<span class=\"notice success\">';
              echo __d('cake_dev', 'The %s is being used for caching. To change the config edit APP/Config/core.php ', '<em>'. \$settings['engine'] . 'Engine</em>');
          echo '</span>';
        else :
          echo '<span class=\"notice\">';
            echo __d('cake_dev', 'Your cache is NOT working. Please check the settings in APP/Config/core.php');
          echo '</span>';
        endif;
      echo '</p>';
    echo '</div>';

  echo '</div>';

echo '</div>';
echo '<div class=\"grid_4\">';

  echo '<div class=\"box pages home pages-home pages-home-box\">';

      echo '<div class=\"box-title\">';
        echo '<p>';
          echo \$this->Html->link(__d('cake_dev', 'Database configuration'), '#', array('id' => 'toggle-section-menu', 'escape' => false));
        echo '</p>';
      echo '</div>';

      echo '<div class=\"block\">';
        echo '<p>';
          \$filePresent = null;
          if (file_exists(APP . 'Config' . DS . 'database.php')) :
            echo '<span class=\"notice success\">';
              echo __d('cake_dev', 'Your database configuration file is present.');
              \$filePresent = true;
            echo '</span>';
          else :
            echo '<span class=\"notice\">';
              echo __d('cake_dev', 'Your database configuration file is NOT present.');
              echo '<br/>';
              echo __d('cake_dev', 'Rename APP/Config/database.php.default to APP/Config/database.php');
            echo '</span>';
          endif;
        echo '</p>';
      echo '</div>';

      echo '<div class=\"block\">';
        echo '<p>';
          if (isset(\$filePresent)) :
            App::uses('ConnectionManager', 'Model');
            try {
              \$connected = ConnectionManager::getDataSource('default');
            } catch (Exception \$e) {
              \$connected = false;
            }
            if (\$connected  &&  \$connected->isConnected()) :
              echo '<span class=\"notice success\">';
                echo __d('cake_dev', 'Cake is able to connect to the database.');
              echo '</span>';
            else :
              echo '<span class=\"notice\">';
                echo __d('cake_dev', 'Cake is NOT able to connect to the database.');
              echo '</span>';
            endif;
          endif;
        echo '</p>';
      echo '</div>';

    echo '</div>';

echo '</div>';
echo '<div class=\"grid_4\">';

    echo '<div class=\"box pages home pages-home pages-home-box\">';

      echo '<div class=\"box-title\">';
        echo '<p>';
          echo \$this->Html->link(__('Unicode support'), '#', array('id' => 'toggle-section-menu', 'escape' => false));
        echo '</p>';
      echo '</div>';

      echo '<div class=\"block\">';
        echo '<p>';
          App::uses('Validation', 'Utility');
          if (!Validation::alphaNumeric('cakephp')) {
            echo '<p><span class=\"notice\">';
            __d('cake_dev', 'PCRE has not been compiled with Unicode support.');
            echo '<br/>';
            __d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
            echo '</span></p>';
          } else {
            echo '<p><span class=\"notice success\">';
            echo __d('cake_dev', 'PCRE has been compiled with Unicode support.');
            echo '</span></p>';
          }
        echo '</p>';
      echo '</div>';

    echo '</div>';

echo '</div>';

echo '<div class=\"grid_16\">';

  echo '<div class=\"box pages home pages-home pages-home-box\">';

    echo '<div class=\"box-title\">';
      echo '<p>';
        echo \$this->Html->link(__d('cake_dev', 'Editing this Page'), '#', array('id' => 'toggle-section-menu', 'escape' => false));
      echo '</p>';
    echo '</div>';

    echo '<div class=\"block\">';
      echo '<p>';
      echo __d('cake_dev', 'To change the content of this page, edit: %s 
        To change its layout, edit: %s 
        You can also add some CSS styles for your pages at: %s', 
        APP . 'View' . DS . 'Pages' . DS . 'home.ctp.<br />',  APP . 'View' . DS . 'Layouts' . DS . 'default.ctp.<br />', APP . 'webroot' . DS . 'css');
      echo '</p>';
    echo '</div>';

  echo '</div>';

echo '</div>';
";
?>