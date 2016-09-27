<?php
/**
 * Each set of fields can be automatically generated using ths following array
 * structure for settings:
 *
 *
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
 *                    'toggle_fields'=>array('option'=>'field_1,field_2,field_3'),
 *                    'toggled_by'=>array('field_name'=>'option1,option2,option3'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */


// Branding
$site_branding = array(
    'section'=>'branding',
    'tabs' =>array(
        'branding' => array(
            'label' =>'branding',
            'fields'=>array(
                'logo'=>file_field(array(
                        'name'=>'logo',
                        'label'=>'Logo',
                    )
                 ),
                'favicon'=>file_field(array(
                        'name'=>'favicon',
                        'label'=>'Favicon'
                    )
                ),
                'logo_site_toggle'=>select_field(array(
                        'name'=>'logo_site_toggle',
                        'label'=>'Toggle site logo',
                        'args'=>array(
                            'logo',
                            'custom',
                            'site_title'
                        ),
                        'toggle_fields'=>array('custom'=>'custom_header')
                    )
                ),
                'custom_header'=>textarea_field(array(
                        'name'=>'custom_header',
                        'label'=>'Custom Header',
                        'args'=>'wp_editor',
                        'toggled_by'=>array('logo_site_toggle'=>'custom'),
                    )
                ),
            ),
        ),//end branding
    ),
);


$site_settings = array(
    'section'=>'settings',
    'tabs'=>array(
        'settings'=>array(
            'label'=>'General Settings',
            'fields'=>array(
                'analytics'=>text_field(array(
                        'name'=>'analytics',
                        'label'=>'Analytics Code',
                    )
                ),
                'resonsive'=>select_field(array(
                        'name'=>'responsive',
                        'label'=>'Site Structure',
                        'args'=>array(
                            'full_width',
                            'box'
                        )
                    )
                ),
                '404_page'=>textarea_field(array(
                        'name'=>'404_page',
                        'label'=>'404 page content',
                        'args'=>'wp_editor'
                    )
                )
            ),
        ),
    ),
);

$site_components = array(
    'section' => 'components',
    'tabs'=>array(
        'components'=>array(
            'label'=>'Components',
            'fields'=>array(
                'style_widgets'=>select_field(array(
                        'name'=>'style_widgets',
                        'label'=>'Style Widgets',
                        'args'=>array(
                            'no',
                            'yes'
                        )
                    )
                ),
                'featured_image_size'=>label_field(array(
                        'name'=>'featured_image_size',
                        'label'=>'Featured Image Size',
                    )
                ),
                'featured_image_height'=>text_field(array(
                        'name'=>'featured_image_height',
                        'label'=>'Height',
                        'args'=>array('suffix'=>'px')
                    )
                ),
                'featured_image_width'=>text_field(array(
                        'name'=>'featured_image_width',
                        'label'=>'Width',
                        'args'=>array('suffix'=>'px')
                    )
                ),
                'featured_image_crop'=>select_field(array(
                        'name'=>'featured_image_crop',
                        'label'=>'Crop Image',
                        'args'=>array(
                            'yes',
                            'no'
                        )
                    )
                ),
                'allow_comments'=>select_field(array(
                        'name'=>'allow_comments',
                        'label'=>'Allow Post Comments',
                        'args'=>array(
                            'yes',
                            'no'
                        )
                    )
                ),
            )
        )
    ),
);

$site_styles = array(
    'section'=>'styles',
    'tabs'=>array(
        'styles'=>array(
            'label'=>'Custom CSS',
            'fields'=>array(
                'custom_styles'=>textarea_field(array())
            )
        )
    ),
);

$theme_settings_tabs = array(
    'site_branding' => $site_branding,
    'site_settings' => $site_settings,
    'site_components' => $site_components,
    'site_styles' => $site_styles,
);
