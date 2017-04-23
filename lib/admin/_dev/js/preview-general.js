
if( $('.preview-window').length < 0)
	return;


$('body').addClass('folded');

$('.bswp-form input, .bswp-form select, .custom-styles').not('.js--no-css-change').change(function(){

  var $this = $(this);
  var previewType = $this.data('preview');


  var rgba = $(this).minicolors('rgbaString');
  var section = '';
  var field = $this.attr('name');
  var value = $this.minicolors('value');


  var parts = field.split('[');
  section = parts[0];
  section = section.substring(5, section.length);

  // i dont recall what this was, i think its the
	if($this.hasClass('custom-styles')){
		section = 'custom_styles';
		value = $this.text();
	}


  // preview type
  if(previewType == 'form_save_warning'){

    $this.parent().addClass('save-warning');
    $this.closest("form").find("#submit").parent().addClass('save-warning');

  }else if(previewType == 'ajax'){
    var deps = $this.data('preview_deps');

    ajax_preview.init(section, field, value, deps);

  }else if(previewType == 'toggle-class'){
    var dataToggles = $this.data('toggle_class');
    var toggles = dataToggles.split(';');
    var $preview = $('iframe.preview-window');
    toggles.forEach(function(e,i,a){
        var parts = e.split('=>');
        var elm = parts[0];
        var classname = parts[1];
        $preview.contents().find(elm).toggleClass(classname);
    });


  }else if(previewType == 'auto'){

    send_to_preview.init(section, field, value);

  }else{
    $this.parent().addClass('save-warning');
    $this.closest("form").find("#submit").parent().addClass('save-warning');
  }


});
