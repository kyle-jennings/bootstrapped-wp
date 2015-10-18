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
 *                    'toggled_field'=>'no',
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
                        'label'=>'Text Color'
                    )
                ),
                'background_color'=>color_field(array(
                        'name'=>'background_color',
                        'label'=>'Background Color'
                    )
                ),
                'border_color'=>color_field(array(
                        'name'=>'border_color',
                        'label'=>'Border Color'
                    )
                ),
                'background_color_alt'=>color_field(array(
                        'name'=>'background_color_alt',
                        'label'=>'Background Color Alt'
                    )
                ),
                'border_color_alt'=>color_field(array(
                        'name'=>'border_color_alt',
                        'label'=>'Border Color Alt'
                    )
                ),
                'file'=>file_field(array(
                        'name'=>'file',
                        'label'=>'Upload File'
                    )
                ),
                'button_text'=>text_field(array(
                        'name'=>'button_text',
                        'label'=>'Button Text',
                    )
                ),
                'button_color'=>select_field(array(
                        'name'=>'button_color',
                        'label'=>'Button Color',
                        'select'=>array('btn-primary','btn-info','btn-success','btn-warning','btn-danger','btn-inverse')
                    )
                )
            )
        ),
        'mobile_style'=>array(),

    ),
);