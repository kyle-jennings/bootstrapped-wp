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
}elseif($section =="posts"){
	posts_misc_settings_callback();	
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
		<div class="option float-toggle">
			<label>Float Title Area</label>
			<select name="kjd_pageTitle_misc_settings[kjd_pageTitle_misc][float][toggle]">
				<option value="true" <?php selected( $options['float']['toggle'], 'true', true) ?>>Yes</option>
				<option value="false" <?php selected( $options['float']['toggle'], 'false', true) ?>>No</option>
			</select>
		</div>	


		<div class="option float-option" <?php echo $options['float']['toggle']=='true' ? 'style="display:block;"' : 'style="display:none;"' ; ?>>
			<label>Page title margin</label>
			<div class="margin-label"><span>Top</span>
			<input name="kjd_pageTitle_misc_settings[kjd_pageTitle_misc][float][margin_top]" 
				value="<?php echo $options['float']['margin_top'] ? $options['float']['margin_top'] : ''; ?>"
				style="width:40px;"/>px.
			</div>
			<div class="margin-label"><span>Bottom</span>
			<input name="kjd_pageTitle_misc_settings[kjd_pageTitle_misc][float][margin_bottom]" 
				value="<?php echo $options['float']['margin_bottom'] ? $options['float']['margin_bottom'] : ''; ?>"
				style="width:40px;"/>px.
			</div>
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
				value="<?php echo $options['header_height'] ? $options['header_height'] : '' ;?>" style="width:40px;">px
			</div>

			<div class="option">
				<label>Confine Background?</label>
				<select name="kjd_header_misc_settings[kjd_header_misc][kjd_header_confine_background]">
					<option value="false" <?php selected( $options['kjd_header_confine_background'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['kjd_header_confine_background'], 'true', true) ?>>Yes</option>
				</select>
			</div>	

			<div class="option float-toggle">
				<label>Float Header Area</label>
				<select name="kjd_header_misc_settings[kjd_header_misc][float][toggle]">
						<option value="true" <?php selected( $options['float']['toggle'], 'true', true) ?>>Yes</option>
						<option value="false" <?php selected( $options['float']['toggle'], 'false', true) ?>>No</option>
				</select>
			</div>	


			<div class="option float-option">
				<label>Float Margin.</label>
				<div class="margin-label"><span>Top</span>
				<input name="kjd_header_misc_settings[kjd_header_misc][float][margin_top]" 
					value="<?php echo $options['float']['margin_top'] ? $options['float']['margin_top'] : ''; ?>"
					style="width:40px;"/>px.
				</div>
				<div class="margin-label"><span>Bottom</span>
					<input name="kjd_header_misc_settings[kjd_header_misc][float][margin_bottom]" 
					value="<?php echo $options['float']['margin_bottom'] ? $options['float']['margin_bottom'] : ''; ?>"
					style="width:40px;"/>px.
				</div>
			</div>
				
			<div class="option">
				<label>Hide Header?</label>
				<select name="kjd_header_misc_settings[kjd_header_misc][hide_header]">
					<option value="false" <?php selected( $options['hide_header'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['hide_header'], 'true', true ) ?>>Yes</option>
				</select>
			</div>			

		</div><!-- end options wrapper -->

<?php
}

function navbar_misc_settings_callback(){ 
	settings_fields( 'kjd_navbar_misc_settings' );
	$options = get_option('kjd_navbar_misc_settings');
	$options = $options['kjd_navbar_misc'];

	$navBarStyles = array('full_width','contained','page-top','sticky-top','sticky-bottom');	
	$navBarLinkStyles = array('none','highlighted','pills','tabs', 'tabs-below');	

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>
		<!-- link styles -->
		<div class="optionsWrapper">

			<h3>Navbar settings</h3>
			<div class="option">
				<label><?php echo ucwords(str_replace("_"," ",$section));?> navbar style</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_style]">
					<?php foreach($navBarStyles as $style){ ?>
						<option value="<?php echo $style;?>" <?php selected( $options['navbar_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?></option>
					<?php } ?>
				</select>
			</div>

			<div class="option">
				<label>Nav link style</label>
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

			<div class="option">
				<label>Confine Background?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][kjd_navbar_confine_background]">
					<option value="false" <?php selected( $options['kjd_navbar_confine_background'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['kjd_navbar_confine_background'], 'true', true) ?>>Yes</option>
				</select>
			</div>	

			<div class="option">
				<label>Move to header and align?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][kjd_navbar_pull_up]">
					<option value="false" <?php selected( $options['kjd_navbar_pull_up'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['kjd_navbar_pull_up'], 'true', true) ?>>Yes</option>
				</select>
				<input name="kjd_navbar_misc_settings[kjd_navbar_misc][kjd_navbar_margin_top]" 
				value="<?php echo  $options['kjd_navbar_margin_top'] ?  $options['kjd_navbar_margin_top'] : ''; ?>"
				style="width:40px;"/>px.
			</div>	

			<div class="option float-toggle">
				<label>Float Navbar Area</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][float][toggle]">
						<option value="true" <?php selected( $options['float']['toggle'], 'true', true) ?>>Yes</option>
						<option value="false" <?php selected( $options['float']['toggle'], 'false', true) ?>>No</option>
				</select>
			</div>	


			<div class="option float-option" <?php echo $options['float']['toggle']=='true' ? 'style="display:block;"' : 'style="display:none;"' ; ?>>
				<label>Navbar Margin</label>
				<div class="margin-label"><span>Top</span>
				<input name="kjd_navbar_misc_settings[kjd_navbar_misc][float][margin_top]" 
					value="<?php echo $options['float']['margin_top'] ? $options['float']['margin_top'] : '0'; ?>"
					style="width:40px;"/>px.
				</div>
				<div class="margin-label"><span>Bottom</span>
					<input name="kjd_navbar_misc_settings[kjd_navbar_misc][float][margin_bottom]" 
					value="<?php echo $options['float']['margin_bottom'] ? $options['float']['margin_bottom'] : '0'; ?>"
					style="width:40px;"/>px.
				</div>
			</div>

			<div class="option">
				<label>Remove left padding on first link</label>
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

			<div class="option">
				<label>Side Sliding Nav</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][side_nav]">
						<option value="false" <?php selected( $options['side_nav'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $options['side_nav'], 'true', true) ?>>Yes</option>
				</select>
			</div>

			<div class="option">
				<label>Dropdown Background on Mobile?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][dropdown_bg]">
					<option value="true" <?php selected( $options['dropdown_bg'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $options['dropdown_bg'], 'false', true ) ?>>No</option>
				</select>
			</div>

		<h3>Open Menu Button Settings</h3>
		<div class="color_option option" style="position: relative;">
			<label>Background</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_bg]" 
				value="<?php echo  $options['menu_btn_bg'] ?  $options['menu_btn_bg'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
		<div class="color_option option" style="position: relative;">
			<label>Border</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_border]" 
				value="<?php echo $options['menu_btn_border'] ? $options['menu_btn_border'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label>Background - hovered/active</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_bg_hovered]" 
				value="<?php echo  $options['menu_btn_bg_hovered'] ?  $options['menu_btn_bg_hovered'] : ''; ?>"/>
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

/* ------------------------- Body Misc Settings --------------------------- */
function body_misc_settings_callback(){
	settings_fields( 'kjd_body_misc_settings' );
	$options = get_option('kjd_body_misc_settings');
	$options = $options['kjd_body_misc'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');	
?>
	<div class="optionsWrapper">
			<div class="option">
				<label>Confine Background?</label>
				<select name="kjd_body_misc_settings[kjd_body_misc][kjd_body_confine_background]">
					<option value="true" <?php selected( $options['kjd_body_confine_background'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $options['kjd_body_confine_background'], 'false', true ) ?>>No</option>
				</select>
			</div>	

<!-- 			<div class="option">
				<label>Outer glow</label>
				<select name="kjd_body_misc_settings[kjd_body_misc][kjd_body_section_shadow]">
					<?php foreach($glowSettings as $glow){ ?>
						<option value="<?php echo $glow;?>" <?php selected( $options['kjd_body_section_shadow'], $glow, true) ?>>
							<?php echo $glow; ?>
						</option>
					<?php } ?>
				</select>
			</div> -->

		<div class="color_option option" style="position: relative;">
			<label>Post Titles Bottom Border</label>

			<input class="minicolors" name="kjd_body_misc_settings[kjd_body_misc][post_info_border]" 
				value="<?php echo $options['post_info_border'] ? $options['post_info_border'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label>Blockquote Color</label>

			<input class="minicolors" name="kjd_body_misc_settings[kjd_body_misc][blockquote]" 
				value="<?php echo $options['blockquote'] ? $options['blockquote'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="option float-toggle">
			<label>Float Body Area</label>
			<select name="kjd_body_misc_settings[kjd_body_misc][float][toggle]">
					<option value="true" <?php selected( $options['float']['toggle'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $options['float']['toggle'], 'false', true) ?>>No</option>
			</select>
		</div>	


		<div class="option float-option" <?php echo $options['float']['toggle']=='true' ? 'style="display:block;"' : 'style="display:none;"' ; ?>>
			<label>Body Margin</label>
			<div class="margin-label"><span>Top</span>
			<input name="kjd_body_misc_settings[kjd_body_misc][float][margin_top]" 
				value="<?php echo $options['float']['margin_top'] ? $options['float']['margin_top'] : ''; ?>"
				style="width:40px;"/>px.
			</div>
			<div class="margin-label"><span>Bottom</span>
				<input name="kjd_body_misc_settings[kjd_body_misc][float][margin_bottom]" 
				value="<?php echo $options['float']['margin_bottom'] ? $options['float']['margin_bottom'] : ''; ?>"
				style="width:40px;"/>px.
			</div>
		</div>
	</div>			
<?php
}

/* ---------------------------  Posts Misc settings ----------------------------- */
function posts_misc_settings_callback()
{
	settings_fields('kjd_posts_misc_settings');
	$options = get_option('kjd_posts_misc_settings');
	$options = $options['kjd_posts_misc'];

///////post
		//use well
			//well color and opacity

?>
	<div class="optionsWrapper">

		<h3>Post/Page Listing</h3>


		<div class="option"> 
			<label>Show Excerpt or Content</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][post_listing_type]" class="post-listing-toggle">
				<option value="excerpt" <?php selected( $options['post_listing_type'], "excerpt", true) ?>>Excerpt</option>
				<option value="content" <?php selected( $options['post_listing_type'], "content", true) ?>>Content</option>
			<select>
		</div>

	</div>

	<div class="optionsWrapper image-settings" <?php echo $options['post_listing_type'] == 'excerpt' ? 'style="display:block;"' : 'style="display:none;"';?>>
		<h3>Featured Image</h3>

		<div class="option"> 
			<label>Show Featured Image</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][show_featured_image]" class='featured-image-toggle'>
				<option value="false" <?php selected( $options['show_featured_image'], "false", true) ?>>No</option>
				<option value="true" <?php selected( $options['show_featured_image'], "true", true) ?>>Yes</option>
			<select>
		</div> 

		<div class="option featured-image-settings"> 
			<label>Featured Image Position</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][featured_position]">
				<?php
					$positions = array('atop_post','left_of_post','right_of_post','after_post','before_post_info', 'before_content','before_post_meta');
					foreach($positions as $position){
						$selected = selected( $options['featured_position'], $position, true);
						echo '<option value="'.$position.'" '.$selected.' >'.ucwords(str_replace('_',' ',$position)).'</option>';
					}
				?>
			<select>
		</div> 
	</div>

	<div class="optionsWrapper">

		<h3>Post/Page Listing</h3>


		<div class="option"> 
			<label>Use Background Color?</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][post_background_toggle]">
				<option value="true" <?php selected( $options['post_background_toggle'], "true", true) ?>>Yes</option>
				<option value="false" <?php selected( $options['post_background_toggle'], "false", true) ?>>No</option>
			<select>
		</div>
		
	</div>
<?php

}


