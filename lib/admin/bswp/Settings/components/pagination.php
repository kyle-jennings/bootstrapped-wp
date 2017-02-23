<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;


if($component_options['activate_pagination'] == 'yes'){

    $pagination = new SettingsGroup('pagination');
    $pagination->add_tab('text', array_merge(
        $links,
        array( 'divider3'=>new Divider()),
        $hovered_links,
        array( 'divider4'=>new Divider()),
        $active_links
        )
    );

    $pagination->add_tab('borders', array_merge(
            $component_borders,
            array( 'divider1'=>new Divider()),
            array( 'label1'=>new Label(array('name'=>'border_radius'))),
            $radii_fields
        )
    );


}
