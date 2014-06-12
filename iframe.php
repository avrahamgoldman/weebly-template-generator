<?php 
  include "php/template.php";
  $id=$_GET["id"];
  $page=$_GET["page"];
  $json=json_decode(file_get_contents("json_templates/$id.json"), true);
  $template=$json["html"]["template"];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $id . " - " . $page; ?></title>
    <link rel="stylesheet" href="css/template-reset.css">
    <style id="styles">
      <?php echo get_stylesheet($json);?>
    </style>
  </head>
  <body>
    <?php
      echo get_template("templates/$template/$page.html");
    ?>
  </body>
</html>