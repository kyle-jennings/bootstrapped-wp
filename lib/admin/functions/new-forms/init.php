<?php

$theme_root = get_template_directory();
include($theme_root.'/lib/admin/functions/fields/class--bswpFields.php');


$field_settings = new bswpFields;

function bswp_register_field_settings($field_groups, $section, $setting){

    // loop through each tab
    foreach($field_groups as $field_group){
        $fields = $field_group['fields'];

        // Ugh nested for loop. its not the worst here
        // get teh fields from each tab
        foreach($fields as $field){

          add_settings_field(
                'bswp_'.$section.'_'.$setting.'_'.$field['name'], // ID hook name
                null,
                null,
                'bswp_'.$section, // page name
                'bswp_'.$section.'_'.$setting.'_section' // parent section
            );
        }
    }

}

function bswp_save_field_sections(){

    global $field_settings;

    $section = $field_settings->section;
    $settings_groups = $field_settings->settings;

    foreach ($settings_groups as $settings){
        $setting = $settings['section'];
        $field_groups = $settings['tabs'];

        add_settings_section(
            'bswp_'.$section.'_'.$setting.'_section', // ID hook name
            $setting.' settings', // label
            null, // function name
            'bswp_'.$section // page name
        );

        // now set the field settings
        bswp_register_field_settings($field_groups, $section, $setting);


        register_setting(
            'bswp_'.$section,
            'bswp_'.$section
        );
    }

}

add_action('admin_init', 'bswp_save_field_sections');
include($theme_root.'/lib/admin/functions/live-preview.php');

include('class--bswpForm.php');
include('class--bswpNav.php');