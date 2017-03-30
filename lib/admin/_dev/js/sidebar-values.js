$('.js--sidebar-setting').on('change', function(e){

  var $this = $(this);
  var $parent = $this.closest('.field');
  var $selects = $parent.find('select');

  var collection = {};

  $selects.each(function(idx){
    var $thisSel = $(this);
    var name = $thisSel.data('name');
    var value = $thisSel.val();

    collection[name] = value;
  });

  var val = JSON.stringify(collection);

  $parent.find('input[type=hidden]').val(val);
});
