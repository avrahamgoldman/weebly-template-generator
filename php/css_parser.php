<?php   
  /**
  * 
  */
  class css_file
  {
    //css file
    private $css="";
    //array of all css selectors as the key and an array of the declarations
    private $css_array=array();
    function __construct($css)
    {
      $this->css = $css;
      $this->parse();
    }

    function parse() {
      $i = 0;
      $token = strtok($this->css, "{}");
      $selector="";
      //loop through the css and make it into an array
      while ($token !== false) {
        //handle comments
        $matches = array();
        preg_match('.*\\*.*\*\.*', $token, $matches);
        foreach ($matches as $key => $value) {
          
        }
        //if it is even it is a selector, otherwise it is the declarations
        if ($i%2==0) {
          //remove all spacing
          $selector = preg_replace("/\s+/", "", $token);
        }
        else {
          $declarations = $token;
          //check if this selector already has a value
          if ($this->css_array[$selector]!=null) {
            $declarations = $this->css_array[$selector].$declarations;
          }
          $this->css_array[$selector]=$declarations;
        }
        $token = strtok("{}");
        $i++;
      }

      foreach ($this->css_array as $key => $value) {
          $this->css_array[$key] = $this->splitDeclarations($value);
      }
    }

    function getCssBySelector($selector)
    {
      return $this->css_array[$selector];
    }

    function valuesOf($property) {
      $values=array();
      foreach ($this->css_array as $key => $value) {
          foreach ($this->css_array[$key] as $key => $value) {
            if ($key==$property)
              $values[]=$value;
          }
      }
      return $values;
    }
    
    function splitDeclarations($token) {
      //set all the delartaions into an array and set the current selecter in the css_array to the declarations array
      $i=0;
      $declarations = array();
      $declaration = strtok($token, ":;");
      $property = "";
      //set all the declarations to the array
      while ($declaration !== false) {
        if ($i%2==0) {
          $property = preg_replace("/\s+/", "", $declaration);
        }
        else {
          $declarations[$property] = $declaration;
        }
        $declaration = strtok(":;");
        $i++;
      }
      return $declarations;
    }
  }

  $test = new css_file("body {background:blue;height:100%;font-family:Impact;} h1 {font-family:Times New Roman;font-size:1.3em;} body {width:100%;}");
  print_r($test->getCssBySelector("body"));
  print_r($test->valuesOf("font-family"));
?>