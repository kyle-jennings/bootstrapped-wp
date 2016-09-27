<?php

namespace bswp\forms\fields;


class fileField extends field  {

    public $output;

    /**
     * Produces the file field input
     */
    public function __construct($args=array(), $tab = null){
        extract($args);
        $value = isset($value) ? $value : '';

        $output = '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<input class="media_input"  type="text"  name="bswp_'.$this->section.'['.$name.']"
                    value="'.$value.'" />';
        $output .= '<input class="button upload_image" type="button" value="Upload file" />';

        $this->output = $output;

    }

    public function __toString(){
        return $this->output;
    }
}
