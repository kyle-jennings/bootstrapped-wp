<?php

/**
 * All images are basically the same, some need a couple settings removed
 * @var array
 */
$image_types = array('thumbnails', 'inline_images','caption','iframe');
$images = array();

// The image types are all basically the same, so lets set the all at once
foreach($image_types as $image){
    $images[$image] = array(
        'label'=>ucfirst(str_replace('_',' ',$image)),
        'fields'=>array(
            $image.'_background_color'=>color_field(
                    array(
                        'name'=>$image.'_color',
                        'label'=>'Start Color',
                        'args'=>'transparency'
                    )
                ),
            $image.'_border_color'=>color_field(
                    array(
                        'name'=>$image.'_color',
                        'label'=>'Start Color',
                    )
                ),
            $image.'_hover_glow'=>color_field(
                    array(
                        'name'=>$image.'_color',
                        'label'=>'Start Color',
                        'args'=>'transparency'
                    )
                ),
            $image.'_text_color'=>color_field(
                    array(
                        'name'=>$image.'_color',
                        'label'=>'Start Color',
                    )
                ),
            $image.'_border_size'=>select_field(
                    array(
                            'name'=>$image.'_border_size',
                            'args'=>array_map('add_px_string', range(1,20))
                        )
                ),
            $image.'_border_style'=>select_field(
                    array(
                            'name'=>$image.'_border_style',
                            'args'=>array_map('add_px_string', range(1,20))
                        )
                ),
            $image.'_border_radius'=>select_field(
                    array(
                            'name'=>$image.'_border_radius',
                            'args'=>array_map('add_px_string', range(1,20))
                        )
                )
        ),
    );

    // some fields are removed for specific image types
    if($image != 'captions')
        unset($images[$image]['fields'][$image.'_text_color']);
    if(in_array($image, array('images','iframe')))
        unset($images[$image]['fields'][$image.'_hover_glow']);

}

$images_fields = array(
    'section'=>'images',
    'tabs'=>$images
);