/* ---------------------------  Footer Misc settings ----------------------------- */
function footer_misc_settings_callback(){
	settings_fields( 'kjd_footer_misc_settings' );
	$options = get_option('kjd_footer_misc_settings');
	$options = $options['kjd_footer_misc'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');	
?>
	<div class="optionsWrapper">
			<div class="option">
				<label>Confine Background?</label>
				<select name="kjd_footer_misc_settings[kjd_footer_misc][kjd_footer_confine_background]">
					<option value="true" <?php selected( $options['kjd_footer_confine_background'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $options['kjd_footer_confine_background'], 'false', true ) ?>>No</option>
				</select>
			</div>	

		<div class="option">
			<label>Footer Height</label>
			<input name="kjd_footer_misc_settings[kjd_footer_misc][height]" 
				value="<?php echo $options['height'] ? $options['height'] : ''; ?>"
				style="width:40px;"/>px.
		</div>

<!-- 			<div class="option">
				<label>Outer glow</label>
				<select name="kjd_footer_misc_settings[kjd_footer_misc][kjd_footer_section_shadow]">
					<?php foreach($glowSettings as $glow){ ?>
						<option value="<?php echo $glow;?>" <?php selected( $options['kjd_footer_section_shadow'], $glow, true) ?>>
							<?php echo $glow; ?>
						</option>
					<?php } ?>
				</select>
			</div> -->

	</div>			
<?php
}
?>