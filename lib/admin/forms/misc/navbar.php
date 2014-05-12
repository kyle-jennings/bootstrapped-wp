<?php

/* -----------------------------------------------------------------------------------
					nav bar
----------------------------------------------------------------------------------- */

function kjd_navbar_misc_settings_callback($section){ 
	settings_fields( 'kjd_navbar_misc_settings' );
	$options = get_option('kjd_navbar_misc_settings');
	$options = $options['kjd_navbar_misc'];

	$navBarStyles = array('default','page-top','sticky-top','sticky-bottom');	
	$navBarLinkStyles = array('none','highlighted','pills','tabs', 'tabs-below');	

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>
		<!-- link styles -->
		<div class="optionsWrapper">

			<h3>Navbar settings</h3>


	<div class="option">
			<label>Navbar Style</label>
			<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_style]">
				<option value="default" <?php selected( $options['navbar_style'], 'default', true) ?>>Full Width</option>
				<option value="contained" <?php selected( $options['navbar_style'], 'contained', true ) ?>>Contained</option>
			</select>
		</div>
		<div class="option">
			<label>Position</label>
			<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_position]" >
				<option value="default" <?php selected( $options['navbar_position'], 'default', true) ?>>Default</option>
				<option value="fixed-top" <?php selected( $options['navbar_position'], 'fixed-top', true ) ?>>Fixed at top</option>
				<option value="fixed-bottom" <?php selected( $options['navbar_position'], 'fixed-bottom', true ) ?>>Fixed at bottom</option>
				<option value="static-top" <?php selected( $options['navbar_position'], 'static-top', true ) ?>>Top of Page</option>
			</select>
		</div>
		<div class="option">
			<label>Link style</label>
			<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_link_style]">
				<?php foreach($navBarLinkStyles as $style){ ?>
					<option value="<?php echo $style;?>" <?php selected( $options['navbar_link_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?></option>
				<?php } ?>
			</select>
		</div>


		<div class="option">
			<label>Nav alignment</label>
			<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_alignment]">
				<option value="left" <?php selected( $options['navbar_alignment'], 'left', true) ?>>Left</option>
				<option value="center" <?php selected( $options['navbar_alignment'], 'center', true) ?>>Center</option>
				<option value="right" <?php selected( $options['navbar_alignment'], 'right', true) ?>>Right</option>
			</select>
		</div>

		<div class="option">
			<label>Disable Link Inner Shadows?</label>
			<select name="kjd_navbar_misc_settings[kjd_navbar_misc][link_shadows]">
				<option value="true" <?php selected( $options['link_shadows'], 'true', true) ?>>Yes</option>
				<option value="false" <?php selected( $options['link_shadows'], 'false', true ) ?>>No</option>
			</select>
		</div>

		<?php 
			// echo kjd_confine_section_toggle($section, $options);
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
		

			<div class="option">
				<label>Flush links to side?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][flush_first_link]">
						<option value="false" <?php selected( $options['flush_first_link'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $options['flush_first_link'], 'true', true) ?>>Yes</option>
				</select>
			</div>

			<div class="option">
				<label>Hide navbar?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][hideNav]">
						<option value="false" <?php selected( $options['hideNav'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $options['hideNav'], 'true', true) ?>>Yes</option>
				</select>
			</div>

		</div>

	
<?php
}
