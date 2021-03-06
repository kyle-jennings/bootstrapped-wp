var send_to_preview = {

  data: {},

  load_styles: function() {
  	var $preview = $('iframe.preview-window');
		var url = object_name.css_dir + '/bswp/preview-assets/css/preview.css';
  	var preview_style = '<link id="preview" href="' + url + '" rel="stylesheet" type="text/css" />';

    var timestamp = Date.now();


  	var link = $("<link>");
  	link.attr({
  			id: 'preview',
        class: 'preview-css',
        type: 'text/css',
        rel: 'stylesheet',
        href: url + '?' + timestamp
  	});


  	if( $preview.contents().find('head').find('#preview').length ){
      $preview.contents()
        .find('head')
            .find('#preview').attr('href',url + "?id=" +  timestamp);
  	}else {
      $preview.contents().find('head').append( link );
  	}

    var $previewWrapper = $('.preview-wrapper');
    $previewWrapper.delay(2000).removeClass('reloading');
  },



  init: function(section, thisField, value) {
    var $previewWrapper = $('.preview-wrapper');
    $previewWrapper.addClass('reloading');


		thisField = thisField.split('[');
		thisField = thisField[thisField.length-1];
		thisField = thisField.substring(0, thisField.length-1);


		var preview = {};
		preview.section = section;
		preview.field = thisField;
		preview.val = value;
    window.preview = preview;


		//count fields
		var form = $('form').serializeArray();
    var saved_values = {};
    // delete these:
    var throwAway = ["option_page", "action", "_wpnonce", "_wp_http_referer", "group_tab", "_ajax_linking_nonce"];

		var formLength = form.length;
    var fields = form;

    for(var i = form.length - 1; i >= 0; i--) {
        if(throwAway.indexOf(form[i].name) > -1) {
           form.splice(i, 1);
        }
    }


		for( var int = 0, l = formLength; int < l ; int++) {
      if(typeof form[int] === 'undefined' ||
         typeof form[int].name === 'undefined' ||
         typeof form[int].value === 'undefined'
        )
        continue;

      // console.log(int, form[int]);

      var matches = form[int].name.match(/\[(.*?)\]/g);
      if ('null' == matches || matches.length < 3)
        continue;

      var group = matches[0].replace( /(^.*\[|\].*$)/g, '' );
      var tab = matches[1].replace( /(^.*\[|\].*$)/g, '' );
      var field = matches[2].replace( /(^.*\[|\].*$)/g, '' );
      var val = form[int].value;


      if(typeof saved_values[group] === 'undefined')
        saved_values[group] = {};

      if(typeof saved_values[group][tab] === 'undefined')
        saved_values[group][tab] = {};


      saved_values[group][tab][field] = val ? val : '' ;

		}


    preview.form_values = saved_values;
    var data = {
      action: 'bswp_live_preview',
      data: preview
    };


		$.post(
      ajaxurl,
      data,
      function(response){
        send_to_preview.load_styles();
		  }
    );

  }
};

window.send_to_preview = send_to_preview;
