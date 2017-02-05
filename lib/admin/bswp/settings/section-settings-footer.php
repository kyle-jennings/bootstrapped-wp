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

$footer_settings_fields = array(
    'section'=>'settings',
    'tabs' => array(
        'settings'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'footer_height_toggle'=>select_field(array(
                        'name'=>'footer_height_toggle',
                        'label'=>'Set Height',
                        'args'=>array('no','yes'),
                        'toggle_fields'=>array(
                            'yes'=>'footer_height',
                        )
                    )
                ),
                    'footer_height'=>text_field(array(
                            'name'=>'footer_height',
                            'label'=>'Footer Height',
                            'args'=>array('suffix','px'),
                            'toggled_by'=>array('footer_height_toggle'=>'yes')
                        )
                    ),
                'confine_section'=>select_field(array(
                        'name'=>'confine_section',
                        'label'=>'Confine Section',
                        'args'=>array('no','yes')
                    )
                ),
                'hide'=>select_field(array(
                        'name'=>'hide',
                        'label'=>'Hide',
                        'args'=>array('none','frontpage','inside','all')
                    )
                ),
            )
        ),
    )
);


$footer_settings_tabs = array(
    'background' => $background_fields,
    'borders' => $borders_fields,
    'headings' => $headings_fields,
    'text' => $text_fields,
    'images' => $images_fields,
    'footer_settings' => $footer_settings_fields
);
