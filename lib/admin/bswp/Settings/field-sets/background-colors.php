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
    'background_end_color'=>new ColorPicker(
        array(
            'name'=>'background_end_color',
            'label'=>'End Color',
            'args'=>'transparency'
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
            'name'=>'background_gradient',
            'label'=>'Color Fill',
            'args'=>array(
                'none',
                'solid',
                'vertical',
                'horizontal',
                'radial'
            ),
        )
    ),
);
