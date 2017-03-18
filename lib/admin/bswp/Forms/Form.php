<?php

namespace bswp\Forms;

class Form {

    public $preview;
    public $section;


    public function __construct($section_name = null, $preview = true, $section = null ){
        // $this->section_name = isset($_GET['section']) ? $_GET['section'] : 'theme_settings';
        $this->section_name = $section_name ? $section_name : $GLOBALS['bswp\Settings\Section']->name;
        $this->preview = $preview ? $preview : false;
        $this->section = $section ? $section : $GLOBALS['bswp\Settings\Section'];


        // $this->preview = in_array($this->section_name, ['sidebar_settings','frontpage_settings'] ) ? false : true;

    }

    // if there is something like a submit button or a wp_Editor, we grab the output and return it
    public function grab_function_output($func, $arg = null ){
        ob_start();
            call_user_func($func, $arg);
            $ob_content = ob_get_contents();
        ob_end_clean();

        return $ob_content;
    }


    public function get_form_settings($field){
        $form_meta_settings = $GLOBALS['bswp\Settings\Section']->form_meta_settings;

        $setting = isset($form_meta_settings[$field]) ? $form_meta_settings[$field] : '';
        return $GLOBALS['bswp\Settings\Section']->form_meta_settings[$field];
    }

    /**
     * Sets up the form tabs
     *
     * This form holds the tab panes, the tab dropdown. and
     *
     * @param  [array] $settings [nested array with all the section fields]
     * @return [string]           [the markup, dawg]
     */
    public function get_the_form(){

        wp_enqueue_media();


        $classes = !$this->preview ? 'fields-wrapper--no-preview' : '';

        // the current group
        $current_group_name_attr = 'bswp_'.$this->section_name.'[form_meta_settings][group_tab]';
        $this->current_group_value = $current_group_value = $this->get_form_settings('group_tab');

        // the current tab
        $current_tab_name_attr = 'bswp_'.$this->section_name.'[form_meta_settings][field_tab]';
        $this->current_tab_value = $current_tab_value = $this->get_form_settings('field_tab');

        $output = '';

        $output .= '<form class="bswp-form '.$classes.'" method="post" action="options.php" autocomplete="off">';

            $output .= $this->grab_function_output('settings_fields', 'bswp_'.$this->section_name );
            $output .= '<input id="js--group-tab-field" type="hidden" name="'.$current_group_name_attr.'" value="'.$current_group_value.'">';
            $output .= '<input id="js--field-tab-field" type="hidden" name="'.$current_tab_name_attr.'" value="'.$current_tab_value.'">';
            $output .= '<input id="js--saved_fields" type="hidden" name="bswp_'.$this->section_name.'[form_meta_settings][build_css]" value="yes">';


            // $output .= '<div class="fields-wrapper '.$classes.'">';

                $output .= '<div id="groups-tabs" class="tab-content">';
                    $output .= $this->section_groups();
                $output .= '</div>';

                $output .= $this->grab_function_output('submit_button');

            // $output .= '</div>';
        $output .= '</form>';

        if( $this->preview ) {
            $output .= '<div class="preview-options hidden-phone ">';
                $output .= kjd_site_preview($this->section_name);
            $output .= '</div>';
        }

        return $output;
    }


    // display the form
    public function the_form(){
        echo $this->get_the_form();
    }


    // loop through all the groups
    public function section_groups(){

        $output = '';
        $i = 0;

        // examine($GLOBALS['bswp\settings\Section']);
        $groups = $this->section->groups;

        foreach($groups as $group){
            $output .= $this->group_content($group, $this->section_name, $i);
            $i++;
        }

        // examine($output);

        return $output;
    }


    // markup for the tab which is a group
    public function group_content($group = null, $section_name = null, $i = 0) {


        $active = '';

        if($this->current_group_value){
            $is_group = $this->is_saved_group($this->current_group_value, $group->name );
            if($is_group)
                $active = 'active';

        }else
            $active = $i == 0 ? 'active' : '';



        $output = '';
        // each section pane - ie background/borders/headers ect
        $output .= '<div id="'.$group->name.'" class="tab-pane group-content '.$active.'">';
            $output .= $this->group_tabs($group->tabs,  $section_name, $group->name );
        $output .= '</div>';



        return $output;
    }


