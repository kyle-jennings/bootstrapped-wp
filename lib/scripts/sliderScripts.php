<?php

	$root=get_bloginfo('template_directory'); 
	$cyclerOptions = get_option('kjd_cycler_misc_settings');
	$plugin = $cyclerOptions['kjd_cycler_misc']['plugin'];
	$theme = $cyclerOptions['kjd_cycler_misc']['nivoTheme'];
	$effect = $cyclerOptions['kjd_cycler_misc']['effect'];
	$timeout = $cyclerOptions['kjd_cycler_misc']['timeout'];

	if($plugin =="nivo"){
		nivoSettings($root, $plugin, $theme, $effect, $timeout);		
	}elseif($plugin =="piecemaker3d"){
		piecemakerSettings($root, $plugin, $theme, $effect, $timeout);
	}elseif($plugin =="flexslider2"){
		flexsliderSettings($root, $plugin, $theme, $effect, $timeout);
	}elseif($plugin =="parallax"){
		parallaxSliderSettings($root, $plugin, $theme, $effect, $timeout);
	}elseif($plugin =="single image"){
		singleImage();
	}elseif($plugin =="none"){
		noImage();
	}
//
////////////////////////
// Nivo Slider Settingsion: "fade",
////////////////////////
	function nivoSettings($root, $plugin, $theme, $effect, $timeout){	?>
	<script type="text/javascript" src="<?php echo $root;?>/lib/scripts/nivo/nivoSliderPack.js"></script>
	<link media="all" type="text/css" href="<?php echo $root;?>/lib/scripts/nivo/nivoSlider.css" id="nivo" rel="stylesheet">
	<?php // gets theme for slider
		if($theme =="light"){ ?> 
	<link media="all" type="text/css" href="<?php echo $root;?>/lib/scripts/nivo/themes/light/light.css" id="nivoTheme" rel="stylesheet">
		<?php
		}elseif($theme =="dark"){ ?> 
	<link media="all" type="text/css" href="<?php echo $root;?>/lib/scripts/nivo/themes/dark/dark.css" id="nivoTheme" rel="stylesheet">
		<?php
		}else{ ?> 
	<link media="all" type="text/css" href="<?php echo $root;?>/lib/scripts/nivo/themes/default/default.css" id="nivoTheme" rel="stylesheet">
		<?php
		} // end if statement	
?>


	<script type="text/javascript">
	jQuery(window).load(function() {
			jQuery(".nivoSlider").nivoSlider({

				effect: "<?php echo $effect;?>", // Specify sets with a comma
				slices: 15, // For slice animations
				boxCols: 8, // For box animations
				boxRows: 4, // For box animations
				animSpeed: 500, // Slide transition speed
				pauseTime: <?php echo $timeout ? $timeout : '3000' ;?>, // How long each slide will show
				startSlide: 0, // Set starting Slide (0 index)
				directionNav: true, // Next & Prev navigation
				controlNav: true, // 1,2,3... navigation
				controlNavThumbs: false, // Use thumbnails for Control Nav
				pauseOnHover: true, // Stop animation while hovering
				manualAdvance: false, // Force manual transitions
				prevText: "Prev", // Prev directionNav text
				nextText: "Next", // Next directionNav text
				randomStart: false

			});
	});
	</script>
<?php	
	}// end nivo settings


/////////////////////
// piecemaker
/////////////////////
function piecemakerSettings($root, $plugin, $theme, $effect, $timeout){ ?>
	<!-- all settings are in those xml files -->
	<script type="text/javascript" src="<?php echo $root;?>/lib/scripts/piecemaker/swfobject/swfobject.js"></script>  
<?php
}


/////////////////////
// flexslider
/////////////////////
function flexsliderSettings($root, $plugin, $theme, $effect, $timeout){
 ?>
<link rel="stylesheet" href="<?php echo $root;?>/lib/scripts/flexslider/flexslider.css" type="text/css">
<script src="<?php echo $root;?>/lib/scripts/flexslider/flexslider.js"></script>

<script type="text/javascript" charset="utf-8">
  jQuery(window).load(function() {
    jQuery('#imageSlider .slides').flexslider({

			namespace: "flex-",             
			selector: "li",       
			animation: "<?php echo $effect;?>",
			easing: "swing",               
			direction: "horizontal",       
			reverse: false,                
			animationLoop: true,           
			smoothHeight: false,           
			startAt: 0,                     
			slideshow: true,                
			slideshowSpeed: <?php echo $timeout ? $timeout : '3000' ;?>,           
			animationSpeed: 600,            
			initDelay: 0,                   
			randomize: false,               			 
			pauseOnAction: true,            
			pauseOnHover: false,            
			useCSS: true,                  
			touch: true,                    
			video: false,                   			 
			// Primary Controls
			controlNav: true,               
			directionNav: true,             
			prevText: "Previous",           
			nextText: "Next",               
			// Secondary Navigation
			keyboard: true,                 
			multipleKeyboard: false,        
			mousewheel: false,              
			pausePlay: false,               
			pauseText: 'Pause',             
			playText: 'Play',               
	
			});
  });
</script>
<?php
}

function parallaxSliderSettings($root, $plugin, $theme, $effect, $timeout){ ?>
<link rel="stylesheet" href="<?php echo $root;?>/lib/scripts/parallax/parallax.css" type="text/css">
<script type="text/javascript" src="<?php echo $root;?>/lib/scripts/parallax/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="<?php echo $root;?>/lib/scripts/parallax/jquery.cslider.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#da-slider').cslider({
			autoplay	: true,
			bgincrement	: 600
		});
	
	});
</script>
<?
}
function singleImage(){

}

function noImage(){}
?>
