<?php

namespace bswp\forms\fields;

class fieldMethods {

    public $tab;
    public $fields;
    public $section;

    // ------------------------------------------
    //  The field generators
    // ------------------------------------------

    public function __toString(){
        return $this->output;
    }

    /**
     * This is used for saved values which do not need fields
     * @return [type] [description]
     */
    public function no_field_generator(){}



    // this is gross but im hungover
    public function find_value($target){

        $fields = $this->fields->settings;
        foreach($fields as $field){

            $tabs = $field['tabs'];

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
}
