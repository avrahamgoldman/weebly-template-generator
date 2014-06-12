<?php
  include "template.php";
  $id=$_POST['id'];
  $object=$_POST['object'];
  $selector=$_POST['selector'];
  $property=$_POST['property'];
  $value=$_POST['value'];

  $json=json_decode(file_get_contents("../json_templates/$id.json"), true);
  $json[$object][$selector][$property]="$value";
  echo get_stylesheet($json);
  $json=json_encode($json);
  file_put_contents("../json_templates/$id.json", $json);

?>
