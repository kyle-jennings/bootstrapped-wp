<?php

/**
 * This builds the entire page, including the header and footer
 */
class kjdScaffolding extends kjdLayout {

	public function __construct(){

		ob_start();
			get_header();
				echo $this->kjd_scaffolding_init();
			get_footer();

			$this->output = ob_get_contents();
		ob_end_clean();

		echo $this->output;
	}

}


/**
 * This is the layout class. It builds the main content shit
 */
class kjdLayout {
	
	public $output = '';

	public function __toString(){
		$this->output = $this->kjd_scaffolding_init();
		return $this->output;
	}

	public function kjd_scaffolding_init(){

		$layoutSettings = $this->kjd_get_layout_settings();

		$template = $layoutSettings['name'];
		
		$bodySettings = get_option('kjd_body_misc_settings');
		$bodySettings = $bodySettings['kjd_body_misc'];	
		$confineBodyBackground = $bodySettings['kjd_body_confine_background'];
		$confineClass = ($confineBodyBackground =='true' )? 'container confined' : '' ;
		$device_view = $layoutSettings['deviceView'];
		$position = $layoutSettings['position'];

		$pagination_top = get_option('kjd_posts_misc_settings');
		$pagination_top = $pagination_top['pagination_top'];


		$scaffolding_markup = '';



		if($position =='left' || $position =='right' ){
			$widthClass = 'span9';
		}else{
			$widthClass = 'span12';
		}

		// get the title	
		$scaffolding_markup .= $this->kjd_get_the_title();

		//start scaffolding
		$scaffolding_markup .= '<div id="body" class="'.$confineClass.'">';
			$scaffolding_markup .= '<div class="container">';
				$scaffolding_markup .= '<div class="row">';



					/* ----------------- top or left sidebar ------------------- */
					 if($position =='top' || $position =='left'){ 
			
						$scaffolding_markup .= ($position =='top') ? 
						 $this->kjd_get_sidebar($template,'horizontal',$position, $device_view) :
						 $this->kjd_get_sidebar($template,null,$position, $device_view);
					} 

					//content div
					$scaffolding_markup .= '<div id="main-content" class="'.$widthClass.'">';

					/* ---------------------- The Loop ----------------------- */
					if (have_posts()){

						if($pagination_top == 'true'){
							$scaffolding_markup .= $this->kjd_get_posts_pagination();
						}

						//open content-list/single wrapper
						if( !is_single() && !is_page() && !is_attachment() ){
							$scaffolding_markup .= '<div class="content-list">';
						}else{
							$scaffolding_markup .= '<div class="content-single">';
						}
						 while (have_posts()){ 

							the_post(); 
							$scaffolding_markup .= $this->kjd_the_content_wrapper();

						}

					 	//close content-list/single wrapper
						$scaffolding_markup .= '</div>';

						// pagination
						$scaffolding_markup .= $this->kjd_get_posts_pagination();

					}else{
							$scaffolding_markup .= '<div class="content-wrapper">';
									$scaffolding_markup .= $this->kjd_the_404();
							$scaffolding_markup .= '</div>';	
					}
					/* ---------------------- End Loop ----------------------- */

					//end main content
					$scaffolding_markup .= '</div>'; // end maincontent span

		/* ----------------- right or bottom sidebar ------------------- */
			if($position =='bottom' || $position =='right'){ 
				$scaffolding_markup .= ($position =='bottom') ? 
				$this->kjd_get_sidebar($template,'horizontal',$position, $device_view) : 
				$this->kjd_get_sidebar($template,null,$position, $device_view);
			} 


		// close scaffolding

				$scaffolding_markup .= '</div>';//	<!-- end row -->
			$scaffolding_markup .= '</div>';// <!-- end container -->
		$scaffolding_markup .= '</div>'; //<!-- end body -->

		
		return $scaffolding_markup;

	}


	/**
	 * This detects the current page's/post's /feed's template and gets teh layout settings appropriately
	 * Layout settings for now, are nothing more than the position of the sidebar, as well as sidebar visibility.
	 * 
	 * @param  [type] $template [description]
	 * @return [type]           [description]
	 */
	public function kjd_get_layout_settings() {

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

	/**
	 * The content wrapper
	 */

	public function kjd_the_content_wrapper(){

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

			$the_content_markup .= $this->kjd_attachment_layout($post_options);

		}elseif( is_page() || is_single () ){

			$the_content_markup .= $this->kjd_single_page_layout($post_options);
		
		}else{

			$the_content_markup .= $this->kjd_posts_layout($post_options);

		}

		// closes the content-wrapper
		$the_content_markup .= '</div>';

		return $the_content_markup;
	}

