<?php

if($section =="header"){

	kjd_header_misc_settings_callback($section);

}elseif($section =="login"){

	kjd_login_misc_settings_callback($section);

}elseif($section =="navbar"){

	kjd_navbar_misc_settings_callback($section);

}elseif($section =="dropdown-menu"){

	kjd_dropdown_misc_settings_callback($section);

}elseif($section =="mobileNav"){

	kjd_mobileNav_misc_settings_callback($section);

}elseif($section =="pageTitle"){

	kjd_title_misc_settings_callback($section);

}elseif($section =="body"){

	kjd_body_misc_settings_callback($section);

}elseif($section =="posts"){

	kjd_posts_misc_settings_callback($section);	

}elseif($section =="footer"){

	kjd_footer_misc_settings_callback($section);

}


/* -----------------------------------------------------------------------------------
				Mobile  Nav
----------------------------------------------------------------------------------- */

function kjd_mobileNav_misc_settings_callback(){

	settings_fields( 'kjd_mobileNav_misc_settings' );

	$options = get_option('kjd_mobileNav_misc_settings');
	$options = $options['kjd_mobileNav_misc'];

?>

	<div class="option">
		<label>Override navbar on Mobile?</label>
		<select class="toggle-switch" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][override_nav]">
			<option value="false" <?php selected( $options['override_nav'], 'false', true ) ?>>No</option>
			<option value="true" <?php selected( $options['override_nav'], 'true', true) ?>>Yes</option>
		</select>
	</div>

	<div class="option toggle-options" <?php echo  $options['override_nav'] == 'true' ? 'style="display:block;"' : 'style="display:none;"' ;?> >
		<label>Navbar Style</label>
		<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][mobilenav_style]">
			<option value="default" <?php selected( $options['mobilenav_style'], 'default', true) ?>>Same as Desktop</option>
			<option value="sidr" <?php selected( $options['mobilenav_style'], 'sidr', true ) ?>>Sidr</option>
			<option value="dropdown" <?php selected( $options['mobilenav_style'], 'dropdown', true ) ?>>In Dropdown</option>

		</select>
	</div>
<!-- 
	if override is set to yes and navbar style is:
		default - then the colors selected in the other tabs affects the navbar area
		sidr - builds the sidr nav like it already is being done
		dropdown - removes the navbar styles and applies the mobilenav style settings 
					to a dropdown wrapped around the .nav menu
 -->


	<h3>Open Menu Button Settings</h3>
	
	<div class="color_option option" style="position: relative;">
		<label>Background</label>

		<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_bg]" 
			value="<?php echo  $options['menu_btn_bg'] ?  $options['menu_btn_bg'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>
	<div class="color_option option" style="position: relative;">
		<label>Border</label>

		<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_border]" 
			value="<?php echo $options['menu_btn_border'] ? $options['menu_btn_border'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>

	<div class="color_option option" style="position: relative;">
		<label>Background - hovered/active</label>

		<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_bg_hovered]" 
			value="<?php echo  $options['menu_btn_bg_hovered'] ?  $options['menu_btn_bg_hovered'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>
	<div class="color_option option" style="position: relative;">
		<label>Border - hovered/active</label>

		<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_border_hovered]" 
			value="<?php echo $options['menu_btn_border_hovered'] ? $options['menu_btn_border_hovered'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>




<?php


}



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
		?>
	
		<?php
			echo kjd_float_section_toggle($section, $options);
		?>

		<?php
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





/* -----------------------------------------------------------------------------------
					nav bar
----------------------------------------------------------------------------------- */

