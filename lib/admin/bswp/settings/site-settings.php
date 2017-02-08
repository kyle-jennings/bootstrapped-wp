<?php

namespace bswp\forms\fields;
use bswp\forms\fields;

$site_settings = array(

    'logo'=>new File(array(
            'name'=>'logo',
            'label'=>'Logo',
        )
     ),
    'favicon'=>new File(array(
            'name'=>'favicon',
            'label'=>'Favicon'
        )
    ),
    'logo_site_toggle'=>new Select(array(
            'name'=>'logo_site_toggle',
            'label'=>'Toggle site logo',
            'args'=>array(
                'logo',
                'custom',
                'site_title'
            ),
            'toggle_fields'=>array('custom'=>'custom_header')
        )
    ),
    'custom_header'=>new TextArea(array(
            'name'=>'custom_header',
            'label'=>'Custom Header',
            'args'=>'wp_editor',
            'toggled_by'=>array('logo_site_toggle'=>'custom'),
        )
    ),
    'resonsive'=>new Select(array(
            'name'=>'responsive',
            'label'=>'Site Structure',
            'args'=>array(
                'full_width',
                'box'
            )
        )
    ),
    '404_page'=>new TextArea(array(
            'name'=>'404_page',
            'label'=>'404 page content',
            'args'=>'wp_editor'
        )
    )
);
