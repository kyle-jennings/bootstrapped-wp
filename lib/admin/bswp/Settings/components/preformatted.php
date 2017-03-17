<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;

use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;

use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;


$preformatted = new SettingsGroup('preformatted');
$preformatted->add_tab('background_colors', $background_colors);



$preformatted->add_tab('text', array_merge(
        $regular_text,
        array( 'divider1'=>new Divider()),
        $link,
        array( 'divider3'=>new Divider()),
        $hovered_link,
        array( 'divider4'=>new Divider()),
        $active_link
    )
);

$preformatted->add_tab('borders', array_merge(
        $component_borders,
        array( 'divider1'=>new Divider()),
        array( 'label1'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);
