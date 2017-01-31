<?php

use bswp\fields\settings;

function bswp_admin_body_class( $classes ) {
    return 'bswp';
}
add_filter( 'admin_body_class', 'bswp_admin_body_class' );

$settings = new settings;
add_action('admin_init', array($settings, 'register_section_settings'));
add_action('admin_init', array($settings, 'build_css'));



include('live-preview.php');
