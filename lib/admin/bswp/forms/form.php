<?php

namespace bswp\forms;

class form {

    public $forms_root = '';
    public $section;
    public $tab;
    public $fields;
    public $settings;

    public function __construct(){
        $this->section = isset($_GET['section']) ? $_GET['section'] : 'theme_settings';
        $this->preview = in_array($this->section, ['sidebar_settings','frontpage_settings'] ) ? false : true;
        $this->settings = $GLOBALS['bswp\fields\settings']->get_field_settings();

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
    public function init(){

        if(!$this->settings)
            return;

        $this->fields = $this->settings;
        wp_enqueue_media();

        $classes = !$this->preview ? 'fields-wrapper--no-preview' : '';
        $output = '';

        $output .= '<form class="bswp-form" method="post" action="options.php">';
            $output .= $this->grab_function_output('settings_fields', 'bswp_'.$this->section );
            $output .= '<div class="fields-wrapper '.$classes.'">';

                $output .= '<div class="tab-content">';
                    $output .= $this->settings_tabs();
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
    public function settings_tabs(){

        $output = '';
        $i = 0;

        foreach($this->settings as $k=>$settings){

            $tab = new settingsTab($settings, $this->fields, $this->section);
            $active = '';

            $id = $settings['section'];
            if(isset($_GET['tab']) )
                $active = $_GET['tab'] == $id ? 'active': '';
            else
                $active = ($i == 0) ? 'active' : '';

            // each section pane - ie background/borders/headers ect
            $output .= '<div id="'.$id.'" class="tab-pane '.$active.'">';
                $output .= $tab->field_tabs();
            $output .= '</div>';
            $i++;
        }

        return $output;
    }


}
