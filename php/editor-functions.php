<?php 
  function get_editor_element($property, $object, $value) {
    $dropdown_menu = array(
      'font-family' => array(
        'Times New Roman' => "Times New Roman",
        'Arial' => "Arial",
        'Arial Black' => "Arial Black",
        'Candara' => "Candara",
        'Segoe UI' => "Segoe UI"
        ),
      'font-weight' => array(
        'Light' => 'lighter',
        'Normal' => 'normal',
        'Bold' => 'bold'
        ),
      'text-align' => array(
        'Left' => 'left',
        'Center' => 'center',
        'Right' => 'right', 
        )
      );
    
    //text
    if (false) {

    }
    //spinner
    else if ($property=='font-size'||$property=='line-height'||strpos($property, 'padding')!==false) {
      $value = preg_replace("([^0-9])","", $value);
      echo "<input data-property='$property' data-unit='px' data-object='$object' value='".$value."' class='spinner'>";
    }
    //dropdown
    else if ($property=='font-family'||$property=='font-weight'||$property=='text-align') {
      echo "<select data-property='$property' data-unit='' data-object='$object'>";
      foreach ($dropdown_menu[$property] as $display => $store) {
        if ($store==$value) {
          echo "<option value='$store' selected='selected'>$display</option>";
        }
        else {
          echo "<option value='$store'>$display</option>";
        }
      }
      echo "</select>";
    }
    //colorpicker
    else if ($property=='color') {
      echo "<input type='text' data-property='$property' data-unit='' data-object='$object' value='".$value."' class='colorpicker'/>";
    }
    else {
      echo $property;
    }
  }

?>