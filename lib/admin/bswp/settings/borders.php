<?php

namespace bswp\settings;
use bswp\forms\fields;

$borders = array();
$border_targets = array('top','right','bottom','left');

// all the borders are teh same, so lets set them all at once
foreach($border_targets as $border){

    $borders[$border] = array(
           'label'=>ucfirst($border),
           'fields'=>array(
                $border.'_border_style'=>new Select(array(
                        'name'=> $border.'_border_style',
                        'label'=>'Style',
                        'args'=>$border_styles,
                        'toggle_fields'=>border_setings_map('border_styles_toggle', $border_targets)
                    )
                ),
                $border.'_border_color'=>new ColorPicker(array(
                        'name'=> $border.'_border_color',
                        'toggled_by'=>array($border.'_border_style' => border_setings_map('border_styles_toggled_by', $border_targets ) )
                    )
                ),
                $border.'_border_width'=>new Select(array(
                        'name'=> $border.'_border_width',
                        'label'=>'Width',
                        'args'=>array_map('add_px_string', range(1,20)),
                        'toggled_by'=>array($border.'_border_style' => border_setings_map('border_styles_toggled_by', $border_targets ) )
                    )
                ),
            ),
       );
}
