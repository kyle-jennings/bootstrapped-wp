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
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$nav_dropdown_settings = array(
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