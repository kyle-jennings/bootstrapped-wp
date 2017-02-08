$('.minicolors').each(function(){

  $(this).minicolors({
    opacity: $(this).hasClass('opacity'),
    change: function(hex, opacity) {
      var text = $(this).minicolors('rgbaString');
      var $parent = $(this).closest('.option.ColorPicker');
      $parent.next('.option.Hidden').find('input').val(text);
    },
    hide: function(hex, opacity){

      var $this = $(this);
      var rgba = $(this).minicolors('rgbaString');
      var section = '';
      var field = $this.attr('name');
      var value = $this.minicolors('value');
      var end_pos = field.indexOf('_',4);

			section = field.substring(4,end_pos);
			window.field = field;

      // kjd_send_preview_data(section, field, rgba, field);

    }
  });

});


$('.clearColor').on('click',function(){
	$(this).siblings('.minicolors').find('input').val('');
	$(this).siblings('.minicolors').find('.minicolors-swatch span').css('background','none');
});
