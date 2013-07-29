<?php 
// gets options function
if(is_admin()){
	include(dirname(dirname(__FILE__)).'/admin/init.php' ); 	
	include(dirname(dirname(__FILE__)).'/styles/styles.php');
}

 require_once('kjd_bootstrap_menus.php');
 require_once('kjdGallery.php');
 require_once('kjdShortcodes.php');
 require_once('kjdWidgets.php');
 require_once('kjd_adminbar_menu.php');

add_action( 'wp_enqueue_scripts', 'add_assets' );
function add_assets(){

	$navbarSettings = get_option('kjd_navbar_misc_settings');
	$navbarSettings = $navbarSettings['kjd_navbar_misc'];
	$sideNav = $navbarSettings['side_nav'];

	$root=get_bloginfo('template_directory'); 
	$root = $root.'/lib';

	wp_enqueue_script("jquery", $root."/scripts/jquery.js", false, "1.0", false);  
	wp_enqueue_script("bootstrap", $root."/scripts/bootstrap.min.js", false, "1.0", true);  

	if($sideNav =='true'){
		wp_enqueue_script("sidr", $root."/scripts/sidr.min.js", false, "1.0", true);  
		wp_enqueue_style("sidr", $root."/styles/sidr.css");
	}
	wp_enqueue_script("script", $root."/scripts/application.js", false, "1.0", true);  

	wp_enqueue_style("bootstrap", $root."/styles/bootstrap/bootstrap.css");
	$generalSettings = get_option('kjd_theme_settings');
	$responsive = $generalSettings['kjd_responsive_design'];
	if($responsive == 'true'){
		wp_enqueue_style("bootstrap-responsive", $root."/styles/bootstrap/bootstrap-responsive.css");
	}

	wp_enqueue_style("wpstyles", $root."/styles/wpstyles.css");	
	wp_enqueue_style("scaffolding", $root."/styles/common.css");	
	wp_enqueue_style("custom", $root."/styles/custom.css");
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


// add excerpts to pages
add_action( 'init', 'add_excerpts_to_pages' );
function add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
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
			
			$attributes['image_id'] = $att->ID;
			$attributes['title'] = $att->post_title;
			$attributes['description'] = $att->post_content;
			$attributes['caption'] = $att->post_excerpt;
			$attributes['alt'] = $att->_wp_attachment_image_alt;
			array_push($images, $attributes);
	    }
	}	
	return $images;

}


/* -------------------device views ----------------------- */

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


/* --------------------------- read more link --------------------------*/
function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* -------------------------------- pagination  ------------------------------- */
function posts_pagination(){
	
	$pagination_markup ='';

	global $wp_query;  
	  
	$total_pages = $wp_query->max_num_pages;  
	  
	if ($total_pages > 1){  
	  
	  $current_page = max(1, get_query_var('paged'));  
	  $pagination_markup .= '<div class="row">';

		  $pagination_markup .= '<div class="pagination">';
		  $pagination_markup .=  paginate_links(array(  
		      'base' => get_pagenum_link(1) . '%_%',  
		      'format' => 'page/%#%',  
		      'current' => $current_page,  
		      'total' => $total_pages,  
		      'type' => 'list',
		      'prev_text' => 'Prev',  
		      'next_text' => 'Next'  
		    ));  
		  $pagination_markup .= '</div>';
	  $pagination_markup .= '</div>';  
	    
	}  
	return $pagination_markup;
}

/* ---------------------------- content and content list scaffolding functions ----------------------------- */


function kjd_get_the_content($post_display = null)
{
	$the_content_markup = '';

	$the_content_markup .= '<div class="the-content">';
	if(!is_single() && !is_page()){
		$title = get_the_title();
	}


	if(is_attachment()){

		if ( wp_attachment_is_image( $post->id ) ){
			$att_image = wp_get_attachment_image_src( $post->id, "full");
	        
	        $the_content_markup .= '<div class="attachment">';
	        	$the_content_markup .= '<a href="'.wp_get_attachment_url($post->id).'" title="'.get_the_title().'" rel="attachment">';
	        		$the_content_markup .= '<img src="'.$att_image[0].'" class="attachment-medium" alt="'.$post->post_excerpt.'" /></a>';
	        $the_content_markup .= '</div>';
		}

	}elseif(is_404()){

		$the_content_markup = kjd_the_404();

	}elseif(is_single() || is_page()){
		
		ob_start();
			the_content();
			$buffered_content = ob_get_contents();
		ob_end_clean();

		$the_content_markup .= $buffered_content;
	
	}else{
		ob_start();
		if($post_display !='excerpt'){
			the_content();
		}else{
			the_excerpt();
		}
			$buffered_content = ob_get_contents();
		ob_end_clean();

		$the_content_markup .= $buffered_content;
	}

		$the_content_markup .= '<div style="clear:both;"></div>';
	$the_content_markup .= '</div>';

	return $the_content_markup;
}

