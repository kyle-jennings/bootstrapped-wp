var send_to_preview = {

  data: {},

  load_styles: function() {
  	var $preview = $('iframe'),
  		url = object_name.root_url + '/lib/styles/preview.css',
  		preview_style = '<link id="preview" href="' + url + '" rel="stylesheet" type="text/css" />';


    var timestamp = Date.now();


  	var link = $("<link>");
  	link.attr({
  			id: 'preview',
        type: 'text/css',
        rel: 'stylesheet',
        href: object_name.root_url + '/lib/styles/preview.css?' + timestamp
  	});


  	if( $preview.contents().find('head').find('#preview').length ){
  		$preview.contents().find('head').find('#preview').remove();
  	}

  	$preview.contents().find('head').append( link );
  },



  init: function(section, field, value) {

    arrayName = field;
		arrayName = arrayName.split('[');
		arrayName = arrayName[1];
		arrayName = arrayName.substring(0, arrayName.length-1);
		arrayName = arrayName.replace(section,'section');

		field = field.split('[');
		field = field[field.length-1];
		field = field.substring(0, field.length-1);


		var preview = {};
		preview.section = section;
		preview.arrayName = arrayName;
		preview.field = field;
		preview.val = value;
    window.preview = preview;

		//count fields
		var form = $('form').serializeArray();
    // delete these:
    var throwAway = ["option_page", "action", "_wpnonce", "_wp_http_referer", "group_tab"];

		var formLength = form.length;
    var fields = form;

    for(var i = form.length - 1; i >= 0; i--) {
        if(throwAway.indexOf(form[i].name) > -1) {
           form.splice(i, 1);
        }
    }


		// for( var i = 0; i< formLength; i++) {
		// 	var string = form[i].name;
		// 	var hasBracket = string.indexOf('[',0);
    //
		// 	if(hasBracket > 0){
    //
		// 		string = string.split('[');
    //
		// 			var newField = string[string.length-1].replace(']','' );
		// 			string = string[string.length-2];
		// 			string = string.replace(']', '');
		// 			string = string.replace(section,'section');
    //
		// 		form[i].name = string;
		// 		form[i].field = newField;
    //
		// 	}
		// }

    preview.settings = form;
    // var data = {
    //   action: 'kjd_live_preview',
    //   data: preview
    // };


		// console.log(preview);

		// $.post(
    //   ajaxurl,
    //   data,
    //   function(response){
    //     // console.log(response);
    //     kjd_reload_styles();
		//   }
    // );

  }
}
window.send_to_preview = send_to_preview;
