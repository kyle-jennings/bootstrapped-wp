<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;

use function bswp\Settings\_helpers\border_settings_map;



// Background settings
$forms = new SettingsGroup('forms');

$forms->add_tab('background_colors', array_merge(
        $background_colors,
        array( 'divider0'=>new Divider()),
        $regular_text,
        array( 'divider1'=>new Divider()),
        $component_borders,
        array( 'divider2'=>new Divider()),
        array( 'label2'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);

$forms->add_tab('field_colors', array_merge(
    $background_colors,
    array( 'divider0'=>new Divider()),
    $regular_text,
    array( 'divider1'=>new Divider()),
    $component_borders,
    array( 'divider2'=>new Divider()),
    array( 'label2'=>new Label(array('name'=>'border_radius'))),
    $radii_fields
    )
);

$forms->add_tab('field_active_colors', array_merge(
    $background_colors,
    array( 'divider0'=>new Divider()),
    $regular_text,
    array( 'divider1'=>new Divider()),
    $component_borders,
    array( 'divider2'=>new Divider()),
    array( 'label2'=>new Label(array('name'=>'border_radius'))),
    $radii_fields
    )
);
