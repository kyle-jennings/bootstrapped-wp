<?php

require "vendor/autoload.php";
use bswp\Settings;
use bswp\Menus\AdminMenu;
use bswp\Menus\Nav;
use bswp\CSS\Builder;

add_action('admin_menu', array(new AdminMenu, 'add_top_menu') );


function bswp_check_for_styles() {
    $file = wp_upload_dir()['basedir'].'/bswp/assets/css/site.css';
    if(!file_exists($file)){
        $name = 'site_settings';
        $settings = get_option('bswp_'.$name);

        $builder = new Builder($name, $settings);
        $builder->build();
        $builder->save_to_file('dist');
        unset($builder);
    }

}
add_action("after_switch_theme", "bswp_check_for_styles");

/**
 * Adds the admin area CSS and JS
 * @return [type] [description]
 */
function bswp_admin_assets() {

	$adminDir = get_bloginfo('template_directory');
	$adminDir = $adminDir."/lib/admin/";
    $assets_dir = $adminDir . 'assets';
    $css_dir = wp_upload_dir()['baseurl'];


    wp_deregister_script( 'jquery' );
    wp_enqueue_script("boostrap-tab", get_bloginfo('template_directory').'/lib/scripts/bootstrap/bootstrap-tab.js');
    wp_enqueue_script("boostrap-dropdown", get_bloginfo('template_directory').'/lib/scripts/bootstrap/bootstrap-dropdown.js');

	wp_enqueue_style("admin", $assets_dir."/css/admin.css");
    wp_enqueue_script( 'admin', $assets_dir."/js/_admin.js", false, '1.0' ); //register script



	$wp_paths = array( 'export_file_url' => $adminDir.'functions/kjd_export_settings.php',
					   'root_url' 		 => get_bloginfo('template_directory'),
					   'site_url' 		 => get_bloginfo('url'),
                       'css_dir'      => $css_dir,
				    );
	wp_localize_script( 'admin', 'object_name', $wp_paths );
	wp_enqueue_script("admin"); //enqueue

}


function bswp_add_editor_styles() {
    $dir = get_bloginfo('template_directory');
    $frontend_dir = $dir."/lib/styles/";
    $admin_dir = $dir."/lib/admin/assets/css/";

    $files = array($frontend_dir.'site.css', $admin_dir.'editor.css');
    add_editor_style( $files );
}
add_action( 'admin_init', 'bswp_add_editor_styles' );

// adds admin functions
include 'functions/admin_functions.php';
include 'functions/ajax-functions.php';
include 'functions/shortcode-injector/init.php';
include 'functions/metabox--featured-post.php';

// update function
include 'update/update.php';


// initializae the BSWP stuff
if( (isset($_GET['page']) && $_GET['page'] == 'bswp_settings') || (isset($_POST['option_page']) ) ) {
    add_action('admin_init', 'bswp_admin_assets');
    include 'functions/init.php';
}
