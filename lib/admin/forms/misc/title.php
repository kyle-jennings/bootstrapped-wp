<?php
/* -----------------------------------------------------------------------------------
					title area
----------------------------------------------------------------------------------- */

function kjd_title_misc_settings_callback($section){
	settings_fields( 'kjd_pageTitle_misc_settings' );
	$options = get_option('kjd_pageTitle_misc_settings');
	$options = $options['kjd_pageTitle_misc'];
	
?>
	<div class="optionsWrapper">

		<?php 
			echo kjd_confine_section_toggle($section, $options);

			echo kjd_float_section_toggle($section, $options);

			echo kjd_set_section_margin($section, $options);
		?>

	</div>

	
	<div class="option">
		<label>Use breadcrumbs</label>
		<select name="kjd_pageTitle_misc_settings[kjd_pageTitle_misc][use_breadcrumbs]">
			<option value="false" <?php selected( $options['use_breadcrumbs'], "false", true) ?>>No</option>
			<option value="true" <?php selected( $options['use_breadcrumbs'], "true", true) ?>>Yes</option>
		</select>

	</div>

<?php
}
