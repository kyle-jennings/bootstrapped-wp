/**
 * reusable function to toggle fields
 * this is run whenver a select is changed and on page load
 */
function toggleFields($this) {

  var $tabPane = $this.closest('.js--fields-group');
  var thisVal = $this.val();
  var thisData = $this.data('field-toggle');
  var targetData = $('option:selected', $this).attr('data-targets');

  var $fieldFamily = $tabPane.find('.js--toggled-field.'+thisData);

  $fieldFamily.fadeOut();
  // if an option with a field toggle was selected
  if( !targetData )
		return;

  // split the results up (there might be a few)
  var targetFields = targetData.split(',');

  // loop through all the fields that could be toggled by the select
  $.each($fieldFamily, function(i,e){
    var $e = $(e);
    var toggleName = $e.data('toggle-name');
    // console.log($.inArray(toggleName, targetFields));
    if( $.inArray(toggleName, targetFields) >= 0 ){
      // console.log(toggleName, targetFields);
      $e.fadeIn();
    }

  });


}

// whenever a field changes, check to see if we need to toggle something
$('.js--toggle-field').on('change',function(e) {
  var $this = $(this);
  toggleFields($this);
});


// whenever a select changes, check to see if we need to toggle something
$('.js--toggle-field').each(function(i,e){
  var $this = $(e);
  var $thisOption = $this.find('option:selected');

  if( $thisOption.attr('data-targets') ){
    toggleFields($this);
	}

});