/* ------------------------------ post info ----------------------------- */
function kjd_get_the_post_info()
{
	$the_post_info_markup =	'<div class="post-info">';
	$the_post_info_markup .='<span class="post-date">';
	$the_post_info_markup .= 'Posted on: <a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date('F j').'</a>, <a href="'.get_year_link(get_the_time('Y')).'">'.get_the_date('Y').'</a> - </span>';
	$the_post_info_markup .='<span class="post-author">';
	$the_post_info_markup .='By: <a href="'.get_the_author_link().'">'.get_the_author().'</a>';
	$the_post_info_markup .= '</span></div>';

	return $the_post_info_markup;
}

/* --------------------------- post meta -------------------------- */
function kjd_get_the_post_meta(){
	ob_start();
		the_category();
		$buffered_categories = ob_get_contents();
	ob_end_clean();
	$the_post_meta_markup = '<div class="post-meta">';
	if(!is_page() && !is_attachment()){
		$the_post_meta_markup .= '<span class="cat-label">Categorized: </span>'.$buffered_categories;
		$the_post_meta_markup .= '<div style="clear:both;"></div>';
	}

	if(is_attachment()){
		$the_post_meta_markup .= kjd_gallery_image_links();	

		$the_post_meta_markup .= '<p class="attachment-description">'.get_the_content().'</p>';
	}
	$the_post_meta_markup .= '</div>';

	return $the_post_meta_markup;
}

/* ------------------------------- the content ------------------------------ */
function kjd_the_content(){


	$post_options = get_option('kjd_posts_misc_settings');
	$post_options = $post_options['kjd_posts_misc'];
	$post_display = $post_options['post_listing_type'];

	$use_featured_image = ($post_options['show_featured_image'] == 'true' && $post_options['post_listing_type'] == 'excerpt') ? 'true' : 'false' ;
	$featured_image = $post_options['featured_position'];

	$content_well = $post_options['post_background_toggle'] == "true" ? 'well' : '' ;

	$the_content_markup = '';


	// this will wrap the content in a well if need be
	$the_content_markup .= '<div class="the-content-wrapper '.$content_well.'">';
		
		// puts featured image before content wrapper
		if(in_array($featured_image, array('atop_post','left_of_post')) && $use_featured_image == 'true'){

			$the_content_markup .= kjd_get_featured_image($featured_image);
		}

		$the_content_markup .= '<div class="the-content-inner">';


			if(!is_single() && !is_page()){
				$the_content_markup .= '<h3 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
			}

			if(!is_page() || is_attachment()){

				// featured image before info
				if($featured_image == 'before_post_info' && $use_featured_image == 'true' && !is_attachment()){
					$the_content_markup .= kjd_get_featured_image();
				}

				$the_content_markup .= kjd_get_the_post_info();
			}

			// featured image before content
			if($featured_image == 'before_content' && $use_featured_image == 'true' && !is_attachment()){
				$the_content_markup .= kjd_get_featured_image();
			}

			// the content
			$the_content_markup .= kjd_get_the_content($post_display);
			//the content

			if(!is_page() || is_attachment()){
				
				// featured image before meta
				if($featured_image == 'before_post_meta' && $use_featured_image == 'true' && !is_attachment()){
					$the_content_markup .= kjd_get_featured_image();
				}

				$the_content_markup .= kjd_get_the_post_meta();
			}

		// closes content inner
		$the_content_markup .= '</div>';

		// featured image after post or right of post
		if(in_array($featured_image, array('after_post','right_of_post')) && $use_featured_image == 'true'){
			$the_content_markup .= kjd_get_featured_image($featured_image);
		}

	// closes the content-wrapper
	$the_content_markup .= '</div>';

	return $the_content_markup;
}


