<?php

/**
* This class builds the navbar, this is my first attempt at OOP so its probably going to be pretty rough
*
* The first function builds the navbar, it accepts a number of arguments to build everything out
*/
class Navbar{

    public $output = '';
    public $brand = 'none';
    public $brand_image = null;
    public $menu_id;
    public $movement = 'none';
    public $walker;
    public $button_type = 'default';


    // sets up the nav
    public function __construct( $menu_id = 'primary-menu'){
        $this->menu_id = $menu_id;

        $site_options = get_option('bswp_site_settings');
        $nav_settings = $site_options['navbar']['settings'];

        $this->brand = $nav_settings['brand'];
        $this->brand_image = ($this->brand == 'image' && $nav_settings['brand_image']) ? $nav_settings['brand_image'] : null;

        $this->position = $nav_settings['position'];
        $this->movement = $nav_settings['movement'];

        if($this->position == 'stickied_to_top')
            $this->nav_style = 'navbar-fixed-top';

        if($this->position == 'stickied_to_bottom')
            $this->nav_style = 'navbar-fixed-bottom';

        $this->walker = new navbarMenu();

        $this->button_type = $nav_settings['menu_toggle_type'] ? $nav_settings['menu_toggle_type'] : 'default';

        $this->scaffolding();
    }



    public function __toString(){
        return $this->output;
    }


    //							menu id,  nav style,   link style, sidr/dropdown/ect,     devise visibility,  position, logo, menu id again for some reason, button type
    public function scaffolding(){

        $output = '';

        $output .= '<div class="navbar-wrapper '. $this->movement_class() .' '. $this->menu_id .' '. $this->nav_style . '">';

            $output .= '<div class="navbar-inner">';

                // if the navbar type is not set to contained then we need to put the container inside the inn=er
                $output .= '<div class="container">';
                    $output .= '<div class="navbar">';

                        // $output .= '<a class="brand '.$logo.'" href="'.home_url().'">'.get_bloginfo( 'name' ).'</a>';
                        $output .= $this->toggle_button_type();
                        $output .= $this->brand();
                        $output .= '<div class="nav-collapse collapse navbar-responsive-collapse">';
                            $output .= $this->build_menu();
                            $output .= $navbar_contents;
                        $output .= '</div>'; // en nav collapse


                    $output .= '</div>'; // end navbar -->

                $output .= '</div>'; // end container -->


            $output .= '</div>'; // end navbar-inner-->


        $output .= '</div>'; // end #navbar

        $this->output = $output;
    }

    public function brand() {


        if($this->brand == 'none')
            return '';

        if($this->brand == 'image' && $this->brand_image != null )
            return '<a class="brand brand--image" href="'.home_url().'"><img src="'.$this->brand_image.'" /></a>';
        else
            return '<a class="brand" href="'.home_url().'">'.get_bloginfo( 'name' ).'</a>';
    }


    public function movement_class() {

        if(strpos($this->position, 'stickied') !== false )
            return '';

        if($this->movement == 'stick_to_top_on_scroll')
            return 'js--'.str_replace('_','-',$this->movement);

        return '';
    }


    public function build_menu(){


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
                    'walker'=> $this->walker
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

public function toggle_button_type( ) {

    $output = '';
    $btn_output = '';
    $button_class = '';


    switch($this->button_type):
        case 'default':
            $button_class = "btn btn-navbar collapsed";

            $btn_output .= '<span class="icon-bar"></span>';
            $btn_output .= '<span class="icon-bar"></span>';
            $btn_output .= '<span class="icon-bar"></span>';
            break;
        case 'hamburger':
            $button_class = "btn btn-navbar btn-hamburger collapsed";

            $btn_output .= '<span class="icon-bar"></span>';
            $btn_output .= '<span class="icon-bar"></span>';
            $btn_output .= '<span class="icon-bar"></span>';

            break;
        case 'text':
            $button_class = "btn-navbar menu-text collapsed";

            $btn_output ='<span class="btn-navbar__text"> Menu </span>';
            break;
        default:
            $button_class = "btn btn-navbar collapsed";

            $btn_output .= '<span class="icon-bar"></span>';
            $btn_output .= '<span class="icon-bar"></span>';
            $btn_output .= '<span class="icon-bar"></span>';
            break;
    endswitch;
    $output .= '<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="navbar-menu-btn '.$button_class.'">';
        $output .= $btn_output;
    $output .= '</a>';

    return $output;
}




}
