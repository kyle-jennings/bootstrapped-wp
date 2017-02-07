<?php

namespace bswp\forms\fields;


class Label extends field  {

    /**
     * Creates a BIG section label
     */
    public function field_output(){

        $output = '';

        $output .= '<h3>'.$this->label.'</h3>';

        $this->output = $output;

    }

}
