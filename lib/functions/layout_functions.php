<?php


/* ------------------------------- the content ------------------------------ */

/*
	this is the content wrapper, it provides the markup layout for the post/page/attachment content
*/

function kjd_the_content_wrapper(){

	$post_options = get_option('kjd_posts_misc_settings');
	$post_options = $post_options['kjd_posts_misc'];
	$post_display = $post_options['post_listing_type'];
	$show_thumbnail = $post_options['show_featured_image'];
	$featured_image = $post_options['featured_position'];

	$media_class = ($show_thumbnail == 'true' && $post_display == 'excerpt' && !is_singular() ) ? 'media' : '' ;

	$content_well = $post_options['style_posts'] == "true" ? 'well' : '' ;



	$the_content_markup = '';

	// this will wrap the content in a well if need be
	$the_content_markup .= '<div class="the-content-wrapper '.$content_well.' '. $media_class .'">';
		
	if( is_attachment() ){

		$the_content_markup .= kjd_attachment_layout($post_options);

	}elseif( is_page() || is_single () ){

		$the_content_markup .= kjd_single_page_layout($post_options);
	
	}else{

		$the_content_markup .= kjd_posts_layout($post_options);

	}

	// closes the content-wrapper
	$the_content_markup .= '</div>';

	return $the_content_markup;
}

/* ---------------------------- content and content list scaffolding functions ----------------------------- */
/*
	This just grabs the post/page/attachment content.
*/

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
	        		$the_content_markup .= '<img src="'.$att_image[0].'" class="attachment-medium" alt="'.$post->post_excerpt.'" />';
	        		$the_content_markup .= '</a>';
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
	ob_start();
		the_author_posts_link();
		$buffered_content = ob_get_contents();
	ob_end_clean();


	$the_post_info_markup =	'<div class="post-info">';
	$the_post_info_markup .='<span class="post-date">';
	$the_post_info_markup .= 'Posted on: <a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date('F j').'</a>, <a href="'.get_year_link(get_the_time('Y')).'">'.get_the_date('Y').'</a> - </span>';
	$the_post_info_markup .='<span class="post-author">';
	$the_post_info_markup .='By: <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('nickname').'</a>';
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
	}elseif( is_attachment() ){
   		$the_post_meta_markup .= kjd_gallery_image_links();
	}

	$the_post_meta_markup .= '</div>';

	return $the_post_meta_markup;
}



/* ---------------------------------- the post or page title ------------------------------------ */
function kjd_get_the_title($content_type = null)
{
	
	$pageTitleSettings = get_option('kjd_pageTitle_misc_settings');
	$pageTitleSettings = $pageTitleSettings['kjd_pageTitle_misc'];
	$confineTitleBackground = $pageTitleSettings['kjd_pageTitle_confine_background'];

	$class = $confineTitleBackground =='true' ? 'container confined' : '' ;

	$the_title_markup ='<div id="pageTitle" class="'.$class.'">';
	$the_title_markup .= '<div class="container">';
	$the_title_markup .= '<h1>';
	
	if( is_archive() ){
		

		if ( is_day() ) :
			$the_title_markup .= 'Daily Archives: <span>'.get_the_date() . '</span>';
		elseif ( is_month() ) :
			$the_title_markup .= 'Monthly Archives: <span>' . get_the_date( 'F Y' ) . '</span>';
		elseif ( is_year() ) :
			$the_title_markup .= 'Yearly Archives: <span>' . get_the_date( 'Y' ) . '</span>';
		elseif(get_query_var('author_name')) :
		    $auth = get_user_by('slug', get_query_var('author_name'));
			$the_title_markup .= 'Posts by: '.$auth->nickname;
		else :
			if(is_category()){
				ob_start();
					single_cat_title();
					$buffered_cat = ob_get_contents();
				ob_end_clean();

				$the_title_markup .= 'Posted in: '.$buffered_cat;
			}
		endif;		

	}elseif( is_search() ){
		
		global $wp_query;
		$total_results = $wp_query->found_posts;
		$the_title_markup .=  $total_results ? 'Posts containing: '.get_search_query() : 'No results found' ;
	

	}elseif( is_404() ){

		$the_title_markup .= 'Page Not Found';

	}else{

		$the_title = get_the_title();
		if( isset($the_title) && !empty($the_title) && !is_null($the_title) ){
		
			$the_title_markup .= $the_title;

		}else {
			$the_title_markup .= 'No Title';
		}
	}

	$the_title_markup .= '</h1>';
	$the_title_markup .=  '</div></div>';

	return $the_title_markup;
}

