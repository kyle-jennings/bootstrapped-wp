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
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$navbar_settings = array(
    'tabs' => array(
        'general'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'display_logo'=>select_field(array(
                        'name'=>'display_logo',
                        'label'=>'Display branding',
                        'args'=>array('none','logo','title')
                    )
                ),
            ),
        ),

        'general'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'display_logo'=>select_field(array(
                        'name'=>'display_logo',
                        'label'=>'Display branding',
                        'args'=>array('none','logo','title')
                    )
                ),
            ),
        ),

        'menu_button_style'=>array(
            'label'=>'',
            'fields'=>array(
                'button_style'=>select_field()
            )
        ),
        'mobile_style'=>array(),

    ),
);