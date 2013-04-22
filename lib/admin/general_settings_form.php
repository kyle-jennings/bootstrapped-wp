<?php

function kjd_theme_settings_display(){  
screen_icon('themes'); ?> 

<h2>theme Settings</h2>

<?php

	if( isset( $_GET[ 'tab' ] ) ) {  
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'settings'; 
	}else{
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'settings'; 
	}
?> 

<h2 class="nav-tab-wrapper">  
	  <a href="?page=kjd_theme_settings&tab=settings" class="nav-tab"<?php echo $active_tab == 'settings' ? 'id="active"' : 'none'; ?>>theme Settings
	  </a>  	

</h2>

    <?php settings_errors(); ?>  
	  <form method="post" action="options.php">  
		<?php 
				 if( $active_tab == 'settings' ) { 
							theme_settings_callback();
					}
						submit_button(); 
						donate_callback();
				?>  
	</form>

<?php
}

////////////////////
// theme settings
////////////////////
function theme_settings_callback(){

	settings_fields( 'kjd_theme_settings' ); 
	$options = get_option('kjd_theme_settings');
?>
<!-- upload logo -->


	<div class="optionsWrapper">
		<h3>Logo</h3>
		<div class="option">

			<label>Upload your site logo</label>
			<input type="text" id="logo_url" name="kjd_theme_settings[kjd_site_logo]" value="<?php echo $options['kjd_site_logo'] ? $options['kjd_site_logo'] : ' '; ?>" />  
		  <input type="button" class="button upload_option upload_logo_button" value="Upload image" />  

			<div class="logo_preview" style="min-height: 100px; clear:both;">  
		      <img style="max-width:100%;" src="<?php echo esc_url( $options['kjd_site_logo'] ); ?>" />  
		  </div> 
		</div>

	<div class="option">

		<label>Upload favicon</label>
		<input type="text" id="logo_url" name="kjd_theme_settings[kjd_favicon]" value="<?php echo $options['kjd_favicon'] ? $options['kjd_favicon'] : ' '; ?>" />  
	  <input type="button" class="button upload_option upload_logo_button" value="Upload image" />  

		<div class="logo_preview" style="min-height: 100px; clear:both;">  
	      <img style="max-width:100%;" src="<?php echo esc_url( $options['kjd_favicon'] ); ?>" />  
	  </div> 
	</div>


	<div class="option">
		<label>Google Analytics</label>
		<textarea class="long_textarea" name="kjd_theme_settings[kjd_google_analytics]"><?php echo $options['kjd_google_analytics']? $options['kjd_google_analytics']: '' ;?></textarea>
	</div>

	
	<div class="option">
		<label>Use breadcrumbs</label>
		<select name="kjd_theme_settings[kjd_toggle_breadcrumbs]">
			<option value="true" <?php selected( $options['kjd_toggle_breadcrumbs'], "true", true) ?>>Yes</option>
			<option value="false" <?php selected( $options['kjd_toggle_breadcrumbs'], "false", true) ?>>No</option>
		</select>

	</div>

<!-- confine page to 960px -->
	<div class="option">
		<label>Use Responsive design</label>

		<select class="toggleDisplaySwitch" name="kjd_theme_settings[kjd_responsive_design]">
			<option value="true" <?php selected( $options['kjd_responsive_design'], "true", true) ?>>Yes</option>
			<option value="false" <?php selected( $options['kjd_responsive_design'], "false", true) ?>>No</option>
		</select>

	</div>
<div class="toggleDisplay">
	<div id="confineOption" class="option">
		<label>Confine ALL backgrounds 960px wide</label>

		<select name="kjd_theme_settings[kjd_confine_page]">
			<option value="true" <?php selected( $options['kjd_confine_page'], "true", true) ?>>Yes</option>
			<option value="false" <?php selected( $options['kjd_confine_page'], "false", true) ?>>No</option>
		</select>

	</div>

	<div id="boxShadow" class="option">
		<label>Add Shadow to page wrapper?</label>

		<select name="kjd_theme_settings[kjd_box_shadow]">
			<option value="true" <?php selected( $options['kjd_box_shadow'], "true", true) ?>>Yes</option>
			<option value="false" <?php selected( $options['kjd_box_shadow'], "false", true) ?>>No</option>
		</select>

	</div>	
</div>	
<!-- disable body and html background -->

	<div class="option">
		<label>Hide Header and Navbar on homepage?</label>
		<select name="kjd_theme_settings[kjd_hide_header]">
			<option value="false" <?php selected( $options['kjd_hide_header'], 'false', true ) ?>>No</option>
			<option value="true" <?php selected( $options['kjd_hide_header'], 'true', true) ?>>Yes</option>
		</select>
	</div>	

	<div class="option">
		<label>Hide Footer on Homepage?</label>
		<select name="kjd_theme_settings[kjd_hide_footer]">
			<option value="false" <?php selected( $options['kjd_hide_footer'], 'false', true ) ?>>No</option>
			<option value="true" <?php selected( $options['kjd_hide_footer'], 'true', true) ?>>Yes</option>
		</select>
	</div>	
</div>	

<?php
}


//////////////////
// paypal btn
//////////////////
function donate_callback(){ 

?>

<div class="option">
		<p>
			Thanks for downloading my wordpress theme! This is my first theme and is only phase one of development, phase two will have <span class="bold">tons of shortcodes</span>, <span class="bold">custom widgets</span>, and more.
		</p>

			<form style="text-align:center;"action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input  style="margin:0 auto; float:none;" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

	</div>

<?php
}
?>