    // Loop through the tabs in a group
    public function group_tabs($tabs,  $section_name = null, $group_name = null) {
        $output = '';

        // $output .= $this->tab_dropdown($tabs, $group_name);


        $output .= '<div class="tab-content tab-content--fields js--fields-tabs-wrapper">';
        $i = 0;

        if(!is_array($tabs))
            return;

        foreach($tabs as $tab_name=>$tab){
            $output .= $this->tab_content($tab,  $section_name, $tab_name, $group_name, $i );
            $i++;
        }
        $output .= '</div>';

        return $output;
    }


    // produce the tab markup
    public function tab_content( $tab,  $section_name = null, $tab_name = '', $group_name = '', $number = 0  ){

        $is_group = $this->is_saved_group($this->current_group_value, $group_name );
        $is_tab = $this->is_saved_tab($this->current_tab_value, 'fields_'.$group_name.'_'.$tab_name);

        $active = $number === 0 ? 'active' : '';
        if( $this->current_tab_value && $is_group  )
                $active = $is_tab ? 'active' : '';

        $output = '';

        $output .= '<div class="js--fields-group tab-pane cf '.$active.'" id="fields_'.$group_name.'_'.$tab_name.'">';
            $output .= $this->fields($tab);
        $output .= '</div>';

        return $output;
    }



    //  loop through all the fields and display it
    public function fields($fields) {
        if(empty($fields) || !is_array($fields) )
            return;

        $output = '';

        foreach($fields as $field) {
            $output .= $field->get_the_field();
        }

        return $output;
    }




    // the tab dropdown
    public function tab_dropdown($tabs, $group_name = ''){

        $output = '';

        if(!is_array($tabs))
            return;

        // reset the tabs to get first tabname
        reset($tabs);
        $tab_name = key($tabs);
        $label = $tab_name;

        // sets the correct label
        $is_group = $this->is_saved_group($this->current_group_value, $group_name );
        $is_tab = $this->is_saved_tab($this->current_tab_value, 'fields_'.$group_name.'_'.$tab_name);
        if( $this->current_tab_value && $is_group  )
            $label= str_replace('#','',str_replace('fields_'.$group_name.'_','' , $this->current_tab_value));



        $label = str_replace('_', ' ', $label);
        $label = ucfirst($label);

        $output .= '<div class="btn-group tab-switcher">';
            $output .= '<a class="btn btn-primary dropdown-toggle tab-switcher__dropdown" data-toggle="dropdown" href="#">';
                $output .= '<h6>'. ucwords($group_name) . '</h6>';
                $output .= '<span class="btn-face">'.$label.'</span>';
                $output .= '<span class="caret"></span>';
            $output .= '</a>';
            $output .= '<ul class="dropdown-menu">';

                foreach($tabs as $key=>$tab)
                    $output .= $this->tab_dropdown_link($tab, $key, $group_name);

            $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }


    // The tab links in the dropdown
    public function tab_dropdown_link($tab, $label, $group_name = ''){

        $name = str_replace(' ','_',strtolower($label));
        $label = str_replace('_', ' ', $label);
        $label = ucfirst($label);

        $output = '';
        $output .= '<li>';
            $output .= '<a href="#fields_'.$group_name.'_'.$name.'" data-toggle="tab">'.$label.'</a>';
        $output .= '</li>';

        return $output;
    }



    public function is_saved_group( $saved_group_name, $current_group_name) {

        if($saved_group_name == $current_group_name || strpos($saved_group_name, $current_group_name) != false ){
            // error_log('Group: '.$saved_group_name . ' - ' . $current_group_name );
            return true;
        }


        return false;

    }



    public function is_saved_tab($saved_tab_name, $current_tab_name) {
        // error_log($saved_tab_name .'--'. $current_tab_name);
        if($saved_tab_name == $current_tab_name || strpos($saved_tab_name, $current_tab_name) != false ){
            return true;
        }

        return false;
    }

}
