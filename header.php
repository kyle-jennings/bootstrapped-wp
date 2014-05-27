<?php

	$root = get_stylesheet_directory_uri(); 
	$navbar_style = '';
	$nav_wrapper = '';
	// $navbar .= dirname(__FILE__).'/lib/partials/navbar_scaffolding.php';
	
	// general settings
	$theme_settings = get_option('kjd_theme_settings');
	$analytics = $theme_settings['kjd_google_analytics'];

	// logo and favicon
	$logo_settings = get_option('kjd_theme_logo');
	
	$logo = $logo_settings['kjd_site_logo'];	
	$logo_toggle = $logo_settings['kjd_logo_toggle'];
	$favicon = $logo_settings['kjd_favicon'];
	$custom_header = $logo_settings['kjd_custom_header'];

	$confinePage = $theme_settings['kjd_confine_page'];
	$responsiveDesign = $theme_settings['kjd_responsive_design'];

	// Header settings
	$header_settings = get_option('kjd_header_misc_settings');
	$header_settings = $header_settings['kjd_header_misc'];
	$header_contents = $header_settings['header_contents'];
	$confine_header_background = $header_settings['kjd_header_confine_background'];

	$useMast = $header_settings['use_mast'];
	$useLogo = $header_settings['use_logo'];
	$hide_header = $header_settings['hide_header'];
	
	$footer_settings = get_option('kjd_footer_misc_settings');
	$footer_settings = $footer_settings['kjd_footer_misc'];
	$hide_footer = $theme_options['hide_footer'];

	// nav settings

	$navbar_settings = get_option('kjd_navbar_misc_settings');
	$navbar_settings = $navbar_settings['kjd_navbar_misc'];

	$navbar_link_style = $navbar_settings['navbar_link_style'];
	$navbar_style = $navbar_settings['navbar_style'];
	$navbar_position = $navbar_settings['navbar_position'];
	

	// $confineNavbarBackground = $navbar_settings['kjd_navbar_confine_background'];

	//	mobile nav settings
	$mobile_nav_settings = get_option('kjd_mobileNav_misc_settings');
	$mobile_nav_settings = $mobile_nav_settings['kjd_mobileNav_misc'];

	$mobile_nav_link_style = $mobile_nav_settings['mobilenav_link_style'];
	$mobile_nav_width = $mobile_nav_settings['mobilenav_width'];
	$mobile_nav_position = $mobile_nav_settings['mobilenav_position'];	
	$mobile_nav_logo = $mobile_nav_settings['display_logo'];	

	$use_mobile_menu = $mobile_nav_settings['use_mobile_menu'];
	$override_nav = $mobile_nav_settings['override_nav'];

	if( $override_nav == 'true') {

		$mobilenav_style = $mobile_nav_settings['mobilenav_style'];

		$mobilenav_position = $mobile_nav_settings['mobilenav_position'];

	}
	$button_type = $mobile_nav_settings['menu_button_type'];

	// mast settings
	$options = get_option('kjd_mastArea_background_settings');
	$options = $options['kjd_mastArea_background_misc'];
	$confine_mast = $options['confine_mast'];

	// content area settings
	$content_area_settings = get_option('kjd_contentArea_background_settings');
	$confine_content_area = $content_area_settings['kjd_contentArea_background']['confine_contentArea'];

	$walker = 'drop_down';
	$menu_name = 'primary-menu';
	$visibility = 'visible-desktop';

	$nav_args = array(
		'menu_name' => $menu_name,
		'mobile_nav_width' => $mobile_nav_width,
		'mobile_nav_link_style' => $mobile_nav_link_style,
		'mobilenav_style' => $mobilenav_style,
		'visibility' => $visibility,
		'mobile_nav_position' => $mobile_nav_position,
		'mobile_nav_logo' => $mobile_nav_logo,
		'use_mobile_menu' => $use_mobile_menu,
		'button_type' => $button_type,
		'walker' => $walker
 	);


	
	$desktop_nav_object = new kjdNavBar;
	$desktop_nav_object->kjd_build_navbar(
		'primary-menu',
		 $navbar_style,
		 $navbar_link_style,
		 $mobilenav_style,
		 'visible-desktop',
		 $navbar_position,
		 $mobile_nav_logo,
		 null,
		 $button_type,
		 $walker
 	);
	// $desktop_nav_object = $desktop_nav_object->output;

	$mobile_nav_object = new kjdNavBar;

	if( $override_nav  == 'true'){

		$mobile_nav_object->kjd_build_navbar(
			'mobile-menu',
			 $mobile_nav_width,
			 $mobile_nav_link_style,
			 $mobilenav_style,
			 'hidden-desktop',
			 $mobile_nav_position,
			 $mobile_nav_logo,
			 $use_mobile_menu,
			 $button_type,
			 $walker 
	 	);

	}else{
		$mobile_nav_object->kjd_build_navbar(
			'mobile-menu',
			 $navbar_style,
			 $navbar_link_style,
			 $mobilenav_style,
			 'hidden-desktop',
			 $navbar_position,
			 $mobile_nav_logo,
			 null,
			 $button_type,
			 $walker
	 	);
	}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="icon" type="image/png" href="<?php echo $favicon; ?>">

	<title>
