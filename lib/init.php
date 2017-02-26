<?php

if(! function_exists('examine') ){

    function examine($object, $examine_type = 'print_r'){
        if(empty($object))
            return;

        echo '<pre>';
        if($examine_type == 'var_dump')
            var_dump($object);
        else
            print_r($object);

        die;
    }

}


function bswp_remove_customizer() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('customize');
}

add_action( 'wp_before_admin_bar_render', 'bswp_remove_customizer' );

function bswp_remove_customizer_menu_item () {
    global $submenu;
    foreach($submenu['themes.php'] as $key=>$item)
        if($item[1] == 'customize')
            unset($submenu['themes.php'][$key]);
}
add_action('admin_menu', 'bswp_remove_customizer_menu_item');

register_nav_menus(
    array(
      'primary-menu' => __( 'Primary Nav' ),
    )
);

// gets options function
if(is_admin())
    include 'admin/init.php' ;

if(!is_admin()){
    require_once('functions/kjd-gallery.php');
    require_once('functions/kjd-shortcodes.php');
    require_once('functions/class-Navbar.php');
    require_once('functions/kjd-class-layout.php');
    require_once('functions/class-mobileMenu.php');
    require_once('functions/class-navbarMenu.php');
}


require_once('functions/kjd-widgets.php');


/* ------------------------------------------------
 kjd add js and css
 -------------------------------------------------- */
function kjd_add_assets(){

    //set tempplate root
    $root = get_bloginfo('template_directory');
    $wpcontent = dirname( ( dirname($root) ) );
    $root = $root.'/lib';

    // set variables
    $mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
    $mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];

    $override_nav = $mobileNavSettings['override_nav'];
    if( $override_nav == 'true') {
        $mobilenav_style = $mobileNavSettings['mobilenav_style'];
    }


    wp_enqueue_script("script", $root."/scripts/application.js", false, "1.0", true);
    wp_enqueue_script("jquery", $root."/scripts/jquery.js", false, "1.0", false);

    wp_enqueue_script("bootstrap-dropdown", $root."/scripts/bootstrap/bootstrap-dropdown.js", false, "1.0", true);
    wp_enqueue_script("bootstrap-carousel", $root."/scripts/bootstrap/bootstrap-carousel.js", false, "1.0", true);


    $component_options = get_option('bswp_site_settings');
    $component_options = $component_options['available_components']['components'];
    if($component_options['activate_collapsibles'])
        wp_enqueue_script("bootstrap-collapse", $root."/scripts/bootstrap/bootstrap-collapse.js", false, "1.0", true);

    if($component_options['activate_tabs'])
        wp_enqueue_script("bootstrap-tab", $root."/scripts/bootstrap/bootstrap-tab.js", false, "1.0", true);

    if($component_options['activate_tooltips'])
        wp_enqueue_script("bootstrap-tooltip", $root."/scripts/bootstrap/bootstrap-tooltip.js", false, "1.0", true);

    if($component_options['activate_popovers'])
        wp_enqueue_script("bootstrap-popover", $root."/scripts/bootstrap/bootstrap-popover.js", false, "1.0", true);



    wp_enqueue_style("site", $root."/styles/site.css");
    wp_enqueue_style("base", $root."/styles/common.css");

    // Add slider scripts if on front page
    if( is_front_page() )
        include( 'functions/add-slider-scripts.php');

}
add_action( 'wp_enqueue_scripts', 'kjd_add_assets' );



/* ----------------------------------------------------
 Set featured image and User Image Sizes
 ----------------------------------------------------- */
function kjd_set_featured_image_size(){

    $image_size_settings = get_option('kjd_component_settings');
    $featured_size = $image_size_settings['featured_image'];
    $w = $featured_size['width'] ? $featured_size['width'] : 300 ;
    $h = $featured_size['height'] ? $featured_size['height'] : 300 ;
    $c = $featured_size['crop'] ? $featured_size['crop'] : false ;

    if( function_exists ('add_theme_support') ){
        add_theme_support('post_tumbnails');
        add_image_size(
            'featured-image', $w, $h, $c
        );
    }
}
add_action( 'init', 'kjd_set_featured_image_size' );


function kjd_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'featured-image' => __('Featured Image'),
    ) );
}

add_filter( 'image_size_names_choose', 'kjd_custom_sizes' );


/* -----------------------------------------------
gets featured image meta info
------------------------------------------------- */
function kjd_the_post_thumbnail_description($args) {
    $thumbnail_id    = get_post_thumbnail_id($args->ID);
    $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

    if ($thumbnail_image && isset($thumbnail_image[0])) {
        echo '<span>'.$thumbnail_image[0]->post_content.'</span>';
    }
}


// add excerpts to pages
function kjd_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'kjd_add_excerpts_to_pages' );


/* ------------------------------------------------------
device views
--------------------------------------------------------- */

