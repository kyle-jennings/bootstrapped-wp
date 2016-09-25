<?php

namespace bswp\forms;
use bswp\forms\fields;

class settingsTab {

    public $fields;
    public $settings;
    public $settings_component;

    public function __construct($settings, $fields, $section){
        $this->fields = $fields;
        $this->settings = $settings;
        $this->section = $section;

    }


    /**
     * The section tab
     *
     * This will create the settings fields and the settings dropdown.
     * IE - in the background settings, there are background colors and also
     * background wallpaper. Each of those are in their own tab pans, which are
     * activated with a dropdown menu button
     *
     * @param  array  $settings [description]
     * @return [type]           [description]
     */
    public function field_tabs(){

        $section_component = $this->settings['section'];
        $this->section_component = $section_component;

        $tabs = $this->settings['tabs'];

        if( empty($tabs) )
            return;


        // if there are more than one tab, set this flag
        $multi_tabs = (count($tabs) > 1) ? true : false;

        $output ='';

        // if there is more than one tab we create a dropdown to navigate them
        if( $multi_tabs )
            $output .= $this->fields_tab_dropdown($tabs);
        else
            $output .= '<div class="tab-switcher--spacer"></div>';

        // get the tab pane
        $output .= $this->fields_tab_pane($multi_tabs, $tabs);

        return $output;
    }

    /**
     * Here is the tab pane which displays the fields as mentioned above
     * @param  [type] $multi_tabs [description]
     * @param  [type] $tabs       [description]
     * @return [type]             [description]
     */
    public function fields_tab_pane($multi_tabs, $tabs){

        $output = '';

        // the tab content
        if( $multi_tabs )
            $output .= '<div class="tab-content tab-content--fields js--fields-tabs-wrapper">';

        // generate the fields
        $i=0;


        foreach($tabs as $tab){
            $current_tab = key($tabs);
            $output .= $this->create_tab_content($tab, $i, $current_tab);
            $i++;
        }

        // close tab content
        if( $multi_tabs )
            $output .= '</div>';

        return $output;
    }


    // the tab dropdown
    public function fields_tab_dropdown($tabs){

        $output = '';

        $first_tab = reset($tabs);
        $first_label = $first_tab['label'];

        $output .= '<div class="btn-group tab-switcher">';
            $output .= '<a class="btn btn-primary dropdown-toggle tab-switcher__dropdown" data-toggle="dropdown" href="#">';
                $output .= '<span class="btn-face">'.$first_label.'</span>';
                $output .= '<span class="caret"></span>';
            $output .= '</a>';
            $output .= '<ul class="dropdown-menu">';

                foreach($tabs as $tab)
                    $output .= $this->fields_tab_dropdown_link($tab);

            $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    // The tab links in the dropdown
    public function fields_tab_dropdown_link($tab){


        $label = $tab['label'];
        $name = str_replace(' ','_',strtolower($tab['label']));

        $output = '';
        $output .= '<li>';
            $output .= '<a href="#fields__'.$name.'" data-toggle="tab">'.$label.'</a>';
        $output .= '</li>';

        return $output;
    }


    /**
     * Generates the markup for the tab contents
     */
    public function create_tab_content($tab, $i=0, $current_tab = null){


        $name = str_replace(' ','_',strtolower($tab['label']));
        $label = $tab['label'];
        $fields = $tab['fields'];
        $class = $i == 0 ? 'active' : '';

        $output = '<div class="js--fields-group tab-pane cf '.$class.'" id="fields__'.$name.'">';

            $output .= $this->identify_fields($fields, $name, $current_tab, $section_component);
        $output .= '</div>';

        return $output;
    }


    /**
     * Identifies which field to use based on the 'type' key
     */
    public function identify_fields($fields = array(), $tab, $current_tab = null){

        $output = '';

        foreach($fields as $field){

            $type = $field['type'];
            $name = $field['name'];
            $toggled_by = $field['toggled_by'];
            $wrapper_class = $field['wrapper_class'] ? $field['wrapper_class'] : '';

            $data_toggled_by = '';
            $data_toggle_name = '';


            if(!is_null($toggled_by) ){
                $toggles = $this->toggle_fields_markup($toggled_by, $name, $current_tab);
                extract($toggles);
            }
            if($type == 'no')
                continue;

            $output .= '<div class="option '.$data_toggled_by.' '.$type.' '.$wrapper_class.'" '.$data_toggle_name.' >';


                $class = 'bswp\forms\fields\\' .$type.'Field';

                $output .= new $class($field, $tab, $this->section);


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
