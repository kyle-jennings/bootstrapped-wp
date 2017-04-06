$('.js--sidebar-setting').on('change', function(e){

  var $this = $(this);
  var $parent = $this.closest('.field');
  var $selects = $parent.find('select');
  var name = $parent.find('input[type=hidden]').attr('name');
  var parts = name.split('[');
  var section = parts[0];
  section = section.substring(5, section.length);
  var data = {};

  $selects.each(function(idx){
    var $thisSel = $(this);
    var name = $thisSel.data('name');
    var value = $thisSel.val();

    data[name] = value;
  });

  data.target = parts[3].replace(']','');

  ajax_preview.init(section, name, data, '');


});
