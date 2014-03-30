<?php
	settings_fields('kjd_'.$section.'_background_settings');
	$options = get_option('kjd_'.$section.'_background_settings'); 
	$colorSettings = $options['kjd_'.$section.'_background_colors'];
	$wallpaperSettings = $options['kjd_'.$section.'_background_wallpaper'];
	$positions = array('left top','left center','left bottom','right top','right center','right bottom','center top','center center','center bottom','custom');



	if( !empty($colorSettings['start_rgba']) ){	
		$start_rgba =  $colorSettings['start_rgba'];
		$start_rgba = split(',',$start_rgba);
		$start_rgba = $start_rgba[3];
		$start_rgba =  str_replace(')','',$start_rgba) ;

	}
		

	if( !empty($colorSettings['end_rgba']) ){		
		$end_rgba =  $colorSettings['end_rgba'];
		$end_rgba = split(',',$end_rgba);
		$end_rgba =	$end_rgba[3];
		$end_rgba =  str_replace(')','',$end_rgba);
	}

?>

<!-- Tab Navigation-->
<div class="btn-group ">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="btn-face">Background Colors</span>
		<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
		<li class="active"><a href="#background-colors" data-toggle="tab">Background Colors</a></li>
		<li><a href="#background-wallpaper" data-toggle="tab">Background Wallpaper</a></li>
	</ul>
</div>
<!-- end nav -->

<!-- tabbed content -->
<div class="tab-content">

	<!-- ********** -->
	<!-- bg color   -->
	<!-- ********** -->
	<div class="tab-pane cf active" id="background-colors">


		<h2>Background colors</h2>

		<!-- starting color -->
	 	<div class="color_option option" style="position: relative;">

			<label>Start color</label>
			<input class="minicolors opacity" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_colors][color]" 
			value="<?php echo $colorSettings['color'] ? $colorSettings['color'] : 'none'; ?>" data-opacity ="<?php echo $start_rgba; ?>" />
			<input type="hidden" class="rgba-color" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_colors][start_rgba]"
			 value="<?php echo $colorSettings['start_rgba'] ? $colorSettings['start_rgba'] : 'none'; ?>" />
			<a class="clearColor">Clear</a>
		</div> <!-- End color select-->

		<!-- ending color -->
	 	<div class="color_option option" style="position: relative;">

			<label>End color</label>
			<input class="minicolors opacity" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_colors][endcolor]" 
			value="<?php echo $colorSettings['endcolor'] ? $colorSettings['endcolor'] : 'none'; ?>"  data-opacity ="<?php echo $end_rgba; ?>" />
			<input type="hidden" class="rgba-color" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_colors][end_rgba]"
			 value="<?php echo $colorSettings['end_rgba'] ? $colorSettings['end_rgba'] : 'none'; ?>" />
			<a class="clearColor">Clear</a>
		</div> <!-- End color select-->

		<div class="option">
			<label>Color fill</label>		

			<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_colors][gradient]">
					<option value="none" <?php selected( $colorSettings['gradient'], "none", true) ?>>None</option>
					<option value="solid" <?php selected( $colorSettings['gradient'], "solid", true) ?>>Solid</option>
					<option value="vertical" <?php selected( $colorSettings['gradient'], "vertical", true) ?>>Vertical</option>
					<option value="horizontal" <?php selected( $colorSettings['gradient'], "horizontal", true) ?>>Horizontal</option>
					<option value="radial" <?php selected( $colorSettings['gradient'], "radial", true) ?>>Radial</option>
					<?php if($section =='navbar'){ ?>
					
					<option value="bootstrap_default" <?php selected( $colorSettings['gradient'], "bootstrap_default", true) ?>>Bootstrap Default</option>

					<?php } ?>
			</select>
		</div>

	</div> <!-- end .tab-pane -->

	<!-- ************** -->
	<!-- bg wallpaper   -->
	<!-- ************** -->
<?php 

if($section !=='posts'):

