$('.js--expand-textarea').on('click', function(e){
  e.preventDefault();
  
  $(this).closest('.field.TextArea').toggleClass('expand');
});
