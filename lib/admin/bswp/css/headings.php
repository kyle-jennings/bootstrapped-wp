<?php

namespace bswp\css;


class headings {

    public $section;
    public $headings;


    public $h1_color;
    public $h1_background_style;
    public $h1_background_color;
    public $h1_background_color_rgba;
    public $h1_text_decoration;
    public $h1_text_shadow;
    public $h2_color;
    public $h2_background_style;
    public $h2_background_color;
    public $h2_background_color_rgba;
    public $h2_text_decoration;
    public $h2_text_shadow;
    public $h3_color;
    public $h3_background_style;
    public $h3_background_color;
    public $h3_background_color_rgba;
    public $h3_text_decoration;
    public $h3_text_shadow;
    public $h4_color;
    public $h4_background_style;
    public $h4_background_color;
    public $h4_background_color_rgba;
    public $h4_text_decoration;
    public $h4_text_shadow;
    public $h5_color;
    public $h5_background_style;
    public $h5_background_color;
    public $h5_background_color_rgba;
    public $h5_text_decoration;
    public $h5_text_shadow;

    public $h6_color;
    public $h6_background_style;
    public $h6_background_color;
    public $h6_background_color_rgba;
    public $h6_text_decoration;
    public $h6_text_shadow;


    public $output = '';

    // magic methods

    public function __construct( $args = array(), $section = null){

        if(!is_array($args) || empty($section))
            return false;

        $this->headings = range(1,6);
        $this->section = $section;
        $this->set_values($args);
        $this->set_default_heading_values();
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

    public function set_default_heading_values(){

        $defaults = array(
            'h1_color'=> '#000',
            'h1_background_style' => 'none',
            'h1_background_color' => null,
            'h1_text_decoration' => 'none',
            'h1_text_shadow' => null
        );

        foreach($defaults as $k=>$v){
            $this->$k = !empty($this->$k) ? $this->$k : $v;
        }

    }


    public function headings(){

        if(empty($this->section))
            return false;

        foreach($this->headings as $heading){

            $this->set_heading_defaults($heading);

            $output = '';
            $output .= $this->color($heading);
            $output .= $this->background_style($heading);
            $output .= $this->text_decoration($heading);

            $output = "\n#".$this->section .' h'.$heading.'{ '."\n". $output .'}';
            $this->output .= $output;

        }


    }


    public function set_heading_defaults($heading){
        $output = '';

        $defaults = array(
            '_color',
            '_background_style',
            '_background_color',
            '_text_decoration',
            '_text_shadow',
        );

        foreach($defaults as $k){
            $target = 'h'.$heading.$k;
            $default = 'h1'.$k;
            $this->$target = !empty($this->$target) ? $this->$target : $this->$default;
        }


    }



    public function color($heading){
        $color = 'h'.$heading.'_color';
        return 'color: '.$this->$color.'; ';
    }


    public function text_decoration($heading){
        $decoration = 'h'.$heading.'_text_decoration';
        $shadow = 'h'.$heading.'_text_shadow';

        if( $this->$decoration == 'none' )
            return false;

        if( $this->$decoration == 'text-shadow' && !empty($this->$shadow))
            return 'text-shadow: 2px 2px 2px '.$this->$shadow.'; ';

        return 'text-decoration: '.$this->$decoration.'; ';

    }


    public function background_style($heading){

        $output = '';

        $style = 'h'.$heading.'_background_style';
        $bg_color = 'h'.$heading.'_background_color';
        $padding = '0 4px';

        if($this->$style == 'none' )
            return false;


        $output .= 'background: '.$this->$bg_color.'; ';
        $output .= 'padding: '.$padding.'; ';

        if($style == 'pills'){
            $output .= 'border-radius: 4px; ';
            $output .= 'word-break: hyphenate; ';
        }

        return $output;
    }


}
