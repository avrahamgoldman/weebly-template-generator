function get_stylesheet(json)
{
  var html_tags = ['p', 'a'];
  style="";
  css=json["css"];
  $.each(css, function(selector, properties) {
      if (html_tags.indexOf(selector)==-1) {
        style+=".";
      }
      style += selector+"{";
      $.each(properties, function(property, value) {
        style += property+":"+value+";";
      });
      style += "}"
  });
  return style;
}


function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}