<?php

/**
 * Text and link colors
 * @var array
 */
$links = array();
$link_targets = array('normal','hover','active','visited');

$links['text'] = color_field();

// Each link type is dynamically created, no need to repat ouselves since they are all the same.
foreach($link_targets as $link){
    $links[$link] = array(
        'tab_name'=>array(
           'label'=>ucfirst($link),
           'fields'=>array(
               'color'=>color_field(),
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
                'decoration'=>$decoration_field,
                'text_shadow'=>text_shadow_color_field()

            ),
        ),
    );
}
$text_fields = array(
    'section'=>'text',
    'tabs'=>$links
);

