<?php

namespace bswp\forms\fields;

class sidebarField extends fieldMethods {

    public $output;

    public function __construct($args=array(), $tab = null){

        $output = '';

        // create the first select
        $output .= $this->select_field_generator($args);

        // the extract the args to reuse

        extract($args);
        // output the diagram and device visibility
        $positions = array('none','top','right','bottom','left');

        // get the sidebar value
        $target = key($toggled_by);


        $output .= '<div class="layout_preview">';
            foreach($positions as $position){
                $display = ($this->find_value($target) == $position) ? 'display:block' : 'display:none';
                $output .= '<img class="'.$position.'" style="'.$display.'" src="'.get_bloginfo("template_directory").'/images/widgets'.$position.'.png" >';
            }
        $output .= '</div>';

        // end diagram/visibility output

        $this->output = $output;

    }

    public function __toString(){
        return $this->output;
    }
}
