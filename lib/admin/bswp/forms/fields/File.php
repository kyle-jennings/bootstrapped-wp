<?php

namespace bswp\forms\fields;


class File extends Field {



    /**
     * Produces the file field input
     */
    public function field_output() {

        $output = '';

        $output .= '<label>'.$this->label.'</label>';
        $output .= '<input class="media_input" type="text" name="bswp_'.$this->section_name.'['.$this->group_name.']['.$this->name.']"
                    value="'.$this->value.'" />';
        $output .= '<input class="button upload_image" type="button" value="Upload file" />';

        return $output;

    }

}
