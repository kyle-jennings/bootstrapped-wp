<?php

class fieldsClass{

    public $background_fields = array();
    public $borders_fields = array();
    public $headings_fields = array();
    public $text_fields = array();
    public $components_fields = array();
    public $images_fields = array();

    public $all_sections_settings = array();
    public $section_settings = array();

    public function __construct(){

        $theme_root = get_template_directory();
        $file = $theme_root.'/lib/admin/functions/fields/settings.php';
        include_once($file);

        $this->background_fields = $background_fields;
        $this->borders_fields = $borders_fields;
        $this->headings_fields = $headings_fields;
        $this->text_fields = $text_fields;
        $this->components_fields = $components_fields;
        $this->images_fields = $images_fields;

        $this->all_sections_settings = array(
            'theme_settings'=>$theme_settings,
            'header_settings'=>$header_settings,
            'navbar_settings'=>$navbar_settings,
            'nav_dropdown_settings'=>$nav_dropdown_settings,
            'mobile_nav_settings'=>$mobile_nav_settings,
            'page_title_settings'=>$page_title_settings,
            'body_settings'=>$body_settings,
            'feed_settings'=>$feed_settings,
            'footer_settings'=>$footer_settings,
        );
    }


    public function set_section_settings($section = null){

        if($section == null)
            return;

        $this->section_settings = $this->all_sections_settings[$section];
        unset($this->all_sections_settings);
    }


    public function get_section_settings($section){
        $fields = array(
            $borders_fields = $this->borders_fields,
            $headings_fields = $this->headings_fields,
            $text_fields = $this->text_fields,
            $components_fields = $this->components_fields,
            $images_fields = $this->images_fields,
            $settings = $this->$section_settings,
        );
    }

}