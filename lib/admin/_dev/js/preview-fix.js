var previewWindow = $('.preview-options').offset().top;
var adminBarHieght = $('#wpadminbar').outerHeight();
$(window).scroll(function() {
    var scrollTop = $(window).scrollTop() + adminBarHieght;

    if ( scrollTop > previewWindow) {
        $('.preview-options').addClass('affix');
    }
    else {
        $('.preview-options').removeClass('affix');
    }
});
