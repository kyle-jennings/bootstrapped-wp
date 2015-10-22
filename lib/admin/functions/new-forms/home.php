<?php

    $bswp_nav = new bswpNav;
    $bswp_nav->tabs_nav($active_tab, 'theme');
    $bswp_nav->sections_dropdown_nav();

    $form = new bswpBuildForm;

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
                            'args'=>array('yes','no'),
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
                            'args'=>array('no-repeat','repeat','repeat-x', 'repeat-y')
                        )
                    ),
                    'attachment'=>select_field(array(
                            'name'=>'attachment',
                            'label'=>'Scroll wallpaper?',
                            'args'=>array('scroll','fixed')
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
                            'toggle_field'=>array(
                                'custom'=>'positionX,positionY'
                            ),
                        )
                    ),
                    'positionX'=>text_field(array(
                            'name'=>'positionX',
                            'label'=>'Horizontal Position',
                        )
                    ),
                    'positionY'=>text_field(array(
                            'name'=>'positionY',
                            'label'=>'Vertical Position',
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
                            'toggle_field'=>array('percentage'=>'percentage'),
                        )
                    ),
                    'percentage'=>text_field(array(
                       'name'=>'percentage',
                        'label'=>'Percentage Size',
                        'type'=>'text',
                        )
                    ),
                ),
            ),
        ),
    );

    settings_errors();
    echo $form->init($background_fields);