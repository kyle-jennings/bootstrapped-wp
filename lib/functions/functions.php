<?php 


// gets options function
if(is_admin()){
	include(dirname(dirname(__FILE__)).'/admin/init.php' );
	include(dirname(dirname(__FILE__)).'/update/update.php');

}

 require_once('kjd_bootstrap_menus.php');
 require_once('kjdGallery.php');
 require_once('kjdShortcodes.php');
 require_once('kjdWidgets.php');
 require_once('kjd_adminbar_menu.php');

 require_once('kjd_layout_functions.php');


/* ----------------------- kjd add js and css --------------------- */
function kjd_add_assets(){

	// set variables
	$mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
	$mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];
	
	$override_nav = $mobileNavSettings['override_nav'];
	if( $override_nav == 'true') {
		$mobilenav_style = $mobileNavSettings['mobilenav_style'];
	}


	$generalSettings = get_option('kjd_theme_settings');
	$responsive = $generalSettings['kjd_responsive_design'];

	//set tempplate root
	$root=get_bloginfo('template_directory'); 
	$root = $root.'/lib';

	wp_enqueue_script("jquery", $root."/scripts/jquery.js", false, "1.0", false);  
	wp_enqueue_script("bootstrap", $root."/scripts/bootstrap.min.js", false, "1.0", true);  

	if( $mobilenav_style == 'sidr' ){
		wp_enqueue_script("sidr", $root."/scripts/sidr.min.js", false, "1.0", true);  
		wp_enqueue_style("sidr", $root."/styles/sidr.css");
	}

	
	wp_enqueue_script("script", $root."/scripts/application.js", false, "1.0", true);  

	wp_enqueue_style("bootstrap", $root."/styles/bootstrap/bootstrap.min.css");

	if($responsive == 'true'){
		wp_enqueue_style("bootstrap-responsive", $root."/styles/bootstrap/bootstrap-responsive.min.css");
	}

	wp_enqueue_style("custom", $root."/styles/custom.css");
	wp_enqueue_style("scaffolding", $root."/styles/common.css");	

	// Add slider scripts if on front page
	if( is_front_page() ){
		 include( 'add_slider_scripts.php');
	}

}
add_action( 'wp_enqueue_scripts', 'kjd_add_assets' );


/* ------------------------------------- get page template layout settings ************************* */
function kjd_get_layout_settings($template = NULL) {

			//	if the page is a post type

			$layoutOptions = get_option('kjd_post_layout_settings');
			$layoutSettings = $layoutOptions['kjd_post_layouts'];
			
			if( is_single() ){
			
				$template = 'single';

			}elseif( is_attachment() ){

				$template = 'attachment';

			}elseif( is_404() ){
			
				$template = '404';
			
			}elseif( is_category() ){
			
				$template = 'category';

			}elseif( is_archive() ){
			
				$template = 'archive';
			
			}elseif( is_tag() ){

				$template = 'tag';

			}elseif( is_author() ){

				$template = 'author';

			}elseif( is_date() ){

				$template = 'date';

			}elseif( is_search() ){

				$template = 'search';

			}elseif( is_front_page() ){

				$template = 'front_page';

			}elseif( is_page() ){


				// if current page is page template
				if( is_page_template() ){
					
					$options = get_option('kjd_page_layout_settings');
					$layoutSettings = $options['kjd_page_layouts'];
				$is_page_template = true;
					
						if ( is_page_template('pageTemplate1.php') ){

							$template = 'template_1';
						
						}elseif( is_page_template('pageTemplate2.php') ){

							$template = 'template_2';
						
						}elseif( is_page_template('pageTemplate3.php') ){

							$template = 'template_3';
						
						}elseif( is_page_template('pageTemplate4.php') ){

							$template = 'template_4';
						
						}elseif( is_page_template('pageTemplate5.php') ){

							$template = 'template_5';
						
						}elseif( is_page_template('pageTemplate6.php') ){

							$template = 'template_6';
						
						}else{
							
							$template = 'page';							
						}
		

				// if current page is a page but not a template
				}else{
					$template = 'page';
				
				}

			//fallback - if not a post template OR a page
			}else{

				$template = 'default';
			}
			
	if( !empty($layoutSettings[$template]) && ($layoutSettings[$template]['toggled'] == 'true' || $is_page_template == true) ){
		
		$layoutSettings = $layoutSettings[$template];

	}else{

		$layoutSettings = $layoutSettings['default'];
	}


	// echo $template; die();
	return $layoutSettings;
}