function kjd_deviceViewSettings($deviceView){
    if(isset($deviceView) && $deviceView !="all"){
        echo $deviceView;
    }
}

/* ------------------------------------------------------
 Add login css
--------------------------------------------------------- */
function kjd_login_css() {
    require_once('styles/login.php');
}
add_action('login_head', 'kjd_login_css');



/* --------------------------------------------
 the 404
------------------------------------------------ */

function kjd_the_404(){

    $page_404 = get_option('kjd_theme_settings');
    $page_404 = !empty($page_404['kjd_404_page']) ? $page_404['kjd_404_page'] : '' ;
    $output = do_shortcode($page_404);

    return $outout;
}

/* -----------------------------------------------------
    Add widget styling classes to front end
--------------------------------------------------------*/
function kjd_add_widget_style( $params ){

    global $wp_registered_widgets, $widget_number;



    $arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
    $this_id                = $params[0]['id']; // Get the id for the current sidebar we're processing
    $widget_id              = $params[0]['widget_id'];
    $widget_obj             = $wp_registered_widgets[$widget_id];
    $widget_num             = $widget_obj['params'][0]['number'];
    $widget_opt             = null;
    $widget_opt = get_option( $widget_obj['callback'][0]->option_name );


            $widget_opt = get_option( $widget_obj['callback'][0]->option_name );

    if ( isset( $widget_opt[$widget_num]['widget_style'] ) && !empty( $widget_opt[$widget_num]['widget_style'] ) ){
        // $params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['widget_style']} ", $params[0]['before_widget'], 1 );
        $params[0]['before_widget'] = $params[0]['before_widget'].' <div class="' . $widget_opt[$widget_num]['widget_style'] . '"> ';
        $params[0]['after_widget'] = ' </div> '.$params[0]['after_widget'];

        // $params[0]['after_widget'] = str_replace('</div>', '</div></div>', $params[0]['after_widget']);

    }


    return $params;
}

add_filter( 'dynamic_sidebar_params', 'kjd_add_widget_style' );


