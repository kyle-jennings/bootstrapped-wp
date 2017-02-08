
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
  			var effects = ["linear",
        "easeInSine",
        "easeOutSine",
        "easeInOutSine",
        "easeInCubic",
        "easeOutCubic",
        "easeInOutCubic",
        "easeOutInCubic",
        "easeInQuint",
        "easeOutQuint",
        "easeInOutQuint",
        "easeOutInQuint",
        "easeInCirc",
        "easeOutCirc",
        "easeInOutCirc",
        "easeOutInCirc",
        "easeInBack",
        "easeOutBack",
        "easeInOutBack",
        "easeOutInBack",
        "easeInQuad",
        "easeOutQuad",
        "easeInOutQuad",
        "easeOutInQuad",
        "easeInQuart",
        "easeOutQuart",
        "easeInOutQuart",
        "easeOutInQuart",
        "easeInExpo",
        "easeOutExpo",
        "easeInOutExpo",
        "easeOutInExpo",
        "easeInElastic",
        "easeOutElastic",
        "easeInOutElastic",
        "easeOutInElastic",
        "easeInBounce",
        "easeOutBounce",
        "easeInOutBounce",
        "easeOutInBounce"];
  			//loops array and appends each option to the select box
  			for(var int = 0; int< effects.length; int++){
  					$('.effectSelect').append($("<option></option>").attr("value", effects[int]).text(effects[int]));
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
