<?php

/**
 * Get the wordpress root
 *
 * This allows the use wordpres functions inside the window
 */
if ( !defined('WP_LOAD_PATH') ) {

    /** classic root path if wp-content and plugins is below wp-config.php */
    // $root = dirname (dirname (dirname (dirname (dirname (dirname (__FILE__) ) ) ) ) );
    $root = dirname(__FILE__);

    while( !file_exists('wp-config.php') ){
        $root = dirname($root);

        if( file_exists($root.'/wp-config.php') ){
            define( 'WP_LOAD_PATH', $root);
            break;
        }
    }
}

require_once( WP_LOAD_PATH . '/wp-load.php');


$site_root = get_bloginfo('template_directory');
$site_url = get_option('siteurl');

// // check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') )
	wp_die(__("You must be logged in to do that."));