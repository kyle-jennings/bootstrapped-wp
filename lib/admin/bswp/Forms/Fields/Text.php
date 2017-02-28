<?php

namespace bswp\Forms\Fields;

class Text extends Field {

    public $output;
    /**
     * The base field, used for misc values
     * @param  array  $args [description]
     * @param  [type] $tab  [description]
     * @return [type]       [description]
     */
    public function field_output(){

        $id = $this->group_name.'-'.$this->tab_name.'-'.$this->name;
        $name = 'bswp_'.$this->section_name.
            '['.$this->group_name.']['.$this->tab_name.']['.$this->name.']';

        $output = '';

        $output .= '<label>';
            $output .= $this->label;
        $output .= '</label>';

        $class = '';
        $data = '';

        if($this->args['suffix']){
            $class = 'js--add-suffix';
            $data = 'data-suffix="'.$this->args['suffix'].'"';
        }

        $output .='<input class="'.$class.'" '.$data.' type="text"
            id="'.$id.'" name="'.$name.'" value="'.$this->value.'" >';

        return $output;
    }

}
