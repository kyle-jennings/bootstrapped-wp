<?php

namespace bswp\forms\fields;


class labelField extends field  {

    public $output;

    /**
     * Creates a BIG section label
     */
    public function __construct($args=array(), $tab = null, $section, $group){

        $this->tab = $tab;
        $this->section = $section;

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
