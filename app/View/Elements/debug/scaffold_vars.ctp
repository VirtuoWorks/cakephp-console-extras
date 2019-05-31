<?php

echo '<div class="grid_6">';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$title_for_layout :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo($title_for_layout);
    echo '</div>';
  echo '</div>';
echo '</div>';

echo '<div class="grid_5">';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$singularVar :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo($singularVar);
    echo '</div>';
  echo '</div>';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$singularHumanName :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo($singularHumanName);
    echo '</div>';
  echo '</div>';
echo '</div>';

echo '<div class="grid_5">';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$pluralVar :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo($pluralVar);
    echo '</div>';
  echo '</div>';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$pluralHumanName :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo($pluralHumanName);
    echo '</div>';
  echo '</div>';
echo '</div>';

echo '<div class="clear"></div>';

echo '<div class="grid_4">';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$modelClass :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo($modelClass);
    echo '</div>';
  echo '</div>';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$primaryKey :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo($primaryKey);
    echo '</div>';
  echo '</div>';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$displayField :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo($displayField);
    echo '</div>';
  echo '</div>';
echo '</div>';


echo '<div class="grid_6">';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$associations :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo('<pre>');
        print_r($associations);
      echo('</pre>');
    echo '</div>';
  echo '</div>';
echo '</div>';

echo '<div class="grid_6">';
  echo '<div class="box">';
    echo '<div class="box-title">';
      echo '<p>$scaffoldFields :</p>';
    echo '</div>';
    echo '<div class="block">';
      echo('<pre>');
        print_r($scaffoldFields);
      echo('</pre>');
    echo '</div>';
  echo '</div>';
echo '</div>';
?>
