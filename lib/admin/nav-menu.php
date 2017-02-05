<?php

use Cascade\Section;

function add_cascade_menu(){
    add_menu_page(
        'Cascade', //title (title tags)
        'Cascade', // menu title (label)
        'manage_options', // user caps
        'cascade_settings', // slug
        'cascade_admin_display', // function
        'dashicons-admin-customizer' // icon
    );

    add_submenu_page(
        'cascade_settings', // parent slug
        'Body Settings', // title (title tag)
        'Body Settings', // menu label
        'manage_options',  // user caps
        'cascade_settings&section=body', //  menu slug
        'cascade_admin_display' // function
    );
}

add_action('admin_menu', 'add_cascade_menu');


function cascade_admin_display() {
    echo "<h1>Home</h1>";

    include('settings/body-settings.php');
    $section_fields = $fields;
    $section = new Section();

    examine($section);
}