?>
<div class="tab-pane cf" id="background-wallpaper">
			<!-- ********** -->
			<!-- Wallpaper  -->
			<!-- ********** -->
		<h2>Background wallpaper</h2>
		<div class="option">
			<label>Use wallpaper?</label>
			<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][use_wallpaper]">
				<option value="false" <?php selected( $wallpaperSettings['use_wallpaper'], 'false', true ) ?>>No</option>
				<option value="true" <?php selected( $wallpaperSettings['use_wallpaper'], 'true', true ) ?>>Yes</option>
			</select>
		</div>

		<div class="option">
			<label>Upload wallpaper</label>
				<input type="text" class="media_input" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][image]" value="<?php echo $wallpaperSettings['image'] ? $wallpaperSettings['image'] : ''; ?>" />  
				<input type="button" class="button upload_image" value="Upload image" /> 
		</div>

		<!-- background repeat -->
		<div class="option">
			<label>Wallpaper repeat?</label>		
		<?php $repeatOptions = array('repeat','no-repeat','repeat-x','repeat-y',);?>
			<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][repeat]">
				<?php foreach($repeatOptions as $repeat){ ?>
					<option value="<?php echo $repeat;?>" <?php selected( $wallpaperSettings['repeat'], $repeat, true) ?>><?php echo $repeat;?></option>
				<?php } ?>
			</select>
		</div>
	
		<div class="option">
			<label>Background Attachment</label>		
			<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][attachment]">
				<option value="scroll" <?php selected( $wallpaperSettings['attachment'], 'scroll', true) ?>>Scroll</option>
				<option value="fixed" <?php selected( $wallpaperSettings['attachment'], 'fixed', true) ?>>Fixed</option>
			</select>
		</div>

		<!-- background position -->
		<div class="full-option cf">
			<div class="option">
				<label>Wallpaper position</label>		
				<select class="background-pos" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][position]">
					<?php foreach($positions as $position){ ?>
						<option value="<?php echo $position;?>" <?php selected( $wallpaperSettings['position'], $position, true) ?>><?php echo $position;?></option>
					<?php } ?>
				</select>
			</div>


			<div class="option" style="<?php echo $wallpaperSettings['size'] == 'percentage' ? 'display:block;' : 'display:none;' ; ?>">
				<label>Wallpaper custom position</label>		
				<input type="text" name="kjd_<?php echo $section;?>_background_settings[kjd_<?php echo $section;?>_background_wallpaper][positionX]"
				value="<?php echo $wallpaperSettings['positionX'] ? $wallpaperSettings['positionX'] : '' ;?>" style="width:40px;"><span class="explanation">from left </span>
				<input type="text" name="kjd_<?php echo $section;?>_background_settings[kjd_<?php echo $section;?>_background_wallpaper][positionY]"
				value="<?php echo $wallpaperSettings['positionY'] ? $wallpaperSettings['positionY'] : '' ;?>" style="width:40px;"><span class="explanation">from top </span>
			</div>
		</div>

		<!-- background size -->
		<div class="full-option cf">
			<div class="option">
				<label>Background Size</label>		
				<select  class="background-size" class="toggle-switch" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][size]">
					<option value="default" <?php selected( $wallpaperSettings['size'], 'percentage', true) ?>>Default</option>
					<option value="cover" <?php selected( $wallpaperSettings['size'], 'cover', true) ?>>Cover</option>
					<option value="contain" <?php selected( $wallpaperSettings['size'], 'contain', true) ?>>Contained</option>
					<option value="percentage" <?php selected( $wallpaperSettings['size'], 'percentage', true) ?>>Percentage</option>
				</select>
			</div>


			<div class="option" style="<?php echo $wallpaperSettings['size'] == 'percentage' ? 'display:block;' : 'display:none;' ; ?>">
				<label>Background width</label>		
				<input type="text" name="kjd_<?php echo $section;?>_background_settings[kjd_<?php echo $section;?>_background_wallpaper][percentage]"
				value="<?php echo $wallpaperSettings['percentage'] ? $wallpaperSettings['percentage'] : '' ;?>" style="width:40px;"><span class="explanation">%</span>
			</div>
		</div>


	</div> <!-- end .tab-pane -->
<?php 
endif;
?>


</div> <!-- end .tabbed-content -->