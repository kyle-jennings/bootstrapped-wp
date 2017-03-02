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
    $collapsibles->add_tab('header', array_merge (
            $background_colors,
            array(
                'text_color'=>new ColorPicker(array(
                        'name'=>'text_color',
                        'label'=>'Text Color',
                        'type'=>'color',
                    )
                )
            )
        )
    );
    $collapsibles->add_tab('background_colors', $background_colors);
    $collapsibles->add_tab('text', array_merge(
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


    $collapsibles->add_tab('borders', array_merge(
            $component_borders,
            array( 'divider1'=>new Divider()),
            array( 'label1'=>new Label(array('name'=>'inner_border'))),
            array(
                'inner_border_style'=>new Select(array(
                        'name'=> 'inner_border_style',
                        'args'=>$border_styles,
                        'toggle_fields'=>border_settings_map('border_styles_toggle', array('inner'))
                    )
                ),
                'inner_border_color'=>new ColorPicker(array(
                        'name'=> 'inner_border_color',
                        'toggled_by'=>array('inner_border_style' => border_settings_map('border_styles_toggled_by', array('inner') ) )
                    )
                ),
                'inner_border_width'=>new Select(array(
                        'name'=> 'inner_border_width',
                        'args'=>array_map('bswp\Settings\_helpers\add_px_string', range(1,20)),
                        'toggled_by'=>array('inner_border_style' => border_settings_map('border_styles_toggled_by', array('inner') ) )
                    )
                ),
            ),
            array( 'divider9'=>new Divider()),
            array( 'label9'=>new Label(array('name'=>'border_radius'))),
            $radii_fields
        )
    );

}
