<?php


/**
 * Each set of fields can be automatically generated using ths following array
 * structure for settings:
 *
 *
 * $fields = array(
 *    'tabs'=>array(
 *        'tab-name'=>array(
 *            'label'=>'Tab Name',
 *            'fields'=>array(
 *                'color'=>array(
 *                    'name'=>'field-name',
 *                    'label'=>'Field Name',
 *                    'type'=>'field-type',
 *                    'args'=>'{string or array}',
 *                    'toggle_fields'=>array('option'=>'field_1,field_2,field_3'),
 *                    'toggled_by'=>array('field_name'=>'option1,option2,option3'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$blockquote = array(
    'section'=>'blockquote',
    'tabs'=>array(
        'background_colors'=>array(
            'label'=>'Quote Background Colors',
            'fields'=>array(
                'background_start_color'=>color_field(
                    array(
                        'name'=>'background_start_color',
                        'label'=>'Start Color',
                        'args'=>'transparency'
                    )
                ),
                'background_start_color_rgba'=>no_field(
                    array(
                        'name'=>'background_start_color_rgba',
                        'label'=>''
                    )
                ),
                'background_end_color'=>color_field(
                    array(
                        'name'=>'background_end_color',
                        'label'=>'End Color',
                        'args'=>'transparency'
                    )
                ),
                'background_end_color_rgba'=>no_field(
                    array(
                        'name'=>'background_end_color_rgba',
                        'label'=>''
                    )
                ),
                'background_gradient'=>select_field(
                    array(
                        'name'=>'background_gradient',
                        'label'=>'Color Fill',
                        'args'=>array(
                            'none',
                            'solid',
                            'vertical',
                            'horizontal',
                            'radial'
                        ),
                    )
                ),
            ),
        ), // background colors
        'borders' => array(
            'label'=>'Borders',
            'fields'=>array(

            )
        ), // borders
        // 'text' => array(
        //     'label'=>'Text Colors',
        //     'fields'=>array()
        // ), //text
        // 'settings' => array(
        //     'label'=>'Misc',
        //     'fields'=>array(
        //         'padding_size'=> array(
        //             'name'=>'padding_size',
        //             'label'=>'Color Fill',
        //             'args'=>array_map('add_px_string', range(1,20)),
        //         ),
        //     )
        // ), // settings
    ) // tabs
);



$border_targets = array('top','right','bottom','left');

// all the borders are teh same, so lets set them all at once
foreach($border_targets as $border){

    $blockquote['tabs']['borders']['fields'][$border.'_border_label'] = label_field(array(
            'name'=>$border.'_border_label',
            'label'=>$border.' Border',
        )
    );

    $blockquote['tabs']['borders']['fields'][$border.'_border_style']=select_field(array(
            'name'=> $border.'_border_style',
            'label'=>'Style',
            'args'=>$border_styles,
            'toggle_fields'=>border_setings_map('border_styles_toggle', $border_targets)
        )
    );
    $blockquote['tabs']['borders']['fields'][$border.'_border_color'] = color_field(array(
            'name'=> $border.'_border_color',
            'toggled_by'=>array($border.'_border_style' => border_setings_map('border_styles_toggled_by', $border_targets ) )
        )
    );
    $blockquote['tabs']['borders']['fields'][$border.'_border_width'] = select_field(array(
            'name'=> $border.'_border_width',
            'label'=>'Width',
            'args'=>array_map('add_px_string', range(1,20)),
            'toggled_by'=>array($border.'_border_style' => border_setings_map('border_styles_toggled_by', $border_targets ) )
        )
    );

}


$blockquote['tabs']['borders']['fields']['border_radius_label'] = label_field(array(
        'name'=>'border_radius_label',
        'label'=> 'Border Radius',
    )
);


$radii = array('top_left','top_right','bottom_right','bottom_left');
$radii_fields = array();

// the border radius fields are all the same so lets set them a single time
foreach($radii as $radius){
    $blockquote['tabs']['borders']['fields'][$radius] = select_field(array(
            'name'=>$radius,
            'label'=>ucfirst(str_replace('_', ' ', $radius)),
            'args'=>array_map('add_px_string', range(1,20))
        )
    );
}
