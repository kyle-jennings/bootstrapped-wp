<?php

namespace bswp\Settings;

use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\Select;

use function bswp\Settings\_helpers\add_px_string;




$images = new SettingsGroup('images');
$images->add_tab('images', array_merge(
        $background_colors,
        array( 'divider0'=>new Divider()),
        array(
            'padding' => new Select(
                array(
                    'name'=>'adding',
                    'label'=>'padding',
                    'args'=>array_map('bswp\Settings\_helpers\add_px_string',$px_range),

                )
            ),
        ),
        array( 'divider6'=>new Divider()),
        $component_borders,
        array( 'divider7'=>new Divider()),
        array( 'label7'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);

$images->add_tab('thumbnails', array_merge(
        $background_colors,
        array( 'divider0'=>new Divider()),
        array(
            'padding' => new Select(
                array(
                    'name'=>'adding',
                    'label'=>'padding',
                    'args'=>array_map('bswp\Settings\_helpers\add_px_string',$px_range),

                )
            ),
        ),
        array( 'divider6'=>new Divider()),
        $component_borders,
        array( 'divider7'=>new Divider()),
        array( 'label7'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);


$images->add_tab('image_captions', array_merge(
        $background_colors,
        array(
            'caption_color'=>new ColorPicker(array(
                    'name'=>'text_color',
                    'label'=>'Caption Text',
                    'type'=>'color',
                )
            )
        ),
        array( 'divider0'=>new Divider()),
        array(
            'padding' => new Select(
                array(
                    'name'=>'adding',
                    'label'=>'padding',
                    'args'=>array_map('bswp\Settings\_helpers\add_px_string',$px_range),

                )
            ),
        ),
        array( 'divider6'=>new Divider()),
        $component_borders,
        array( 'divider7'=>new Divider()),
        array( 'label7'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);