function kjd_navbar_misc_settings_callback($section){ 
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




/* -----------------------------------------------------------------------------------
				Body Area
----------------------------------------------------------------------------------- */

function kjd_body_misc_settings_callback($section){
	settings_fields( 'kjd_body_misc_settings' );
	$options = get_option('kjd_body_misc_settings');
	$options = $options['kjd_body_misc'];

	
?>
	<div class="optionsWrapper">

		<?php 
			echo kjd_confine_section_toggle($section, $options);
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

		
		<h3>Misc Colors</h3>

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

		<?php echo kjd_pre_code_colors($section, $options, 'pre'); ?>
		<?php echo kjd_pre_code_colors($section, $options, 'code'); ?>
	</div>			
<?php
}




/* ----------------------------------------------------------------------------------------
			Posts - Content 
---------------------------------------------------------------------------------------- */

function kjd_posts_misc_settings_callback()
{
	settings_fields('kjd_posts_misc_settings');
	$options = get_option('kjd_posts_misc_settings');
	$options = $options['kjd_posts_misc'];

///////post
		//use well
			//well color and opacity

?>

	<div class="optionsWrapper">
		<h3>Post/Page Styles</h3>

		<div class="option"> 
			<label>Style Posts?</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][style_posts]">
				<option value="false" <?php selected( $options['style_posts'], "false", true) ?>>No</option>
				<option value="true" <?php selected( $options['style_posts'], "true", true) ?>>Yes</option>
			<select>
		</div>


		<h3>Misc Colors</h3>

		<div class="color_option option" style="position: relative;">
			<label>Post Titles Bottom Border</label>

			<input class="minicolors" name="kjd_posts_misc_settings[kjd_posts_misc][post_info_border]" 
				value="<?php echo $options['post_info_border'] ? $options['post_info_border'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label>Blockquote Color</label>

			<input class="minicolors" name="kjd_posts_misc_settings[kjd_posts_misc][blockquote]" 
				value="<?php echo $options['blockquote'] ? $options['blockquote'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
	
		<?php echo kjd_pre_code_colors($section, $options, 'pre'); ?>
		<?php echo kjd_pre_code_colors($section, $options, 'code'); ?>
	
	</div>

	<div class="optionsWrapper">

		<h3>Post/Page Listing</h3>

		<div class="option">
			<label>Display paginator at top of posts</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][pagination_top]">
				<option value="false" <?php selected( $options['pagination_top'], "false", true) ?>>No</option>
				<option value="true" <?php selected( $options['pagination_top'], "true", true) ?>>Yes</option>
			</select>

		</div>
		

		<div class="option"> 
			<label>Show Excerpt or Content</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][post_listing_type]" class="post-listing-toggle">
				<option value="excerpt" <?php selected( $options['post_listing_type'], "excerpt", true) ?>>Excerpt</option>
				<option value="content" <?php selected( $options['post_listing_type'], "content", true) ?>>Content</option>
			<select>
		</div>

	</div>

<!-- Post Thumbnail settings -->
	<div class="optionsWrapper image-settings" <?php echo $options['post_listing_type'] == 'excerpt' ? 'style="display:block;"' : 'style="display:none;"';?>>
		<h3>Featured Image</h3>

		<div class="option"> 
			<label>Show Featured/Author Image</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][show_featured_image]" class='featured-image-toggle'>
				<option value="false" <?php selected( $options['show_featured_image'], "false", true) ?>>No</option>
				<option value="true" <?php selected( $options['show_featured_image'], "true", true) ?>>Yes</option>
			<select>
		</div> 
	</div>

	<div class="option-wraper featured-image-settings" <?php echo $options['show_featured_image'] == 'true' ? 'style="display:block;"' : 'style="display:none;"';?>>
		<div class="option"> 
			<label>Featured/Author Image Position</label>
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

		<div class="option"> 
			<label>Show Featured or Author Image</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][image_type]">
				<option value="featured" <?php selected( $options['image_type'], "featured", true) ?>>Featured</option>
				<option value="author" <?php selected( $options['image_type'], "author", true) ?>>Author</option>
			<select>
		</div> 

	</div>

<?php

}


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



/*  -------------------------------------------------------------
----------------------------------------------------------------- 
----------------------------------------------------------------- 
Repeated Setings Functions 
-----------------------------------------------------------------
-----------------------------------------------------------------
-----------------------------------------------------------------   */

function kjd_confine_section_toggle($section, $options) {

	$option_markup ='';
	$option_markup .= '<div class="option">';
		$option_markup .= '<label>Confine Background?</label>';
		$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][kjd_'.$section.'_confine_background]">';
			$option_markup .= '<option value="true" '. selected( $options['kjd_'.$section.'_confine_background'], 'true', false) .'>Yes</option>';
			$option_markup .= '<option value="false" '. selected( $options['kjd_'.$section.'_confine_background'], 'false', false ) .'>No</option>';
		$option_markup .= '</select>';
	$option_markup .= '</div>';

	return $option_markup;
}

