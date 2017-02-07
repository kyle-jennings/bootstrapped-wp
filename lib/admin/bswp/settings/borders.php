<?php

namespace bswp\forms\fields;
use bswp\forms\fields;

use function bswp\settings\_helpers;
use function bswp\settings\_helpers\border_settings_map;
use function bswp\settings\_helpers\add_px_string;
use function bswp\settings\_helpers\heading_toggle;


$borders_targets = array();
$border_sides = array('top','right','bottom','left');

// all the borders are teh same, so lets set them all at once
foreach($border_sides as $border){
    $$border = $border;
    $$border = array(

        $border.'_border_style'=>new Select(array(
                'name'=> $border.'_border_style',
                'label'=>'Style',
                'args'=>$border_styles,
                'toggle_fields'=>border_settings_map('border_styles_toggle', $border_sides)
            )
        ),
        $border.'_border_color'=>new ColorPicker(array(
                'name'=> $border.'_border_color',
                'toggled_by'=>array($border.'_border_style' => border_settings_map('border_styles_toggled_by', $border_sides ) )
            )
        ),
        $border.'_border_width'=>new Select(array(
                'name'=> $border.'_border_width',
                'label'=>'Width',
                'args'=>array_map('bswp\settings\_helpers\add_px_string', range(1,20)),
                'toggled_by'=>array($border.'_border_style' => border_settings_map('border_styles_toggled_by', $border_sides ) )
            )
        ),
    );

}
