<?php

	$full_width = ( !empty($sliderOptions['full_width']) && $sliderOptions['full_width'] == 'true') ? 'carousel_full_width' : '' ;
?>
<div id="myCarousel" class="carousel slide <?php echo $full_width; ?>">
  <?php if( count($images) > 1 ){ ?>

  <ol class="carousel-indicators">
  	<?php
  		$i=0;
		foreach($images as $image){  
			$i++;
    		echo '<li data-target="#myCarousel" data-slide-to="' . $i . '" class="active"></li>';
		}
  	?>
  </ol>

  <?php }?>
  <!-- Carousel items -->
  <div class="carousel-inner">
	<?php 
  		$i=0;
		foreach($images as $image){  

			$i++;
			echo '<div class="active item">';
			
			if( !empty($image['url']) ){ 
				echo '<img class="slider-background" src="' . $image['url'] . '" />';
				echo '<div class="slider-copy-wrapper">';
					echo '<div class="container slider-copy">' . do_shortcode( $image['text'] ) . '</div>'; 
				echo '</div>';
			}
			
			echo '</div>';
		}
	?>
  </div> <!-- end carousel inner -->
  <!-- Carousel nav -->
  <?php if( count($images) > 1 ){ ?>
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
  <?php }?>
</div> <!-- end carousel -->