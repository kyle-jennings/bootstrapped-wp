// 'use strict';

require('jquery');
window.$ = jQuery;
require('./insertParam');
require('./getCookie');
require('./vendor/colorpicker/minicolors');
require('./send-to-preview');

jQuery(document).ready(function($) {

  require('./update-last-group-and-tab');
  require('./dropdown-nav');
  require('./dropdown-subnav-links');
  require('./overlay');

  require('./form-saved');
  require('./expand-textarea');

  require('./minicolors');
  require('./live-preview');
  require('./ajax-preview');
	require('./custom-code-preview');

  require('./toggle-fields');

  require('./notification-auto-dismiss');
  require('./removeNag');

  require('./previewSize');
  require('./preview-affix');

  require('./mediaLibrary');

  require('./addSuffix');


	require('./extendFields'); // might be dead

	// these need to be updated, but their form features do not exist yet
	// require('./addImageCarousel');
	// require('./pageLayouts');
	// require('./frontPageSortables');
	// require('./imageCarouselSorting');

	// probably deprecated
  // require('./menuButtonToggle');
});
