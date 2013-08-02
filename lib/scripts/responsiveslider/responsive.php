<div class="rslides">
<?php 
	$i = 0;
	foreach($images as $image){  
	
		$i++; 
		echo '<li style="background:url('.$image['url'].') no-repeat top left; background-size:cover;">';
		if(!empty($image['url'])){ 
			//echo '<img class="slider-background" title="slide-'.$i.'" src="'.$image['url'].'" />';
			echo '<div class="container slider-copy-wrapper"><div class="slider-copy">' . $image['text'] . '</div></div>'; 
		}
		echo '</li>';
	}
?>
</div>