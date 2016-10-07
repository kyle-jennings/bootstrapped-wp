<?php

namespace bswp\css;

class tabbable {
    public $tabbed_content_background;
    public $tabbed_content_background_rgba;
    public $tabbed_content_border;
    public $tabbed_content_text_color;
    public $tabbed_content_link_color;

    public $tabbed_active_tab_border;
    public $tabbed_active_tab_background;
    public $tabbed_active_tab_background_rgba;
    public $tabbed_active_tab_link_color;

    public $tabbed_inactive_tab_border;
    public $tabbed_inactive_tab_background;
    public $tabbed_inactive_tab_background_rgba;
    public $tabbed_inactive_tab_link_color;

    public $tabbed_hovered_tab_background;
    public $tabbed_hovered_tab_background_rgba;
    public $tabbed_hovered_tab_border;
    public $tabbed_hovered_tab_link_color;

    public $parts;
    public $section;

    public $output = '';

    // magic methods

    public function __construct( $args = array(), $section ){

        $this->section = $section;
        $this->parts = array('content', 'inactive_tab', 'hovered_tab');
        if(!is_array($args))
            return false;

        $this->set_values($args);
        $this->set_defaults();
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



    private function set_defaults(){
        //active tab and content area

        foreach($this->parts as $part){

            $background = 'tabbed_'.$part.'_background';
            $background_rgba = 'tabbed_'.$part.'_background_rgba';
            $border_color = 'tabbed_'.$part.'_border';
            $text_color = 'tabbed_'.$part.'_text_color';
            $link_color = 'tabbed_'.$part.'_link_color';

            $this->$background = !empty($this->$background) ? $this->$background : null;
            $this->$background_rgba = !empty($this->$background_rgba) ? $this->$background_rgba : $this->$background;
            $this->$border_color = !empty($this->$border_color) ? $this->$border_color : $this->$background_rgba;

            $this->$link_color = !empty($this->$link_color) ? $this->$link_color : null;

            if($part == 'content')
                $this->$text_color = !empty($this->$text_color) ? $this->$text_color : null;

        }

        $this->tabbed_active_tab_background = $this->tabbed_active_tab_background;
        $this->tabbed_active_tab_background_rgba = $this->tabbed_content_background_rgba;
        $this->tabbed_active_tab_border = $this->tabbed_content_border;
        $this->tabbed_active_tab_link_color = $this->tabbed_content_link_color;

    }


    public function content_area_styles(){

        $output = '';

        // setup defaults
        $content_background = $this->tabbed_content_background_rgba;
        $content_border = $this->tabbed_content_border;
        $content_text = $this->tabbed_content_text_color;
        $content_link = $this->tabbed_content_link_color;


        // the active tab SHOULD match the content area styles tbh, so this should
        // be killed in the future, but this is a lift and shift

        if( empty($content_background) &&
            empty($content_border) &&
            empty($content_text)
        )
        return;


        // the content area
        $output .= $section.' .tabbable > .tab-content {';
            if(!empty($content_background))
                $output .= 'background:'. $content_background.'; ';
            if(!empty($content_border))
                $output .= 'border-color:'. $content_border.'; ';
            if(!empty($content_text))
                $output .= 'color:'. $content_text.';';

            $output .= 'border-style: solid; border-width: 1px; padding:20px;';
        $output .= '}';

        if(!empty($content_link)){
            $output .= $section.' .tabbable > .tab-content a{';
                $output .= $content_link;
            $output .= '}';
        }

        $this->output .= $output;
    }



    public function tab_styles($target){


        $background_rgba = 'tabbed_'.$target.'_background_rgba';
        $border_color = 'tabbed_'.$target.'_border';
        $link_color = 'tabbed_'.$target.'_link_color';

        $background_rgba = $this->$background_rgba;
        $border_color = $this->$border_color;
        $link_color = $this->$link_color;

        $selector = $this->get_tab_selector($target);
        if($selector == false)
            return;


        // the active tab SHOULD match the content area styles tbh, so this should
        // be killed in the future, but this is a lift and shift

        if( empty($background_rgba) &&
            empty($border_color) &&
            empty($link_color)
        )
        return;

        $output = '';
        $output .= $selector . ' {';
            if(!empty($background_rgba))
            $output .= 'background:'. $background_rgba.';';
            if(!empty($border_color)){
                $output .= 'border-color:'. $border_color.'; ';
                $output .= 'border-bottom-color: '. $background_rgba.' ; ';
            }
            if(!empty($link_color))
                $output .= 'color:'. $link_color.';';

        $output .= '}';

        $tab_pos = array('tabs-left' => 'right', 'tabs-right' => 'left', 'tabs-below' =>'top');
        foreach( $tab_pos as $position=>$opposite){

            $opp_border = $target == 'active_tab' ? $this->tabbed_content_background_rgba : $this->tabbed_content_border;

            $selector = $this->get_tab_selector($target, $position);
            $output .= $selector . ' {';

                if(!empty($border_color))
                    $output .= 'border-color:'.$border_color.';';

                $output .= 'border-'.$opposite.'-color:'. $opp_border.'; ';
            $output .= '}';
        }


        $this->output .= $output;
    }

    public function tabs_left_right_content(){
        $output = '';

        $output .= $this->section.' .tabs-left .tab-content{';
            $output .= 'border-radius: 4px;';
            $output .= 'border-top-left-radius: 0;';
        $output .= '}';

        $output .= $this->section.' .tabs-right .tab-content{';
            $output .= 'border-radius: 4px;';
            $output .= 'border-top-right-radius: 0;';
        $output .= '}';

        $this->output .= $output;
    }


    public function get_tab_selector($target, $direction = 'tabbable'){
        switch($target):
            case 'active_tab':
                return $this->section.' .'.$direction.' > ul.nav > li.active > a';
                break;
            case  'inactive_tab':
                return $section.' .'.$direction.' > ul.nav > li > a';
                break;
            case 'hovered_tab':
                return $this->section.' .'.$direction.' > ul.nav > li > a:hover';
                break;
        endswitch;

        return false;
    }
}
