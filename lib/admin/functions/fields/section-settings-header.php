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
 *                    'toggle_field'=>null,
 *                    'field_toggle'=>array('field_name'=>'option'),
 *                    'preview'=>null,
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
                        'args'=>array('logo','widgets')
                    )
                ),
                'logo_alignment'=>select_field(array(
                        'name'=>'logo_alignment',
                        'label'=>'Logo Alignment',
                        'args'=>array('left','center','right')
                    )
                ),
                'logo_margin'=>text_field(array(
                        'name'=>'logo_margin',
                        'label'=>'Push Logo down/up',
                        'args'=>array('suffix'=>'px')
                    )
                ),
                'header_height_label'=>label_field(array(
                        'label'=>'Force Header Height'
                    )
                ),
                'header_height_toggle'=>select_field(array(
                        'name'=>'header_height_toggle',
                        'label'=>'',
                        'args'=>array('yes','no'),
                        'toggle_field'=>array(
                            'yes'=>array('header_height'),
                        )
                    )
                ),
                'header_height'=>text_field(array(
                        'name'=>'header_height',
                        'label'=>'',
                        'args'=>array('suffix','px'),
                        'field_toggle'=>array('header_height_toggle','yes')
                    )
                ),
                'confine_section'=>select_field(array(
                        'name'=>'confine_section',
                        'label'=>'Confine Section',
                        'args'=>array('yes','no')
                    )
                ),
                'float_section'=>select_field(array(
                        'name'=>'float_section',
                        'label'=>'Float Section',
                        'args'=>array('yes','no'),
                        'toggle_field'=>array(
                            'yes'=>array('top_margin','bottom_margin')
                        )
                    )
                ),
                'top_margin'=>text_field(array(
                        'name'=>'top_margin',
                        'label'=>'Top Margin',
                        'args'=>array('suffix','px'),
                        'field_toggle'=>array('float_section','yes')
                    )
                ),
                'bottom_margin'=>text_field(array(
                        'name'=>'bottom_margin',
                        'label'=>'Bottom Margin',
                        'args'=>array('suffix','px'),
                        'field_toggle'=>array('float_section','yes')
                    )
                ),
                'hide_on_mobile'=>select_field(array(
                        'name'=>'hide_on_mobile',
                        'label'=>'Hide on mobile?',
                        'args'=>array('yes','no')
                    )
                ),
            ),
        ),
    ),
);

$header_settings_tabs = array(
    $background_fields,
    $borders_fields,
    $headings_fields,
    $text_fields,
    $components_fields,
    $images_fields,
    $header_settings_fields
);