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
echo "<?php
if (isset(\$this->Paginator)) {
  \$this->Paginator->options(array('url' => \$this->passedArgs));
}

echo '<div class=\"grid_12\">';

  echo '<div class=\"box index " . strtolower($pluralVar) . "-index datas\">';

    echo '<div class=\"box-title\">';
      echo '<p>';
        echo \$this->Html->link(__('{$pluralHumanName} Index'),  '#',  array('id' => 'toggle-" . strtolower($pluralVar) . "-index', 'escape' => false));
      echo '</p>';
    echo '</div>';

    if (isset(\$this->Paginator) && \$this->Paginator->hasPage()) {
      \$displayPagingCounter = false;
      \$pagingElementPosition = 'top';
      echo '<div id=\"paging-navigation-'.\$pagingElementPosition.'\"  class=\"block\">';
        echo '<div class=\"grid_2\">';
          echo '<div class=\"box paging-navigation-first paging-navigation-'.\$pagingElementPosition.'-first\">';
            echo '<div id=\"paging-navigation-'.\$pagingElementPosition.'-first\" class=\"block\">';
              echo '<p>';
                echo \$this->Paginator->first(__('first'),  array());
              echo '</p>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
        echo '<div class=\"grid_12\">';
          echo '<div class=\"box paging-navigation-numbers paging-navigation-'.\$pagingElementPosition.'-numbers\">';
            echo '<div id=\"paging-navigation-'.\$pagingElementPosition.'-numbers\" class=\"block\">';
              echo '<p>';
                echo \"\\t\" . \$this->Paginator->prev('<< '. __('previous'),  array(),  null,  array('class' => 'disabled'));
                  echo \"\\t\" . \$this->Paginator->numbers(array());
                echo \"\\t\" . \$this->Paginator->next(__('next') .' >>',  array(),  null,  array('class' => 'disabled'));
              echo '</p>';
              if (isset(\$displayPagingCounter) && \$displayPagingCounter) {
                echo '<p>';
                  echo \$this->Paginator->counter(array(
                    'format' => __('Page %page% of %pages%,  showing %current% records out of %count% total,  starting on record %start%,  ending on %end%')
                 ));
                echo '</p>';
              }
            echo '</div>';
          echo '</div>';
        echo '</div>';
        echo '<div class=\"grid_2\">';
          echo '<div class=\"box paging-navigation-last paging-navigation-'.\$pagingElementPosition.'-last\">';
            echo '<div id=\"paging-navigation-'.\$pagingElementPosition.'-last\" class=\"block\">';
              echo '<p>';
                echo \$this->Paginator->last(__('last'),  array());
              echo '</p>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    }

    echo '<div id=\"" . strtolower($pluralVar) . "-index\" class=\"block\">';

      if (isset(\${$pluralVar}) && is_array(\${$pluralVar}) && count(\${$pluralVar})) {
        \$class = ' first';
        \$displayedFields = array();
        foreach (\${$pluralVar} as \${$singularVar}) {
          echo '<div class=\"" . strtolower($singularVar) . " data '.\$class.'\">';
            echo '<div class=\"grid_6\">';
              echo '<div class=\"box fields " . strtolower($singularVar) . "-fields\">';
                echo '<div id=\"" . strtolower($singularVar) . "-fields-'.((isset(\${$singularVar}['{$modelClass}']['{$primaryKey}'])) ? \${$singularVar}['{$modelClass}']['{$primaryKey}'] : String::uuid()).'\" class=\"block\">';
";
                foreach ($fields as $_field) :
echo "
                    if (isset(\${$singularVar}['{$modelClass}']) && isset(\${$singularVar}['{$modelClass}']['" . $_field . "'])) {
                      \$displayedFields['" . $_field . "'] = '" . $_field . "';
                      echo '<p>';
                        echo '<span class=\"data-title\">';
                          echo __('" . Inflector::humanize($_field) . "');
                          echo '&nbsp;:&nbsp;';
                        echo '</span>';";
                    $isKey = false;
                    if (!empty($associations['belongsTo'])) :
                      foreach ($associations['belongsTo'] as $_alias => $_details) :
                        if ($_field  == = $_details['foreignKey']) :
                          $isKey = true;
echo "
                        if (isset(\${$singularVar}['" . $_alias . "']) && isset(\${$singularVar}['" . $_alias . "']['" . $_details['displayField'] . "'])) {
                          echo \$this->Html->link(h(\${$singularVar}['" . $_alias . "']['" . $_details['displayField'] . "'], 'UTF-8'),  array('controller' => '" . $_details['controller'] . "',  'action' => 'view',  \${$singularVar}['" . $_alias . "']['" . $_details['primaryKey'] . "'],  str_replace('_', '-', Inflector::slug(strtolower(\${$singularVar}['" . $_alias . "']['" . $_details['displayField'] . "'])))),  array('escape' => false));
                        } else {
                          echo \$this->Html->link(\${$singularVar}['{$modelClass}']['" . $_field . "'],  array('controller' => '" . $_details['controller'] . "',  'action' => 'view',  \${$singularVar}['{$modelClass}']['" . $_field . "']),  array('escape' => false));
                        }";
                          break;
                        endif;
                      endforeach;
                    endif;

                    if ($isKey  !==  true) :
                      if (isset($schema) && isset($schema[$_field]) && $schema[$_field]['type'] == 'boolean') {
echo "
                        if (\${$singularVar}['{$modelClass}']['" . $_field . "']) {
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
                        if (isset(\${$singularVar}['{$modelClass}']['" . $primaryKey . "']) && is_numeric(\${$singularVar}['{$modelClass}']['" . $primaryKey . "'])) {
                          echo \$this->Html->link(h(\${$singularVar}['{$modelClass}']['" . $_field . "'], 'UTF-8'),  array('controller' => '{$pluralVar}',  'action' => 'view',  \${$singularVar}['{$modelClass}']['" . $primaryKey . "'],  str_replace('_', '-', Inflector::slug(strtolower(\${$singularVar}['{$modelClass}']['" . $_field . "'])))),  array('escape' => false));
                        } else {
                          echo h(\${$singularVar}['{$modelClass}']['" . $_field . "'], 'UTF-8');
                        }";
                        } else {
echo "
                        echo h(\${$singularVar}['{$modelClass}']['" . $_field . "'], 'UTF-8');";
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
              echo '<div class=\"box related " . strtolower($singularVar) . "-related\">';
                echo '<div id=\"" . strtolower($singularVar) . "-related-'.((isset(\${$singularVar}['{$modelClass}']['{$primaryKey}'])) ? \${$singularVar}['{$modelClass}']['{$primaryKey}'] : String::uuid()).'\" class=\"block\">';
                  echo '<p>&nbsp;</p>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
            echo '<div class=\"grid_4\">';
              echo '<div class=\"box actions " . strtolower($singularVar) . "-actions\">';
                echo '<div id=\"" . strtolower($singularVar) . "-actions-'.((isset(\${$singularVar}['{$modelClass}']['{$primaryKey}'])) ? \${$singularVar}['{$modelClass}']['{$primaryKey}'] : String::uuid()).'\" class=\"block\">';
                  if (isset(\${$singularVar}['{$modelClass}']['{$primaryKey}']) && is_numeric(\${$singularVar}['{$modelClass}']['{$primaryKey}'])) {
                    echo '<ul>';

                      echo '<li class=\"action " . strtolower($singularVar) . "-action " . strtolower($pluralVar) . "-view\">';";
                    if (isset($primaryKey) && isset($displayField)) {
echo "
                        if (isset(\${$singularVar}['{$modelClass}']['{$displayField}']) && !is_numeric(\${$singularVar}['{$modelClass}']['{$displayField}'])) {
                          echo \$this->Html->link('<span class=\"icon\"></span>'.__('View " . strtolower($singularHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'view',  \${$singularVar}['{$modelClass}']['{$primaryKey}'],  str_replace('_', '-', Inflector::slug(strtolower(\${$singularVar}['{$modelClass}']['{$displayField}'])))),  array('escape' => false));
                        } else {
                          echo \$this->Html->link('<span class=\"icon\"></span>'.__('View " . strtolower($singularHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'view',  \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false));
                        }";
                    } else {
echo "
                        echo \$this->Html->link('<span class=\"icon\"></span>'.__('View " . strtolower($singularHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'view',  \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false));";
                    }
echo"
                      echo '</li>';

                      echo '<li class=\"action " . strtolower($singularVar) . "-action " . strtolower($pluralVar) . "-edit\">';
                        echo \$this->Html->link('<span class=\"icon\"></span>'.__('Edit " . strtolower($singularHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'edit',  \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false));
                      echo '</li>';

                      echo '<li class=\"action " . strtolower($singularVar) . "-action " . strtolower($pluralVar) . "-delete\">';
                        echo \$this->Form->postLink('<span class=\"icon\"></span>'.__('Delete " . strtolower($singularHumanName) . "'),  array('controller' => '{$pluralVar}',  'action' => 'delete',  \${$singularVar}['{$modelClass}']['{$primaryKey}']),  array('escape' => false),  __('Are you sure you want to delete this " . strtolower($singularHumanName) . "'));
                      echo '</li>';

                    echo '</ul>';
                  }
                echo '</div>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
          \$class = null;
        }
      } else {
        echo '<p>';
          echo '<span class=\"notice\">';
            echo __('No {$pluralHumanName} found. Try another search.');
          echo '</span>';
        echo '</p>';
      }

    echo '</div>';

    if (isset(\$this->Paginator) && \$this->Paginator->hasPage()) {
      \$displayPagingCounter = true;
      \$pagingElementPosition = 'bottom';
      echo '<div id=\"paging-navigation-'.\$pagingElementPosition.'\"  class=\"block\">';
        echo '<div class=\"grid_2\">';
          echo '<div class=\"box paging-navigation-first paging-navigation-'.\$pagingElementPosition.'-first\">';
            echo '<div id=\"paging-navigation-'.\$pagingElementPosition.'-first\" class=\"block\">';
              echo '<p>';
                echo \$this->Paginator->first(__('first'),  array());
              echo '</p>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
        echo '<div class=\"grid_12\">';
          echo '<div class=\"box paging-navigation-numbers paging-navigation-'.\$pagingElementPosition.'-numbers\">';
            echo '<div id=\"paging-navigation-'.\$pagingElementPosition.'-numbers\" class=\"block\">';
              echo '<p>';
                echo \"\\t\" . \$this->Paginator->prev('<< '. __('previous'),  array(),  null,  array('class' => 'disabled'));
                  echo \"\\t\" . \$this->Paginator->numbers(array());
                echo \"\\t\" . \$this->Paginator->next(__('next') .' >>',  array(),  null,  array('class' => 'disabled'));
              echo '</p>';
              if (isset(\$displayPagingCounter) && \$displayPagingCounter) {
                echo '<p>';
                  echo \$this->Paginator->counter(array(
                    'format' => __('Page %page% of %pages%,  showing %current% records out of %count% total,  starting on record %start%,  ending on %end%')
                 ));
                echo '</p>';
              }
            echo '</div>';
          echo '</div>';
        echo '</div>';
        echo '<div class=\"grid_2\">';
          echo '<div class=\"box paging-navigation-last paging-navigation-'.\$pagingElementPosition.'-last\">';
            echo '<div id=\"paging-navigation-'.\$pagingElementPosition.'-last\" class=\"block\">';
              echo '<p>';
                echo \$this->Paginator->last(__('last'),  array());
              echo '</p>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    }

  echo '</div>';
echo '</div>';

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

  if (isset(\$this->Paginator) && \$this->Paginator->hasPage()) {
    echo '<div class=\"box paging-actions " . strtolower($pluralVar) . "-index-paging-actions\">';
      echo '<div class=\"box-title\">';
        echo '<p>';
          echo \$this->Html->link(__('Paging links', true),  '#',  array('id' => 'toggle-paging-actions', 'escape' => false));
        echo '</p>';
      echo '</div>';
      echo '<div id=\"paging-actions\" class=\"block\">';
        echo '<div class=\"block-title\">';
          echo '<p>';
            echo __('Results per page', true);
            echo '&nbsp;:';
          echo '</p>';
        echo '</div>';
        echo '<ul class=\"menu paging-actions-menu paging-actions-menu-results\">';
          echo '<li class=\"paging-actions-results " . strtolower($pluralVar) . "-paging-actions-results\">';
            \$resultsPerPage = array(5, 10, 25, 50);
            foreach (\$resultsPerPage as \$value) {
              if (isset(\$this->passedArgs) && isset(\$this->passedArgs['limit']) && \$this->passedArgs['limit'] == \$value) {
                echo '<span class=\"current\">';
                  echo __('%s results',  \$value);
                echo '</span>';
              } else {
                echo \$this->Paginator->link(__('%s results',  \$value),  array('controller' => '{$pluralVar}', 'action' => 'index'),  array('url' => array_merge(\$this->passedArgs, array('page' => 1, 'limit' => \$value)),  'escape' => false));
              }
            }
          echo '</li>';
        echo '</ul>';
        echo '<div class=\"block-title\">';
          echo '<p>';
            echo __('Order by', true);
            echo '&nbsp;:';
          echo '</p>';
        echo '</div>';
        echo '<ul class=\"menu paging-actions-menu paging-actions-menu-order\">';
          if (\$this->Paginator->sortKey()) {
            if (isset(\$displayedFields) && is_array(\$displayedFields) && isset(\$displayedFields[\$this->Paginator->sortKey()]) && \$displayedFields[\$this->Paginator->sortKey()]) {
              echo '<li class=\"paging-actions-order " . strtolower($pluralVar) . "-paging-actions-order\">';
                if (\$this->Paginator->sortDir() == 'desc') {
                  echo '<span class=\"current\">';
                    echo __('Ordered by %s %s', strtolower(Inflector::humanize(\$this->Paginator->sortKey())),  __('descending'));
                  echo '</span>';
                } else {
                  echo '<span class=\"current\">';
                    echo __('Ordered by %s %s', strtolower(Inflector::humanize(\$this->Paginator->sortKey())),  __('ascending'));
                  echo '</span>';
                }
              echo '</li>';
            }
          }
";
          foreach ($fields as $_field) :
echo "
          if (isset(\$displayedFields) && is_array(\$displayedFields) && isset(\$displayedFields['" . $_field . "']) && \$displayedFields['" . $_field . "']) {
            echo '<li class=\"paging-actions-order " . strtolower($pluralVar) . "-paging-actions-order\">';
              if (\$this->Paginator->sortKey() == '{$_field}' && \$this->Paginator->sortDir()!='desc') {
                echo \$this->Paginator->sort('{$_field}', __('Order by " . strtolower(Inflector::humanize($_field)) . " %s', __('descending', true)));
              } else {
                echo \$this->Paginator->sort('{$_field}', __('Order by " . strtolower(Inflector::humanize($_field)) . " %s', __('ascending', true)));
              }
            echo '</li>';
          }
";
          endforeach;
echo "
        echo '</ul>';
      echo '</div>';
    echo '</div>';
  }
echo '</div>';
?>
";
?>