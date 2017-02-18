<?php

namespace bswp\settings\_helpers;



/**
 * Pixel width helper - Adds 'px' to each step in the range
 * used for stuff like border widths
 * @param [type] $index [description]
 */
function add_px_string($index){
    return ($index.'px');
}


// this is used to populate the
$border_styles = array(
    'none',
    'solid',
    'dotted',
    'dashed',
    'double',
    'groove',
    'ridge',
    'inset',
    'outset',
);


function border_settings_map(
    $return = 'border_styles_toggled_by',
    $border_targets = array(),
    $toggles = array('solid','dotted','dashed','double','groove','ridge','inset','outset')
){
    // examine($toggles);
    if( empty($border_targets))
        return array();

    $return_arr = array();

    foreach($toggles as $toggle){

        foreach($border_targets as $target){
            $border_color = ltrim($target.'_border_color', '_');
            $border_style = ltrim($target.'_border_style', '_');
            $border_width = ltrim($target.'_border_width', '_');

            if($return == 'border_styles_toggle')
                $return_arr[$toggle] .= $border_color . ',' . $border_width .',';
            elseif($return == 'border_styles_toggled_by')
                $return_arr[$border_style] = 'solid,dotted,dashed,double,groove,ridge,inset,outset';
        }
    }
    // examine($return_arr);
    return $return_arr;
}


function heading_toggle($new, $array){
    $heading = 'h1';
    return($heading.'_border_color,'.$heading.'_border_size');
}
