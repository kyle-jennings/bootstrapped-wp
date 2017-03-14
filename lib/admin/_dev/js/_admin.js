// 'use strict';

require('jquery');
window.$ = jQuery;
require('./insertParam');
require('./getCookie');
require('./vendor/colorpicker/minicolors');
// require('./preview-file-field-updated');
require('./preview-send-values');

jQuery(document).ready(function($) {

  require('./update-last-group-and-tab');
  require('./dropdown-nav');
  require('./dropdown-subnav-links');
  require('./overlay');

  require('./form-saved');
  require('./expand-textarea');


  // preview field values
  require('./minicolors');
  require('./preview-textarea-update');
  require('./preview-general');
  require('./preview-ajax');
  require('./preview-custom-code');

  // preview behavior
  require('./preview-size');
  require('./preview-affix');

  require('./toggle-fields');

  require('./notification-auto-dismiss');
  require('./removeNag');

  require('./media-library');

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
