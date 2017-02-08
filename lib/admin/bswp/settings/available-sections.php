<?php

namespace bswp\forms\fields;
use bswp\forms\fields;


$available_sections_toggles = array(
    'activate_title_area'=>new Select(
        array(
            'args'=>array('yes','no'),
            'name'=>'activate_body',
            'label'=>'Body Settings'
        )
    ),

    'activate_header'=>new Select(
        array(
            'args'=>array('yes','no'),
            'name'=>'activate_header',
            'label'=>'Header Settings'
        )
    ),

    'activate_Navbar'=>new Select(
        array(
            'args'=>array('yes','no'),
            'name'=>'activate_Navbar',
            'label'=>'Navbar Settings'
        )
    ),

    'activate_title_area'=>new Select(
        array(
            'args'=>array('yes','no'),
            'name'=>'activate_title_area',
            'label'=>'Title Area Settings'
        )
    ),

    'activate_sidebar'=>new Select(
        array(
            'args'=>array('yes','no'),
            'name'=>'activate_sidebar',
            'label'=>'Sidebar Settings'
        )
    ),
    'activate_footer'=>new Select(
        array(
            'args'=>array('yes','no'),
            'name'=>'activate_footer',
            'label'=>'Footer Settings'
        )
    ),
);
