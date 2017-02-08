/* --------------------------------- Page Layouts ---------------------------------------- */
  $('.layout_select').change(function(){

    var temp = $(this).val();
    temp = '.'+temp;
    $(this).next('.layout_preview').find(temp).siblings().fadeOut();
    $(this).next('.layout_preview').find(temp).fadeIn();
  });

  $('.js--sidebar-preview').change(function(){
      var $this = $(this);
      var thisVal = $this.val();
      var $parent = $this.closest('.option');
      var $layout = $parent.next('.sidebar').find('.layout_preview');

      $layout.find('.'+thisVal).siblings().fadeOut();
      $layout.find('.'+thisVal).fadeIn();
  });
