<?php

namespace bswp\forms\fields;

class colorField extends field {

    public $fields;
    public $section;
    public $tab;
    public $args;


    public $output = '';

    /**
     * produces color field
     */
    public function __construct($args=array(), $tab = null, $section, $group){

        $this->tab = $tab;
        $this->section = $section;

        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label>'.$label.'</label>';

        $alpha = '1';
        if( is_string($args) && $args == 'transparency'):
            $rgba = $this->find_value($name.'_rgba');
            $alpha = $this->get_alpha($rgba);
        endif;

        // the visible output
        $output .= '<input class="minicolors opacity" data-opacity="'.$alpha.'" name="bswp_'.$this->section.'['.$group.']['.$name.']"
            value="'.$value.'"';
        $output .= '/>';

        if( is_string($args) && $args == 'transparency'){
            $output .= '<input class="rgba-color" name="bswp_'.$this->section.'['.$group.']['.$name.'_rgba]"
            type="hidden" value="'.$rgba.'" />';
        }

        $output .= '<a class="clearColor js--clear-color">Clear</a>';

        $this->output = $output;
    }

    public function __toString(){
        return $this->output;
    }
}
