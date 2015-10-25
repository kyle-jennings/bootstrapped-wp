<?php

class bswpBuildForm extends fieldsClass{

    public $field_generators;
    public function __construct(){
        // $this->field_generators = new bswpFieldGenerators;
    }

    public function grab_function_output($func){
        ob_start();
            call_user_func('submit_button');
            $ob_content = ob_get_contents();

        ob_end_clean();

        return $ob_content;
    }

    public function init($settings){

        if(!$settings)
            return;

        wp_enqueue_media();

        $output = '';
        $output .= '<form method="post" action="options.php">';
            $output .= '<div class="fields-wrapper">';
                $output .= $this->field_generators->field_tab_generator($settings);
                $output .= $this->grab_function_output('submit_button');
            $output .= '</div>';
        $output .= '</form>';

        return $output;
    }

}