// sticky navbar
var delayMillis = 6000; //1 second

setTimeout(function() {
  if($('#navbar.js--stick-to-top-on-scroll').length > 0){

    console.log('boom');
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

}, delayMillis);
