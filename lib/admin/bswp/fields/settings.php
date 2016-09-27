<?php

namespace bswp\fields;

class settings{

    public $section;
    public $settings;
    public $saved_values;


    public function __construct(){

        if( isset($_GET['section']) ){
            $this->section = $_GET['section'];
        }elseif( isset($_POST) ){
            $this->section = str_replace('bswp_', '',$_POST['option_page']);
        }else{
            return false;
        }

        $this->saved_values = get_option('bswp_'.$this->section);

        $settings_array = $this->section.'_tabs';



        // get the fields file
        $theme_root = get_template_directory();
        $file = dirname(__FILE__).'/field-settings.php';
        include_once($file);

        $this->settings = $$settings_array;
        $this->set_saved_values();


        $class = __CLASS__;

        if ( empty( $GLOBALS[ $class ] ) )
            $GLOBALS[ $class ] = $this;

        unset($this->saved_values);
    }



    public function get_field_settings(){
        return $this->settings;
    }



    public function set_saved_values(){


        if(empty($this->settings) || empty($this->saved_values))
            return;

        // loop through each group of settings
        foreach ($this->settings as $group => $settings){
            $this->loop_through_tabs($group, $settings['tabs']);

        }

    }

    public function loop_through_tabs($group, $tabs){
        // loop through each groups tabs
        foreach($tabs as $tab_key=>$tab){
            $this->loop_through_fields($group, $tab_key, $tab['fields']);
        }
    }


    public function loop_through_fields($group, $tab_key, $fields){

        // loop through each tab's fields
        foreach($fields as $field_key=>$field){
            $name = $field['name'];
            $value = $this->saved_values[$group][$name];
            $this->settings[$group]['tabs'][$tab_key]['fields'][$field_key]['value'] = $value;
        }

    }




    public function register_section_settings(){


        if(empty($this->settings))
            return;

        foreach ($this->settings as $settings){

            $field_groups = $settings['tabs'];
            $element = $settings['section'];

            add_settings_section(
                'bswp_'.$this->section.'_section',
                null,
                null,
                'bswp_'.$this->section
            );

            $this->register_field_settings($field_groups);

            register_setting('bswp_'.$this->section, 'bswp_'.$this->section);
        }
    }

    public function register_field_settings($field_groups){

        // loop through each tab
        foreach($field_groups as $field_group){
            $fields = $field_group['fields'];

            foreach($fields as $field){

              add_settings_field(
                    $field['name'],
                    null,
                    null,
                    'bswp_'.$this->section,
                    'bswp_'.$this->section.'_section'
                );
            }
        }

    }

}
