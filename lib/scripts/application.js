jQuery(document).ready(function($) {  


	$('#sidr-toggle').sidr();

	$("input[type=submit], button").addClass("btn");


	var logo_width = $('.logo a img').width();
	var maxWidth = 0;
	var maxHeight = 0;
	$('.logo').width(logo_width);
	
	$('.cyclerImage').each(function(){
		maxWidth = (maxWidth > $(this).width()) ? maxWidth : $(this).width();

		maxHeight = (maxHeight > $(this).height()) ? maxHeight : $(this).height();
  	$('#cycler').width(maxWidth);
  	$('#cycler').height(maxHeight);
	}); 


	var bodyCSS = $('#body').css(["background-color", "background-position", "background-repeat", "background-image" ]);
	//alert(bodyCSS);

	// applies styling to thumbnails
	$('.image > *').first().addClass('thumbnail');

	//fixes page flexslider
	$('.flexslider img').removeClass();
	//fixes page carousel
	
	$('.carousel img').removeClass();
	$('.carousel img').wrap('<div class="item"></div>');

	$('.accordion .accordion-toggle').click(function(){
		$(this).closest('.accordion-group').siblings().find('.accordion-toggle').addClass('collapsed');
	});

	$('.tabs-right').each(function(){
		var navHeight = $(this).find("ul").height(); 
		$(this).find(".tab-content").css("min-height",navHeight);
	});

	$('.tabs-left').each(function(){
		var navHeight = $(this).find("ul").height(); 
		$(this).find(".tab-content").css("min-height",navHeight);
	});
	

	$( '#submit' ).addClass( 'btn btn-primary btn-large' );
	$( '#wp-calendar' ).addClass( 'table table-striped table-bordered' );
	

});
