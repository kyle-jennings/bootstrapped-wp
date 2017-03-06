
// update the nav links if they are activated
$('.nav-dropdown a.group-nav').on('click', function(e){
    e.preventDefault();
    var $this = $(this);
    var thisVal = $this.attr('href');

    $('#js--group-tab-field').val(thisVal);
    $currentTab = $(thisVal+'.tab-pane.group-content').find('.tab-content').find('.tab-pane').first();
    $('#js--field-tab-field').val($currentTab.attr('id'));
});


$('.nav-dropdown a.tab-nav').on('click',function(e) {
  e.preventDefault();

  var $this = $(this);
  var btnVal = $this.attr('href');

  $('#js--field-tab-field').val(btnVal);
});
