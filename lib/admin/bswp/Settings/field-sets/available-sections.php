<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;


$available_sections = array(
    // 'activate_header'=>new Select(
    //     array(
    //         'args'=>array('no', 'yes'),
    //         'name'=>'activate_header',
    //         'label'=>'Header Settings'
    //     )
    // ),
    // 'activate_navbar'=>new Select(
    //     array(
    //         'args'=>array('no', 'yes'),
    //         'name'=>'activate_navbar',
    //         'label'=>'Navbar Settings'
    //     )
    // ),
    'body'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'body',
            'label'=>'Body Settings'
        )
    ),
    'sidebar'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'sidebar',
            'label'=>'Sidebar Settings'
        )
    ),
    // 'activate_footer'=>new Select(
    //     array(
    //         'args'=>array('no', 'yes'),
    //         'name'=>'activate_footer',
    //         'label'=>'Footer Settings'
    //     )
    // ),
);
