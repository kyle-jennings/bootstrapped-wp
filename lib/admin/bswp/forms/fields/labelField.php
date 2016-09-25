<?php

namespace bswp\forms\fields;


class labelField {

    public $output;

    /**
     * Creates a BIG section label
     */
    public function __construct($args=array(), $tab = null){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<h3>'.$label.'</h3>';

        $this->output = $output;

    }

    public function __toString(){
        return $this->output;
    }
}
