<?php

namespace Cascade;

use Casecades\fields;

/**
 * This is a field, it contains not only the saved values from the DB,
 * but it will also render the visual field as well
 */
class Field {
    public $name = '';
    public $display_name = '';

    public $settingsGroup = '';
    public $tab = 'default';

    public $type = '';
    public $args = '';
    public $toggle_fields = '';
    public $toggled_by = '';
    public $preview = '';
    public $inherits_from = array();

    public $output = '';

    public function __construct($settings = array(), $type = 'text'){
        // i dont think this even does anything
        if($type === null)
            $type = 'text';

        if(empty($args))
            unset($this);

        extract($args);

        $this->name = $name;
        $this->display_name = isset($display_name) ? $display_name : ucfirst(str_replace(array('-','_'), ' ', $name ) );
        $this->type = $type;
        $this->args = $args;
        $this->toggle_fields = $toggle_fields;
        $this->toggled_by = $toggled_by;
        $this->preview = $preview;;
        // $this->type = ''
    }

    public function __toString() {
        return $this->output;
    }

}
