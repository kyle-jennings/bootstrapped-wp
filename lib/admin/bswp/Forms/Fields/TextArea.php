<?php

namespace bswp\Forms\Fields;

class TextArea extends Field {

    public $output;

    public function field_output(){

        $output = '';

        $output .= '<label class="js--extend-field">';
            $output .= $this->label.'<span class="dashicons dashicons-external"></span>';
        $output .= '</label>';

        if($this->args == 'wp_editor'){
            ob_start();
                wp_editor( $this->value, $this->name, array( 'textarea_rows' => 5 ));
                $ob_content = ob_get_contents();
            ob_end_clean();
            $output .= $ob_content;
        }
        else{
            $output .= '<textarea name="bswp_'.$this->section_name.
                '['.$this->group_name.']['.$this->tab_name.']['.$this->name.']" 
                rows="5">'.$this->value.'</textarea>';
        }


        $this->output = $output;

    }


}
