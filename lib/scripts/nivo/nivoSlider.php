<div class="nivoSlider">
<?php


	$i = 0;
	foreach($images as $image){  $i++; ?>
	<?php if(!empty($image['url'])){ ?>
	<img title="#<?php echo $i; ?>" src="<?php echo $image['url'];?>" />
	<?php }
	}
?>
</div>

<?php $i =0;
foreach($images as $image){  $i++;
	if(!empty($image['text'])){ ?>
	<div id="<?php echo $i;?>" class="nivo-html-caption">
			<?echo $image['text']; ?>
	</div>
	<?php }
} ?>
