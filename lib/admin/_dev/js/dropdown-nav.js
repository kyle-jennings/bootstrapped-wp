
/**
 * Section dropdown in the new nav
 */
$('.js--nav-dropdown-toggle').on('click', function(e){
  e.preventDefault();
  var $this = $(this);
  var target = '#'+$this.data('target');
  var $target = $(target);

  if($target.find('a').length > 0){
    $target.toggleClass('active');
    $('.js--overlay').toggleClass('active');
  }


});
