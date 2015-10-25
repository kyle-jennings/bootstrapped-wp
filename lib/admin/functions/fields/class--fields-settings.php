<?php

class fieldsClass{

    public $background_fields = array();
    public $borders_fields = array();
    public $headings_fields = array();
    public $text_fields = array();
    public $components_fields = array();
    public $images_fields = array();

    public $section_settings = array();

    public function __construct(){

        $theme_root = get_template_directory();
        $file = $theme_root.'/lib/admin/functions/fields/settings.php';
        include($file);

        $this->background_fields = $background_fields;
        $this->borders_fields = $borders_fields;
        $this->headings_fields = $headings_fields;
        $this->text_fields = $text_fields;
        $this->components_fields = $components_fields;
        $this->images_fields = $images_fields;

    }

    public function set_section_settings($section){

    }

}