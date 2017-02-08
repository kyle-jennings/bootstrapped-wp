
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
