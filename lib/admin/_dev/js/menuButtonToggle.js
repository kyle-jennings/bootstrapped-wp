
  // menu button selector

  $('.menu-button-select select').change(function(){

  	var $this = $(this),
  		$parent = $this.closest('.option'),
  		thisVal = $this.val();

  	$parent.siblings('.option-group').fadeOut();
  	switch( thisVal ){

  		case 'default':
  			$('.hamburger-colors').fadeIn();
  			break;

  		case 'hamburger':
  			$('.hamburger-colors').fadeIn();
  			break;

  		case 'image':
  			$('.image-button').fadeIn();
  			break;

  		case 'button':
  			$('.text-settings').fadeIn();
  			$('.button-settings').fadeIn();

  			break;

  		case 'text':
  			$('.text-settings').fadeIn();
  			break;
  	}
  });
