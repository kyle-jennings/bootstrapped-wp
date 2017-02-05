<?php

use bswp\forms\fields;

/**
 * All images are basically the same, some need a couple settings removed
 * @var array
 */
$image_types = array('inline_images', 'linked_images', 'caption_images');
$images = array();

// The image types are all basically the same, so lets set the all at once
foreach($image_types as $image){
    $images[$image] = array(
        'label'=>ucfirst(str_replace('_',' ',$image)),
        'fields'=>array(

            $image.'_border_style'=>new Select(array(
                    'name'=> $image.'_border_style',
                    'label'=>'Border Style',
                    'args'=>$border_styles,
                    'toggle_fields'=>border_setings_map('border_styles_toggle', array($image))
                )
            ),
            $image.'_border_color'=>new ColorPicker(array(
                    'label'=>'Border Color',
                    'name'=> $image.'_border_color',
                    'toggled_by'=>array($image.'_border_style' => border_setings_map('border_styles_toggled_by', array($image) ) )
                )
            ),
            $image.'_border_width'=>new Select(array(
                    'name'=> $image.'_border_width',
                    'label'=>'Border Width',
                    'args'=>array_map('add_px_string', range(1,20)),
                    'toggled_by'=>array($image.'_border_style' => border_setings_map('border_styles_toggled_by', array($image) ) )

                )
            ),
            $image.'_hover_glow' => new ColorPicker(
                    array(
                        'name'=>$image.'_hover_glow',
                        'label'=>'Hover Glow Color',
                        'args'=>'transparency',
                        'toggled_by'=>array($image.'_border_style' => border_setings_map('border_styles_toggled_by', array($image) ) )
                    )
                ),
            $image.'_hover_glow_rgba' => new HiddenField(
                array(
                    'name'=>$image.'_hover_glow_rgba',
                    'label'=>'',
                )
            ),
            $image.'_text_color'=>new ColorPicker(
                    array(
                        'name'=>$image.'_text_color',
                        'label'=>'Text Color',
                    )
                ),
            $image.'_background_color'=>new ColorPicker(
                    array(
                        'name'=>$image.'_background_color',
                        'label'=>'Background Color',
                        'args'=>'transparency'
                    )
                ),
            $image.'_background_color_rgba'=> new HiddenField(
                    array(
                        'name'=>$image.'_background_color_rgba',
                        'label'=>'',
                    )
                ),

            $image.'_border_radius'=>new Select( array(
                'name'=>$image.'_border_radius',
                'label'=>'Border Radius',
                'args'=>array_map('add_px_string', range(1,20))
                )
            ),
        ),
    );

    // some fields are removed for specific image types
    if($image != 'caption_images'){
        unset($images[$image]['fields'][$image.'_text_color']);
        unset($images[$image]['fields'][$image.'_background_color']);
    }


    foreach($images[$image]['fields'][$image.'_border_style']['toggle_fields'] as $toggle=>$fields){
        $images[$image]['fields'][$image.'_border_style']['toggle_fields'][$toggle] .= $image.'_hover_glow';
        $images[$image]['fields'][$image.'_border_style']['toggle_fields'][$toggle] .= ','.$image.'_background_color';

        // examine($images[$image]['fields'][$image.'_border_style']['toggle_fields'][$toggle]);

    }




}
$images_fields = array(
    'section'=>'images',
    'tabs'=>$images
);
