<?php

namespace bswp\forms\fields;

class textareaField extends field {

    public $output;

    public function __construct($args=array(), $tab = null, $section, $group){

        $this->tab = $tab;
        $this->section = $section;

        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label class="js--extend-field">';
            $output .= $label.'<span class="dashicons dashicons-external"></span>';
        $output .= '</label>';

        if($args == 'wp_editor'){
            ob_start();
                wp_editor( $value, $name, array( 'textarea_rows' => 5 ));
                $ob_content = ob_get_contents();
            ob_end_clean();
            $output .= $ob_content;
        }
        else{
            $output .= '<textarea name="bswp_'.$this->section.'['.$group.']['.$name.']" rows="5">'.$value.'</textarea>';
        }


        $this->output = $output;

    }

    public function __toString(){
        return $this->output;
    }
}
