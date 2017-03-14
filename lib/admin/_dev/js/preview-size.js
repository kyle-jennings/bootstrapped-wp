
/**
 * Changes the live preview window size
 */
$('.preview-size').change(function(){
	var size = $(this).val();
	var width;

	switch(size){
		case 'desktop':
			width = '100%';
			break;
		case 'tablet':
			width = '800px';
			break;
		case 'phone':
			width = '480px';
			break;
	}

	// document.cookie='previewSize='+size;
	$('.preview-window').css('width', width);

});
