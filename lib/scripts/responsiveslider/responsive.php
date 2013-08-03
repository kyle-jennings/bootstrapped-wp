<div class="rslides">
<?php 
	$i = 0;
	foreach($images as $image){  
	
		$i++; 
		echo '<li>';
		if(!empty($image['url'])){ 
			echo '<img class="slider-background" title="slide-'.$i.'" src="'.$image['url'].'" />';
			echo '<div class="slider-copy-wrapper"><div class="container slider-copy">' . do_shortcode( $image['text'] ). '</div></div>'; 
		}
		echo '</li>';
	}
?>
</div>