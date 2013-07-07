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
	//if ( $paged >= 2 || $page >= 2 )
	//	echo ' | ' . sprintf( __( 'Page %s', 'kjd' ), max( $paged, $page ) );

	?>
	</title>
<?php

	$themeSettings = get_option('kjd_theme_settings');
	$logo = $themeSettings['kjd_site_logo'];	
	$confinePage = $themeSettings['kjd_confine_page'];
	$responsiveDesign = $themeSettings['kjd_responsive_design'];

	$headerSettings = get_option('kjd_header_misc_settings');
	$headerSettings = $headerSettings['kjd_header_misc'];
	$confineHeaderBackground = $headerSettings['kjd_header_confine_background'];

	$options = get_option('kjd_navbar_misc_settings');
	$navbarSettings = $options['kjd_navbar_misc'];
	$alignNavWithLogo = $options['kjd_navbar_misc']['kjd_navbar_pull_up'];
	$sideNav = $navbarSettings['side_nav'];

	$useMast = $headerSettings['use_mast'];
	$useLogo = $headerSettings['use_logo'];

	$options = get_option('kjd_mastArea_background_settings');
	$options = $options['kjd_mastArea_background_misc'];
	$confineMast = $options['confine_mast'];

	$contentAreaSettings = get_option('kjd_contentArea_background_settings');
	$confinecontentArea = $contentAreaSettings['kjd_contentArea_background']['confine_contentArea'];

	wp_head();
	if(is_home() ) { 
		$themeOptions = get_option('kjd_theme_settings');
		$hideHeader = $themeOptions['kjd_hide_header'];
		$hideFooter = $themeOptions['kjd_hide_footer'];
		if($hideHeader == 'true' || $hideFooter == 'true'){
			echo "<style>";
			if($hideHeader == 'true'){
					echo"#mast{display:none;}";
				}

				if($hideFooter == 'true'){
					echo"#pageWrapper{margin:0 auto !important;}";
					echo"#footer,#push{display:none;}";
				}
				echo "</style>";
		}
			

	}
	// Custom Styles
	// $root=get_bloginfo('template_directory'); 
	// include($root.'/lib/styles/custom.php');

 if ( is_user_logged_in() ) { 
 	echo '<style>body{padding-top:18px !important;}</style>';
  }
?>
</head>

<body>
	<?php if($sideNav =='true'){
	?>
		<div id="sidr">
		  	
			<?php wp_nav_menu(array('theme_location' => 'sidr-menu' ) ); ?>
		</div>	
	<?php
	}?>

	<div id="pageWrapper">
		<div id="mastArea" class="<?php echo $confineMast == 'true' ? 'container' : '' ;?>">
		<?php
		//if the nav is set to align with header then we use the following template to render the nav NEXT to the logo in the header
		//depending on the user settings, it will probably look hideous
		if($alignNavWithLogo =='true'){

			?>
				<div class="container">
					<div class="row">
						<div class="span4 widgetWrapper hidden-phone">
							<?php if(is_active_sidebar('header-widgets') ){  
								dynamic_sidebar('header-widgets');
							 } ?>
						</div> <!-- end header widgets -->
					</div>
				</div>
				<div id="header" class="<?php echo $confineHeaderBackground =='true' ? 'container confined' : '' ;?>">
					<div class="container">
						<div class="row">
							<div id="logoWrapper">
								<?php if($useLogo == "true"){ ?>
								<a href="<?php bloginfo('url'); ?>">
									<img src="<?php echo $logo; ?>" alt=""/>
								</a>
								<?php
								}?>
							</div> <!-- end logo-->
							<?php 
								if($navbarSettings['navbar_style'] !='page-top'){
									include("navbar.php"); 	
								}
							?>
						</div> <!-- end row -->
					</div><!-- end header container -->
				</div> <!-- end header area -->
			<?php
		}else{
			//places navbar at top of page
			if($navbarSettings['navbar_style'] =='page-top'){
				include("navbar.php"); 	
			}
			?>
				<div id="header" class="visible-desktop <?php echo $confineHeaderBackground =='true' ? 'container confined' : '' ;?>">
					<div class="container">
						<div class="row">
							<div id="logoWrapper" class="span6">
								<?php if($useLogo == "true"){ ?>
								<a href="<?php bloginfo('url'); ?>">
									<img src="<?php echo $logo; ?>" alt=""/>
								</a>
								<?php
								}?>
							</div> <!-- end logo-->

							<div class="span4 widgetWrapper hidden-phone">
								<?php if(is_active_sidebar('header-widgets') ){  
									dynamic_sidebar('header-widgets');
								 } ?>
							</div> <!-- end header widgets -->
						</div> <!-- end row -->
					</div><!-- end header container -->
				</div> <!-- end header area -->
			<?php
			//places navbar underneath header - this is the default behavior
			if($navbarSettings['navbar_style'] !='page-top'){
				include("navbar.php"); 	
			}
		}
		?>
			
		</div> <!-- end mast -->