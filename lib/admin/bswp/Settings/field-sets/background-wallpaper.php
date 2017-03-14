<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;


$background_wallpaper = array (

    'background_use_wallpaper'=>new Select(array(
            'name'=>'background_use_wallpaper',
            'label'=>'Use Wallpaper?',
            'args'=>array('no', 'yes'),
        )
    ),
    'background_image'=>new File(array(
            'name'=>'background_image',
            'label'=>'Upload Image',
        )
    ),
    'background_repeat'=>new Select(array(
            'name'=>'background_repeat',
            'label'=>'Repeat wallpaper?',
            'args'=>array('no-repeat','repeat','repeat-x','repeat-y'),
        )
    ),
    'background_attachment'=>new Select(array(
            'name'=>'background_attachment',
            'label'=>'Scroll wallpaper?',
            'args'=>array('scroll','fixed'),

        )
    ),
    'background_position'=>new Select(array(
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
    'background_positionX'=>new Text(array(
            'name'=>'background_positionX',
            'label'=>'Horizontal Position',
            'toggled_by'=>array('background_position'=>'custom')
        )
    ),
    'background_positionY'=>new Text(array(
            'name'=>'background_positionY',
            'label'=>'Vertical Position',
            'toggled_by'=>array('background_position'=>'custom')
        )
    ),
    'background_size'=>new Select(array(
            'name'=>'background_size',
            'label'=>'Wallpaper Size',
            'args'=>array(
                'auto',
                'cover',
                'contained',
                'percentage',
            ),
            'toggle_fields'=>array('percentage'=>'background_percentage'),

        )
    ),
    'background_percentage'=>new Text(array(
            'name'=>'background_percentage',
            'label'=>'Percentage Size',
            'type'=>'text',
            'toggled_by'=>array('background_size'=>'percentage')
        )
    ),

);
