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

        $output = '';
        $output .= '<label>'.$this->label.'</label>';
        $output .= '<input class="media_input" type="text" id="'.$id.'" name="'.$name.'"
            value="'.$this->value.'" />';
        $output .= '<input class="button upload_image" type="button" value="Upload file" />';

        return $output;

    }

}
