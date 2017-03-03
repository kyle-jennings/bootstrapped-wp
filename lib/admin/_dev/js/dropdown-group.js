
/**
 * Section dropdown in the new nav
 */
// $('.js--sections-dropdown-toggle').on('click', function(e){
//   e.preventDefault();
//   $('.js--sections-dropdown').toggleClass('active');
// });


$('.js--group-link').on('click', function(e){

    e.preventDefault();

    var $this = $(this);
    var thisVal = $this.attr('href');
    var $groups = $('#groups-tabs');

    $this.addClass('active').siblings().removeClass('active');
    console.log(thisVal);
    $groups.find(' > .tab-pane').removeClass('active');
    $groups.find(' > '+thisVal).addClass('active');
});
