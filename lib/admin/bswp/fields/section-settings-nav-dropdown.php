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
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$nav_dropdown_settings_fields = array(
    'section'=>'settings',
    'tabs' => array(
        'settings'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'remove_padding'=>select_field(array(
                        'name'=>'remove_padding',
                        'label'=>'Remove padding',
                        'args'=>array('no','yes')
                    )
                ),
            ),
        ),
    ),
);

$nav_dropdown_settings_tabs = array(
    'background' => $background_fields,
    'borders' => $borders_fields,
    'headings' => $headings_fields,
    'text' => $text_fields,
    'images' => $images_fields,
    'components' => $components_fields,
    'nav_dropdown_settings' => $nav_dropdown_settings_fields
);
