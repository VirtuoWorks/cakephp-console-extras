<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

 /**
 * Available bake vars :
 * $plugin, $admin, $controllerPath, $pluralName, $singularName, $singularHumanName, $pluralHumanName, $modelObj, $wannaUseSession, $currentModelName, $displayField, $primaryKey
 */
?>

/**
 * <?php echo $admin; ?>index method
 *
 * @return void
 */
  public function <?php echo $admin; ?>index() {
    $this->Paginator->settings = array(
      '<?php echo $currentModelName ?>' => array(
        'limit' => 10,
        'maxLimit' => 50
     )
   );
    $this-><?php echo $currentModelName ?>->recursive = 1;
    $<?php echo strtolower($pluralName); ?> = $this->Paginator->paginate('<?php echo $currentModelName; ?>');
    $this->set('<?php echo $pluralName ?>', $<?php echo strtolower($pluralName); ?>);
  }

/**
 * <?php echo $admin; ?>view method
 *
 * @param string $id
 * @return void
 */
  public function <?php echo $admin; ?>view($<?php echo strtolower($singularName); ?>_id = null) {
    if (isset($<?php echo strtolower($singularName); ?>_id) && is_numeric($<?php echo strtolower($singularName); ?>_id)) {
      $this-><?php echo $currentModelName; ?>->id = $<?php echo strtolower($singularName); ?>_id;
      if ($this-><?php echo $currentModelName; ?>->exists()) {
        $<?php echo strtolower($singularName); ?> = $this-><?php echo $currentModelName; ?>->read(null, $<?php echo strtolower($singularName); ?>_id);
        $this->set('<?php echo $singularName; ?>', $<?php echo strtolower($singularName); ?>);
      } else {
        throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
      }
    } else {
      throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
    }
  }

<?php $compact = array(); ?>
/**
 * <?php echo $admin; ?>add method
 *
 * @return void
 */
  public function <?php echo $admin; ?>add() {
    if ($this->request->is('post')) {
      if (isset($this->request->data) && is_array($this->request->data) && count($this->request->data)>0) {
        $this-><?php echo $currentModelName; ?>->create();
        if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
          $<?php echo strtolower($singularName); ?>_id = $this-><?php echo $currentModelName; ?>->getLastInsertID();
          if (isset($<?php echo strtolower($singularName); ?>_id) && is_numeric($<?php echo strtolower($singularName); ?>_id)) {
<?php if ($wannaUseSession) : ?>
            $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), 'default', array('class' => 'error'));
            $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => 'view', $<?php echo strtolower($singularName); ?>_id));
            exit();
<?php else : ?>
            $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('controller' => '<?php echo $pluralName ?>', 'action' => 'view', $<?php echo strtolower($singularName); ?>_id));
<?php endif; ?>
          } else {
<?php if ($wannaUseSession) : ?>
            $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), 'default', array('class' => 'message'));
            $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => 'index'));
            exit();
<?php else : ?>
            $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('controller' => '<?php echo $pluralName ?>', 'action' => 'index'));
<?php endif; ?>
          }
        } else {
<?php if ($wannaUseSession) : ?>
          $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'default', array('class' => 'error'));
<?php endif; ?>
        }
      } else {
<?php if ($wannaUseSession) : ?>
        $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'default', array('class' => 'error'));
<?php endif; ?>
      }
    }
<?php
  foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc) :
    foreach ($modelObj->{$assoc} as $associationName => $relation) :
      if (!empty($associationName)) :
        $otherModelName = $this->_modelName($associationName);
        $otherPluralName = $this->_pluralName($associationName);
        echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
        $compact[] = "'{$otherPluralName}'";
      endif;
    endforeach;
  endforeach;
  if (!empty($compact)) :
    echo "\t\t\$this->set(compact(" . join(', ', $compact) . "));\n";
  endif;
?>
  }

