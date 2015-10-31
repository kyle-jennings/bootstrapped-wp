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
 *                    'toggle_fields'=>null,
 *                    'toggled_by'=>array('field_name'=>'option'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

/**
 * Backgrounds are pretty straitforward
 * @var array
 */

// background fields aren't repetitive, so we set them manually
$background_fields = array(
    'section'=>'background',
    'tabs'=>array(
        'colors'=>array(
            'label'=>'Background Colors',
            'fields'=>array(
                'color'=>color_field(
                    array(
                        'name'=>'color',
                        'label'=>'Start Color',
                        'args'=>'transparency')
                    ),
                'endcolor'=>color_field(
                    array(
                        'name'=>'end_color',
                        'label'=>'End Color',
                        'args'=>'transparency')
                    ),
                'gradient'=>select_field(
                    array(
                        'name'=>'gradient',
                        'label'=>'Color Fill',
                        'args'=>array(
                            'none',
                            'solid',
                            'vertical',
                            'horizontal',
                            'radial'
                        ),
                    )
                ),
            ),
        ),
        'wallpaper'=>array(
            'label'=>'Background Wallpaper',
            'fields'=>array(
                'use_wallpaper'=>select_field(array(
                        'name'=>'use_wallpaper',
                        'label'=>'Use Wallpaper?',
                        'args'=>array('no', 'yes'),
                        // 'toggle_fields'=>array(
                        //     'yes'=>'image,repeat,attachment,position,positionX,positionY,size,percentage'
                        // ),
                    )
                ),
                'image'=>file_field(array(
                        'name'=>'image',
                        'label'=>'Upload Image',
                    )
                ),
                'repeat'=>select_field(array(
                        'name'=>'repeat',
                        'label'=>'Repeat wallpaper?',
                        'args'=>array('no-repeat','repeat','repeat-x','repeat-y'),


                    )
                ),
                'attachment'=>select_field(array(
                        'name'=>'attachment',
                        'label'=>'Scroll wallpaper?',
                        'args'=>array('scroll','fixed'),

                    )
                ),
                'position'=>select_field(array(
                        'name'=>'position',
                        'label'=>'Wallpaper position',
                        'args'=>array(
                            'left top',
                            'left center',
                            'left bottom',
                            'right top',
                            'right center',
                            'right bottom',
                            'center top',
                            'center center',
                            'center bottom',
                            'custom',
                        ),
                        'toggle_fields'=>array(
                            'custom'=>'positionX,positionY',
                        ),

                    )
                ),
                'positionX'=>text_field(array(
                        'name'=>'positionX',
                        'label'=>'Horizontal Position',
                        'toggled_by'=>array('position'=>'custom')
                    )
                ),
                'positionY'=>text_field(array(
                        'name'=>'positionY',
                        'label'=>'Vertical Position',
                        'toggled_by'=>array('position'=>'custom')
                    )
                ),
                'size'=>select_field(array(
                        'name'=>'size',
                        'label'=>'Wallpaper Size',
                        'args'=>array(
                            'default',
                            'cover',
                            'contained',
                            'percentage',
                        ),
                        'toggle_fields'=>array('percentage'=>'percentage'),

                    )
                ),
                'percentage'=>text_field(array(
                        'name'=>'percentage',
                        'label'=>'Percentage Size',
                        'type'=>'text',
                        'toggled_by'=>array('size'=>'percentage')
                    )
                ),
            ),
        ),
    ),
);

