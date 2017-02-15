<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;


if($component_options['activate_modals'] == 'yes'){

    $modals = new SettingsGroup('modals');
    $modals-add_tab('background_colors', $background_colors);

    $modals-add_tab('borders', array_merge(
            $top,
            array( 'divider1'=>new Divider()),
            $right,
            array( 'divider2'=>new Divider()),
            $bottom,
            array( 'divider3'=>new Divider()),
            $left,
            array( 'divider4'=>new Divider()),
            array( 'label1'=>new Label(array('name'=>'border_radius'))),
            $radii_fields
        )
    );


    $modals-add_tab('text', array_merge(
            $regular_text,
            array( 'divider1'=>new Divider()),
            $links,
            array( 'divider2'=>new Divider()),
            $visited_links,
            array( 'divider3'=>new Divider()),
            $hovered_links,
            array( 'divider4'=>new Divider()),
            $active_links
        )
    );
}
