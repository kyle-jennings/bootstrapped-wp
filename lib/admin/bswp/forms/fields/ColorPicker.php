<?php

namespace bswp\forms\fields;

class ColorPicker extends Field{



    /**
     * produces color field
     */
    public function generate_output( $args=array() ) {


        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label>'.$label.'</label>';

        $alpha = '1';
        if( is_string($args) && $args == 'transparency'):
            $rgba = $this->find_value($name.'_rgba');
            $alpha = $this->get_alpha($rgba);
        endif;

        $opacity_opt = (is_string($args) && $args == 'transparency') ? 'opacity' : '';
        // the visible output
        $output .= '<input class="minicolors '.$opacity_opt.'" data-opacity="'.$alpha.'" name="bswp_'.$this->section.'['.$group.']['.$name.']"
            value="'.$value.'"';
        $output .= '/>';

        if( is_string($args) && $args == 'transparency'){
            $output .= '<input class="rgba-color" name="bswp_'.$this->section.'['.$group.']['.$name.'_rgba]"
            type="hidden" value="'.$rgba.'" />';
        }

        $output .= '<a class="clearColor js--clear-color">Clear</a>';

        $this->output = $output;
    }


}
