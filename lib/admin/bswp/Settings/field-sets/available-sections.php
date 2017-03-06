<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;


$available_sections_toggles = array(
    'activate_title_area'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'activate_body',
            'label'=>'Body Settings'
        )
    ),

    'activate_header'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'activate_header',
            'label'=>'Header Settings'
        )
    ),

    'activate_title_area'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'activate_title_area',
            'label'=>'Title Area Settings'
        )
    ),
    'activate_body'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'activate_body',
            'label'=>'Body Settings'
        )
    ),
    'activate_sidebar'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'activate_sidebar',
            'label'=>'Sidebar Settings'
        )
    ),
    'activate_footer'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'activate_footer',
            'label'=>'Footer Settings'
        )
    ),
);