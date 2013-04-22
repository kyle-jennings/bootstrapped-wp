<?php 

	$options = get_option('kjd_cycler_images_settings');
	$cyclerOptions = get_option('kjd_cycler_misc_settings');
	$plugin = $cyclerOptions['kjd_cycler_misc']['plugin'];
	$images = $options['kjd_cycler_images'];

?>

		<!-- ************ -->
		<!-- image slider -->
		<!-- ************ -->
		<div id="imageSliderWrapper" class="hidden-phone">
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
								<?php }else{
									 echo "<div id='emptyImage'></div>"; 
								} ?>
								<?php if(!empty($images[0]['text'])){ ?>
								<div class="caption">
									
								</div>
								<?php } ?>
							</div>
						<?php
						}
					}
?>
				</div> <!-- end cycler -->
			</div> <!-- end container -->
		</div> <!-- end image slider -->