/* ----------------------- Set featured image and User Image Sizes --------------------- */
function kjd_set_featured_image_size(){
// kjd_component_settings[featured_image][height]
	$image_size_settings = get_option('kjd_component_settings');
	$featured_size = $image_size_settings['featured_image'];
	$w = $featured_size['width'] ? $featured_size['width'] : 300 ;
	$h = $featured_size['height'] ? $featured_size['height'] : 300 ;
	$c = $featured_size['crop'] ? $featured_size['crop'] : false ;
	if( function_exists ('add_theme_support') ){
		add_theme_support('post_tumbnails');
		add_image_size(
			'featured-image', $w, $h, true
		);
	}
}
add_action( 'init', 'kjd_set_featured_image_size' );

 


//gets featured image meta info
function kjd_the_post_thumbnail_description($args) {
  $thumbnail_id    = get_post_thumbnail_id($args->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_content.'</span>';
  }
}


// add excerpts to pages
function kjd_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'kjd_add_excerpts_to_pages' );


//////////////////
// get images
//////////////////

// old image grabber
function kjd_get_post_images($postID, $size = NULL) {

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

function kjd_deviceViewSettings($deviceView){
		if(isset($deviceView) && $deviceView !="all"){
			echo $deviceView;
		}
}

////////////////////////
// login screen styling


function kjd_login_css() {
	require_once(dirname(dirname(__FILE__)).'/styles/login.php');
}
add_action('login_head', 'kjd_login_css');




/* --------------------------- read more link --------------------------*/
function kjd_excerpt_more_link($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read More</a>';
}
add_filter('excerpt_more', 'kjd_excerpt_more_link');


/* -------------------------------- pagination  ------------------------------- */
function kjd_get_posts_pagination(){
	
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
		      'next_text' => 'Next',
		      'mid_size' => 1,
		      'end_size' => 1
		    ));  
		  $pagination_markup .= '</div>';
	  $pagination_markup .= '</div>';  
	    
	}  
	return $pagination_markup;
}



