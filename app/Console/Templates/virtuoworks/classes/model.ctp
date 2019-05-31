<?php
/**
 * Model template file.
 *
 * Used by bake to create new Model files.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright         Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link                    http://cakephp.org CakePHP(tm) Project
 * @package             Cake.Console.Templates.default.classes
 * @since                 CakePHP(tm) v 1.3
 * @license             MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

 /**
 * Available bake vars :
 * $name, $associations, $validate, $primaryKey, $useTable, $useDbConfig, $displayField, $plugin, $pluginPath
 */
if (is_file(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'utilities'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'VirtuoWorksCakeBakeModelUtilities.php')) {
    require_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'utilities'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'VirtuoWorksCakeBakeModelUtilities.php');
}
echo "<?php\n";
echo "App::uses('{$plugin}AppModel', '{$pluginPath}Model');\n";
?>
/**
 * <?php echo $name ?> Model
 *
<?php
foreach (array('hasOne', 'belongsTo', 'hasMany', 'hasAndBelongsToMany') as $assocType) {
    if (!empty($associations[$assocType])) {
        foreach ($associations[$assocType] as $relation) {
            echo " * @property {$relation['className']} \${$relation['alias']}\n";
        }
    }
}
?>
 */
class <?php echo $name ?> extends <?php echo $plugin; ?>AppModel {

/**
 * ContainableBehavior
 *
 * @var array
 */
    public $actsAs = array('Containable');

<?php if ($useDbConfig != 'default') : ?>
/**
 * Use database config
 *
 * @var string
 */
    public $useDbConfig = '<?php echo $useDbConfig; ?>';

<?php endif; ?>
<?php if ($useTable  &&  $useTable  !==  Inflector::tableize($name)) :
    $table = "'$useTable'";
    echo "/**\n * Use table\n *\n * @var mixed False or table name\n */\n";
    echo "\tpublic \$useTable = $table;\n";
endif;
if ($primaryKey  !==  'id') : ?>
/**
 * Primary key field
 *
 * @var string
 */
    public $primaryKey = '<?php echo $primaryKey; ?>';

<?php endif;
if ($displayField) : ?>
/**
 * Display field
 *
 * @var string
 */
    public $displayField = '<?php echo $displayField; ?>';

<?php endif;
if (!empty($validate)) : ?>
/**
 * Validation domain (for i18n)
 *
 * @var string
 */
<?php
    echo "\tpublic \$validationDomain = '" . strtolower($name) . "_validation';\n\n";
    echo "/**\n * Validation rules\n *\n * @var array\n */\n";
    echo "\tpublic \$validate = array(\n";
    foreach ($validate as $field => $validations) :
        echo "\t\t'$field' => array(\n";
        if (class_exists('VirtuoWorksCakeBakeModelUtilities')) {
            foreach ($validations as $key => $validator) :
                $rule = VirtuoWorksCakeBakeModelUtilities::getRulesParsedMessages($key, $field);
                if (isset($rule) && is_array($rule) && count($rule)) {
                    echo "\t\t\t" . implode("\n\t\t\t\t", $rule) . "\n";
                } else {
                    echo "\t\t\t'$key' => array(\n";
                    echo "\t\t\t\t'rule' => array('$validator'),\n";
                    echo "\t\t\t\t//'message' => 'Your custom message here',\n";
                }
                echo "\t\t\t\t//'allowEmpty' => false,\n";
                echo "\t\t\t\t//'required' => false,\n";
                echo "\t\t\t\t//'last' => false, // Stop validation after this rule\n";
                echo "\t\t\t\t//'on' => 'create', // Limit validation to 'create' or 'update' operations\n";
                echo "\t\t\t),\n";
            endforeach;
        } else {
            foreach ($validations as $key => $validator) :
                switch(strtolower($key)) {
                    case 'alphanumeric':
                        //Validation::alphaNumeric (staticmethod, in Data Validation)
                        echo "\t\t\t'alphaNumeric' => array(\n";
                        echo "\t\t\t\t'rule' => array('alphaNumeric'),\n";
                    break;
                    case 'equalto':
                        //Validation::equalTo (staticmethod, in Data Validation)
                        echo "\t\t\t'equalTo' => array(\n";
                        echo "\t\t\t\t'rule' => array('equalTo'),\n";
                    break;
                    case 'isunique':
                        //Validation::isUnique (staticmethod, in Data Validation)
                        echo "\t\t\t'isUnique' => array(\n";
                        echo "\t\t\t\t'rule' => array('isUnique'),\n";
                    break;
                    case 'minlength':
                        //Validation::minLength (staticmethod, in Data Validation)
                        echo "\t\t\t'minLength' => array(\n";
                        echo "\t\t\t\t'rule' => array('minLength'),\n";
                    break;
                    case 'maxlength':
                        //Validation::maxLength (staticmethod, in Data Validation)
                        echo "\t\t\t'maxLength' => array(\n";
                        echo "\t\t\t\t'rule' => array('maxLength'),\n";
                    break;
                    case 'inlist':
                        //Validation::inList (staticmethod, in Data Validation)
                        echo "\t\t\t'inList' => array(\n";
                        echo "\t\t\t\t'rule' => array('inList'),\n";
                    break;
                    case 'notempty':
                        //Validation::notEmpty (staticmethod, in Data Validation)
                        echo "\t\t\t'notEmpty' => array(\n";
                        echo "\t\t\t\t'rule' => array('notEmpty'),\n";
                    break;
                    case 'userdefined':
                        //Validation::userDefined (staticmethod, in Data Validation)
                        echo "\t\t\t'userDefined' => array(\n";
                        echo "\t\t\t\t'rule' => array('userDefined'),\n";
                    default:
                        echo "\t\t\t'$key' => array(\n";
                        echo "\t\t\t\t'rule' => array('$validator'),\n";
                }
                echo "\t\t\t\t//'message' => 'Your custom message here',\n";
                echo "\t\t\t\t//'allowEmpty' => false,\n";
                echo "\t\t\t\t//'required' => false,\n";
                echo "\t\t\t\t//'last' => false, // Stop validation after this rule\n";
                echo "\t\t\t\t//'on' => 'create', // Limit validation to 'create' or 'update' operations\n";
                echo "\t\t\t),\n";
            endforeach;
        }
        echo "\t\t),\n";
    endforeach;
    echo "\t);\n";
endif;

foreach ($associations as $assoc) :
    if (!empty($assoc)) :
?>

