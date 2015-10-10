<?php


	$cyclerOptions = get_option('kjd_cycler_misc_settings');


	$plugin = $cyclerOptions['kjd_cycler_misc']['plugin'];

	$theme = $cyclerOptions['kjd_cycler_misc']['nivoTheme'];

	$effect = $cyclerOptions['kjd_cycler_misc']['effect'];

	$timeout = $cyclerOptions['kjd_cycler_misc']['timeout'];

	switch($plugin){

/* --------------------------------------------------
Nivo Slider
-------------------------------------------------- */
	case($plugin =="nivo"):

		$theme = $cyclerOptions['kjd_cycler_misc']['nivoTheme'];
		wp_enqueue_script("slider", $root."/scripts/nivo/nivoSliderPack.js", false, "1.0", true);

		wp_enqueue_style("nivo", $root."/scripts/nivo/nivoSlider.css");

		if($theme =="light"){

			wp_enqueue_style("slider", $root."/scripts/nivo/themes/light/light.css");

		}elseif($theme =="dark"){

			wp_enqueue_style("slider", $root."/scripts/nivo/themes/dark/dark.css");

		}else{

			wp_enqueue_style("slider", $root."/scripts/nivo/themes/dark/dark.css");

		}

		add_action('wp_head', 'kjd_nivo_settings_hook');

		break;
/* --------------------------------------------------
Piecemaker 3D - not working
-------------------------------------------------- */
		case($plugin =="piecemaker3d"):

			// all settings are in those xml files, google the instructions
			wp_enqueue_style("slider", $root."/scripts/piecemaker/swfobject/swfobject.js");

			add_action('wp_head', 'kjd_piecemakerSettings',10, 5);
			break;
/* --------------------------------------------------
Flex Slider
-------------------------------------------------- */
		case($plugin =="flexslider2"):

			wp_enqueue_style("slider", $root."/scripts/flexslider/flexslider.css");
			wp_enqueue_script("slider", $root."/scripts/flexslider/flexslider.js", false, "1.0", true);

			add_action('wp_head', 'kjd_flexslider_settings_hook');
			break;
/* --------------------------------------------------
Parallax - not working
-------------------------------------------------- */
		case($plugin =="parallax"):

			wp_enqueue_style("slider", $root."/scripts/parallax/parallax.css");
			wp_enqueue_script("mondernizer", $root."/scripts/parallax/modernizr.custom.28468.js", false, "1.0", true);
			wp_enqueue_script("slider", $root."/scripts/parallax/jquery.cslider.js", false, "1.0", true);

			add_action('wp_head', 'kjd_parallax_slider_settings',10, 5);
			break;
/* --------------------------------------------------
Responsive Slider
-------------------------------------------------- */
		case($plugin =='responsive_slider'):

			wp_enqueue_style("slider", $root."/scripts/responsiveslider/responsiveslides.css");
			wp_enqueue_script("slider", $root."/scripts/responsiveslider/responsiveslides.min.js", false, "1.0", true);

			add_action('wp_head', 'kjd_responsive_slider_hook',10, 1);

		break;
/* --------------------------------------------------
Single Image
-------------------------------------------------- */
		case($plugin =="single image"):

			kjd_singleImage();
		break;
/* --------------------------------------------------
Bootstrap Slider
-------------------------------------------------- */
		case($plugin =="bootstrap_slider"):

			wp_enqueue_style("slider", $root."/scripts/bootstrap/bootstrap_slider.css");
			add_action('wp_head', 'kjd_bootstrap_slider_hook');

			break;
/* --------------------------------------------------
No Image
-------------------------------------------------- */
		default:

			kjd_noImage();
			break;

	}

/* --------------------------------------------------
--------------------------------------------------
The functions!
--------------------------------------------------
-------------------------------------------------- */



/////////////////////////////
// boot strap slider

function kjd_bootstrap_slider_hook(){

	$cyclerOptions = get_option('kjd_cycler_misc_settings');
	$timeout = $cyclerOptions['kjd_cycler_misc']['timeout'] ? $cyclerOptions['kjd_cycler_misc']['timeout'] : 5000 ;

	$script_output = '';

	$script_output .= '<script>';
		$script_output .= 'jQuery(function($) {';
    		$script_output .= '$(".bootstrap-carousel").carousel({';
			  $script_output .= 'interval: '.$timeout.', ';
			  $script_output .= 'pause: "hover"';
			$script_output .= '})';
		$script_output .= '});';
	$script_output .= '</script>';

	echo $script_output;
}

/////////////////////////////
//		responsive slider

function kjd_add_responsive_slider_script(){
	wp_enqueue_style("slider", $root."/scripts/responsiveslider/responsiveslides.css");
	wp_enqueue_script("slider", $root."/scripts/responsiveslider/responsiveslides.min.js", false, "1.0", true);

}