function kjd_float_section_toggle($section, $options) {

	$option_markup ='';
	$option_markup .= '<div class="option float-toggle">';
		$option_markup .= '<label>Float Section?</label>';
		$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][float]">';
				$option_markup .= '<option value="true" '.selected( $options["float"], "true", false) .'>Yes</option>';
				$option_markup .= '<option value="false" '.selected( $options["float"], "false", false) .'>No</option>';
		$option_markup .= '</select>';
	$option_markup .= '</div>';
	
	return $option_markup;
}

function kjd_set_section_margin($section, $options) {
	$option_markup ='';
	
	$toggle_class = $options['float'] =='true' ? 'style="display:block;"' : 'style="display:none;"' ;
	$margin_top_toggle = $options['margin_top'] ? $options['margin_top'] : '0';
	$margin_bottom_toggle = $options['margin_bottom'] ? $options['margin_bottom'] : '0';

	$option_markup .= '<div class="option float-option" '. $toggle_class .'>';
		$option_markup .= '<label>Floated Section Margin</label>';
		$option_markup .= '<div class="margin-label"><span>Top</span>';
			$option_markup .= '<input name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][margin_top]" ';
				$option_markup .= 'value="'. $margin_top_toggle .'"';
				$option_markup .= 'style="width:40px;"/>px.';
		$option_markup .= '</div>';
	$option_markup .= '<div class="margin-label"><span>Bottom</span>';
		$option_markup .= '<input name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][margin_bottom]" ';
			$option_markup .= 'value="'. $margin_bottom_toggle .'"';
			$option_markup .= 'style="width:40px;"/>px.';
		$option_markup .= '</div>';
	$option_markup .= '</div>';

	return $option_markup;
}


function kjd_pre_code_colors($section, $options, $type){

?>
		<h3><?php echo ucwords($type);?></h3>
		<div class="color_option option" style="position: relative;">
			<label><?php echo ucwords($type);?> Background</label>

			<input class="minicolors" name="kjd_<?php echo $section; ?>_misc_settings[kjd_<?php echo $section; ?>_misc][<?php echo $type;?>_background]" 
				value="<?php echo $options[$type.'_background'] ? $options[$type.'_background'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label><?php echo ucwords($type);?> Text</label>

			<input class="minicolors" name="kjd_<?php echo $section; ?>_misc_settings[kjd_<?php echo $section; ?>_misc][<?php echo $type;?>_text]" 
				value="<?php echo $options[$type.'_text'] ? $options[$type.'_text'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label><?php echo ucwords($type);?> Link</label>

			<input class="minicolors" name="kjd_<?php echo $section; ?>_misc_settings[kjd_<?php echo $section; ?>_misc][<?php echo $type;?>_link]" 
				value="<?php echo $options[$type.'_link'] ? $options[$type.'_link'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label><?php echo ucwords($type);?> Hovered Link</label>

			<input class="minicolors" name="kjd_<?php echo $section; ?>_misc_settings[kjd_<?php echo $section; ?>_misc][<?php echo $type;?>_hovered_link]" 
				value="<?php echo $options[$type.'_hovered_link'] ? $options[$type.'_hovered_link'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>



<?php
}

function kjd_section_glow_toggle($section, $options) {
	
// 	$sides = array('none','left and right','top and bottom', 'top','bottom', 'all sides');

// 	$option_markup = '';
// 	$option_markup .= '<div class="option">';
// 	$option_markup .= '<label>Outer glow</label>';
// 	$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc]['.$section.'_section_shadow]">';

// 	foreach($sides as $shadow){ 
// 			$option_markup .= '<option value="'.$shadow.'" '.selected( $options[$section.'_section_shadow'], $shadow, false) . '>';
// 				$option_markup .= $shadow;
// 			$option_markup .= '</option>';
// 	}

// 	$option_markup .= '</select>';
// 	$option_markup .= '</div>';
// return $option_markup;
}