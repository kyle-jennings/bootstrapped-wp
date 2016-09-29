<?php

namespace bswp\css;


class text {

    public $text_color;


    public $normal_links_color;
    public $normal_links_background_style;
    public $normal_links_background_color;
    public $normal_links_text_decoration;
    public $hover_links_color;
    public $hover_links_background_style;
    public $hover_links_background_color;
    public $hover_links_text_decoration;
    public $active_links_color;
    public $active_links_background_style;
    public $active_links_background_color;
    public $active_links_text_decoration;
    public $visited_links_color;
    public $visited_links_background_style;
    public $visited_links_background_color;
    public $visited_links_text_decoration;


    public $output = '';

    // magic methods

    public function __construct( $args = array() ){

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




}
