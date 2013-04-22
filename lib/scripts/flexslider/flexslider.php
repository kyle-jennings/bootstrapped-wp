<div class="flexslider">
<ul class="slides">
 <?php 
	$i = 0;
	foreach($images as $image){  $i++; ?>
		<li>
		<?php echo !empty($image['linkto']) ? "<a href='".$image['linkto'].">": ''; ?>
			<img title="#<?php echo $i; ?>" src="<?php echo $image['url'];?>" />

		<?php echo !empty($image['linkto']) ? "</a>": ''; ?>
		</li>
	<?php }
?>
</ul>
</div>