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
                        'args'=>array('yes','no')
                    )
                ),

                'float_section'=>select_field(array(
                        'name'=>'float_section',
                        'label'=>'Float Section',
                        'args'=>array('yes','no')
                    )
                ),
                'outer_glow'=>select_field(array(
                        'name'=>'outer_glow',
                        'label'=>'Outer Glow',
                        'args'=>array('none','left_and_right','top_and_bottom','top','bottom','all_sides')
                    )
                ),

                'flush_first_link'=>select_field(array(
                        'name'=>'flush_first_link',
                        'label'=>'Flush links to side',
                        'args'=>array('yes','no')
                    )
                ),

                'hide_section'=>select_field(array(
                        'name'=>'hide_section',
                        'label'=>'Hide Section',
                        'args'=>array('yes','no')
                    )
                ),

                'style_for_mobile'=>select_field(array(
                        'name'=>'style_for_mobile',
                        'label'=>'Style for mobile',
                        'args'=>array('yes','no')
                    )
                ),

            ),
        ),
    ),
);