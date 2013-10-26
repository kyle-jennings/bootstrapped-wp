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
	$use_breadcrumbs = $pageTitleSettings['use_breadcrumbs'];

	$class = $confineTitleBackground =='true' ? 'container confined' : '' ;

	$the_title_markup ='<div id="pageTitle" class="'.$class.'">';
	$the_title_markup .= '<div class="container">';
	
	if( $use_breadcrumbs == 'true' ){
		$the_title_markup .= '<h3>';
			$the_title_markup .= kjd_build_breadcrumbs();
		$the_title_markup .= '</h3>';
	}else{
	
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
	
	}
		

	$the_title_markup .=  '</div></div>';

	return $the_title_markup;
}

function kjd_build_breadcrumbs() {

	/* === OPTIONS === */
	$text['home']     = 'Home'; // text for the 'Home' link
	$text['category'] = 'Archive by Category "%s"'; // text for a category page
	$text['search']   = 'Search Results for "%s" Query'; // text for a search results page
	$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
	$text['author']   = 'Posted by %s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = '<span class="divider"> &#47; </span>'; // delimiter between crumbs
	$before         = '<li class="current">'; // tag before the current crumb
	$after          = '</li>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<li>';
	$link_after   = '</li>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	$breadcrumbs_output = '';

	if (is_home() || is_front_page()) {

		return;

	} else {

		$breadcrumbs_output .= '<ul class="breadcrumb">';
		
		if ($show_home_link == 1) {
			$breadcrumbs_output .=  sprintf($link, $home_link, $text['home']);
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) 
				$breadcrumbs_output .=  $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				$breadcrumbs_output .= $cats;
			}
			if ($show_current == 1) $breadcrumbs_output .= $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			$breadcrumbs_output .= $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			$breadcrumbs_output .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			$breadcrumbs_output .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			$breadcrumbs_output .= $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			$breadcrumbs_output .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			$breadcrumbs_output .= $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			$breadcrumbs_output .= $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) $breadcrumbs_output .= $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				$breadcrumbs_output .= $cats;
				if ($show_current == 1) $breadcrumbs_output .= $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			$breadcrumbs_output .= $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>' . $link_after, $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			$breadcrumbs_output .= $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) $breadcrumbs_output .= $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) $breadcrumbs_output .= $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					$breadcrumbs_output .= $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) $breadcrumbs_output .= $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) $breadcrumbs_output .= $delimiter;
				$breadcrumbs_output .= $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			$breadcrumbs_output .= $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			$breadcrumbs_output .= $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			$breadcrumbs_output .= $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $breadcrumbs_output .= ' (';
			$breadcrumbs_output .= __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $breadcrumbs_output .= ')';
		}

		$breadcrumbs_output .= '</ul><!-- .breadcrumbs -->';

		return $breadcrumbs_output;
	}
} // end dimox_breadcrumbs()


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

	$attachment_options = get_option('kjd_attachment_page_layout_settings');
	$attachment_info = $attachment_options['kjd_attachment_info'];
	// $attachment_layout = $attachment_options['kjd_attachment_layout'];


	$attachment_layout = !empty($attachment_options['kjd_attachment_layout']) ? $attachment_options['kjd_attachment_layout'] : 'do_not_display'  ;
	$the_content_markup = '';

	$the_content_markup .= '<div class="the-content-inner attachment-'. $attachment_layout .'">';

		if($attachment_info == 'yes'){
			$the_content_markup .= kjd_get_the_post_info();
		}

		if($attachment_layout == 'text-above' || $attachment_layout == 'text-left' ){
			$the_content_markup .= '<p class="attachment-description">'.get_the_content().'</p>';
		}

		// the content
		$the_content_markup .= kjd_get_the_content();
		//the content	

		if($attachment_layout == 'text-below' || $attachment_layout == 'text-right'){
			$the_content_markup .= '<p class="attachment-description">'.get_the_content().'</p>';
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