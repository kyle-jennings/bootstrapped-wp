<?php

/* -----------------------------------------------------------------------------------
				header area
----------------------------------------------------------------------------------- */

function kjd_header_misc_settings_callback($section){
		settings_fields( 'kjd_header_misc_settings' );
		$options = get_option('kjd_header_misc_settings'); 
		$options = $options['kjd_header_misc'];

		$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>
		<div class="optionsWrapper">
			<h2>Options</h2>
			<div class="option">
				<label>Header Contents</label>		
				<select name="kjd_header_misc_settings[kjd_header_misc][header_contents]">
					<option value="logo" <?php selected( $options['header_contents'], 'logo', true ) ?>>Logo</option>
					<option value="widgets" <?php selected( $options['header_contents'], 'widgets', true ) ?>>Widgets</option>
				</select>
			</div>

			<div class="option">

				<label>Logo Alignment</label>		
				<select name="kjd_header_misc_settings[kjd_header_misc][logo_align]">
					<option value="left" <?php selected( $options['logo_align'], 'left', true ) ?>>Left</option>
					<option value="center" <?php selected( $options['logo_align'], 'center', true ) ?>>Center</option>
					<option value="right" <?php selected( $options['logo_align'], 'right', true ) ?>>Right</option>
				</select>
			</div>

			<div class="option">
				<label>Pull Logo up or down?</label>
				<input name="kjd_header_misc_settings[kjd_header_misc][logo_margin]" 
				value="<?php echo $options['logo_margin'] ? $options['logo_margin'] : ''; ?>"
				style="width:40px;"/>px.
			</div>	

			<div class="option">
				<label>Force Header height</label>
				<select name="kjd_header_misc_settings[kjd_header_misc][force_height]">
					<option value="false" <?php selected( $options['force_height'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['force_height'], 'true', true ) ?>>Yes</option>
				</select>
				<input type="text" name="kjd_header_misc_settings[kjd_header_misc][header_height]"
				value="<?php echo $options['header_height'] ? $options['header_height'] : '' ;?>" style="width:40px;">px
			</div>

		<?php 
			echo kjd_confine_section_toggle($section, $options);
		?>
	
		<?php
			echo kjd_float_section_toggle($section, $options);
		?>

		<?php
			echo kjd_set_section_margin($section, $options);
		?>
			

		
		<div class="option">
			<label>Hide Header?</label>
			<select name="kjd_header_misc_settings[kjd_header_misc][hide_header]">
				<option value="none" <?php selected( $options['hide_header'], 'none', true ) ?>>none</option>
				<option value="frontpage" <?php selected( $options['hide_header'], 'frontpage', true ) ?>>Front Page</option>
				<option value="inside" <?php selected( $options['hide_header'], 'inside', true ) ?>>Inside</option>
				<option value="all" <?php selected( $options['hide_header'], 'all', true ) ?>>All</option>
			</select>
		</div>			


		</div><!-- end options wrapper -->

		<div class='options-wrapper'>
			<h2>Mobile Settings</h2>

			<div class="option">
				<label>Hide Header?</label>
				<select name="kjd_header_misc_settings[kjd_header_misc][mobile_hide_header]">
					<option value="false" <?php selected( $options['mobile_hide_header'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['mobile_hide_header'], 'true', true ) ?>>Yes</option>
				</select>
			</div>	


		</div>
<?php
}
