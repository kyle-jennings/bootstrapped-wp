<?php

/**
 * Custom Excerpt Length
 */
function bswp_continue_reading_link() {
    return '<a href="'. esc_url( get_permalink() ) . '">' . __( '&hellip;', 'kjd_themestarter' ) . '</a>';
}


function bswp_excerpt_length() {
    error_log('22');
    return '10';
}

function bswp_auto_excerpt_more( $more ) {
    return bswp_continue_reading_link();
}

function bswp_custom_excerpt_more( $output ) {
    if ( has_excerpt() && !is_attachment() ) {
        $output .= bswp_continue_reading_link();
    }
    return $output;
}


if(get_option('rss_use_excerpt', true) == true) {

    add_filter( 'excerpt_length', 'bswp_excerpt_length' );
    add_filter( 'excerpt_more', 'bswp_auto_excerpt_more' );
    add_filter( 'get_the_excerpt', 'bswp_custom_excerpt_more' );
}
