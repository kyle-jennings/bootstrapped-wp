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

$hero_settings_fields = array(
    'section'=>'settings',
    'tabs' => array(
        'settings' =>array(
            'label' =>'Settings',
            'fields' => array(
                'slider_type'=>array(
                    'name'=>'slider_type',
                    'label'=>'Slider Type',
                    'type'=>'select',
                    'args'=>array(
                        'single_image',
                        'nivo',
                        'flexslider2',
                        'responsive_slider',
                        'bootstrap_slider',
                    ),
                    'toggle_fields'=>array(),
                    'preview'=>null,
                ),
            )
        )
    ),
);

$hero_settings_tabs = array(
    $background_fields,
    $borders_fields,
    $headings_fields,
    $text_fields,
    $hero_settings_fields
);