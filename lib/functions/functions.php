<?php 
// gets options function
if(is_admin()){
	include(dirname(dirname(__FILE__)).'/admin/init.php' ); 	
}

 require_once('kjdMenus.php');
 require_once('kjdGallery.php');
 require_once('kjdShortcodes.php');
 require_once('kjdWidgets.php');


add_action( 'wp_enqueue_scripts', 'add_assets' );
function add_assets(){

	$root=get_bloginfo('template_directory'); 
	$root = $root.'/lib';

	wp_enqueue_script("jquery", $root."/scripts/jquery.js", false, "1.0", false);  
	wp_enqueue_script("bootstrap", $root."/scripts/bootstrap.min.js", false, "1.0", true);  
	wp_enqueue_script("script", $root."/scripts/application.js", false, "1.0", true);  
	wp_enqueue_style("bootstrap", $root."/styles/bootstrap/bootstrap.css");
	$generalSettings = get_option('kjd_theme_settings');
	$responsive = $generalSettings['kjd_responsive_design'];
	if($responsive == 'true'){
		wp_enqueue_style("bootstrap-responsive", $root."/styles/bootstrap/bootstrap-responsive.css");
	}

	wp_enqueue_style("wpstyles", $root."/styles/wpstyles.css");	
	wp_enqueue_style("scaffolding", $root."/styles/common.css");	
	
}

///////////////////////////
// featured image settings
///////////////////////////

if (function_exists('add_theme_support')) {  
    add_theme_support('post-thumbnails');  
}  


// get image sizes from admin area
//
// if (function_exists("add_image_size")) {  
//     add_image_size('wideBanner', 1170, 400, true);
//     add_image_size('normalBanner', 960, 400, true);
// }  

// add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );  
// function custom_image_sizes_choose( $sizes ) {  
//     $custom_sizes = array(  
//         'wideBanner' => 'Wide Banner',  
//         'normalBanner' => 'Normal Banner'
//     );  
//     return array_merge( $sizes, $custom_sizes );  
// }

//gets featured image meta info
function the_post_thumbnail_description($args) {
  $thumbnail_id    = get_post_thumbnail_id($args->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_content.'</span>';
  }
}





//////////////////
// get images
//////////////////

// old image grabber
function get_post_images($postid, $size) {
	$atts = new WP_Query(array(
		'post_type' => 'attachment',
		'post_status' => 'null',
		'post_mime_type' => 'image/jpeg',
		'post_parent' => $postid,
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'showposts' => 99, 'size'=> $size
	));
	
	$imgs = array();
	
	if ($atts->have_posts()) :
		foreach ($atts->posts as $att) :
			$title = apply_filters('the_title', $att->post_title);
			$data = wp_get_attachment_image_src($att->ID, $size);
			
			if ($data[2] <= 50) : # hack: no "featured" images; they are not distinguished in any way in the database
				continue;
			endif;
			
			$imgs[$title] = $data;
			$imgs[$title][3] = apply_filters('the_content', $att->post_content);
		endforeach;
	endif;
	
	return $imgs;
}


// new image grabber
function get_all_post_images($postid, $size) {
	$images = get_children( array( 
		'post_parent' => $postid,
		'post_type' => 'attachment', 
		'post_mime_type' => 'image', 
		'size'=> $size, 
		'orderby' => 'menu_order', 
		'order' => 'ASC', 
		'numberposts' => 999 ) 
	); 

	$imageData = array();
    if ( $images ) { 
        //looping through the images
        foreach ( $images as $image_id => $image ) {
        	$imageData['title'] = $image->post_title; 
        	$imageData['excerpt'] = $image->post_excerpt;
        	$imageData['content'] = $image->post_content;
        }
    }
    return $imageData;
}

/// page template stuff
function layoutSettings(){
	
}

function deviceViewSettings($deviceView){
		if(isset($deviceView) && $deviceView !="all"){
			echo $deviceView;
		}else{
		}
}

////////////////////////
// login screen styling

function wpc_url_login(){
$siteURL = get_option('siteurl');
    return $siteURL; // your URL here
}
add_filter('login_headerurl', 'wpc_url_login');

function login_css() {
	require_once(dirname(dirname(__FILE__)).'/styles/login.php');
}
add_action('login_head', 'login_css');

//include('kjdBuildWidgets.php');


?>