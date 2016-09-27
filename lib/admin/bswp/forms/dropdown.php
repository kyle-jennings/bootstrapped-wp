<?php

namespace bswp\forms;

class dropdown {

    public $output = '';
    public $tabs;

    public function __toString(){
        return $this->$output;
    }

    public function __construct($tabs){
        $this->tabs = $tabs;
    }

    // the tab dropdown
    public function fields_tab_dropdown(){
        $tabs = $this->tabs;
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


}
