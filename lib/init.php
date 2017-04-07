<?php

if(! function_exists('examine') ){

    function examine($object, $examine_type = 'print_r', $die = 'hard'){
        if(empty($object))
            return;

        echo '<pre>';
        if($examine_type == 'var_dump')
            var_dump($object);
        else
            print_r($object);

        if($die != 'soft')
            die;
    }

}


// gets options function
if(is_admin())
    include 'admin/init.php' ;

if(!is_admin()){
    require_once('functions/add-assets.php');
    require_once('functions/excerpts.php');
    require_once('functions/gallery.php');
    require_once('functions/class-TemplateSettings.php');
    require_once('functions/shortcodes.php');
    require_once('functions/class-Navbar.php');
    require_once('functions/class-Header.php');
    require_once('functions/class-Sidebar.php');
    require_once('functions/class-Columns.php');
    require_once('functions/class-Layout.php');
    require_once('functions/frontpage-functions.php');
    require_once('functions/class-Pagination.php');
    require_once('functions/class-Scaffolding.php');
    require_once('functions/class-Content.php');
    require_once('functions/class-mobileMenu.php');
    require_once('functions/class-navbarMenu.php');
}


require_once('functions/functions.php');
require_once('functions/class-SetupWidgets.php');
