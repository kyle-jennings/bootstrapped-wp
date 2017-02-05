<?php

namespace bswp\forms\fields;


class HiddenField extends Field {
    /**
     * produces color field
     */
    public function generate_output( $args=array() ) {


        extract($args);
        $value = isset($value) ? $value : '';


        $thi->output .='<input type="text" name="bswp_'.$this->section.'['.$group.']['.$name.']"
                value="'.$value.'" >';
    }
}
