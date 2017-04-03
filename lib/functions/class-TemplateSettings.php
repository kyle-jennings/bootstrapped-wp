<?php


class TemplateSettings {

    public static $feed_type = null;
    public static $full_width;
    public static $header_settings;
    public static $template;
    public static $template_type;
    public static $sidebar_settings;

    public function __construct()
    {
        $site_settings = get_option('bswp_site_settings');
        $layout = $site_settings['misc']['layout'];
        self::$full_width = ($layout['full_width'] != 'no') ? true : false;

        self::$header_settings = $site_settings['header'];
        self::$sidebar_settings = ['layout']['sidebars'];

        self::getTemplateType();

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
    public static function getTemplateType() {

        //	if the page is a post type

        if( is_singular() ){
            self::$template_type = 'single';
            self::isSingle();
        }elseif( is_front_page() ){
            self::$template_type = 'frontpage';
        }else{
            self::$template_type = 'feed';
            self::isFeed();

        }


    }


    public static function isSingle()
    {
        if (is_embed()) :
            self::$template = 'embed';
        elseif (is_404()) :
            self::$template = '404';
        elseif (is_attachment()) :
            self::$template = 'attachment';
        elseif (is_single()) :
            self::$template = 'single';
        elseif ( is_page_template()):
            self::$template = 'page-template';
        elseif (is_page()) :
            self::$template = 'page';
        endif;
    }


    public static function isFeed()
    {

        // if( is_post_type_archive() || is_home() )
        if( is_search() )
            self::$template = 'search';
        elseif( is_home()){
            self::$template = 'home';
            self::$feed_type = 'post_type_archive';
        }elseif( is_tax() ){
            self::$template = 'taxonomy';
        }elseif( is_category() ){
            self::$template = 'category';
        }elseif( is_tag() ){
            self::$template = 'tag';
        }elseif( is_author() ){
            self::$template = 'author';
        }elseif( is_date() ){
            self::$template = 'date';
            self::isDate();
        }elseif( is_archive() ){
            self::$template = 'archive';
            self::$feed_type = 'post_type_archive';
        }else{
            self::$template = 'home';
            self::$feed_type = 'post_type_archive';

        }



    }


    public static function isDate()
    {
        if(is_day())
            self::$feed_type = 'day';
        elseif( is_month())
            self::$feed_type = 'month';
        else
            self::$feed_type = 'year';
    }


    public static function isPageTemplate()
    {

        if ( is_page_template('pageTemplate1.php') )
            self::$template = 'template_1';
        elseif( is_page_template('pageTemplate2.php') )
            self::$template = 'template_2';
        elseif( is_page_template('pageTemplate3.php') )
            self::$template = 'template_3';
        elseif( is_page_template('pageTemplate4.php') )
            self::$template = 'template_4';
        elseif( is_page_template('pageTemplate5.php') )
            self::$template = 'template_5';
        elseif( is_page_template('pageTemplate6.php') )
            self::$template = 'template_6';
        else
            self::$template = 'page';

    }



}
