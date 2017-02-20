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
$table_borders = $all_sides;
$table_borders['style_border_sides']->toggle_fields = border_settings_map('border_styles_toggle', $border_sides, array('yes') );


$tables->add_tab('borders', array_merge(
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
    array('divider'=>new Divider()),
    $table_borders,
    array('divider1'=>new Divider()),
    $top,
    array('divider2'=>new Divider()),
    $right,
    array('divider3'=>new Divider()),
    $bottom,
    array('divider4'=>new Divider()),
    $left
    )
);
