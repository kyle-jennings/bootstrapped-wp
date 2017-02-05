<?php

namespace bswp\forms\fields;
use bswp\forms\fields;


$background_colors = array(

    'background_start_color'=>new ColorPicker(
        array(
            'name'=>'background_start_color',
            'label'=>'Start Color',
            'args'=>'transparency'
        )
    ),
    'background_start_color_rgba'=>new HiddenField(
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
    'background_end_color_rgba'=>new HiddenField(
        array(
            'name'=>'background_end_color_rgba',
            'label'=>''
        )
    ),
    'background_gradient'=>new Select(
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
