/**
 * reusable function to toggle fields
 * this is run whenver a select is changed and on page load
 */

function hasMultipleToggledBys(data, val){
  var tbCount = 0;
  for (var d in data) {
    if (data.hasOwnProperty(d)) {
        if(d.indexOf('toggled_by') > -1)
          tbCount++;
    }
  }

  return tbCount;
}


function calcMultipleToggledBysResult(data, $thisTabPane) {

  var result = false;
  var prevResult = false;
  var arr = [];
  for (var d in data) {
    if (data.hasOwnProperty(d)) {

        // only look at data keys that have "togled_by" in the name
        if(d.indexOf('toggled_by') > -1){

          // find the element matching the data key
          var t = d.replace('toggled_by_','');

          var $elm = $thisTabPane.find('[data-field_name="'+t+'"]');

          // if that element's value matches whats in teh data value mark it as true

          if($elm.val() == data[d] || data[d].indexOf($elm.val()) > -1 ){
            result = true;
            // else mark it false
          }else{
            return false;
          }


            // so long as result is never set to false, then it will return true
        }
    }
  } // end for in

  return result;

}


function toggleFields($this) {

  var $thisTabPane = $this.closest('.js--fields-group');
  var thisVal = $this.val();
  var thisFieldName = $this.data('field_name');
  var targetFields = $this.data('target_fields');

  // toggleable fields were found, we need to toggle them!
  if( targetFields ){
    // split the results up (there might be a few)
    targetFields = targetFields.split(',');

    // find the target fields
    targetFields.forEach(function(e,i,a){

      var $elm = $thisTabPane.find('.js--toggled-field[data-toggle_name="'+e+'"]');
      var dataAttrs = $elm.data();
      var hasMultipleToggleBys = hasMultipleToggledBys(dataAttrs);
      var toggled = false;


      // do we have multiple toggles?
      if(hasMultipleToggleBys > 1){
        toggled = calcMultipleToggledBysResult(dataAttrs, $thisTabPane);

      // if we only have one
      }else{
        var dataName = 'toggled_by_'+thisFieldName;

        // if(!dataAttrs || typeof dataAttrs === 'undefined')
        //   console.log($elm, dataAttrs);

        var elmDataToggledBy = dataAttrs[dataName];

        // if we do not have a toggled-by field then skip
        if(elmDataToggledBy == null)
          return;

        if(thisVal == elmDataToggledBy || elmDataToggledBy.indexOf(thisVal) > -1)
          toggled = true;
      }

      // toggle the fields
      if(toggled == true){
        $elm.fadeIn();
      }else{
        $elm.fadeOut();
      }

    });

  }



}

// whenever a field changes, check to see if we need to toggle something
$('.js--toggle-field').on('change',function(e) {

  var $this = $(this);
  toggleFields($this);
});


// whenever a select changes, check to see if we need to toggle something
$('.js--toggle-field').each(function(i,e){

  var $this = $(e);
  toggleFields($this);

});
