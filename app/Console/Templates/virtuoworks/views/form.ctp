<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

 /**
 * Available bake vars :
 * $modelClass, $schema, $primaryKey, $displayField, $singularVar, $pluralVar, $singularHumanName, $pluralHumanName, $fields, $associations, $action, $plugin
 */
?>
<?php
if (is_file(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'utilities'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'VirtuoWorksCakeBakeFormUtilities.php')) {
  require_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'utilities'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'VirtuoWorksCakeBakeFormUtilities.php');
}
echo "<?php";
$grid = 12;
if (strpos($action, 'add')  == = false) :
  $grid = 8;
echo "
  echo '<div class=\"grid_4\">';
    echo '<div class=\"box view-actions " . strtolower($singularVar) . "-view-actions\">';
      echo '<div class=\"box-title\">';
        echo '<p>';
          echo \$this->Html->link(__('{$singularHumanName} actions'), '#', array('id' => 'toggle-" . strtolower($singularVar) . "-actions', 'escape' => false));
        echo '</p>';
      echo '</div>';
      echo '<div id=\"" . strtolower($singularVar) . "-actions\" class=\"block\">';
        echo '<ul class=\"menu " . strtolower($singularVar) . "-actions-menu " . strtolower($singularVar) . "-actions-menu\">';
          echo '<li class=\"action " . strtolower($singularVar) . "-action " . strtolower($singularVar) . "-edit\">';
            echo \$this->Html->link('<span class=\"icon\"></span>'.__('View " . strtolower($singularHumanName) . "'), array('controller' => '{$pluralVar}', 'action' => 'view', \$this->Form->value('" . $modelClass . " . " . $primaryKey . "')), array('escape' => false));
          echo '</li>';
          echo '<li class=\"action " . strtolower($singularVar) . "-action " . strtolower($singularVar) . "-delete\">';
            echo \$this->Form->postLink('<span class=\"icon\"></span>'.__('Delete " . strtolower($singularHumanName) . "'), array('controller' => '{$pluralVar}', 'action' => 'delete', \$this->Form->value('" . $modelClass . " . " . $primaryKey . "')), array('escape' => false), __('Are you sure you want to delete this " . strtolower($singularHumanName) . "'));
          echo '</li>';
        echo '</ul>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
";
endif;
echo "
  echo '<div class=\"grid_{$grid}\">';
    echo '<div class=\"box " . strtolower($pluralVar) . " form " . strtolower($pluralVar) . "-form " . strtolower($pluralVar) . "-{$action}-form\">';
      echo '<div class=\"box-title\">';
        echo '<p>';
          echo \$this->Html->link(__('" . Inflector::humanize($action) . " " . strtolower($singularHumanName) . "'), '#', array('id' => 'toggle-" . strtolower($pluralVar) . "-{$action}-form', 'escape' => false));
        echo '</p>';
      echo '</div>';
      echo '<div id=\"" . strtolower($pluralVar) . "-{$action}-form\" class=\"block\">';
        echo \$this->Form->create('{$modelClass}',array('type' => 'post', 'url' => array('controller' => '{$pluralVar}', 'action' => '{$action}')));
          echo '<fieldset>';
            echo '<legend>';
              echo __('" . Inflector::humanize($action) . " " . strtolower($singularHumanName) . " form');
            echo '</legend>';
