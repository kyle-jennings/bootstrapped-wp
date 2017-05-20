<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;

$btn_background_colors = array(

    'background_start_color'=>new ColorPicker(
        array(
            'name'=>'background_start_color',
            'label'=>'Start Color',
            'args'=>'transparency'
        )
    ),
    'background_start_color_rgba'=>new Hidden(
        array(
            'name'=>'background_start_color_rgba',
            'label'=>''
        )
    ),


    'background_end_color'=>new ColorPicker(
        array(
            'name'=>'background_end_color',
            'label'=>'End Color',
            'args'=>'transparency',
        )
    ),
    'background_end_color_rgba'=>new Hidden(
        array(
            'name'=>'background_end_color_rgba',
            'label'=>''
        )
    ),

    'background_fill'=>new Select(
        array(
            'name'=>'background_fill',
            'label'=>'Color Fill',
            'args'=>array(
                'solid',
                'none',
                'vertical',
                'horizontal',
                'radial'
            ),
        )
    ),

);


$buttons = new SettingsGroup('buttons');
$buttons->add_tab('default_settings', array_merge(
    $btn_background_colors,
    $regular_text,
    $component_borders,
    array( 'divider1'=>new Divider()),
    array( 'label1'=>new Label(array('name'=>'border_radius'))),
    $radii_fields
));

$states = array('primary', 'info', 'success', 'warning', 'danger');

foreach($states as $state):
$buttons->add_tab($state, array(
    'text_color'=>new ColorPicker(array(
            'name'=>'text_color',
            'label'=>'Text',
            'type'=>'color',
        )
    ),
    'background_start_color'=>new ColorPicker(
        array(
            'name'=>'background_start_color',
            'label'=>'Start Color',
            'args'=>'transparency'
        )
    ),
    'background_start_color_rgba'=>new Hidden(
        array(
            'name'=>'background_start_color_rgba',
            'label'=>''
        )
    ),


    'background_end_color'=>new ColorPicker(
        array(
            'name'=>'background_end_color',
            'label'=>'End Color',
            'args'=>'transparency',
        )
    ),
    'background_end_color_rgba'=>new Hidden(
        array(
            'name'=>'background_end_color_rgba',
            'label'=>''
        )
    ),

    'border_color'=>new ColorPicker(
        array(
            'name'=>'border_color',
            'label'=>'Border Color',
        )
    ),

    'border_color_hover'=>new ColorPicker(
        array(
            'name'=>'border_color_hover',
            'label'=>'Border Color Hover',
        )
    ),
)
);
endforeach;
