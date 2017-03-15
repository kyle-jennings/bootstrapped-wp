<?php

if(! function_exists('examine') ){

    function examine($object, $examine_type = 'print_r', $die = 'hard'){
        if(empty($object))
            return;

        echo '<pre>';
        if($examine_type == 'var_dump')
            var_dump($object);
        else
            print_r($object);

        if($die != 'soft')
            die;
    }

}


function bswp_remove_customizer() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('customize');
}

add_action( 'wp_before_admin_bar_render', 'bswp_remove_customizer' );

function bswp_remove_customizer_menu_item () {
    global $submenu;
    foreach($submenu['themes.php'] as $key=>$item)
        if($item[1] == 'customize')
            unset($submenu['themes.php'][$key]);
}
add_action('admin_menu', 'bswp_remove_customizer_menu_item');

register_nav_menus(
    array(
      'primary-menu' => __( 'Primary Nav' ),
    )
);

// gets options function
if(is_admin())
    include 'admin/init.php' ;

if(!is_admin()){
    require_once('functions/kjd-gallery.php');
    require_once('functions/kjd-shortcodes.php');
    require_once('functions/class-Navbar.php');
    require_once('functions/class-Header.php');
    require_once('functions/kjd-class-layout.php');
    require_once('functions/class-mobileMenu.php');
    require_once('functions/class-navbarMenu.php');
    add_action( 'wp_enqueue_scripts', 'bswp_add_assets' );

}


require_once('functions/kjd-widgets.php');


/* ------------------------------------------------
 kjd add js and css
 -------------------------------------------------- */
function bswp_add_assets(){

    //set tempplate root
    $root = get_bloginfo('template_directory');
    $wpcontent = dirname( ( dirname($root) ) );
    $root = $root.'/lib';

    // set variables
    $mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
    $mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];

    $override_nav = $mobileNavSettings['override_nav'];
    if( $override_nav == 'true') {
        $mobilenav_style = $mobileNavSettings['mobilenav_style'];
    }

    wp_enqueue_script("jquery", $root."/scripts/jquery.js", false, null, false);

    wp_enqueue_script("bootstrap-dropdown", $root."/scripts/bootstrap/bootstrap-dropdown.js", false, null, true);
    wp_enqueue_script("bootstrap-carousel", $root."/scripts/bootstrap/bootstrap-carousel.js", false, null, true);


    $component_options = get_option('bswp_site_settings');
    $component_options = $component_options['available_components']['components'];

    // this always needs to be here because of the navbar
    wp_enqueue_script("bootstrap-collapse", $root."/scripts/bootstrap/bootstrap-collapse.js", false, null, true);


    if($component_options['activate_tabs'])
        wp_enqueue_script("bootstrap-tab", $root."/scripts/bootstrap/bootstrap-tab.js", false, null, true);

    if($component_options['activate_tooltips'])
        wp_enqueue_script("bootstrap-tooltip", $root."/scripts/bootstrap/bootstrap-tooltip.js", false, null, true);

    if($component_options['activate_popovers'])
        wp_enqueue_script("bootstrap-popover", $root."/scripts/bootstrap/bootstrap-popover.js", false, null, true);




    wp_enqueue_script("site", $root."/scripts/application.js", 'jquery', null, true);




    wp_enqueue_style("site", wp_upload_dir()['baseurl'].'/bswp/assets/css/site.css');
    wp_enqueue_style("base", $root."/styles/common.css");

    // Add slider scripts if on front page
    if( is_front_page() )
        include( 'functions/add-slider-scripts.php');

}


require_once('functions/functions.php');
