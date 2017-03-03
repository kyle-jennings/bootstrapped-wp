
// update the nav links if they are activated
$('.js--group-link').on('click', function(e){
    e.preventDefault();
    var $this = $(this);
    var thisVal = $this.attr('href');

    $('#js--group-tab-field').val(thisVal);
    $currentTab = $(thisVal+'.tab-pane.group-content').find('.tab-content').find('.tab-pane').first();
    $('#js--field-tab-field').val($currentTab.attr('id'));
});


//
// if( $('#js--group-tab-field').val() ){
//     var thisVal = $('#js--group-tab-field').val();
//     $('#groups-tabs > .tab-pane').removeClass('active');
//     $('#groups-tabs > '+thisVal).addClass('active');
// }



$('.tab-switcher .dropdown-menu a').on('click',function(e) {
  e.preventDefault();

  var $this = $(this);
  var btnVal = $this.attr('href');

  $('#js--field-tab-field').val(btnVal);
});
