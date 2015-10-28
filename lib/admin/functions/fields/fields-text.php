<?php

/**
 * Text and link colors
 * @var array
 */
$links = array();
$link_targets = array('normal','hover','active','visited');

$links['text'] = array(
    'label' => 'Text',
    'fields' => array(
        'color'=>color_field(array(
                'name'=>'text',
                'label'=>'Text',
                'type'=>'color',
            )
        )
    )
);

// Each link type is dynamically created, no need to repat ouselves since they are all the same.
foreach($link_targets as $link){
    $links[$link] = array(
       'label'=>ucfirst($link),
       'fields'=>array(
           'color'=>color_field(array(
                    'name'=>$link.'_link',
                    'label'=>$link.' Link',
                    'type'=>'color',

                )
            ),
            'background_style'=>select_field(array(
                    'name'=>'background_style',
                    'label'=>'Background Style',
                    'args'=>array('highlighted','pills'),
                    'toggle_fiel'=>array('background_color')
                )
            ),
            'background_color'=>color_field(array(
                    'name'=>'background_color',
                    'label'=>'Background Color',
                )
            ),
            'decoration'=>text_decoration_field( array(
                    'name'=>'text_decoration',
                    'label'=>'Text Decoration'
                )
            ),
            'text_shadow'=>text_shadow_color_field()
        ),
    );
}


$text_fields = array(
    'section'=>'text',
    'tabs'=>$links
);