jQuery(document).ready(function($) {   

/* ---------------------------------------------
			XML exporting
--------------------------------------------- */
$('.export-xml').on('click', function(e){
	e.preventDefault;
	$.ajax({
	    url: object_name.export_file_url,
	    type: 'POST',
	    data: { data: 'stuff' },
	    success: function(result) {
	        console.log('boom');
	    }
	});

	
});

/* ---------------------------------------------
		Button toggle title change
--------------------------------------------- */
if($('.btn-group').length ){

	$btnChoice = $('.btn-group .dropdown-menu a');

	$btnChoice.click(function (e) {
	  e.preventDefault();
	  
	  var $this = $(this),
		  $btnGroup = $this.closest('.btn-group'),
		  $btnFace = $btnGroup.find('.btn-face'),
		  $parent = $this.parent('li'),
	  	  btnText = $this.text();
	  
	  $parent.siblings().removeClass('active');
	  $btnFace.text(btnText);

	})
}

/* ---------------------------------------------
		Form Misc Shit
--------------------------------------------- */
$('form').submit(function(e){
	var $activeTab = $('.tabbable .tab-pane.active');
	$('#active_tab').val($activeTab.attr('id'));
});

$('.float-toggle select').change(function(){
	if( $(this).val() == 'true' || $(this).val() == 'dropdown' ){
		$(this).closest('.float-toggle').next('.float-option input').disabled = false;
		$(this).closest('.float-toggle').next('.float-option').fadeIn();
	}else{
		$(this).closest('.float-toggle').next('.float-option input').disabled = true;
		$(this).closest('.float-toggle').next('.float-option').fadeOut();
	}
});


$('.float-toggle select').change(function(){
	if( $(this).val() == 'dropdown' || $(this).val() == 'default' ){
		$(this).closest('.float-toggle').next('.float-option input').disabled = false;
		$(this).closest('.float-toggle').next('.float-option').fadeIn();
	}else{
		$(this).closest('.float-toggle').next('.float-option input').disabled = true;
		$(this).closest('.float-toggle').next('.float-option').fadeOut();
	}
});

$('.toggle-widgetarea').click(function(){
	$this = $(this);

	if( $this.attr('checked') ) {

		$this.closest('.option').find('select').prop('disabled',false);
	}else {

		$this.closest('.option').find('select').prop('disabled',true);
	}

});

$('.background-pos').change(function(){
	var $this = $(this),
		thisVal = $this.val();
		if(thisVal == 'custom'){
			$this.closest('.option').next('.option').fadeIn();	
		}else{
			$this.closest('.option').next('.option').fadeOut();	
		}

});

$('.background-size').change(function(){
	
	var $this = $(this),
		thisVal = $this.val();
		if(thisVal == 'percentage'){
			$this.closest('.option').next('.option').fadeIn();	
		}else{
			$this.closest('.option').next('.option').fadeOut();	
		}
});


/* --------------------------------- Mini Colors ---------------------------------------- */
$('.minicolors').each(function(){

	$(this).minicolors({
		 opacity: $(this).hasClass('opacity'),
		change: function(hex, opacity) {
			var text = $(this).minicolors('rgbaString');
			$(this).parent().next('.rgba-color').val(text);
		},
		hide: function(hex, opacity){
			
			$this = $(this),
			rgba = $(this).minicolors('rgbaString'),
			section = '',
			field = $this.attr('name'),
			value = $this.minicolors('value');

			var end_pos = field.indexOf('_',4);
			section = field.substring(4,end_pos);
			arrayName = field;
			kjd_send_preview_data(section, field, rgba, arrayName);

		}
	});

});

$('.clearColor').on('click',function(){

	$(this).siblings('.minicolors').find('input').val('');
	$(this).siblings('.minicolors').find('.minicolors-swatch span').css('background','none');
});



/* ---------------------------------------------
			Live Preview Shit
--------------------------------------------- */
if( $('.preview-window').length ) {

	$('body').addClass('folded');

	$('.clearColor').on('click', function(){
		$this = $(this).prev('.minicolors').find('.minicolors-input'),
		section = '',
		field = $this.attr('name'),
		value = $this.val(),

		end_pos = field.indexOf('_',4),
		section = field.substring(4,end_pos),
		
		arrayName = field;


		kjd_send_preview_data(section, field, value, arrayName);
	});

	$('form input, form select').not('.preview-size').change(function(){
		$this = $(this),
		section = '',
		field = $this.attr('name'),
		value = $this.val(),

		end_pos = field.indexOf('_',4),
		section = field.substring(4,end_pos),
		
		arrayName = field;


		kjd_send_preview_data(section, field, value, arrayName);
	});
} 

function kjd_reload_styles(){
	var $preview = $('iframe'),
		url = object_name.root_url + '/lib/styles/preview.css',
		preview_style = '<link id="preview" href="' + url + '" rel="stylesheet" type="text/css" />';
	var getTimestamp = (new Date).getTime();

	var link = $("<link>");
	link.attr({
			id: 'preview',
	        type: 'text/css',
	        rel: 'stylesheet',
	        href: object_name.root_url + '/lib/styles/preview.css?' + getTimestamp
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

		
		var data = new Object();
		data.section = section;
		data.arrayName = arrayName;
		data.field = field;
		data.val = value;

		
		//count fields 
		var form = $('form').serializeArray();
		var formLength = form.length;

		for( var i = 0; i< formLength; i++) {
			var string = form[i].name;
			var hasBracket = string.indexOf('[',0);
			
			if(hasBracket > 0){
				
				string = string.split('[');

					var field = string[string.length-1].replace(']','' );
					string = string[string.length-2];		
					string = string.replace(']', '');
					string = string.replace(section,'section');

				form[i].name = string;
				form[i].field = field;

			}
		}	

		data.settings = form;
		// console.log( data.settings );	
		$.ajax({
		    url: object_name.template_url,
		    type: 'POST',
		    data: { data: data },
		    success: function(result) {
		        kjd_reload_styles();
		    }
		});

}

$('.preview-size').change(function(){
	var size = $(this).val();
	var width;

	switch(size){
		case 'desktop':
			width = '100%';
			break;
		case 'tablet':
			width = '800px';
			break;
		case 'phone':
			width = '480px';
			break;
	}
			
	$('.preview-window').css('width', width);

});

/* ------------------------------------------------------ 
Form Option Settings Toggles 
--------------------------------------------------------- */

// new toggle switch
$('.toggle-switch').change(function(){
	var toggleVal = $(this).val();
	if( toggleVal == 'true' ){
		
		$(this).closest('.option').next('.toggle-options').fadeIn();

	}else{
		
		$(this).closest('.option').next('.toggle-options').fadeOut();
	}

});


$('.toggle-switch').change(function(){
	var toggleVal = $(this).val();
	if( toggleVal == 'logo' ){
		$('.toggle-options.mobile-nav-logo').fadeIn();
	}else{
		$('.toggle-options.mobile-nav-logo').fadeOut();
	}

});




// hide shit
// Page: Cycler Misc?

  	$('.decorationList').change(function(){
		var thisVal = $(this).val();
		if(thisVal != 'text-shadow'){
			$(this).parent().next('.shadowColor').fadeOut(function(){
				$('.shadowColor').find('select').val('');
			});
		}else{ $(this).parent().next('.shadowColor').fadeIn(); }
	});


// Post Settings Toggles 
// Page Settings: Post Misc

$('.post-listing-toggle').change(function(){
	var thisVal = $(this).val();
	console.log(thisVal);
	var $settings = $('.image-settings');
	if(thisVal == 'excerpt'){
		$settings.fadeIn();
	}else{
		$settings.fadeOut();
	}
});



$('.featured-image-toggle').change(function(){
	var thisVal = $(this).val();
	var $settings = $('.featured-image-settings');
	if(thisVal == 'yes'){
		$settings.fadeIn();
	}else{
		$settings.fadeOut();
	}
});

$('.posts-background-toggle').change(function(){
	var thisVal = $(this).val();
	var $settings = $('.posts-background-settings');
	if(thisVal == 'yes'){
		$settings.fadeIn();
	}else{
		$settings.fadeOut();
	}
});

$('.single-post-background-toggle').change(function(){
	var thisVal = $(this).val();
	var $settings = $('.single-post-background-settings');
	if(thisVal == 'yes'){
		$settings.fadeIn();
	}else{
		$settings.fadeOut();
	}
});


//	responive design options
//	Settings Page: Page layout?

	if($('.toggleDisplaySwitch').val() == 'true'){
		$('.toggleDisplaySwitch').parent().next('.toggleDisplay').hide();
	}

	$('.toggleDisplaySwitch').change(function(){
		var thisVal = $(this).val();
		if(thisVal == 'true'){
			$(this).parent().next('.toggleDisplay').fadeOut(function(){
				$('#confineOption').find('select').val('false');
				$('#boxShadow').find('select').val('false');
			});
		}else{ $(this).parent().next('.toggleDisplay').fadeIn(); }
	});	


/* ---------------------------------------------------------------
 Media Manager Settings 
 ----------------------------------------------------------------- */
var file_frame;

$('.upload_image').click( function(e){  
	
	e.preventDefault();
	var $this = $(this);
	var $preview = $this.closest('.option').find('.image_preview');
 	var url = '';
 	var image = '';


    // If the media frame already exists, reopen it.
    if ( file_frame ) {
    	delete file_frame;
    }
 
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: $( this ).data( 'uploader_title' ),
      button: {
        text: $( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });
 
    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
	      // We set multiple to false so only get one image from the uploader
		attachment = file_frame.state().get('selection').first().toJSON();
			
		url = attachment.url;
		$this.prev('.media_input').val(url); 

		image = '<img style="max-height:100%;" src=' + url + ' />';
		$preview.html(image);

		
		// if this is on the image banner images pages
		if('#add_image') {

			var $frame = $this.closest('.cycler_image').find('iframe').contents();
			$frame.find('body').css('background-image','url('+url+')');

		}

    });
 
    // Finally, open the modal
    file_frame.open();

});  


if('#add_image') {
	setTimeout(function(){
		
		$('.cycler_image').each(function(){
			var $this = $(this);
			var imageURL = $this.find('.url.media_input').val();
			var $frame = $this.find('iframe');

			if( $frame ){
				$frame.contents().find('body').css('background-image','url('+imageURL+')');
			}
				
		});

	}, 1000);
}

/* --------------------------------- Google fonts ---------------------------------------- */
	// $('.google_fonts').change(function(){	
	// 	var font = $(".google_fonts :selected").val();
	// 	font = "'"+font.replace(/\+/g,' ')+"'";
	// 	$(this).next('.font_preview').find('span').css('font-family',font);
	// });

/* --------------------------------- Page Layouts ---------------------------------------- */
	$('.layout_select').change(function(){

		var temp = $(this).val();
		temp = '.'+temp;
		$(this).next('.layout_preview').find(temp).siblings().fadeOut();	
		$(this).next('.layout_preview').find(temp).fadeIn();
	});

/* ----------------------------------------------------------- 
			Front Page Settings
----------------------------------------------------------- */

if ( $('#frontpage-sortables').length ){
// activates components
	function setComponentNames(element, id) {  
		var newId = "componentOrder_" + id;      
		$(element).attr("id", newId);                 
       	$(".labelID", element).html(id);
 
	 	$(".component", element).attr("name", "kjd_frontPage_layout_settings[kjd_frontPage_layout]["+id+"][component]");
	 	$(".componentDisplay", element).attr("name", "kjd_frontPage_layout_settings[kjd_frontPage_layout]["+id+"][display]");
	 	$(".componentDeviceView", element).attr("name", "kjd_frontPage_layout_settings[kjd_frontPage_layout]["+id+"][componentDeviceView]");
	 	$(".componentDisplay", element).val('on');
	} 

//	deactivates components
	function removeComponentNames(element, id) {  
		var newId = "componentOrder_" + id;      
		 
	 	$(".component", element).attr("name", "");
	 	$(".componentDisplay", element).attr("name", "");
	 	$(".componentDisplay", element).val('off');

		$(".componentDeviceView", element).attr("name", "");
	} 

//	Sets components as sortable
	$("#activeComponents, #inactiveComponents").sortable({  
		placeholder: "ui-state-highlight",
		connectWith: ".connectedSortable",
		update: function(event, ui) {  

	    	var container = $(this).closest('.connectedSortable').attr('id');
	    	
	    	if(container == 'activeComponents'){
	    		var i = 0;  
			    $("li", this).each(function() {  
			        setComponentNames(this, i);
			        i++;  
			    }); 
	    	}else{
	    		var i = 0;  
			    $("li", this).each(function() {  
			        removeComponentNames(this, i);
			        i++;  
			    }); 	    		
	    	}
     
		}, receive: function(){
			
	    	var container = $(this).closest('.connectedSortable').attr('id');
	    	
	    	if(container == 'activeComponents'){
	    		var i = 0;  
			    $("li", this).each(function() {  
			        setComponentNames(this, i);
			        i++;  
			    }); 
	    	}else{
	    		var i = 0;  
			    $("li", this).each(function() {  
			        removeComponentNames(this, i);
			        i++;  
			    }); 	    		
	    	}
		}

	});

	$( "#activeComponenets" ).disableSelection();

}




/* ----------------------------------------------- 
	Image Carousel Sorting 
-------------------------------------------------- */


if( $('.banner_image_options').length){


	// $('.wp-editor-wrap').contents().find('iframe').css('background',"red");
	// sets image sortable handle
	$('.cycler_image > .handlediv').click(function(){
		$(this).siblings('.inside').slideToggle();

	});

	// Sortable functions
	// This counts the images, renumbers them (for order purposes), adds and removes images

	var totalCount = $('#totalCount').val();
	var elementCounter = 0; 

	$('#element_counter').val(elementCounter);

	// remove image
	$(".remove_image").click(function() {  

		if(totalCount<2){
			alert("Sorry, you need at lease one image.");
		}else{
			totalCount--;
			$('#total_elements').val(totalCount);
			$(this).closest('li').fadeOut( function() { $(this).remove(); });
			$('.banner_image_options').resize();
			$('#element_counter').val('0');
			$('#submit').trigger('click');
		}

	});

	// // add new image to cycler
	$("#add_image").click(function() {   
		$('#element_counter').val('1');

		// return false;  
	});

	// submits form and resets image counter
	$("#submit").click(function() {   
		$('#element_counter').val('0');
		$('#submit').trigger('click');

		// return false;  
	});


// image sorting

// function called by sortable to rename inputs
	function setInputName(element, id) {  
		var newId = "banner_element_" + id;      
        var editorVal = '';
		$(element).attr("id", newId);                 
		                
	 	$(".url", element).attr("name", "kjd_cycler_images_settings[kjd_cycler_images]["+id+"][url]");
	 	$(".alt", element).attr("name", "kjd_cycler_images_settings[kjd_cycler_images]["+id+"][alt]");
	 	$(".tmce-active textarea", element)
	 		  .attr("name", "kjd_cycler_images_settings[kjd_cycler_images]["+id+"][text]");
	 	
	} 

//makes cycler sortable
	$(".cycler_mgmt").sortable( {  
		placeholder: "ui-state-highlight",
		handle: ".handle",
		stop: function(event, ui) {  
		    var i = 0;  

		    $("li", this).each(function() {  
		        setInputName(this, i);                      						
		        i++;  
		    }); 
		    
			$(this).closest('.image_ID').html(i);
		    elementCounter = i;   

		},
		update: function(event, ui){
			$('#submit').trigger('click');

		}  
	}); 

}


/* ---------------------------------------------------------------------------- 
					Image Carousel Settings 
-------------------------------------------------------------------------------- */
// clean this shit up - use a switch case and class things more abstractly

if( $('.pluginSelect').length ){

	$('.pluginSelect').change(function(){
		var thisVal = $(this).val();
		if(thisVal == 'nivo'){
			$(".nivoOptions").fadeIn();
			$(".singleOptions").fadeOut();
			$('.effectSelect').empty(); //remove old options
			var effects = ['random','sliceDown','sliceDownLeft','sliceUp','sliceUpLeft','sliceUpDown',
	'sliceUpDownLeft','fold','fade','slideInRight','slideInLeft','boxRandom','boxRain',
	'boxRainReverse','boxRainGrow','boxRainGrowReverse'];
			//loops array and appends each option to the select box
			for(var i = 0; i< effects.length; i++){
					$('.effectSelect').append($("<option></option>").attr("value", effects[i]).text(effects[i])).fadeIn();
				}
		}else if(thisVal == 'piecemaker3d'){
			$(".nivoOptions").fadeOut();
			$(".singleOptions").fadeOut();
			$('.effectSelect').empty(); //remove old options
			var effects = ["linear","easeInSine","easeOutSine", "easeInOutSine", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeOutInCubic", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeOutInQuint", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeOutInCirc", "easeInBack", "easeOutBack", "easeInOutBack", "easeOutInBack", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeOutInQuad", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeOutInQuart", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeOutInExpo", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeOutInElastic", "easeInBounce", "easeOutBounce", "easeInOutBounce", "easeOutInBounce"];
			//loops array and appends each option to the select box
			for(var i = 0; i< effects.length; i++){
					$('.effectSelect').append($("<option></option>").attr("value", effects[i]).text(effects[i]));
				}
		}else if(thisVal == 'flexslider2'){
			$(".nivoOptions").fadeOut();
			$(".singleOptions").fadeOut();
			$('.effectSelect').empty(); //remove old options
			var effects = ["fade","slide"];
			for(var i = 0; i< effects.length; i++){
					$('.effectSelect').append($("<option></option>").attr("value", effects[i]).text(effects[i])).fadeIn();
			}
		}else if(thisVal == 'single image'){
			$(".singleOptions").fadeIn();
			$(".nivoOptions").fadeOut();
			$('.effectSelect').fadeOut(); //remove old options
		}else{
			$(".nivoOptions").fadeOut();
			$(".singleOptions").fadeOut();
			$('.effectSelect').fadeOut(); //remove old options
		}
	});

	
}


});