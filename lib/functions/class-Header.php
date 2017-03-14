<?php

class Header {

    // settings
    public $page_id;
    public $page_type;
    public $args;
    public $content_type;
    public $custom_content;

    // the output
    public $output = '';
    public $content ='';

    // args: content_type, custom content, styles, page type, url, content type
    public function __construct($content_type = null, $custom_content = null, $args = array(), $page_type = null, $url = null ) {

        // examine(get_queried_object());

        // get current page ID
        $this->page_id  = get_queried_object_id();
        // get posts page_id
        $this->post_page_id = get_option('page_for_posts', true);

        // if the page_id is not set is a url is passed in..
        if(!$this->page_id || $this->page_id == 0 ){
            $this->page_id = $url ? $this->get_page_id($url) : null;
        }

        $this->page_type = $page_type ? $page_type : $this->set_page_type($this->page_id);



        // set optional args - these should just be styles
        $this->args = $args;
        if(!empty($args))
            extract($args);

        // set the passed in content_type and content if any
        $this->content_type = $content_type ? $content_type : null;
        $this->custom_content = ($this->content_type == 'custom_content' && $custom_content)
            ? $custom_content
            : null;



        if($this->custom_content){
            $this->set_content($this->custom_content);
            return;
        }


        // lets go ahead and grab the saved values
        $site_options = get_option('bswp_site_settings');
        $this->saved_settings = $site_options['header'];


        // use the correct content
        $this->select_content();
        // unset the uneeded vars
        unset($this->args);
        unset($this->saved_settings);
    }

    public function __toString(){
        return $this->output;
    }


    public function set_page_type($id = null) {


        // set the current page
        if($id === null || is_front_page($id) || (  $this->page_id !== get_option('page_for_posts', true) && strpos($template, 'index')) ){
            return 'frontpage';
        }elseif( is_archive($id) || ($this->page_id == $this->post_page_id  || is_home($id)) ){

            return 'feed';
        }else {

            return 'single';
        }


    }

    /**
     * Displays custom content as defined in the theme settings
     */
    public function custom_content() {
        $output = '';
        $output .= $this->custom_content ? $this->custom_content : '';

        return $output;
    }

    public function get_page_id($url) {
        $number = url_to_postid($url);
        $id = null;
        if($number > 0)
            $id = $number; // a page
        else{
            $page_for_posts_url = get_permalink( $this->post_page_id );
            if( rtrim($url,'/') == rtrim($page_for_posts_url,'/') )
                $id = $this->post_page_id; // the posts page
            else
                $id =  null;  // front page
        }

        return $id;
    }


    public function set_content($content = '') {

        $this->content = $content;
        $output = '';
        $output .= '<div class="span12 header-content js--header-content">';
            $output .= '<div class="jumbotron no-background">';
                $output .= $this->content;
            $output .= '</div>';

        $output .= '</div>';
        $this->output = $output;
        unset($this->custom_content);
    }


    // Waht page are we on and what content do we serve?
    public function select_content(){

        $post_page = get_option('page_for_posts', true);

        if( $this->page_type == 'frontpage'){
            $content = $this->get_frontpage_content();
        }elseif( $this->page_type == 'feed' ){

            $content = $this->get_feed_content();
        }else {

            $content = $this->get_page_content();
        }

        $this->set_content($content);

    }



    /**
     * Displays the Site Title and descriptoin
     * @return [type] [description]
     */
    public function site_title() {
        $output = '';

            $output .= '<h1 class="logo-wrapper" >';
                    $output .= get_bloginfo( 'name');
            $output .= '</h1>';
            $output .= '<div class="logo-wrapper">'.get_bloginfo('description').'</div>';


        return $output;
    }



    /**
     * The front page can show either the site title or custom content
     * (or widgets eventually).  So the logic for that is here
     * @return [type] [description]
     */
    public function get_frontpage_content() {
        // get the saved front page values
        $this->_get_default('front_page');

        if($this->content_type == 'title'){
            return $this->site_title();
        }
        else
            return $this->custom_content();
    }


    /** Page title for feeds */
    public function get_feed_content() {

        $this->_get_default('feed_page');

        $post = get_queried_object();

        if( $post->post_title)
                $title = $post->post_title;
        elseif($post->name)
                $title = $post->name;
        elseif($this->page_id)
                $title = get_the_title($this->page_id);
        else
            $title = '';



        if($this->content_type == 'title')
            $output = $this->title_markup($title);
        else
            $output = $this->featured_post_markup($post);

        return $output;
    }


    /* Page title for pages and posts */
    public function get_page_content() {
        global $post;

        $this->_get_default('feed_page');

        $title = $post->post_title ? $post->post_title : get_the_title($this->page_id);


        if($this->content_type == 'title')
            $output = $this->title_markup($title);
        else
            $output = $this->excerpt_markup($title);



        return $output;
    }


    public function featured_post_markup($post) {
        $f_id = get_option('featured-post--post');
        include dirname(__FILE__) . '/class-FeaturedPost.php';

        $use_exceprt = strpos($this->content_type, 'excerpt') !== false ? 'use-excerpt' : null;
        $featured_post = new FeaturedPost($f_id, 'post', $use_exceprt);
        return $featured_post->output;
        // return '';
    }


    public function excerpt_markup($title) {
        $output = '';

        $use_title = strpos($this->content_type, 'title') !== false ? 'use-title' : null;
        if($use_title == 'use-title')
            $output = $this->title_markup($title);

        $output .= '<p>'.get_the_excerpt($this->page_id).'</p>';
        return $output;
    }

    public function title_markup($title) {
        $output = '';
        $output .= '<h1 class="logo-wrapper" >';
                $output .= $title;
        $output .= '</h1>';

        return $output;
    }


    // if custom content has not been passed in, then we
    public function _get_default($target) {
        $this->content_type = $this->content_type
            ? $this->content_type
            : $this->saved_settings[$target]['content_type'];

        // get the saved front page values
        $this->custom_content = ($this->content_type == 'custom_content' && $this->custom_content != null)
            ? $this->custom_content
            : $this->saved_settings[$target]['custom_content'];
    }

}
