<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;


$background_colors = array(

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

    'background_fill'=>new Select(
        array(
            'name'=>'background_fill',
            'label'=>'Color Fill',
            'args'=>array(
                'none',
                'solid',
                'vertical',
                'horizontal',
                'radial'
            ),
            'toggle_fields' => array(
                'solid' => 'background_end_color',
                'vertical' => 'background_end_color',
                'horizontal' => 'background_end_color',
                'radial' => 'background_end_color',
            )
        )
    ),

    'background_end_color'=>new ColorPicker(
        array(
            'name'=>'background_end_color',
            'label'=>'End Color',
            'args'=>'transparency',
            'toggled_by' => array(
                'background_fill' => 'solid,vertical,horizontal,radial'
            )
        )
    ),
    'background_end_color_rgba'=>new Hidden(
        array(
            'name'=>'background_end_color_rgba',
            'label'=>''
        )
    ),
);