/* ----------------------------------- single image nav links for gallery images ------------------------------------ */
function kjd_gallery_image_links(){

	global $post;

	$navigation_markup = '<div class="image-pagination">';
	$parent_id = $post->post_parent;

	if ( strpos(get_post($parent_id)->post_content,'[gallery ') === false ){
		// $navigation_markup .= 'no gallery';
	}else{

		$images = kjd_get_post_images($parent_id);
		foreach($images as $k=>$image)
		{
			

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
 
/* ---------------------------- set featured image size ------------------------------ */
function kjd_get_featured_image($position = null, $wrapper = 'div'){
	
	if($position == 'left_of_post'){
	
		$wrapper = 'span';
	
		$wrapper_class = 'pull-left';
	
	}elseif($position == 'right_of_post'){
	
		$wrapper = 'span';
	
		$wrapper_class = 'pull-right';
	
	}else{

		$wrapper = 'div';
	
	}

	$featured_image_markup = '';

	if ( has_post_thumbnail() ) {
		$featured_image_markup .= '<'.$wrapper.' class="media-object '.$wrapper_class.'">';
		$featured_image_markup .= get_the_post_thumbnail(null, 'featured-image', array(
			'alt'	=> trim(strip_tags( $attachment->post_excerpt )),
			'title'	=> trim(strip_tags( $attachment->post_title )),
			)
		);
		$featured_image_markup .= '</'.$wrapper.'>';
	} 


	return $featured_image_markup;
}



/* --------------------------------------------------
 Navbar functions 
 --------------------------------------------------------*/
function kjd_empty_nav_fallback_callback( $args ) {
	if ( ! isset( $args['show_home'] ) )
					 
		$args['show_home'] = true;

	return $args;
}


function kjd_build_navbar( $menu_id, $navbar_type, $style, $position, $mobilenav_style, $misc = null ){

switch( $style ){
			// navbar in default position
			case 'full_width':
				$navbar_style .= 'navbar navbar-static-top';
				break ;

			// navbar in default position, but is not full width
			case 'contained':
				$navbar_style .= 'container';
				$nav_wrapper ='<div class="navbar">';
				break ;

			// we want to STICK the navbar to the top of the page - it will scroll WITH the page
			case 'sticky-top':
				$navbar_style .= 'navbar navbar-fixed-top';
				break ;
			// we want to STICK the navbar to the bottom of the page - it will scroll WITH the page
			case 'sticky-bottom':
				$navbar_style .= 'navbar navbar-fixed-bottom';
				break ;
			// navbar is just placed at the top of the page
			case 'page-top':
				$navbar_style .= 'navbar navbar-static-top';
				break ;
		
			default:
				$navbar_style .= 'navbar navbar-static-top';
		}

		$navbar_open = '<div id="navbar" class="'. $navbar_style . '">';
		$navbar_open .= $nav_wrapper;

		$navbar_inner = '';
			$navbar_inner .= '<div class="navbar-inner">';

			if( $navbar_style != 'contained' ){
				$navbar_inner .= '<div class="container">';
			}
			
			if($mobilenav_style =='sidr'){
				$navbar_inner .= '<a id="sidr-toggle" class="btn btn-navbar">
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>';
			}else{
				$navbar_inner .= '<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>';
			}
				
					$navbar_inner .='<div class="nav-collapse collapse navbar-responsive-collapse">';
						ob_start();
						kjd_menu_style_callback($navbar_link_style, $menu_id);
						$navbar_contents = ob_get_contents();
						ob_end_clean();
					$navbar_inner .= $navbar_contents;
					$navbar_inner .= '</div>';
				
				if( $navbar_style != 'contained' ){
					$navbar_inner .='</div>'; // end container -->
				}

			$navbar_inner .='</div>'; // end navbar-inner-->



		if($navbarSettings['navbar_style'] =="contained"){
			$navbar_close = '</div></div>';
		}else{
			$navbar_close = '</div>';
		} 
	
		return $navbar_open . $navbar_inner . $navbar_close;
}

function kjd_menu_style_callback($navbar_link_style = 'none', $menu_id = 'primary-menu'){
	
	$menu_class = 'nav';
	
	switch($navbar_link_style){
		case 'none':

			$menu_class .= ' nav-noBG';
			break;
		case 'dividers':

			$menu_class .= ' nav-dividers';
			break;
		case 'pills':

			$menu_class .= ' nav-pills';
			break;
		case 'tabs':

			$menu_class .= ' nav-tabs';
			break;
		case 'tabs-below':

			$menu_class .= ' nav-tabs tabs-below';	
			break;
		default:
			$menu_class .= ' nav-pills';
	}


	

	if ( has_nav_menu( 'primary-menu' ) ){
			wp_nav_menu(array('theme_location' => 'primary-menu', 
				'menu_class' =>$menu_class,
				'container'=> '',
				'walker'=> new dropDown()
			 ) );

	} else {
	    
	    echo '<ul class="nav nav-pills">';
		echo '<li><a href="'. home_url() .'/" title="home">Home</a></li>';
		if( is_user_logged_in() ){
			echo '<li><a href="'. home_url() .'/wp-admin/nav-menus.php" title="set menus" >Set Menu</a></li>';

		}else{

			echo '<li><a href="'. wp_login_url() .'/" title="login" >Login</a></li>';
		}
	    echo '</ul>';

	} 


}


/* --------------------------------------------------
 Site logo
 --------------------------------------------------------*/
function kjd_site_logo($header_contents, $logo_toggle, $logo, $custom_header){
	
	$heading = is_front_page() ? 'h1' : 'h2' ;

	if($headerSettings['header_contents'] == 'widgets'){ 

		dynamic_sidebar('header_widgets');
	
	}else{ 

		if($logo_toggle == 'text'){
		
			echo '<div class="header-wrapper">';
				echo $custom_header;
			echo '</div>';
		
		}elseif($logo_toggle == 'logo' ){
			
			echo '<'.$heading.' class="logo-wrapper">';
				echo '<a href="'.get_bloginfo('url').' ">';
					echo '<img src="'.$logo.'" alt=""/>';
				echo '</a>';
			echo '</'.$heading.'>';
		
		}else{
			
			echo '<div class="jumbotron no-background">';
			echo '<'.$heading.' class="logo-wrapper" >';
				echo '<a href="'.get_bloginfo('url').' ">';
					echo get_bloginfo( 'name');
				echo '</a>';
			echo '</'.$heading.'>';
				echo '<div class="logo-wrapper">'.get_bloginfo('description').'</div>';
			echo '</div>';

		}
		

	 }

}