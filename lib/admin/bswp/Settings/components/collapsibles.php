<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;

use function bswp\Settings\_helpers\border_settings_map;


if($component_options['activate_collapsibles'] == 'yes'){

    // Background settings
    $collapsibles = new SettingsGroup('collapsibles');
    $collapsibles->add_tab('active_header',
        array(

            'background_color'=>new ColorPicker(
                array(
                    'name'=>'background_color',
                    'args'=>'transparency'
                )
            ),
            'background_color_rgba'=>new Hidden(
                array(
                    'name'=>'background_color_rgba',
                    'label'=>''
                )
            ),
            'text_color'=>new ColorPicker(array(
                    'name'=>'text_color',
                    'label'=>'Text Color',
                    'type'=>'color',
                )
            )

        )
    );
    $collapsibles->add_tab('active_background_colors', $background_colors);
    $collapsibles->add_tab('active_borders', array_merge(
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

    $collapsibles->add_tab('active_text', array_merge(
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


    $collapsibles->add_tab('inactive__heading_background_colors', $background_colors);
    $collapsibles->add_tab('inactive_heading_text', array_merge(
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
    $collapsibles->add_tab('inactive_borders', array_merge(
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
}
