<?php

// forms
include 'display_settings.php';
include 'general_settings_form.php';
include 'page_layouts_form.php';
include 'misc_backgrounds_form.php';



// makes new menu
function kjd_setup_theme_menus() {

    $options = get_option('kjd_component_settings');
    $mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
    $mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];
    $override_nav = $mobileNavSettings['override_nav'];


    add_menu_page(
        'Theme settings', //title bar
        'BSWP Home', // menu bar title
        'manage_options',  //member access
        'kjd_theme_settings', // id for menu
        'kjd_theme_settings_display', //function
        null,
        null
    );
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'General Settings', // title bar
        'General Settings', // menu title
        'manage_options',   //member access
        'kjd_theme_settings', // id for submenu
        'kjd_theme_settings_display' //function
    );

        // customize header
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize Header', // title bar
        'Header area', // menu title
        'manage_options',   //member access
        'kjd_header_settings', // id for submenu
        create_function('', 'kjd_settings_display("header");')
    );

        // customize navbar
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize Navigation', // title bar
        'Navbar area', // menu title
        'manage_options',   //member access
        'kjd_navbar_settings', // id for submenu
        create_function('', 'kjd_settings_display("navbar");')
    );

    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Navbar Submenus', // title bar
        'Navbar submenus', // menu title
        'manage_options',   //member access
        'kjd_dropdown-menu_settings', // id for submenu
        create_function('', 'kjd_settings_display("dropdown-menu");')
    );

    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Mobile Nav', // title bar
        'Mobile Nav', // menu title
        'manage_options',   //member access
        'kjd_mobileNav_settings', // id for submenu
        create_function('', 'kjd_settings_display("mobileNav");')
    );

    if( $override_nav == 'true') {

        $mobilenav_style = $mobileNavSettings['mobilenav_style'];
        add_submenu_page(
            'kjd_theme_settings',   // belongs to id
            'Side Drawer', // title bar
            'Side Drawer', // menu title
            'manage_options',   //member access
            'kjd_sidr_settings', // id for submenu
            create_function('', 'kjd_settings_display("sidr");')
            );
    }


        // customize cycler
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize Frontpage Image Banner', // title bar
        'Image Banner', // menu title
        'manage_options',   //member access
        'kjd_cycler_settings', // id for submenu
        create_function('', 'kjd_settings_display("cycler");')
    );

        // customize title area
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize Title Area', // title bar
        'Title Area', // menu title
        'manage_options',   //member access
        'kjd_pageTitle_settings', // id for submenu
        create_function('', 'kjd_settings_display("pageTitle");')
    );

        // customize body
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize Body', // title bar
        'Body', // menu title
        'manage_options',   //member access
        'kjd_body_settings', // id for submenu
        create_function('', 'kjd_settings_display("body");')
    );


    // customize post
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize Post Contents', // title bar
        'Post Contents', // menu title
        'manage_options',   //member access
        'kjd_posts_settings', // id for submenu
        create_function('', 'kjd_settings_display("posts");')
    );


    if($options['style_widgets'] =='true'){
        // customize post
        add_submenu_page(
            'kjd_theme_settings',   // belongs to id
            'Sidebar Widgets', // title bar
            'Sidebar Widgets', // menu title
            'manage_options',   //member access
            'kjd_widgets_settings', // id for submenu
            create_function('', 'kjd_settings_display("widgets");')
        );

        add_submenu_page(
            'kjd_theme_settings',   // belongs to id
            'Horizontal Widgets', // title bar
            'Horizontal Widgets', // menu title
            'manage_options',   //member access
            'kjd_horizontalWidgets_settings', // id for submenu
            create_function('', 'kjd_settings_display("horizontalWidgets");')
        );
    }
        // customize footer
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize Footer', // title bar
        'Footer', // menu title
        'manage_options',   //member access
        'kjd_footer_settings', // id for submenu
        create_function('', 'kjd_settings_display("footer");')
    );

    // customize login page
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize Login Page', // title bar
        'Login Page', // menu title
        'manage_options',   //member access
        'kjd_login_settings', // id for submenu
        create_function('', 'kjd_settings_display("login");')
    );

// customize login page
    add_submenu_page(
        'kjd_theme_settings',   // belongs to id
        'Customize misc backgounds', // title bar
        'Special Backgrounds', // menu title
        'manage_options',   //member access
        'kjd_misc_background_settings', // id for submenu
        'kjd_misc_backgrounds_display'
    );

        // page layouts
    add_submenu_page(
        'kjd_theme_settings',  //belongs to id
        'Page layouts', //title bar
        'Page Layouts', // menu title
        'manage_options',   //member access
        'kjd_page_layout_settings', //id for submenu
        'kjd_page_layout_settings_display'//function
    );

}

add_action("admin_menu", "kjd_setup_theme_menus");