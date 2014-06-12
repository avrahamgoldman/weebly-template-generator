<?php
  
  $id="template_name";
  $page="landing";

  $json=json_decode(file_get_contents("json_templates/$id.json"), true);

  $data_model=json_decode(file_get_contents("data_model.json"), true);
  
  include_once 'php/editor-functions.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Edit: Template Name</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/spectrum.css" />
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="js/spectrum.js"></script>
  </head>
  <body>
    <!-- page content -->
    <div id="editor-top">
      logo
    </div>

    <div id="editor-left">

      <ul id="editor-options">
        <li>
          <a href="#" data-settings="general">General</a>
        </li>
        <li>
          <a href="#" data-settings="header">Header</a>
        </li>
        <li>
          <a href="#" data-settings="navigation">Navigation</a>
        </li>
        <li>
          <a href="#" data-settings="content">Content</a>
        </li>
        <li>
          <a href="#" data-settings="footer">Footer</a>
        </li>
        <li>
          <a href="#" data-settings="typography">Change Fonts</a>
        </li>        
      </ul>
      <div id="editor-settings">

        <!--general setttings-->
        <div id="general" class="settings-set">
          <div id="template-width"></div>
          <?php 
            foreach ($data_model["general"] as $selector => $properties) {
              echo "<a href='#'>$properties[0]</a>"; 
              echo "<div class='editor-selector' data-selector='$selector'>";
              for ($i=1; $i < count($properties); $i+=2) { 
                echo "$properties[$i]";
                get_editor_element($properties[$i+1], "css", $json["css"][$selector][$properties[$i+1]]);
              }
              echo "</div>";
              echo "<hr/>";
            }
          ?>
        </div>

        <!--header setttings-->
        <div id="header" class="settings-set">
          <?php 
            foreach ($data_model["header"] as $selector => $properties) {
              echo "<a href='#'>$properties[0]</a>"; 
              echo "<div class='editor-selector' data-selector='$selector'>";
              for ($i=1; $i < count($properties); $i+=2) { 
                echo "$properties[$i]";
                get_editor_element($properties[$i+1], "css", $json["css"][$selector][$properties[$i+1]]);
              }
              echo "</div>";
              echo "<hr/>";
            }
          ?>
        </div>

        <!--navigation setttings-->
        <div id="navigation" class="settings-set">
          <?php 
            foreach ($data_model["navigation"] as $selector => $properties) {
              echo "<a href='#'>$properties[0]</a>"; 
              echo "<div class='editor-selector' data-selector='$selector'>";
              for ($i=1; $i < count($properties); $i+=2) { 
                echo "$properties[$i]";
                  get_editor_element($properties[$i+1], "css", $json["css"][$selector][$properties[$i+1]]);
                }
              }
              echo "</div>";
              echo "<hr/>";
            }
          ?>
        </div>

        <!--content setttings-->
        <div id="content" class="settings-set">
          <?php 
            foreach ($data_model["content"] as $selector => $properties) {
              echo "<a href='#'>$properties[0]</a>"; 
              echo "<div class='editor-selector' data-selector='$selector'>";
              for ($i=1; $i < count($properties); $i+=2) { 
                echo "$properties[$i]";
                get_editor_element($properties[$i+1], "css", $json["css"][$selector][$properties[$i+1]]);
              }
              echo "</div>";
              echo "<hr/>";
            }
          ?>
        </div>

        <!--footer setttings-->
        <div id="footer" class="settings-set">
          <?php 
            foreach ($data_model["footer"] as $selector => $properties) {
              echo "<a href='#'>$properties[0]</a>"; 
              echo "<div class='editor-selector' data-selector='$selector'>";
              for ($i=1; $i < count($properties); $i+=2) { 
                echo "$properties[$i]";
                get_editor_element($properties[$i+1], "css", $json["css"][$selector][$properties[$i+1]]);
              }
              echo "</div>";
              echo "<hr/>";
            }
          ?>
        </div>

        <!--typography setttings-->
        <div id="typography" class="settings-set">
          <?php 
            foreach ($data_model["typography"] as $selector => $properties) {
              echo "<a href='#'>$properties[0]</a>"; 
              echo "<div class='editor-selector' data-selector='$selector'>";
              for ($i=1; $i < count($properties); $i+=2) { 
                echo "$properties[$i]";
                get_editor_element($properties[$i+1], "css", $json["css"][$selector][$properties[$i+1]]);
              }
              echo "</div>";
              echo "<hr/>";
            }
          ?>
        </div>

      </div>
    </div>

    <div id="editor-webpage">
      <!--load web page here-->
      <iframe src="iframe.php?id=<?php echo $id; ?>&page=<?php echo $page; ?>"></iframe>
    </div>


    <script>
    //set id
    var id = "<?php echo $id; ?>";
    //set json to the json from the server
    var json = <?php echo json_encode($json); ?>;
    </script>
    <script src="js/template.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>