/* ------------------------------------------------------
device visibility
--------------------------------------------------------- */
function kjd_add_device_visibility( $params ){

    global $wp_registered_widgets, $widget_number;



    $arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
    $this_id                = $params[0]['id']; // Get the id for the current sidebar we're processing
    $widget_id              = $params[0]['widget_id'];
    $widget_obj             = $wp_registered_widgets[$widget_id];
    $widget_num             = $widget_obj['params'][0]['number'];
    $widget_opt             = null;
    $widget_opt = get_option( $widget_obj['callback'][0]->option_name );


    // if Widget Logic plugin is enabled, use it's callback
    if ( in_array( 'widget-logic/widget_logic.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        $widget_logic_options = get_option( 'widget_logic' );
        if ( isset( $widget_logic_options['widget_logic-options-filter'] ) && 'checked' == $widget_logic_options['widget_logic-options-filter'] ) {
            $widget_opt = get_option( $widget_obj['callback_wl_redirect'][0]->option_name );
        } else {
            $widget_opt = get_option( $widget_obj['callback'][0]->option_name );
        }

    // if Widget Context plugin is enabled, use it's callback
    } elseif ( in_array( 'widget-context/widget-context.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        $callback = isset($widget_obj['callback_original_wc']) ? $widget_obj['callback_original_wc'] : null;
        $callback = !$callback && isset($widget_obj['callback']) ? $widget_obj['callback'] : null;

        if ($callback && is_array($widget_obj['callback'])) {
            $widget_opt = get_option( $callback[0]->option_name );
        }
    }

    // Default callback
    else {
        // Check if WP Page Widget is in use
        $custom_sidebarcheck = get_post_meta( get_the_ID(), '_customize_sidebars' );
        if ( isset( $custom_sidebarcheck[0] ) && ( $custom_sidebarcheck[0] == 'yes' ) ) {
            $widget_opt = get_option( 'widget_'.get_the_id().'_'.substr($widget_obj['callback'][0]->option_name, 7) );
        }
        else {
            $widget_opt = get_option( $widget_obj['callback'][0]->option_name );
        }
    }



    if ( isset( $widget_opt[$widget_num]['device_visibility'] ) && !empty( $widget_opt[$widget_num]['device_visibility'] ) ){
        $params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['device_visibility']} ", $params[0]['before_widget'], 1 );
    }


    return $params;
}

add_filter( 'dynamic_sidebar_params', 'kjd_add_device_visibility' );

/* --------------------------------------------------
 Site logo
 ----------------------------------------------------*/
function kjd_header_content($header_contents, $logo_toggle, $logo, $custom_header){

    $heading = is_front_page() ? 'h1' : 'h2' ;
    $header_output = '';



    if($header_contents == 'widgets'){

        dynamic_sidebar('header_widgets');

    }else{
        $header_output .= '<div class="span12">';


            if($logo_toggle == 'text'){

                $header_output .= '<div class="header-wrapper">';
                    $header_output .= $custom_header;
                $header_output .= '</div>';

            }elseif($logo_toggle == 'logo' ){

                $header_output .= '<'.$heading.' class="span logo-wrapper">';
                    $header_output .= '<a href="'.get_bloginfo('url').' ">';
                        $header_output .= '<img src="'.$logo.'" alt=""/>';
                    $header_output .= '</a>';
                $header_output .= '</'.$heading.'>';

            }else{

                $header_output .= '<div class="jumbotron no-background">';
                $header_output .= '<'.$heading.' class="logo-wrapper" >';
                    $header_output .= '<a href="'.get_bloginfo('url').' ">';
                        $header_output .= get_bloginfo( 'name');
                    $header_output .= '</a>';
                $header_output .= '</'.$heading.'>';
                    $header_output .= '<div class="logo-wrapper">'.get_bloginfo('description').'</div>';
                $header_output .= '</div>';

            }


        $header_output .= '</div>';
        echo $header_output;
     }

}

/* --------------------------------------------------
  create a default navbar if no menu is selected
 --------------------------------------------------------*/
function kjd_empty_nav_fallback_callback( $args ) {
    if ( ! isset( $args['show_home'] ) )

        $args['show_home'] = true;

    return $args;
}


/**
 * Adds body classes to page
 * @param  array $classes the body class
 * @return array          the appended array of classes
 */
function kjd_add_body_class( $classes ){

    $classes = array();

    $navbar_settings = get_option('kjd_navbar_misc_settings');
    $navbar_settings = $navbar_settings['kjd_navbar_misc'];
    $navbar_position = $navbar_settings['navbar_position'];

    $mobile_nav_settings = get_option('kjd_mobileNav_misc_settings');
    $mobile_nav_settings = $mobile_nav_settings['kjd_mobileNav_misc'];
    $mobile_nav_position = $mobile_nav_settings['mobilenav_position'];

    if(is_front_page() ) {
        $classes[] = 'home';
    }elseif( is_page() ){
        $classes[] = get_page_template_slug();
    }

    if( is_user_logged_in() ){
        $classes[] = 'logged-in';
    }

    //navbar
    if( $navbar_position == 'fixed-top'){
        $classes[] = 'desktopnav-fixed-top';
    }elseif( $navbar_position == 'fixed-bottom'){
        $classes[] = 'desktopnav-fixed-bottom';
    }

    //mobilenav
    if( $mobile_nav_position == 'fixed-top'){
        $classes[] = 'mobilenav-fixed-top';
    }elseif( $mobile_nav_position == 'fixed-bottom'){
        $classes[] = 'mobilenav-fixed-bottom';
    }

    return $classes;
}
add_filter('body_class', 'kjd_add_body_class');



// old image grabber
function kjd_get_post_images($postID, $size = NULL) {

$attachments = get_children( array(
    'post_parent' => $postID,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'numberposts' => 999 )
);
    $images = array();
/* $images is now a object that contains all images (related to post id 1) and their information ordered like the gallery interface. */
    $attributes = array();
    if ( $attachments){
        //looping through the images
        foreach ( $attachments as $attachment => $att ) {

            $url = wp_get_attachment_image_src($attachment, 'thumbnail');
            $attributes['thumbnail']= $url[0];
            $url = wp_get_attachment_image_src($attachment, 'medium');
            $attributes['medium'] = $url[0];
            $url = wp_get_attachment_image_src($attachment, 'large');
            $attributes['large'] = $url[0];
            $url = wp_get_attachment_image_src($attachment, 'full');
            $attributes['full'] = $url[0];

            $attributes['image_id'] = $att->ID;
            $attributes['title'] = $att->post_title;
            $attributes['description'] = $att->post_content;
            $attributes['caption'] = $att->post_excerpt;
            $attributes['alt'] = $att->_wp_attachment_image_alt;
            array_push($images, $attributes);
        }
    }
    return $images;

}




function add_classes_to_linked_images($html) {
    $classes = 'link link--image'; // can do multiple classes, separate with space

    $patterns = array();
    $replacements = array();

    $patterns[0] = '/<a(?![^>]*class)([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor tag where anchor has no existing classes
    $replacements[0] = '<a\1 class="' . $classes . '"><img\2></a>';

    $patterns[1] = '/<a([^>]*)class="([^"]*)"([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor has existing classes contained in double quotes
    $replacements[1] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';

    $patterns[2] = '/<a([^>]*)class=\'([^\']*)\'([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor has existing classes contained in single quotes
    $replacements[2] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';

    $html = preg_replace($patterns, $replacements, $html);

    return $html;
}

add_filter('the_content', 'add_classes_to_linked_images', 100, 1);
