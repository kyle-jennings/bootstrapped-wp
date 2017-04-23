<?php


// fucking gross ass shit
function rebuild_nav($args = array()) {
    $lib_dir = dirname(dirname(dirname(__FILE__)));
    include $lib_dir . '/functions/class-navbarMenu.php';
    include $lib_dir . '/functions/class-Navbar.php';

    $new_args = array();
    // error_log('navbar change: ');
    // error_log(json_encode($args));

    if(!empty($args['dependancies'])) {
        foreach($args['dependancies'] as &$dep){
            $new_args[str_replace('#navbar-settings-','', $dep['name'])] = $dep['value'];
        }
    }

    $navbar = new Navbar('primary-menu', $new_args, 'preview');
    // return the navbar output, and the callback
    return array(
        'output' => $navbar::$output,
        'callback_args' => $new_args['position']
    );

}
