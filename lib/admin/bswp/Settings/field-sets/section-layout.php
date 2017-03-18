<?php

namespace bswp\forms\fields;

use bswp\forms\fields;
use function bswp\Settings\_helpers;
use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;
use function bswp\Settings\_helpers\heading_toggle;

$section_layout = array(
    'full_width' => new Select (
        array(
            'name'=>'full_width',
            'label'=>'Full Width',
            'args'=>array('yes','no'),
            'preview'=>'toggle-class',
            'preview_args'=>'container',
        )
    ),
    'float_section' => new Select (
        array(
            'name'=>'float_section',
            'label'=>'Float Section',
            'args'=>array('no','yes'),
            'toggle_fields'=>array(
                'yes'=>'top_margin,bottom_margin,outer_glow'
            ),
            'preview'=>'toggle-class',
            'preview_args'=>'float-section',
        )
    ),
    'top_margin' => new Select(
        array(
            'name'=>'top_margin',
            'label'=>'Top Margin',
            'args' => array_map('bswp\Settings\_helpers\add_px_string', $px_range ),
            'toggled_by'=>array('float_section'=>'yes')
        )
    ),
    'bottom_margin' => new Select(
        array(
            'name'=>'bottom_margin',
            'label'=>'Bottom Margin',
            'args' => array_map('bswp\Settings\_helpers\add_px_string', $px_range ),
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
