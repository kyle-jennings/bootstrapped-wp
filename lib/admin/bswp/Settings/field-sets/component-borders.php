<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;

use function bswp\Settings\_helpers;
use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;
use function bswp\Settings\_helpers\heading_toggle;

$comp_all_sides = $all_sides;
$comp_all_sides['style_border_sides'] = clone $all_sides['style_border_sides'];
$comp_all_sides['style_border_sides']->toggle_fields['yes'] = implode(array_map(function($v, $k){
    $divider = 'dividerBorder'.$k;
    $border_color = ltrim($v.'_border_color', '_');
    $border_style = ltrim($v.'_border_style', '_');
    $border_width = ltrim($v.'_border_width', '_');

    $string = $divider.','.$border_style.','.$border_color.','.$border_width;

    return $string;

}, $border_sides, range(1,4) ),',');



// all the borders are teh same, so lets set them all at once
foreach($border_sides as $border){
    $border_name = 'comp_'.$border;

    $$border_name = array(

        $border.'_border_style'=>new Select(array(
                'name' => $border.'_border_style',
                'args' => $border_styles,
                'toggle_fields' => border_settings_map('border_styles_toggle', array($border) ),
                'toggled_by' => array(
                    'style_border_sides' => 'yes'
                ),
                'default' =>'solid'
            )
        ),
        $border.'_border_color' => new ColorPicker(array(
                'name' => $border.'_border_color',
                'toggled_by' => array(
                    $border.'_border_style' => border_settings_map('border_styles_toggled_by', array($border) ),
                    'style_border_sides' => 'yes'
                ),
            )
        ),
        $border.'_border_width' => new Select(array(
                'name' => $border.'_border_width',
                'args' => array_map('bswp\Settings\_helpers\add_px_string', $px_range ),
                'toggled_by' => array(
                    $border.'_border_style' => border_settings_map('border_styles_toggled_by', array($border) ),
                    'style_border_sides' => 'yes'
                ),
                'default'=>'1px'
            )
        ),
    );

}

// examine($comp_top);


$component_borders = array_merge(
    $comp_all_sides,
    array('dividerBorder1'=>new Divider(
        array(
            'name' => 'dividerBorder1',
            'toggled_by' => array( 'style_border_sides' => 'yes' ) )
    )),
    $comp_top,
    array('dividerBorder2'=>new Divider(
        array(
            'name' => 'dividerBorder2',
            'toggled_by' => array( 'style_border_sides' => 'yes' ) )
    )),
    $comp_right,
    array('dividerBorder3'=>new Divider(
        array(
            'name' => 'dividerBorder3',
            'toggled_by' => array( 'style_border_sides' => 'yes' ) )
    )),
    $comp_bottom,
    array('dividerBorder4'=>new Divider(
        array(
            'name' => 'dividerBorder4',
            'toggled_by' => array( 'style_border_sides' => 'yes' ) )
    )),
    $comp_left
);



// examine($component_borders);
