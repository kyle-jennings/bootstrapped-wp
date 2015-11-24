<?php
class bswpFields{

    public $section;
    public $settings;
    public $saved_values;

    public function __construct(){

        if( isset($_GET['section']) ){
            $this->section = $_GET['section'];
        }elseif( isset($_POST) ){
            $this->section = ltrim($_POST['option_page'],'bswp_');
        }else{
            return false;
        }

        $this->saved_values = get_option('bswp_'.$this->section);

        $settings_array = $this->section.'_tabs';

        // get the fields file
        $theme_root = get_template_directory();
        $file = $theme_root.'/lib/admin/functions/fields/settings.php';
        include_once($file);

        $this->settings = $$settings_array;

        $class = __CLASS__;
        if ( empty( $GLOBALS[ $class ] ) )
            $GLOBALS[ $class ] = $this;

    }


    public function get_field_settings(){

        return $this->settings;
    }

    public function register_section_settings(){

        $section = $this->section;
        $settings_groups = $this->settings;
        if(empty($settings_groups))
            return;

        foreach ($settings_groups as $settings){

            $field_groups = $settings['tabs'];

            add_settings_section(
                'bswp_'.$section.'_section',
                null,
                null,
                'bswp_'.$section
            );

            $this->register_field_settings($field_groups, $section);

            register_setting('bswp_'.$section, 'bswp_'.$section);
        }
    }

    public function register_field_settings($field_groups, $section){

        // loop through each tab
        foreach($field_groups as $field_group){
            $fields = $field_group['fields'];

            foreach($fields as $field){
              add_settings_field(
                    $field['name'],
                    null,
                    null,
                    'bswp_'.$section,
                    'bswp_'.$section.'_section'
                );
            }
        }

    }

}