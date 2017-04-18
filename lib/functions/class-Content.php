<?php

class Content {
    /**
    * The content wrapper
    */
    public static $template;
    public static $site_settings;

    public function __construct(){
        self::$site_settings = get_option('bswp_site_settings');
        $misc_settings = self::$site_settings['misc'];

        $is_body_confined = self::is_body_contained($misc_settings['layout']['full_width']);
    }

    public function __toString() {
        return self::kjd_the_content_wrapper();
    }


    public static function set_template($template){
        self::$template = $template;
    }

    public static function is_body_contained() {
        $layout = self::$site_settings['misc']['layout'];
        $full_width = ($layout['full_width'] == 'no') ? true : false;

        return $full_width;
    }


    public static function contain_section() {
        $contained = self::is_body_contained();
        return $contained ? '' : 'container';
    }

    public static function kjd_the_content_wrapper(){

        $output = '';

        // this will wrap the content in a well if need be
        $output .= '<div class="the-content-wrapper '.$content_well.' '. $media_class .'">';

        if( is_attachment() ){

            $output .= self::kjd_attachment_layout($post_options);

        }elseif( is_page() || is_single () ){

            $output .= self::kjd_single_page_layout($post_options);

        }else{

            $output .= self::kjd_posts_layout($post_options);

        }

        // closes the content-wrapper
        $output .= '</div>';

        return $output;
    }

    public static function kjd_attachment_layout($post_options){



        $attachment_layout = !empty($attachment_options['kjd_attachment_layout']) ? $attachment_options['kjd_attachment_layout'] : 'do_not_display'  ;
        $output = '';

        $output .= '<div class="the-content-inner attachment-'. $attachment_layout .'">';

        if($attachment_info == 'yes'){
            $output .= self::kjd_get_the_post_info();
        }

        if( $attachment_layout == 'text-above' || $attachment_layout == 'text-left' ){
            if( get_the_content()  ){
                $output .= '<p class="attachment-description">'.get_the_content().'</p>';
            }
        }

        // the content
        $output .= self::kjd_get_the_content();
        //the content

        if($attachment_layout == 'text-below' || $attachment_layout == 'text-right'){
            if( get_the_content()  ){
                $output .= '<p class="attachment-description">'.get_the_content().'</p>';
            }
        }


        $output .= self::kjd_get_the_post_meta();


        // closes content inner
        $output .= '</div>';

        return 	$output;
    }


    /**
    * Builds the layout for the single posts or a single page
    * @return [type] [description]
    */
    public static function kjd_single_page_layout() {

        $output = '';

        $output .= '<div class="the-content-inner">';

            // if this is a post, show the post info
            if(!is_page())
                $output .= self::kjd_get_the_post_info();

            // the content
            $output .= self::kjd_get_the_content();

            // if this is a post, show the post meta
            if(!is_page())
                $output .= self::kjd_get_the_post_meta();

        // closes content inner
        $output .= '</div>';

        return $output;
    }



    /**
    * This just grabs the post/page/attachment content.
    *
    * As in, the shit from the wp editor or the attached image
    */

    public static function kjd_get_the_content($post_display = null)
    {

        $output = '';

        $output .= '<div class="the-content">';
        if(!is_single() && !is_page()){
            $title = get_the_title();
        }


        if(is_attachment()){

            if ( wp_attachment_is_image( $post->id ) ){
                $att_image = wp_get_attachment_image_src( $post->id, "full");

                $output .= '<div class="attachment">';
                    $output .= '<a href="'.wp_get_attachment_url($post->id).'" title="'.get_the_title().'" rel="attachment">';
                        $output .= '<img src="'.$att_image[0].'" class="attachment-medium" alt="'.$post->post_excerpt.'" />';
                    $output .= '</a>';
                $output .= '</div>';
            }

        }elseif( is_404() ){

            $output = kjd_the_404();

        }elseif(is_single() || is_page()){

            ob_start();
            the_content();
            wp_link_pages();
            $buffered_content = ob_get_contents();
            ob_end_clean();

            $output .= $buffered_content;
            if($allow_comments == 'true' && is_single() ){
                $output .= kjd_comment_form();
            }


        }else{
            ob_start();
            if(!get_option('rss_use_excerpt', true)){
                the_content();
            }else{
                the_excerpt();
            }
            $buffered_content = ob_get_contents();
            ob_end_clean();

            $output .= $buffered_content;
        }

        $output .= '<div style="clear:both;"></div>';
        $output .= '</div>';

        return $output;
    }



