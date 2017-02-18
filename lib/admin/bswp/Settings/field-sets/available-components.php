<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;


$available_components_toggles = array();
$components_array = array(
    'activate_collapsibles',
    'activate_tabs',
    'activate_alerts',
    'activate_tooltips',
    'activate_pagination',
    'activate_well',

    // 'activate_breadcrumbs',
    // 'activate_modals',
);

foreach($components_array as $name){
    $available_components_toggles[$name] = new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>$name,
            'label'=>ucfirst(str_replace('_', ' ', $name))
        )
    );
}
