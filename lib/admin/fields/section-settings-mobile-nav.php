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
            'fields'=>array
(                'button_type'=>select_field(array(
                        'name'=>'button_type',
                        'label'=>'Button Type',
                        'args'=>array('default','hamburger','kabob','grid','image', 'button', 'text')
                        'toggle_field'=>array(
                                'default',
                                'hamburger',
                                'kabob',
                                'grid',
                                'image',
                                'button',
                                'text'
                            )
                    )
                )
                'background_color'=>color_field(),
                'border_color'=>color_field(),
                'background_color_alt'=>color_field(),
                'border_color_alt'=>color_field(),
                'file'=>file_field(),
                'button_text'=>text_field(),
                'button_color'=>select_field(array(
                        'name'=>'',
                        'label'=>'',
                        'select'=>array('btn-primary','btn-info','btn-success','btn-warning','btn-danger','btn-inverse')
                        )
(                    )
                )
            )
        ),
        'mobile_style'=>array(),

    ),
);