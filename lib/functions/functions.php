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
function get_post_images($postID, $size = NULL) {

$attachments = get_children( array( 
	'post_parent' => $postID, 
	'post_type' => 'attachment', 
	'post_mime_type' => 'image', 
	'orderby' => 'menu_order', 
	'order' => 'ASC', 
	'numberposts' => 999 ) 
); 
	$images = array();
/* $images is now a object that contains all images (related to post id 1) and their information ordered like the gallery interface. */
    $attributes = array();
	if ( $attachments){
	    //looping through the images
	    foreach ( $attachments as $attachment => $att ) {
	    	$url = wp_get_attachment_image_src($attachment, 'thumbnail');
			$attributes['thumbnail']= $url[0];
			$url = wp_get_attachment_image_src($attachment, 'medium');
			$attributes['medium'] = $url[0];
			$url = wp_get_attachment_image_src($attachment, 'large');
			$attributes['large'] = $url[0];
			$url = wp_get_attachment_image_src($attachment, 'full');
			$attributes['full'] = $url[0];
			
			$attributes['title'] = $att->post_title;
			$attributes['description'] = $att->post_content;
			$attributes['caption'] = $att->post_excerpt;
			$attributes['alt'] = $att->_wp_attachment_image_alt;
			array_push($images, $attributes);
	    }
	}	
	

	return $images;

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


// pagination 
function posts_pagination(){
	global $wp_query;  
	  
	$total_pages = $wp_query->max_num_pages;  
	  
	if ($total_pages > 1){  
	  
	  $current_page = max(1, get_query_var('paged'));  
	    
	  echo '<div class="pagination">';
	  echo paginate_links(array(  
	      'base' => get_pagenum_link(1) . '%_%',  
	      'format' => 'page/%#%',  
	      'current' => $current_page,  
	      'total' => $total_pages,  
	      'type' => 'list',
	      'prev_text' => 'Prev',  
	      'next_text' => 'Next'  
	    ));  
	  
	  echo '</div>';  
	    
	}  

}

?>