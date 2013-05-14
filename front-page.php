<?php

get_header();

	$layoutOptions = get_option('kjd_page_layout_settings');
	$layoutSettings = $layoutOptions['kjd_page_layouts']['kjd_front_page_widgets'];

	$frontPageOptions = get_option('kjd_frontPage_layout_settings');
	$frontPageSidebar = $frontPageOptions['kjd_frontPage_sidebar'];

	$components = $frontPageOptions['kjd_frontPage_layout'];
	$secondayContent = $frontPageOptions['kjd_frontPage_secondaryContent'];
	$arrayLength = count($components) -1;
	
	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];	
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

$layoutSettings['position'] = 'right';
$showImageSlider = get_option('kjd_cycler_misc_settings');
$showImageSlider = $showImageSlider['kjd_cycler_misc']['enable'];
if($showImageSlider =='true')
{
	image_slider_callback($confineBodyBackground,$position,$arrayLength,$layoutSettings);
}

if(!empty($components))
{ ?>

<div id="body" class="frontPageBody <?php echo $confineBodyBackground =='true' ? 'container' : '' ;?>">
	<div class="container">
	<div class="row">
<?php 

	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){ 
		echo '<div class="span12 content-wrapper">';
	}else{
		echo '<div class="span9 content-wrapper">';
	}

	foreach($components as $position => $component)
	{
		if($component['component'] =='widget_area_1'){
			 widget_area_1_callback($layoutSettings); 
		}elseif($component['component'] =='widget_area_2'){
			 widget_area_2_callback($layoutSettings);
		}elseif($component['component'] =='content'){
			content_callback($layoutSettings);
		}elseif($component['component'] =='secondary_content'){
			secondary_content_callback($frontPageOptions,$layoutSettings);
		}
	}

	if($layoutSettings['position'] == 'right' || $layoutSettings['position'] =='left')
	{
		echo '</div>'; // end left content
		echo '<div class="span3">';
		dynamic_sidebar('front_page_sidebar');
		echo '</div>';
	}else{
		echo '</div>';
	}
	
	echo '</div></div>';

}else{ ?>
<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container' : '' ;?>">
	<div class="container">
		<br /><br /><br /><br />
		<div class="hero-unit">
		  <h1>Please set up your theme</h1>
		  <p>so this ugly message goes away</p>
		  <p>
		    <a href="wp-admin/admin.php?page=kjd_page_layout_settings&tab=frontPage"class="btn btn-primary btn-large">
		      go to your dashboard
		    </a>
		  </p>
		</div>
	</div>
</div>			
<?php
}


get_footer(); // End page, start function

function image_slider_callback($confineBodyBackground,$position,$arrayLength,$layoutSettings){
		
		$options = get_option('kjd_cycler_images_settings');
		$cyclerOptions = get_option('kjd_cycler_misc_settings');
		$plugin = $cyclerOptions['kjd_cycler_misc']['plugin'];
		$images = $options['kjd_cycler_images'];

		$options = get_option('kjd_cycler_misc_settings');
		$sliderOptions = $options['kjd_cycler_misc'];

		// $cyclerOptions = get_option('kjd_cycler_misc_settings');
		// $cyclerOptions = $cyclerOptions['kjd_cycler_misc'];	
		$confineCyclerBackground = $cyclerOptions['kjd_cycler_misc']['kjd_cycler_confine_background'];	
?>

<div id="imageSliderWrapper" class="frontPageBody hidden-phone">
	<?php include(dirname(__FILE__) . '/lib/scripts/sliderScripts.php'); ?>
<div class="container">
<div id="imageSlider">
<?php
	 if($plugin !="none" && isset($plugin)){ 
		if($plugin =="nivo"){
			include "lib/scripts/nivo/nivoSlider.php"; 
		}elseif($plugin =="piecemaker3d"){
			include "lib/scripts/picemaker/piecemaker.php"; 
		}elseif($plugin =="flexslider2"){
			include "lib/scripts/flexslider/flexslider.php"; 
		}elseif($plugin =="parallax"){
			include "lib/scripts/parallax/parallax.php"; 
		}elseif($plugin =="single image"){ ?> 
	
			<div class="singleImage">
				<?php if(!empty($images[0]['url'])){ ?>
				<img alt="<?php echo '0'; ?>" src="<?php echo $images[0]['url'];?>" />
					<?php if(!empty($images[0]['text'])){ ?>
				<div class="caption">
					<p>
						<?php echo $images[0]['text'];?>
					</p>
				</div>
				<?php } ?>
				<?php }else{
					 echo "<div id='emptyImage'></div>"; 
				} ?>

			</div>

			<?php if(!empty($images[0]['text'])){ ?>
			<script>
				jQuery(document).ready(function() {  
					var imgWidth = jQuery('.singleImage > img').innerWidth();
					var borderWidth = jQuery('.singleImage > img').css("border-left-width");
					borderWidth = parseInt(borderWidth)*2;
					jQuery('.singleImage').width(imgWidth);
					imgWidth = '-'+((imgWidth/2) - (borderWidth-borderWidth/2))+'px'; 
					borderWidth/=2;
					<?php if($sliderOptions['singleCaption'] == "top"){
						echo "jQuery('.singleImage > .caption').css('margin-left',imgWidth);";
						echo "jQuery('.singleImage > .caption').css('top',borderWidth);";
					}elseif($sliderOptions['singleCaption'] == "bottom"){
						echo "jQuery('.singleImage > .caption').css('margin-left',imgWidth);";
						echo "jQuery('.singleImage > .caption').css('bottom',borderWidth);";
					}elseif($sliderOptions['singleCaption'] == "right"){ 
						echo "jQuery('.singleImage > .caption').css('top',borderWidth);";
						echo "jQuery('.singleImage > .caption').css('bottom',borderWidth);";
						?> borderWidth*=-1;<?php
						echo "jQuery('.singleImage > .caption').css('right',borderWidth);";
					}elseif($sliderOptions['singleCaption'] == "left"){
						echo "jQuery('.singleImage > .caption').css('top',borderWidth);";
						echo "jQuery('.singleImage > .caption').css('bottom',borderWidth);";
						echo "jQuery('.singleImage > .caption').css('left',borderWidth);";
					}
					?>
				});
			</script>
			<?php
			}


			 ?>
			
		<?php
		}
	}
?>
		</div> <!-- end cycler -->
	</div>
</div> <!-- end image slider -->
<?php
}

function widget_area_1_callback($layoutSettings){
	echo '<div class="row">'; 
		dynamic_sidebar('front_page_widget_area_1');
	echo '</div>'; 
}

function widget_area_2_callback($layoutSettings){
	echo '<div class="row">'; 
		dynamic_sidebar('front_page_widget_area_2');
	echo '</div>';
}


function content_callback($layoutSettings){
	echo '<div class="row">'; 
		include('lib/page_code/the_content.php');
	echo '</div>';
}

function secondary_content_callback($frontPageOptions,$layoutSettings){ 
	echo '<div class="row">'; 
		echo do_shortcode($frontPageOptions['kjd_frontPage_secondaryContent']);
	echo '</div>'; 
}
?>