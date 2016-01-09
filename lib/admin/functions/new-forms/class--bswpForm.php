<?php
// Moved the feild generators into their own class to keep things short and clean
// things were getting grody
include('class--bswpFieldGenerators.php');

class bswpForm extends bswpFieldGenerators {

    public $forms_root = '';
    public $section;
    public $tab;
    public $fields;

    public function __construct(){
        $this->section = isset($_GET['section']) ? $_GET['section'] : 'theme_settings';
        $this->preview = in_array($this->section, ['sidebar_settings','frontpage_settings'] ) ? false : true;
    }

    // if there is something like a submit button or a wp_Editor, we grab the output and return it
    public function grab_function_output($func, $arg = null ){
        ob_start();
            call_user_func($func, $arg);
            $ob_content = ob_get_contents();

        ob_end_clean();

        return $ob_content;
    }


    /**
     * Sets up the form tabs
     *
     * This form holds the tab panes, the tab dropdown. and
     *
     * @param  [array] $settings [nested array with all the section fields]
     * @return [string]           [the markup, dawg]
     */
    public function init($settings){

        if(!$settings)
            return;

        $this->fields = $settings;
        wp_enqueue_media();

        $classes = !$this->preview ? 'fields-wrapper--no-preview' : '';
        $output = '';

        $output .= '<form class="bswp-form" method="post" action="options.php">';
            $output .= $this->grab_function_output('settings_fields', 'bswp_'.$this->section );
            $output .= '<div class="fields-wrapper '.$classes.'">';

                $output .= '<div class="tab-content">';
                    $output .= $this->settings_tabs($settings);
                $output .= '</div>';

                $output .= $this->grab_function_output('submit_button');

            $output .= '</div>';
        $output .= '</form>';

        if($this->preview){
            $output .= '<div class="preview-options">';
                $output .= kjd_site_preview($this->section);
            $output .= '</div>';
        }

        return $output;
    }

    /**
     * Each tab's pane, activated by the dropdown
     *
     * Each set of settings (backgrounds, borders, text ect) get their own tab-pane
     * becase we are keeping each section's settings on the same page
     * @return [type] [description]
     */
    public function settings_tabs($settings_group){


        $output = '';
        $i = 0;
        foreach($settings_group as $k=>$settings){
            $active = '';

            $id = $settings['section'];
            if(isset($_GET['tab']) )
                $active = $_GET['tab'] == $id ? 'active': '';
            else
                $active = ($i == 0) ? 'active' : '';

            // each section pane - ie background/borders/headers ect
            $output .= '<div id="'.$id.'" class="tab-pane '.$active.'">';
                $output .= $this->field_tabs($settings);
            $output .= '</div>';
            $i++;
        }

        return $output;
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
    public function field_tabs($settings = array()){

        $tabs = $settings['tabs'];

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

        // get the tab pain
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
            $output .= $this->create_tab_content($tab,$i,$current_tab);
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

            $output .= $this->identify_fields($fields, $name, $current_tab);
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

            $data_toggled_by = '';
            $data_toggle_name = '';

            if(!is_null($toggled_by) ){
                $toggles = $this->toggle_fields_markup($toggled_by, $name, $current_tab);
                extract($toggles);
            }

            $output .= '<div class="option '.$data_toggled_by.' '.$type.'" '.$data_toggle_name.' >';
                $output .= call_user_func( array($this, $type.'_field_generator'), $field, $tab);
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