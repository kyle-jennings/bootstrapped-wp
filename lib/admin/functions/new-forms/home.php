<?php

    $bswp_nav = new bswpNav;
    $bswp_nav->tabs_nav($active_tab, 'theme');
    $bswp_nav->sections_dropdown_nav();

//    $fields = new fieldsClass;
    $form = new bswpBuildForm;
    kjd_examine($form);
    settings_errors();
    $prop = 'background_fields';
    // echo $form->init($prop);