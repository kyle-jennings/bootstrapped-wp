if($('.js--sortables').length <= 0)
  return;

var $sortableList = $('.js--sortables');
var $groupWrapper = $sortableList.closest('.sortables');
var siblingsName = $sortableList.data('sortable-group');
var $active = $('.js--sortable-active');
var fieldTarget = $active.data('field-target');
var $field = $('#'+fieldTarget);

// inits the sortable and does things
$sortableList.sortable({
  placeholder: 'ui-state-highlight',
  connectWith: siblingsName,
	update: function(event, ui) {
    var $this = $(this);

    var activeComponentsStr = '';

    activeComponentsStr = get_active_sortables($active);

    $field.val(activeComponentsStr);
  },
  receive: function(e){}
});

// when the visibility changes
$('.sortable__visibility select').on('change', function(e){
  var $this = $(this);
  var thisVal = $this.val();

  var activeComponentsStr = get_active_sortables($active);
  $field.val(activeComponentsStr);

});

// gets the active sortables and sets their settings/positions to a string to be saved
function get_active_sortables($active){
  var activeComponents = [];

  // loop through the active components and collect their data
  $active.find('li').each(function(idx) {
      var $thisComp = $(this);
      var component = $thisComp.attr('id');
      var visibility = $thisComp.find('select').val();

      activeComponents.push({
        name: component,
        visibility : visibility
      });
  });
  // stringify the array into a string and return
  return JSON.stringify(activeComponents);
}
