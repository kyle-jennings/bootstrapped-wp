<?php

class Header {

    // settings
    public static $page_id;
    public static $post_page_id;

    public static $template;
    public static $template_type;
    public static $feed_type;

    public static $args;
    public static $content_type;
    public static $custom_content;
    public static $header_settings;


    public static $full_width;

    public static $bg_image_url;
    public static $navbar;
    public static $background_use_wallpaper;
    public static $height;
    public static $title_size;

    // the output
    public static $output = '';
    public static $content ='';


    public function __construct($url = null, $navbar = null) {

        // examine(get_queried_object());

        // get current page ID
        self::$page_id  = get_queried_object_id();
        // get posts page_id
        self::$post_page_id = get_option('page_for_posts', true);

        // if the page_id is not set is a url is passed in..
        if(!self::$page_id || self::$page_id == 0 ){
            self::$page_id = $url ? self::get_page_id($url) : null;
        }

        // set the page type - used for previews mostly
        self::$template_type = $GLOBALS['TemplateSettings']::$template_type;
        self::$template = $GLOBALS['TemplateSettings']::$template;
        self::$feed_type = $GLOBALS['TemplateSettings']::$feed_type;

        self::$header_settings = $GLOBALS['TemplateSettings']::$header_settings;
        self::$full_width = $GLOBALS['TemplateSettings']::$full_width;


        // sizes
        self::$height = self::$header_settings['settings']['height'];
        self::$title_size = self::$header_settings['settings']['title_size'];

        //bg wallpaper
        self::$background_use_wallpaper = self::$header_settings['background_wallpaper']['background_use_wallpaper'];

        // set navbar
        self::$navbar = $navbar;

    }


    // magic method to echo string
    public function __toString(){
        return self::$output;
    }

    public static function is_body_full_width() {
        $full_width = self::is_full_width();
        return ($full_width == 'no') ? true : false;

    }



    public static function is_full_width() {
        return self::$full_width == 'yes' ? true : false;
    }

    public static function contain_section() {
        $body_contained = self::is_body_full_width();
        $contained = !$body_contained && self::is_navbar_full_width() ? true : false;
        return $contained ? '' : 'container';
    }

    public static function inner_container() {

        $body_contained = self::is_body_contained();
        $container = !$body_contained && self::is_navbar_full_width() ? 'container' : '';
    }


    public static function get_page_id($url) {
        $number = url_to_postid($url);
        $id = null;
        if($number > 0)
            $id = $number; // a page
        else{
            $page_for_posts_url = get_permalink( self::$post_page_id );
            if( rtrim($url,'/') == rtrim($page_for_posts_url,'/') )
                $id = self::$post_page_id; // the posts page
            else
                $id =  null;  // front page
        }

        return $id;
    }



    /**
     * This is where we manually set content, say for the preview window
     * @param  string $content_type  title/custom content/featured post ect
     * @param string $custom_content html to display as the custom content
     */
    public static function set_content($content_type = null, $custom_content = null) {

        // set the passed in content_type and content if any
        self::$content_type = $content_type ? $content_type : null;
        self::$custom_content = (self::$content_type == 'custom_content' && $custom_content)
            ? $custom_content
            : null;



        if(self::$custom_content){
            self::set_content_markup(self::$custom_content);
            return;
        }


    }


    public static function wrap_with_container($markup ='') {
        $output = '';
        // if the navbar type is not set to contained then we need to put the container inside the inn=er
        $output .= '<div class="container">';
            $output .= $markup;
        $output .= '</div>'; // end container -->

        return $output;
    }



    public static function inner_markup() {
        $output = '';
        $output .= '<div class="row">';
            $output .= self::$output;
        $output .= '</div>';

        return $output;
    }



    public static function set_scaffolding() {
        self::select_content();

        ?>
        <div class="section section--header"
            <?php echo self::get_bg_styles(); ?> >
            <?php
            if(self::$navbar::$position == 'in_header_top')
                echo $navbar;

            if(self::is_body_full_width())
                echo self::wrap_with_container(self::inner_markup());
            else
                echo self::inner_markup();

            if(self::$navbar::$position == 'in_header_bottom'){
                echo self::$navbar;
            }
            ?>
        </div> <!-- end header area -->

        <?php
    }



    public static function get_bg_styles() {
        $output = '';
        if(self::$bg_image_url && self::$background_use_wallpaper == 'yes') {
            $output .= 'style="';
                $output .= 'background-image:url('.self::$bg_image_url.')';
            $output .= '"';
        }

        return $output;
    }


    public static function get_height_and_title_size() {
        $output = '';

        $output .= isset(self::$height) ? self::$height. ' ' : ' ';
        $output .= isset(self::$title_size) ? 'title-'.self::$title_size : ' ';


        return $output;
    }


    /**
     * sets the header object's output based on what was set as teh content
     * from the results of the selct_content method
     * @param string $content [description]
     */
    public static function set_content_markup($content = '') {

        self::$content = $content;
        $output = '';
        $output .= '<div class="span12 header-content js--header-content">';
            $output .= self::$content;
        $output .= '</div>';
        self::$output = $output;
        self::$custom_content = null;;
    }


    /**
     * Logic to select which type of content we need to start grabing
     * @return [type] [description]
     */
    public static function select_content(){

        $post_page = get_option('page_for_posts', true);

        if( self::$template_type == 'frontpage'){

            $content = self::get_frontpage_content();
        }elseif( self::$template_type == 'feed' ){
            $content = self::getFeedContent();
        }else {
            $content = self::get_page_content();
        }

        self::set_content_markup($content);
        self::$header_settings = null;
    }


