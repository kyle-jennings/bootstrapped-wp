<?php

namespace bswp\settings;


/**
 * A SettingsGroup
 *
 * SettingsGroups are groups of settings for part of a section (Section like footer),
 * or something in that section (headings tags inside the footer section)
 */
class SettingsGroup {
    public $name = '';
    public $display_name = '';

    public $tabs = array();
    public $is_active = false;
    public $inherits_from = array();


    public function __construct( $name = null, $display_name = null ) {

        if($name)
            $this->name = $name;

        if($display_name)
            $this->display_name = $display_name;
        else
            $this->display_name = ucwords(str_replace('_',' ', $this->name));

    }
}
