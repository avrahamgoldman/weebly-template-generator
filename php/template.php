<?php 
  include_once 'simple_html_dom.php';
  //include_once 'css_parser.php';
  $errors = array();

  //new code
  function get_template($url) {
    $file = file_get_html($url);
    if($file!=false) {
      $file = replace_weebly_tags($file);
      return $file;
    }
    else {
      return false;
    }
  }

  function generate_template($url) {
    $file = file_get_html($url);
    if($file!=false) {
      return $file;
    }
    else {
      return false;
    }
  }

  function get_stylesheet($json)
  {
    $html_tags = array('p', 'a');
    $style="";
    $css=$json["css"];
    foreach($css as $selector => $properties) {
      if (!in_array($selector, $html_tags)) {
        $style .= ".";
      }
      $style .= $selector."{";
      foreach($properties as $property => $value) {
        $style .= $property.":".$value.";";
      }
      $style .= "}";
    }
    return $style;
  }

  //from other template
  
  function replace_weebly_tags($file) {
    $pattern = '|{\s?.*\s?}|U';
    $matches = array();
    preg_match_all($pattern, $file, $matches, PREG_PATTERN_ORDER);
    for ($i=0;$i<count($matches[0]);$i++) {
      $file = str_replace($matches[0][$i], get_filler($matches[0][$i]), $file);
    }
    return $file;
  }

  function get_filler($tag)
  {
    $known_tags = array("content", "title", "logo", "social", "menu", "search", "footer", "headline:text", "headline-paragraph:text","action:button","phone:text");
    $replace_tags = array(
      "<span style='z-index:10;position:relative;float:left;max-width:100%;;clear:left;margin-top:0px;*margin-top:0px'><a><img src='http://aymtemplates.weebly.com/uploads/1/0/9/1/10914633/929226120.jpg?187' style='margin-top: 5px; margin-bottom: 10px; margin-left: 0px; margin-right: 10px; border-width:1px;padding:3px;' alt='Picture' class='galleryImageBorder wsite-image'></a><span style='display: block; font-size: 90%; margin-top: -10px; margin-bottom: 10px; text-align: center;'' class='wsite-caption'></span></span><p style='text-align:left;display:block;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at est mattis, facilisis magna nec, placerat dolor. Curabitur at nulla vitae lectus scelerisque tempus. Donec justo augue, tincidunt eget ligula eleifend, volutpat commodo tortor. Ut et porttitor purus. Donec velit erat, sodales id massa at, tincidunt auctor erat. Cras sit amet mi ipsum. Donec semper porttitor ligula. Morbi ornare diam vitae adipiscing euismod. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent molestie magna vel velit cursus tristique sit amet ac purus. Donec augue dui, tristique vel risus ut, tempor vulputate lorem. Cras dapibus facilisis augue vitae posuere. Aliquam non lacinia sem, ac pharetra dui.<br><br>Vestibulum sed commodo felis, ac suscipit est. Ut lacinia est nunc, vel dapibus mauris posuere sed. Nulla molestie leo eget lobortis facilisis. Sed mollis nulla lectus, nec ullamcorper nibh faucibus sed. Vivamus aliquet tellus eu justo aliquet, sed volutpat turpis sagittis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas tempor, risus eu consequat cursus, leo mauris luctus dui, eget bibendum tellus tortor vitae ligula. Morbi sed rhoncus purus. Cras non venenatis nisl, in egestas nisi. Nulla facilisi. Nunc viverra, arcu et varius aliquam, libero ante viverra sem, a porttitor enim mi vel lacus. Integer at eros velit.<br></p>",
      "Website Title",
      "<span class='wsite-logo'><a href='/'><span id='wsite-title'>AYM Templates</span></a></span>",
      "some social networking things",
      "<div class='navigation'><ul class='wsite-menu-default'><li id='active'><a href='/'>Home</a></li><li ><a href='/about.html'>About</a></li><li><a href='/contact.html'>Contact</a></li></ul></div>",
      "searching...",
      "&copy; this awesome website",
      "Headline",
      "headline paragraph",
      "action button",
      "phone: 1800-111-4384");
    $tag=str_replace("{", "", $tag);
    $tag=str_replace("}", "", $tag);
    for ($i=0;$i<count($replace_tags);$i++) {
      if (stripos($tag,$known_tags[$i])!==false&&$tag[stripos($known_tags[$i],$tag)-1]!=":") {
        return $replace_tags[$i];
      }
    }
    return $tag." not found";
  }

?>