    /**
    * This builds the post wrapper/layout for the FEED views
    * It does things like positions the featured image, and also styles the post in a bootstrap "well" if need be
    * @param  [type] $post_options [description]
    * @return [type]               [description]
    */
    public static function kjd_posts_layout($post_options = array()) {

        $post_display = $post_options['post_listing_type'];
        $show_thumbnail = $post_options['show_featured_image'];
        $featured_image = $post_options['featured_position'];

        $show_thumbnail = ( $show_thumbnail== 'true' && $post_display == 'excerpt' ) ? 'true' : 'false' ;
        $media_body_right = $featured_image == 'right_of_post' ? 'media-body-right' : '' ;

        $output = '';
        // puts featured image before content wrapper
        if( in_array($featured_image, array('atop_post','left_of_post') ) && $show_thumbnail == 'true'){

            $output .= self::kjd_get_featured_image($featured_image);

        }
        //

        $output .= '<div class="the-content-inner media-body '.$media_body_right.' ">';

        $output .= '<h3 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';

        // featured image before info
        if($featured_image == 'before_post_info' && $show_thumbnail == 'true' && !is_attachment()){
            $output .= self::kjd_get_featured_image();
        }

        $output .= self::kjd_get_the_post_info();


        // featured image before content
        if($featured_image == 'before_content' && $show_thumbnail == 'true' && !is_attachment()){
            $output .= self::kjd_get_featured_image();
        }

        // the content
        $output .= self::kjd_get_the_content($post_display);
        //the content

        // featured image before meta
        if($featured_image == 'before_post_meta' && $show_thumbnail == 'true' && !is_attachment()){
            $output .= self::kjd_get_featured_image();
        }
        //

        $output .= self::kjd_get_the_post_meta();


        // closes content inner
        $output .= '</div>';

        // featured image after post or right of post
        if(in_array($featured_image, array('after_post','right_of_post')) && $show_thumbnail == 'true'){
            $output .= self::kjd_get_featured_image($featured_image);
        }

        return $output;
    }


    /**
    * Gets the post meta
    * The post metat constists of things like the category, number of comments, and tags
    * Right now it only shows the cat
    */
    public static function kjd_get_the_post_meta(){
        ob_start();
        the_category();
        $buffered_categories = ob_get_contents();
        ob_end_clean();
        $output = '';
        $output .= '<div class="post-meta">';
        if(!is_page() && !is_attachment()){
            $output .= '<span class="cat-label">Categorized: </span>'.$buffered_categories;
            $output .= '<div style="clear:both;"></div>';
        }elseif( is_attachment() ){
            $output .= self::kjd_gallery_image_links();
        }

        $output .= '</div>';

        return $output;
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
    public static function kjd_get_featured_image($position = null, $wrapper = 'div'){

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


    /**
    * Get the post info for the post
    * The post info consists of things like
    * the date and the author
    */
    public static function kjd_get_the_post_info()
    {
        ob_start();
        the_author_posts_link();
        $buffered_content = ob_get_contents();
        ob_end_clean();

        $output = '';
        $output .= '<div class="post-info">';
            $output .= '<span class="post-date">';
                $output .= 'Posted on: <a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date('F j').'</a>, <a href="'.get_year_link(get_the_time('Y')).'">'.get_the_date('Y').'</a> - ';
            $output .= '</span>';
        $output .='<span class="post-author">';
            $output .='By: <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('nickname').'</a>';
        $output .= '</span></div>';

        return $output;
    }

}
