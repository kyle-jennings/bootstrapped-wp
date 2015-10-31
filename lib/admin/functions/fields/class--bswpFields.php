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

                // add_settings_section(
                //     'kjd_'.$section.'_'.$setting['section'].'_settings_section', // ID hook name
                //     'body settings', // label
                //     'kjd_'.$section.'_'.$setting['section'].'_settings_callback', // function name
                //     'kjd_'.$section.'_'.$setting['section'].'_settings' // page name
                // );


                // add_settings_field(
                //     'kjd_'.$section.'_'.$setting['section'].'_'.$setting, // ID hook name
                //     null,
                //     null,
                //     'kjd_'.$section.'_'.$setting['section'].'_settings', // page name
                //     'kjd_'.$section.'_'.$setting['section'].'_settings_section' // parent section
                // );

                // register_setting(
                //     'kjd_'.$section.'_'.$setting['section'].'_settings',
                //     'kjd_'.$section.'_'.$setting['section'].'_settings'
                // );
        }
    }

}