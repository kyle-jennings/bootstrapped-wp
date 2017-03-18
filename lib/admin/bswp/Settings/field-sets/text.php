<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;

use function bswp\Settings\_helpers;
use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\add_px_string;
use function bswp\Settings\_helpers\heading_toggle;

$regular_text = array(

    'text_color'=>new ColorPicker(array(
            'name'=>'text_color',
            'label'=>'Text',
            'type'=>'color',
        )
    )

);


$heading_states = array('normal','link','link_hovered');
// each H tag is the same, so lets just loop through them to create them
foreach($heading_states as $state){
    $name = 'headings_'. $state;
    $$name = array(

        'headings_'.$state.'_color'=>new ColorPicker(array(
                 'name'=>'headings_'.$state.'_color',
             )
         ),


        'headings_'.$state.'_text_decoration'=>new Select(array(
                'name'=>'headings_'.$state.'_text_decoration',
                'args' => array(
                    'none',
                    'overline',
                    'underline',
                    'line-through',
                    'text-shadow',
                ),
                'toggle_fields' => array('text-shadow'=>'headings_'.$state.'_text_shadow')
            )
         ),
        'headings_'.$state.'_text_shadow'=>new ColorPicker(array(
            'name'=>'headings_'.$state.'_text_shadow',
            'toggled_by' => array('headings_'.$state.'_text_decoration' => 'text-shadow'),
            'args'=>'transparency'
            )
        ),

        'headings_'.$state.'_text_shadow_rgba'=>new Hidden(
            array(
                'name'=>'headings_'.$state.'_text_shadow_rgba',
                'label'=>''
            )
        ),


    );
}
