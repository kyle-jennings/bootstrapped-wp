<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;


$available_sections = array(
    'header'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'header',
            'label'=>'Header'
        )
    ),
    'navbar'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'navbar',
            'label'=>'Navbar'
        )
    ),
    'body'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'body',
            'label'=>'Body',

        )
    ),
    'sidebar'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'sidebar',
            'label'=>'Sidebar',

        )
    ),
    'horizontal_sidebar'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'horizontal_sidebar',
            'label'=>'Horizontal Sidebar',

        )
    ),

    'footer'=>new Select(
        array(
            'args'=>array('no', 'yes'),
            'name'=>'footer',
            'label'=>'Footer',

        )
    ),
);


foreach($available_sections as &$section){
    $section->preview = 'form_save_warning';
}
