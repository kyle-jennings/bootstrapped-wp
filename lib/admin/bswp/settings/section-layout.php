<?php

namespace bswp\forms\fields;
use bswp\forms\fields;


$section_layout = array(
    'confine_section' => new Select (
        array(
            'name'=>'confine_section',
            'label'=>'Confine Section',
            'args'=>array('no','yes')
        )
    ),
    'float_section' => new Select (
        array(
            'name'=>'float_section',
            'label'=>'Float Section',
            'args'=>array('no','yes'),
            'toggle_fields'=>array(
                'yes'=>'top_margin,bottom_margin,outer_glow'
            )
        )
    ),
    'top_margin' => new Text(
        array(
            'name'=>'top_margin',
            'label'=>'Top Margin',
            'args'=>array('suffix','px'),
            'toggled_by'=>array('float_section'=>'yes')
        )
    ),
    'bottom_margin' => new Text(
        array(
            'name'=>'bottom_margin',
            'label'=>'Bottom Margin',
            'args'=>array('suffix','px'),
            'toggled_by'=>array('float_section'=>'yes')
        )
    ),
    'outer_glow' => new Select (
        array(
            'name'=>'outer_glow',
            'label'=>'Outer Glow',
            'args'=>array('none','left_and_right','top_and_bottom','top','bottom','all_sides'),
            'toggled_by'=>array('float_section'=>'yes')
        )
    ),
);
