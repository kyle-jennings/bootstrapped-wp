<?php

namespace Cascade\fields;

class textField extends field {

    public $output;
    /**
     * The base field, used for misc values
     * @param  array  $args [description]
     * @param  [type] $tab  [description]
     * @return [type]       [description]
     */
    public function __construct($args=array(), $tab = null, $section, $group){

        $this->tab = $tab;
        $this->section = $section;

        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label>';
            $output .= $label;
        $output .= '</label>';

        $output .='<input type="text" name="bswp_'.$this->section.'['.$group.']['.$name.']"
        value="'.$value.'" >';

        $this->output = $output;
    }

    public function __toString(){
        return $this->output;
    }
}
