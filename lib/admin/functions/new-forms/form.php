<?php
    //
    // $css_builder_dir = dirname( dirname(__FILE__) ).'/css-builder/';
    // $css_builder_file = 'class--css-builder.php';
    // include_once($css_builder_dir . $css_builder_file);
    // $builder = new bswpBuildCSS;


    // set up the fields
    $field_settings = $GLOBALS['bswpFields'];

    // get the current section, settings tab, and sub settings
    $bswp_nav = new bswpNav;
    $form = new bswpform;

    // get the fields
    $fields = $field_settings->get_field_settings();

    settings_errors();
    echo $bswp_nav->tabs_nav($fields);
    echo $form->init($fields);