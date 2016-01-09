<?php
	$options = get_option('kjd_cycler_images_settings');
	$cyclerOptions = get_option('kjd_cycler_misc_settings');
	$plugin = $cyclerOptions['kjd_cycler_misc']['plugin'];

    $images = $options['kjd_cycler_images'];
    if(empty($images))
        return;

	$sliderOptions = $cyclerOptions['kjd_cycler_misc'];
	$device_view = $cyclerOptions['kjd_cycler_misc']['deviceView'];

	$full_width = ($cyclerOptions['kjd_cycler_misc']['full_width'] == 'true') ? 'true' : 'false' ;

	$confineCyclerBackground = ($cyclerOptions['kjd_cycler_misc']['kjd_cycler_confine_background'] =='true') ? 'container confined' : '' ;

if($location != 'sortable'){  ?>

	<div id="imageSliderWrapper" class="<?php echo $confineCyclerBackground.' '.$device_view ; ?>">


		<?php echo $full_width == 'true' ? '' : '<div class="container">' ; ?>

			<div id="imageSlider">
			<?php

				echo kjd_build_image_carousels( $plugin, $images, $full_width);

			?>
			</div> <!-- end imageSlider -->

		<?php echo $full_width == 'true' ? '' : '</div>' ; ?> <!-- end container -->

	</div> <!-- end imageSliderWrapper -->


<?php

}else{
	echo '<div id="imageSlider" class="frontpage-component sortable-image-slider-wrapper '. $deviceView .'">';
		echo kjd_build_image_carousels( $plugin, $images, $full_width);
	echo '</div>';
}
/* -----------------------------------------------------
			Single Image Callback
------------------------------------------------------- */
function kjd_build_image_carousels( $plugin, $images, $full_width){


 if( $plugin !="none" && isset( $plugin ) ){

		if($plugin =="nivo"){

			include (dirname(dirname(__FILE__))."/scripts/nivo/nivoSlider.php");

		}elseif($plugin =="piecemaker3d"){

			include (dirname(dirname(__FILE__))."/scripts/piecemaker/piecemaker.php");

		}elseif($plugin =="flexslider2"){

			include (dirname(dirname(__FILE__))."/scripts/flexslider/flexslider.php");

		}elseif($plugin =="parallax"){

			include (dirname(dirname(__FILE__))."/scripts/parallax/parallax.php");

		}elseif($plugin =='responsive_slider'){

			include (dirname(dirname(__FILE__))."/scripts/responsiveslider/responsive.php");

		}elseif( $plugin == 'bootstrap_slider' ){

			include (dirname(dirname(__FILE__))."/scripts/bootstrap/bootstrap_slider.php");

		}elseif($plugin =="single image"){

			kjd_single_image_callback($images, $full_width );

		}

	}

}


/* -----------------------------------------------------
			Single Image Callback
------------------------------------------------------- */
function kjd_single_image_callback( $images, $full_width = null ) {

$image = $images[0]['url'];
// $style = ($full_width  == 'true') ? 'style="width: 100%; height: auto;"' : 'style="margin: 0 auto; display: block;"' ;
$style = 'style="width: 100%; height: auto;"';
?>
	<div class="single-image">

		<img alt="<?php echo '0'; ?>" src="<?php echo $image; ?>" <?php echo $style; ?> />

		<?php
		if( !empty($images[0]['text']) ){

			$caption =  '<div class="nivo-caption">';
				$caption .=  '<p>';
					$caption .=  $images[0]['text'];;
				$caption .=  '</p>';
			$caption .=  '</div>';

			// echo $caption;
		}

		?>


	</div>

	<?php if( !empty($images[0]['text']) ) { ?>
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

}