<?php


/**
 * Headings
 * Settings for H tags
 * @var array
 */
$headings = array();
$heading_tags = array('h1','h2','h3','h4','h5');

// each H tag is the same, so lets just loop through them to create them
foreach($heading_tags as $heading){
    $headings[$heading] =  array(
       'label'=>$heading,
       'fields'=>array(
           'color'=>color_field(array(
                    'name'=>$heading,
                    'label'=>ucfirst($heading),
                    'type'=>'color',
                )
            ),
           'background_style'=>select_field(array(
                   'name'=>'background_style',
                   'label'=>'Background Style',
                   'args'=>array('none','square','tab', 'pill'),
                   'toggle_field'=>array('background_color','border_style','border_color')
                )
            ),
           'background_color'=>color_field(
                array(
                    'name'=>'background_color',
                    'label'=>'Background Color',
                    'args'=>'transparency'
                )
            ),
           'border_style'=>select_field(array(
                   'name'=>'border_style',
                   'label'=>'Border Style',
                   'args'=>$border_styles,
                )
            ),
           'border_color'=>color_field(array(
                   'name'=>'border_color',
                   'label'=>'Border Color',
               )
           ),
           'decoration'=>text_decoration_field(),
           'text_shadow_color'=>color_field(array('args'=>array(
                    'none',
                    'overline',
                    'underline',
                    'line-through',
                    'text-shadow',
                ))
           )

        ),
    );
}

$headings_fields = array(
    'section'=>'headings',
    'tabs'=>$headings
);