/* ----------------------------- the sidebar ----------------------------- */
function kjd_get_sidebar($sidebar, $location = null, $width = null, $device_view = null)
{


	$location_class = ($location == 'horizontal') ? 'span12' : 'span3' ;

	$sidebar = kjd_set_sidebar_area($sidebar);
	ob_start();
		dynamic_sidebar($sidebar);
		$the_buffered_sidebar = ob_get_contents();
	ob_end_clean();
	$the_sidebar_markup = '<div id="sideContent" class="'.$location_class.' '.$location.'-widgets '.$device_view.'">';
		$the_sidebar_markup .= ($location == 'horizontal') ? '<div class="row">' : '' ;
			$the_sidebar_markup .= $the_buffered_sidebar;
		$the_sidebar_markup .= ($location == 'horizontal') ? '</div>' : '' ;
	$the_sidebar_markup .= '</div>';


	// return $the_buffered_sidebar;
	return $the_sidebar_markup;
}



function kjd_set_sidebar_area($sidebar = null){

	$options = get_option('kjd_widget_areas_settings');
	$available_sidebars = array(
		'template_1', 'template_2', 'template_3', 'template_4', 'template_5', 'template_6',
		'front_page_widget_area_1', 'front_page_widget_area_2', 'header_widgets', 'footer_widgets','default'
	);
	if( !empty($options['widget_areas']) ){
		foreach($options['widget_areas'] as $k => $v){
			$available_sidebars[] = $k; 
		}
	}
	

	if(!in_array($sidebar, $available_sidebars)){
		$sidebar = 'default';
	}


	return $sidebar;
}



/* ---------------------------------- the post listing post layout ----------------------------------- */

function kjd_posts_layout($post_options) {

	$post_display = $post_options['post_listing_type'];
	$show_thumbnail = $post_options['show_featured_image'];
	$featured_image = $post_options['featured_position'];

	$show_thumbnail = ( $show_thumbnail== 'true' && $post_display == 'excerpt' ) ? 'true' : 'false' ;
	$media_body_right = $featured_image == 'right_of_post' ? 'media-body-right' : '' ;

		// puts featured image before content wrapper
		if( in_array($featured_image, array('atop_post','left_of_post') ) && $show_thumbnail == 'true'){
			
			$the_content_markup .= kjd_get_featured_image($featured_image);

		}
		//

		$the_content_markup .= '<div class="the-content-inner media-body '.$media_body_right.' ">';



			$the_content_markup .= '<h3 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';


			// featured image before info
			if($featured_image == 'before_post_info' && $show_thumbnail == 'true' && !is_attachment()){
				$the_content_markup .= kjd_get_featured_image();
			}
			//

			$the_content_markup .= kjd_get_the_post_info();


			// featured image before content
			if($featured_image == 'before_content' && $show_thumbnail == 'true' && !is_attachment()){
				$the_content_markup .= kjd_get_featured_image();
			}

			// the content
			$the_content_markup .= kjd_get_the_content($post_display);
			//the content

		// featured image before meta
		if($featured_image == 'before_post_meta' && $show_thumbnail == 'true' && !is_attachment()){
			$the_content_markup .= kjd_get_featured_image();
		}
		//

		$the_content_markup .= kjd_get_the_post_meta();


		// closes content inner
		$the_content_markup .= '</div>';

		// featured image after post or right of post
		if(in_array($featured_image, array('after_post','right_of_post')) && $show_thumbnail == 'true'){
			$the_content_markup .= kjd_get_featured_image($featured_image);
		}
		
		return $the_content_markup;
}

/* ---------------------------------- the attchment ------------------------------------ */

function kjd_attachment_layout($post_options){

	$decription_position = !empty($post_options['attachment_position']) ? $post_options['attachment_position'] : 'do_not_display'  ;
	$the_content_markup = '';

	$the_content_markup .= '<div class="the-content-inner">';

		$the_content_markup .= kjd_get_the_post_info();

		if($decription_position == 'over_image'){
			$the_content_markup .= '<p class="attachment-description '. $decription_position .'">'.get_the_content().'</p>';
		}

		// the content
		$the_content_markup .= kjd_get_the_content();
		//the content	

		if($decription_position == 'below_image'){
			$the_content_markup .= '<p class="attachment-description '. $decription_position .'">'.get_the_content().'</p>';
		}
	

		$the_content_markup .= kjd_get_the_post_meta();


	// closes content inner
	$the_content_markup .= '</div>';

	return 	$the_content_markup;
}

function kjd_single_page_layout() {

	$the_content_markup = '';

	$the_content_markup .= '<div class="the-content-inner">';

		if( !is_page() ){

			$the_content_markup .= kjd_get_the_post_info();
		}

		// the content
		$the_content_markup .= kjd_get_the_content();
		//the content

		if( !is_page() ){

			$the_content_markup .= kjd_get_the_post_meta();
		}

	// closes content inner
	$the_content_markup .= '</div>';

	return $the_content_markup;
}