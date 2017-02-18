<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;

use function bswp\Settings\_helpers;
use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;
use function bswp\Settings\_helpers\heading_toggle;


$borders_targets = array();
$border_sides = array('top','right','bottom','left');

$all_sides = array(
    'all_sides_border_style'=>new Select(array(
            'name'=> 'all_sides_border_style',
            'args'=>$border_styles,
            'toggle_fields'=>border_settings_map('border_styles_toggle', array('all_sides'))
        )
    ),
    'all_sides_border_color'=>new ColorPicker(array(
            'name'=> 'all_sides_border_color',
            'toggled_by'=>array('all_sides_border_style' => border_settings_map('border_styles_toggled_by', array('all_sides') ) )
        )
    ),
    'all_sides_border_width'=>new Select(array(
            'name'=> 'all_sides_border_width',
            'args'=>array_map('bswp\Settings\_helpers\add_px_string', range(1,20)),
            'toggled_by'=>array('all_sides_border_style' => border_settings_map('border_styles_toggled_by', array('all_sides') ) )
        )
    ),

    'style_border_sides'=>new Select(array(
            'name'=> 'style_border_sides',
            'args'=>array('no', 'yes'),

        )
    ),
);



// all the borders are teh same, so lets set them all at once
foreach($border_sides as $border){
    $$border = $border;
    $$border = array(

        $border.'_border_style'=>new Select(array(
                'name'=> $border.'_border_style',
                'args'=>$border_styles,
                'toggle_fields'=>border_settings_map('border_styles_toggle', array($border))
            )
        ),
        $border.'_border_color'=>new ColorPicker(array(
                'name'=> $border.'_border_color',
                'toggled_by'=>array($border.'_border_style' => border_settings_map('border_styles_toggled_by', array($border) ) )
            )
        ),
        $border.'_border_width'=>new Select(array(
                'name'=> $border.'_border_width',
                'args'=>array_map('bswp\Settings\_helpers\add_px_string', range(1,20)),
                'toggled_by'=>array($border.'_border_style' => border_settings_map('border_styles_toggled_by', array($border) ) )
            )
        ),
    );

}
