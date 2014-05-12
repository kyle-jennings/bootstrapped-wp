<?php





/* -----------------------------------------------------------------------------------
				Body Area
----------------------------------------------------------------------------------- */

function kjd_body_misc_settings_callback($section){
	settings_fields( 'kjd_body_misc_settings' );
	$options = get_option('kjd_body_misc_settings');
	$options = $options['kjd_body_misc'];


?>
	<div class="optionsWrapper">

		<?php 
			echo kjd_confine_section_toggle($section, $options);
		?>

		<?php
			echo kjd_float_section_toggle($section, $options);
		?>

		<?php
			echo kjd_set_section_margin($section, $options);
		?>

		<?php
			echo kjd_section_glow_toggle($section, $options);
		?>

		
		<h3>Misc Colors</h3>

		<div class="color_option option" style="position: relative;">
			<label>Post Titles Bottom Border</label>

			<input class="minicolors" name="kjd_body_misc_settings[kjd_body_misc][post_info_border]" 
				value="<?php echo $options['post_info_border'] ? $options['post_info_border'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>


		


	</div>			
<?php
}


