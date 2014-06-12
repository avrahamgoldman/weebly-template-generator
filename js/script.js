$( document ).ready(function() {
  
  /******************************
  Setup
  ******************************/

  //variables
  var saved=true;
  
  //set size
  var left = 230;
  $("#editor-settings").css('width', left+'px');
  $("#editor-webpage").css('width', ($("body").width()-left)+'px');
  $("#editor-webpage iframe").css('height', $("#editor-webpage").height()+'px');
  

  //makes sure that the page is saved before it closes
  $(window).on('beforeunload', function() {
    //before the user closes
    if (saved==false) {
      return "you sure you want to leave?";
    }
  });

  /******************************
  settings stuff
  ******************************/

  $("#editor-options a").click(function() {
    $('.settings-set').each(function() {
      $(this).css('display', 'none');
    });
    $("#"+$(this).attr("data-settings")).css('display', 'block');
  });

  $(".settings-set a").click(function() {
    $(this).siblings('.editor-selector').each(function() {
      $(this).css('display', 'none');
    });
    $(this).next().css('display', 'block');
  });

  /******************************
  editing stuff
  ******************************/

  //handle template width
  $("#template-width" ).slider({
      min: 300,
      max: 1250,
      value: 90,
      stop: function( event, ui ) {
        if (ui.value < 1200) {
          update("container", "width", ui.value, "px", "css");
        }
        else {
          update("container", "width", "100", "%", "css");
        }
      }
    });

  //handle spinners
  $("#editor-settings .spinner").spinner({
    stop: function() {
      update($(this).parents('.editor-selector').attr('data-selector'), $(this).attr('data-property'),$(this).spinner("value"), $(this).attr('data-unit'), $(this).attr('data-object'));
    }
  });

  //handle text input
  $("#editor-settings .text").change(function() {
    update($(this).parents('.editor-selector').attr('data-selector'), $(this).attr('data-property'), $(this).val(), $(this).attr('data-unit'), $(this).attr('data-object'));
  });

  //handle dropdown menu
  $("#editor-settings select").change(function() {
    update($(this).parents('.editor-selector').attr('data-selector'), $(this).attr('data-property'), $(this).val(), $(this).attr('data-unit'), $(this).attr('data-object'));
  });

  //handle colorpicker
  $("#editor-settings .colorpicker").spectrum({
      showButtons: true,
      change: function(color) {
        console.log(color.toHexString()); // #ff0000
        update($(this).parents('.editor-selector').attr('data-selector'), $(this).attr('data-property'), color.toHexString(), $(this).attr('data-unit'), $(this).attr('data-object'));
      }
  });

  /******************************
  functions
  ******************************/

  function update(selector, property, value, unit, object) {
    //NOTE: the local update is only for the client side, the saved update is done on the server side
    saved=false;
    //change the local json and update it for the user
    json[object][selector][property]=value+unit;
    var stylesheet=get_stylesheet(json);
    refresh_iframe(stylesheet);
    //update the new json to the server
    update_server(selector, property, value, unit, object);
  }

  //update iframe
  function refresh_iframe(data) {
    $("iframe").contents().find("#styles").text("");
    $("iframe").contents().find("#styles").append(data);
  }

  //update the server
  function update_server(selector, property, value, unit, object) {
    $.ajax({
      url: 'php/update.php',
      type: 'POST',
      data: {id : id, selector : selector, property : property, value : value+unit, object : object},
    })
    .done(function(data) {
      saved=true;
      //update the frame with the code from the server
      refresh_iframe(data);
    });
  }
  
});