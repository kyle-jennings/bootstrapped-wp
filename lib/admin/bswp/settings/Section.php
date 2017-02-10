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

    public $current_group = '';
    public $groups;
    public $fields = array();


    /**
     * sets the section name, this is used to grab all the saved values from
     * the DB, and also register all fields.
     */
    public function __construct($name = null, $fields = array(), $display_name = null){

        if($name){
            // examine('set');
            $this->name = $name;
        }elseif( isset($_GET['section']) ){
            // examine('get');
            $this->name = $_GET['section'];
        }elseif( !empty($_POST)){

            if( !isset($_POST['option_page'])
                || $_POST['option_page'] != 'bswp_site_settings'
                || empty($_POST['bswp_site_settings'])
            )
                return;
            // examine($_POST['bswp_site_settings']);
            $this->name = str_replace('bswp_', '',$_POST['option_page']);
        }else{
            $this->name = 'site_settings';
        }


        if($display_name)
            $this->display_name = $display_name;
        else
            $this->display_name = ucwords(str_replace('_',' ', $this->name));

        $this->get_settings_file();
        $this->get_saved_values();

        if($_GET['show_saved_values'] == 'yes')
            examine($this->saved_values);


        $class = __CLASS__;
            $GLOBALS[ $class ] = $this;

        $this->get_section_field_settings();
        $this->set_values_to_fields();

        $this->form_meta_settings = $this->saved_values['form_meta_settings'];

        unset($this->saved_values);


        if($_GET['show_object'] == 'yes')
            examine($this);
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


    // get all the saved values for this section from the DB, options table
    public function get_saved_values(){
        $this->saved_values = get_option('bswp_'.$this->name);

    }


    // Start process to take the set values and save them to the fields
    public function set_values_to_fields(){
        foreach( $this->groups as &$group ){
            $group->set_section($this->name);
            $group->loop_tabs();
        }
    }


    // see if the field has a saved value
    public function find_saved_value($name, $group_name = '', $tab_name = '') {

        if( empty( $this->saved_values[$group_name] ) )
            return false;

        // loop through all fields
        foreach( $this->saved_values[$group_name] as $field_name=>$field ){
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

        register_setting('bswp_'.$this->name, 'bswp_'.$this->name);
        // foreach($this->groups as $group_name=>$group){
        //     $this->register_field($group);
        // }

    }





}