";
    foreach ($fields as $field) :
      if (strpos($action, 'add')  !==  false  &&  $field  ==  $primaryKey) {
        continue;
      } elseif (strpos($action, 'add')  !==  false  &&  isset($schema[$field])  &&  ((isset($schema[$field]['null']) &&  $schema[$field]['null'])||(isset($schema[$field]['default'])  &&  $schema[$field]['default'] !== '')) && (!isset($schema[$field]['key'])||$schema[$field]['key']!='unique')) {
        continue;
      } elseif (!in_array($field, array('created', 'modified', 'updated')) && !in_array($field,array(strtolower($singularVar).'_'.'created', strtolower($singularVar).'_'.'modified', strtolower($singularVar).'_'.'updated'))) {
        if (isset($schema) && isset($schema[$field]) && isset($schema[$field]['type'])) {
          echo "\t\t\t\t\t\t//input field for {$modelClass}.{$field}\n";
          echo "\t\t\t\t\t\t\$options = array(\n";
          if (class_exists('VirtuoWorksCakeBakeFormUtilities')) {
            $enum = VirtuoWorksCakeBakeFormUtilities::getEnumParsedValues($schema, $field);
          }
          if (isset($enum) && is_array($enum) && count($enum)>0) {
            //select(string $fieldName, array $options, mixed $selected, array $attributes)
            echo "\t\t\t\t\t\t\t'type' => 'select',\n";
            if (isset($schema[$field]['default'])) :
              echo "\t\t\t\t\t\t\t'default' => '" . $schema[$field]['default'] . "',\n";
            endif;
            echo "\t\t\t\t\t\t\t'options' => array(\n";
            foreach ($enum as $key => $value) :
              echo "\t\t\t\t\t\t\t\t'{$key}' => __('{$value}'),\n";
            endforeach;
            echo "\t\t\t\t\t\t\t),\n";
            if (isset($schema[$field]['null']) && $schema[$field]['null']) {
              echo "\t\t\t\t\t\t\t'empty' => true,\n";
            } else {
              echo "\t\t\t\t\t\t\t'empty' => false,\n";
            }
            echo "\t\t\t\t\t\t\t'class' => 'select-tag form-select-tag " . strtolower($pluralVar) . "-{$action}-form-select-tag',\n";
          } else {
            switch($schema[$field]['type']) {
              case 'string':
                if (isset($schema[$field]['length']) && $schema[$field]['length']>=2048) {
                  echo "\t\t\t\t\t\t\t'type' => 'textarea',\n";
                  if (isset($schema[$field]['null']) && $schema[$field]['null']) :
                    echo "\t\t\t\t\t\t\t'default' => null,\n";
                  endif;
                  echo "\t\t\t\t\t\t\t'class' => 'text-tag form-text-tag" . strtolower($pluralVar) . "-{$action}-form-text-tag',\n";
                } else {
                  echo "\t\t\t\t\t\t\t'type' => 'text',\n";
                  if (isset($schema[$field]['null']) && $schema[$field]['null']) :
                    echo "\t\t\t\t\t\t\t'default' => null,\n";
                  endif;
                  if (isset($schema[$field]['length'])) :
                    echo "\t\t\t\t\t\t\t'maxlength' => " . $schema[$field]['length'] . ",\n";
                  endif;
                  echo "\t\t\t\t\t\t\t'class' => 'text-tag form-text-tag " . strtolower($pluralVar) . "-{$action}-form-text-tag',\n";
                }
              break;
              case 'date':
                echo "\t\t\t\t\t\t\t'type' => 'date',\n";
                echo "\t\t\t\t\t\t\t'minYear' => date('Y')-100,\n";
                echo "\t\t\t\t\t\t\t'maxYear' => date('Y')+20,\n";
                echo "\t\t\t\t\t\t\t'dateFormat' => 'DMY',\n";
                echo "\t\t\t\t\t\t\t'monthNames' => true,\n";
                echo "\t\t\t\t\t\t\t'separator' => '/',\n";
                if (isset($schema[$field]['default']) && !empty($schema[$field]['default'])) {
                  echo "\t\t\t\t\t\t\t'default' => '" . $schema[$field]['default'] . "',\n";
                } else {
                  if (isset($schema[$field]['null']) && $schema[$field]['null']) {
                    echo "\t\t\t\t\t\t\t'default' => null,\n";
                  } else {
                    echo "\t\t\t\t\t\t\t'default' => strftime('%Y-%m-%d'),\n";
                  }
                }
                echo "\t\t\t\t\t\t\t'class' => 'date-tag form-date-tag " . strtolower($pluralVar) . "-{$action}-form-date-tag',\n";
              break;
              case 'time':
                echo"\t\t\t\t\t\t\t'type' => 'time',\n";
                echo"\t\t\t\t\t\t\t'timeFormat' => 24,\n";
                echo"\t\t\t\t\t\t\t'separator' => '/',\n";
                if (isset($schema[$field]['default']) && !empty($schema[$field]['default'])) {
                  echo "\t\t\t\t\t\t\t'default' => '" . $schema[$field]['default'] . "',\n";
                } else {
                  if (isset($schema[$field]['null']) && $schema[$field]['null']) {
                    echo "\t\t\t\t\t\t\t'default' => null,\n";
                  } else {
                    echo "\t\t\t\t\t\t\t'default' => strftime('%H:%i:%s'),\n";
                  }
                }
                echo "\t\t\t\t\t\t\t'class' => 'time-tag form-time-tag " . strtolower($pluralVar) . "-{$action}-form-time-tag',\n";
              break;
              case 'datetime':
                echo "\t\t\t\t\t\t\t'type' => 'datetime',\n";
                echo "\t\t\t\t\t\t\t'minYear' => date('Y')-100,\n";
                echo "\t\t\t\t\t\t\t'maxYear' => date('Y')+20,\n";
                echo "\t\t\t\t\t\t\t'dateFormat' => 'DMY',\n";
                echo "\t\t\t\t\t\t\t'timeFormat' => 24,\n";
                echo "\t\t\t\t\t\t\t'monthNames' => true,\n";
                echo "\t\t\t\t\t\t\t'separator' => '/',";
                if (isset($schema[$field]['default']) && !empty($schema[$field]['default'])) {
                  echo "\t\t\t\t\t\t\t'default' => '" . $schema[$field]['default'] . "',\n";
                } else {
                  if (isset($schema[$field]['null']) && $schema[$field]['null']) {
                    echo "\t\t\t\t\t\t\t'default' => null,\n";
                  } else {
                    echo "\t\t\t\t\t\t\t'default' => strftime('%Y-%m-%d %H:%i:%s'),\n";
                  }
                }
                echo "\t\t\t\t\t\t\t'class' => 'datetime-tag form-datetime-tag " . strtolower($pluralVar) . "-{$action}-form-datetime-tag',\n";
              break;
              default:
                echo "\t\t\t\t\t\t\t'class' => 'input-tag form-input-tag " . strtolower($pluralVar) . "-{$action}-form-input-tag',\n";
            }
          }
          echo "\t\t\t\t\t\t\t'error' => array(\n";
            echo "\t\t\t\t\t\t\t\t'attributes' => array(\n";
            echo "\t\t\t\t\t\t\t\t\t'wrap' => 'label',\n";
            echo "\t\t\t\t\t\t\t\t\t'class' => 'error-message',\n";
            echo "\t\t\t\t\t\t\t\t\t'for' => \$this->Html->domId('{$modelClass}.{$field}', 'for'),\n";
            echo "\t\t\t\t\t\t\t\t),\n";
            if (class_exists('VirtuoWorksCakeBakeFormUtilities')) {
              $rules = VirtuoWorksCakeBakeFormUtilities::getRulesParsedI18nMessages($schema, $field);
            }
            if (isset($rules) && is_array($rules) && count($rules)) :
              echo "\t\t\t\t\t\t\t\t";
              echo implode(",\n\t\t\t\t\t\t\t\t", $rules);
              echo "\n";
            endif;
          echo "\t\t\t\t\t\t\t)\n";
          echo "\t\t\t\t\t\t);\n";
          echo "\t\t\t\t\t\techo \$this->Form->input('{$modelClass}.{$field}',\$options);\n";
          echo "\t\t\t\t\t\tunset(\$options);\n\n";
        } else {
          echo "\t\t\t\t\t\t//input field for {$modelClass}.{$field}\n";
          echo "\t\t\t\t\t\t\$options = array(\n";
            echo "\t\t\t\t\t\t\t'class' => 'input-tag form-input-tag " . strtolower($pluralVar) . "-{$action}-form-input-tag'\n";
          echo "\t\t\t\t\t\t);\n";
          echo "\t\t\t\t\t\techo \$this->Form->input('{$modelClass}.{$field}',\$options);\n";
          echo "\t\t\t\t\t\tunset(\$options);\n\n";
        }
      }
    endforeach;
    if (strpos($action, 'add')  == = false  &&  !empty($associations['hasAndBelongsToMany'])) :
      foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) :
        echo "\t\t\t\t\t\t//input field for {$assocName}\n";
        echo "\t\t\t\t\t\t\$options = array(\n";
          echo "\t\t\t\t\t\t\t'class' => 'input-tag form-input-tag " . strtolower($pluralVar) . "-{$action}-form-input-tag" . strtolower($pluralVar) . "-{$action}-form-" . strtolower($assocName) . "-input-tag',\n";
        echo "\t\t\t\t\t\t);\n";
        echo "\t\t\t\t\t\techo \$this->Form->input('{$assocName}',\$options);\n";
        echo "\t\t\t\t\t\tunset(\$options);\n\n";
      endforeach;
    endif;
