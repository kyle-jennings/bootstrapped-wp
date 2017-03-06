$('.nav-dropdown a').on('click', function(e){

    e.preventDefault();

    var $this = $(this);
    var thisVal = $this.attr('href');
    var thisLabel = $this.text();
    var $parent = $this.closest('.nav-dropdown');
    var parentID = $parent.attr('id');

    var target = $this.data('target');
    var $targetElm = $(target);

    if(typeof target == 'undefined' || !target){
      var origin = window.location.origin;
      var path = window.location.pathname;
      window.location.href = origin+path+thisVal;
      return;
    }

    var $groupTabTarget = $('.components-nav__link-wrapper'+thisVal+'-tabs-nav-wrapper');


    $this.addClass('active').parent('li').siblings().find('a').removeClass('active');

    // activate the tab
    $targetElm.find(' > '+thisVal).addClass('active').siblings().removeClass('active');
    // $targetElm.find(' > .tab-pane').removeClass('active');

    // activate the group's tabs
    $groupTabTarget.removeClass('hide').siblings('.components-nav__link-wrapper').addClass('hide');

    // add label to dropdown and remove overlay
    $parent.removeClass('active').prev('.js--nav-dropdown-toggle[data-target="'+parentID+'"]').text(thisLabel);
    $('.js--overlay').removeClass('active');
});
