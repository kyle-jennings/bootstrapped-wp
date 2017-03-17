<?php


namespace bswp\Forms\Fields;
use bswp\Forms\Fields;

use function bswp\Settings\_helpers;
use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;
use function bswp\Settings\_helpers\heading_toggle;


$link_targets = array('link','hovered_link','active_link');

// Each link type is dynamically created, no need to repat ouselves since they are all the same.
foreach($link_targets as $name){


    $$name = array(

       $name.'_color'=>new ColorPicker(array(
                'name'=>$name.'_color',
                'label'=> ucwords(str_replace('_',' ',$name)).' Color',
                'type'=>'color',
            )
        ),

        $name.'_background_style'=>new Select(array(
                'name'=>$name.'_background_style',
                'label'=>'Background Style',
                'args'=>array('none','highlighted','pills'),
                'toggle_fields'=>array(
                    'highlighted'=> $name.'_background_color',
                    'pills' =>  $name.'_background_color',
                ),
            )
        ),
        $name.'_background_color'=>new ColorPicker(array(
                'name'=>$name.'_background_color',
                'label'=>'Background Color',
                'toggled_by'=>array( $name.'_background_style'=>'highlighted,pills' ),
                'args' =>'transparency'
            )
        ),
        $name.'_background_color_rgba'=>new Hidden(
            array(
                'name'=>$name.'_background_color_rgba',
                'label'=>''
            )
        ),

        $name.'_text_decoration' => new Select( array(
                'name' => $name.'_text_decoration',
                'label' => 'Text Decoration',
                'toggle_fields' => array('text-shadow'=>$name.'_text_shadow'),
                'args' => array(
                    'none',
                    'overline',
                    'underline',
                    'line-through',
                    'text-shadow',
                ),
            )
        ),
        $name.'_text_shadow'=> new ColorPicker( array(
                'name'=>$name.'_text_shadow',
                'toggled_by' => array($name.'_text_decoration' => 'text-shadow'),
                'args' =>'transparency'
            )
        ),
        $name.'_text_shadow_rgba'=>new Hidden(
            array(
                'name'=>$name.'_text_shadow_rgba',
                'label'=>''
            )
        ),

    );
}
