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
 *                    'toggled_field'=>array('field_name'=>'option'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$page_title_settings = array(
    'tabs' => array(
        'settings'=>array(
            'label'=>'Settings',
            'fields'=>array(
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
                            'toggled_field'=>array('float_section','yes')
                        )
                    ),
                    'bottom_margin'=>text_field(array(
                            'name'=>'bottom_margin',
                            'label'=>'Bottom Margin',
                            'args'=>array('suffix','px'),
                            'toggled_field'=>array('float_section','yes')
                        )
                    ),
                'use_breadcrumbs'=>select_field(array(
                        'name'=>'use_breadcrumbs',
                        'label'=>'Use breadcrumbs',
                        'args'=>array('yes','no')
                    )
                ),
            )
        )
    )
);