	/**
	 * The comment form
	 * @return [type] [description]
	 */
	public function kjd_comment_form() {

	 	global $current_user;

		$fields =  array(

		  'author' =>
		    '<div class="control-group"><label class="control-label" for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '<div class="controls"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		    '" size="30"' . $aria_req . ' /></div></div>',

		  'email' =>
		    '<div class="control-group"><label class="control-label" for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '<div class="controls"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '" size="30"' . $aria_req . ' /></div></div>',

		  'url' =>
		    '<div class="control-group"><label class="control-label" for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
		    '<div class="controls"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		    '" size="30" /></div></div>',
		);

		$args = array(
		  'id_form'           => 'commentform',
		  'id_submit'         => 'submit',
		  'title_reply'       => __( 'Leave a Reply' ),
		  'title_reply_to'    => __( 'Leave a Reply to %s' ),
		  'cancel_reply_link' => __( 'Cancel Reply' ),
		  'label_submit'      => __( 'Post Comment' ),

		  'comment_field' =>  '<div class="control-group"><label class="control-label" for="comment">' . _x( 'Comment', 'noun' ) .
		    '</label><div class="controls"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
		    '</textarea></div></div>',

		  'must_log_in' => '<p class="must-log-in">' .
		    sprintf(
		      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
		      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		    ) . '</p>',

		  'logged_in_as' => '<p class="logged-in-as">' .
		    sprintf(
		    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
		      admin_url( 'profile.php' ),
		      $current_user->user_login,
		      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		    ) . '</p>',

		  'comment_notes_before' => '',

		  'comment_notes_after' => '',

		  'fields' => apply_filters( 'comment_form_default_fields', $fields  ),
		);




		
		ob_start();
			comment_form($args);
			$buffered_comments = ob_get_contents();
		ob_end_clean();

		return $buffered_comments;
	}

	/**
	 * This just grabs the post/page/attachment content.
	 *
	 * As in, the shit from the wp editor or the attached image
	 */
		
