<?php

namespace bswp\forms;
use bswp\forms\fields\field;

class settingsTab {

    public $fields;
    public $settings;
    public $settings_component;
    public $group;

    public function __construct($group){
        // $this->fields = $fields;
        // $this->settings = $settings;
        $this->section = $GLOBALS['bswp\fields\settings']->section;
        $this->group = $group;

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

        $tabs = $GLOBALS['bswp\fields\settings']->settings[$this->group]['tabs'];

        if( empty($tabs) )
            return;

        // if there are more than one tab, set this flag
        $multi_tabs = (count($tabs) > 1) ? true : false;

        $output ='';

        // if there is more than one tab we create a dropdown to navigate them
        if( $multi_tabs ){
            $dropdown = new dropdown($tabs);
            $output .= $dropdown->fields_tab_dropdown();
        }
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

        foreach($tabs as $tab_name => $tab){
            $output .= $this->create_tab_content($tab, $i, $tab_name);
            $i++;
        }

        // close tab content
        if( $multi_tabs )
            $output .= '</div>';

        return $output;
    }



    /**
     * Generates the markup for the tab contents
     */
    public function create_tab_content($tab, $i=0, $current_tab = null){

        $label = $tab['label'];
        $name = str_replace(' ','_',strtolower($label));
        $fields = $tab['fields'];
        $class = $i == 0 ? 'active' : '';

        $field = new field();
        $output = '<div class="js--fields-group tab-pane cf '.$class.'" id="fields__'.$name.'">';
            $output .= $field->identify_fields($fields, $name, $current_tab);
        $output .= '</div>';

        return $output;
    }



}
