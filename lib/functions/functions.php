<?php

function get_page_wrapper_class() {
    $site_options = get_option('bswp_site_settings');
    $misc_settings = $site_options['settings'];
    $page_wrapper_class = '';
    if($misc_settings['layout']['full_width'] == 'no')
        $page_wrapper_class = 'container';

    return $page_wrapper_class;
}


// main nav menu
register_nav_menus(
    array(
      'primary-menu' => __( 'Primary Nav' ),
    )
);


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

// add_filter( 'dynamic_sidebar_params', 'kjd_add_widget_style' );


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

// add_filter( 'dynamic_sidebar_params', 'kjd_add_device_visibility' );


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
    $classes[] = 'bswp-body';
    $id = get_queried_object_id();
    global $template;


    if(is_front_page() ) {
        $classes[] = 'frontpage';
    } elseif( $id == get_option('page_for_posts', true) ){
        $classes[] = 'posts-page';
        $classes[] = 'feed';
    } elseif(is_archive() ){
        $classes[] = 'feed';
    } elseif( is_page() || is_single() || is_singular() ){
        $classes[] = 'page';
        $classes[] = 'single';
        $classes[] = get_page_template_slug();
    }elseif( $id !== get_option('page_for_posts', true) && strpos($template, 'index') ) {
        $classes[] = 'frontpage';
    }


    if( is_user_logged_in() ){
        $classes[] = 'logged-in';

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
