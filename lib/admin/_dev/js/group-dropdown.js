
/**
 * Section dropdown in the new nav
 */
$('.js--sections-dropdown-toggle').on('click', function(e){
  e.preventDefault();
  $('.js--sections-dropdown').toggleClass('active');
});



// update the nav links if they are activated
$('.js--group-link').on('click', function(){
    var $this = $(this);
    var thisVal = $this.attr('href');
    $this.addClass('active').siblings().removeClass('active');
    $('#js--group-tab-field').val(thisVal);
});


if( $('#js--group-tab-field').val() ){
    var thisVal = $('#js--group-tab-field').val();
    $('#groups-tabs > .tab-pane').removeClass('active');
    $('#groups-tabs > '+thisVal).addClass('active');
}
