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
        // all the data attrs
        $data_preview_deps = $this->preview_dependancies ? 'data-preview_deps="'.$this->preview_dependancies.'"' : '' ;
        $data_preview = $this->preview ? 'data-preview="'.$this->preview.'"' : '';
        $data_field_name = $this->toggle_fields ? 'data-field_name="'.$this->name.'"' : '';
        // list of the fields which are toggled by this one
        $data_target_fields = $this->data_target_fields
        ? 'data-target_fields="'.$this->data_target_fields.'"' : '';



        if($this->args['suffix']){
            $class = 'js--add-suffix';
            $data = 'data-suffix="'.$this->args['suffix'].'"';
        }

        $output .='<input class="'.$class.'"
            '.$data_preview.'
            '.$data_field_name.'
            '.$data_preview_deps.'
            '.$data_target_fields.'
            type="text"
            id="'.$id.'"
            name="'.$name.'"
            value="'.$this->value.'"
         >';

        return $output;
    }

}
