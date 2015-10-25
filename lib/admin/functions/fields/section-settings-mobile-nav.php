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

$navbar_settings = array(
    'tabs' => array(
        'general'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'display_logo'=>select_field(array(
                        'name'=>'display_logo',
                        'label'=>'Display branding',
                        'args'=>array('none','logo','title'),
                        'toggle_field'=>array('logo'=>'file')
                    )
                ),
                'file'=>file_field(array(
                        'name'=>'file',
                        'lable'=>'Upload File',
                        'field_toggle'=>array('display_logo','logo')
                    )
                )
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
                'button_type'=>select_field(array(
                    'name'=>'button_type',
                    'label'=>'Button Type',
                    'args'=>array('default','hamburger','kabob','grid','image', 'button', 'text'),
                    'toggle_field'=>array(
                            'default'=>array('background_color','border_color','background_color_alt','border_color_alt'),
                            'hamburger'=>array('color','color_alt'),
                            'kabob'=>array('color','color_alt'),
                            'grid'=>array('color','color_alt'),
                            'image'=>array('file'),
                            'button'=>array('button_text','button_color', 'color'),
                            'text'=>array('button_text', 'color'),
                        )
                    )
                ),
                'color'=>color_field(array(
                        'name'=>'color',
                        'label'=>'Text Color',
                        'field_toggle'=>array('button_type'=>'hamburger','button_type'=>'kabob','button_type'=>'grid','button_type'=>'button','button_type'=>'text')
                    )
                ),
                'background_color'=>color_field(array(
                        'name'=>'background_color',
                        'label'=>'Background Color',
                        'toggle_field'=>array('button_type'=>'default')
                    )
                ),
                'border_color'=>color_field(array(
                        'name'=>'border_color',
                        'label'=>'Border Color',
                        'toggle_field'=>array('button_type'=>'default')
                    )
                ),
                'background_color_alt'=>color_field(array(
                        'name'=>'background_color_alt',
                        'label'=>'Background Color Alt',
                        'toggle_field'=>array('button_type'=>'default')
                    )
                ),
                'border_color_alt'=>color_field(array(
                        'name'=>'border_color_alt',
                        'label'=>'Border Color Alt',
                        'toggle_field'=>array('button_type'=>'default')
                    )
                ),
                'file'=>file_field(array(
                        'name'=>'file',
                        'label'=>'Upload File',
                        'toggle_field'=>array('button_type'=>'image')

                    )
                ),
                'button_text'=>text_field(array(
                        'name'=>'button_text',
                        'label'=>'Button Text',
                        'toggle_field'=>array('button_type'=>'button', 'button_type'=>'text')

                    )
                ),
                'button_color'=>select_field(array(
                        'name'=>'button_color',
                        'label'=>'Button Color',
                        'args'=>array('btn-primary','btn-info','btn-success','btn-warning','btn-danger','btn-inverse'),
                        'toggle_field'=>array('button_type'=>'button')

                    )
                )
            )
        ),
        'mobile_style'=>array(),

    ),
);