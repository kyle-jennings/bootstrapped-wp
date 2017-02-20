<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;

use function bswp\Settings\_helpers;
use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;
use function bswp\Settings\_helpers\heading_toggle;

$outer_borders = $all_sides;
$outer_borders['style_border_sides']->toggle_fields = border_settings_map('border_styles_toggle', $border_sides, array('yes') );


$component_borders = array_merge(
    $outer_borders,
    array('divider1'=>new Divider()),
    $top,
    array('divider2'=>new Divider()),
    $right,
    array('divider3'=>new Divider()),
    $bottom,
    array('divider4'=>new Divider()),
    $left
);
