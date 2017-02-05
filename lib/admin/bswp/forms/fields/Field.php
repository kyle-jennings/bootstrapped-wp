<?php

namespace bswp\forms\fields;

class Field {

    public $name;
    public $label;
    public $args;
    public $toggle_fields;
    public $toggled_by;
    public $preview;
    public $class;
    public $wrapper_class;

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



    public function __toString(){
        return $this->output;
    }


    public function get_the_field() {
        return $this->output;
    }



    public function the_field(){
        echo $this->output;
    }

    // this is gross but im hungover
    public function find_value($target){

        $fields = $GLOBALS['bswp\fields\settings']->settings;

        foreach($fields as $field){

            $tabs = $field['tabs'];

            if(empty($tabs))
                continue;

            foreach($tabs as $tab){

                $tab_fields = $tab['fields'];
                foreach($tab_fields as $tab_field){

                    if($tab_field['name'] == $target){
                        return $tab_field['value'];
                    }
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
    public function identify_fields($fields = array(), $tab_name, $current_tab = null){

        $output = '';

        foreach($fields as $field){

            $type = $field['type'];
            $name = $field['name'];
            $toggled_by = $field['toggled_by'];
            $wrapper_class = $field['wrapper_class'] ? $field['wrapper_class'] : '';
            $class = 'bswp\forms\fields\\' .$type.'Field';

            // error_log($class);

            $data_toggled_by = '';
            $data_toggle_name = '';


            if(!is_null($toggled_by) ){
                $toggles = $this->toggle_fields_markup($toggled_by, $name, $current_tab);
                extract($toggles);
            }

            if($type == 'no')
                continue;

            $output .= '<div class="option '.$data_toggled_by.' '.$type.' '.$wrapper_class.'" '.$data_toggle_name.' >';
                $output .= new $class($field, $tab_name, $this->section, $this->group);
            $output .= '</div>';
        }

        return $output;
    }



    /**
     * field toggling
     */
    public function get_toggled_by($toggled_bys, $current_tab = null){
        $output = 'hide js--toggled-field ';
        foreach ($toggled_bys as $field=>$value){
            $output .= $field.' ';
        }

        return $output;
    }


    public function toggle_fields_markup($toggled_by, $name, $current_tab = null){

        $data_toggled_by = !empty($toggled_by) ? $this->get_toggled_by($toggled_by, $current_tab) : '' ;
        $data_toggle_name = !empty($toggled_by) ? 'data-toggle-name="'.$name.'"' : '';

        return ['data_toggled_by'=>$data_toggled_by, 'data_toggle_name'=>$data_toggle_name];
    }
}
