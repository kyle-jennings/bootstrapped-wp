<?php

namespace bswp\css;

class Borders {
    public $directions = array('top','right','bottom','left');
    public $corners = array('top_left', 'top_right','bottom_right','bottom_left');
    public $parts = array('style', 'color', 'width');

    public $top_border_style;
    public $top_border_color;
    public $top_border_width;
    public $right_border_style;
    public $right_border_color;
    public $right_border_width;
    public $bottom_border_style;
    public $bottom_border_color;
    public $bottom_border_width;
    public $left_border_style;
    public $left_border_color;
    public $left_border_width;
    public $top_left;
    public $top_right;
    public $bottom_right;
    public $bottom_left;

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



    public function borders(){

        $output = '';

        foreach($this->directions as $direction)
            $output .= $this->border($direction);

        $this->output .= $output;
    }


    public function border_radii(){

        $output = '';

        foreach($this->corners as $corner)
            $output .= $this->border_radius($corner);

        $this->output .= $output;
    }


    /* ------------------------- border settings -----------------------------*/
    function border($direction){

    	$output = '';
        $style = $direction.'_border_style';

    	if( empty($this->$style) || $this->$style == "none")
            return;

        foreach($this->parts as $part)
            $output .= $this->border_part($direction, $part);


    	$this->output .= $output;
    }


    public function border_part($direction, $attr){

        $part = $direction.'_border_'.$attr;

        if ( !empty($this->$part) )
            return $direction.'-border-'.$attr.': '. $this->$part .'; ';

    }


    // /* ------------------------- border-radius -----------------------------*/
    function border_radius($direction){

    	if( empty($this->$direction))
            return;

        $this->output .= 'border-'.str_replace('_','-',$direction).'-radius: '.$this->$direction .'; ';

    }

}