<?php $compact = array(); ?>
/**
 * <?php echo $admin; ?>edit method
 *
 * @param string $id
 * @return void
 */
  public function <?php echo $admin; ?>edit($<?php echo strtolower($singularName); ?>_id = null) {
    if (isset($<?php echo strtolower($singularName); ?>_id) && is_numeric($<?php echo strtolower($singularName); ?>_id)) {
      $this-><?php echo $currentModelName; ?>->id = $<?php echo strtolower($singularName); ?>_id;
      if ($this-><?php echo $currentModelName; ?>->exists()) {
        $<?php echo strtolower($singularName); ?> = $this-><?php echo $currentModelName; ?>->read(null, $<?php echo strtolower($singularName); ?>_id);
        if ($this->request->is('post')||$this->request->is('put')) {
          if (isset($this->request->data) && is_array($this->request->data) && count($this->request->data)>0) {
            if (isset($this->request->data['<?php echo $currentModelName; ?>']) && isset($this->request->data['<?php echo $currentModelName; ?>']['id']) && ($this->request->data['<?php echo $currentModelName; ?>']['id'] == $<?php echo strtolower($singularName); ?>_id)) {
              if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession) : ?>
                $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'));
                $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => 'view', $<?php echo strtolower($singularName); ?>_id));
                exit();
<?php else : ?>
                $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('controller' => '<?php echo $pluralName ?>', 'action' => 'view', $<?php echo strtolower($singularName); ?>_id));
<?php endif; ?>
              } else {
<?php if ($wannaUseSession) : ?>
                $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'default', array('class' => 'error'));
<?php endif; ?>
              }
            } else {
<?php if ($wannaUseSession) : ?>
              $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'default', array('class' => 'error'));
<?php endif; ?>
            }
          } else {
<?php if ($wannaUseSession) : ?>
            $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'default', array('class' => 'error'));
<?php endif; ?>
          }
        }
        $this->request->data = $<?php echo strtolower($singularName); ?>;
<?php
    foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc) :
      foreach ($modelObj->{$assoc} as $associationName => $relation) :
        if (!empty($associationName)) :
          $otherModelName = $this->_modelName($associationName);
          $otherPluralName = $this->_pluralName($associationName);
          echo "\t\t\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
          $compact[] = "'{$otherPluralName}'";
        endif;
      endforeach;
    endforeach;
    if (!empty($compact)) :
      echo "\t\t\t\t\$this->set(compact(" . join(', ', $compact) . "));\n";
    endif;
?>
      } else {
        throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
      }
    } else {
      throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
    }
  }

/**
 * <?php echo $admin; ?>delete method
 *
 * @param string $id
 * @return void
 */
  public function <?php echo $admin; ?>delete($<?php echo strtolower($singularName); ?>_id = null) {
    if ($this->request->is('post')) {
      if (isset($<?php echo strtolower($singularName); ?>_id) && is_numeric($<?php echo strtolower($singularName); ?>_id)) {
        $this-><?php echo $currentModelName; ?>->id = $<?php echo strtolower($singularName); ?>_id;
        if ($this-><?php echo $currentModelName; ?>->exists()) {
          if ($this-><?php echo $currentModelName; ?>->delete()) {
<?php if ($wannaUseSession) : ?>
            $this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted.'), 'default', array('class' => 'message'));
            $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => 'index'));
            exit();
<?php else : ?>
            $this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted.'), array('controller' => '<?php echo $pluralName ?>', 'action' => 'index'));
<?php endif; ?>
          } else {
<?php if ($wannaUseSession) : ?>
            $this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> was not deleted.'), 'default', array('class' => 'error'));
            $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => 'index'));
            exit();
<?php else : ?>
            $this->flash(__('The <?php echo strtolower($singularHumanName); ?> was not deleted.'), array('controller' => '<?php echo $pluralName ?>', 'action' => 'index'));
<?php endif; ?>
          }
        } else {
          throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
        }
      } else {
        throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
      }
    } else {
      throw new MethodNotAllowedException();
    }
  }
<?php
    foreach ($modelObj->{$assoc} as $associationName => $relation) :
      if (!empty($associationName)) :
        $otherModelName = $this->_modelName($associationName);
        $otherPluralName = $this->_pluralName($associationName);
?>

