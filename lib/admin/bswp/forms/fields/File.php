<?php

namespace bswp\forms\fields;


class File {

    

    /**
     * Produces the file field input
     */
    public function generate_output( $args=array() ) {

        $this->tab = $tab;
        $this->section = $section;

        extract($args);
        $value = isset($value) ? $value : '';

        $output = '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<input class="media_input"  type="text" name="bswp_'.$this->section.'['.$group.']['.$name.']"
                    value="'.$value.'" />';
        $output .= '<input class="button upload_image" type="button" value="Upload file" />';

        $this->output = $output;

    }

}
