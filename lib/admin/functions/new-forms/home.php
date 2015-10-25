<?php

    $bswp_nav = new bswpNav;
    $bswp_nav->tabs_nav($active_tab, 'theme');
    $bswp_nav->sections_dropdown_nav();

    $fields = new fieldsClass;
    $fields->set_section_settings('theme_settings');

    $form = new bswpFieldGenerators;
    settings_errors();

    $prop = 'background_fields';
    echo $form->init($fields->$prop);