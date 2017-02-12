<?php

namespace bswp\Forms\Fields;


class Label extends field  {

    /**
     * Creates a BIG section label
     */
    public function field_output(){

        $output = '';

        return '<h3>'.$this->label.'</h3>';

    }

}
