<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;


if($component_options['activate_tabs'] == 'yes'){
    $tabs = new SettingsGroup('tabs');
    $tabs->add_tab('background_colors',  $background_colors);
    $tabs->add_tab('text', array_merge(
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

    // copy the all sides border settings and remove the toggle
    $tabs_borders = $all_sides;
    // $tabs_borders['all_sides_border_width']->args
    unset($tabs_borders['style_border_sides']);

    // copy the border raddii settings and remove the toggle
    $tabs_radii = $radii_fields;
    unset($tabs_radii['style_corners']);

    $tabs->add_tab('borders', array_merge(
            $tabs_borders,
            array( 'divider4'=>new Divider()),
            array( 'label1'=>new Label(array('name'=>'border_radius'))),
            $radii_fields
        )
    );


    // remove the border width settings from the inactive tabs
    $inactive_tab_borders = $tabs_borders;
    $inactive_tab_borders['all_sides_border_style'] = clone $tabs_borders['all_sides_border_style'];
    foreach($inactive_tab_borders['all_sides_border_style']->toggle_fields as $k=>&$option)
        $option = str_replace(',all_sides_border_width','', $option);

    unset($inactive_tab_borders['all_sides_border_width']);
    $tabs->add_tab('inactive_tab_colors',
        array_merge(
            $background_colors,
            array( 'divider1'=>new Divider()),
            $regular_text,
            array( 'divider2'=>new Divider()),
            $inactive_tab_borders

        )
    );

}
