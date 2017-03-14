$('.js--expand-textarea').on('click', function(e){
  e.preventDefault();
  if($('.preview-options').is(":visible"))
    $(this).closest('.field.TextArea').toggleClass('expand');
});
