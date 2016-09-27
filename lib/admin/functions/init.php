<?php

use bswp\fields\settings;

function bswp_admin_body_class( $classes ) {
    return 'bswp';
}
add_filter( 'admin_body_class', 'bswp_admin_body_class' );


add_action('admin_init', array(new settings, 'register_section_settings'));


include($theme_root.'/lib/admin/functions/live-preview.php');