echo "
          echo '</fieldset>';";
    if ($action  ==  'add') {
echo "
        echo \$this->Form->end(__('Create " . strtolower($singularHumanName) . "'));";
    } else {
      if ($action  ==  'edit') {
echo "
        echo \$this->Form->end(__('Save " . strtolower($singularHumanName) . "'));";
      } else {
echo "
        echo \$this->Form->end(__('Submit'));";
      }
    }
echo "
      echo '</div>';
    echo '</div>';
  echo '</div>';

  echo '<div class=\"grid_4\">';
    echo '<div class=\"box actions menu actions-menu\">';
      echo '<div class=\"box-title\">';
        echo '<p>';
          echo \$this->Html->link(__('Main Actions'), '#', array('id' => 'toggle-section-menu', 'escape' => false));
        echo '</p>';
      echo '</div>';
      echo '<div id=\"section-menu\" class=\"block\">';
        echo '<ul class=\"section menu actions-section-menu\">';

          echo '<li class=\"" . strtolower($pluralVar) . "-actions\">';
            echo \$this->Html->link('<span class=\"icon\"></span>'.__('" . $pluralHumanName . " actions'), '#', array('class' => 'menuitem', 'escape' => false));
            echo '<ul class=\"submenu " . strtolower($pluralVar) . "-actions-submenu\">';
              echo '<li class=\"action " . strtolower($pluralVar) . "-action " . strtolower($pluralVar) . "-index\">';
                echo \$this->Html->link('<span class=\"icon\"></span>'.__('List " . strtolower($pluralHumanName) . "'), array('controller' => '{$pluralVar}', 'action' => 'index'), array('escape' => false));
              echo '</li>';
              echo '<li class=\"action " . strtolower($pluralVar) . "-action " . strtolower($pluralVar) . "-add\">';
                echo \$this->Html->link('<span class=\"icon\"></span>'.__('New " . strtolower($singularHumanName) . "'), array('controller' => '{$pluralVar}', 'action' => 'add'), array('escape' => false));
              echo '</li>';
            echo '</ul>';
          echo '</li>';
