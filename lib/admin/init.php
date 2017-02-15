<?php

require "vendor/autoload.php";


use bswp\Menus\AdminMenu;
use bswp\Menus\Nav;

add_action('admin_menu', array(new AdminMenu, 'add_top_menu') );


/**
 * Adds the admin area CSS and JS
 * @return [type] [description]
 */
function bswp_load_assets() {

	$adminDir = get_bloginfo('template_directory');
	$adminDir = $adminDir."/lib/admin/";
    $assets_dir = $adminDir . 'assets';

    wp_deregister_script( 'jquery' );
    wp_enqueue_script("bsjs", get_bloginfo('template_directory').'/lib/scripts/bootstrap.min.js');
	wp_enqueue_style("admin", $assets_dir."/css/admin.css");
    wp_enqueue_script( 'admin', $assets_dir."/js/_admin.js", false, '1.0' ); //register script



	$wp_paths = array( 'export_file_url' => $adminDir.'functions/kjd_export_settings.php',
					   'root_url' 		 => get_bloginfo('template_directory'),
					   'site_url' 		 => get_bloginfo('url')
				    );
	wp_localize_script( 'admin', 'object_name', $wp_paths );
	wp_enqueue_script("admin"); //enqueue

}


// adds admin functions
include 'functions/admin_functions.php';

// update function
include 'update/update.php';


// initializae the BSWP stuff
if( (isset($_GET['page']) && $_GET['page'] == 'bswp_settings') || (isset($_POST['option_page']) ) ) {
    add_action('admin_init', 'bswp_load_assets');
    include 'functions/init.php';
}
