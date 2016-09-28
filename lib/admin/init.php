<?php

require "vendor/autoload.php";

use bswp\menus\adminMenu;
use bswp\menus\nav;

add_action('admin_menu', array(new adminMenu, 'add_top_menu') );

if(! function_exists('examine') ){

    function examine($object, $examine_type = 'print_r'){
        if(empty($object))
            return;

        echo '<pre>';
        if($examine_type == 'var_dump')
            var_dump($object);
        else
            print_r($object);

        die;
    }



/**
 * Adds the admin area CSS and JS
 * @return [type] [description]
 */
function kjd_load_style_sheets_and_scripts() {

	$adminDir = get_bloginfo('template_directory');
	$adminDir = $adminDir."/lib/admin/";

	wp_enqueue_style("admin", $adminDir."css/admin.css");
  	wp_enqueue_style("bs",$adminDir."css/bootstrap-tabs.css");

	wp_enqueue_script("bsjs", get_bloginfo('template_directory').'/lib/scripts/bootstrap.min.js');


	// mini colors
	wp_enqueue_style("colorPicker", $adminDir."css/minicolors.css");
	wp_enqueue_script("colorPicker", $adminDir."js/colorpicker/minicolors.js");


	wp_register_script( 'admin', $adminDir."js/admin.js", false, '1.0' ); //register script

	$wp_paths = array( 'export_file_url' => $adminDir.'functions/kjd_export_settings.php',
					   'root_url' 		 => get_bloginfo('template_directory'),
					   'site_url' 		 => get_bloginfo('url')
				    );
	wp_localize_script( 'admin', 'object_name', $wp_paths );
	wp_enqueue_script("admin"); //enqueue

}
add_action('admin_init', 'kjd_load_style_sheets_and_scripts');



}


// update function
include 'update/update.php';


// initializae the BSWP stuff
if( (isset($_GET['page']) && $_GET['page'] == 'bswp_settings') || (isset($_POST['option_page']) ) ) {
    include 'functions/init.php';
}
