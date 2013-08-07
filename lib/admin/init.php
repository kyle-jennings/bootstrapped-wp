<?php
include 'general_settings_form.php';
include 'page_layouts_form.php';
include 'misc_backgrounds_form.php';

include 'settings.php';

include('admin_functions.php');

//////////////////////////////////////
// Google font selection
//////////////////////////////////////
#add_action('admin_init', 'load_google_fonts_callback');

// function load_google_fonts_callback(){
// $fontList = array();
// $fonts = get_option('kjd_appearance_settings'); 

// array_push($fontList,$fonts['kjd_heading_font']['font'],$fonts['kjd_general_font']['font']);


// $fontList = implode('|',$fontList);
// wp_enqueue_style('kjd_google-fonts', 'http://fonts.googleapis.com/css?family='.$fontList, false, '1.0');

// }

// gets js and css file for the styling and fancy pantsing



function kjd_load_style_sheets_and_scripts() {  

	$adminDir=get_bloginfo('template_directory');  
	$adminDir = $adminDir."/lib/admin/";
	wp_enqueue_style("admin", $adminDir."css/admin.css");  
  	// wp_enqueue_style("bs", get_bloginfo('template_directory').'/lib/styles/bootstrap/bootstrap.css'); 

	wp_enqueue_script("jquery", $adminDir."js/jquery.js", false, "1.0"); 
	wp_enqueue_script("bsjs", get_bloginfo('template_directory').'/lib/scripts/bootstrap.min.js'); 
	wp_enqueue_script('thickbox');  
	wp_enqueue_style('thickbox');  
	wp_enqueue_script('media-upload');  
	wp_enqueue_script('jquery-ui-sortable'); 	

	wp_enqueue_style("colorPicker", $adminDir."css/minicolors.css");
	wp_enqueue_script("colorPicker", $adminDir."js/colorpicker/minicolors.js");  
	wp_enqueue_script("admin", $adminDir."js/admin.js", false, "1.0");   

}  
add_action('admin_init', 'kjd_load_style_sheets_and_scripts');  

function kjd_initialize_kjd_settings(){
	 include 'kjd_field_settings.php';
}
add_action('admin_init', 'kjd_initialize_kjd_settings');  
/*
// checks to see if user has proper privs
if (!current_user_can('manage_options')) {  
    wp_die('You do not have sufficient permissions to access this page.');  
}*/ 

// makes new menu
function kjd_setup_theme_menus() {  

	$options = get_option('kjd_component_settings');
    

    add_menu_page(
		'Theme settings', //title bar
		'KJD Options', // menu bar title
		'manage_options',  //member access 
		'kjd_theme_settings', // id for menu
		'kjd_theme_settings_display' //function
	);  

		
		// customize header
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Customize Header', // title bar
		'Header area', // menu title
		'manage_options',   //member access
		'kjd_header_settings', // id for submenu
		create_function('', 'kjd_settings_display("header");')
	);   

		// customize navbar
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Customize Navigation', // title bar
		'Navbar area', // menu title
		'manage_options',   //member access
	    'kjd_navbar_settings', // id for submenu
		create_function('', 'kjd_settings_display("navbar");')
	);   	

	add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Navbar Submenus', // title bar
		'Navbar submenus', // menu title
		'manage_options',   //member access
	    'kjd_dropdown-menu_settings', // id for submenu
		create_function('', 'kjd_settings_display("dropdown-menu");')
	);   	
		// customize cycler
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
 		'Customize Frontpage Cycler', // title bar
		'Image Cycler', // menu title
		'manage_options',   //member access
	    'kjd_cycler_settings', // id for submenu
		create_function('', 'kjd_settings_display("cycler");')
	);   

		// customize title area
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Customize Title Area', // title bar
		'Title Area', // menu title
		'manage_options',   //member access
	    'kjd_pageTitle_settings', // id for submenu
		create_function('', 'kjd_settings_display("pageTitle");')
	);   

		// customize body
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Customize Body', // title bar
		'Body', // menu title
		'manage_options',   //member access
	    'kjd_body_settings', // id for submenu
		create_function('', 'kjd_settings_display("body");')
	);   


	// customize post
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Customize Post Contents', // title bar
		'Post Contents', // menu title
		'manage_options',   //member access
	    'kjd_posts_settings', // id for submenu
		create_function('', 'kjd_settings_display("posts");')
	); 
  

    if($options['style_widgets']=='true'){
		// customize post
	    add_submenu_page(
			'kjd_theme_settings',   // belongs to id
	  		'Customize Widgets', // title bar
			'Style Widgets', // menu title
			'manage_options',   //member access
		    'kjd_widgets_settings', // id for submenu
			create_function('', 'kjd_settings_display("widgets");')
		); 
    }
		// customize footer
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Customize Footer', // title bar
		'Footer', // menu title
		'manage_options',   //member access
	    'kjd_footer_settings', // id for submenu
		create_function('', 'kjd_settings_display("footer");')
	);   

	// customize login page
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Customize Login Page', // title bar
		'Login Page', // menu title
		'manage_options',   //member access
	    'kjd_login_settings', // id for submenu
		create_function('', 'kjd_settings_display("login");')
	);   

// customize login page
    add_submenu_page(
		'kjd_theme_settings',   // belongs to id
  		'Customize misc backgounds', // title bar
		'Special Backgrounds', // menu title
		'manage_options',   //member access
	    'kjd_misc_background_settings', // id for submenu
		'kjd_misc_backgrounds_display'
	);      

		// page layouts
    add_submenu_page(
		'kjd_theme_settings',  //belongs to id 
		'Page layouts', //title bar
		'Page Layouts', // menu title
		'manage_options',   //member access
		'kjd_page_layout_settings', //id for submenu
		'kjd_page_layout_settings_display'//function
	); 

}  

add_action("admin_menu", "kjd_setup_theme_menus");  