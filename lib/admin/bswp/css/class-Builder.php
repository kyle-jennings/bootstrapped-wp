<?php

namespace bswp\css;
use bswp\css\Background;

class Builder {

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
            $this->headings_settings($section);
            $this->images_settings($section);
            // $this->components_settings($section);
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

        $output .= $this->sections[$section]['text']->output;
        $output .= $this->sections[$section]['headings']->output;
        $output .= $this->sections[$section]['images']->output;


        $this->output .= $output;
    }


    public function background_settings($section){

        if(empty($this->saved_values[$section]['background']))
            return;

        $background_styles = new Background($this->saved_values[$section]['background']);
        $background_styles->colors();
        $background_styles->wallpaper();

        $background_styles->add_breaklines();
        $this->sections[$section]['background'] = $background_styles;
    }


    public function borders_settings($section){

        if(empty($this->saved_values[$section]['borders']))
            return;

        $borders_styles = new Borders($this->saved_values[$section]['borders']);
        $borders_styles->borders();
        $borders_styles->border_radii();
        $borders_styles->add_breaklines();
        $this->sections[$section]['borders'] = $borders_styles;
    }


    public function text_settings($section){

        if(empty($this->saved_values[$section]['text']))
            return;

        $text_styles = new Text($this->saved_values[$section]['text'], $section);
        $text_styles->links();
        $text_styles->add_breaklines();
        $this->sections[$section]['text'] = $text_styles;

    }


    public function headings_settings($section){

        if(empty($this->saved_values[$section]['headings']))
            return;

        $headings_styles = new Headings($this->saved_values[$section]['headings'], $section);
        $headings_styles->headings();

        $headings_styles->add_breaklines();

        $this->sections[$section]['headings'] = $headings_styles;

    }

    public function images_settings($section){
        if(empty($this->saved_values[$section]['images']))
            return;

        $images_styles = new Images($this->saved_values[$section]['images'], $section);
        $images_styles->image('inline');
        $images_styles->image('caption');
        $images_styles->image('linked');

        // examine($images_styles);
        $images_styles->add_breaklines();

        $this->sections[$section]['images'] = $images_styles;
    }

    public function components_settings($section){

        if(empty($this->saved_values[$section]['components']))
            return;

        $components_styles = new components($this->saved_values[$section]['components'], $section);

        // examine($components_styles);

        $tabbable = new tabbable($components_styles->tabbable(), $this->section);
        $tabbable->content_area_styles();
        $tabbable->tabs_left_right_content();

        $tabbable->tab_styles('active_tab');
        $tabbable->tab_styles('inactive_tab');
        $tabbable->tab_styles('hovered_tab');

        $tabbable->add_breaklines();
        // examine($tabbable);


        $collapsible = new collapsible($components_styles->collapsible(), $this->section);
        $collapsible->content_area_styles();
        $collapsible->title_styles('active_title');
        $collapsible->title_styles('inactive_title');
        $collapsible->title_styles('hovered_title');
        $collapsible->add_breaklines();

        // examine($collapsible);

        $components_styles->add_breaklines();

        $this->sections[$section]['components'] = $components_styles;

    }




    public function setting_settings(){

    }




}
