jQuery(document).ready(function($) {  

	if( $('#wpadminbar').length ){
		// $('html').css('padding-top', $('#wpadminbar').outerHeight() );
	}

	if($('.process').length ) {

		var $color = $('.clickArea');

		$color.click(function(){
			var details = $(this).closest('li').attr('class')+'Text';
			details = details.replace('span2 ','');
			var $this = $(this);
			$this.stop().animate({
		        opacity: 0
		    }, 300).closest('li').siblings().find('.clickArea').animate({
		        opacity: 1
		    }, 300);

			$('p.'+details).stop().fadeIn().siblings('.processText').fadeOut();

		});

	}

	// checks to see if the menu has dividers on
	if($('.nav-dividers').length ){
		$('.nav > .menu-item').after('<li class="divider-vertical"></li>');
	}

	//carousel hook
	if($('.elastislide-list').length ){
		$('#carousel').elastislide();
	}

	// sidr hook
	if($('#sidr').length){
		$('#sidr-toggle').sidr();
	}
	

	// adds btn class to submit input types
	$("input[type=submit], button").addClass("btn");
	$( '.widget .search-form input[type=submit]' ).addClass( 'btn btn-primary btn-large' );


	//I dont know if this is even being used anymore
	if( $('.cyclerImage').length ){
		$('.cyclerImage').each(function(){
			maxWidth = (maxWidth > $(this).width()) ? maxWidth : $(this).width();

			maxHeight = (maxHeight > $(this).height()) ? maxHeight : $(this).height();
	  	$('#cycler').width(maxWidth);
	  	$('#cycler').height(maxHeight);
		}); 
		
	}


	// applies styling to thumbnails
	if( $('.image') ){
		$('.image > *').first().addClass('thumbnail');
	}

	//fixes page flexslider
	if( $('.flexslider').length ){
		$('.flexslider img').removeClass();
	}


	/* Presentation Componenets */

	if( $('.accordion') ){

		$('.accordion .accordion-toggle').click(function(){
			$(this).closest('.accordion-group').siblings().find('.accordion-toggle').addClass('collapsed');
		});

	}


	if( $('.tabbable') ){

		$('.tabs-right').each(function(){
			var navHeight = $(this).find("ul").height(); 
			$(this).find(".tab-content").css("min-height",navHeight);
		});

		$('.tabs-left').each(function(){
			var navHeight = $(this).find("ul").height(); 
			$(this).find(".tab-content").css("min-height",navHeight);
		});
	}
	
	
	if( $('table').length ){
		
		$( '.widget table' ).addClass( 'table table-striped table-bordered' );
		$( '.widget table tr:last-child td' ).css( 'border-radius','0' );
	
	}

});
