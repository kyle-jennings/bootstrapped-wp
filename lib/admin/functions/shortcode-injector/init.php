<?php

/**
 * The shortcode injector
 *
 * This module will add a button to tiny mce editor which inserts
 * customized shortcodes for bootstrap components into posts.
 *
 */



/**
 * Add the shortcode button to the editor
 */
function add_button() {

    if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') && get_user_option('rich_editing') == true )
    {
        add_filter('mce_external_plugins', 'add_plugin');
        add_filter('mce_buttons', 'register_button');
    }
}

/**
 * registers the button
 * @param  [type] $buttons [description]
 * @return [type]          [description]
 */
function register_button($buttons) {
    array_push($buttons,"|" ,"kjdShortCodeInjection");
    return $buttons;
}

/**
 * adds the actual code
 * @param [type] $plugin_array [description]
 */
function add_plugin($plugin_array) {
    $admin_dir = get_stylesheet_directory_uri().'/lib/admin';
    $mce_plugin_js = $admin_dir.'/functions/shortcode-injector/js/mcePlugin.js';

    $plugin_array['kjdShortCodeInjection'] = $mce_plugin_js;
    return $plugin_array;
}

// add the button
add_action('admin_init', 'add_button');
