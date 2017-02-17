
if( $('.preview-window').length < 0)
	return;


$('body').addClass('folded');




$('.bswp-form  input, .bswp-form select, .custom-styles').not('.preview-size').change(function(){

  var $this = $(this);
  var rgba = $(this).minicolors('rgbaString');
  var section = '';
  var field = $this.attr('name');
  var value = $this.minicolors('value');


  var parts = field.split('[');
  section = parts[0];
  section = section.substring(5, section.length);

	if($this.hasClass('custom-styles')){
		section = 'custom_styles';
		value = $this.text();
	}

	send_to_preview.init(section, field, value);

});
