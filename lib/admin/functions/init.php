<?php

use bswp\settings;
$section = new settings\Section;
add_action('admin_init', array($section, 'register_section_settings'));



function bswp_admin_body_class( $classes ) {
    return 'bswp';
}
add_filter( 'admin_body_class', 'bswp_admin_body_class' );


// add_action('admin_init', array($settings, 'build_css'));
include('live-preview.php');
