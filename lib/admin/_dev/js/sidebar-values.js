$('.js--sidebar-setting').on('change', function(e){
  console.log('boom');
  var $this = $(this);
  var $parent = $this.closest('.SidebarPosition');
  var $siblings = $parent.find('select');

  var collection = [];

  $siblings.each(function(idx){
    var $thisSel = $(this);
    var name = $thisSel.data('name');
    var value = $thisSel.val();
    collection.push({
      name: name,
      value : value
    });
  });

  var val = JSON.stringify(collection);

  $parent.find('input[type=hidden]').val(val);
});
