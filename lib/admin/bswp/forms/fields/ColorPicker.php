<?php

namespace bswp\forms\fields;

class ColorPicker extends Field{



    /**
     * produces color field
     */
    public function field_output() {


        $output = '';


        $output .= '<label>'.$this->label.'</label>';

        $alpha = '1';
        if( is_string($this->args) && $this->args == 'transparency'):
            $rgba = $this->find_value($this->name.'_rgba');
            $alpha = $this->get_alpha($rgba);
        endif;

        $opacity_opt = ( is_string($this->args) && $this->args == 'transparency' ) ? 'opacity' : '';

        // the visible output
        $output .= '<input class="minicolors '.$opacity_opt.'" data-opacity="'.$alpha.'" name="bswp_'.$this->section_name.'['.$this->group_name.']['.$this->name.']"
            value="'.$this->value.'"';
        $output .= '/>';


        $output .= '<a class="clearColor js--clear-color">Clear</a>';

        return $output;
    }


}
