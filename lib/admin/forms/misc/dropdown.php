<?php

/* -----------------------------------------------------------------------------------
					Navbar Dropdown 
----------------------------------------------------------------------------------- */

function kjd_dropdown_misc_settings_callback($section) { 
	settings_fields( 'kjd_dropdown-menu_misc_settings' );
	$options = get_option('kjd_dropdown-menu_misc_settings');
	$options = $options['kjd_dropdown-menu_misc'];
	?>
	<div class="optionsWrapper">

			<div class="option">
				<label>Remove padding from dropdown?</label>
				<select name="kjd_dropdown-menu_misc_settings[kjd_dropdown-menu_misc][remove_padding]">
						<option value="false" <?php selected( $options['remove_padding'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $options['remove_padding'], 'true', true) ?>>Yes</option>
				</select>
			</div>

	</div>
<?php
}
