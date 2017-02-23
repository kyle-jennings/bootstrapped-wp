<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;


if($component_options['activate_tooltips'] == 'yes'){
    $tooltips = new SettingsGroup('tooltips');
    $tooltips->add_tab('background_colors', $background_colors);

    $tooltips->add_tab('text', array_merge(
            $regular_text
        )
    );

    $tooltips->add_tab('borders', array_merge(
            $component_borders,
            array( 'divider1'=>new Divider()),
            array( 'label1'=>new Label(array('name'=>'border_radius'))),
            $radii_fields
        )
    );

}
