<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;

use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;
// use function bswp\Settings\_helpers\heading_toggle;


if($component_options['activate_tables'] == 'yes'){
    // Background settings
    $tables = new SettingsGroup('tables');
    $tables->add_tab('table_header',
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
    $tables->add_tab('rows',
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
                    'type'=>'color',
                )
            ),
            'links_color'=>new ColorPicker(array(
                    'name'=>'links_color',
                    'type'=>'color',
                )
            )
        )
    );
    $tables->add_tab('striped_rows',
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
                    'type'=>'color',
                )
            ),
            'links_color'=>new ColorPicker(array(
                    'name'=>'links_color',
                    'type'=>'color',
                )
            )
        )
    );

    $tables->add_tab('borders', array_merge(
            array(
                'border_style'=>new Select(array(
                        'name'=> 'border_style',
                        'args'=>$border_styles,
                        'toggle_fields'=>border_settings_map('border_styles_toggle', array(''))
                    )
                ),
                'border_color'=>new ColorPicker(array(
                        'name'=> 'border_color',
                        'toggled_by'=>array('border_style' => border_settings_map('border_styles_toggled_by', array('') ) )
                    )
                ),
                'border_width'=>new Select(array(
                        'name'=> 'border_width',
                        'args'=>array_map('bswp\Settings\_helpers\add_px_string', range(1,20)),
                        'toggled_by'=>array('border_style' => border_settings_map('border_styles_toggled_by', array('') ) )
                    )
                ),
            ),

            array( 'divider1'=>new Divider()),
            array( 'label1'=>new Label(array('name'=>'border_radius'))),
            $radii_fields
        )
    );

}
