<?php

if($section =="header"){
	header_misc_settings_callback();
}elseif($section =="login"){
	login_misc_settings_callback();
}elseif($section =="navbar"){
	navbar_misc_settings_callback();
}elseif($section =="pageTitle"){
	title_misc_settings_callback();
}elseif($section =="body"){
	body_misc_settings_callback();
}elseif($section =="footer"){
	footer_misc_settings_callback();
}

function title_misc_settings_callback(){
	settings_fields( 'kjd_pageTitle_misc_settings' );
	$options = get_option('kjd_pageTitle_misc_settings');
	$options = $options['kjd_pageTitle_misc'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');	
?>
	<div class="optionsWrapper">
		<div class="option">
			<label>Confine Background?</label>
			<select name="kjd_pageTitle_misc_settings[kjd_pageTitle_misc][kjd_pageTitle_confine_background]">
				<option value="true" <?php selected( $options['kjd_pageTitle_confine_background'], 'true', true) ?>>Yes</option>
				<option value="false" <?php selected( $options['kjd_pageTitle_confine_background'], 'false', true ) ?>>No</option>
			</select>
		</div>
		<div class="option">
			<label>Float Title Area</label>
			<select name="kjd_pageTitle_misc_settings[kjd_pageTitle_misc][float]">
					<option value="true" <?php selected( $options['float'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $options['float'], 'false', true) ?>>No</option>
			</select>
		</div>	

	</div>
<?php
}


function login_misc_settings_callback(){	
	settings_fields( 'kjd_login_misc_settings' );
	$logoOptions = get_option('kjd_login_misc_settings'); 
	$logo = $logoOptions['kjd_loginPage_logo'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>

	<h2>Login Logo</h2>
	<div class="option">
		<label>Upload logo</label>
		<input type="text" class="url" id="logo_url" name="kjd_login_misc_settings[kjd_loginPage_logo]" value="<?php echo $logo ? $logo : ''; ?>" />  
		<input type="button" class="button upload_option upload_logo_button" value="Upload image" /> 
		<div class="logo_preview" style="min-height: 100px; clear:both;">  
  			<img src="<?php echo esc_url( $logo ); ?>" />  
		</div> 
	</div>

<?php
}

function header_misc_settings_callback(){
		settings_fields( 'kjd_header_misc_settings' );
		$options = get_option('kjd_header_misc_settings'); 
		$options = $options['kjd_header_misc'];

		$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>
		<div class="optionsWrapper">
			<h2>Options</h2>
			<div class="option">

				<label>Use logo in header</label>		
				<select name="kjd_header_misc_settings[kjd_header_misc][use_logo]">
					<option value="true" <?php selected( $options['use_logo'], 'true', true ) ?>>Yes</option>
					<option value="false" <?php selected( $options['use_logo'], 'false', true ) ?>>No</option>
				</select>
				<span class="explanation">Makes the logo a clickable link in the header</span>
			</div>

			<div class="option">
				<label>Force Header height</label>
				<select name="kjd_header_misc_settings[kjd_header_misc][force_height]">
					<option value="false" <?php selected( $options['force_height'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['force_height'], 'true', true ) ?>>Yes</option>
				</select>
				<input type="text" name="kjd_header_misc_settings[kjd_header_misc][header_height]"
				value="<?php echo $options['header_height'] ?$options['header_height'] : '' ;?>" style="width:40px;">px
			</div>

				<div class="option">
					<label>Confine Background?</label>
					<select name="kjd_header_misc_settings[kjd_header_misc][kjd_header_confine_background]">
						<option value="false" <?php selected( $options['kjd_header_confine_background'], 'false', true ) ?>>No</option>
						<option value="true" <?php selected( $options['kjd_header_confine_background'], 'true', true) ?>>Yes</option>
					</select>
				</div>	
				
				

		</div><!-- end options wrapper -->

<?php
}

function navbar_misc_settings_callback(){ 
	settings_fields( 'kjd_navbar_misc_settings' );
	$options = get_option('kjd_navbar_misc_settings');
	$navbarSettings = $options['kjd_navbar_misc'];

	$navBarStyles = array('full_width','contained','page-top','sticky-top','sticky-bottom');	
	$navBarLinkStyles = array('none','highlighted','dividers','pills','tabs', 'tabs-below');	

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>
		<!-- link styles -->
		<div class="optionsWrapper">

			<h3>Navbar settings</h3>
			<div class="option">
				<label><?php echo ucwords(str_replace("_"," ",$section));?> navbar style</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_style]">
					<?php foreach($navBarStyles as $style){ ?>
						<option value="<?php echo $style;?>" <?php selected( $navbarSettings['navbar_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?></option>
					<?php } ?>
				</select>
			</div>

			<div class="option">
				<label>Nav link style</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_link_style]">
					<?php foreach($navBarLinkStyles as $style){ ?>
						<option value="<?php echo $style;?>" <?php selected( $navbarSettings['navbar_link_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?></option>
					<?php } ?>
				</select>
			</div>

			<div class="option">
				<label>Nav alignment</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_alignment]">
					<option value="left" <?php selected( $navbarSettings['navbar_alignment'], 'left', true) ?>>Left</option>
					<!-- <option value="center" <?php selected( $navbarSettings['navbar_alignment'], 'center', true) ?>>Center</option> -->
					<option value="right" <?php selected( $navbarSettings['navbar_alignment'], 'right', true) ?>>Right</option>
				</select>
			</div>

			<div class="option">
				<label>Disable Link Inner Shadows?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][link_shadows]">
					<option value="true" <?php selected( $navbarSettings['link_shadows'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $navbarSettings['link_shadows'], 'false', true ) ?>>No</option>
				</select>
			</div>

			<div class="option">
				<label>Confine Background?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][kjd_navbar_confine_background]">
					<option value="false" <?php selected( $navbarSettings['kjd_navbar_confine_background'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $navbarSettings['kjd_navbar_confine_background'], 'true', true) ?>>Yes</option>
				</select>
			</div>	

			<div class="option">
				<label>Align Navbar with logo?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][kjd_navbar_pull_up]">
					<option value="false" <?php selected( $navbarSettings['kjd_navbar_pull_up'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $navbarSettings['kjd_navbar_pull_up'], 'true', true) ?>>Yes</option>
				</select>
				<input name="kjd_navbar_misc_settings[kjd_navbar_misc][kjd_navbar_margin_top]" 
				value="<?php echo  $navbarSettings['kjd_navbar_margin_top'] ?  $navbarSettings['kjd_navbar_margin_top'] : ''; ?>"
				style="width:40px;"/>px from bottom.
			</div>	

			<div class="option">
				<label>Float navbar</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][float]">
						<option value="false" <?php selected( $navbarSettings['float'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $navbarSettings['float'], 'true', true) ?>>Yes</option>
				</select>
			</div>

			<div class="option">
				<label>Hide navbar?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][hideNav]">
						<option value="false" <?php selected( $navbarSettings['hideNav'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $navbarSettings['hideNav'], 'true', true) ?>>Yes</option>
				</select>
			</div>

			<div class="option">
				<label>Side Sliding Nav</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][side_nav]">
						<option value="false" <?php selected( $navbarSettings['side_nav'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $navbarSettings['side_nav'], 'true', true) ?>>Yes</option>
				</select>
			</div>

			<div class="option">
				<label>Dropdown Background on Mobile?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][dropdown_bg]">
					<option value="true" <?php selected( $navbarSettings['dropdown_bg'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $navbarSettings['dropdown_bg'], 'false', true ) ?>>No</option>
				</select>
			</div>

		<h3>Open Menu Button Settings</h3>
		<div class="color_option option" style="position: relative;">
			<label>Background</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_bg]" 
				value="<?php echo  $navbarSettings['menu_btn_bg'] ?  $navbarSettings['menu_btn_bg'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
		<div class="color_option option" style="position: relative;">
			<label>Border</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_border]" 
				value="<?php echo $navbarSettings['menu_btn_border'] ? $navbarSettings['menu_btn_border'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label>Background - hovered/active</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_bg_hovered]" 
				value="<?php echo  $navbarSettings['menu_btn_bg_hovered'] ?  $navbarSettings['menu_btn_bg_hovered'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
		<div class="color_option option" style="position: relative;">
			<label>Border - hovered/active</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_border_hovered]" 
				value="<?php echo $navbarSettings['menu_btn_border_hovered'] ? $navbarSettings['menu_btn_border_hovered'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>



		</div>

<?php
}

function body_misc_settings_callback(){
	settings_fields( 'kjd_body_misc_settings' );
	$options = get_option('kjd_body_misc_settings');
	$bodySettings = $options['kjd_body_misc'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');	
?>
	<div class="optionsWrapper">
			<div class="option">
				<label>Confine Background?</label>
				<select name="kjd_body_misc_settings[kjd_body_misc][kjd_body_confine_background]">
					<option value="true" <?php selected( $bodySettings['kjd_body_confine_background'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $bodySettings['kjd_body_confine_background'], 'false', true ) ?>>No</option>
				</select>
			</div>	

<!-- 			<div class="option">
				<label>Outer glow</label>
				<select name="kjd_body_misc_settings[kjd_body_misc][kjd_body_section_shadow]">
					<?php foreach($glowSettings as $glow){ ?>
						<option value="<?php echo $glow;?>" <?php selected( $bodySettings['kjd_body_section_shadow'], $glow, true) ?>>
							<?php echo $glow; ?>
						</option>
					<?php } ?>
				</select>
			</div> -->

			<div class="option">
				<label>Float body</label>
				<select name="kjd_body_misc_settings[kjd_body_misc][float]">
						<option value="true" <?php selected( $bodySettings['float'], 'true', true) ?>>Yes</option>
						<option value="false" <?php selected( $bodySettings['float'], 'false', true) ?>>No</option>
				</select>
			</div>
	</div>			
<?php
}

function footer_misc_settings_callback(){
	settings_fields( 'kjd_footer_misc_settings' );
	$options = get_option('kjd_footer_misc_settings');
	$footerSettings = $options['kjd_footer_misc'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');	
?>
	<div class="optionsWrapper">
			<div class="option">
				<label>Confine Background?</label>
				<select name="kjd_footer_misc_settings[kjd_footer_misc][kjd_footer_confine_background]">
					<option value="true" <?php selected( $footerSettings['kjd_footer_confine_background'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $footerSettings['kjd_footer_confine_background'], 'false', true ) ?>>No</option>
				</select>
			</div>	


<!-- 			<div class="option">
				<label>Outer glow</label>
				<select name="kjd_footer_misc_settings[kjd_footer_misc][kjd_footer_section_shadow]">
					<?php foreach($glowSettings as $glow){ ?>
						<option value="<?php echo $glow;?>" <?php selected( $footerSettings['kjd_footer_section_shadow'], $glow, true) ?>>
							<?php echo $glow; ?>
						</option>
					<?php } ?>
				</select>
			</div> -->

	</div>			
<?php
}
?>