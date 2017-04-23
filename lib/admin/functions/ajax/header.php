<?php


function rebuild_header($args = array()){

    $lib_dir = dirname(dirname(dirname(dirname(__FILE__))));
    include $lib_dir . '/functions/class-TemplateSettings.php';
    include $lib_dir . '/functions/class-Header.php';
    include $lib_dir . '/functions/class-navbarMenu.php';
    include $lib_dir . '/functions/class-Navbar.php';


    $custom_content = null;
    $styles = null;
    $page_type = null;
    $url = $args['iframeURL'] ? $args['iframeURL'] : null;
    $iframeURLID = get_page_id($url);
    $content_type = $args['field'] == 'content_type' ? $args['value'] : null;
    $template_type = str_replace('_page','',$args['tab']);

    new TemplateSettings($template_type, null, $iframeURLID);

    if(!empty($args['dependancies'])) {
        foreach($args['dependancies'] as $dep){

            // if the dep name is custom content,
            // and the arg value is not title (that is to say, the content type is not sety to "title")
            if(strpos($dep['name'], 'custom_content') !== false){
                $content_type = $args['value'] !== 'title' ? 'custom_content' : 'title';
                $custom_content = $args['value'] !== 'title' ? $dep['value'] : null;
            }
            else
                $new_args[str_replace('#header-settings-','', $dep['name'])] = $dep['value'];
        }
    }



    $array = array(
        'output' => 'no-change',
    );
    if($template_type == $GLOBALS['TemplateSettings']::$template_type) {

        $header = new Header($url, new Navbar('primary-menu'));
        $header::set_content($content_type, $custom_content);
        if(!$custom_content || $content_type == 'title')
            $header::select_content();
        $header::inner_markup();

        $array = array(
            'output' => $header::$output,
            'callback_args' => '',
            'args' => $new_args
        );
    }

    return $array;


}


function rebuild_header_custom_content($args = array()){

    $args['value'] = 'custom_content';
    return rebuild_header($args);

}
