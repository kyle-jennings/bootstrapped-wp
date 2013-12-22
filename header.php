<!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin-top:0 !important;">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />


	<title>
	<?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'page' ), max( $paged, $page ) );

	?>
	</title>
<?php

	$themeSettings = get_option('kjd_theme_settings');
	$logo = $themeSettings['kjd_site_logo'];	
	$custom_header = $themeSettings['kjd_custom_header'];

	$logo_toggle = $themeSettings['kjd_logo_toggle'];
	$favicon = $themeSettings['kjd_favicon'];
	$analytics = $themeSettings['kjd_google_analytics'];

	$confinePage = $themeSettings['kjd_confine_page'];
	$responsiveDesign = $themeSettings['kjd_responsive_design'];

	$headerSettings = get_option('kjd_header_misc_settings');
	$headerSettings = $headerSettings['kjd_header_misc'];
	$header_contents = $headerSettings['header_contents'];
	$confineHeaderBackground = $headerSettings['kjd_header_confine_background'];

	$options = get_option('kjd_navbar_misc_settings');
	$navbarSettings = $options['kjd_navbar_misc'];
	$alignNavWithLogo = $navbarSettings['kjd_navbar_pull_up'];
	$sideNav = $navbarSettings['side_nav'];

	$useMast = $headerSettings['use_mast'];
	$useLogo = $headerSettings['use_logo'];

	$options = get_option('kjd_mastArea_background_settings');
	$options = $options['kjd_mastArea_background_misc'];
	$confineMast = $options['confine_mast'];

	$contentAreaSettings = get_option('kjd_contentArea_background_settings');
	$confinecontentArea = $contentAreaSettings['kjd_contentArea_background']['confine_contentArea'];

	if(is_front_page() ) { 

		$hideHeader = $headerSettings['hide_header'];

		$footerSettings = get_option('kjd_footer_misc_settings');
		$footerSettings = $footerSettings['kjd_footer_misc'];
		$hideFooter = $themeOptions['hide_footer'];

		if($hideHeader == 'frontpage' || $hideHeader =='all' ){
			$output = '<style>';
				$output .= '#header{display:none;}';
			$output .=  "</style>";
		}
		echo $output;

		if($hideFooter == 'frontpage' ||$hideFooter == 'frontpage'){
			$output = "<style>";
				$output .= "#pageWrapper{margin:0 auto !important;}";
				$output .= "#footer,#push{display:none;}";
			$output .=  "</style>";
		}
			
		echo $output;

	}



 if ( is_user_logged_in() ) { 
 	echo '<style>body{ margin-top:28px !important;}</style>';
  }

	$navbar .= dirname(__FILE__).'/lib/partials/navbar_scaffolding.php';

  	wp_head();
?>

	<link rel="icon" 
      type="image/png" 
      href="<?php echo $favicon; ?>">
      
      <?php echo $analytics; ?>
</head>

<body>
	<?php 

if($sideNav =='true'){
	echo '<div id="sidr">';

	// if location is set, else use fallback
	if ( has_nav_menu( 'sidr-menu' ) ){

		wp_nav_menu(array(
			'theme_location' => 'sidr-menu', 
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
			if( $navbarSettings['navbar_style'] =='page-top' && $alignNavWithLogo !='true'){
				include($navbar); 	
			}
		?>

			<div id="header" class="<?php echo $confineHeaderBackground =='true' ? 'container confined' : '' ;?>">
				<div class="container">
					<div class="row">
					<?php  kjd_site_logo($header_contents, $logo_toggle, $logo, $custom_header); ?>
					</div> <!-- end row -->
				</div><!-- end header container -->

			</div> <!-- end header area -->

	<?php
		if( $navbarSettings['navbar_style'] !='page-top' && $alignNavWithLogo !='true'){
			include($navbar); 	
		}
	?>
	</div> <!-- end mast -->
<?php

function kjd_site_logo($header_contents, $logo_toggle, $logo, $custom_header){
	
	$heading = is_front_page() ? 'h1' : 'h2' ;

	if($headerSettings['header_contents'] == 'widgets'){ 

		dynamic_sidebar('header_widgets');
	
	}else{ 

		if($logo_toggle == 'text'){
		
			echo '<div class="header-wrapper">';
				echo $custom_header;
			echo '</div>';
		
		}elseif($logo_toggle == 'logo' ){
			
			echo '<'.$heading.' class="logo-wrapper">';
				echo '<a href="'.get_bloginfo('url').' ">';
					echo '<img src="'.$logo.'" alt=""/>';
				echo '</a>';
			echo '</'.$heading.'>';
		
		}else{
			
			echo '<div class="jumbotron no-background">';
			echo '<'.$heading.' class="logo-wrapper" >';
				echo '<a href="'.get_bloginfo('url').' ">';
					echo get_bloginfo( 'name');
				echo '</a>';
			echo '</'.$heading.'>';
				echo '<div class="logo-wrapper">'.get_bloginfo('description').'</div>';
			echo '</div>';

		}
		

	 }

}
