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

            $this->background_settings($section);
            $this->borders_settings($section);
            $this->text_settings($section);

            // $selector = str_replace('_settings','-section', $section);
            // $this->create_section_element($section, $selector);

        }
    }


    public function create_section_element($section, $selector){
        $output = '';
        $output .= '#'.$selector. ' {';

            $output .= $this->sections[$section]['text']->text_color;
            $output .= $this->sections[$section]['background']->output;
            $output .= $this->sections[$section]['borders']->output;

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
        $this->sections[$section]['background'] = $background_styles;
    }


    public function borders_settings($section){

        if(empty($this->saved_values[$section]['borders']))
            return;

        $borders_styles = new borders($this->saved_values[$section]['borders']);
        $borders_styles->borders();
        $borders_styles->border_radii();
        $borders_styles->add_breaklines();
        $this->sections[$section]['borders'] = $borders_styles;
    }


    public function text_settings($section){

        if(empty($this->saved_values[$section]['text']))
            return;

        $text_styles = new text($this->saved_values[$section]['text'], $section);
        $text_styles->links();
        $text_styles->add_breaklines();
        $this->sections[$section]['text'] = $text_styles;

    }


    public function headings_settings(){

    }


    public function components_settings(){

    }


    public function images_settings(){

    }


    public function setting_settings(){

    }




}
