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
$grid = 12;
if ($this->action!='add') {
    $grid = 8;
    echo '<div class="grid_4">';
        echo '<div class="box view-actions '.strtolower($singularVar).'-view-actions">';
            echo '<div class="box-title">';
                echo '<p>';
                    echo $this->Html->link(__d('scaffold',  '%s actions',  __d('scaffold_specific',  $singularHumanName)),  '#',  array('id' => 'toggle-'.strtolower($singularVar).'-actions', 'escape' => false));
                echo '</p>';
            echo '</div>';
            echo '<div id="'.strtolower($singularVar).'-actions" class="block">';
                echo '<ul class="menu '.strtolower($singularVar).'-actions-menu '.strtolower($singularVar).'-actions-menu">';
                    echo '<li class="action '.strtolower($singularVar).'-action '.strtolower($singularVar).'-edit">';
                        echo $this->Html->link('<span class="icon"></span>'.__d('scaffold',  'View %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'view',  $this->Form->value($modelClass.'.'.$primaryKey)),  array('escape' => false));
                    echo '</li>';
                    echo '<li class="action '.strtolower($singularVar).'-action '.strtolower($singularVar).'-delete">';
                        echo $this->Form->postLink('<span class="icon"></span>'.__d('scaffold',  'Delete %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  array('controller' => $pluralVar,  'action' => 'delete',  $this->Form->value($modelClass.'.'.$primaryKey)),  array('escape' => false),  __d('scaffold',  'Are you sure you want to delete #%s',  $this->Form->value($modelClass.'.'.$primaryKey)));
                    echo '</li>';
                echo '</ul>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}

echo '<div class="grid_'.$grid.'">';
    echo '<div class="box '.strtolower($pluralVar).' form '.strtolower($pluralVar).'-form '.strtolower($pluralVar).'-'.$this->action.'-form">';
        echo '<div class="box-title">';
            echo '<p>';
                if ($this->action  ==  'add') {
                    echo $this->Html->link(__d('scaffold',  'Add %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  '#',  array('id' => 'toggle-'.strtolower($pluralVar).'-'.$this->action.'-form', 'escape' => false));
                } else {
                    if ($this->action  ==  'edit') {
                        echo $this->Html->link(__d('scaffold',  'Edit %s',  __d('scaffold_specific',  strtolower($singularHumanName))),  '#',  array('id' => 'toggle-'.strtolower($pluralVar).'-'.$this->action.'-form', 'escape' => false));
                    } else {
                        echo '&nbsp;';
                    }
                }
            echo '</p>';
        echo '</div>';
        echo '<div id="'.strtolower($pluralVar).'-'.$this->action.'-form" class="block">';
            echo $this->Form->create();
            //echo $this->Form->inputs($scaffoldFields,  array('created',  'modified',  'updated'));
            echo '<fieldset>';
                switch($this->action) {
                    case 'add':
                        echo '<legend>';
                            echo __d('scaffold',  'New %s',  __d('scaffold_specific',  strtolower($singularHumanName)));
                        echo '</legend>';
                    break;
                    case 'edit':
                        echo '<legend>';
                            echo __d('scaffold',  'Edit %s',  __d('scaffold_specific',  strtolower($singularHumanName)));
                        echo '</legend>';
                    break;
                    default:
                }
                foreach ($scaffoldFields as $_field) {
                    if (!in_array($_field,  array('created',  'modified',  'updated'))) {
                        $options = array(
                            'label' => __d('scaffold_specific',     Inflector::humanize($_field)) , 
                            'dateFormat' => 'DMY', 
                            'timeFormat' => 24, 
                            'empty' => true
                       );
                        if (in_array($_field,  array('password'))) {
                            $options['value'] = '';
                        }
                        echo $this->Form->input($_field,  $options);
                        unset($options);
                    }
                }
            echo '</fieldset>';
            switch($this->action) {
                case 'add':
                    echo $this->Form->end(__d('scaffold',  'Create %s',  __d('scaffold_specific',  strtolower($singularHumanName))));
                break;
                case 'edit':
                    echo $this->Form->end(__d('scaffold',  'Save %s',  __d('scaffold_specific',  strtolower($singularHumanName))));
                break;
                default:
                    echo $this->Form->end(__d('scaffold',  'Submit'));
            }
        echo '</div>';
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