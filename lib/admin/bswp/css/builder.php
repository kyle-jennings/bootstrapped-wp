<?php

namespace bswp\css;
use bswp\css\background;

class builder {

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

    public $saved_values = array();
    public $output = '';

    public function __construct(){

        foreach($this->sections as $section){
            $this->get_saved_values($section);
        }

    }

    public function add_breaklines(){

        $first_char = $this->output[0];
        $this->output = "\n".$this->output;
        $this->output = str_replace('}', "} \n", $this->output);
    }


    public function get_saved_values($section){
        $this->saved_values[$section] = get_option('bswp_'.$section);
    }


    public function init(){
        foreach($this->saved_values as $section => $group ){

            if(empty($this->saved_values[$section]))
                continue;

            $selector = str_replace('_settings','-section', $section);
            $this->create_section_element($section, $selector);

        }
    }


    public function create_section_element($section, $selector){
        $output = '';
        $output .= '#'.$selector. ' {';

            $output .= $this->background_settings($section);

        $output .= '}';

        $this->output .= $output;
    }

    public function background_settings($section){

        if(empty($this->saved_values[$section]['background']))
            return;

        $background_styles = new background($this->saved_values[$section]['background']);
        $background_styles->colors();
        $background_styles->wallpaper();

        $background_styles->add_breaklines();
        return $background_styles->output;
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




}
