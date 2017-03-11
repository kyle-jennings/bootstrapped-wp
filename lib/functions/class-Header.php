<?php

class Header {

    // settings
    public $page_id;
    public $page;
    public $args;
    public $content_type;
    public $custom_content;

    // the output
    public $output = '';
    public $content ='';

    public function __construct($custom_content = null, $args = array(), $page = null, $url = null ) {

        // examine(get_queried_object());

        // get current page ID
        $this->page_id  = get_queried_object_id();
        // error_log('quieried page ID: '. $this->page_id );
        // get posts page_id
        $this->post_page_id = get_option('page_for_posts', true);

        // if the page_id is not set is a url is passed in..
        if(!$this->page_id || $this->page_id == 0 ){
            $this->page_id = $url ? $this->get_page($url) : null;
            // error_log('new page id: '. $this->page_id);
        }

        $this->page = $page ? $page : $this->set_page_type($this->page_id);



        // set optional args - these should just be styles
        $this->args = $args;
        if(!empty($args))
            extract($args);

        // set the passed in content_type and content if any
        $this->content_type = $custom_content ? 'custom_content' : null;
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
        if($id === null || is_front_page($id) || ( $this->page_id != $this->post_page_id && is_home($id) ) ){
            // error_log('front page: '. $id);
            return 'frontpage';
        }elseif( is_archive($id) || ($this->page_id == $this->post_page_id  || is_home($id)) ){
            // error_log('feed: '. $id);

            return 'feed';
        }else {
            // error_log('single: '. $id);

            return 'single';
        }


    }


    public function set_content($content = '') {

        $this->content = $content;
        $output = '';
        $output .= '<div class="span12 js--header-content">';
            $output .= $this->content;
        $output .= '</div>';
        $this->output = $output;
        unset($this->custom_content);
    }


    // Waht page are we on and what content do we serve?
    public function select_content(){

        // error_log('selecting content');
        $post_page = get_option('page_for_posts', true);

        if( $this->page == 'frontpage'){
            // error_log('fp');
            $content = $this->frontpage();
        }elseif( $this->page == 'feed' ){
            // error_log('feed');

            $content = $this->feed();
        }else {
            // error_log('page');

            $content = $this->get_page_content();
        }

        $this->set_content($content);

    }


    public function get_page($url) {
        // error_log('supplied url:' . $url . ', id: ' . $this->page_id);
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

        // error_log('found page id: '. $id);
        return $id;
    }


    /**
     * The front page can show either the site title or custom content
     * (or widgets eventually).  So the logic for that is here
     * @return [type] [description]
     */
    public function frontpage() {
        // get the saved front page values
        $this->_get_default('front_page');

        if($this->content_type == 'title'){
            return $this->site_title();
        }
        else
            return $this->custom_content();
    }


    /**
     * Displays the Site Title and descriptoin
     * @return [type] [description]
     */
    public function site_title() {
        $output = '';
        $output .= '<div class="jumbotron no-background">';
            $output .= '<h1 class="logo-wrapper" >';
                    $output .= get_bloginfo( 'name');
            $output .= '</h1>';
            $output .= '<div class="logo-wrapper">'.get_bloginfo('description').'</div>';
        $output .= '</div>';


        return $output;
    }


    /**
     * Displays custom content as defined in the theme settings
     */
    public function custom_content() {
        $output = '';


        $output .= '<div class="jumbotron no-background">';
            $output .= $this->custom_content ? $this->custom_content : '';
        $output .= '</div>';

        return $output;
    }


    /** Page title for feeds */
    public function feed() {

        // error_log('getting feed title');
        $post = get_queried_object();

        if( $post->post_title)
                $title = $post->post_title;
        elseif($post->name)
                $title = $post->name;
        elseif($this->page_id)
                $title = get_the_title($this->page_id);
        else
            $title = '';


        $output = '';
        $output .= '<div class="jumbotron no-background">';
            $output .= '<h1 class="logo-wrapper" >';
                    $output .= $title;
            $output .= '</h1>';
        $output .= '</div>';

        return $output;
    }


    /* Page title for pages and posts */
    public function get_page_content() {
        global $post;

        $title = $post->post_title ? $post->post_title : get_the_title($this->page_id);
        $output = '';

        $output .= '<div class="jumbotron no-background">';
            $output .= '<h1 class="logo-wrapper" >';
                    $output .= $title;
            $output .= '</h1>';
            // $output .= '<div class="logo-wrapper">'.get_bloginfo('description').'</div>';
        $output .= '</div>';

        return $output;
    }


    public function _get_default($target) {

        $this->content_type = ($this->content_type != null)
            ? $this->content_type
            : $this->saved_settings[$target]['content_type'];

        // get the saved front page values
        $this->custom_content = ($this->content_type == 'custom_content' && $this->custom_content != null)
            ? $this->custom_content
            : $this->saved_settings[$target]['custom_content'];
    }

}
