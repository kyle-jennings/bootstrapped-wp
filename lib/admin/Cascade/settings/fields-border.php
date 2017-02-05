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


/**
 * Borders - lots of repetitive fields here, so lets build them with a loop
 * @var array
 */
$borders = array();
$border_sides = array('top','right','bottom','left');

// all the borders are teh same, so lets set them all at once
foreach($border_sides as $border){

    $borders[$border] = array(
           'label'=>ucfirst($border),
           'fields'=>array(
                $border.'_border_style'=>select_field(array(
                        'name'=> $border.'_border_style',
                        'label'=>'Style',
                        'args'=>$border_styles,
                        'toggle_fields'=>border_setings_map('border_styles_toggle', $border_sides)
                    )
                ),
                $border.'_border_color'=>color_field(array(
                        'name'=> $border.'_border_color',
                        'toggled_by'=>array($border.'_border_style' => border_setings_map('border_styles_toggled_by', $border_sides ) )
                    )
                ),
                $border.'_border_width'=>select_field(array(
                        'name'=> $border.'_border_width',
                        'label'=>'Width',
                        'args'=>array_map('add_px_string', range(1,20)),
                        'toggled_by'=>array($border.'_border_style' => border_setings_map('border_styles_toggled_by', $border_sides ) )
                    )
                ),
            ),
       );
}
