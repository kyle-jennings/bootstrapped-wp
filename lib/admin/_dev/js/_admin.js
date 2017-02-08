// 'use strict';

require('jquery');
window.$ = jQuery;
require('./insertParam');
require('./getCookie');
require('./vendor/colorpicker/minicolors');

jQuery(document).ready(function($) {

  require('./minicolors');
	require('./livePreview');
  require('./fieldToggles');
	require('./removeNag');
	require('./dropdownTitleChange');
	require('./previewSize');
	require('./mediaLibrary');
	require('./groupDropdown');
  require('./addSuffix');


	require('./extendFields'); // might be dead

	// these need to be updated, but their form features do not exist yet
	// require('./addImageCarousel');
	// require('./pageLayouts');
	// require('./frontPageSortables');
	// require('./imageCarouselSorting');

	// probably deprecated
  // require('./oldToggles');
  // require('./toggleSwitch');
  // require('./menuButtonToggle');
});
