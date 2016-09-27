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

$mobile_nav_settings_fields = array(
    'section'=>'settings',
    'tabs' => array(

        'general_settings'=>array(
            'label'=>'General Settings',
            'fields'=>array(
                'display_logo'=>select_field(array(
                        'name'=>'display_logo',
                        'label'=>'Display branding',
                        'args'=>array('none','logo','title'),
                        'toggle_fields'=>array('logo'=>'file')
                    )
                ),
                'file'=>file_field(array(
                        'name'=>'file',
                        'lable'=>'Upload File',
                        'toggled_by'=>array('display_logo'=>'logo')
                    )
                ),

            ),
        ),

        'menu_button_style'=>array(
            'label'=>'Menu Button Style',
            'fields'=>array(
                'button_type'=>select_field(array(
                    'name'=>'button_type',
                    'label'=>'Button Type',
                    'args'=>array('choose_one','default','hamburger','kabob','grid','image', 'button', 'text'),
                    'toggle_fields'=>array(
                            'default'=>'background_color,border_color,background_color_alt,border_color_alt',
                            'hamburger'=>'color,color_alt',
                            'kabob'=>'color,color_alt',
                            'grid'=>'color,color_alt',
                            'image'=>'file',
                            'button'=>'button_text,button_color,color',
                            'text'=>'button_text,color',
                        )
                    )
                ),

                'color'=>color_field(array(
                        'name'=>'color',
                        'label'=>'Text Color',
                        'toggled_by'=>array('button_type'=>'hamburger,kabob,grid,button,text')
                    )
                ),
                'color_alt'=>color_field(array(
                        'name'=>'color_alt',
                        'label'=>'Text Color - Hover',
                        'toggled_by'=>array('button_type'=>'hamburger,kabob,grid,button,text')
                    )
                ),

                'background_color'=>color_field(array(
                        'name'=>'background_color',
                        'label'=>'Background Color',
                        'toggled_by'=>array('button_type'=>'default')
                    )
                ),
                'border_color'=>color_field(array(
                        'name'=>'border_color',
                        'label'=>'Border Color',
                        'toggled_by'=>array('button_type'=>'default')
                    )
                ),
                'background_color_alt'=>color_field(array(
                        'name'=>'background_color_alt',
                        'label'=>'Background Color Alt',
                        'toggled_by'=>array('button_type'=>'default')
                    )
                ),
                'border_color_alt'=>color_field(array(
                        'name'=>'border_color_alt',
                        'label'=>'Border Color Alt',
                        'toggled_by'=>array('button_type'=>'default')
                    )
                ),
                'file'=>file_field(array(
                        'name'=>'file',
                        'label'=>'Upload File',
                        'toggled_by'=>array('button_type'=>'image')
                    )
                ),
                'button_text'=>text_field(array(
                        'name'=>'button_text',
                        'label'=>'Text',
                        'toggled_by'=>array('button_type'=>'button,text')

                    )
                ),
                'button_color'=>select_field(array(
                        'name'=>'button_color',
                        'label'=>'Button Color',
                        'args'=>array('btn-primary','btn-info','btn-success','btn-warning','btn-danger','btn-inverse'),
                        'toggled_by'=>array('button_type'=>'button')
                    )
                ),
            ), //end of tab
        ),

    ),
);


$mobile_nav_settings_tabs = array(
    'background' => $background_fields,
    'borders' => $borders_fields,
    'headings' => $headings_fields,
    'text' => $text_fields,
    'components' => $components_fields,
    'images' => $images_fields,
    'mobile_nav_settings' => $mobile_nav_settings_fields
);
