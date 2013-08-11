jQuery(document).ready(function($) {  

	if( $('#wpadminbar').length ){
		$('.navbar.navbar-fixed-top').css('top','28px');
	}

	if($('.nav-dividers').length ){
		$('.nav > .menu-item').after('<li class="divider-vertical"></li>');
		
	}

	if($('.elastislide-list').length ){
		$('#carousel').elastislide();
	}

	if ($("#sidr-toggle").is('*')){
		$('#sidr-toggle').sidr();
	}
	

	if( $('input[type=submit]').length || $('button').length){
		$("input[type=submit], button").addClass("btn");
		$( '.widget .search-form input[type=submit]' ).addClass( 'btn btn-primary btn-large' );
	}


	// var logo_width = $('.logo a img').width();
	// var maxWidth = 0;
	// var maxHeight = 0;

	// $('.logo').width(logo_width);
	
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
