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

$navbar_settings_fields = array(
    'section'=>'settings',
    'tabs' => array(
        'settings'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'navbar_style'=>select_field(array(
                        'name'=>'navbar_style',
                        'label'=>'Navbar Style',
                        'args'=>array('full_width','confined')
                    )
                ),
                'position'=>select_field(array(
                        'name'=>'position',
                        'label'=>'Position',
                        'args'=>array('fixed_at_top','fixed_at_bottom','top_of_page')
                    )
                ),
                'link_style'=>select_field(array(
                        'name'=>'link_style',
                        'label'=>'Link Style',
                        'args'=>array(
                            'none',
                            'highlighted',
                            'pills',
                            'tabs',
                            'tabs-below',
                        )
                    )
                ),
                'alignment'=>select_field(array(
                        'name'=>'alignment',
                        'label'=>'Alignment',
                        'args'=>array('left','center','right')
                    )
                ),
                'link_shadow'=>select_field(array(
                        'name'=>'link_shadow',
                        'label'=>'Disable link shadows?',
                        'args'=>array('no','yes')
                    )
                ),

                'float_section'=>select_field(array(
                        'name'=>'float_section',
                        'label'=>'Float Section',
                        'args'=>array('no','yes'),
                        'toggle_fields'=>array(
                            'yes'=>'top_margin,bottom_margin,outer_glow',
                        )
                    )
                ),
                    'top_margin'=>text_field(array(
                            'name'=>'top_margin',
                            'label'=>'Top Margin',
                            'args'=>array('suffix','px'),
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),
                    'bottom_margin'=>text_field(array(
                            'name'=>'bottom_margin',
                            'label'=>'Bottom Margin',
                            'args'=>array('suffix','px'),
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),
                    'outer_glow'=>select_field(array(
                            'name'=>'outer_glow',
                            'label'=>'Outer Glow',
                            'args'=>array('none','left_and_right','top_and_bottom','top','bottom','all_sides'),
                            // 'toggle_fields'=>array()
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),

                'flush_first_link'=>select_field(array(
                        'name'=>'flush_first_link',
                        'label'=>'Flush links to side',
                        'args'=>array('no','yes')
                    )
                ),

                'hide_section'=>select_field(array(
                        'name'=>'hide_section',
                        'label'=>'Hide Section',
                        'args'=>array('no','yes')
                    )
                ),

                'style_for_mobile'=>select_field(array(
                        'name'=>'style_for_mobile',
                        'label'=>'Style for mobile',
                        'args'=>array('no','yes')
                    )
                ),

            ),
        ),
    ),
);


$navbar_settings_tabs = array(
    'background' => $background_fields,
    'borders' => $borders_fields,
    'headings' => $headings_fields,
    'text' => $text_fields,
    'components' => $components_fields,
    'images' => $images_fields,
    'navbar_settings' => $navbar_settings_fields
);
