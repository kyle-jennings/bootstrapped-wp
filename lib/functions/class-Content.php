<?php

class Content {
    /**
    * The content wrapper
    */
    public static $site_settings;

    public function __construct(){
        self::$site_settings = get_option('bswp_site_settings');
        $misc_settings = self::$site_settings['misc'];

        $is_body_confined = self::is_body_contained($misc_settings['layout']['full_width']);
    }

    public function __toString() {
        return self::kjd_the_content_wrapper();
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

            $the_content_markup .= self::kjd_attachment_layout($post_options);

        }elseif( is_page() || is_single () ){

            $the_content_markup .= self::kjd_single_page_layout($post_options);

        }else{

            $the_content_markup .= self::kjd_posts_layout($post_options);

        }

        // closes the content-wrapper
        $the_content_markup .= '</div>';

        return $the_content_markup;
    }

    public static function kjd_attachment_layout($post_options){

        $attachment_options = get_option('kjd_attachment_page_layout_settings');
        $attachment_info = $attachment_options['kjd_attachment_info'];
        // $attachment_layout = $attachment_options['kjd_attachment_layout'];


        $attachment_layout = !empty($attachment_options['kjd_attachment_layout']) ? $attachment_options['kjd_attachment_layout'] : 'do_not_display'  ;
        $the_content_markup = '';

        $the_content_markup .= '<div class="the-content-inner attachment-'. $attachment_layout .'">';

        if($attachment_info == 'yes'){
            $the_content_markup .= self::kjd_get_the_post_info();
        }

        if( $attachment_layout == 'text-above' || $attachment_layout == 'text-left' ){
            if( get_the_content()  ){
                $the_content_markup .= '<p class="attachment-description">'.get_the_content().'</p>';
            }
        }

        // the content
        $the_content_markup .= self::kjd_get_the_content();
        //the content

        if($attachment_layout == 'text-below' || $attachment_layout == 'text-right'){
            if( get_the_content()  ){
                $the_content_markup .= '<p class="attachment-description">'.get_the_content().'</p>';
            }
        }


        $the_content_markup .= self::kjd_get_the_post_meta();


        // closes content inner
        $the_content_markup .= '</div>';

        return 	$the_content_markup;
    }


    /**
    * Builds the layout for the single posts or a single page
    * @return [type] [description]
    */
    public static function kjd_single_page_layout() {

        $the_content_markup = '';

        $the_content_markup .= '<div class="the-content-inner">';

        if( !is_page() ){

            $the_content_markup .= self::kjd_get_the_post_info();
        }

        // the content
        $the_content_markup .= self::kjd_get_the_content();
        //the content

        if( !is_page() ){

            $the_content_markup .= self::kjd_get_the_post_meta();
        }

        // closes content inner
        $the_content_markup .= '</div>';

        return $the_content_markup;
    }



    /**
    * This just grabs the post/page/attachment content.
    *
    * As in, the shit from the wp editor or the attached image
    */

    public static function kjd_get_the_content($post_display = null)
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

            $the_content_markup = kjd_the_404();

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
    * This builds the post wrapper/layout for the FEED views
    * It does things like positions the featured image, and also styles the post in a bootstrap "well" if need be
    * @param  [type] $post_options [description]
    * @return [type]               [description]
    */
    public static function kjd_posts_layout($post_options) {

        $post_display = $post_options['post_listing_type'];
        $show_thumbnail = $post_options['show_featured_image'];
        $featured_image = $post_options['featured_position'];

        $show_thumbnail = ( $show_thumbnail== 'true' && $post_display == 'excerpt' ) ? 'true' : 'false' ;
        $media_body_right = $featured_image == 'right_of_post' ? 'media-body-right' : '' ;

        // puts featured image before content wrapper
        if( in_array($featured_image, array('atop_post','left_of_post') ) && $show_thumbnail == 'true'){

            $the_content_markup .= self::kjd_get_featured_image($featured_image);

        }
        //

        $the_content_markup .= '<div class="the-content-inner media-body '.$media_body_right.' ">';

        $the_content_markup .= '<h3 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';

        // featured image before info
        if($featured_image == 'before_post_info' && $show_thumbnail == 'true' && !is_attachment()){
            $the_content_markup .= self::kjd_get_featured_image();
        }

        $the_content_markup .= self::kjd_get_the_post_info();


        // featured image before content
        if($featured_image == 'before_content' && $show_thumbnail == 'true' && !is_attachment()){
            $the_content_markup .= self::kjd_get_featured_image();
        }

        // the content
        $the_content_markup .= self::kjd_get_the_content($post_display);
        //the content

        // featured image before meta
        if($featured_image == 'before_post_meta' && $show_thumbnail == 'true' && !is_attachment()){
            $the_content_markup .= self::kjd_get_featured_image();
        }
        //

        $the_content_markup .= self::kjd_get_the_post_meta();


        // closes content inner
        $the_content_markup .= '</div>';

        // featured image after post or right of post
        if(in_array($featured_image, array('after_post','right_of_post')) && $show_thumbnail == 'true'){
            $the_content_markup .= self::kjd_get_featured_image($featured_image);
        }

        return $the_content_markup;
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
        $the_post_meta_markup = '<div class="post-meta">';
        if(!is_page() && !is_attachment()){
            $the_post_meta_markup .= '<span class="cat-label">Categorized: </span>'.$buffered_categories;
            $the_post_meta_markup .= '<div style="clear:both;"></div>';
        }elseif( is_attachment() ){
            $the_post_meta_markup .= self::kjd_gallery_image_links();
        }

        $the_post_meta_markup .= '</div>';

        return $the_post_meta_markup;
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


        $the_post_info_markup =	'<div class="post-info">';
        $the_post_info_markup .='<span class="post-date">';
        $the_post_info_markup .= 'Posted on: <a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date('F j').'</a>, <a href="'.get_year_link(get_the_time('Y')).'">'.get_the_date('Y').'</a> - </span>';
        $the_post_info_markup .='<span class="post-author">';
        $the_post_info_markup .='By: <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('nickname').'</a>';
        $the_post_info_markup .= '</span></div>';

        return $the_post_info_markup;
    }

}
