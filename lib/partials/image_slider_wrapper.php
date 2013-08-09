<?php
		$options = get_option('kjd_cycler_images_settings');
		$cyclerOptions = get_option('kjd_cycler_misc_settings');
		$plugin = $cyclerOptions['kjd_cycler_misc']['plugin'];
		$images = $options['kjd_cycler_images'];

		$sliderOptions = $cyclerOptions['kjd_cycler_misc'];

		// $cyclerOptions = get_option('kjd_cycler_misc_settings');
		// $cyclerOptions = $cyclerOptions['kjd_cycler_misc'];	
		$confineCyclerBackground = ($cyclerOptions['kjd_cycler_misc']['kjd_cycler_confine_background'] =='true') ? 'container confined' : '' ;	
?>

<div id="imageSliderWrapper" class="frontPageBody <?php echo $confineCyclerBackground; ?>">


	<?php echo ( $plugin == 'responsive_slider' || ( $plugin == 'bootstrap_slider' ) ) ? '' : '<div class="container">' ; ?>

		<div id="imageSlider">
<?php
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
		
			kjd_single_image_callback();
			
		}

	}
	
?>
		</div> <!-- end imageSlider -->
		
	<?php echo ( $plugin == 'responsive_slider' || $plugin == 'bootstrap_slider' ) ? '' : '</div>' ; ?> <!-- end container -->

</div> <!-- end imageSliderWrapper -->


<?php

function kjd_single_image_callback() {

?>
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