	public function kjd_get_the_content($post_display = null)
	{
		$allow_comments = get_option('kjd_pageTitle_misc_settings');
		$allow_comments = $allow_comments['kjd_pageTitle_misc'];

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

		}elseif( is_404() ){

			$the_content_markup = $this->kjd_the_404();

		}elseif(is_single() || is_page()){
			
			ob_start();
				the_content();
				wp_link_pages();
				$buffered_content = ob_get_contents();
			ob_end_clean();

			$the_content_markup .= $buffered_content;
			if($allow_comments == 'true' && is_single() ){
				$the_content_markup .= kjd_comment_form();
			}
		
		
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


	/**
	 * Get the post info for the post
	 * The post info consists of things like
	 * the date and the author
	 */
	public function kjd_get_the_post_info()
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

	/**
	 * Gets the post meta
	 * The post metat constists of things like the category, number of comments, and tags
	 * Right now it only shows the cat
	 */
	public function kjd_get_the_post_meta(){
		ob_start();
			the_category();
			$buffered_categories = ob_get_contents();
		ob_end_clean();
		$the_post_meta_markup = '<div class="post-meta">';
		if(!is_page() && !is_attachment()){
			$the_post_meta_markup .= '<span class="cat-label">Categorized: </span>'.$buffered_categories;
			$the_post_meta_markup .= '<div style="clear:both;"></div>';
		}elseif( is_attachment() ){
	   		$the_post_meta_markup .= $this->kjd_gallery_image_links();
		}

		$the_post_meta_markup .= '</div>';

		return $the_post_meta_markup;
	}



	/**
	 * Displays teh post of page title
	 * @param  [type] $content_type [description]
	 * @return [type]               [description]
	 */
	public function kjd_get_the_title($content_type = null)
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

	public function kjd_build_breadcrumbs() {

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

	/**
	 * builds and gets the sidebar, must call kjd_set_sidebar_area to get the correct widgts 
	 * @param  string $sidebar     [description]
	 * @param  [type] $location    [description]
	 * @param  [type] $width       [description]
	 * @param  [type] $device_view [description]
	 * @return [type]              [description]
	 */
	public function kjd_get_sidebar($sidebar = 'default', $location = null, $width = null, $device_view = null)
	{

		$location_class = ($location == 'horizontal') ? 'span12' : 'span3' ;

		$sidebar = $this->kjd_set_sidebar_area($sidebar);
		ob_start();
			dynamic_sidebar($sidebar);
			$the_buffered_sidebar = ob_get_contents();
		ob_end_clean();
		$the_sidebar_markup = '<div id="side-content" class="'.$location_class.' '.$location.'-widgets '.$device_view.'">';
				$the_sidebar_markup .= '<div class="row">' . $the_buffered_sidebar .'</div>';
		$the_sidebar_markup .= '</div>';


		// return $the_buffered_sidebar;
		return $the_sidebar_markup;
	}


	public function kjd_set_sidebar_area($sidebar = null){

		// echo $sidebar; die();
		$post_templates = get_option('kjd_post_layout_settings');
		$post_templates = $post_templates['kjd_post_layouts'];

		$available_sidebars = array(
			'template_1', 'template_2', 'template_3', 'template_4', 'template_5', 'template_6',
			'front_page_widget_area_1', 'front_page_widget_area_2', 'header_widgets', 'footer_widgets','default'
		);
		if( !empty($post_templates) ){
			foreach($post_templates as $k => $v){
				$available_sidebars[] = $k; 
			}
		}
		

		if(!in_array($sidebar, $available_sidebars)){
			$sidebar = 'default';
		}


		return $sidebar;
	}


	/**
	 * This builds the post wrapper/layout for the FEED views
	 * It does things like positions the featured image, and also styles the post in a bootstrap "well" if need be
	 * @param  [type] $post_options [description]
	 * @return [type]               [description]
	 */
	public function kjd_posts_layout($post_options) {

		$post_display = $post_options['post_listing_type'];
		$show_thumbnail = $post_options['show_featured_image'];
		$featured_image = $post_options['featured_position'];

		$show_thumbnail = ( $show_thumbnail== 'true' && $post_display == 'excerpt' ) ? 'true' : 'false' ;
		$media_body_right = $featured_image == 'right_of_post' ? 'media-body-right' : '' ;

			// puts featured image before content wrapper
			if( in_array($featured_image, array('atop_post','left_of_post') ) && $show_thumbnail == 'true'){
				
				$the_content_markup .= $this->kjd_get_featured_image($featured_image);

			}
			//

			$the_content_markup .= '<div class="the-content-inner media-body '.$media_body_right.' ">';

				$the_content_markup .= '<h3 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';

				// featured image before info
				if($featured_image == 'before_post_info' && $show_thumbnail == 'true' && !is_attachment()){
					$the_content_markup .= $this->kjd_get_featured_image();
				}

				$the_content_markup .= $this->kjd_get_the_post_info();


				// featured image before content
				if($featured_image == 'before_content' && $show_thumbnail == 'true' && !is_attachment()){
					$the_content_markup .= $this->kjd_get_featured_image();
				}

				// the content
				$the_content_markup .= $this->kjd_get_the_content($post_display);
				//the content

			// featured image before meta
			if($featured_image == 'before_post_meta' && $show_thumbnail == 'true' && !is_attachment()){
				$the_content_markup .= $this->kjd_get_featured_image();
			}
			//

			$the_content_markup .= $this->kjd_get_the_post_meta();


			// closes content inner
			$the_content_markup .= '</div>';

			// featured image after post or right of post
			if(in_array($featured_image, array('after_post','right_of_post')) && $show_thumbnail == 'true'){
				$the_content_markup .= $this->kjd_get_featured_image($featured_image);
			}
			
			return $the_content_markup;
	}

	/**
	 * Sets the layout for the attachment page
	 * layouts simply position the attachment desription around the attachment
	 * @param  [type] $post_options [description]
	 * @return [type]               [description]
	 */
	public function kjd_attachment_layout($post_options){

		$attachment_options = get_option('kjd_attachment_page_layout_settings');
		$attachment_info = $attachment_options['kjd_attachment_info'];
		// $attachment_layout = $attachment_options['kjd_attachment_layout'];


		$attachment_layout = !empty($attachment_options['kjd_attachment_layout']) ? $attachment_options['kjd_attachment_layout'] : 'do_not_display'  ;
		$the_content_markup = '';

		$the_content_markup .= '<div class="the-content-inner attachment-'. $attachment_layout .'">';

			if($attachment_info == 'yes'){
				$the_content_markup .= $this->kjd_get_the_post_info();
			}

			if( $attachment_layout == 'text-above' || $attachment_layout == 'text-left' ){
				if( get_the_content()  ){
					$the_content_markup .= '<p class="attachment-description">'.get_the_content().'</p>';	
				}
			}

			// the content
			$the_content_markup .= $this->kjd_get_the_content();
			//the content	

			if($attachment_layout == 'text-below' || $attachment_layout == 'text-right'){
				if( get_the_content()  ){
					$the_content_markup .= '<p class="attachment-description">'.get_the_content().'</p>';	
				}
			}
		

			$the_content_markup .= $this->kjd_get_the_post_meta();


		// closes content inner
		$the_content_markup .= '</div>';

		return 	$the_content_markup;
	}

	/**
	 * Builds the layout for the single posts or a single page
	 * @return [type] [description]
	 */
	public function kjd_single_page_layout() {

		$the_content_markup = '';

		$the_content_markup .= '<div class="the-content-inner">';

			if( !is_page() ){

				$the_content_markup .= $this->kjd_get_the_post_info();
			}

			// the content
			$the_content_markup .= $this->kjd_get_the_content();
			//the content

			if( !is_page() ){

				$the_content_markup .= $this->kjd_get_the_post_meta();
			}

		// closes content inner
		$the_content_markup .= '</div>';

		return $the_content_markup;
	}		

	/* --------------------------------------------
	 pagination  
	 ------------------------------------------- */
	public function kjd_get_posts_pagination(){
		
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



	/* ----------------------------------------------------
			gallery images pagination
	 ----------------------------------------------------- */
	public function kjd_gallery_image_links(){

		global $post;

		$navigation_markup = '<div class="image-pagination cf">';
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
 
	/* -----------------------------------------------
	 set featured image size 
	 ------------------------------------------------- */
	public function kjd_get_featured_image($position = null, $wrapper = 'div'){
		
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

}