<?php

	$root = get_stylesheet_directory_uri(); 
	$navbar_style = '';
	$nav_wrapper = '';
	// $navbar .= dirname(__FILE__).'/lib/partials/navbar_scaffolding.php';
	
	// general settings
	$themeSettings = get_option('kjd_theme_settings');
	$logo = $themeSettings['kjd_site_logo'];	
	$custom_header = $themeSettings['kjd_custom_header'];

	$logo_toggle = $themeSettings['kjd_logo_toggle'];
	$favicon = $themeSettings['kjd_favicon'];
	$analytics = $themeSettings['kjd_google_analytics'];

	$confinePage = $themeSettings['kjd_confine_page'];
	$responsiveDesign = $themeSettings['kjd_responsive_design'];

	// Header settings
	$headerSettings = get_option('kjd_header_misc_settings');
	$headerSettings = $headerSettings['kjd_header_misc'];
	$header_contents = $headerSettings['header_contents'];
	$confineHeaderBackground = $headerSettings['kjd_header_confine_background'];

	$useMast = $headerSettings['use_mast'];
	$useLogo = $headerSettings['use_logo'];
	$hideHeader = $headerSettings['hide_header'];
	
	$footerSettings = get_option('kjd_footer_misc_settings');
	$footerSettings = $footerSettings['kjd_footer_misc'];
	$hideFooter = $themeOptions['hide_footer'];

	// nav settings

	$navbarSettings = get_option('kjd_navbar_misc_settings');
	$navbarSettings = $navbarSettings['kjd_navbar_misc'];

	$navbarLinkStyle = $navbarSettings['navbar_link_style'];
	$navbarStyle = $navbarSettings['navbar_style'];
	$navbarPosition = $navbarSettings['navbar_position'];

	// $confineNavbarBackground = $navbarSettings['kjd_navbar_confine_background'];

	//	mobile nav settings
	$mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
	$mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];

	$mobileNavLinkStyle = $mobileNavSettings['mobilenav_link_style'];
	$mobileNavWidth = $mobileNavSettings['mobilenav_width'];
	$mobileNavPosition = $mobileNavSettings['mobilenav_position'];	

	$use_mobile_menu = $mobileNavSettings['use_mobile_menu'];
	$override_nav = $mobileNavSettings['override_nav'];
	if( $override_nav == 'true') {

		$mobilenav_style = $mobileNavSettings['mobilenav_style'];

		$mobilenav_position = $mobileNavSettings['mobilenav_position'];
		if ( $mobilenav_position == 'fixed' || $mobilenav_position == 'sticky') {
			// $navbar_style .= 'visible-desktop '
			
		}
	}


	// mast settings
	$options = get_option('kjd_mastArea_background_settings');
	$options = $options['kjd_mastArea_background_misc'];
	$confineMast = $options['confine_mast'];

	// content area settings
	$contentAreaSettings = get_option('kjd_contentArea_background_settings');
	$confinecontentArea = $contentAreaSettings['kjd_contentArea_background']['confine_contentArea'];

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin-top:0 !important;">
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

		if($hideHeader == 'frontpage' || $hideHeader =='all' ){
			$frontpage_styles .= '#header{display:none;}';
		}

		if($hideFooter == 'frontpage' || $hideFooter == 'all'){
			$frontpage_styles .= "#pageWrapper{margin:0 auto !important;}";
			$frontpage_styles .= "#footer,#push{display:none;}";
		}
			
		$frontpage_styles .=  "</style>";

	}else {

		$frontpage_styles = '<style>';

		if($hideHeader == 'inside' || $hideHeader =='all' ){
			$frontpage_styles .= '#header{display:none;}';
		}

		if($hideFooter == 'inside' || $hideFooter == 'all'){
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

<body <?php echo is_user_logged_in() ? 'class="logged-in "' : '' ;?> >

<?php 
/* -----------------------------
	Sidr Markup 
-------------------------------- */
if($mobilenav_style =='sidr'){

	echo '<div id="sidr">';

	// if location is set, else use fallback
	if ( has_nav_menu( 'mobile-menu' ) ){

		wp_nav_menu(array(
			'theme_location' => 'mobile-menu', 
			'menu_class' =>'nav nav-tabs nav-stacked',
			'container'=> '') 
		); 


	}else {
	    echo '<ul class="nav nav-tabs nav-stacked">';
		echo '<li><a href="'. home_url() .'/" title="home">Home</a></li>';
		if( is_user_logged_in() ){
			echo '<li><a href="'. home_url() .'/wp-admin/nav-menus.php" title="set menus" >Set Menu</a></li>';

		}else{

			echo '<li><a href="'. wp_login_url() .'/" title="login" >Login</a></li>';
		}
	    echo '</ul>';
	    
	} // end  has menu location set
	
	echo '</div>';

} // end using sidr

?>

<div id="pageWrapper">
	<div id="mastArea" class="<?php echo $confineMast == 'true' ? 'container' : '' ;?>">
		<?php
			if( $navbarPosition =='static-top'){

				if($navbarSettings['hideNav'] != "true"){

					echo kjd_build_navbar('primary-menu', $navbarStyle, $navbarLinkStyle, $mobilenav_style, 'visible-desktop', $navbarPosition );
					
				}
 	
			}
		?>

			<div id="header" class="<?php echo $confineHeaderBackground =='true' ? 'container confined' : '' ;?>">
				<div class="container">
					<div class="row">
					<?php  
						
						kjd_header_content($header_contents, $logo_toggle, $logo, $custom_header); 

					?>
					</div> <!-- end row -->
				</div><!-- end header container -->

			</div> <!-- end header area -->

	<?php
		if( $navbarPosition !='static-top'){
			if($navbarSettings['hideNav'] != "true"){

				if( $override_nav  == 'true'){

					echo kjd_build_navbar('mobile-menu', $mobileNavStyle, $mobileNavLinkStyle, $mobilenav_style, 'hidden-desktop', $mobileNavPosition );
					echo kjd_build_navbar('primary-menu', $navbarStyle, $navbarLinkStyle, $mobilenav_style, 'visible-desktop', $navbarPosition );
				
				}else{

					echo kjd_build_navbar('primary-menu', $navbarStyle, $navbarLinkStyle, $mobilenav_style, null, $navbarPosition);
					
				}
			}
		}
	?>
	</div> <!-- end mast -->
	<div id="contentArea">