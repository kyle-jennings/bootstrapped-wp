<?php


class TemplateSettings {

    public static $id = null;
    public static $url = null;

    public static $feed_type = null;
    public static $full_width;
    public static $header_settings;
    public static $template;
    public static $template_type;
    public static $sidebar_settings;

    public function __construct($template_type = null, $template = null, $id = null, $url = null)
    {
        self::$id = $id;
        self::$url = $url;

        if(self::$url ){
            self::$id = self::get_page_id(self::$url);
        }


        $site_settings = get_option('bswp_site_settings');

        $layout = $site_settings['settings']['layout'];
        self::$full_width = ($layout['full_width'] != 'no') ? true : false;

        self::$header_settings = $site_settings['header'];
        self::$sidebar_settings = $site_settings['layouts']['sidebars'];


        self::$template_type = $template_type ? $template_type : self::getTemplateType(self::$id);
        self::$template = $template ? $template : self::getTemplate(self::$template_type, self::$id);



        $class = __CLASS__;
        $GLOBALS[ $class ] = $this;
    }

    /**
    * This detects the current page's/post's /feed's template and gets teh layout settings appropriately
    * Layout settings for now, are nothing more than the position of the sidebar, as well as sidebar visibility.
    *
    * @param  [type] $template [description]
    * @return [type]           [description]
    */
    public static function getTemplateType($id) {

        //	if the page is a post type
        if( is_front_page($id) || $id == get_option( 'page_on_front' ) ){
            return 'frontpage';
        }elseif( is_singular($id) || is_page($id) ){
            return 'single';
        }else{
            return 'feed';
        }


    }


    public static function getTemplate($template_type, $id) {

        //	if the page is a post type
        switch($template_type):
            case 'frontpage':
              return 'frontpage';
              break;
            case 'single':
              return self::isSingle($id);
              break;
            case 'feed':
              return self::isFeed($id);
              break;
        endswitch;


    }


    public static function isSingle($id)
    {
        if (is_embed($id)) :
            return 'embed';
        elseif (is_404($id)) :
            return '404';
        elseif (is_attachment($id)) :
            return 'attachment';
        elseif (is_single($id)) :
            return 'single';
        elseif ( is_page_template($id)):
            return 'page-template';
        elseif (is_page($id)) :
            return 'page';
        endif;
    }


    public static function isFeed($id)
    {

        if( is_search($id) )
            return 'search';
        elseif( is_home($id) || $id == get_option( 'page_for_posts') ){
            self::$feed_type = 'post_type_archive';
            return 'home';
        }elseif( is_tax($id) ){
            return 'taxonomy';
        }elseif( is_category($id) ){
            return 'category';
        }elseif( is_tag($id) ){
            return 'tag';
        }elseif( is_author($id) ){
            return 'author';
        }elseif( is_date($id) ){
            self::isDate($id);
            return 'date';
        }elseif( is_archive($id) ){
            self::$feed_type = 'post_type_archive';
            return 'archive';
        }else{
            self::$feed_type = 'post_type_archive';
            return 'home';
        }



    }


    public static function isDate($id)
    {
        if(is_day($id))
            self::$feed_type = 'day';
        elseif( is_month($id))
            self::$feed_type = 'month';
        else
            self::$feed_type = 'year';
    }


    public static function isPageTemplate()
    {

        if ( is_page_template('pageTemplate1.php') )
            return 'template_1';
        elseif( is_page_template('pageTemplate2.php') )
            return 'template_2';
        elseif( is_page_template('pageTemplate3.php') )
            return 'template_3';
        elseif( is_page_template('pageTemplate4.php') )
            return 'template_4';
        elseif( is_page_template('pageTemplate5.php') )
            return 'template_5';
        elseif( is_page_template('pageTemplate6.php') )
            return 'template_6';
        else
            return 'page';

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

}
