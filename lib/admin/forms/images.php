<?php 

	settings_fields( 'kjd_'.$section.'_images_settings' );
	$options = get_option('kjd_'.$section.'_images_settings'); 
	$options = $options['kjd_'.$section.'_images'];

	$borderSizes = range(0,20);
	$borderStyles = array('none','solid','dotted','dashed','double','groove','ridge','inset','outset');
	$image_types = array('thumbnails','images','captions', 'iframe');


?>
<div class="tabbable">

	<!-- tabs nav -->
  <div class="btn-group ">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="btn-face">Thumbnails</span>
		<span class="caret"></span>
	</a>
    <ul class="dropdown-menu">
	<?php  
		foreach($image_types as $image_type){
			echo '<li><a href="#'.$image_type.'" data-toggle="tab" >'.ucwords($image_type).'</a></li>';
	} ?>

    </ul>
  </div>



	<!-- tabbed content  -->
	<div class="tab-content">

	<?php 

	foreach($image_types as $image_type):
	
	?>

	  	<div class="tab-pane <? echo $image_type == 'thumbnails'? 'active' : '' ;?> " id="<?php echo $image_type;?>">
			
			<h2><?php echo ucwords($image_type);?></h2>
				<div class="option">
				<label>Background color</label>
				<input class="minicolors" 
				name="kjd_<?php echo $section;?>_images_settings[kjd_<?php echo $section;?>_images][<?php echo $image_type;?>][background_color]"
					value="<?php echo $options[$image_type]['background_color'] ? $options[$image_type]['background_color'] : '' ;?>"
					 />		
					<a class="clearColor">Clear</a>
				</div> 
				<div class="option">
				<label>Border color</label>
				<input class="minicolors" 
				name="kjd_<?php echo $section;?>_images_settings[kjd_<?php echo $section;?>_images][<?php echo $image_type;?>][border_color]"
					value="<?php echo $options[$image_type]['border_color'] ? $options[$image_type]['border_color'] : '' ;?>"
					 />		
				<a class="clearColor">Clear</a>
			</div> 
			<?php
			if($image_type =='thumbnails' || $image_type =='captions'){
				?>
				<div class="option">
				<label>Thumbnail Hover Glow</label>
				<input class="minicolors" 
				name="kjd_<?php echo $section;?>_images_settings[kjd_<?php echo $section;?>_images][<?php echo $image_type;?>][thumbnail_glow]"
					value="<?php echo $options[$image_type]['thumbnail_glow'] ? $options[$image_type]['thumbnail_glow'] : '' ;?>"
					 />		
					<a class="clearColor">Clear</a>
				</div> 
			<?php
			}

			if($image_type =='captions'){
				?>
				<div class="option">
				<label>Text Color</label>
				<input class="minicolors" 
				name="kjd_<?php echo $section;?>_images_settings[kjd_<?php echo $section;?>_images][<?php echo $image_type;?>][text_color]"
					value="<?php echo $options[$image_type]['text_color'] ? $options[$image_type]['text_color'] : '' ;?>"
					 />		
					<a class="clearColor">Clear</a>
				</div> 
			<?php
			}
			?>

			<!-- border size -->
			<div class="option">
				<label>Border size</label>
				<select name="kjd_<?php echo $section;?>_images_settings[kjd_<?php echo $section;?>_images][<?php echo $image_type;?>][border_size]">
					<?php foreach($borderSizes as $size){?>
						<option value="<?php echo $size.'px';?>" <?php selected( $options[$image_type]['border_size'], $size.'px', true) ?>><?php echo $size.'px';?></option>
					<?php }?>
				</select>
			</div>

			<!-- border style -->
			<div class="option">
				<label>Border style</label>
				<select name="kjd_<?php echo $section;?>_images_settings[kjd_<?php echo $section;?>_images][<?php echo $image_type;?>][border_style]">
					<?php foreach($borderStyles as $style){?>
						<option value="<?php echo $style;?>"<?php selected( $options[$image_type]['border_style'], $style, true) ?>><?php echo $style;?></option>
					<?php }?>
				</select>
			</div>

			<?php if($image_type !='captions'){ ?>
			<div class="option">
				<label>Padding</label>
				<select
			name="kjd_<?php echo $section;?>_images_settings[kjd_<?php echo $section;?>_images][<?php echo $image_type;?>][padding]">
					<?php foreach($borderSizes as $size){?>
						<option value="<?php echo $size.'px';?>"<?php selected( $options[$image_type]['padding'], $size.'px', true) ?>><?php echo $size.'px';?></option>
					<?php }?>

				</select>
			</div>
			<?php } ?>

			<div class="option">
				<label>Border Radius</label>
				<select name="kjd_<?php echo $section;?>_images_settings[kjd_<?php echo $section;?>_images][<?php echo $image_type;?>][border_radius]">
					<?php foreach($borderSizes as $size){?>
						<option value="<?php echo $size.'px';?>"<?php selected( $options[$image_type]['border_radius'], $size.'px', true) ?>><?php echo $size.'px';?></option>
					<?php }?>
					<option value="50%"<?php selected( $options[$image_type]['border_radius'], '50%', true) ?>>50%</option>
				</select>
			</div>
		</div>
<?php			
		endforeach;
?>
	</div> <!-- end tabbed content -->
</div> <!-- end tabbable -->