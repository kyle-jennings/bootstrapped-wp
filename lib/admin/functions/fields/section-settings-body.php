<?php
/**
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
 *                    'toggle_fields'=>null,
 *                    'toggled_by'=>array('field_name'=>'option'),
 *                    'preview'=>null,
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$body_settings_fields = array(
    'section'=>'settings',

    'tabs' => array(
        'settings'=>array(
            'label'=>'settings',
            'fields'=>array(
               'confine_section'=>select_field(array(
                        'name'=>'confine_section',
                        'label'=>'Confine Section',
                        'args'=>array('no','yes')
                    )
                ),
                'float_section'=>select_field(array(
                        'name'=>'float_section',
                        'label'=>'Float Section',
                        'args'=>array('no','yes'),
                        'toggle_fields'=>array(
                            'yes'=>'top_margin,bottom_margin,outer_glow'
                        )
                    )
                ),
                    'top_margin'=>text_field(array(
                            'name'=>'top_margin',
                            'label'=>'Top Margin',
                            'args'=>array('suffix','px'),
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),
                    'bottom_margin'=>text_field(array(
                            'name'=>'bottom_margin',
                            'label'=>'Bottom Margin',
                            'args'=>array('suffix','px'),
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),
                    'outer_glow'=>select_field(array(
                            'name'=>'outer_glow',
                            'label'=>'Outer Glow',
                            'args'=>array('none','left_and_right','top_and_bottom','top','bottom','all_sides'),
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),
            ),
        ),
    )
);

$body_settings_tabs = array(
    $background_fields,
    $borders_fields,
    $headings_fields,
    $text_fields,
    $components_fields,
    $images_fields,
    $body_settings_fields
);