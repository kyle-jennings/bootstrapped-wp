<?php

$feed_settings_fields = array(
    'post_title_border_color'=>color_field(array(
            'name'=>'post_title_border_color',
            'label'=>'Title underline color'
        )
    ),
    'pagination_location'=>select_field(array(
            'name'=>'pagination_location',
            'label'=>'Pagination Location',
            'args'=>array('below','above','both')
        )
    ),
    'post_content'=>select_field(array(
            'name'=>'post_content',
            'label'=>'Post Content',
            'args'=>array('excerpt','full_content'),
        )
    ),
    'show_image'=>select_field(array(
            'name'=>'show_image',
            'label'=>'Show featued image?',
            'args'=>array('no','yes'),
            'toggle_fields'=>array('yes'=>'image_position,image_source')
        )
    ),
    'image_position'=>select_field(array(
            'name'=>'image_position',
            'label'=>'Image Position',
            'args'=>array('atop_post','left_of_post','right_of_post','after_post','before_post_info','before_content','before_post_meta'),
            'toggled_by'=>array('show_image'=>'yes')
        )
    ),
    'image_source'=>select_field(array(
            'name'=>'image_source',
            'label'=>'Image source',
            'args'=>array('featured_image','author_image'),
            'toggled_by'=>array('show_image'=>'yes')

        )
    )
);
