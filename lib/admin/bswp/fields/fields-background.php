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
                'background_start_color'=>color_field(
                    array(
                        'name'=>'background_start_color',
                        'label'=>'Start Color',
                        'args'=>'transparency'
                    )
                ),
                'background_start_color_rgba'=>no_field(
                    array(
                        'name'=>'background_start_color_rgba',
                        'label'=>''
                    )
                ),
                'background_end_color'=>color_field(
                    array(
                        'name'=>'background_end_color',
                        'label'=>'End Color',
                        'args'=>'transparency'
                    )
                ),
                'background_end_color_rgba'=>no_field(
                    array(
                        'name'=>'background_end_color_rgba',
                        'label'=>''
                    )
                ),
                'background_gradient'=>select_field(
                    array(
                        'name'=>'background_gradient',
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
                'background_use_wallpaper'=>select_field(array(
                        'name'=>'background_use_wallpaper',
                        'label'=>'Use Wallpaper?',
                        'args'=>array('no', 'yes'),
                        // 'toggle_fields'=>array(
                        //     'yes'=>'image,repeat,attachment,position,positionX,positionY,size,percentage'
                        // ),
                    )
                ),
                'background_image'=>file_field(array(
                        'name'=>'background_image',
                        'label'=>'Upload Image',
                    )
                ),
                'background_repeat'=>select_field(array(
                        'name'=>'background_repeat',
                        'label'=>'Repeat wallpaper?',
                        'args'=>array('no-repeat','repeat','repeat-x','repeat-y'),


                    )
                ),
                'background_attachment'=>select_field(array(
                        'name'=>'background_attachment',
                        'label'=>'Scroll wallpaper?',
                        'args'=>array('scroll','fixed'),

                    )
                ),
                'background_position'=>select_field(array(
                        'name'=>'background_position',
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
                            'custom'=>'background_positionX,background_positionY',
                        ),

                    )
                ),
                'background_positionX'=>text_field(array(
                        'name'=>'background_positionX',
                        'label'=>'Horizontal Position',
                        'toggled_by'=>array('background_position'=>'custom')
                    )
                ),
                'background_positionY'=>text_field(array(
                        'name'=>'background_positionY',
                        'label'=>'Vertical Position',
                        'toggled_by'=>array('background_position'=>'custom')
                    )
                ),
                'background_size'=>select_field(array(
                        'name'=>'background_size',
                        'label'=>'Wallpaper Size',
                        'args'=>array(
                            'default',
                            'cover',
                            'contained',
                            'percentage',
                        ),
                        'toggle_fields'=>array('percentage'=>'background_percentage'),

                    )
                ),
                'background_percentage'=>text_field(array(
                        'name'=>'background_percentage',
                        'label'=>'Percentage Size',
                        'type'=>'text',
                        'toggled_by'=>array('background_size'=>'percentage')
                    )
                ),
            ),
        ),
    ),
);

