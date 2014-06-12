<?php 
  include "php/template.php";
  $id=$_GET["id"];
  $page=$_GET["page"];
  $json=json_decode(file_get_contents("json_templates/$id.json"), true);
  $template=$json["html"]["template"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Generated files</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  </head>
  <body>
    <textarea>
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>{title}</title>
        </head>
        <body>
          <?php
            echo generate_template("templates/$template/$page.html");
          ?>
        </body>
      </html>
    </textarea>
    <br/>
    <br/>
    <textarea>
      <?php echo get_stylesheet($json);?>
    </textarea>
  </body>
</html>