$('.bswp-form ').submit(function(e){
  // e.preventDefault();
  $target = $('#js--saved_fields');
  $target.val('yes');
  console.log( $target.val() );
});
