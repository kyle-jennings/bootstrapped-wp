<?php

global $page, $paged;
$root = get_stylesheet_directory_uri();

$site_options = get_option('bswp_site_settings');
$header_settings = $site_options['header'];

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
    wp_head();
?>
</head>


<body <?php body_class(); ?> >

<div id="pageWrapper">
	<div id="mastArea">
    <?php
    	if( $navbar->position == 'above_header' || $navbar->position == 'stickied_to_top')
            echo $navbar;
    ?>

			<div id="header">
                <?php
                if($navbar->position == 'in_header_top')
                    echo $navbar;
                ?>
				<div class="container">
					<div class="row">
					<?php echo new Header(); ?>
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
