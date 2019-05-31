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
 * @subpackage        cake.cake.console.libs.templates.views
 * @since                 CakePHP(tm) v 0.10.0.1076
 * @license             MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php
if (isset($this->Paginator)) {
    $this->Paginator->options(array('url' => $this->passedArgs));
}

echo '<div class="grid_12">';

    echo '<div class="box index '.strtolower($pluralVar).'-index datas">';
        echo '<div class="box-title">';
            echo '<p>';
                echo $this->Html->link(__d('scaffold',  '%s Index',  __d('scaffold_specific',  $pluralHumanName)),  '#',  array('id' => 'toggle-'.strtolower($pluralVar).'-index', 'escape' => false));
            echo '</p>';
        echo '</div>';

        if (isset($this->Paginator) && $this->Paginator->hasPage()) {
            $displayPagingCounter = false;
            $pagingElementPosition = 'top';
            echo '<div id="paging-navigation-'.$pagingElementPosition.'"    class="block">';
                echo '<div class="grid_2">';
                    echo '<div class="box paging-navigation-first paging-navigation-'.$pagingElementPosition.'-first">';
                        echo '<div id="paging-navigation-'.$pagingElementPosition.'-first" class="block">';
                            echo '<p>';
                                echo $this->Paginator->first(__d('scaffold',  'first'),  array());
                            echo '</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="grid_12">';
                    echo '<div class="box paging-navigation-numbers paging-navigation-'.$pagingElementPosition.'-numbers">';
                        echo '<div id="paging-navigation-'.$pagingElementPosition.'-numbers" class="block">';
                            echo '<p>';
                                echo "\t" .   $this->Paginator->prev('<< '. __d('scaffold',  'previous'),  array(),  null,  array('class' => 'disabled'));
                                    echo "\t" .   $this->Paginator->numbers(array());
                                echo "\t" .   $this->Paginator->next(__d('scaffold',  'next') .' >>',  array(),  null,  array('class' => 'disabled'));
                            echo '</p>';
                            if (isset($displayPagingCounter) && $displayPagingCounter) {
                                echo '<p>';
                                    echo $this->Paginator->counter(array(
                                        'format' => __d('scaffold',  'Page %page% of %pages%,  showing %current% records out of %count% total,  starting on record %start%,  ending on %end%')
                                   ));
                                echo '</p>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="grid_2">';
                    echo '<div class="box paging-navigation-last paging-navigation-'.$pagingElementPosition.'-last">';
                        echo '<div id="paging-navigation-'.$pagingElementPosition.'-last" class="block">';
                            echo '<p>';
                                echo $this->Paginator->last(__d('scaffold',  'last'),  array());
                            echo '</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }

        echo '<div id="'.strtolower($pluralVar).'-index" class="block">';

            if (isset(${$pluralVar}) && is_array(${$pluralVar}) && count(${$pluralVar})) {
                $class = ' first';
                foreach (${$pluralVar} as ${$singularVar}) {
                    echo '<div class="'.strtolower($singularVar).' data '.$class.'">';
                        echo '<div class="grid_6">';
                            echo '<div class="box fields '.strtolower($singularVar).'-fields">';
                                echo '<div id="'.strtolower($singularVar).'-fields-'.${$singularVar}[$modelClass][$primaryKey].'" class="block">';
                                    foreach ($scaffoldFields as $_field) {
                                        echo '<p>';
                                            echo '<span class="data-title">';
                                                echo __d('scaffold_specific',  Inflector::humanize($_field));
                                                echo '&nbsp;:&nbsp;';
                                            echo '</span>';
                                            $isKey = false;
                                            if (!empty($associations['belongsTo'])) {
                                                foreach ($associations['belongsTo'] as $_alias => $_details) {
                                                    if ($_field  == = $_details['foreignKey']) {
                                                        $isKey = true;
                                                            echo '<span class="data-content">';
                                                                echo $this->Html->link(h(${$singularVar}[$_alias][$_details['displayField']], 'UTF-8'),  array('controller' => $_details['controller'],  'action' => 'view',  ${$singularVar}[$_alias][$_details['primaryKey']]),  array('escape' => false));
                                                            echo '</span>';
                                                        break;
                                                    }
                                                }
                                            }
                                            if ($isKey  !==  true) {
                                                if (gettype(${$singularVar}[$modelClass][$_field])  ==  'boolean') {
                                                    echo '<span class="data-content">';
                                                        if (${$singularVar}[$modelClass][$_field]) {
                                                            echo __d('scaffold',  'Yes');
                                                        } else {
                                                            echo __d('scaffold',  'No');
                                                        }
                                                    echo '</span>';
                                                } else {
                                                    if (isset($primaryKey)  &&  isset($displayField)  &&  $displayField  == = $_field  &&  !is_numeric(${$singularVar}[$modelClass][$_field])) {
                                                        echo '<span class="data-content">';
                                                            echo $this->Html->link(h(${$singularVar}[$modelClass][$_field], 'UTF-8'),  array('controller' => $pluralVar,  'action' => 'view',  ${$singularVar}[$modelClass][$primaryKey],  Inflector::slug(strtolower(${$singularVar}[$modelClass][$_field]), '-')),  array('escape' => false));
                                                        echo '</span>';
                                                    } else {
                                                        switch($_field) {
                                                            case 'password':
                                                            case 'userpass':
                                                                echo '<span class="data-content data-content-hidden">';
                                                                    echo __d('validation',  'hidden');
                                                                echo '</span>';
                                                            break;
                                                            default:
                                                                echo '<span class="data-content">';
                                                                    echo h(${$singularVar}[$modelClass][$_field], 'UTF-8');
                                                                echo '</span>';
                                                        }
                                                    }
                                                }
                                            }
                                        echo '</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="grid_6">';
                            echo '<div class="box related '.strtolower($singularVar).'-related">';
                                echo '<div id="'.strtolower($singularVar).'-related-'.${$singularVar}[$modelClass][$primaryKey].'" class="block">';
                                    echo '<p>&nbsp;</p>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="grid_4">';
                            echo '<div class="box actions '.strtolower($singularVar).'-actions">';
                                echo '<div id="'.strtolower($singularVar).'-actions-'.${$singularVar}[$modelClass][$primaryKey].'" class="block">';
                                    echo '<ul>';
                                        echo '<li class="action '.strtolower($singularVar).'-action '.strtolower($pluralVar).'-view">';
                                            if (isset($primaryKey) && isset($displayField)) {
                                                if ($displayField  == = $_field  &&  !is_numeric(${$singularVar}[$modelClass][$_field])) {
                                                    echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'View %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'view',  ${$singularVar}[$modelClass][$primaryKey],  Inflector::slug(strtolower(${$singularVar}[$modelClass][$_field]), '-')),  array('escape' => false));
                                                } else {
                                                    echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'View %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'view',  ${$singularVar}[$modelClass][$primaryKey]), array('escape' => false));
                                                }
                                            } else {
                                                echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'View %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'view',  ${$singularVar}[$modelClass][$primaryKey]), array('escape' => false));
                                            }
                                        echo '</li>';
                                        echo '<li class="action '.strtolower($singularVar).'-action '.strtolower($pluralVar).'-edit">';
                                            echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'Edit %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'edit',  ${$singularVar}[$modelClass][$primaryKey]), array('escape' => false));
                                        echo '</li>';
                                        echo '<li class="action '.strtolower($singularVar).'-action '.strtolower($pluralVar).'-delete">';
                                            echo $this->Form->postLink('<span class="icon"></span>'.__d('scaffold',  'Delete %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'delete',  ${$singularVar}[$modelClass][$primaryKey]),  array('escape' => false),  __d('scaffold',  'Are you sure you want to delete #%s',  ${$singularVar}[$modelClass][$primaryKey]));
                                        echo '</li>';
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    $class = null;
                }
            } else {
                echo '<p>';
                    echo '<span class="notice">';
                        echo __d('scaffold',  'No %s found. Try another search.',  __d('scaffold_specific',  $pluralHumanName));
                    echo '</span>';
                echo '</p>';
            }

        echo '</div>';

        if (isset($this->Paginator) && $this->Paginator->hasPage()) {
            $displayPagingCounter = true;
            $pagingElementPosition = 'bottom';
            echo '<div id="paging-navigation-'.$pagingElementPosition.'"    class="block">';
                echo '<div class="grid_2">';
                    echo '<div class="box paging-navigation-first paging-navigation-'.$pagingElementPosition.'-first">';
                        echo '<div id="paging-navigation-'.$pagingElementPosition.'-first" class="block">';
                            echo '<p>';
                                echo $this->Paginator->first(__d('scaffold',  'first'),  array());
                            echo '</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="grid_12">';
                    echo '<div class="box paging-navigation-numbers paging-navigation-'.$pagingElementPosition.'-numbers">';
                        echo '<div id="paging-navigation-'.$pagingElementPosition.'-numbers" class="block">';
                            echo '<p>';
                                echo "\t" .   $this->Paginator->prev('<< '. __d('scaffold',  'previous'),  array(),  null,  array('class' => 'disabled'));
                                    echo "\t" .   $this->Paginator->numbers(array());
                                echo "\t" .   $this->Paginator->next(__d('scaffold',  'next') .' >>',  array(),  null,  array('class' => 'disabled'));
                            echo '</p>';
                            if (isset($displayPagingCounter) && $displayPagingCounter) {
                                echo '<p>';
                                    echo $this->Paginator->counter(array(
                                        'format' => __d('scaffold',  'Page %page% of %pages%,  showing %current% records out of %count% total,  starting on record %start%,  ending on %end%')
                                   ));
                                echo '</p>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="grid_2">';
                    echo '<div class="box paging-navigation-last paging-navigation-'.$pagingElementPosition.'-last">';
                        echo '<div id="paging-navigation-'.$pagingElementPosition.'-last" class="block">';
                            echo '<p>';
                                echo $this->Paginator->last(__d('scaffold',  'last'),  array());
                            echo '</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }

    echo '</div>';
echo '</div>';

echo '<div class="grid_4">';

    echo '<div class="box actions menu actions-menu">';
        echo '<div class="box-title">';
            echo '<p>';
                echo $this->Html->link(__d('scaffold',  'Main actions'),  '#',  array('id' => 'toggle-section-menu', 'escape' => false));
            echo '</p>';
        echo '</div>';
        echo '<div id="section-menu" class="block">';
            echo '<ul class="section menu actions-section-menu">';
                echo '<li class="'.strtolower($pluralVar).'-actions">';
                    echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  '%s actions',  __d('scaffold_specific',  $pluralHumanName)),  '#',  array('class' => 'menuitem',  'escape' => false));
                    echo '<ul class="submenu '.strtolower($pluralVar).'-actions-submenu">';
                        echo '<li class="action '.strtolower($pluralVar).'-action '.strtolower($pluralVar).'-add">';
                            echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'New %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'add'),  array('escape' => false));
                        echo '</li>';
                    echo '</ul>';
                echo '</li>';
                $done = array();
                foreach ($associations as $_type => $_data) {
                    foreach ($_data as $_alias => $_details) {
                        if ($_details['controller'] != $this->name  &&  !in_array($_details['controller'],  $done)) {
                            echo '<li class="'.$_details['controller'].'-actions">';
                                echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  '%s actions',  __d('scaffold_specific',  Inflector::humanize($_details['controller']))),  '#',  array('class' => 'menuitem',  'escape' => false));
                                echo '<ul class="submenu '.$_details['controller'].'-actions-submenu">';
                                    echo '<li class="action '.$_details['controller'].'-action '.$_details['controller'].'-index">';
                                        echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'List %s',  __d('scaffold_specific',  strtolower(Inflector::humanize($_details['controller'])))),  array('controller' => $_details['controller'],  'action' => 'index'),  array('escape' => false));
                                    echo '</li>';
                                    echo '<li class="action '.$_details['controller'].'-action '.$_details['controller'].'-add">';
                                        echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'New %s',  __d('scaffold_specific',  strtolower(Inflector::humanize(Inflector::underscore($_alias))))),  array('controller' => $_details['controller'],  'action' => 'add'),  array('escape' => false));
                                    echo '</li>';
                                echo '</ul>';
                            echo '</li>';
                            $done[] = $_details['controller'];
                        }
                    }
                }
            echo '</ul>';
        echo '</div>';
    echo '</div>';

    if (isset($this->Paginator) && $this->Paginator->hasPage()) {
        echo '<div class="box paging-actions '.strtolower($pluralVar).'-index-paging-actions">';
            echo '<div class="box-title">';
                echo '<p>';
                    echo $this->Html->link(__d('scaffold',  'Paging links'),  '#',  array('id' => 'toggle-paging-actions', 'escape' => false));
                echo '</p>';
            echo '</div>';
            echo '<div id="paging-actions" class="block">';
                echo '<div class="block-title">';
                    echo '<p>';
                        echo __d('scaffold',  'Results per page');
                        echo '&nbsp;:';
                    echo '</p>';
                echo '</div>';
                echo '<ul class="menu paging-actions-menu paging-actions-menu-results">';
                    echo '<li class="paging-actions-results '.strtolower($pluralVar).'-paging-actions-results">';
                        $resultsPerPage = array(5, 10, 25, 50);
                        foreach ($resultsPerPage as $value) {
                            if (isset($this->passedArgs) && isset($this->passedArgs['limit']) && $this->passedArgs['limit'] == $value) {
                                echo '<span class="current">'.__d('scaffold',  '%s results',  $value).'</span>';
                            } else {
                                echo $this->Paginator->link(__d('scaffold',  '%s results',  $value),  array('controller' => $pluralVar,  'action' => 'index'),  array('url' => array_merge($this->passedArgs, array('page' => '1', 'limit' => $value)),  'escape' => false));
                            }
                        }
                    echo '</li>';
                echo '</ul>';
                echo '<div class="block-title">';
                    echo '<p>';
                        echo __d('scaffold',  'Order by');
                        echo '&nbsp;:';
                    echo '</p>';
                echo '</div>';
                echo '<ul class="menu paging-actions-menu paging-actions-menu-order">';
                    if ($this->Paginator->sortKey()) {
                        echo '<li class="paging-actions-order '.strtolower($pluralVar).'-paging-actions-order">';
                            if ($this->Paginator->sortDir() == 'desc') {
                                echo '<span class="current">';
                                    echo __d('scaffold',  'Ordered by %s %s',  __d('scaffold_specific',  __d('scaffold_specific',  strtolower(Inflector::humanize($this->Paginator->sortKey())))),  __d('scaffold',  'descending'));
                                echo '</span>';
                            } else {
                                echo '<span class="current">';
                                    echo __d('scaffold',  'Ordered by %s %s',  __d('scaffold_specific',  __d('scaffold_specific',  strtolower(Inflector::humanize($this->Paginator->sortKey())))),  __d('scaffold',  'ascending'));
                                echo '</span>';
                            }
                        echo '</li>';
                    }
                    foreach ($scaffoldFields as $_field) {
                        echo '<li class="paging-actions-order '.strtolower($pluralVar).'-paging-actions-order">';
                            if ($this->Paginator->sortKey() == $_field && $this->Paginator->sortDir()!='desc') {
                                echo $this->Paginator->sort($_field, __d('scaffold',  'Order by %s %s',  __d('scaffold_specific',  strtolower(Inflector::humanize($_field))),  __d('scaffold',  'descending')));
                            } else {
                                echo $this->Paginator->sort($_field, __d('scaffold',  'Order by %s %s',  __d('scaffold_specific',  strtolower(Inflector::humanize($_field))),  __d('scaffold',  'ascending')));
                            }
                        echo '</li>';
                    }
                echo '</ul>';
            echo '</div>';
        echo '</div>';
    }
echo '</div>';
