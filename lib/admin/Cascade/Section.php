<?php

namespace Cascade;

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
    public $is_active = false;
    public $inherits_from = array();

    public $fields = array();


    /**
     * sets the section name, this is used to grab all the saved values from
     * the DB, and also register all fields.
     */
    public function __construct($name = null, $fields = array() ){

        if($name){
            $this->name = $name;
        }elseif( isset($_GET['section']) ){
            $this->name = $_GET['section'];
        }elseif( isset($_POST) ){
            $this->name = str_replace('cascade_', '',$_POST['option_page']);
        }else{
            throw new Exception("Section not set");
        }


        $class = __CLASS__;

        if ( empty( $GLOBALS[ $class ] ) )
            $GLOBALS[ $class ] = $this;
    }


    public function get_saved_values(){
        $this->saved_values = get_option('cascade_'.$this->name);

    }


    // register this section to save the fields
    public function register_section_settings(){

        add_settings_section(
            'cascade_'.$this->name.'_section',
            null,
            null,
            'cascade_'.$this->name
        );

        $this->register_field($this->fields);
        register_setting('cascade_'.$this->name, 'cascade_'.$this->name);

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
                  'cascade_'.$this->name,
                  'cascade_'.$this->name.'_section'
              );
        }
    }


}
