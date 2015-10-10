<?php

/* -----------------------------------------------------------------------------------
			Login Page
----------------------------------------------------------------------------------- */

function kjd_login_misc_settings_callback($section){	
	settings_fields( 'kjd_login_misc_settings' );
	$logoOptions = get_option('kjd_login_misc_settings'); 
	$logo = $logoOptions['kjd_loginPage_logo'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>

	<h2>Login Logo</h2>
	<div class="option">
		<label>Upload logo</label>
		<input type="text" class="media_input" id="logo_url" name="kjd_login_misc_settings[kjd_loginPage_logo]" value="<?php echo $logo ? $logo : ''; ?>" />  
		<input type="button" class="button upload_image" value="Upload image" /> 
		<div class="logo_preview" style="min-height: 100px; clear:both;">  
  			<img src="<?php echo esc_url( $logo ); ?>" />  
		</div> 
	</div>

<?php
}