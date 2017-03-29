$('.js--sidebar-diagram-toggle').on('change', function(e){
  var $this = $(this);
  var val = $this.val();
  var classes = ['top', 'right', 'bottom', 'left'];
  var $diagram = $this.next('.diagram');

  classes.forEach(function(e,i,a){
    $diagram.removeClass(e);
  });
  $diagram.addClass(val);
});