/* ---------------------------------- the post or page title ------------------------------------ */
function kjd_get_the_title($content_type = null)
{
	$class = $confineTitleBackground =='true' ? 'container confined' : '' ;

	$the_title_markup ='<div id="pageTitle" class="'.$class.'">';
	$the_title_markup .= '<div class="container"><h1>';
	
	if(is_archive()){

		if ( is_day() ) :
			$the_title_markup .= 'Daily Archives: <span>'.get_the_date() . '</span>';
		elseif ( is_month() ) :
			$the_title_markup .= 'Monthly Archives: <span>' . get_the_date( 'F Y' ) . '</span>';
		elseif ( is_year() ) :
			$the_title_markup .= 'Yearly Archives: <span>' . get_the_date( 'Y' ) . '</span>';
		else :
			if(is_category()){
				ob_start();
					single_cat_title();
					$buffered_cat = ob_get_contents();
				ob_end_clean();

				$the_title_markup .= 'Posts in category: '.$buffered_cat;
			}
		endif;		
	}else{
		$the_title_markup .= get_the_title();
	}

	$the_title_markup .=  '</h1></div></div>';

	return $the_title_markup;
}

/* ----------------------------- the sidebar ----------------------------- */
function kjd_get_sidebar($sidebar, $location = null, $width = null)
{
$location_class = ($location == 'horizontal') ? 'span12' : 'span3' ;

	$sidebar = set_sidebar_area($sidebar);

	ob_start();
		dynamic_sidebar($sidebar);
		$the_buffered_sidebar = ob_get_contents();
	ob_end_clean();
	$the_sidebar_markup = '<div id="sideContent" class="'.$location_class.' '.$location.'-widgets '.deviceViewSettings($layoutSettings['deviceView']).'">';
		$the_sidebar_markup .= ($location == 'horizontal') ? '<div class="row">' : '' ;
			$the_sidebar_markup .= $the_buffered_sidebar;
		$the_sidebar_markup .= ($location == 'horizontal') ? '</div>' : '' ;
	$the_sidebar_markup .= '</div>';


	// return $the_buffered_sidebar;
	return $the_sidebar_markup;
}



function set_sidebar_area($sidebar = null){

	$options = get_option('kjd_widget_areas_settings');
	$available_sidebars = array(
		'kjd_template_1', 'kjd_template_2', 'kjd_template_3', 'kjd_template_4', 'kjd_template_5', 'kjd_template_6',
		'front_page_widget_area_1', 'front_page_widget_area_2', 'header_widgets', 'footer_widgets','default'
	);
	foreach($options['widget_areas'] as $k => $v){
		$available_sidebars[] = $k; 
	}
	// print_r($available_sidebars);

	if(!in_array($sidebar, $available_sidebars)){
		$sidebar = 'default';
	}

	return $sidebar;
}

/* ----------------------------------- single image nav links for gallery images ------------------------------------ */
function kjd_gallery_image_links(){

	global $post;

	$navigation_markup = '<div class="image-pagination">';
	$parent_id = $post->post_parent;
	if (strpos(get_post($parent_id)->post_content,'[gallery') === false){
		$navigation_markup .= 'no gallery';
	}else{

		$images = get_post_images($parent_id);
		foreach($images as $k=>$image)
		{
			
			// print_r($image);
			// echo "<br />";
			if($image['image_id'] == $post->ID){
				// $next_url = '<a href="'.get_attachment_link( $id ).'"><img src="'.$url[0].'" /></a>';
				$prev =  $images[$k-1]['image_id'];
				if(isset($prev)){
					$navigation_markup .= '<a class="image-nav prev" href="'.get_attachment_link($prev).'">Previous Image</a>';
				}

				$next =  $images[$k+1]['image_id'];
				if(isset($next)){
					$navigation_markup .= '<a class="image-nav next" href="'.get_attachment_link($next).'">Next Image</a>';
				}
			}
		}
	}

	$navigation_markup .= '</div>';
	return $navigation_markup;
}

/* ------------------------ the 404 ------------------------ */

function kjd_the_404(){

	$page404 = get_option('kjd_theme_settings');
	$page404 = do_shortcode($page404['kjd_404_page']);
	return $page404;
}

function kjd_get_featured_image($position = null){

	$featured_image_markup = '';
	if ( has_post_thumbnail() ) {
		
		$featured_image_markup .='<div class="featured-image">';
		$featured_image_markup .= get_the_post_thumbnail();
		$featured_image_markup .='</div>';
	} 


	return $featured_image_markup;
}