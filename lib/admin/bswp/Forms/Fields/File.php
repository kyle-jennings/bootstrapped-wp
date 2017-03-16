<?php

namespace bswp\Forms\Fields;


class File extends Field {

    /**
     * Produces the file field input
     */
    public function field_output() {

        $id = $this->group_name.'-'.$this->tab_name.'-'.$this->name;
        $name = 'bswp_'.$this->section_name.
            '['.$this->group_name.']['.$this->tab_name.']['.$this->name.']';

        // all the data attrs
        $data_preview_deps = $this->preview_dependancies ? 'data-preview_deps="'.$this->preview_dependancies.'"' : '' ;
        $data_preview = $this->preview ? 'data-preview="'.$this->preview.'"' : '';
        $data_field_name = $this->toggle_fields ? 'data-field_name="'.$this->name.'"' : '';
        // list of the fields which are toggled by this one
        $data_target_fields = $this->data_target_fields
        ? 'data-target_fields="'.$this->data_target_fields.'"' : '';


        $output = '';
        $output .= '<label>'.$this->label.'</label>';
        $output .= '<input class="media_input" type="text" id="'.$id.'" name="'.$name.'"
            value="'.$this->value.'" />';
        $output .= '<input class="button upload_image" type="button" value="Upload file" />';

        return $output;

    }

}
