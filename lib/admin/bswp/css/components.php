<?php

namespace bswp\css;

class components {

    public $section;

    public $output = '';

    // magic methods

    public function __construct( $args = array(), $section ){

        $this->section = $section;

        if(!is_array($args))
            return false;

        $this->set_values($args);

    }

    public function __toString(){
        return $this->output;
    }

    // custom methods

    public function add_breaklines(){

        $first_char = $this->output[0];
        $this->output = "\n\t".$this->output;
        $this->output = str_replace(';', "; \n\t", $this->output);
        $this->output = rtrim($this->output, "\t");
    }


    public function set_values($args = array()){


        if( empty($args) )
            return false;

        foreach($args as $k=>$v){
            $this->$k = $v;
        }

    }

    public function tabbable(){
        $args = array(
            'tabbed_content_background' => $this->tabbed_content_background,
            'tabbed_content_background_rgba' => $this->tabbed_content_background_rgba,
            'tabbed_content_border' => $this->tabbed_content_border,
            'tabbed_content_text_color' => $this->tabbed_content_text_color,
            'tabbed_content_link_color' => $this->tabbed_content_link_color,

            'tabbed_active_tab_border' => $this->tabbed_content_border,
            'tabbed_active_tab_background' => $this->tabbed_content_background,
            'tabbed_active_tab_background_rgba' => $this->tabbed_content_background_rgba,
            'tabbed_active_tab_link_color' => $this->tabbed_content_link_color,

            'tabbed_inactive_tab_border' => $this->tabbed_inactive_tab_border,
            'tabbed_inactive_tab_background' => $this->tabbed_inactive_tab_background,
            'tabbed_inactive_tab_background_rgba' => $this->tabbed_inactive_tab_background_rgba,
            'tabbed_inactive_tab_link_color' => $this->tabbed_inactive_tab_link_color,

            'tabbed_hovered_tab_background' => $this->tabbed_hovered_tab_background,
            'tabbed_hovered_tab_background_rgba' => $this->tabbed_hovered_tab_background_rgba,
            'tabbed_hovered_tab_border' => $this->tabbed_hovered_tab_border,
            'tabbed_hovered_tab_link_color' => $this->tabbed_hovered_tab_link_color,
        );

        return $args;
    }


    public function collapsible (){
        $args = array(
            'collapsible_content_background' => $this->collapsible_content_background,
            'collapsible_content_background_rgba' => $this->collapsible_content_background_rgba,
            'collapsible_content_border' => $this->collapsible_content_border,
            'collapsible_content_text_color' => $this->collapsible_content_text_color,
            'collapsible_content_link_color' => $this->collapsible_content_link_color,

            'collapsible_active_tab_border' => $this->collapsible_active_tab_border,
            'collapsible_active_tab_background' => $this->collapsible_active_tab_background,
            'collapsible_active_tab_background_rgba' => $this->collapsible_active_tab_background_rgba,
            'collapsible_active_tab_link_color' => $this->collapsible_active_tab_link_color,

            'collapsible_inactive_tab_border' => $this->collapsible_inactive_tab_border,
            'collapsible_inactive_tab_background' => $this->collapsible_inactive_tab_background,
            'collapsible_inactive_tab_background_rgba' => $this->collapsible_inactive_tab_background_rgba,
            'collapsible_inactive_tab_link_color' => $this->collapsible_inactive_tab_link_color,

            'collapsible_hovered_tab_background' => $this->collapsible_hovered_tab_background,
            'collapsible_hovered_tab_background_rgba' => $this->collapsible_hovered_tab_background_rgba,
            'collapsible_hovered_tab_border' => $this->collapsible_hovered_tab_border,
            'collapsible_hovered_tab_link_color' => $this->collapsible_hovered_tab_link_color,
        );

        return $args;
    }
}