/**
 * <?php echo $admin; ?>related<?php echo strtolower($associationName); ?> method
 *
 * @param string $id
 * @return void
 */
  public function <?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>($<?php echo $relation['foreignKey']; ?> = null) {
    if (isset($<?php echo $relation['foreignKey']; ?>) && is_numeric($<?php echo $relation['foreignKey']; ?>)) {
      $this-><?php echo $currentModelName; ?>->id = $<?php echo $relation['foreignKey']; ?>;
      if ($this-><?php echo $currentModelName; ?>->exists()) {
        $this->Paginator->settings = array(
          '<?php echo $otherModelName; ?>' => array(
            'limit' => 10,
            'maxLimit' => 50,
            'joins' => array(
              array(
                'table' => '<?php echo $relation['joinTable']; ?>', 
                'alias' => '<?php echo $relation['with']; ?>', 
                'type' => 'inner',  
                'conditions'=> array(
                  '<?php echo $relation['with']; ?>.<?php echo $relation['associationForeignKey']; ?> = <?php echo $otherModelName; ?>.id',
               ),
             ),array(
                'table' => '<?php echo $pluralName; ?>',
                'alias' => '<?php echo $currentModelName; ?>', 
                'type' => 'inner',  
                'conditions'=> array(
                  '<?php echo $currentModelName; ?>.id = <?php echo $relation['with']; ?>.<?php echo $relation['foreignKey']; ?>', 
                  '<?php echo $currentModelName; ?>.id' => $<?php echo $relation['foreignKey']; ?> 
               )
             )
           )
         )
       );
        $<?php echo strtolower($otherPluralName); ?> = $this->Paginator->paginate('<?php echo $currentModelName; ?>.<?php echo $otherModelName; ?>');
        $this->set('<?php echo $otherPluralName; ?>', $<?php echo strtolower($otherPluralName); ?>);
      } else {
        throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
      }
    } else {
      throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
    }
  }

