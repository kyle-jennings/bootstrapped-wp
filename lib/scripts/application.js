jQuery(document).ready(function($) {


  // no idea what this is
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






	// adds btn class to submit input types
	$("input[type=submit], button").addClass("btn");
	$( '.widget .search-form input[type=submit]' ).addClass( 'btn btn-primary btn-large' );



	// applies styling to thumbnails
	if( $('.image') ){
		$('.image > *').first().addClass('thumbnail');
	}


	/* Presentation Componenets */
	if( $('.accordion') ){
		$('.accordion .accordion-toggle').click(function(){
			$(this).closest('.accordion-group').siblings().find('.accordion-toggle').addClass('collapsed');
		});

	}


  $(".alert .close").on('click', function(e){
    e.preventDefault();
    $(this).closest('.alert').fadeOut();
  });

// tool tips
$('.word--tooltip').hover(function(e){
  e.preventDefault();

  $(this).tooltip('toggle');
});


  // popovers

    $('.word--popover').popover();
    $('.word--popover').on('click',function(e){
        e.preventDefault();
    });



    // tabables
    $('.tabbable .nav-tabs a').click(function (e) {
      e.preventDefault();
      var $this = $(this);
      $this.closest('li').addClass('active').siblings().removeClass('active');
      var target = $this.attr('href');
      var $parent = $this.closest('.tabbable');
      var $tabContent = $parent.find('.tab-content .tab-pane'+target);
      $tabContent.addClass('active').siblings().removeClass('active');
    //   $(this).tab('show');
    });

  // tabbable height
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


  // tables
	if( $('table').length ){
		$( '.widget table' ).addClass( 'table table-striped table-bordered' );
		$( '.widget table tr:last-child td' ).css( 'border-radius','0' );

	}

  // Navbar

  $('.dropdown-toggle').dropdown();
	// checks to see if the menu has dividers on
	if($('.nav-dividers').length ){
		$('.nav > .menu-item').after('<li class="divider-vertical"></li>');
	}

  // sticky navbar
  if($('#navbar.js--stick-to-top-on-scroll').length > 0 ){
    stick_navbar_to_top($);
  }


  setInterval(function(){
    if($('#navbar.js--stick-to-top-on-scroll.preview').length > 0 ){
      stick_navbar_to_top($);
    }
  }, 1000);


});



function stick_navbar_to_top($) {
  var $navbar = $('#navbar.js--stick-to-top-on-scroll');
  var navbarOffset = $navbar.offset().top;
  var adminBarHieght = $('#wpadminbar').outerHeight();
  $(window).scroll(function() {
    var scrollTop = $(window).scrollTop() + adminBarHieght ;

    if ( scrollTop > navbarOffset) {
      $navbar.addClass('navbar-fixed-top');

    }
    else {
      $navbar.removeClass('navbar-fixed-top');
    }
  });
}
