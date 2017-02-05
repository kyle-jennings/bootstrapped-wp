<?php

namespace bswp\settings;

/**
 * A Section is a page of settings for some
 * section of the website.
 *
 * For instance, we might have a page for the footer section settings,
 * or a page for the login page settings.
 *
 * Sections can be turned on and off
 * Sections can also inherit their settings from another section
 *
 * Basic stesps:
 * when a section object is created, we pass in the section name and
 * its field settings.  The fields themselves will have the name of the
 * "SettingsGroup" and "Tab".  These will be used to determine how to set up the
 * structure of the form to display.
 *
 * On construction, the object will read the DB to try and grab the saved values
 * of the fields and set them to the fields in the object.  These are displayed in the forms.
 *
 * Finally, the object should register the settings and sections (WordPress terms)
 * so we can save them in the DB.  This gets tricky because these need to be registered
 * early in the bootstrap process.  think about abstracting that to its own class.
 *
 */


class Section {

    public $name = '';
    public $display_name = '';

    public $settings = array();
    public $settings_file = '';

    public $is_active = false;
    public $inherits_from = array();

    public $groups;
    public $fields = array();


    /**
     * sets the section name, this is used to grab all the saved values from
     * the DB, and also register all fields.
     */
    public function __construct($name = null, $fields = array(), $display_name = null){

        if($name){
            $this->name = $name;
        }elseif( isset($_GET['section']) ){
            $this->name = $_GET['section'];
        }elseif( isset($_POST) ){
            $this->name = str_replace('bswp', '',$_POST['option_page']);
        }else{
            throw new Exception("Section not set");
        }


        if($display_name)
            $this->display_name = $display_name;
        else
            $this->display_name = ucwords(str_replace('_',' ', $this->name));

        $this->get_settings_file();
        $this->get_saved_values();
        $this->get_section_field_settings();

        $this->set_values_to_fields();

        $class = __CLASS__;
        // $class = $class;

        if ( empty( $GLOBALS[ $class ] ) )
            $GLOBALS[ $class ] = $this;

    }


    // get all the saved values for this section from the DB, options table
    public function get_saved_values(){
        $this->saved_values = get_option('bswp_'.$this->name);

    }


    // we use a settings file as an index of all settings
    public function get_settings_file(){
        $this->settings_file = dirname(__FILE__).'/section--'.$this->name.'.php';
    }

    // now we grab the field settings
    public function get_section_field_settings(){


        include_once( $this->settings_file );

        foreach( $groups as $key=>$group )
            $this->groups[$key] = $group;
    }


    public function set_values_to_fields(){

        $this->loop_groups();

    }


    private function loop_groups(){

        foreach( $this->groups as &$group ){
            $this->loop_tabs( $group );
        }
    }


    private function loop_tabs( &$group ){
        $tabs = $group->tabs;

        foreach( $tabs as &$tab ){
            $this->loop_fields($tab);
        }
    }


    private function loop_fields( &$tab = array() ){

        $fields = $tab;

        if(!is_array($fields))
            return;

        foreach($fields as $name=>$field){

            $saved_value = $this->find_saved_value($name);
            $tab[$name]->value = $saved_value;
        }

    }


    public function find_saved_value($name) {

        // note, this is temporary, dont use nested forloops kyle
        foreach($this->saved_values as $group)
            foreach($group as $field_name=>$field){
                if($name == $field_name){
                    return $field;
                }
            }
    }


    // register this section to save the fields
    public function register_section_settings(){

        add_settings_section(
            'bswp_'.$this->name.'_section',
            null,
            null,
            'bswp_'.$this->name
        );

        $this->register_field($this->fields);
        register_setting('bswp_'.$this->name, 'bswp_'.$this->name);

    }


    // loop through each field and register it
    public function register_field($fields){
        if(empty($fields))
            return;

        foreach($fields as $field){

            add_settings_field(
                  $field['name'],
                  null,
                  null,
                  'bswp_'.$this->name,
                  'bswp_'.$this->name.'_section'
              );
        }
    }


}
