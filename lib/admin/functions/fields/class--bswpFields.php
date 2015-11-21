<?php

class bswpFields{

    public $section;
    public $settings;

    public function __construct(){

        $this->section = $_GET['section'] ? $_GET['section'] : 'theme_settings';
        $this->section = isset($_GET['section']) ? $_GET['section'] : 'theme_settings';
        $settings_array = $this->section.'_tabs';

        // get the fields file
        $theme_root = get_template_directory();
        $file = $theme_root.'/lib/admin/functions/fields/settings.php';
        include_once($file);

        $this->settings = $$settings_array;

        $class = __CLASS__;
        if ( empty( $GLOBALS[ $class ] ) )
            $GLOBALS[ $class ] = $this;

    }


    public function get_field_settings(){

        return $this->settings;
    }

    public function register_section_settings(){

        $section = $this->section;
        $settings_groups = $this->settings;

        if(empty($settings_groups))
            return;

        foreach ($settings_groups as $settings){
            $setting = $settings['section'];
            $field_groups = $settings['tabs'];

            // kjd(
            //     "add_settings_section(
            //         'bswp_{$section}_{$setting}_section',
            //         '{$setting}_settings',
            //         null,
            //         'bswp_{$section}'
            //       )"
            // );

            add_settings_section(
                'bswp_'.$section.'_'.$setting.'_section', // ID hook name
                $setting.' settings', // label
                null, // function name
                'bswp_'.$section // page name
            );

            // now set the field settings
            $this->register_field_settings($field_groups, $section, $setting);

            // kjd("register_setting(
            //                 'bswp_{$section}_{$setting}',
            //                 'bswp_{$section}_{$setting}'
            //             )");

            register_setting(
                'bswp_'.$section,
                'bswp_'.$section
            );
        }
    }

    public function register_field_settings($field_groups, $section, $setting){

        // loop through each tab
        foreach($field_groups as $field_group){
            $fields = $field_group['fields'];

            // Ugh nested for loop. its not the worst here
            // get teh fields from each tab
            foreach($fields as $field){

             // kjd( "add_settings_field(
             //       'bswp_{$section}_{$setting}_{$field['name']}',
             //       null,
             //       null,
             //       'bswp_{$section}',
             //       'bswp_{$section}_{$setting}_section'
             //   );");

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
}