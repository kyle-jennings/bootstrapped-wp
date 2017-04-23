<?php


function get_frontpage_sortble_widgets() {

    $options = get_option('bswp_site_settings');
    $frontpage_sidebar = $options['layouts']['sidebars']['frontpage'];
    $sortables = $options['layouts']['frontpage']['frontpage_layout_sortable'];
    $sortables = json_decode($sortables);

    $areas = array();
    foreach($sortables as $sortable){
        if(strpos($sortable->name, 'widgets')){
            $output = '';
            $output .= '<div class="row '.$sortable->visibility.' frontpage-component">';
                $output .= new Sidebar($sortable->name, 'top', $sortable->visibility, 'preview');
            $output .= '</div>';
            $areas[] = $output;
        }

    }

    return $areas;
}
