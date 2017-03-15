<?php

class Header {

    // settings
    public static $page_id;
    public static $post_page_id;
    public static $template_type;
    public static $args;
    public static $content_type;
    public static $custom_content;
    public static $saved_settings;
    public static $bg_image_url;
    public static $navbar;

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
        self::$template_type = self::set_template_type(self::$page_id);
        // lets go ahead and grab the saved values
        $site_options = get_option('bswp_site_settings');
        self::$saved_settings = $site_options['header'];

        // set navbar
        self::$navbar = $navbar;

    }
    // magic method to echo string
    public function __toString(){
        return self::$output;
    }



    /**
     * We identify the page type (template) and set it to frontpage/feed/single post
     * This will expand later to the other "top level" template types
     * @param [type] $id [description]
     */
    public static function set_template_type($id = null) {


        // set the current page
        if($id === null || is_front_page($id) || (  self::$page_id !== get_option('page_for_posts', true) && strpos($template, 'index')) ){
            return 'frontpage';
        }elseif( is_archive($id) || (self::$page_id == self::$post_page_id  || is_home($id)) ){
            return 'feed';
        }else {
            return 'single';
        }


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


    public static function set_scaffolding() {
        self::select_content();

        ?>
        <div class="section section--header" id="header" <?php echo self::get_bg_styles(); ?> >
            <?php
            if(self::$navbar::$position == 'in_header_top')
                echo $navbar;
            ?>
            <div class="container">
                <div class="row">
                    <?php
                        echo self::$output;
                    ?>
                </div> <!-- end row -->
            </div><!-- end header container -->
            <?php
            if(self::$navbar::$position == 'in_header_bottom'){
                echo self::$navbar;
            }
            ?>
        </div> <!-- end header area -->

        <?php
    }



    public static function get_bg_styles() {

        $output = '';
        if(self::$bg_image_url) {

            $output .= 'style="';
                $output .= 'background-image:url('.self::$bg_image_url.')';
            $output .= '"';
        }

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
            $output .= '<div class="jumbotron no-background">';
                $output .= self::$content;
            $output .= '</div>';

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
            $content = self::get_feed_content();
        }else {

            $content = self::get_page_content();
        }

        self::set_content_markup($content);
        self::$saved_settings = null;
    }


    /**
     * The front page can show either the site title or custom content
     * (or widgets eventually).  So the logic for that is here
     * @return [type] [description]
     */
    public static function get_frontpage_content() {
        // get the saved front page values
        self::_get_default('front_page');

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

        $output .= '<h1 class="logo-wrapper" >';
                $output .= get_bloginfo( 'name');
        $output .= '</h1>';
        $output .= '<div class="logo-wrapper">'.get_bloginfo('description').'</div>';


        return $output;
    }


    /**
     * Gets the content when youre on a "feed" template
     *
     * Could be the taxonomy title, the posts page title, or a featured post
     * @return [type] [description]
     */
    public static function get_feed_content() {


        self::_get_default('feed_page');
        $post = get_queried_object();

        if( $post->post_title)
                $title = $post->post_title;
        elseif($post->name)
                $title = $post->name;
        elseif(self::$page_id)
                $title = get_the_title(self::$page_id);
        else
            $title = '';


        // select the content type markup
        if(self::$content_type == 'title' || self::$content_type == null)
            $output = self::title_markup($title);
        else
            $output = self::featured_post_markup($post);

        return $output;
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

        self::_get_default('single_page');

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
            $output .= '<p>'.get_the_excerpt(self::$page_id).'</p>';

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
            : self::$saved_settings[$target]['content_type'];

        // get the saved front page values
        self::$custom_content = (self::$content_type == 'custom_content' && self::$custom_content != null)
            ? self::$custom_content
            : self::$saved_settings[$target]['custom_content'];
    }

}
