<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Select;
use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;
use function bswp\Settings\_helpers\heading_toggle;

if($component_options['activate_popovers'] == 'yes'){
    $popovers = new SettingsGroup('popovers');
    $popovers->add_tab('content_colors', array_merge(
            $background_colors,
            $regular_text
        )
    );

    $popovers->add_tab('title_colors', array_merge(
            $background_colors,
            $regular_text,
            array( 'divider0'=>new Divider()),
            array(
                'title_bottom_border_style'=>new Select(array(
                        'name'=> 'title_bottom_border_style',
                        'args'=>$border_styles,
                        'toggle_fields'=>border_settings_map('border_styles_toggle', array('title_bottom'))
                    )
                ),
                'title_bottom_border_color'=>new ColorPicker(array(
                        'name'=> 'title_bottom_border_color',
                        'toggled_by'=>array('title_bottom_border_style' => border_settings_map('border_styles_toggled_by', array('title_bottom') ) )
                    )
                ),
                'title_bottom_border_width'=>new Select(array(
                        'name'=> 'title_bottom_border_width',
                        'args'=>array_map('bswp\Settings\_helpers\add_px_string', range(1,20)),
                        'toggled_by'=>array('title_bottom_border_style' => border_settings_map('border_styles_toggled_by', array('title_bottom') ) )
                    )
                ),
            )
        )
    );

    $popovers->add_tab('borders', array_merge(
            $component_borders,
            array( 'divider8'=>new Divider()),
            array( 'label8'=>new Label(array('name'=>'border_radius'))),
            $radii_fields
        )
    );
}
