<?php

namespace bswp\forms\fields;


class Hidden extends Field {
    /**
     * produces color field
     */
    public function field_output() {

        return '<input type="hidden" name="bswp_'.$this->section_name.'['.$this->group_name.']['.$this->name.']"
                value="'.$this->value.'" >';
    }
}
