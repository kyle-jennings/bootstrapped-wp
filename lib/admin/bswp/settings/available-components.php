<?php

namespace bswp\forms\fields;
use bswp\forms\fields;


$available_components_toggles = array();
$components_array = array(
    'activate_collapsibles',
    'activate_tables',
    'activate_tabs',
    'activate_alerts',
    'activate_tooltips',
    'activate_modals',
    'activate_quotes',
    'activate_preformatted',
    'activate_breadcrumbs',
    'activate_pagination',
    'activate_well',
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

// examine($available_components_toggles);
