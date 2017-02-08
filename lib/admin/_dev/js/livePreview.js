
  if( $('.preview-window').length < 0)
		return;


	$('body').addClass('folded');

	$('.clearColor').on('click', function(){
		var $this = $(this).prev('.minicolors').find('.minicolors-input'),
		section = '',
		field = $this.attr('name'),
		value = $this.val(),
		end_pos = field.indexOf('_',4),
		arrayName = field;

      section = field.substring(4, end_pos);

		kjd_send_preview_data(section, field, value, arrayName);
	});


	$('form input, form select, .custom-styles').not('.preview-size').change(function(){
		var $this = $(this),
			section = '',
			field = $this.attr('name'),
			value = $this.val(),
			end_pos = field.indexOf('_',4),
			arrayName = field;

          section = field.substring(4,end_pos);

		if($this.hasClass('custom-styles')){
			section = 'kjd_custom_styles';
			value = $this.text();
		}

		// kjd_send_preview_data(section, field, value, arrayName);

	});



  function kjd_reload_styles(){
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
  }



  function kjd_send_preview_data(section, field, value, arrayName){

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


  		//count fields
  		var form = $('form').serializeArray();
  		var formLength = form.length;

  		for( var i = 0; i< formLength; i++) {
  			var string = form[i].name;
  			var hasBracket = string.indexOf('[',0);

  			if(hasBracket > 0){

  				string = string.split('[');

  					var newField = string[string.length-1].replace(']','' );
  					string = string[string.length-2];
  					string = string.replace(']', '');
  					string = string.replace(section,'section');

  				form[i].name = string;
  				form[i].field = newField;

  			}
  		}
      preview.settings = form;
      var data = {
        action: 'kjd_live_preview',
        data: preview
      };

  		// console.log(preview);

  		$.post(
        ajaxurl,
        data,
        function(response){
          // console.log(response);
          kjd_reload_styles();
  		  }
      );

  }
