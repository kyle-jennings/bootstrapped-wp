<?php 
add_action( 'wp_before_admin_bar_render', 'customize_admin_bar' );
function customize_admin_bar()
{
    global $wp_admin_bar;
    $wp_admin_bar->add_menu( array(
        'id' => 'kjd_settings',
        'parent' => false,
        'title' => 'KJD Settings',
        'href' => admin_url('admin.php?page=kjd_theme_settings'),
    ) );

    // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'general_settings',
        'parent' => 'kjd_settings',
        'title' => 'General Settings',
        'href' => admin_url('admin.php?page=kjd_theme_settings'),
    ) );


// Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'header_settings',
        'parent' => 'kjd_settings',
        'title' => 'Header Settings',
        'href' => admin_url('admin.php?page=kjd_header_settings'),
    ) );

    // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'navbar_settings',
        'parent' => 'kjd_settings',
        'title' => 'Navbar Settings',
        'href' => admin_url('admin.php?page=kjd_navbar_settings'),
    ) );

    // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'subnav_settings',
        'parent' => 'kjd_settings',
        'title' => 'Subnav Settings',
        'href' => admin_url('admin.php?page=kjd_dropdown-menu_settings'),
    ) );

        // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'image_cycler_settings',
        'parent' => 'kjd_settings',
        'title' => 'Image Cycler',
        'href' => admin_url('admin.php?page=kjd_cycler_settings'),
    ) );

        // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'title_area_settings',
        'parent' => 'kjd_settings',
        'title' => 'Title Area',
        'href' => admin_url('admin.php?page=kjd_pageTitle_settings'),
    ) );
        // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'body_settings',
        'parent' => 'kjd_settings',
        'title' => 'Body Area',
        'href' => admin_url('admin.php?page=kjd_body_settings'),
    ) );
        // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'footer_settings',
        'parent' => 'kjd_settings',
        'title' => 'Footer Area',
        'href' => admin_url('admin.php?page=kjd_footer_settings'),
    ) );
        // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'login_settings',
        'parent' => 'kjd_settings',
        'title' => 'Login Settings',
        'href' => admin_url('admin.php?page=kjd_login_settings'),
    ) );
            // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'misc_background_settings',
        'parent' => 'kjd_settings',
        'title' => 'Special Background',
        'href' => admin_url('admin.php?page=kjd_misc_background_settings'),
    ) );
            // Sub menu to open one of my plugins page
    $wp_admin_bar->add_menu( array(
        'id' => 'page_layout_settings',
        'parent' => 'kjd_settings',
        'title' => 'Page  Layouts',
        'href' => admin_url('admin.php?page=kjd_page_layout_settings'),
    ) );

}