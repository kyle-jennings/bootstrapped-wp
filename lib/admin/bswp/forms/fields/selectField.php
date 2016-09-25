<?php

namespace bswp\forms\fields;


class selectField {

    public $output;

    /**
     * Select field
     * 'args' field is in array - used to populate the options
     * if an 'args' a non-associative array then each value is used for both the value and label
     * otherwise the key is the value and the value is the label. huh?
     * @return [type]       [description]
     */
    public function __construct($args=array(), $tab = null){


        extract($args);

        $output = '';

        $classes = $class;
        $classes .= $toggle_fields ? ' js--toggle-field' : '';

        $data = $toggle_fields ? 'data-field-toggle="'.$name.'"' : '';
        $value = isset($value) ? $value : '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<select class="'.$classes.'" '.$data.' name="bswp_'.$this->section.'['.$name.']">';

        foreach ($args as $option):

            $name = strtolower(str_replace(' ','_',$option));
            $data_targets = '';
            if(isset($toggle_fields[$option])){

                $data_targets = is_string($toggle_fields[$option]) ? 'data-targets="'.$toggle_fields[$option].'"' : '' ;
            }

            $output .= '<option '.$data_targets.' value="'.$name.'" '.selected( $name, $value, false).'>';
                $output .= str_replace('_',' ',$option);
            $output .= '</option>';

        endforeach;
        $output .= '</select>';

        $this->output = $output;

    }

    public function __toString(){
        return $this->output;
    }
}
