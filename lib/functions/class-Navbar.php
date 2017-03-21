<?php

/**
* This class builds the navbar, this is my first attempt at OOP so its probably going to be pretty rough
*
* The first function builds the navbar, it accepts a number of arguments to build everything out
*/
class Navbar{

    public static $output = '';
    public static $class = '';
    public static $brand = 'none';
    public static $brand_image = null;
    public static $menu_id;
    public static $movement = 'none';
    public static $nav_style;
    public static $position;
    public static $full_width;
    public static $walker;
    public static $button_type = 'default';
    public static $nav_settings;
    public static $site_settings;


    // sets up the nav
    public function __construct( $menu_id = 'primary-menu', $args = array(), $class = null){

        self::$menu_id = $menu_id;

        // expecting: $position, $movement, $nav_style, $brand, $brand_image,  $menu_toggle_type
        extract($args);

        $site_settings = get_option('bswp_site_settings');
        self::$site_settings = $site_settings['misc'];
        self::$nav_settings = $site_settings['navbar']['settings'];


        self::$class = $class ? $class : '';

        // position and movement
        self::$position = isset($position) ? $position : self::get_default('position', 'below_header');
        self::$movement = isset($movement) ? $movement : self::get_default('movement', 'none');
        self::$full_width = isset($full_width) ? $full_width : self::get_default('full_width', 'none');

        // navbar brand
        self::$brand = isset($brand) ? $brand : self::get_default('brand', 'text');
        self::$brand_image = isset($brand_image) ? $brand_image : self::get_default('brand_image', '');

        // navbar style for stickied navbar
        if(self::$position == 'stickied_to_top')
            self::$nav_style = 'navbar-fixed-top';
        elseif(self::$position == 'stickied_to_bottom')
            self::$nav_style = 'navbar-fixed-bottom';
        else
            self::$nav_style = '';

        // mobile nav toggle button type
        self::$button_type = isset($menu_toggle_type) ? $menu_toggle_type : self::get_default('menu_toggle_type', 'default');

        // modified navbar
        self::$walker = new navbarMenu();


        self::scaffolding();

    }

    public function __toString(){
        return self::$output;
    }


    public static function is_body_contained() {
        $layout = self::$site_settings['layout'];

        $full_width = ($layout['full_width'] == 'yes') ? false : true;
        return $full_width;
    }

    public static function is_navbar_full_width() {

        return self::$full_width == 'yes' ? true : false;
    }

    public static function contain_section() {
        $body_contained = self::is_body_contained();

        $contained = !$body_contained && self::is_navbar_full_width() ? true : false;
        return $contained ? '' : 'container';
    }

    public static function inner_container() {
        $body_contained = self::is_body_contained();
        $container = !$body_contained && self::is_navbar_full_width() ? 'container' : '';
    }


    public static function get_default($arg = null, $default = '') {
        if(!$arg)
            return '';

        return self::$nav_settings[$arg] ? self::$nav_settings[$arg] : $default;
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
        $output .= '<div class="navbar">';

            // $output .= '<a class="brand '.$logo.'" href="'.home_url().'">'.get_bloginfo( 'name' ).'</a>';
            $output .= self::toggle_button_type();
            $output .= self::brand();
            $output .= '<div class="nav-collapse collapse navbar-responsive-collapse">';
                $output .= self::build_menu();
            $output .= '</div>'; // en nav collapse


        $output .= '</div>'; // end navbar -->

        return $output;
    }


    public static function scaffolding(){

        $output = '';

        $output .= '<div id="navbar" class="section section--navbar navbar-wrapper '. self::$menu_id
            .' '. self::movement_class()
            .' '. self::nav_style()
            .' '. self::contain_section()
            .'">';
            $output .= '<div class="navbar-inner">';
                // if the navbar type is not set to contained then we need to put the container inside the inn=er
                if(self::is_navbar_full_width())
                    $output .= self::wrap_with_container(self::inner_markup());
                else
                    $output .= self::inner_markup();

            $output .= '</div>'; // end navbar inner


        $output .= '</div>'; // end #navbar

        self::$output = $output;
    }

    public static function brand() {


        if(self::$brand == 'none')
            return '';

        if(self::$brand == 'image' && self::$brand_image != null )
            return '<a class="brand brand--image" href="'.home_url().'"><img src="'.self::$brand_image.'" /></a>';
        else
            return '<a class="brand" href="'.home_url().'">'.get_bloginfo( 'name' ).'</a>';
    }


    public static function movement_class() {


        if(strpos(self::$position, 'stickied') !== false )
            return '';

        if(self::$movement == 'stick_to_top_on_scroll')
            return 'js--'.str_replace('_','-',self::$movement);

        return '';
    }


    public static function nav_style() {
        return rtrim(self::$nav_style . ' ' .self::$class);
    }


    public static function build_menu(){


        /*
        If the primary nav is set, then we use that.
        otherwise, we display the default menu
        */
        if ( has_nav_menu( 'primary-menu' ) ){

            ob_start();
            wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'menu_class' => 'nav',
                    'container'=> '',
                    'walker'=> self::$walker
                )
            );
            $output = ob_get_contents();
            ob_end_clean();

            return $output;
        } else {

            $output = '';

            $output .= '<ul class="nav nav-pills visible-desktop">';
            $output .= '<li><a href="'. home_url() .'/" title="home">Home</a></li>';
            if( is_user_logged_in() ){
                $output .= '<li><a href="'. home_url() .'/wp-admin/nav-menus.php" title="set menus" >Set Menu</a></li>';

            }else{

                $output .= '<li><a href="'. wp_login_url() .'/" title="login" >Login</a></li>';
            }
            $output .= '</ul>';

            return $output;
        }


        return;
    }


    public static function toggle_button_type( ) {

        $output = '';
        $btn_output = '';
        $button_class = '';

        switch(self::$button_type):
            case 'default':
                $button_class = "btn collapsed";

                $btn_output .= '<span class="icon-bar"></span>';
                $btn_output .= '<span class="icon-bar"></span>';
                $btn_output .= '<span class="icon-bar"></span>';
                break;
            case 'hamburger':
                $button_class = "btn btn-hamburger collapsed";

                $btn_output .= '<span class="icon-bar"></span>';
                $btn_output .= '<span class="icon-bar"></span>';
                $btn_output .= '<span class="icon-bar"></span>';

                break;
            case 'text':
                $button_class = "menu-text collapsed";

                $btn_output ='<span class="btn-navbar__text"> Menu </span>';
                break;
            default:
                $button_class = "btn collapsed";

                $btn_output .= '<span class="icon-bar"></span>';
                $btn_output .= '<span class="icon-bar"></span>';
                $btn_output .= '<span class="icon-bar"></span>';
                break;
        endswitch;
        $output .= '<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="navbar-menu-btn btn-navbar '.$button_class.'">';
            $output .= $btn_output;
        $output .= '</a>';

        return $output;
    }




}
