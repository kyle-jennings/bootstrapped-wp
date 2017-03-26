<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;



$buttons = new SettingsGroup('buttons');
$buttons->add_tab('background_colors', $background_colors);

$buttons->add_tab('text', array_merge(
        $regular_text
    )
);

$buttons->add_tab('borders', array_merge(
        $component_borders,
        array( 'divider1'=>new Divider()),
        array( 'label1'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);
