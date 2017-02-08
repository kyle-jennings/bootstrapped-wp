// I think this file toggles open collapsible divs

$('.js--extend-field').on('click',function(){
  var $this = $(this);
  var $wrapper = $this.closest('.option');
  var $icon = $wrapper.find('.dashicon');

  if( $wrapper.hasClass('open') ){
    $wrapper.removeClass('open');
  }else{
    $wrapper.addClass('open');

  }
});
