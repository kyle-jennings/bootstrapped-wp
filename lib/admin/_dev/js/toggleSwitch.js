

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
