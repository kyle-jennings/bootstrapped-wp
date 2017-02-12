<?php

namespace bswp\Forms\Fields;


class Select extends Field{

    /**
     * Select field
     * 'args' field is in array - used to populate the options
     * if an 'args' a non-associative array then each value is used for both the value and label
     * otherwise the key is the value and the value is the label. huh?
     * @return [type]       [description]
     */
    public function field_output() {

        $output = '';
        $classes = $this->class;
        $classes .= $this->toggle_fields ? ' js--toggle-field' : '';

        $data = $this->toggle_fields ? 'data-field-toggle="'.$this->name.'"' : '';
        $value = isset($this->value) ? $this->value : '';

        $output .= '<label>'.$this->label.'</label>';
        $output .= '<select class="'.$classes.'" '.$data.' name="bswp_'.$this->section_name.'['.$this->group_name.']['.$this->name.']">';

        foreach ($this->args as $key=>$option):

            $option_test = $option;
            if(is_string($key))
                $option_text = $key;

            $name = strtolower(str_replace(' ','_',$option));
            $data_targets = '';
            if(isset($this->toggle_fields[$option])){
                $data_targets = is_string($this->toggle_fields[$option]) ? 'data-targets="'.$this->toggle_fields[$option].'"' : '' ;
            }

            $output .= '<option '.$data_targets.' value="'.$option.'" '.selected( $option, $this->value, false).'>';
                $output .= str_replace('_',' ',$option);
            $output .= '</option>';

        endforeach;
        $output .= '</select>';

        return $output;

    }

}
