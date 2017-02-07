<?php


namespace bswp\forms\fields;
use bswp\forms\fields;

use function bswp\settings\_helpers;
use function bswp\settings\_helpers\border_settings_map;
use function bswp\settings\_helpers\add_px_string;
use function bswp\settings\_helpers\heading_toggle;


$link_targets = array('links','hovered_links','active_links','visited_links');

$regular_text = array(

    'text_color'=>new ColorPicker(array(
            'name'=>'text_color',
            'label'=>'Text',
            'type'=>'color',
        )
    )

);

// Each link type is dynamically created, no need to repat ouselves since they are all the same.
foreach($link_targets as $link){
    $$link = array(

       $link.'_color'=>new ColorPicker(array(
                'name'=>$link.'_color',
                'label'=> ucwords(str_replace('_',' ',$link)).' Color',
                'type'=>'color',
            )
        ),

        $link.'_background_style'=>new Select(array(
                'name'=>$link.'_background_style',
                'label'=>'Background Style',
                'args'=>array('none','highlighted','pills'),
                'toggle_fields'=>array('highlighted'=>$link.'_background_color', 'pills'=>$link.'_background_color')
            )
        ),
        $link.'_background_color'=>new ColorPicker(array(
                'name'=>$link.'_background_color',
                'label'=>'Background Color',
                'toggled_by'=>array( $link.'_background_style'=>'highlighted',  $link.'_background_style'=>'pills'),
                'args' =>'transparency'
            )
        ),
        $link.'_background_color_rgba'=>new Hidden(
            array(
                'name'=>$link.'_background_color_rgba',
                'label'=>''
            )
        ),

        $link.'_text_decoration' => new Select( array(
                'name' => $link.'_text_decoration',
                'label' => 'Text Decoration',
                'toggle_fields' => array('text-shadow'=>$link.'_text_shadow'),
                'args' => array(
                    'none',
                    'overline',
                    'underline',
                    'line-through',
                    'text-shadow',
                ),
            )
        ),
        $link.'_text_shadow'=> new ColorPicker( array(
                'name'=>$link.'_text_shadow',
                'toggled_by' => array($link.'_text_decoration' => 'text-shadow'),
                'args' =>'transparency'
            )
        ),
        $link.'_text_shadow_rgba'=>new Hidden(
            array(
                'name'=>$link.'_text_shadow_rgba',
                'label'=>''
            )
        ),

    );
}
