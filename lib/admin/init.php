<?php

require "vendor/autoload.php";


use bswp\Menus\AdminMenu;
use bswp\Menus\Nav;
use bswp\CSS\Builder;

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
    wp_enqueue_script("boostrap-tab", get_bloginfo('template_directory').'/lib/scripts/bootstrap/bootstrap-tab.js');
    wp_enqueue_script("boostrap-dropdown", get_bloginfo('template_directory').'/lib/scripts/bootstrap/bootstrap-dropdown.js');

	wp_enqueue_style("admin", $assets_dir."/css/admin.css");
    wp_enqueue_script( 'admin', $assets_dir."/js/_admin.js", false, '1.0' ); //register script



	$wp_paths = array( 'export_file_url' => $adminDir.'functions/kjd_export_settings.php',
					   'root_url' 		 => get_bloginfo('template_directory'),
					   'site_url' 		 => get_bloginfo('url'),
                       'assets_dir'      => $assets_dir
				    );
	wp_localize_script( 'admin', 'object_name', $wp_paths );
	wp_enqueue_script("admin"); //enqueue

}


// adds admin functions
include 'functions/admin_functions.php';
include 'functions/shortcode-injector/init.php';

// update function
include 'update/update.php';


// initializae the BSWP stuff
if( (isset($_GET['page']) && $_GET['page'] == 'bswp_settings') || (isset($_POST['option_page']) ) ) {
    add_action('admin_init', 'bswp_load_assets');
    include 'functions/init.php';
}





/**
 * build the CSS to preview.css
 * @return [type] [description]
 */
function bswp_live_preview() {

    if( !isset($_POST['data']) )
        die;

    $data = $_POST['data'];


    $builder = new Builder($data[$section], $data['form_values'], true);
    $builder->build();
    $builder->save_to_file('preview');

    unset($builder);
    die;
}

add_action('wp_ajax_bswp_live_preview', 'bswp_live_preview');
