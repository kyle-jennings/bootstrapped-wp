<?php


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




function border_setings_map($return = 'border_styles_toggled_by', $border_targets = array() ){

    $border_styles = array('solid'=>'','dotted'=>'','dashed'=>'','double'=>'','groove'=>'','ridge'=>'','inset'=>'','outset'=>'',);

    if( empty($border_targets))
        return array();

    $return_arr = array();

    foreach($border_styles as $key=>$v){

        foreach($border_targets as $target){
            if($return == 'border_styles_toggle')
                $return_arr[$key] .= $target.'_border_color,'.$target.'_border_width,';
            elseif($return == 'border_styles_toggled_by')
                $return_arr[$target.'_border_style'] = 'solid,dotted,dashed,double,groove,ridge,inset,outset';
        }
    }
    // examine($return_arr);
    return $return_arr;
}


function heading_toggle($new, $array){
    $heading = 'h1';
    return($heading.'_border_color,'.$heading.'_border_size');
}
