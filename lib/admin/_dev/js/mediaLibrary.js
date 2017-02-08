/* ---------------------------------------------------------------
 Media Manager Settings
 ----------------------------------------------------------------- */
var file_frame;

$('.upload_image').click( function(e){

  e.preventDefault();
  var $this = $(this);
  var $preview = $this.closest('.option').find('.image_preview');
  var url = '';
  var image = '';


    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      delete file_frame;
    }

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: $( this ).data( 'uploader_title' ),
      button: {
        text: $( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
        // We set multiple to false so only get one image from the uploader
    attachment = file_frame.state().get('selection').first().toJSON();

    url = attachment.url;
    $this.prev('.media_input').val(url);

    image = '<img style="max-height:100%;" src=' + url + ' />';
    $preview.html(image);


    // if this is on the image banner images pages
    if('#add_image') {

      var $frame = $this.closest('.cycler_image').find('iframe').contents();
      $frame.find('body').css('background-image','url('+url+')');

    }

    });

    // Finally, open the modal
    file_frame.open();

});
