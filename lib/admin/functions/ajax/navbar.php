<?php


// fucking gross ass shit
function rebuild_nav($args = array()) {
    $lib_dir = dirname(dirname(dirname(dirname(__FILE__))));
    include $lib_dir . '/functions/class-navbarMenu.php';
    include $lib_dir . '/functions/class-Navbar.php';
    include $lib_dir . '/functions/class-TemplateSettings.php';

    $new_args = array();

    new TemplateSettings(null, null, null);

    if(!empty($args['dependancies'])) {
        $replace = array('#navbar-settings-','#settings-settings-');
        foreach($args['dependancies'] as &$dep){
            $new_args[str_replace($replace,'', $dep['name'])] = $dep['value'];
        }
    }

    // error_log(json_encode($new_args));
    $navbar = new Navbar('primary-menu', $new_args, 'preview');
    // return the navbar output, and the callback
    return array(
        'output' => $navbar::$output,
        'callback_args' => $new_args['position']
    );

}
