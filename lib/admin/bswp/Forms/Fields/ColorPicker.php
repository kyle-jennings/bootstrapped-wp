<?php

namespace bswp\Forms\Fields;

class ColorPicker extends Field{



    /**
     * produces color field
     */
    public function field_output() {

        $id = $this->group_name.'-'.$this->tab_name.'-'.$this->name;
        $name = 'bswp_'.$this->section_name.
            '['.$this->group_name.']['.$this->tab_name.']['.$this->name.']';

        $data_preview_deps = $this->preview_dependancies ? 'data-preview_deps="'.$this->preview_dependancies.'"' : '' ;
        $data_preview = $this->preview ? 'data-preview="'.$this->preview.'"' : '';
        $data_field_name = $this->toggle_fields ? 'data-field_name="'.$this->name.'"' : '';
        // list of the fields which are toggled by this one
        $data_target_fields = $this->data_target_fields
        ? 'data-target_fields="'.$this->data_target_fields.'"' : '';


        $output = '';
        $output .= '<label>'.$this->label.'</label>';

        $alpha = '1';
        if( is_string($this->args) && $this->args == 'transparency'):
            $rgba = $this->find_value($this->name.'_rgba');
            $alpha = $this->get_alpha($rgba);
        endif;

        $opacity_opt = ( is_string($this->args) && $this->args == 'transparency' ) ? 'opacity' : '';

        // the visible output
        $output .= '<input class="minicolors '.$opacity_opt.'"
        '.$data_preview.'
        '.$data_field_name.'
        '.$data_preview_deps.'
        '.$data_target_fields.'
        id="'.$id.'"
        name="'.$name.'"
        data-opacity="'.$alpha.'"
        value="'.$this->value.'"';
        $output .= '/>';


        $output .= '<a class="clearColor js--clear-color">Clear</a>';

        return $output;
    }


}
