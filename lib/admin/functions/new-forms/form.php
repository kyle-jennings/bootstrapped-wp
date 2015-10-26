<?php

    $page = $_GET['page'] ? $_GET['page'] : null;
    $section =  $_GET['section'] ? $_GET['section'] : null;
    $tab =  $_GET['tab'] ? $_GET['tab'] : null;

    $current_view = $section;

    $bswp_nav = new bswpNav;
    $bswp_nav->tabs_nav($active_tab, 'theme');
    $bswp_nav->sections_dropdown_nav();


    $fields = new fieldsClass;
    $fields->init('theme');

    // kjd_examine($fields);

    $form = new bswpFieldGenerators;
    settings_errors();

    $prop = 'background_fields';
    echo $form->init($fields->$prop);