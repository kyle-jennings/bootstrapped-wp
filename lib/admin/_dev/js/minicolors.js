$('.minicolors').each(function(){

  $(this).minicolors({
    opacity: $(this).hasClass('opacity'),
    change: function(hex, opacity) {

      var text = $(this).minicolors('rgbaString');
      var $parent = $(this).closest('.field.ColorPicker');
      $parent.next('.field.Hidden').find('input').val(text);

    },
    hide: function(hex, opacity){

      var $this = $(this);
      var rgba = $(this).minicolors('rgbaString');
      var section = '';
      var field = $this.attr('name');
      var value = $this.minicolors('value');


			var parts = field.split('[');
      section = parts[0];
      section = section.substring(5, section.length);


      send_to_preview.init( section, field, rgba );

    }
  });

});


$('.clearColor').on('click',function(){
	$(this).siblings('.minicolors').find('input').val('');
	$(this).siblings('.minicolors').find('.minicolors-swatch span').css('background','none');

  var $parent = $(this).closest('.field.ColorPicker');
  $parent.next('.field.Hidden').find('input').val('rgba(0,0,0,0)');

  var $this = $(this).prev('.minicolors').find('.minicolors-input');
  var section = '';
  var field = $this.attr('name');
  var value = $this.val();
  var end_pos = field.indexOf('_',4);
  var arrayName = field;

  section = field.substring(4, end_pos);

  send_to_preview.init(section, field, value);
});