/**
 * <?php echo $admin; ?>addto<?php echo strtolower($associationName); ?> method
 *
 * @param string $id
 * @return void
 */
  public function <?php echo $admin; ?>addto<?php echo strtolower($associationName); ?>($<?php echo $relation['foreignKey']; ?> = null, $<?php echo $relation['associationForeignKey']; ?> = null) {
    if ($this->request->is('post')) {
      if (isset($<?php echo $relation['foreignKey']; ?>) && is_numeric($<?php echo $relation['foreignKey']; ?>)) {
        if (isset($<?php echo $relation['associationForeignKey']; ?>) && is_numeric($<?php echo $relation['associationForeignKey']; ?>)) {
          $this-><?php echo $currentModelName; ?>->id = $<?php echo $relation['foreignKey']; ?>;
          if ($this-><?php echo $currentModelName; ?>->exists()) {
            $this-><?php echo $currentModelName; ?>-><?php echo $otherModelName; ?>->id = $<?php echo $relation['associationForeignKey']; ?>;
            if ($this-><?php echo $currentModelName; ?>-><?php echo $otherModelName; ?>->exists()) {
              $data = $this-><?php echo $currentModelName; ?>-><?php echo $relation['with']; ?>->find('all',array(
                  'fields' => array(
                    '<?php echo $relation['with']; ?>.id'
                 ),
                  'conditions' => array(
                    '<?php echo $relation['with']; ?>.<?php echo $relation['foreignKey']; ?>' => $<?php echo $relation['foreignKey']; ?>,
                    '<?php echo $relation['with']; ?>.<?php echo $relation['associationForeignKey']; ?>' => $<?php echo $relation['associationForeignKey']; ?> 
                 )
               ));
              if (empty($data)) {
                $data = array(
                  '<?php echo $relation['with']; ?>' => array(
                    '<?php echo $relation['foreignKey']; ?>' => $<?php echo $relation['foreignKey']; ?>,
                    '<?php echo $relation['associationForeignKey']; ?>' => $<?php echo $relation['associationForeignKey']; ?> 
                 )
               );
                $this-><?php echo $currentModelName; ?>-><?php echo $relation['with']; ?>->create();
                if ($this-><?php echo $currentModelName; ?>-><?php echo $relation['with']; ?>->save($data)) {
<?php if ($wannaUseSession) : ?>
                  $this->Session->setFlash(__('Relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> has been saved.'), 'default', array('class' => 'message'));
                  $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
                  exit();
<?php else : ?>
                  $this->flash(__('Relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> has been saved.'), array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
<?php endif; ?>
                } else {
<?php if ($wannaUseSession) : ?>
                  $this->Session->setFlash(__('The relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> could not be saved. Please, try again.'), 'default', array('class' => 'error'));
                  $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
                  exit();
<?php else : ?>
                  $this->flash(__('The relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> could not be saved. Please, try again.'), array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
<?php endif; ?>
                }
              } else {
<?php if ($wannaUseSession) : ?>
                $this->Session->setFlash(__('Relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> has been saved.'), 'default', array('class' => 'message'));
                $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
                exit();
<?php else : ?>
                $this->flash(__('Relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> has been saved.'), array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
<?php endif; ?>
              }
            } else {
              throw new NotFoundException(__('Invalid <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?>.'));
            }
          } else {
            throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
          }
        } else {
          throw new NotFoundException(__('Invalid <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?>.'));
        }
      } else {
        throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
      }
    } else {
      throw new MethodNotAllowedException();
    }
  }

/**
 * <?php echo $admin; ?>removefrom<?php echo strtolower($associationName); ?> method
 *
 * @param string $id
 * @return void
 */
  public function <?php echo $admin; ?>removefrom<?php echo strtolower($associationName); ?>($<?php echo $relation['foreignKey']; ?> = null, $<?php echo $relation['associationForeignKey']; ?> = null) {
    if ($this->request->is('post')) {
      if (isset($<?php echo $relation['foreignKey']; ?>) && is_numeric($<?php echo $relation['foreignKey']; ?>)) {
        if (isset($<?php echo $relation['associationForeignKey']; ?>) && is_numeric($<?php echo $relation['associationForeignKey']; ?>)) {
          $this-><?php echo $currentModelName; ?>->id = $<?php echo $relation['foreignKey']; ?>;
          if ($this-><?php echo $currentModelName; ?>->exists()) {
            $this-><?php echo $currentModelName; ?>-><?php echo $otherModelName; ?>->id = $<?php echo $relation['associationForeignKey']; ?>;
            if ($this-><?php echo $currentModelName; ?>-><?php echo $otherModelName; ?>->exists()) {
              $data = $this-><?php echo $currentModelName; ?>-><?php echo $relation['with']; ?>->find('all',array(
                  'fields' => array(
                    '<?php echo $relation['with']; ?>.id'
                 ),
                  'conditions' => array(
                    '<?php echo $relation['with']; ?>.<?php echo $relation['foreignKey']; ?>' => $<?php echo $relation['foreignKey']; ?>,
                    '<?php echo $relation['with']; ?>.<?php echo $relation['associationForeignKey']; ?>' => $<?php echo $relation['associationForeignKey']; ?> 
                 )
               ));
              if (empty($data)) {
<?php if ($wannaUseSession) : ?>
                $this->Session->setFlash(__('Relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> deleted.'));
                $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
                exit();
<?php else : ?>
                $this->flash(__('Relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> deleted.'), array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
<?php endif; ?>
              } else {
                $this-><?php echo $currentModelName; ?>-><?php echo $relation['with']; ?>->id = $data['<?php echo $relation['with']; ?>']['id'];
                if ($this-><?php echo $currentModelName; ?>-><?php echo $relation['with']; ?>->delete()) {
<?php if ($wannaUseSession) : ?>
                  $this->Session->setFlash(__('Relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> deleted.'), 'default', array('class' => 'message'));
                  $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
                  exit();
<?php else : ?>
                  $this->flash(__('Relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> deleted.'), array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
<?php endif; ?>
                } else {
<?php if ($wannaUseSession) : ?>
                  $this->Session->setFlash(__('The relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> was not deleted.'), 'default', array('class' => 'error'));
                  $this->redirect(array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
                  exit();
<?php else : ?>
                  $this->flash(__('The relation between <?php echo strtolower($singularHumanName); ?> and <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?> was not deleted.'), array('controller' => '<?php echo $pluralName ?>', 'action' => '<?php echo $admin; ?>related<?php echo strtolower($otherPluralName); ?>', $<?php echo $relation['foreignKey']; ?>));
<?php endif; ?>
                }
              }
            } else {
              throw new NotFoundException(__('Invalid <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?>.'));
            }
          } else {
            throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
          }
        } else {
          throw new NotFoundException(__('Invalid <?php echo strtolower(Inflector::humanize(Inflector::underscore($relation['className']))); ?>.'));
        }
      } else {
        throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>.'));
      }
    } else {
      throw new MethodNotAllowedException();
    }
  }
<?php
      endif;
    endforeach;
?>