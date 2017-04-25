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


function rebuild_sidebar($args = array()) {

    $lib_dir = dirname(dirname(dirname(dirname(__FILE__))));
    include $lib_dir . '/functions/class-TemplateSettings.php';
    include $lib_dir . '/functions/class-Sidebar.php';
    include $lib_dir . '/functions/class-Columns.php';
    include $lib_dir . '/functions/frontpage-functions.php';


    $url = $args['iframeURL'];
    $iframeURLID = get_page_id($url);
    // sidebar args
    $template_type = str_replace('_widgets','',$args['value']['target']);
    $position = $args['value']['position'];
    $visibility = $args['value']['visibility'];

    new TemplateSettings(null, null, $iframeURLID);

    $array = array();


    // examine($template_type .'=>'. $GLOBALS['TemplateSettings']::$template_type);

    if($template_type == $GLOBALS['TemplateSettings']::$template_type) {

        // error_log($template_type.'---'.$position.'---'.$visibility);
        $sidebar = new Sidebar($template_type, $position, $visibility, 'preview');


        $new_args = array(
            'position' => $position,
            'visibility' => $visibility,
            'isSection' => $GLOBALS['TemplateSettings']::isHorizontalSidebar()
        );

        if($template_type == 'frontpage'){
            $new_args['fp_widget_areas'] = get_frontpage_sortble_widgets();
        }


        $array = array(
            'output' => $sidebar->output,
            'callback_args' => $new_args,
            'args' => $new_args
        );

    }

    return $array;
}