    /**
     * The front page can show either the site title or custom content
     * (or widgets eventually).  So the logic for that is here
     * @return [type] [description]
     */
    public static function get_frontpage_content() {
        // get the saved front page values
        self::_get_default('frontpage');

        if(self::$content_type == 'title' || self::$content_type == null)
            return self::site_title();
        else
            return self::custom_content();
    }


    /**
     * Displays custom content as defined in the theme settings
     */
    public static function custom_content() {
        $output = '';
        $output .= self::$custom_content ? self::$custom_content : '';

        return $output;
    }


    /**
     * Displays the Site Title and descriptoin
     * @return [type] [description]
     */
    public static function site_title() {
        $output = '';

        $output .= '<h1 class="header-content__title" >';
                $output .= get_bloginfo( 'name');
        $output .= '</h1>';
        $output .= '<p class="header-content__description">'.get_bloginfo('description').'</p>';


        return $output;
    }


    /**
     * Gets the content when youre on a "feed" template
     *
     * Could be the taxonomy title, the posts page title, or a featured post
     * @return [type] [description]
     */
    public static function getFeedContent()
    {

        self::_get_default('feed');

        if(self::$feed_type == 'post_type_archive'):
            $post = get_queried_object();
            if( $post->post_title)
                $title = $post->post_title;
            elseif($post->name)
                $title = $post->name;
            elseif(self::$page_id)
                $title = get_the_title(self::$page_id);
        endif;


        switch(self::$template):
            case 'author':
                $auth = get_user_by('slug', get_query_var('author_name'));
                $title ='Posts by: '.$auth->nickname;
                break;
            case 'date':
                $title = self::isDate(self::$feed_type);
                break;
            case 'category':
                ob_start();
                single_cat_title();
                $buffered_cat = ob_get_contents();
                ob_end_clean();
                $title ='Posted in: '.$buffered_cat;
                break;
            case 'search':
                global $wp_query;
    			$total_results = $wp_query->found_posts;
    			$title = $total_results ? 'Posts containing: '.get_search_query() : 'No results found' ;
                break;
        endswitch;

        // select the content type markup
        if(self::$feed_type != 'post_type_archive'){
            $output = self::title_markup($title);
        }
        elseif(self::$content_type == 'title' || self::$content_type == null )
            $output = self::title_markup($title);
        else{
            $post = get_queried_object();
            $output = self::featured_post_markup($post);
        }


        return $output;
    }



    public static function isDate($date_type)
    {

        switch($date_type):
            case 'day':
                $title = 'Daily Archives: <span>'.get_the_date() . '</span>';
                break;
            case 'month':
                $title = 'Monthly Archives: <span>' . get_the_date( 'F Y' ) . '</span>';
                break;
            case 'year':
                $title = 'Yearly Archives: <span>' . get_the_date( 'Y' ) . '</span>';
                break;
        endswitch;


        return $title;
    }


    /**
     * A featured post is its own object due to the complexities of a post
     *
     * @param  [type] $post [description]
     */
    public static function featured_post_markup($post) {

        $f_id = get_option('featured-post--post');
        include dirname(__FILE__) . '/class-FeaturedPost.php';

        $use_exceprt = strpos(self::$content_type, 'excerpt') !== false ? 'use-excerpt' : null;
        $featured_post = new FeaturedPost($f_id, 'post', $use_exceprt);
        self::set_post_image($featured_post->id);

        return $featured_post->output;
        // return '';
    }



    /**
     * Gets the content for a "single pust" (also page or CPT)
     */
    public static function get_page_content() {
        global $post;

        self::_get_default('single');

        $title = $post->post_title ? $post->post_title : get_the_title(self::$page_id);

        // gets the post image
        self::set_post_image($post->ID);

        if(self::$content_type == 'title' || self::$content_type == null)
            $output = self::title_markup($title);
        else
            $output = self::excerpt_markup($title);

        return $output;
    }



    /**
     * The markup for the page excerpt
     * - should be used for maybe site descripton and taxonomy descriptons
     * @param  [type] $title [description]
     * @return [type]        [description]
     */
    public static function excerpt_markup($title) {
        $output = '';

        $use_title = strpos(self::$content_type, 'title') !== false ? 'use-title' : null;
        if($use_title == 'use-title' || !get_the_excerpt(self::$page_id))
            $output = self::title_markup($title);

        if(get_the_excerpt(self::$page_id))
            $output .= '<p class="header-content__description">'.get_the_excerpt(self::$page_id).'</p>';

        return $output;
    }


    /**
     * Gets the post image
     */
    private static function set_post_image($post_id) {
        $sizes = get_intermediate_image_sizes();

        $thumb_id = get_post_thumbnail_id($post_id);
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);

        if( $thumb_url_array[0] !== site_url().'/wp-includes/images/media/default.png')
            self::$bg_image_url = $thumb_url_array[0];
        else
            self::$bg_image_url = null;
    }

    /**
     * The markup for a regular ol title
     * @param  string $title the title
     */
    public static function title_markup($title) {
        $output = '';
        $output .= '<h1 class="logo-wrapper" >';
                $output .= $title;
        $output .= '</h1>';

        return $output;
    }


    // if custom content has not been passed in, then we
    public static function _get_default($target) {
        self::$content_type = self::$content_type
            ? self::$content_type
            : self::$header_settings[$target]['content_type'];

        // get the saved front page values
        self::$custom_content = (self::$content_type == 'custom_content' && self::$custom_content != null)
            ? self::$custom_content
            : self::$header_settings[$target]['custom_content'];
    }

}
