<?php

namespace Cascade;

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


    public function __construct($name = null) {

    }
}
