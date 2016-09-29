<?php

namespace bswp\css;


class text {

    public $section;
    public $links = array('normal','hover','active', 'visited');

    public $text_color;

    public $normal_links_color;
    public $normal_links_background_style;
    public $normal_links_background_color;
    public $normal_links_text_decoration;
    public $normal_links_text_shadow;

    public $hover_links_color;
    public $hover_links_background_style;
    public $hover_links_background_color;
    public $hover_links_text_decoration;
    public $hover_links_text_shadow;

    public $active_links_color;
    public $active_links_background_style;
    public $active_links_background_color;
    public $active_links_text_decoration;
    public $active_links_text_shadow;

    public $visited_links_color;
    public $visited_links_background_style;
    public $visited_links_background_color;
    public $visited_links_text_decoration;
    public $visited_links_text_shadow;



    public $output = '';

    // magic methods

    public function __construct( $args = array(), $section = null){

        if(!is_array($args) || empty($section))
            return false;

        $this->section = $section;
        $this->set_values($args);
        $this->set_default_link_values();
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

    public function set_default_link_values(){

        $defaults = array(
            'normal_links_color'=> '#000',
            'normal_links_background_style' => 'none',
            'normal_links_background_color' => null,
            'normal_links_text_decoration' => 'none',
            'normal_links_text_shadow' => null
        );

        foreach($defaults as $k=>$v)
            $this->$k = !empty($this->$k) ? $this->$k : $v;

    }


    public function links(){

        if(empty($this->section))
            return false;

        foreach($this->links as $link){

            $anchor = ($link !== 'normal') ? 'a:'.$link : 'a';

            $this->set_link_defaults($link);

            $output = '';
            $output .= $this->links_color($link);
            $output .= $this->links_background_style($link);
            $output .= $this->links_text_decoration($link);

            $output = "\n#".$this->section .' '.$anchor.'{ '."\n". $output .'}';
            $this->output .= $output;

        }


    }


    public function set_link_defaults($link){
        $output = '';

        $defaults = array(
            '_links_color',
            '_links_background_style',
            '_links_background_color',
            '_links_text_decoration',
            '_links_text_shadow',
        );

        foreach($defaults as $k){
            $target = $link.$k;
            $default = 'normal'.$k;

            $this->$target = !empty($this->$target) ? $this->$target : $this->$default;
        }


    }



    public function links_color($link){
        $color = $link.'_links_color';
        return 'color: '.$this->$color.'; ';
    }


    public function links_text_decoration($link){
        $decoration = $link.'_links_text_decoration';
        $shadow = $link.'_links_text_shadow';

        if( $this->$decoration == 'none' )
            return false;

        if( $this->$decoration == 'text-shadow' && !empty($this->$shadow))
            return 'text-shadow: 2px 2px 2px'.$this->$shadow.'; ';

        return 'text-decoration: '.$this->$decoration.'; ';

    }


    public function links_background_style($link){

        $output = '';

        $style = $link.'_links_background_style';
        $bg_color = $link.'_links_background_color';
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
