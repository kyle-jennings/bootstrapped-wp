<?php

namespace bswp\Settings;


/**
 * A SettingsGroup
 *
 * SettingsGroups are groups of settings for part of a section (Section like footer),
 * or something in that section (headings tags inside the footer section)
 */
class SettingsGroup {
    public $name = '';
    public $display_name = '';

    public $section_name = '';

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


    public function add_tab($name, $fields){

        if(empty($fields) || !is_array($fields) )
            return;

        // clone the fields
        foreach ( $fields as $k => $v)
            $this->tabs[$name][$k] = clone $v;

    }

    public function set_section($name = ''){
        $this->section_name = $name;

    }


    // loop through the groups' tabs
    public function loop_tabs(  $action = 'setup_fields' ){


        if(empty($this->tabs) )
            return;

        foreach( $this->tabs as $tab_name=>&$tab ){
            if(method_exists($this, $action))
                $this->$action($tab, $tab_name);
        }
    }



    // loop through the tabs' fields
    private function setup_fields( &$tab, $tab_name = '' ){

        $fields = $tab;
        foreach($fields as $name=>$field){

            $type = new \ReflectionClass($field);
            $type = $type->getShortName();

            $tab[$name]->type = $type;
            $tab[$name]->section_name = $this->section_name;
            $tab[$name]->group_name = $this->name;
            $tab[$name]->tab_name = $tab_name;
            $tab[$name]->form_name_attr = $this->section_name.'_section';


            $saved_value = $GLOBALS['bswp\Settings\Section']->find_saved_value($name, $this->name, $tab_name);
            $tab[$name]->value = $saved_value;
        }

    }


    // loop through each field and register it
    public function register_field($group) {

        // examine($group);

        foreach($group->tabs as $name=>$fields){

            add_settings_field(
                $group->name.'_'.$field->name,
                null,
                null,
                'bswp_'.$this->name,
                'bswp_'.$this->name.'_section'
            );
        }

    }

}
