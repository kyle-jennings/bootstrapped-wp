
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
