var ajax_preview = {

  data: {},


  init: function(section, fieldName, value, deps) {


    var $previewWrapper = $('.preview-wrapper');
    $previewWrapper.addClass('reloading');
    var iframeURL = document.getElementById("preview-window").contentWindow.location.href


    var matches = fieldName.match(/\[(.*?)\]/g);
    if ('null' == matches || matches.length < 3)
      return;

    var group = matches[0].replace( /(^.*\[|\].*$)/g, '' );
    var tab = matches[1].replace( /(^.*\[|\].*$)/g, '' );
    var field = matches[2].replace( /(^.*\[|\].*$)/g, '' );



    var depFields = [];
    if(deps && deps.length > 0 ){

      deps = deps.split(',');
      deps.forEach(function(e,i,a){
        // if the dep has is prefixed with a !# then we knot the exact element,
        // AND the jquery chain has been provided
        if(e.indexOf('$') >-1){

          var tmpName = e;
          var value = eval(e);
        }
        // else the dep might just be prefixed with a hashtag, in that case we
        // dont need to search for the field
        else if(e.indexOf('#') >-1){
          var tmpName = e;
          var $elm = $(tmpName);
          var value = $elm.val();
        }
        // otherwise, we might need to search for the field, we should probably
        // jsut be specific from the onset
        else{
          var tmpName = '#'+group+'-'+tab+'-'+e;
          var $elm = $(tmpName);
          var value = $elm.val();

        }

        depFields.push({
          name: tmpName,
          value: value
        });
      });
    }


    var data = {
      iframeURL: iframeURL,
      section: section,
      group: group,
      tab: tab,
      field: field,
      value: value,
      dependancies: depFields
    };

    var args = {
      action: 'bswp_ajax_preview_args',
      data: data
    };
    // console.log(data);
    $.post(
      ajaxurl,
      args,
      function(response){
        var json = JSON.parse(response);

        eval(json.preview_callback);
        $previewWrapper.removeClass('reloading');
      }
    );


	}

};

window.ajax_preview = ajax_preview;
