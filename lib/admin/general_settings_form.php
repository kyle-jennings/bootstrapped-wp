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
			}elseif( $active_tab == 'butt' ) { 
				//theme_settings_callback();
			}
			submit_button(); 
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

	
<!-- 	<div class="option">
		<label>Use breadcrumbs</label>
		<select name="kjd_theme_settings[kjd_toggle_breadcrumbs]">
			<option value="true" <?php selected( $options['kjd_toggle_breadcrumbs'], "true", true) ?>>Yes</option>
			<option value="false" <?php selected( $options['kjd_toggle_breadcrumbs'], "false", true) ?>>No</option>
		</select>

	</div> -->

	<div class="option">
		<label>Display paginator at top of posts</label>
		<select name="kjd_theme_settings[kjd_pagination_top]">
			<option value="true" <?php selected( $options['kjd_pagination_top'], "true", true) ?>>Yes</option>
			<option value="false" <?php selected( $options['kjd_pagination_top'], "false", true) ?>>No</option>
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

	<div class="option">
		<label>404 Page Content</label>
			<?php wp_editor( $options['kjd_404_page'], 'kjd_theme_settings[kjd_404_page]' );?>
	</div>

<?php
}
