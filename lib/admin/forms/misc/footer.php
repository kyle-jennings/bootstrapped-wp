<?php


/* --------------------------------------------
			Footer
-------------------------------------------- */

function kjd_footer_misc_settings_callback($section){
	settings_fields( 'kjd_footer_misc_settings' );
	$options = get_option('kjd_footer_misc_settings');
	$options = $options['kjd_footer_misc'];

	
?>
	<div class="optionsWrapper">

		<?php 
			echo kjd_confine_section_toggle($section, $options);
		?>

		<div class="option">
			<label>Footer Height</label>
			<input name="kjd_footer_misc_settings[kjd_footer_misc][height]" 
				value="<?php echo $options['height'] ? $options['height'] : ''; ?>"
				style="width:40px;"/>px.
		</div>

		<div class="option">
			<label>Hide Footer?</label>
			<select name="kjd_footer_misc_settings[kjd_footer_misc][hide_footer]">
				<option value="none" <?php selected( $options['hide_footer'], 'none', true ) ?>>none</option>
				<option value="frontpage" <?php selected( $options['hide_footer'], 'frontpage', true ) ?>>Front Page</option>
				<option value="inside" <?php selected( $options['hide_footer'], 'inside', true ) ?>>Inside</option>
				<option value="all" <?php selected( $options['hide_footer'], 'all', true ) ?>>All</option>
			</select>
		</div>	

	</div>	


	<div class='options-wrapper'>
		<h2>Mobile Settings</h2>

		<div class="option">
			<label>Hide Footer?</label>
			<select name="kjd_footer_misc_settings[kjd_footer_misc][mobile_hide_footer]">
				<option value="false" <?php selected( $options['mobile_hide_footer'], 'false', true ) ?>>No</option>
				<option value="true" <?php selected( $options['mobile_hide_footer'], 'true', true ) ?>>Yes</option>
			</select>
		</div>	


	</div>		
<?php
}


