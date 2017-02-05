<?php

use bswp\forms\fields;

/**
 * Headings
 * Settings for H tags
 * @var array
 */
$headings = array();
$heading_tags = array('h1','h2','h3','h4','h5','h6');

// each H tag is the same, so lets just loop through them to create them
foreach($heading_tags as $heading){
    $headings[$heading] =  array(
       'label'=>ucfirst($heading),
       'fields'=>array(
           $heading.'_color'=>new ColorPicker(array(
                    'name'=>$heading.'_color',
                    'label'=>'color',
                )
            ),
           $heading.'_background_style'=>new Select(array(
                   'name'=>$heading.'_background_style',
                   'label'=>'Background Style',
                   'args'=>array('none','highlighted', 'pill'),
                   'toggle_fields'=>array(
                            'highlighted'=>$heading.'_background_color,',
                            'pill'=>$heading.'_background_color,',
                        )
                )
            ),
           $heading.'_background_color'=>new ColorPicker(
                array(
                    'name'=>$heading.'_background_color',
                    'label'=>'Background Color',
                    'args'=>'transparency',
                    'toggled_by'=>array(
                        $heading.'_background_style'=>'highlighted',
                        $heading.'_background_style'=>'pill'
                    )
                )
            ),


           $heading.'_text_decoration'=>new TextDecorationSelect(array(
                'name'=>$heading.'_text_decoration',
                'toggle_fields' => array('text-shadow'=>$heading.'_text_shadow')
                )
            ),
           $heading.'_text_shadow'=>new TextShadowColorPicker(array(
                'name'=>$heading.'_text_shadow',
                'toggled_by' => array($heading.'_text_decoration' => 'text-shadow')

                )
            )

        ),
    );
}
// kjd($headings);
$headings_fields = array(
    'section'=>'headings',
    'tabs'=>$headings
);
