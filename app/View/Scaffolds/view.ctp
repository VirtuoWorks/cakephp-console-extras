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
 * @subpackage        cake.cake.libs.view.templates.scaffolds
 * @since                 CakePHP(tm) v 0.10.0.1076
 * @license             MIT License (http://www.opensource.org/licenses/mit-license.php)
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

echo '<div class="grid_'.$grid.'">';
    echo '<div class="box '.strtolower($pluralVar).' view '.strtolower($pluralVar).'-view">';
        echo '<div class="box-title">';
            echo '<p>';
                echo $this->Html->link(__d('scaffold',  'View %s',  __d('scaffold_specific',  $singularHumanName)),  '#',  array('id' => 'toggle-'.strtolower($pluralVar).'-view', 'escape' => false));
            echo '</p>';
        echo '</div>';
        echo '<div id="'.strtolower($pluralVar).'-view" class="block">';
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
                                echo $this->Html->link(h(${$singularVar}[$_alias][$_details['displayField']], 'UTF-8'),  array('controller' => $_details['controller'],  'action' => 'view',  ${$singularVar}[$_alias][$_details['primaryKey']],  Inflector::slug(strtolower(${$singularVar}[$_alias][$_details['displayField']]), '-')),  array('escape' => false));
                                break;
                            }
                        }
                    }
                    if ($isKey  !==  true) {
                        if (gettype(${$singularVar}[$modelClass][$_field])  ==  'boolean') {
                            if (${$singularVar}[$modelClass][$_field]) {
                                echo __d('scaffold',  'Yes');
                            } else {
                                echo __d('scaffold',  'No');
                            }
                        } else {
                            if (isset($primaryKey) && isset($displayField)  &&  $displayField  == = $_field  &&  !is_numeric(${$singularVar}[$modelClass][$_field])) {
                                echo $this->Html->link(${$singularVar}[$modelClass][$_field],  array('controller' => $pluralVar,  'action' => 'view',  ${$singularVar}[$modelClass][$primaryKey],  Inflector::slug(strtolower(${$singularVar}[$modelClass][$_field]), '-')),  array('escape' => false));
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

    echo '<div class="box view-actions '.strtolower($singularVar).'-view-actions">';
        echo '<div class="box-title">';
            echo '<p>';
                echo $this->Html->link(__d('scaffold',  '%s actions',  __d('scaffold_specific',  $singularHumanName)),  '#',  array('id' => 'toggle-'.strtolower($singularVar).'-actions', 'escape' => false));
            echo '</p>';
        echo '</div>';
        echo '<div id="'.strtolower($singularVar).'-actions" class="block">';
            echo '<ul class="menu '.strtolower($singularVar).'-actions-menu '.strtolower($singularVar).'-actions-menu">';
                echo '<li class="action '.strtolower($singularVar).'-action '.strtolower($singularVar).'-edit">';
                    echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'Edit %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'edit',  ${$singularVar}[$modelClass][$primaryKey]),  array('escape' => false));
                echo '</li>';
                echo '<li class="action '.strtolower($singularVar).'-action '.strtolower($singularVar).'-delete">';
                    echo $this->Form->postLink('<span class="icon"></span>'.__d('scaffold',  'Delete %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'delete',  $this->Form->value($modelClass.'.'.$primaryKey)),  array('escape' => false),  __d('scaffold',  'Are you sure you want to delete #%s', $this->Form->value($modelClass.'.'.$primaryKey)));
                echo '</li>';
            echo '</ul>';
        echo '</div>';
    echo '</div>';

    if (!empty($associations['hasOne'])) {
        foreach ($associations['hasOne'] as $_alias => $_details) {
            echo '<div class="box '.strtolower($pluralVar).' related '.strtolower($pluralVar).'-related '.strtolower($pluralVar).'-related-'.Inflector::singularize($_details['controller']).'">';
                echo '<div class="box-title">';
                    echo '<p>';
                        echo $this->Html->link(__d('scaffold',  'Related %s',  __d('scaffold_specific',  Inflector::humanize(Inflector::singularize($_details['controller'])))),  '#',  array('id' => 'toggle-'.strtolower($pluralVar).'-related-'.Inflector::singularize($_details['controller']), 'escape' => false));
                    echo '</p>';
                echo '</div>';
                echo '<div id="'.strtolower($pluralVar).'-related-'.Inflector::singularize($_details['controller']).'" class="block">';
                if (isset(${$singularVar}[$_alias]) && is_array(${$singularVar}[$_alias]) && count(array_filter(${$singularVar}[$_alias]))) {
                    $otherFields = array_keys(${$singularVar}[$_alias]);
                    foreach ($otherFields as $_field) {
                        echo '<p>';
                            echo '<span class="data-title">';
                                echo __d('scaffold_specific',  Inflector::humanize($_field));
                                echo '&nbsp;:&nbsp;';
                            echo '</span>';
                            $isKey = false;
                            if (preg_match('#^([a-z]+)_id$#', $_field)) {
                                $isKey = true;
                                echo $this->Html->link(h(${$singularVar}[$_alias][$_field], 'UTF-8'),  array('controller' => Inflector::pluralize(rtrim($_field, '_id')),  'action' => 'view',  ${$singularVar}[$_alias][$_field]),  array('escape' => false));
                            }
                            if ($isKey  !==  true) {
                                if (gettype(${$singularVar}[$_alias][$_field]) == 'boolean') {
                                    if (${$singularVar}[$_alias][$_field]) {
                                        echo __d('scaffold',  'Yes');
                                    } else {
                                        echo __d('scaffold',  'No');
                                    }
                                } else {
                                    if (isset($_details['primaryKey']) && isset($_details['displayField'])  &&  $_details['displayField']  == = $_field  &&  !is_numeric(${$singularVar}[$_alias][$_field])) {
                                        echo $this->Html->link(${$singularVar}[$_alias][$_field],  array('controller' => $_details['controller'],  'action' => 'view',  ${$singularVar}[$_alias][$_details['primaryKey']],  Inflector::slug(strtolower(${$singularVar}[$_alias][$_field]), '-')),  array('escape' => false));
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
                                                    echo h(${$singularVar}[$_alias][$_field], 'UTF-8');
                                                echo '</span>';
                                        }
                                    }
                                }
                            }
                        echo '</p>';
                    }
                } else {
                    echo '<p>';
                        echo __d('scaffold',  'No related %s',  __d('scaffold_specific',  strtolower(Inflector::humanize(Inflector::singularize($_details['controller'])))));
                    echo '</p>';
                }
                echo '</div>';
            echo '</div>';
        }
    }
echo '</div>';

if (!empty($relations)) {
    echo '<div class="grid_8">';
        foreach ($relations as $_alias => $_details) {
            $otherSingularVar = Inflector::variable($_alias);
            echo '<div class="box '.strtolower($pluralVar).' related '.strtolower($pluralVar).'-related '.strtolower($pluralVar).'-related-'.$_details['controller'].' datas">';
                echo '<div class="box-title">';
                    echo '<p>';
                        echo $this->Html->link(__d('scaffold',  'Related %s',  __d('scaffold_specific',  Inflector::humanize($_details['controller']))),  '#',  array('id' => 'toggle-'.strtolower($pluralVar).'-related-'.$_details['controller'], 'escape' => false));
                    echo '</p>';
                echo '</div>';
                echo '<div id="'.strtolower($pluralVar).'-related-'.$_details['controller'].'" class="block">';
                    if (isset(${$singularVar}[$_alias]) && is_array(${$singularVar}[$_alias]) && count(array_filter(${$singularVar}[$_alias]))) {
                        $otherFields = array_keys(${$singularVar}[$_alias][0]);
                        if (isset($_details['with'])) {
                            $index = array_search($_details['with'],  $otherFields);
                            unset($otherFields[$index]);
                        }
                        $class = '    first';
                        foreach (${$singularVar}[$_alias] as ${$otherSingularVar}) {
                            echo '<div class="'.strtolower($otherSingularVar).' data '.$class.'">';
                                echo '<div class="grid_6">';
                                    echo '<div class="box fields '.strtolower($otherSingularVar).'-fields">';
                                        echo '<div id="'.strtolower($otherSingularVar).'-fields-'.${$otherSingularVar}[$_details['primaryKey']].'" class="block">';
                                            foreach ($otherFields as $_field) {
                                                echo '<p>';
                                                    echo '<span class="data-title">';
                                                        echo __d('scaffold_specific',  Inflector::humanize($_field));
                                                        echo '&nbsp;:&nbsp;';
                                                    echo '</span>';
                                                    $isKey = false;
                                                    if (preg_match('#^([a-z]+)_id$#', $_field)) {
                                                        $isKey = true;
                                                        echo $this->Html->link(${$otherSingularVar}[$_field],  array('controller' => Inflector::pluralize(rtrim($_field, '_id')),  'action' => 'view',  ${$otherSingularVar}[$_field]),  array('escape' => false));
                                                    }
                                                    if ($isKey  !==  true) {
                                                        if (gettype(${$otherSingularVar}[$_field]) == 'boolean') {
                                                            if (${$otherSingularVar}[$_field]) {
                                                                echo __d('scaffold',  'Yes');
                                                            } else {
                                                                echo __d('scaffold',  'No');
                                                            }
                                                        } else {
                                                            if (isset($_details['primaryKey'])  &&  isset($_details['displayField'])  &&  $_details['displayField']  == = $_field  &&  !is_numeric(${$otherSingularVar}[$_field])) {
                                                                echo $this->Html->link(h(${$otherSingularVar}[$_field], 'UTF-8'),  array('controller' => Inflector::pluralize($otherSingularVar),  'action' => 'view',  ${$otherSingularVar}[$_details['primaryKey']],  Inflector::slug(strtolower(${$otherSingularVar}[$_field]), '-')),  array('escape' => false));
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
                                                                            echo h(${$otherSingularVar}[$_field], 'UTF-8');
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
                                    echo '<div class="box related '.strtolower($otherSingularVar).'-related">';
                                        echo '<div id="'.strtolower($otherSingularVar).'-related-'.${$otherSingularVar}[$_details['primaryKey']].'" class="block">';
                                            echo '<p>&nbsp;</p>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="grid_4">';
                                    echo '<div class="box actions '.strtolower($otherSingularVar).'-actions">';
                                        echo '<div id="'.strtolower($otherSingularVar).'-actions-'.${$otherSingularVar}[$_details['primaryKey']].'" class="block">';
                                            echo '<ul>';
                                                echo '<li class="action '.strtolower($otherSingularVar).'-action '.Inflector::pluralize($otherSingularVar).'-view">';
                                                    if (isset($_details['primaryKey']) && isset($_details['displayField'])) {
                                                        if ($_details['displayField']  == = $_field  &&  !is_numeric(${$otherSingularVar}[$_field])) {
                                                            echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'View %s', __d('scaffold_specific',  strtolower($otherSingularVar))),  array('controller' => Inflector::pluralize($otherSingularVar),  'action' => 'view',  ${$otherSingularVar}[$_details['primaryKey']],  Inflector::slug(strtolower(${$otherSingularVar}[$_field]), '-')),  array('escape' => false));
                                                        } else {
                                                            echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'View %s', __d('scaffold_specific',  strtolower($otherSingularVar))),  array('controller' => Inflector::pluralize($otherSingularVar),  'action' => 'view',  ${$otherSingularVar}[$_details['primaryKey']]), array('escape' => false));
                                                        }
                                                    } else {
                                                        echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'View %s',  __d('scaffold_specific',  strtolower($otherSingularVar))),  array('controller' => Inflector::pluralize($otherSingularVar),  'action' => 'view',  ${$otherSingularVar}[$_details['primaryKey']]), array('escape' => false));
                                                    }
                                                echo '</li>';
                                                echo '<li class="action '.strtolower($otherSingularVar).'-action '.Inflector::pluralize($otherSingularVar).'-edit">';
                                                    echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'Edit %s',  __d('scaffold_specific',  strtolower($otherSingularVar))),  array('controller' => Inflector::pluralize($otherSingularVar),  'action' => 'edit',  ${$otherSingularVar}[$_details['primaryKey']]), array('escape' => false));
                                                echo '</li>';
                                                echo '<li class="action '.strtolower($otherSingularVar).'-action '.Inflector::pluralize($otherSingularVar).'-delete">';
                                                    echo $this->Form->postLink('<span class="icon"></span>'.__d('scaffold',  'Delete %s',  __d('scaffold_specific',  strtolower($otherSingularVar))),  array('controller' => Inflector::pluralize($otherSingularVar),  'action' => 'delete',  ${$otherSingularVar}[$_details['primaryKey']]),  array('escape' => false),  __d('scaffold',  'Are you sure you want to delete #%s', ${$otherSingularVar}[$_details['primaryKey']]));
                                                echo '</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="clear"></div>';
                            $class = null;
                        }
                    } else {
                        echo '<div class="address data first">';
                            echo '<p>';
                                echo __d('scaffold',  'No related %s',  __d('scaffold_specific',  strtolower(Inflector::humanize(Inflector::singularize($_details['controller'])))));
                            echo '</p>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        }
    echo '</div>';
}

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
                        echo '<li class="action '.strtolower($pluralVar).'-action '.strtolower($pluralVar).'-index">';
                            echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'List %s',  __d('scaffold_specific',  strtolower($pluralHumanName))),  array('controller' => $pluralVar,  'action' => 'index'),  array('escape' => false));
                        echo '</li>';
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
echo '</div>';
?>