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

$header_settings_fields = array(
    'section'=>'settings',
    'tabs' => array(
        'settings'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'header_content'=>select_field(array(
                        'name'=>'header_content',
                        'label'=>'Header Content',
                        'args'=>array('logo','widgets'),
                        'toggle_fields'=>array('logo'=>'logo_alignment,logo_margin')
                    )
                ),
                'logo_alignment'=>select_field(array(
                        'name'=>'logo_alignment',
                        'label'=>'Logo Alignment',
                        'args'=>array('left','center','right'),
                        'toggled_by'=>array('header_content'=>'logo'),
                    )
                ),
                'logo_margin'=>text_field(array(
                        'name'=>'logo_margin',
                        'label'=>'Push Logo down/up',
                        'args'=>array('suffix'=>'px'),
                        'toggled_by'=>array('header_content'=>'logo'),

                    )
                ),
                // 'header_height_label'=>label_field(array(
                //         'name'=>'force_header_height',
                //         'label'=>'Force Header Height'
                //     )
                // ),

                // Toggle-y things
                'header_height_toggle'=>select_field(array(
                        'name'=>'header_height_toggle',
                        'label'=>'Force Header Height',
                        'args'=>array('no','yes'),
                        'toggle_fields'=>array(
                            'yes'=>'header_height',
                        )
                    )
                ),
                    'header_height'=>text_field(array(
                            'name'=>'header_height',
                            'label'=>'height (in px)',
                            'args'=>array('suffix','px'),
                            'toggled_by'=>array('header_height_toggle'=>'yes')
                        )
                    ),
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
                            'yes'=>'top_margin,bottom_margin',
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
                'hide_on_mobile'=>select_field(array(
                        'name'=>'hide_on_mobile',
                        'label'=>'Hide on mobile?',
                        'args'=>array('no','yes')
                    )
                ),
            ),
        ),
    ),
);

$header_settings_tabs = array(
    'background' => $background_fields,
    'borders' => $borders_fields,
    'headings' => $headings_fields,
    'text' => $text_fields,
    'components' => $components_fields,
    'images' => $images_fields,
    'header_settings' => $header_settings_fields
);
