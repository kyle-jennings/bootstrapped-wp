jQuery(document).ready(function() {   

jQuery('form').submit(function(e){
	var $activeTab = jQuery('.tabbable .tab-pane.active');
	jQuery('#active_tab').val($activeTab.attr('id'));
});

jQuery('.float-toggle select').change(function(){
	if(jQuery(this).val()=='true'){
		jQuery(this).closest('.float-toggle').next('.float-option input').disabled = false;
		jQuery(this).closest('.float-toggle').next('.float-option').fadeIn();
	}else{
		jQuery(this).closest('.float-toggle').next('.float-option input').disabled = true;
		jQuery(this).closest('.float-toggle').next('.float-option').fadeOut();
	}
});


jQuery('.cycler_image > .handlediv').click(function(){
	jQuery(this).siblings('.inside').slideToggle();

});

//////////////////////
// mini color stuff

jQuery('.minicolors').minicolors({
	opacity: true,
	change: function(hex, opacity) {
		
		// text = hex ? hex : 'transparent';
		// if( opacity ) text += ', ' + opacity;
		// text = jQuery(this).minicolors('rgbaString');
		// jQuery(this).val(text);
	}
});

jQuery('.clearColor').click(function(){
	jQuery(this).prev('.minicolors').find('input').val('');
	jQuery(this).prev('.minicolors').find('.minicolors-swatch span').css('background','none');
});

/////////////////////////////
// hide shit
/////////////////////////////
  	jQuery('.decorationList').change(function(){
		var thisVal = jQuery(this).val();
		if(thisVal != 'text-shadow'){
			jQuery(this).parent().next('.shadowColor').fadeOut(function(){
				jQuery('.shadowColor').find('select').val('');
			});
		}else{ jQuery(this).parent().next('.shadowColor').fadeIn(); }
	});


// posts layout options

jQuery('.post-listing-toggle').change(function(){
	var thisVal = jQuery(this).val();
	console.log(thisVal);
	var $settings = jQuery('.image-settings');
	if(thisVal == 'excerpt'){
		$settings.fadeIn();
	}else{
		$settings.fadeOut();
	}
});



jQuery('.featured-image-toggle').change(function(){
	var thisVal = jQuery(this).val();
	var $settings = jQuery('.featured-image-settings');
	if(thisVal == 'yes'){
		$settings.fadeIn();
	}else{
		$settings.fadeOut();
	}
});

jQuery('.posts-background-toggle').change(function(){
	var thisVal = jQuery(this).val();
	var $settings = jQuery('.posts-background-settings');
	if(thisVal == 'yes'){
		$settings.fadeIn();
	}else{
		$settings.fadeOut();
	}
});

jQuery('.single-post-background-toggle').change(function(){
	var thisVal = jQuery(this).val();
	var $settings = jQuery('.single-post-background-settings');
	if(thisVal == 'yes'){
		$settings.fadeIn();
	}else{
		$settings.fadeOut();
	}
});

////////////////////////////
// responive design options
////////////////////////////

	if(jQuery('.toggleDisplaySwitch').val() == 'true'){
		jQuery('.toggleDisplaySwitch').parent().next('.toggleDisplay').hide();
	}

	jQuery('.toggleDisplaySwitch').change(function(){
		var thisVal = jQuery(this).val();
		if(thisVal == 'true'){
			jQuery(this).parent().next('.toggleDisplay').fadeOut(function(){
				jQuery('#confineOption').find('select').val('false');
				jQuery('#boxShadow').find('select').val('false');
			});
		}else{ jQuery(this).parent().next('.toggleDisplay').fadeIn(); }
	});	
////////////////////////
//options media uploader
////////////////////////
	var uploadBtn;
	jQuery('.upload_logo_button').click(function() {  
	var uploadBtn = jQuery(this);
	  tb_show('Upload something', 'media-upload.php?referer=wp-settings&type=image&TB_iframe=true&post_id=0', false);  

	
		if(jQuery('.upload_option').is(':visible')){

			window.send_to_editor = function(html) {  
				var image_url = jQuery('img',html).attr('src');  
				jQuery(uploadBtn).prev('input').val(image_url); 
				jQuery(uploadBtn).next('.logo_preview img').attr('src',image_url); 
				tb_remove();  
			}  
		}
	  return false;  
  });  
///////////////////////////////
//  google font preview
///////////////////////////////
	// jQuery('.google_fonts').change(function(){	
	// 	var font = jQuery(".google_fonts :selected").val();
	// 	font = "'"+font.replace(/\+/g,' ')+"'";
	// 	jQuery(this).next('.font_preview').find('span').css('font-family',font);
	// });

//////////////////////////////
//  page layout preview
//////////////////////////////
	jQuery('.layout_select').change(function(){

		var temp = jQuery(this).val();
		temp = '.'+temp;
		jQuery(this).next('.layout_preview').find(temp).siblings().fadeOut();	
		jQuery(this).next('.layout_preview').find(temp).fadeIn();
	});

	//////////////////////////////
	//  front page layout
	////////////////////////////// 
	function setComponentNames(element, id) {  
		var newId = "componentOrder_" + id;      
		jQuery(element).attr("id", newId);                 
       	jQuery(".labelID", element).html(id);
 
	 	jQuery(".component", element).attr("name", "kjd_frontPage_layout_settings[kjd_frontPage_layout]["+id+"][component]");
	 	jQuery(".componentDisplay", element).attr("name", "kjd_frontPage_layout_settings[kjd_frontPage_layout]["+id+"][display]");
	 	jQuery(".componentDisplay", element).val('on');
	} 

	function removeComponentNames(element, id) {  
		var newId = "componentOrder_" + id;      
		 
	 	jQuery(".component", element).attr("name", "");
	 	jQuery(".componentDisplay", element).attr("name", "");
	 	jQuery(".componentDisplay", element).val('off');
	} 

	//makes cycler sortable
	jQuery("#activeComponents,#inactiveComponents").sortable({  
		placeholder: "ui-state-highlight",
		connectWith: ".connectedSortable",
		update: function(event, ui) {  

	    	var container = jQuery(this).closest('.connectedSortable').attr('id');
	    	
	    	if(container == 'activeComponents'){
	    		var i = 0;  
			    jQuery("li", this).each(function() {  
			        setComponentNames(this, i);
			        i++;  
			    }); 
	    	}else{
	    		var i = 0;  
			    jQuery("li", this).each(function() {  
			        removeComponentNames(this, i);
			        i++;  
			    }); 	    		
	    	}
     
		}, receive: function(){
			
	    	var container = jQuery(this).closest('.connectedSortable').attr('id');
	    	
	    	if(container == 'activeComponents'){
	    		var i = 0;  
			    jQuery("li", this).each(function() {  
			        setComponentNames(this, i);
			        i++;  
			    }); 
	    	}else{
	    		var i = 0;  
			    jQuery("li", this).each(function() {  
			        removeComponentNames(this, i);
			        i++;  
			    }); 	    		
	    	}
		}

	});
	jQuery( "#activeComponenets" ).disableSelection();

	//////////////////////////////
	//  image cycler admin
	////////////////////////////// 

	var totalCount = jQuery('#totalCount').val();
	var elementCounter = 0; 

	jQuery('#element_counter').val(elementCounter);

	// remove image
	jQuery(".remove_image").click(function() {  

		if(totalCount<2){
			alert("Sorry, you need at lease one image.");
		}else{
			totalCount--;
			jQuery('#total_elements').val(totalCount);
			jQuery(this).closest('li').fadeOut( function() { jQuery(this).remove(); });
			jQuery('.banner_image_options').resize();
			jQuery('#element_counter').val('0');
			jQuery('form').submit();		
		}

	});

	// add new image to cycler
	jQuery("#add_image").click(function() {   
		jQuery('#element_counter').val('1');
		jQuery('form').submit();

		return false;  
	});

	// submits form and resets image counter
	jQuery("#submit").click(function() {   
		jQuery('#element_counter').val('0');
		jQuery('form').submit();

		return false;  
	});

	///////////////////////////
	// image sorting
	///////////////////////////
	// function called by sortable to rename inputs
	function setInputName(element, id) {  
		var newId = "banner_element_" + id;      
		              
		jQuery(element).attr("id", newId);                 
		                
	 	jQuery(".url", element).attr("name", "kjd_cycler_images_settings[kjd_cycler_images]["+id+"][url]");
	 	jQuery(".alt", element).attr("name", "kjd_cycler_images_settings[kjd_cycler_images]["+id+"][alt]");
	 	// jQuery(".text", element).attr("name", "kjd_cycler_images_settings[kjd_cycler_images]["+id+"][text]");
	 	jQuery(".tmce-active textarea", element)
	 		  .attr("name", "kjd_cycler_images_settings[kjd_cycler_images]["+id+"][text]");
	 	
	} 
	//makes cycler sortable
	jQuery(".cycler_mgmt").sortable( {  
		placeholder: "ui-state-highlight",
		handle: ".handle",
		start: function(e, ui){

		    jQuery(this).find('.tmce-active').each(function(){
		        tinyMCE.execCommand( 'mceRemoveControl', false, jQuery(this).attr('id') );
		    });
		},
		stop: function(event, ui) {  
		    var i = 0;  

		    jQuery("li", this).each(function() {  
		        setInputName(this, i);                      						
		        i++;  
		    }); 
		    
				jQuery(this).closest('.image_ID').html(i);
		    elementCounter = i;   

	        jQuery(this).find('.tmce-active').each(function(){
		        tinyMCE.execCommand( 'mceAddControl', true, jQuery(this).attr('id') );
		        jQuery(this).sortable("refresh");
		    });
		}  
	}); 
/////////////// end image sorting


	//effects for cycler
	jQuery('.pluginSelect').change(function(){
		var thisVal = jQuery(this).val();
		if(thisVal == 'nivo'){
			jQuery(".nivoOptions").fadeIn();
			jQuery(".singleOptions").fadeOut();
			jQuery('.effectSelect').empty(); //remove old options
			var effects = ['random','sliceDown','sliceDownLeft','sliceUp','sliceUpLeft','sliceUpDown',
'sliceUpDownLeft','fold','fade','slideInRight','slideInLeft','boxRandom','boxRain',
'boxRainReverse','boxRainGrow','boxRainGrowReverse'];
			//loops array and appends each option to the select box
			for(var i = 0; i< effects.length; i++){
					jQuery('.effectSelect').append(jQuery("<option></option>").attr("value", effects[i]).text(effects[i]));
				}
		}else if(thisVal == 'piecemaker3d'){
			jQuery(".nivoOptions").fadeOut();
			jQuery(".singleOptions").fadeOut();
			jQuery('.effectSelect').empty(); //remove old options
			var effects = ["linear","easeInSine","easeOutSine", "easeInOutSine", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeOutInCubic", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeOutInQuint", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeOutInCirc", "easeInBack", "easeOutBack", "easeInOutBack", "easeOutInBack", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeOutInQuad", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeOutInQuart", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeOutInExpo", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeOutInElastic", "easeInBounce", "easeOutBounce", "easeInOutBounce", "easeOutInBounce"];
			//loops array and appends each option to the select box
			for(var i = 0; i< effects.length; i++){
					jQuery('.effectSelect').append(jQuery("<option></option>").attr("value", effects[i]).text(effects[i]));
				}
		}else if(thisVal == 'flexslider2'){
			jQuery(".nivoOptions").fadeOut();
			jQuery(".singleOptions").fadeOut();
			jQuery('.effectSelect').empty(); //remove old options
			var effects = ["fade","slide"];
			for(var i = 0; i< effects.length; i++){
					jQuery('.effectSelect').append(jQuery("<option></option>").attr("value", effects[i]).text(effects[i]));
			}
		}else if(thisVal == 'single image'){
			jQuery(".singleOptions").fadeIn();
			jQuery(".nivoOptions").fadeOut();
			jQuery('.effectSelect').fadeOut(); //remove old options
		}else{
			jQuery(".nivoOptions").fadeOut();
			jQuery(".singleOptions").fadeOut();
			jQuery('.effectSelect').fadeOut(); //remove old options
		}
	});


});