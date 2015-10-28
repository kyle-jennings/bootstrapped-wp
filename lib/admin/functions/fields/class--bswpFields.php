<?php

class bswpFields{

    public $section;
    public $settings = array();

    public function __construct(){
        $this->section = $_GET['section'] ? $_GET['section'] : 'theme_settings';
        $settings_array = $this->section.'_tabs';

        // get the fields file
        $theme_root = get_template_directory();
        $file = $theme_root.'/lib/admin/functions/fields/settings.php';
        include_once($file);

        $this->settings = $$settings_array;

    }


    public function get_field_settings(){

        return $this->settings;
    }

    public function register_section_settings(){

        $section = $this->section;
        $settings = $this->settings;
        // kjd($settings);

        foreach ($sections as $section){

                // add_settings_section(
                //     'kjd_'.$section.'_background_settings_section', // ID hook name
                //     'body settings', // label
                //     'kjd_'.$section.'_background_settings_callback', // function name
                //     'kjd_'.$section.'_background_settings' // page name
                // );


                // add_settings_field(
                //     'kjd_'.$section.'_background_'.$setting, // ID hook name
                //     null,
                //     null,
                //     'kjd_'.$section.'_background_settings', // page name
                //     'kjd_'.$section.'_background_settings_section' // parent section
                // );

                // register_setting('kjd_'.$section.'_background_settings','kjd_'.$section.'_background_settings');
        }
    }

}