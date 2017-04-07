<?php

function bswp_add_assets(){

    //set tempplate root
    $root = get_bloginfo('template_directory');
    $wpcontent = dirname( ( dirname($root) ) );
    $root = $root.'/lib';


    wp_enqueue_script("jquery", $root."/scripts/jquery.js", false, null, false);

    wp_enqueue_script("bootstrap-dropdown", $root."/scripts/bootstrap/bootstrap-dropdown.js", false, null, true);
    wp_enqueue_script("bootstrap-carousel", $root."/scripts/bootstrap/bootstrap-carousel.js", false, null, true);
    wp_enqueue_script("bootstrap-collapse", $root."/scripts/bootstrap/bootstrap-collapse.js", false, null, true);
    // wp_enqueue_script("bootstrap-alert",    $root."/scripts/bootstrap/bootstrap-alerts.js",   false, null, true);
    wp_enqueue_script("bootstrap-trans",    $root."/scripts/bootstrap/bootstrap-transition.js", false, null, true);

    $component_options = get_option('bswp_site_settings');
    $component_options = $component_options['available_components']['components'];

    if($component_options['activate_tabs'])
        wp_enqueue_script("bootstrap-tab", $root."/scripts/bootstrap/bootstrap-tab.js", false, null, true);

    if($component_options['activate_tooltips'])
        wp_enqueue_script("bootstrap-tooltip", $root."/scripts/bootstrap/bootstrap-tooltip.js", false, null, true);

    if($component_options['activate_popovers'])
        wp_enqueue_script("bootstrap-popover", $root."/scripts/bootstrap/bootstrap-popover.js", false, null, true);


    wp_enqueue_script("site", $root."/scripts/application.js", 'jquery', null, true);

    // we might use this later...
    // $backup = wp_upload_dir()['baseurl'].'/bswp/assets/css/site.css';
    // if(is_readable($backup) )
    //     wp_enqueue_style("site", wp_upload_dir()['baseurl'].'/bswp/assets/css/site.css');
    // else{
        $css = get_option('css-url', true);
        wp_enqueue_style("site", $css['src']);
    // }

    wp_enqueue_style("base", $root."/styles/common.css");

}

add_action( 'wp_enqueue_scripts', 'bswp_add_assets' );
