<?php


/**
 * Headings
 * Settings for H tags
 * @var array
 */
$headings = array();
$heading_tags = array('h1','h2','h3','h4','h5');

// each H tag is the same, so lets just loop through them to create them
foreach($heading_tags as $heading){
    $headings[$heading] =  array(
       'label'=>ucfirst($heading),
       'fields'=>array(
           'color'=>color_field(array(
                    'name'=>$heading.'_color',
                    'label'=>'color',
                )
            ),
           'background_style'=>select_field(array(
                   'name'=>$heading.'_background_style',
                   'label'=>'Background Style',
                   'args'=>array('none','square','tab', 'pill'),
                   'toggle_fields'=>array(
                            'square'=>$heading.'_background_color,'.$heading.'_border_style,'.$heading.'_border_color',
                            'tab'=>$heading.'_background_color,'.$heading.'_border_style,'.$heading.'_border_color',
                            'pill'=>$heading.'_background_color,'.$heading.'_border_style,'.$heading.'_border_color',
                        )
                )
            ),
           'background_color'=>color_field(
                array(
                    'name'=>$heading.'_background_color',
                    'label'=>'Background Color',
                    'args'=>'transparency',
                    'toggled_by'=>array(
                        $heading.'_background_style'=>'square',
                        $heading.'_background_style'=>'tab',
                        $heading.'_background_style'=>'pill'
                    )
                )
            ),
           'border_style'=>select_field(array(
                    'name'=>$heading.'_border_style',
                    'label'=>'Border Style',
                    'args'=>$border_styles,
                    'toggled_by'=>array(
                        $heading.'_background_style'=>'square',
                        $heading.'_background_style'=>'tab',
                        $heading.'_background_style'=>'pill'
                    ),
                    'toggle_fields'=>$header_styles_toggle
                )
            ),
             'border_color'=>color_field(array(
                      'name'=>$heading.'_border_color',
                      'label'=>'Border Color',
                      'toggled_by'=>array(
                        $heading.'_border_style' => $header_styles_true
                      )

                 )
             ),
           'decoration'=>text_decoration_field(array(
                'name'=>$heading.'_text_decoration'
                )
            ),
           'text_shadow_color'=>text_shadow_color_field(array(
                'name'=>$heading.'_text_shadow_color'
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

