<?php

new TemplateSettings();

$page_wrapper_class = get_page_wrapper_class();
$navbar = new Navbar('primary-menu');

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />

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

<div class="page-wrapper <?php echo $page_wrapper_class; ?>">

<?php
	if( $navbar::$position == 'above_header' || $navbar::$position == 'stickied_to_top')
        echo $navbar;

    $header = new Header(null, $navbar);
    $header::set_scaffolding();


	if( $navbar::$position == 'default' || $navbar::$position == 'below_header' || $navbar::$position == 'stickied_to_bottom' )
        echo $navbar;
