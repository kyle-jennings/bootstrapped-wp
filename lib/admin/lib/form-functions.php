<?php

$name = 'kjd_'.$section.'_background_settings[kjd_'.$section.'_background_colors][gradient]';
$option = 'none';
$selected = selected( $settings['gradient'], $option, false);
$section = ''
/**
 * Select Field
 * @param  string $name        the name of the field to save
 * @param  array $setting    the array of the setting to change
 * @param  [type] $conditional [description]
 * @return [type]              [description]
 */
function bswp_select_field($section, $label, $name, $setting, $option ){
	?>
	<div class="option">
		<label><?php echo $label; ?></label>	
		<select name="<?php echo $name; ?>">
			<?php 
			foreach:
			?>
				<option value="<?php echo $option; ?>" 
				<?php selected( $setting, $option, true); ?> >
					<?php echo $option; ?>
				</option>
			<?php
			endforeach;
			?>
			<option value="default" <?php selected( $colorSettings['gradient'], "default", true) ?>>Default</option>
		</select>
	</div>
	<?php
}

/**
 * Color Field
 * @param  string $section [description]
 * @param  string $label   [description]
 * @param  string $name    [description]
 * @param  array $setting [description]
 * @return echo          [description]
 */
function bswp_color_field($section, $label, $name, $setting, $value, $option){
	$rgb_value = $setting ? $setting : 'none';
	$rgba_value = 
	?>
 	<div class="color-option option bswp-option bswp-option--color-select">

		<label><?php echo $label; ?></label>	
		<input class="minicolors opacity" name="<?php echo $name; ?>" 
		value="<?php echo $value; ?>"  data-opacity ="<?php echo $end_rgba; ?>" />
		<input type="hidden" class="rgba-color" name="<?php echo $name; ?>"
		 value="<?php echo $colorSettings['end_rgba'] ? $colorSettings['end_rgba'] : 'none'; ?>" />
		<a class="clearColor">Clear</a>
	</div> <!-- End color select-->
	<?php
}