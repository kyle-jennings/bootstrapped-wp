<?php



/**
 * Helper Function  - examine object or array
 * Just prints out an object or array in a human readable way
 */
function kjd($obj){
    if (empty($obj))
        return;
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
    die;
}

// update function
include 'update/update.php';




// add the new theme settings files
include('functions/new-forms/class--bswpSections.php');
include('functions/new-forms/class--bswpAdminMenu.php');
if( isset($_GET['page']) && $_GET['page'] == 'bswp_settings' )
    include 'functions/new-forms/init.php';

// if we are not on the new theme settings page then dont load the old theme admin functions
if( isset($_GET['page']) && $_GET['page'] != 'bswp_settings' ){

    // include the file which builds the CSS
    include 'functions/stylesheet-builder/styles_init.php';
    include 'functions/admin_functions.php';

    // The forms and menu items to said forms
    include 'functions/forms/init.php';

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