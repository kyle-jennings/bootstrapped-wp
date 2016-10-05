<?php

/**
 * Text and link colors
 * @var array
 */
$links = array();
$link_targets = array('normal_links','hover_links','active_links','visited_links');

$links['text'] = array(
    'label' => 'Text',
    'fields' => array(
        'text_color'=>color_field(array(
                'name'=>'text_color',
                'label'=>'Text',
                'type'=>'color',
            )
        )
    )
);

// Each link type is dynamically created, no need to repat ouselves since they are all the same.
foreach($link_targets as $link){
    $links[$link] = array(
       'label'=>str_replace('_',' ',ucfirst($link)),
       'fields'=>array(
           $link.'_color'=>color_field(array(
                    'name'=>$link.'_color',
                    'label'=> ucwords(str_replace('_',' ',$link)).' Color',
                    'type'=>'color',
                )
            ),

            $link.'_background_style'=>select_field(array(
                    'name'=>$link.'_background_style',
                    'label'=>'Background Style',
                    'args'=>array('none','highlighted','pills'),
                    'toggle_fields'=>array('highlighted'=>$link.'_background_color', 'pills'=>$link.'_background_color')
                )
            ),
            $link.'_background_color'=>color_field(array(
                    'name'=>$link.'_background_color',
                    'label'=>'Background Color',
                    'toggled_by'=>array( $link.'_background_style'=>'highlighted',  $link.'_background_style'=>'pills')
                )
            ),


            $link.'_text_decoration' => text_decoration_field( array(
                    'name' => $link.'_text_decoration',
                    'label' => 'Text Decoration',
                    'toggle_fields' => array('text-shadow'=>$link.'_text_shadow')
                )
            ),
            $link.'_text_shadow'=>text_shadow_color_field( array(
                    'name'=>$link.'_text_shadow',
                    'toggled_by' => array($link.'_text_decoration' => 'text-shadow')
                )
            )
        ),
    );
}


$text_fields = array(
    'section'=>'text',
    'tabs'=>$links
);
