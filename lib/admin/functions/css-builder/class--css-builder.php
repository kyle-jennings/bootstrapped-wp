<?php

class bswpBuildCSS {

    public $sections = array(
        'theme_settings',
        'header_settings',
        'navbar_settings',
        'nav_dropdown_settings',
        'mobile_nav_settings',
        'page_title_settings',
        'body_settings',
        'feed_settings',
        'footer_settings',
        'login_settings',
        'sidebar_settings',
        'layout_settings'
    );

    public $elements = array(
        'background',
        'borders',
        'headings',
        'text',
        'components',
        'images',
        'settings'
    );

    public $saved_values;
    public $file_output = '';

    public function __construct(){
        $sections =  $this->sections;
        foreach($sections as $section){
            $this->selector($section);
        }
    }


    public function background_settings($selector){


        if( empty($this->saved_values['background_start_color']) &&
            empty($this->saved_values['background_start_color_rgba']) &&
            empty($this->saved_values['background_end_color']) &&
            empty($this->saved_values['background_end_color_rgba']) &&
            empty($this->saved_values['background_gradient']) &&
            empty($this->saved_values['background_use_wallpaper']) &&
            empty($this->saved_values['background_image']) &&
            empty($this->saved_values['background_repeat']) &&
            empty($this->saved_values['background_attachment']) &&
            empty($this->saved_values['background_position']) &&
            empty($this->saved_values['background_positionX']) &&
            empty($this->saved_values['background_positionY']) &&
            empty($this->saved_values['background_size']) &&
            empty($this->saved_values['background_percentage'])
        )
            return '';

        $output .= '';
        $output .= $selector. ' {';

            if( !empty($this->saved_values['background_start_color']) ){
                if( empty($this->saved_values['background_start_color_rgba']) ){
                    $output .= 'background-color:'.$this->saved_values['background_start_color'].';';
                else
                    $output .= 'background-color:'.$this->saved_values['background_start_color_rgba'].';';
            }

        $output .= '}';

    }


    public function borders_settings(){
        $sides = array('top','right','bottom','left');
        $corners = array('top-right','bottom-right','bottom-left','top-left');

    }


    public function headings_settings(){

    }


    public function text_settings(){

    }


    public function components_settings(){

    }


    public function images_settings(){

    }


    public function setting_settings(){

    }


    public function selector($section){

        $this->saved_values = get_option('bswp_'.$section);
        $selector = str_replace('_settings','',$section);

        $this->file_output .= $this->background_settings($selector);

    }


}