    //The Associations below have been created with all possible keys, those that are not needed can be removed
<?php
        break;
    endif;
endforeach;

foreach (array('hasOne', 'belongsTo') as $assocType) :
    if (!empty($associations[$assocType])) :
        $typeCount = count($associations[$assocType]);
        echo "\n/**\n * $assocType associations\n *\n * @var array\n */";
        echo "\n\tpublic \$$assocType = array(";
        foreach ($associations[$assocType] as $i => $relation) :
            $out = "\n\t\t'{$relation['alias']}' => array(\n";
            $out  .= "\t\t\t'className' => '{$relation['className']}',\n";
            $out  .= "\t\t\t'foreignKey' => '{$relation['foreignKey']}',\n";
            if ($assocType  ==  'hasOne') :
                $out  .= "\t\t\t'dependent' => false,\n";
            endif;
            $out  .= "\t\t\t'conditions' => '',\n";
            $out  .= "\t\t\t'fields' => '',\n";
            if ($assocType  ==  'belongsTo') :
                $out  .= "\t\t\t'type' => 'left',\n";
                $out  .= "\t\t\t'counterCache' => false,\n";
                $out  .= "\t\t\t'counterScope' => array(),\n";
            endif;
            $out  .= "\t\t\t'order' => ''\n";
            $out  .= "\t\t)";
            if ($i + 1 < $typeCount) {
                $out  .= ",";
            }
            echo $out;
        endforeach;
        echo "\n\t);\n";
    endif;
endforeach;

if (!empty($associations['hasMany'])) :
    $belongsToCount = count($associations['hasMany']);
    echo "\n/**\n * hasMany associations\n *\n * @var array\n */";
    echo "\n\tpublic \$hasMany = array(";
    foreach ($associations['hasMany'] as $i => $relation) :
        $out = "\n\t\t'{$relation['alias']}' => array(\n";
        $out  .= "\t\t\t'className' => '{$relation['className']}',\n";
        $out  .= "\t\t\t'foreignKey' => '{$relation['foreignKey']}',\n";
        $out  .= "\t\t\t'dependent' => false,\n";
        $out  .= "\t\t\t'conditions' => '',\n";
        $out  .= "\t\t\t'fields' => '',\n";
        $out  .= "\t\t\t'order' => '',\n";
        $out  .= "\t\t\t'limit' => '',\n";
        $out  .= "\t\t\t'offset' => '',\n";
        $out  .= "\t\t\t'exclusive' => '',\n";
        $out  .= "\t\t\t'finderQuery' => '',\n";
        $out  .= "\t\t\t'counterQuery' => ''\n";
        $out  .= "\t\t)";
        if ($i + 1 < $belongsToCount) {
            $out  .= ",";
        }
        echo $out;
    endforeach;
    echo "\n\t);\n\n";
endif;

if (!empty($associations['hasAndBelongsToMany'])) :
    $habtmCount = count($associations['hasAndBelongsToMany']);
    echo "\n/**\n * hasAndBelongsToMany associations\n *\n * @var array\n */";
    echo "\n\tpublic \$hasAndBelongsToMany = array(";
    foreach ($associations['hasAndBelongsToMany'] as $i => $relation) :
        $out = "\n\t\t'{$relation['alias']}' => array(\n";
        $out  .= "\t\t\t'className' => '{$relation['className']}',\n";
        $out  .= "\t\t\t'joinTable' => '{$relation['joinTable']}',\n";
        $out  .= "\t\t\t'foreignKey' => '{$relation['foreignKey']}',\n";
        $out  .= "\t\t\t'associationForeignKey' => '{$relation['associationForeignKey']}',\n";
        $out  .= "\t\t\t'unique' => true,\n";
        $out  .= "\t\t\t'conditions' => '',\n";
        $out  .= "\t\t\t'fields' => '',\n";
        $out  .= "\t\t\t'order' => '',\n";
        $out  .= "\t\t\t'limit' => '',\n";
        $out  .= "\t\t\t'offset' => '',\n";
        $out  .= "\t\t\t'finderQuery' => '',\n";
        $out  .= "\t\t\t'deleteQuery' => '',\n";
        $out  .= "\t\t\t'insertQuery' => ''\n";
        $out  .= "\t\t)";
        if ($i + 1 < $habtmCount) {
            $out  .= ",";
        }
        echo $out;
    endforeach;
    echo "\n\t);\n\n";
endif;
?>
}