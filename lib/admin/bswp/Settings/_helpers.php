<?php

namespace bswp\settings\_helpers;

$save_form_script = '
    var $this = $(this);
    var thisVal = $this.val();

    $this.closest("form").find("#submit").addClass()
';

/**
 * Pixel width helper - Adds 'px' to each step in the range
 * used for stuff like border widths
 * @param [type] $index [description]
 */
function add_px_string($index){
    return ($index.'px');
}

$px_range = range(0,20);

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
                return 'solid,dotted,dashed,double,groove,ridge,inset,outset';
        }

        $return_arr[$toggle] = rtrim($return_arr[$toggle],',');

    }
    // examine($return_arr);
    return $return_arr;
}



function border_corners_toggle_map($action = 'toggle'){

    $corners = array('top_left','top_right','bottom_right','bottom_left');

    $return_arr = array();

    foreach($corners as $corner){

        if($action == 'toggle')
                $return_arr['yes'] .= $corner .',';
        elseif($action == 'toggled_by')
                return 'yes';

    }
    // examine($return_arr);
    return $return_arr;
}


function heading_toggle($new, $array){
    $heading = 'h1';
    return($heading.'_border_color,'.$heading.'_border_size');
}


function remove_link_bg($link) {

    unset($link['link_background_style']);
    unset($link['link_background_color']);
    return $link;

}
function remove_link_decoration($link) {
    unset($link['link_text_decoration']);
    unset($link['link_text_shadow']);
    return $link;
}
