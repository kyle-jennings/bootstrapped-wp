<?php

namespace bswp\forms\fields;
use bswp\forms\fields;

use function bswp\settings\_helpers;
use function bswp\settings\_helpers\border_settings_map;
use function bswp\settings\_helpers\add_px_string;
use function bswp\settings\_helpers\heading_toggle;


$heading_sizes = array('h1','h2','h3','h4','h5','h6');
$heading_tags = array();
// each H tag is the same, so lets just loop through them to create them
foreach($heading_sizes as $heading){
    $$heading = array(

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


        $heading.'_text_decoration'=>new Select(array(
                'name'=>$heading.'_text_decoration',
                'args' => array(
                    'none',
                    'overline',
                    'underline',
                    'line-through',
                    'text-shadow',
                ),
                'toggle_fields' => array('text-shadow'=>$heading.'_text_shadow')
            )
         ),
        $heading.'_text_shadow'=>new ColorPicker(array(
            'name'=>$heading.'_text_shadow',
            'toggled_by' => array($heading.'_text_decoration' => 'text-shadow'),
            'args'=>'transparency'
            )
        ),
        
        $heading.'_text_shadow_rgba'=>new Hidden(
            array(
                'name'=>$heading.'_text_shadow_rgba',
                'label'=>''
            )
        ),


    );
}
