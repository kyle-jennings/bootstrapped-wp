<?php
	settings_fields('kjd_'.$section.'_background_settings');
	$options = get_option('kjd_'.$section.'_background_settings'); 
	$colorSettings = $options['kjd_'.$section.'_background_colors'];
	$wallpaperSettings = $options['kjd_'.$section.'_background_wallpaper'];
	$positions = array('left top','left center','left bottom','right top','right center','right bottom','center top','center center','center bottom','custom');

	 ?>
		<div class="optionsWrapper">

			<!-- ********** -->
			<!-- bg color   -->
			<!-- ********** -->
			<h2>Background colors</h2>

			<!-- starting color -->
		 	<div class="color_option option" style="position: relative;">

				<label>Start color</label>
				<input class="minicolors" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_colors][color]" value="<?php echo $colorSettings['color'] ? $colorSettings['color'] : 'none'; ?>" />
<a class="clearColor">Clear</a>
			</div> <!-- End color select-->

			<!-- ending color -->
		 	<div class="color_option option" style="position: relative;">

				<label>End color</label>
				<input class="minicolors" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_colors][endcolor]" value="<?php echo $colorSettings['endcolor'] ? $colorSettings['endcolor'] : 'none'; ?>"  />
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
				</select>
			</div>


			<!-- ********** -->
			<!-- Wallpaper  -->
			<!-- ********** -->
			<h2>Background wallpaper</h2>
			<div class="option">
				<label>Use wallpaper?</label>
				<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][use_wallpaper]">
					<option value="true" <?php selected( $wallpaperSettings['use_wallpaper'], 'true', true ) ?>>Yes</option>
					<option value="false" <?php selected( $wallpaperSettings['use_wallpaper'], 'false', true ) ?>>No</option>
				</select>
			</div>

			<div class="option">
				<label>Upload wallpaper</label>
					<input type="text" id="logo_url" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][image]" value="<?php echo $wallpaperSettings['image'] ? $wallpaperSettings['image'] : ''; ?>" />  
					<input type="button" class="button upload_option upload_logo_button" value="Upload image" /> 
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
			
			<!-- background position -->

			<div class="option">
				<label>Wallpaper position</label>		
				<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][position]">
					<?php foreach($positions as $position){ ?>
						<option value="<?php echo $position;?>" <?php selected( $wallpaperSettings['position'], $position, true) ?>><?php echo $position;?></option>
					<?php } ?>
				</select>
			</div>


			<div class="option">
				<label>Wallpaper custom position</label>		
				<input type="text" name="kjd_<?php echo $section;?>_background_settings[kjd_<?php echo $section;?>_background_wallpaper][positionX]"
				value="<?php echo $wallpaperSettings['positionX'] ? $wallpaperSettings['positionX'] : '' ;?>" style="width:40px;"><span class="explanation">from left </span>
				<input type="text" name="kjd_<?php echo $section;?>_background_settings[kjd_<?php echo $section;?>_background_wallpaper][positionY]"
				value="<?php echo $wallpaperSettings['positionY'] ? $wallpaperSettings['positionY'] : '' ;?>" style="width:40px;"><span class="explanation">from top </span>
			</div>
		</div>
	<div class="optionsWrapper">
		<label>Background Attachment</label>		
		<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_wallpaper][attachment]">
			<option value="scroll" <?php selected( $wallpaperSettings['attachment'], 'scroll', true) ?>>Scroll</option>
			<option value="fixed" <?php selected( $wallpaperSettings['attachment'], 'fixed', true) ?>>Fixed</option>
			<option value="local" <?php selected( $wallpaperSettings['attachment'], 'local', true) ?>>Local</option>
		</select>
	</div>