<?php

/**
 * Presentation Components
 */

/**
 * Gross shit again - basically all teh components are the same
 * Each component is just a set of color fields, with a couple small exceptions
 * so we do not need to define all the settings, we make the assumption that they
 * are color fields. If there ARE options (via arrays) then we handle that in a function
 */
$component_includes = array(
    'blockquote',
    'collapsibles',
    'iframes',
    'forms',
    'nav-lists',
    'pagination',
    'pre',
    'tabbables',
    'tables'
);


foreach($component_includes as $include)
    include_once('fields-'.$include.'.php');







$components = array(
    'tabbed_content'=>array(
        'label'=>'Tabbed Content',
        'fields' => $tabbed_content
    ),
    'collapsibles'=>array(
        'label'=>'Collapsibles',
        'fields' => $collapsibles
    ),
    'tables'=>array(
        'label'=>'Tables',
        'fields' => $tables
    ),
    'pagination'=>array(
        'label'=>'Pagination',
        'fields' => $pagination
    ),
    'nav_lists'=>array(
        'label'=>'Nav Lists',
        'fields' => $nav_lists
    ),
    'pre'=>array(
        'label'=>'Preformatted',
        'fields' => $pre
    ),
    'blockquote'=>array(
        'label'=>'Blockquotes',
        'fields' => $blockquote
    ),
    'forms'=>array(
        'label'=>'Forms',
        'fields'=>$forms
    ),
);

// examine($components);

// compiled components fields
$components_fields = array();