<?php
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ){
			echo " | $site_description";
		}

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 ){
			echo ' | ' . sprintf( __( 'Page %s', 'page' ), max( $paged, $page ) );
		}


?>
	</title>
<?php

	if(is_front_page() ) { 

		$frontpage_styles = '<style>';

		if($hide_header == 'frontpage' || $hide_header =='all' ){
			$frontpage_styles .= '#header{display:none;}';
		}

		if($hide_footer == 'frontpage' || $hide_footer == 'all'){
			$frontpage_styles .= "#pageWrapper{margin:0 auto !important;}";
			$frontpage_styles .= "#footer,#push{display:none;}";
		}
			
		$frontpage_styles .=  "</style>";

	}else {

		$frontpage_styles = '<style>';

		if($hide_header == 'inside' || $hide_header =='all' ){
			$frontpage_styles .= '#header{display:none;}';
		}

		if($hide_footer == 'inside' || $hide_footer == 'all'){
			$frontpage_styles .= "#pageWrapper{margin:0 auto !important;}";
			$frontpage_styles .= "#footer,#push{display:none;}";
		}


		$frontpage_styles .=  "</style>";

	}

  	wp_head();

  	echo $frontpage_styles;
	
	echo $analytics; 

?>
</head>

<body <?php body_class(); ?> >

<?php 
/* -----------------------------
	Sidr Markup 
-------------------------------- */
if($mobilenav_style =='sidr'){
	$sidr_object = new kjdNavBar;
	$sidr_object = $sidr_object->kjd_build_menu( 'mobile-menu', 'sidr-style', $use_mobile_menu, 'sidr_menu' );

	echo '<div id="sidr">';
		echo $sidr_object;
	echo '</div>';

} // end using sidr

?>

<div id="pageWrapper">
	<div id="mastArea" class="<?php echo $confine_mast == 'true' ? 'container' : '' ;?>">
<?php

	if( $mobilenav_position =='static-top' && $mobilenav_settings['hideNav'] != "true" ){
	 	echo $mobile_nav_object;
	}

	if( $navbar_position =='static-top' && $navbar_settings['hideNav'] != "true" ){
	 	echo $desktop_nav_object;
	}

?>

			<div id="header" class="<?php echo $confine_header_background =='true' ? 'container confined' : '' ;?>">
				<div class="container">
					<div class="row">
					<?php  
						
						kjd_header_content($header_contents, $logo_toggle, $logo, $custom_header); 

					?>
					</div> <!-- end row -->
				</div><!-- end header container -->

			</div> <!-- end header area -->

	<?php
	
	if( $mobilenav_position !='static-top' && $mobilenav_settings['hideNav'] != "true" ){
	 	echo $mobile_nav_object;
	}
	if( $navbar_position !='static-top' && $navbar_settings['hideNav'] != "true" ){
	 	echo $desktop_nav_object;
	}

	?>
	</div> <!-- end mast -->
	<div id="contentArea">