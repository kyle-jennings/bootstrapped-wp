<?php

namespace bswp\forms\fields;

class Field {

    public $name;
    public $label;
    public $field_name;
    public $args;
    public $toggle_fields;
    public $toggled_by;
    public $preview;
    public $class;
    public $wrapper_class;

    public $value = '';

    public $output = '';

    public function __construct( $settings = array() ){
        extract($settings);
        $name = isset($name) ? $name : 'field';

        $this->name = $name;
        $this->label = isset($label) ? $label : ucfirst(str_replace(array('-','_'), ' ', $name ) );
        $this->args = isset($args) ? $args : array();
        $this->toggle_fields = isset($toggle_fields) ? $toggle_fields : array();
        $this->toggled_by = isset($toggled_by) ? $toggled_by : array();
        $this->preview = true;
        $this->class = isset($class) ? $class : '';
        $this->wrapper_class = isset($wrapper_class) ? $wrapper_class : '';

    }



    public function __toString() {
        return $this->output;
    }


    public function get_the_field() {
        $this->generate_output();
        return $this->output;
    }



    public function the_field() {
        echo $this->output;
    }

    // this is gross but im hungover
    public function find_value($target) {

        $section = $GLOBALS['bswp\settings\Section'];

        // loop through the settings group
        foreach( $section->groups as $group ){
            $tabs = $group->tabs;

            // loop through the tabs
            if( empty($tabs) )
                continue;

            foreach( $tabs as $tab ){
                $fields = $tab;
                // loop through the fields
                if(!is_array($fields))
                    continue;

                // when we find the matching field, return the value
                foreach($fields as $name=>$field){
                    if($target == $field->name)
                        return $field->value;
                }
            }
        }

        return false;
    }


    // get alpha from RGBA
    public function get_alpha($rgba){
        $find = array('rgba','(',')');
        $rgba = str_replace($find,'',$rgba);

        $parts = explode(', ', $rgba);
        $last = $parts[(sizeof($parts)-1)];

        $alpha = $last;
        return $alpha;
    }


    /**
     * Identifies which field to use based on the 'type' key
     */
    public function generate_output(){

        $output = '';



        // $wrapper_class = $field['wrapper_class'] ? $field['wrapper_class'] : '';
        // $class = 'bswp\forms\fields\\' .$type.'Field';



        $data_toggled_by = '';
        $data_toggle_name = '';


        if(!empty($this->toggled_by) ){
            $toggles = $this->toggle_fields_markup($this->toggled_by);
            extract($toggles);
        }

        $output .= '<div class="option '.$data_toggled_by.' '.$this->type.' '.$this->wrapper_class.'" '.$data_toggle_name.' >';
            $output .= $this->field_output();
        $output .= '</div>';

        if(!empty($this->toggled_by) ){
            // examine($output);
            // examine('boom');
        }

        $this->output = $output;
    }



    /**
     * field toggling
     */
    public function get_toggled_by($toggled_bys){


        $output = 'hide js--toggled-field ';
        foreach ($toggled_bys as $field=>$value){
            $output .= $field.' ';
        }

        return $output;
    }


    public function toggle_fields_markup($toggled_by){

        $data_toggled_by = !empty($toggled_by) ? $this->get_toggled_by($toggled_by) : '' ;
        $data_toggle_name = !empty($toggled_by) ? 'data-toggle-name="'.$this->name.'"' : '';

        $data = array(
            'data_toggled_by'=>$data_toggled_by,
            'data_toggle_name'=>$data_toggle_name
        );



        return $data;
    }
}
