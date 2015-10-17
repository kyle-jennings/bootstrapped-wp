<?php

class fieldSettingsClass{
    static $background_fields = array(
        'section'=>'Images',
        'tabs'=>array(),
    );
    static $borders_fields = array(
        'section'=>'Images',
        'tabs'=>array(),
    );
    static $headings_fields = array(
        'section'=>'Images',
        'tabs'=>array(),
    );
    static $text_fields = array(
        'section'=>'Images',
        'tabs'=>array(),
    );
    static $components_fields = array(
        'section'=>'Images',
        'tabs'=>array(),
    );
    static $images_fields = array(
        'section'=>'Images',
        'tabs'=>array(),
    );

    /**
     * All images are basically the same, some need a couple settings removed
     * @var array
     */
    private function image_settings(){
        $image_types = array('thumbnails', 'images','caption','iframe');
        $images = array();
        foreach($image_types as $image){
            $images[$image] = array(
                'label'=>ucfirst($image),
                'fields'=>array(
                    'background_color'=>color_field(
                            array(
                                'name'=>'color',
                                'label'=>'Start Color',
                                'args'=>'transparency'
                            )
                        ),
                    'border_color'=>color_field(
                            array(
                                'name'=>'color',
                                'label'=>'Start Color',
                            )
                        ),
                    'hover_glow'=>color_field(
                            array(
                                'name'=>'color',
                                'label'=>'Start Color',
                                'args'=>'transparency'
                            )
                        ),
                    'text_color'=>color_field(
                            array(
                                'name'=>'color',
                                'label'=>'Start Color',
                            )
                        ),
                    'border_size'=>select_field(
                            array(
                                    'name'=>'border_size',
                                    'args'=>array_map('add_px_string', range(1,20))
                                )
                        ),
                    'border_style'=>select_field(
                            array(
                                    'name'=>'border_style',
                                    'args'=>array_map('add_px_string', range(1,20))
                                )
                        ),
                    'border_radius'=>select_field(
                            array(
                                    'name'=>'border_radius',
                                    'args'=>array_map('add_px_string', range(1,20))
                                )
                        )
                ),
            );

            if($image != 'captions')
                unset($images[$image]['fields']['text_color']);
            if(in_array($image, array('images','iframe')))
                unset($images[$image]['fields']['hover_glow']);

        }

        $this->images_fields['tabs'] = $images;
    }


}