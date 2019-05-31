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
 * @copyright     Copyright 2005-2011,  Cake Software Foundation,  Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

 /**
 * Available bake vars :
 * $modelClass,  $schema,  $primaryKey,  $displayField,  $singularVar,  $pluralVar,  $singularHumanName,  $pluralHumanName,  $fields,  $associations,  $action,  $plugin
 */
?>
<?php
if (empty($associations['hasMany'])) {
  $associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
  $associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'],  $associations['hasAndBelongsToMany']);
$grid = 12;
if (!empty($relations)) {
  $grid = 4;
}
echo "<?php
echo '<div class=\"grid_{$grid}\">';
  echo '<div class=\"box " . strtolower($pluralVar) . " view " . strtolower($pluralVar) . "-view\">';
    echo '<div class=\"box-title\">';
      echo '<p>';
        echo \$this->Html->link(__('View {$singularHumanName}'),  '#',  array('id' => 'toggle-" . strtolower($pluralVar) . "-view', 'escape' => false));
      echo '</p>';
    echo '</div>';
    echo '<div id=\"" . strtolower($pluralVar) . "-view\" class=\"block\">';
      if (isset(\${$singularVar}) && is_array(\${$singularVar}) && isset(\${$singularVar}['{$modelClass}']) && is_array(\${$singularVar}['{$modelClass}']) && count(array_filter(\${$singularVar}['{$modelClass}']))) {
";
      foreach ($fields as $_field) :
echo "
        if (isset(\${$singularVar}['{$modelClass}']) && isset(\${$singularVar}['{$modelClass}']['" . $_field . "'])) {
          echo '<p>';
            echo '<span class=\"data-title\">';
              echo __('" . Inflector::humanize($_field) . "');
              echo '&nbsp;:&nbsp;';
            echo '</span>';";
          $isKey = false;
          if (!empty($associations['belongsTo'])) :
            foreach ($associations['belongsTo'] as $_alias => $_details) {
              if ($_field  == = $_details['foreignKey']) {
                $isKey = true;
echo "
            if (isset(\${$singularVar}['" . $_alias . "']) && isset(\${$singularVar}['" . $_alias . "']['" . $_details['displayField'] . "'])) {
              echo \$this->Html->link(h(\${$singularVar}['" . $_alias . "']['" . $_details['displayField'] . "'], 'UTF-8'),  array('controller' => '" . $_details['controller'] . "',  'action' => 'view',  \${$singularVar}['" . $_alias . "']['" . $_details['primaryKey'] . "'],  str_replace('_', '-', Inflector::slug(strtolower(\${$singularVar}['" . $_alias . "']['" . $_details['displayField'] . "'])))),  array('escape' => false));
            } else {
              echo \$this->Html->link(h(\${$singularVar}['{$modelClass}']['" . $_field . "'], 'UTF-8'),  array('controller' => '" . $_details['controller'] . "',  'action' => 'view',  \${$singularVar}['{$modelClass}']['" . $_field . "']),  array('escape' => false));
            }";
                break;
              }
            }
          endif;
          if ($isKey  !==  true) :
            if (isset($schema) && isset($schema[$_field]) && $schema[$_field]['type'] == 'boolean') {
echo "
            if (\${$singularVar}['" . $modelClass . "']['" . $_field . "']) {
              echo __('Yes');
            } else {
              echo __('No');
            }";
            }elseif (isset($schema) && isset($schema[$_field]) && isset($schema[$_field]['type']) && preg_match('#^(enum\()((\'[a-zA-Z0-9]+((\'\))|(\',)))+)$#', $schema[$_field]['type'])) {
              $matches = array();
              if (preg_match_all('#\'[a-zA-Z0-9]+\'#', $schema[$_field]['type'], $matches)) {
                if (isset($matches[0]) && is_array($matches[0]) && count($matches[0])) {
                  $forDisplay = array();
                  foreach ($matches[0] as $value) {
                    $value = trim($value, "'");
                    switch($value) {
                      case 'M':
                        $forDisplay[$value] = 'Male';
                      break;
                      case 'F':
                        $forDisplay[$value] = 'Female';
                      break;
                      case 'Y':
                        $forDisplay[$value] = 'Yes';
                      break;
                      case 'N':
                        $forDisplay[$value] = 'No';
                      break;
                      case 'R':
                        $forDisplay[$value] = 'Requested';
                      break;
                      case 'W':
                        $forDisplay[$value] = 'Waiting';
                      break;
                      case 'B':
                        $forDisplay[$value] = 'Blocked';
                      break;
                      case 'NA':
                        $forDisplay[$value] = 'Unspecified';
                      break;
                      default:
                        if (is_string($value)) {
                          $forDisplay[$value] = ucwords(strtolower($value));
                        } else {
                          $forDisplay[$value] = $value;
                        }
                    }
                  }
echo "
            switch(\${$singularVar}['{$modelClass}']['" . $_field . "']) {";
                  foreach ($forDisplay as $key => $value) :
                    $value = trim($value, "'");
echo "
              case " . ((is_string($key)) ? "'" . $key . "'" : $key) . ":
                echo __('" . $value . "');
              break;";
                  endforeach;
                  unset($forDisplay);
echo "
              default:
                echo h(\${$singularVar}['{$modelClass}']['" . $_field . "'], 'UTF-8');";
echo "
            }";
                } else {
echo "
            echo h(\${$singularVar}['{$modelClass}']['" . $_field . "'], 'UTF-8');";
                }
              } else {
echo "
              echo h(\${$singularVar}['{$modelClass}']['" . $_field . "'], 'UTF-8');";
              }
            } else {
              if (isset($primaryKey) && isset($displayField) && $displayField  == = $_field) {
echo "
            if (isset(\${$singularVar}['" . $modelClass . "']['" . $primaryKey . "']) && is_numeric(\${$singularVar}['" . $modelClass . "']['" . $primaryKey . "'])) {
              echo \$this->Html->link(h(\${$singularVar}['" . $modelClass . "']['" . $_field . "'], 'UTF-8'),  array('controller' => '{$pluralVar}',  'action' => 'view',  \${$singularVar}['" . $modelClass . "']['" . $primaryKey . "'],  str_replace('_', '-', Inflector::slug(strtolower(\${$singularVar}['" . $modelClass . "']['" . $_field . "'])))),  array('escape' => false));
            } else {
              echo h(\${$singularVar}['" . $modelClass . "']['" . $_field . "'], 'UTF-8');
            }";
              } else {
echo "
            echo h(\${$singularVar}['" . $modelClass . "']['" . $_field . "'], 'UTF-8');";
              }
            }
          endif;
echo "
          echo '</p>';
        }
";
      endforeach;
echo "
      } else {
        echo '<p>';
          echo '<span class=\"notice\">';
            echo __('{$singularHumanName} not found.');
          echo '</span>';
        echo '</p>';
      }
    echo '</div>';
  echo '</div>';

  if (isset(\${$singularVar}) && is_array(\${$singularVar}) && isset(\${$singularVar}['" . $modelClass . "']) && is_array(\${$singularVar}['" . $modelClass . "']) && isset(\${$singularVar}['" . $modelClass . "']['" . $primaryKey . "']) && is_numeric(\${$singularVar}['" . $modelClass . "']['" . $primaryKey . "'])) {
    echo '<div class=\"box view-actions " . strtolower($singularVar) . "-view-actions\">';
      echo '<div class=\"box-title\">';
        echo '<p>';
          echo \$this->Html->link(__('{$singularHumanName} actions'),  '#',  array('id' => 'toggle-" . strtolower($singularVar) . "-actions', 'escape' => false));
        echo '</p>';
      echo '</div>';
      echo '<div id=\"" . strtolower($singularVar) . "-actions\" class=\"block\">';
        echo '<ul class=\"menu " . strtolower($singularVar) . "-actions-menu " . strtolower($singularVar) . "-actions-menu\">';
          echo '<li class=\"action " . strtolower($singularVar) . "-action " . strtolower($singularVar) . "-edit\">';
            echo \$this->Html->link('<span class=\"icon\"></span>'.__('Edit " . strtolower($singularHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'edit',  \${$singularVar}['" . $modelClass . "']['" . $primaryKey . "']),  array('escape' => false));
          echo '</li>';
          echo '<li class=\"action " . strtolower($singularVar) . "-action " . strtolower($singularVar) . "-delete\">';
            echo \$this->Form->postLink('<span class=\"icon\"></span>'.__('Delete " . strtolower($singularHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'delete',  \${$singularVar}['" . $modelClass . "']['" . $primaryKey . "']),  array('escape' => false),  __('Are you sure you want to delete this " . strtolower($singularHumanName) . "'));
          echo '</li>';
        echo '</ul>';
      echo '</div>';
    echo '</div>';
  }";

  if (!empty($associations['hasOne'])) :
    foreach ($associations['hasOne'] as $_alias => $_details) :
echo "
  echo '<div class=\"box " . strtolower($pluralVar) . " related " . strtolower($pluralVar) . "-related " . strtolower($pluralVar) . "-related-" . strtolower(Inflector::singularize($_details['controller'])) . "\">';
    echo '<div class=\"box-title\">';
      echo '<p>';
        echo \$this->Html->link(__('Related " . Inflector::humanize(Inflector::singularize($_details['controller'])) . "'),  '#',  array('id' => 'toggle-" . strtolower($pluralVar) . "-related-" . strtolower(Inflector::singularize($_details['controller'])) . "', 'escape' => false));
      echo '</p>';
    echo '</div>';
    echo '<div id=\"" . strtolower($pluralVar) . "-related-" . strtolower(Inflector::singularize($_details['controller'])) . "\" class=\"block\">';
      if (isset(\${$singularVar}['" . $_alias . "']) && is_array(\${$singularVar}['" . $_alias . "']) && count(array_filter(\${$singularVar}['" . $_alias . "']))) {
";
        foreach ($_details['fields'] as $_field) :
echo"
        if (isset(\${$singularVar}['" . $_alias . "']) && isset(\${$singularVar}['" . $_alias . "']['" . $_field . "'])) {
          echo '<p>';
            echo '<span class=\"data-title\">';
              echo __('" . Inflector::humanize($_field) . "');
              echo '&nbsp;:&nbsp;';
            echo '</span>';";
            $isKey = false;
            if (isset($schema) && isset($schema[$_field]) && isset($schema[$_field]['key']) && $schema[$_field]['key'] == 'index' && preg_match('#^([a-z]+)_id$#', $_field)) :
              $isKey = true;
echo "
            echo \$this->Html->link(h(\${$singularVar}['" . $_alias . "']['" . $_field . "'], 'UTF-8'),  array('controller' => '" . Inflector::pluralize(rtrim($_field, '_id')) . "',  'action' => 'view',  \${$singularVar}['" . $_alias . "']['" . $_field . "']),  array('escape' => false));";
            endif;
            if ($isKey  !==  true) :
              if (isset($schema) && isset($schema[$_field]) && $schema[$_field]['type'] == 'boolean') {
echo "
            if (\${$singularVar}['" . $_alias . "']['" . $_field . "']) {
              echo __('Yes');
            } else {
              echo __('No');
            }";
              }elseif (isset($schema) && isset($schema[$_field]) && isset($schema[$_field]['type']) && preg_match('#^(enum\()((\'[a-zA-Z0-9]+((\'\))|(\',)))+)$#', $schema[$_field]['type'])) {
                $matches = array();
                if (preg_match_all('#\'[a-zA-Z0-9]+\'#', $schema[$_field]['type'], $matches)) {
                  if (isset($matches[0]) && is_array($matches[0]) && count($matches[0])) {
                    $forDisplay = array();
                    foreach ($matches[0] as $value) {
                      $value = trim($value, "'");
                      switch($value) {
                        case 'M':
                          $forDisplay[$value] = 'Male';
                        break;
                        case 'F':
                          $forDisplay[$value] = 'Female';
                        break;
                        case 'Y':
                          $forDisplay[$value] = 'Yes';
                        break;
                        case 'N':
                          $forDisplay[$value] = 'No';
                        break;
                        case 'R':
                          $forDisplay[$value] = 'Requested';
                        break;
                        case 'W':
                          $forDisplay[$value] = 'Waiting';
                        break;
                        case 'B':
                          $forDisplay[$value] = 'Blocked';
                        break;
                        case 'NA':
                          $forDisplay[$value] = 'Unspecified';
                        break;
                        default:
                          if (is_string($value)) {
                            $forDisplay[$value] = ucwords(strtolower($value));
                          } else {
                            $forDisplay[$value] = $value;
                          }
                      }
                    }
echo "
            switch(\${$singularVar}['" . $_alias . "']['" . $_field . "']) {";
                    foreach ($forDisplay as $key => $value) :
                      $value = trim($value, "'");
echo "
              case " . ((is_string($key)) ? "'" . $key . "'" : $key) . ":
                echo __('" . $value . "');
              break;";
                    endforeach;
                    unset($forDisplay);
echo "
              default:
                echo h(\${$singularVar}['" . $_alias . "']['" . $_field . "'], 'UTF-8');";
echo "
            }";
                  } else {
echo "
            echo h(\${$singularVar}['" . $_alias . "']['" . $_field . "'], 'UTF-8');";
                  }
                } else {
echo "
            echo h(\${$singularVar}['" . $_alias . "']['" . $_field . "'], 'UTF-8');";
                }
              } else {
                if (isset($_details['primaryKey']) && isset($_details['displayField']) && $_details['displayField']  == = $_field) {
echo "
            echo \$this->Html->link(h(\${$singularVar}['" . $_alias . "']['" . $_field . "'], 'UTF-8'),  array('controller' => '" . $_details['controller'] . "',  'action' => 'view',  \${$singularVar}['" . $_alias . "']['" . $_details['primaryKey'] . "'],  str_replace('_', '-', Inflector::slug(strtolower(\${$singularVar}['" . $_alias . "']['" . $_field . "'])))),  array('escape' => false));";
                } else {
echo "
            echo h(\${$singularVar}['" . $_alias . "']['" . $_field . "'], 'UTF-8');";
                }
              }
            endif;
echo "
          echo '</p>';
        }
";
      endforeach;
echo "
      } else {
        echo '<p>';
          echo __('No related " . strtolower(Inflector::humanize(Inflector::singularize($_details['controller']))) . "');
        echo '</p>';
      }
    echo '</div>';
  echo '</div>';
";
    endforeach;
  endif;
echo "
echo '</div>';
";
if (!empty($relations)) :
echo "
echo '<div class=\"grid_8\">';";

    foreach ($relations as $_alias => $_details) :
      $otherSingularVar = Inflector::variable($_alias);
echo "
  echo '<div class=\"box " . strtolower($pluralVar) . " related " . strtolower($pluralVar) . "-related " . strtolower($pluralVar) . "-related-" . strtolower($_details['controller']) . " datas\">';
    echo '<div class=\"box-title\">';
      echo '<p>';
        echo \$this->Html->link(__('Related " . Inflector::humanize($_details['controller']) . "'),  '#',  array('id' => 'toggle-" . strtolower($pluralVar) . "-related-" . strtolower($_details['controller']) . "', 'escape' => false));
      echo '</p>';
    echo '</div>';
    echo '<div id=\"" . strtolower($pluralVar) . "-related-" . strtolower($_details['controller']) . "\" class=\"block\">';
      if (isset(\${$singularVar}['" . $_alias . "']) && is_array(\${$singularVar}['" . $_alias . "']) && count(array_filter(\${$singularVar}['" . $_alias . "']))) {
";
echo "
        \$class = '  first';
        foreach (\${$singularVar}['" . $_alias . "'] as \${$otherSingularVar}) {
          if (is_array(\${$otherSingularVar}) && count(array_filter(\${$otherSingularVar}))) {
            echo '<div class=\"" . strtolower($otherSingularVar) . " data '.\$class.'\">';
              echo '<div class=\"grid_6\">';
                echo '<div class=\"box fields " . strtolower($otherSingularVar) . "-fields\">';
                  echo '<div id=\"" . strtolower($otherSingularVar) . "-fields-'.((isset(\${$otherSingularVar}['" . $_details['primaryKey'] . "'])) ? \${$otherSingularVar}['" . $_details['primaryKey'] . "'] : String::uuid()).'\" class=\"block\">';
";

                      foreach ($_details['fields'] as $_field) :
echo "
                    if (isset(\${$otherSingularVar}) && isset(\${$otherSingularVar}['" . $_field . "'])) {
                      echo '<p>';
                        echo '<span class=\"data-title\">';
                          echo __('" . Inflector::humanize($_field) . "');
                          echo '&nbsp;:&nbsp;';
                        echo '</span>';";
                            $isKey = false;
                            if (isset($schema) && isset($schema[$_field]) && isset($schema[$_field]['key']) && $schema[$_field]['key'] == 'index' && preg_match('#^([a-z]+)_id$#', $_field)) :
                              $isKey = true;
echo "
                        echo \$this->Html->link(h(\${$otherSingularVar}['" . $_field . "'], 'UTF-8'),  array('controller' => '" . Inflector::pluralize(rtrim($_field, '_id')) . "',  'action' => 'view',  \${$otherSingularVar}['" . $_field . "']),  array('escape' => false));";
                            endif;
                            if ($isKey  !==  true) :
                              if (isset($schema) && isset($schema[$_field]) && $schema[$_field]['type'] == 'boolean') {
echo "
                        if (\${$otherSingularVar}['" . $_field . "']) {
                          echo __('Yes');
                        } else {
                          echo __('No');
                        }";
                              }elseif (isset($schema) && isset($schema[$_field]) && isset($schema[$_field]['type']) && preg_match('#^(enum\()((\'[a-zA-Z0-9]+((\'\))|(\',)))+)$#', $schema[$_field]['type'])) {
                                $matches = array();
                                if (preg_match_all('#\'[a-zA-Z0-9]+\'#', $schema[$_field]['type'], $matches)) {
                                  if (isset($matches[0]) && is_array($matches[0]) && count($matches[0])) {
                                    $forDisplay = array();
                                    foreach ($matches[0] as $value) {
                                      $value = trim($value, "'");
                                      switch($value) {
                                        case 'M':
                                          $forDisplay[$value] = 'Male';
                                        break;
                                        case 'F':
                                          $forDisplay[$value] = 'Female';
                                        break;
                                        case 'Y':
                                          $forDisplay[$value] = 'Yes';
                                        break;
                                        case 'N':
                                          $forDisplay[$value] = 'No';
                                        break;
                                        case 'R':
                                          $forDisplay[$value] = 'Requested';
                                        break;
                                        case 'W':
                                          $forDisplay[$value] = 'Waiting';
                                        break;
                                        case 'B':
                                          $forDisplay[$value] = 'Blocked';
                                        break;
                                        case 'NA':
                                          $forDisplay[$value] = 'Unspecified';
                                        break;
                                        default:
                                          if (is_string($value)) {
                                            $forDisplay[$value] = ucwords(strtolower($value));
                                          } else {
                                            $forDisplay[$value] = $value;
                                          }
                                      }
                                    }
echo "
                        switch(\${$otherSingularVar}['" . $_field . "']) {";
                                    foreach ($forDisplay as $key => $value) :
                                      $value = trim($value, "'");
echo "
                          case " . ((is_string($key)) ? "'" . $key . "'" : $key) . ":
                            echo __('" . $value . "');
                          break;";
                                    endforeach;
                                    unset($forDisplay);
echo "
                          default:
                            echo h(\${$otherSingularVar}['" . $_field . "'], 'UTF-8');";
echo "
                        }";
                                  } else {
echo "
                        echo h(\${$otherSingularVar}['" . $_field . "'], 'UTF-8');";
                                  }
                                } else {
echo "
                        echo h(\${$otherSingularVar}['" . $_field . "'], 'UTF-8');";
                                }
                              } else {
                                if (isset($_details['primaryKey']) && isset($_details['displayField']) && $_details['displayField']  == = $_field) {
echo "
                        echo \$this->Html->link(h(\${$otherSingularVar}['" . $_field . "'], 'UTF-8'),  array('controller' => '" . Inflector::pluralize($otherSingularVar) . "',  'action' => 'view',  \${$otherSingularVar}['" . $_details['primaryKey'] . "'],  str_replace('_', '-', Inflector::slug(strtolower(\${$otherSingularVar}['" . $_field . "'])))),  array('escape' => false));";
                                } else {
echo "
                        echo h(\${$otherSingularVar}['" . $_field . "'], 'UTF-8');";
                                }
                              }
                            endif;
echo "
                      echo '</p>';
                    }
";
                      endforeach;
echo "
                  echo '</div>';
                echo '</div>';
              echo '</div>';
              echo '<div class=\"grid_6\">';
                echo '<div class=\"box related " . strtolower($otherSingularVar) . "-related\">';
                  echo '<div id=\"" . strtolower($otherSingularVar) . "-related-'.((isset(\${$otherSingularVar}['" . $_details['primaryKey'] . "'])) ? \${$otherSingularVar}['" . $_details['primaryKey'] . "'] : String::uuid()).'\" class=\"block\">';
                    echo '<p>&nbsp;</p>';
                  echo '</div>';
                echo '</div>';
              echo '</div>';
              echo '<div class=\"grid_4\">';
                echo '<div class=\"box actions " . strtolower($otherSingularVar) . "-actions\">';
                  echo '<div id=\"" . strtolower($otherSingularVar) . "-actions-'.((isset(\${$otherSingularVar}['" . $_details['primaryKey'] . "'])) ? \${$otherSingularVar}['" . $_details['primaryKey'] . "'] : String::uuid()).'\" class=\"block\">';
                    if (isset(\${$otherSingularVar}['" . $_details['primaryKey'] . "'])) {
                      echo '<ul>';
                        echo '<li class=\"action " . strtolower($otherSingularVar) . "-action " . strtolower(Inflector::pluralize($otherSingularVar)) . "-view\">';";
                      if (isset($_details['primaryKey']) && isset($_details['displayField'])) {
echo "
                          if (isset(\${$otherSingularVar}['" . $_details['displayField'] . "']) && !is_numeric(\${$otherSingularVar}['" . $_details['displayField'] . "'])) {
                            echo \$this->Html->link('<span class=\"icon\"></span>'.__('View " . strtolower(Inflector::humanize($otherSingularVar)) . "'),  array('controller' => '" . Inflector::pluralize($otherSingularVar) . "',  'action' => 'view',  \${$otherSingularVar}['" . $_details['primaryKey'] . "'],  str_replace('_', '-', Inflector::slug(strtolower(\${$otherSingularVar}['" . $_details['displayField'] . "'])))),  array('escape' => false));
                          } else {
                            echo \$this->Html->link('<span class=\"icon\"></span>'.__('View " . strtolower(Inflector::humanize($otherSingularVar)) . "'),  array('controller' => '" . Inflector::pluralize($otherSingularVar) . "',  'action' => 'view',  \${$otherSingularVar}['" . $_details['primaryKey'] . "']),  array('escape' => false));
                          }";

                      } else {
echo "
                          echo \$this->Html->link('<span class=\"icon\"></span>'.__('View " . strtolower(Inflector::humanize($otherSingularVar)) . "'),  array('controller' => '" . Inflector::pluralize($otherSingularVar) . "',  'action' => 'view',  \${$otherSingularVar}['" . $_details['primaryKey'] . "']), array('escape' => false));";
                      }
echo "
                        echo '</li>';
                        echo '<li class=\"action " . strtolower($otherSingularVar) . "-action " . strtolower(Inflector::pluralize($otherSingularVar)) . "-edit\">';
                          echo \$this->Html->link('<span class=\"icon\"></span>'.__('Edit " . strtolower(Inflector::humanize($otherSingularVar)) . "'),  array('controller' => '" . Inflector::pluralize($otherSingularVar) . "',  'action' => 'edit',  \${$otherSingularVar}['" . $_details['primaryKey'] . "']), array('escape' => false));
                        echo '</li>';
                        echo '<li class=\"action " . strtolower($otherSingularVar) . "-action " . strtolower(Inflector::pluralize($otherSingularVar)) . "-delete\">';
                          echo \$this->Form->postLink('<span class=\"icon\"></span>'.__('Delete " . strtolower(Inflector::humanize($otherSingularVar)) . "'),  array('controller' => '" . Inflector::pluralize($otherSingularVar) . "',  'action' => 'delete',  \${$otherSingularVar}['" . $_details['primaryKey'] . "']),  array('escape' => false),  __('Are you sure you want to delete this " . strtolower(Inflector::humanize($otherSingularVar)) . "'));
                        echo '</li>';
                      echo '</ul>';
                    }
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
            echo '<div class=\"clear\"></div>';
            \$class = null;
          }
        }

      } else {
        echo '<div class=\"address data first\">';
          echo '<p>';
            echo __('No related " . strtolower(Inflector::humanize(Inflector::singularize($_details['controller']))) . "');
          echo '</p>';
        echo '</div>';
      }
    echo '</div>';
  echo '</div>';
";
    endforeach;
echo "
echo '</div>';
";
endif;
echo "
echo '<div class=\"grid_4\">';
  echo '<div class=\"box actions menu actions-menu\">';
    echo '<div class=\"box-title\">';
      echo '<p>';
        echo \$this->Html->link(__('Main actions'),  '#',  array('id' => 'toggle-section-menu', 'escape' => false));
      echo '</p>';
    echo '</div>';
    echo '<div id=\"section-menu\" class=\"block\">';
      echo '<ul class=\"section menu actions-section-menu\">';

        echo '<li class=\"" . strtolower($pluralVar) . "-actions\">';
          echo \$this->Html->link('<span class=\"icon\"></span>'.__('{$pluralHumanName} actions'),  '#',  array('class' => 'menuitem',  'escape' => false));
          echo '<ul class=\"submenu " . strtolower($pluralVar) . "-actions-submenu\">';
            echo '<li class=\"action " . strtolower($pluralVar) . "-action " . strtolower($pluralVar) . "-index\">';
              echo \$this->Html->link('<span class=\"icon\"></span>'.__('List " . strtolower($pluralHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'index'),  array('escape' => false));
            echo '</li>';
            echo '<li class=\"action " . strtolower($pluralVar) . "-action " . strtolower($pluralVar) . "-add\">';
              echo \$this->Html->link('<span class=\"icon\"></span>'.__('New " . strtolower($singularHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'add'),  array('escape' => false));
            echo '</li>';
          echo '</ul>';
        echo '</li>';
";
        $done = array();
        foreach ($associations as $_type => $_data) :
          foreach ($_data as $_alias => $_details) :
            if ($_details['controller'] != $pluralVar  &&  !in_array($_details['controller'],  $done)) :
echo "
        echo '<li class=\"" . strtolower($_details['controller']) . "-actions\">';
          echo \$this->Html->link('<span class=\"icon\"></span>'.__('" . Inflector::humanize($_details['controller']) . " actions'),  '#',  array('class' => 'menuitem',  'escape' => false));
          echo '<ul class=\"submenu " . strtolower($_details['controller']) . "-actions-submenu\">';
            echo '<li class=\"action " . strtolower($_details['controller']) . "-action " . strtolower($_details['controller']) . "-index\">';
              echo \$this->Html->link('<span class=\"icon\"></span>'.__('List " . strtolower(Inflector::humanize($_details['controller'])) . "'),  array('controller' => '" . $_details['controller'] . "',  'action' => 'index'),  array('escape' => false));
            echo '</li>';
            echo '<li class=\"action " . strtolower($_details['controller']) . "-action " . strtolower($_details['controller']) . "-add\">';
              echo \$this->Html->link('<span class=\"icon\"></span>'.__('New " . strtolower(Inflector::humanize(Inflector::underscore($_alias))) . "'),  array('controller' => '" . $_details['controller'] . "',  'action' => 'add'),  array('escape' => false));
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
echo '</div>';
?>
";
?>