<?php

    // set up the fields
    $field_settings = new bswpFields();

    // get the current section, settings tab, and sub settings
    $bswp_nav = new bswpNav;


    $form = new bswpform;

    // get the fields
    $fields = $field_settings->get_field_settings();

    settings_errors();
    echo $bswp_nav->tabs_nav($fields);
    echo $form->init($fields);

    echo '<div class="preview-options">';
        echo kjd_site_preview();
    echo '</div>';