";
        $done = array();
        foreach ($associations as $_type => $_data) :
          foreach ($_data as $_alias => $_details) :
            if ($_details['controller'] != $pluralVar  &&  !in_array($_details['controller'], $done)) :
echo "
          echo '<li class=\"" . strtolower($_details['controller']) . "-actions\">';
            echo \$this->Html->link('<span class=\"icon\"></span>'.__('" . Inflector::humanize($_details['controller']) . " actions'), '#', array('class' => 'menuitem', 'escape' => false));
            echo '<ul class=\"submenu " . strtolower($_details['controller']) . "-actions-submenu\">';
              echo '<li class=\"action " . strtolower($_details['controller']) . "-action " . strtolower($_details['controller']) . "-index\">';
                echo \$this->Html->link('<span class=\"icon\"></span>'.__('List " . strtolower(Inflector::humanize($_details['controller'])) . "'), array('controller' => '" . $_details['controller'] . "', 'action' => 'index'), array('escape' => false));
              echo '</li>';
              echo '<li class=\"action " . strtolower($_details['controller']) . "-action " . $_details['controller'] . "-add\">';
                echo \$this->Html->link('<span class=\"icon\"></span>'.__('New " . strtolower(Inflector::humanize(Inflector::underscore($_alias))) . "'), array('controller' => '" . $_details['controller'] . "', 'action' => 'add'), array('escape' => false));
              echo '</li>';
            echo '</ul>';
          echo '</li>';
";
              $done[] = $_details['controller'];
            endif;
          endforeach;
        endforeach;
echo "
      echo '</ul>';
    echo '</div>';
  echo '</div>';
?>
";
?>