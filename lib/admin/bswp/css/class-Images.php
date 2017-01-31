<?php

namespace bswp\css;

class Images {

    public $section;

    public $linked_images_border_color;
    public $linked_images_hover_glow;
    public $linked_images_hover_glow_rgba;
    public $linked_images_border_style;
    public $linked_images_border_width;
    public $linked_images_border_radius;

    public $inline_images_border_color;
    public $inline_images_hover_glow;
    public $inline_images_hover_glow_rgba;
    public $inline_images_border_style;
    public $inline_images_border_width;
    public $inline_images_border_radius;

    public $caption_images_border_color;
    public $caption_images_hover_glow;
    public $caption_images_hover_glow_rgba;
    public $caption_images_border_style;
    public $caption_images_border_width;
    public $caption_images_border_radius;
    public $caption_images_text_color;
    public $caption_images_background_color;
    public $caption_images_background_color_rgba;

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



    public function get_target_element($target){
        switch($target):
            case 'inline':
                return 'img';
                break;
            case 'linked':
                return 'a.link--image img';
                break;
            case 'caption':
                return '.wp-caption';
                break;
        endswitch;
    }

    public function image($target = null){

        if(empty($this->section) || empty($target))
            return false;

        $this->set_defaults($target);

        $shortnames = $this->get_shortnames($target);
        extract($shortnames);

        $output = '';
        $element = $this->get_target_element($target);

        // only captions have backgrounds and text
        if($target == 'caption'){
            $output .= $this->background_styles($background_color_rgba);
            $output .= $this->text_color($text_color);
        }

        // everything has border and border radius options
        $output .= $this->border_styles($border_style, $border_width, $border_color);
        $output .= $this->border_radius($border_radius);


        // wrap up the styles
        $output = $this->wrapper($output, $element);
        $output .= $this->glow_styles($true_glow_rgba, $element);

        $this->output .=  $output;

    }

    public function background_styles($background_color_rgba){
        $output = '';

        if($this->$background_color_rgba != 'transparent')
            $output .= 'background-color: '.$this->$background_color_rgba.';';

        return $output;
    }


    public function border_styles($border_style, $border_width, $border_color){

        $output = '';
        if(
            $this->$border_style !== 'none' &&
            $this->$border_width !== '0' &&
            $this->$border_color !== 'transparent'
        ){

            $output .= 'border:';
                $output .= $this->$border_style . ' ';
                $output .= $this->$border_width . ' ';
                $output .= $this->$border_color;
            $output .= ';';

        }

        return $output;
    }


    public function text_color($text_color){
        $output = '';

        if($this->$text_color)
            $output .= 'color: '.$this->$text_color.';';

        $output;
    }


    public function border_radius($border_radius){
        $output = '';

        if($this->$border_radius)
            $output .= 'border-radius:'.$this->$border_radius.';';

        return $output;
    }


    public function wrapper($output, $element){
        return "\n#".$this->section .' '. $element.'{ '."\n". $output .'}';
    }


    public function glow_styles($true_glow_rgba, $element){

        $output = '';

        if($this->$true_glow_rgba != 'transparent'){
            $output .= "\n#".$this->section .' '. $element.':hover{';
                $output .= 'box-shadow: 0 2px 2px rgba(0, 0, 0, 0.075) inset, 0 0 2px '.$this->$true_glow_rgba.' ;';
            $output .= '}';
        }

        return $output;
    }



    public function set_defaults($target){

        $shortnames = $this->get_shortnames($target);
        extract($shortnames);

        $this->$true_glow = !empty( $this->$true_glow) ? $this->$true_glow : 'transparent' ;
        $this->$true_glow_rgba = !empty( $this->$true_glow_rgba) ? $this->$true_glow_rgba : $this->$true_glow ;

        $this->$border_style = !empty($this->$border_style) ? $this->$border_style : 'none' ;
        $this->$border_width = !empty($this->$border_width) ? $this->$border_width : '0' ;
        $this->$border_color = !empty($this->$border_color) ? $this->$border_color : 'transparent' ;

        $this->$border_radius = !empty($this->$border_radius) ? $this->$border_radius : '0' ;

        if($target == 'caption'){

            $this->$background_color = !empty( $this->$background_color) ? $this->$background_color : 'transparent' ;
            $this->$background_color_rgba = !empty( $this->$background_color_rgba) ? $this->$background_color_rgba : $this->$background_color ;
        }
    }


    private function get_shortnames($target){

        $shortnames = array(

            'border_style' => $target.'_images_border_style',
            'border_width' => $target.'_images_border_width',
            'border_color' => $target.'_images_border_color',
            'border_radius' => $target.'_images_border_radius',
            'true_glow' => $target.'_images_hover_glow',
            'true_glow_rgba' => $target.'_images_hover_glow_rgba',
        );

        if($target == 'caption'){

            $shortnames['text_color'] = $target.'_images_text_color';
            $shortnames['background_color'] = $target.'_images_background_color';
            $shortnames['background_color_rgba'] = $target.'_images_background_color_rgba';


        }

        return $shortnames;
    }

}
