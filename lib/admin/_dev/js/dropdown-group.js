


$('.nav-dropdown--group a').on('click', function(e){

    e.preventDefault();

    var $this = $(this);
    var thisVal = $this.attr('href');
    var thisLabel = $this.text();

    var $groups = $('#groups-tabs');

    $this.addClass('active').siblings().removeClass('active');

    $groups.find(' > .tab-pane').removeClass('active');
    $groups.find(' > '+thisVal).addClass('active');

    $this.closest('.js--group-link').removeClass('active').prev('.components-nav__link--group').text(thisLabel);
    $('.js--overlay').removeClass('active');
});
