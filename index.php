<?php
// $bt =  debug_backtrace();
// error_log('sadsakjdl;k;ldkas;lkd');
// error_log("Calling file: ". $bt[0]['file'] . ' line  '. $bt[0]['line']);
/**
 * The index.php file is used to build the page scaffolding
 * for every possible wordpress template sans the custom templates.
 *
 * All logic and markup is handled in the functions files.
 * lib/functions.php defines some basic stuff like feature image sizes, ect ect
 * and lib/kjd_layout_functions.php is where the page is actually built.
 * These files will be further abstracted and cleaned up in the near future
 */


get_header();
    $layout = new Layout();
    echo $layout::scaffolding_init();
get_footer();
