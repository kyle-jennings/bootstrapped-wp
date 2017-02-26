<?php

	$root = get_stylesheet_directory_uri();

    $navbar = new Navbar('primary-menu');

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

<div id="pageWrapper">
	<div id="mastArea" class="<?php echo $confine_mast == 'true' ? 'container' : '' ;?>">
    <?php
    	if( $navbar->position == 'above_header' || $navbar->position == 'stickied_to_top')
            echo $navbar;
    ?>

			<div id="header" class="<?php echo $confine_header_background =='true' ? 'container confined' : '' ;?>">
                <?php
                if($navbar->position == 'in_header_top')
                    echo $navbar;
                ?>
				<div class="container">
					<div class="row">
					<?php
                        kjd_header_content($header_contents, $logo_toggle, $logo, $custom_header);
                    ?>
					</div> <!-- end row -->
				</div><!-- end header container -->
                <?php
                if($navbar->position == 'in_header_bottom')
                    echo $navbar;
                ?>
			</div> <!-- end header area -->

	<?php
    	if( $navbar->position == 'below_header' || $navbar->position == 'stickied_to_bottom' )
            echo $navbar;
	?>
	</div> <!-- end mast -->
	<div id="contentArea">
