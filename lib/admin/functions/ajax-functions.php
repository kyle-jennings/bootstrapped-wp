<?php

use bswp\Settings;
use bswp\Menus\AdminMenu;
use bswp\Menus\Nav;
use bswp\CSS\Builder;

/**
 * build the CSS to preview.css
 * @return [type] [description]
 */
function bswp_live_preview() {

    if( !isset($_POST['data']) )
        die;

    $data = $_POST['data'];


    $builder = new Builder($data[$section], $data['form_values'], true);
    $builder->build();
    $builder->save_to_file('preview');

    unset($builder);
    die;
}

add_action('wp_ajax_bswp_live_preview', 'bswp_live_preview');



function bswp_ajax_preview_args() {

    if( !isset($_POST['data']) )
        die;

    $output = '';

    $data = $_POST['data'];
    $section = new Settings\Section($data['section']);
    $field = $section->groups[$data['group']]->tabs[$data['tab']][$data['field']];



    // set the json object
    $json = new stdClass();
    $json->output = '';

    if($field->preview_args && function_exists($field->preview_args)){

        $return = call_user_func($field->preview_args, $data);

        $json->output = $return['output'];
        $json->callback_args = $return['callback_args'];
        $json->args = $field->preview_args;

    }

    if($field->preview_callback)
        $json->preview_callback = $field->preview_callback;

    echo json_encode($json);
    die;
}
add_action('wp_ajax_bswp_ajax_preview_args', 'bswp_ajax_preview_args');



// fucking gross ass shit
function rebuild_nav($args = array()) {
    $lib_dir = dirname(dirname(dirname(__FILE__)));
    include $lib_dir . '/functions/class-navbarMenu.php';
    include $lib_dir . '/functions/class-Navbar.php';

    $new_args = array();
    // get all the ars for the new navbar
    foreach($args['dependancies'] as &$dep){
        $new_args[str_replace('#navbar-settings-','', $dep['name'])] = $dep['value'];
    }

    $navbar = new Navbar('primary-menu', $new_args, 'preview');
    // return the navbar output, and the callback
    return array(
        'output' => $navbar->output,
        'callback_args' => $new_args['position']
    );

}


function rebuild_header($args = array()){

    $lib_dir = dirname(dirname(dirname(__FILE__)));
    include $lib_dir . '/functions/class-Header.php';

    $custom_content = null;
    $styles = null;
    $page_type = null;
    $url = $args['iframeURL'] ? $args['iframeURL'] : null;

    if( rtrim($url, '/') != rtrim(get_site_url(),'/') && $args['tab'] == 'front_page' )
        return array('output' => 'no-change');

    foreach($args['dependancies'] as $dep){
        if(strpos($dep['name'], 'custom_content') !== false)
            $custom_content = $args['value'] !== 'title' ? $dep['value'] : null;
        else
            $new_args[str_replace('#header-settings-','', $dep['name'])] = $dep['value'];
    }

    // content, styles, page type, url
    $header = new Header($custom_content, $styles, $page_type, $url);

    return array(
        'output' => $header->output,
        'callback_args' => '',
        'args' => $new_args
    );
}
