<?php

class bswpFields{

    public $something;
    public $section_name;

    public $settings = array();
    public $section_settings = array();

    public function __construct($section){

        $this->section = $section;
        $settings_array = $section.'_tabs';

        // get the fields file
        $theme_root = get_template_directory();
        $file = $theme_root.'/lib/admin/functions/fields/settings.php';
        include_once($file);

        $this->settings['settings'] = $$settings_array;

    }


    public function get_field_settings(){

        return $this->settings['settings'];
    }


}