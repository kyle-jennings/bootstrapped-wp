<?php


function rebuild_sidebar($args = array()) {
    global $wpdb;

    $lib_dir = dirname(dirname(dirname(__FILE__)));
    include $lib_dir . '/functions/class-TemplateSettings.php';
    include $lib_dir . '/functions/class-Sidebar.php';
    include $lib_dir . '/functions/class-Columns.php';


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
