<?php

/**
 * Borders - lots of repetitive fields here, so lets build them with a loop
 * @var array
 */
$borders = array();
$border_targets = array('top','right','bottom','left');
// all the borders are teh same, so lets set them all at once
foreach($border_targets as $border){
    $borders[$border] = array(
           'label'=>ucfirst($border),
           'fields'=>array(
                'color'=>color_field(),
                'size'=>select_field(array(
                        'name'=>'size',
                        'label'=>'Size',
                        'args'=>array_map('add_px_string', range(1,20))
                    )
                ),
                'style'=>select_field(array(
                        'name'=>'style',
                        'label'=>'Style',
                        'args'=>$border_styles,
                    )
                )
            ),
       );
}
$radii = array('top_left','top_right','bottom_right','bottom_left');
$radii_fields = array();

// the border radius fields are all the same so lets set them a single time
foreach($radii as $radius){
    $radii_fields[$radius] = select_field(array(
            'name'=>'$radius',
            'label'=>ucfirst(str_replace('_', ' ', $radius)),
            'args'=>array_map('add_px_string', range(1,20))
        )
    );
}
// take the border radius seting and att them to the proper tab
$borders['border_radius'] = array(
    'label'=>'Border Radius',
    'fields'=>$radii_fields
);

// border settings
$borders_fields = array(
    'section'=>'borders',
    'tabs'=>$borders
);