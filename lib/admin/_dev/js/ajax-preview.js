var ajax_preview = {

  data: {},


  init: function(section, fieldName, value, deps) {
    var $previewWrapper = $('.preview-wrapper');
    $previewWrapper.addClass('reloading');

    var matches = fieldName.match(/\[(.*?)\]/g);
    if ('null' == matches || matches.length < 3)
      return;

    var group = matches[0].replace( /(^.*\[|\].*$)/g, '' );
    var tab = matches[1].replace( /(^.*\[|\].*$)/g, '' );
    var field = matches[2].replace( /(^.*\[|\].*$)/g, '' );



    var depFields = [];
    if(deps.length > 0 ){
      deps = deps.split(',');
      deps.forEach(function(e,i,a){
        var tmpName = '#'+group+'-'+tab+'-'+e;
        var $elm = $(tmpName);

        depFields.push({
          name: tmpName,
          value: $elm.val()
        });
      });
    }


    var data = {
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

    $.post(
      ajaxurl,
      args,
      function(response){
        var json = JSON.parse(response);
        console.log(json);
        eval(json.preview_callback);
        $previewWrapper.removeClass('reloading');
      }
    );


	}

};

window.ajax_preview = ajax_preview;