function kjd_responsive_slider_hook($timeout){
	$cyclerOptions = get_option('kjd_cycler_misc_settings');
	$timeout = $cyclerOptions['kjd_cycler_misc']['timeout'] ? $cyclerOptions['kjd_cycler_misc']['timeout'] : 4000 ;

	$script_output = '';
	$script_output .= '<script>';
		$script_output .= 'jQuery(function() {';
    		$script_output .= 'jQuery(".rslides").responsiveSlides({ timeout: '.$timeout.'});';
		$script_output .= '});';
	$script_output .= '</script>';

	echo $script_output;
}

////////////////////////
// Nivo Slider Settingsion: "fade",

function kjd_nivo_settings_hook(){

	$cyclerOptions = get_option('kjd_cycler_misc_settings');
	$theme = $cyclerOptions['kjd_cycler_misc']['nivoTheme'];
	$effect = $cyclerOptions['kjd_cycler_misc']['effect'];

	$effect = !empty($effect) ? $effect : 'random' ;
	$timeout = !empty($timeout)? $timeout : '3000';
	$script_output = '';

	$script_output .= '<script type="text/javascript">';
		$script_output .= 'jQuery(window).load(function() {';
			$script_output .= 'jQuery(".nivoSlider").nivoSlider({';

				$script_output .= 'effect: "'. $effect .'",';
				$script_output .= 'slices: 15,';
				$script_output .= 'boxCols: 8,';
				$script_output .= 'boxRows: 4,';
				$script_output .= 'animSpeed: 500,';
				$script_output .= 'pauseTime: '.$timeout.',';
				$script_output .= 'startSlide: 0,';
				$script_output .= 'directionNav: true,';
				$script_output .= 'controlNav: true,';
				$script_output .= 'controlNavThumbs: false,';
				$script_output .= 'pauseOnHover: true,';
				$script_output .= 'manualAdvance: false,';
				$script_output .= 'prevText: "Prev",';
				$script_output .= 'nextText: "Next",';
				$script_output .= 'randomStart: false';

			$script_output .= '});';
		$script_output .= '});';
	$script_output .= '</script>';

	echo $script_output;
}// end nivo settings


/////////////////////
// piecemaker

function kjd_piecemakerSettings($root, $plugin, $theme, $effect, $timeout){


}


/////////////////////
// flexslider

function kjd_flexslider_settings_hook(){

		$cyclerOptions = get_option('kjd_cycler_misc_settings');
		$theme = $cyclerOptions['kjd_cycler_misc']['nivoTheme'];
		$effect = $cyclerOptions['kjd_cycler_misc']['effect'];

		$effect = !empty($effect) ? $effect : 'fade' ;
		$timeout = !empty($timeout)? $timeout : '3000';

		$script_output = '';

		$script_output .= '<script type="text/javascript" charset="utf-8">';
		  $script_output .= 'jQuery(window).load(function() {';
		    $script_output .= 'jQuery("#imageSlider .slides").flexslider({';

				$script_output .= 'namespace: "flex-",';
				$script_output .= 'selector: "li",';
				$script_output .= 'animation: "'.$effect.'",';
				$script_output .= 'easing: "swing",  ';
				$script_output .= 'direction: "horizontal",';
				$script_output .= 'reverse: false,';
				$script_output .= 'animationLoop: true,';
				$script_output .= 'smoothHeight: false,';
				$script_output .= 'startAt: 0,';
				$script_output .= 'slideshow: true,';
				$script_output .= 'slideshowSpeed: '.$timeout.',';
				$script_output .= 'animationSpeed: 600,';
				$script_output .= 'initDelay: 0,';
				$script_output .= 'randomize: false,			 ';
				$script_output .= 'pauseOnAction: true,';
				$script_output .= 'pauseOnHover: false,';
				$script_output .= 'useCSS: true,';
				$script_output .= 'touch: true,';
				$script_output .= 'video: false,			 ';
				$script_output .= 'controlNav: true,';
				$script_output .= 'directionNav: true,';
				$script_output .= 'prevText: "Previous",';
				$script_output .= 'nextText: "Next",';
				$script_output .= 'keyboard: true,';
				$script_output .= 'multipleKeyboard: false,';
				$script_output .= 'mousewheel: false, ';
				$script_output .= 'pausePlay: false,';
				$script_output .= 'pauseText: "Pause",';
				$script_output .= 'playText: "Play"';

					$script_output .= '});';
		  $script_output .= '});';
		$script_output .= '</script>';

		echo $script_output;
}

function kjd_parallaxSliderSettings($root, $plugin, $theme, $effect, $timeout){


$timeout = '';

$timeout .= '<script type="text/javascript">';
	$timeout .= 'jQuery(document).ready(function(){';
		$timeout .= 'jQuery("#da-slider").cslider({';
			$timeout .= 'autoplay	: true,';
			$timeout .= 'bgincrement	: 600';
		$timeout .= '});';
	$timeout .= '});';
$timeout .= '</script>';

}
function kjd_singleImage(){

}

function kjd_noImage(){


}
