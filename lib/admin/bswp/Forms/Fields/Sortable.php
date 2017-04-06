<?php

namespace bswp\Forms\Fields;

use \stdClass;

class Sortable extends Field {
    public function field_output() {

        $output = '';
        $classes = $this->class . ' ' . $this->type;
        $classes .= $this->toggle_fields ? ' js--toggle-field' : '';

        // sortable is connected to...
        $connected = $this->name;

        $this->args = $this->format_args($this->args);

        $value = json_encode($this->value);
        $value = str_replace('\\','', $value);
        $value = trim($value, '"');
        $value = htmlspecialchars($value);


        $this->value = json_decode($this->value);


        // all the data attrs
        if($this->preview == 'toggle-class'){
            $data_preview_deps = $this->preview_args ? 'data-toggle_class="'.$this->preview_args.'"' : '' ;
        }else{
            $data_preview_deps = $this->preview_dependancies ? 'data-preview_deps="'.$this->preview_dependancies.'"' : '' ;
        }
        $data_preview = $this->preview ? 'data-preview="'.$this->preview.'"' : '';
        $data_field_name = $this->toggle_fields ? 'data-field_name="'.$this->name.'"' : '';
        $data_sortable_name = 'data-sortable-group=".'.$connected.'"';

        // list of the fields which are toggled by this one
        $data_target_fields = $this->data_target_fields
        ? 'data-target_fields="'.$this->data_target_fields.'"' : '';

        // the id and field name
        $id = $this->group_name.'-'.$this->tab_name.'-'.$this->name;
        $field_name = 'bswp_'.$this->section_name.
            '['.$this->group_name.']['.$this->tab_name.']['.$this->name.']';

        // the id of hte save field
        $data_field_target = 'data-field-target="'.$id.'"';



        $output .= '<div class="sortables">';

            // active sortables
            $output .= '<div>';
                $output .= '<h6>Active</h6>';
                $output .= '<ol class="sortables__list js--sortables sortables__active-list js--sortable-active '.$connected.'"
                    '.$data_sortable_name.'
                    '.$data_field_target.'
                    >';
                    $output .= $this->get_active();
                $output .= '</ol>';
            $output .= '</div>';

            // Available sortables
            $output .= '<div>';
                $output .= '<h6>Available</h6>';
                $output .= '<ol class="sortables__list js--sortables js--sortable-available '.$connected.'" '.$data_sortable_name.'>';
                    $output .= $this->get_available();
                $output .= '</ol>';

            $output .= '</div>';

        $output .= '</div>';


        $output .= '<input type="hidden"
        id="'.$id.'"
        name="'.$field_name.'"
        value='.$value.'
        />';
        return $output;
    }


    // get the Available components - does not include comps that have already
    // been activated
    private function get_available(){
        $output = '';

        $output .= $this->calculate_available();

        return $output;
    }


    private function calculate_available() {
        $output = '';
        $components = $this->args;
        $saved = $this->value;
        foreach($components as $component){
            $continue = false;
            foreach($saved as $s){
                if($component->name == $s->name){
                    $continue = true;
                }
            }
            if($continue == true)
                continue;

            $output .= $this->get_sortable_markup($component);
        }

        return $output;
    }



    // get the active components
    private function get_active(){
        $output = '';
        $saved = $this->value;
        foreach($saved as $component){
            $output .= $this->get_sortable_markup($component);
        }

        return $output;
    }


    // the actual list items in teh sortable areas
    private function get_sortable_markup($component) {

        $output = '';
        $output .= '<li id="'.$component->name.'" class="sortable">';
            $output .=  '<h6 class="sortable__title">'.$this->clean_string($component->name).'</h6>';
            $output .=  $this->get_component_visibility($component->visibility);
        $output .= '</li>';

        return $output;
    }


    private function get_component_visibility($vis) {
        $visibilities = array(
            'all',
            'visible_phone',
            'visible_tablet',
            'visible_desktop',
            'hidden_phone',
            'hidden_tablet',
            'hidden_desktop',
        );
        $output = '<span class="sortable__visibility">';
            $output .=  '<span class="dashicons dashicons-visibility"></span>';
            $output .=  '<select class="js--no-css-change">';
                    foreach($visibilities as $v){
                        $selected = $v == $vis ? 'selected' : '';
                        $output .= '<option value="'.$v.'" '.$selected.'>';
                            $output .= $this->clean_string($v);
                        $output .= '</option>';
                    }

            $output .= '</select>';
        $output .=  '</span>';

        return $output;
    }



    private function format_args($args) {
        $newargs = array();
        foreach($args as $arg){
            $newclass = new stdClass();
            $newclass->name = $arg;
            $newclass->visibility = 'all';

            $newargs[] = $newclass;
        }

        return $newargs;
    }
}
