<?php
/**
 * Each set of fields can be automatically generated using ths following array
 * structure for settings:
 *
 *
 * $fields = array(
 *    'tabs'=>array(
 *        'tab-name'=>array(
 *            'label'=>'Tab Name',
 *            'fields'=>array(
 *                'color'=>array(
 *                    'name'=>'field-name',
 *                    'label'=>'Field Name',
 *                    'type'=>'field-type',
 *                    'args'=>'{string or array}',
 *                    'toggle_fields'=>array('option'=>'field_1,field_2,field_3'),
 *                    'toggled_by'=>array('field_name'=>'option1,option2,option3'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$feed_templates = array('category','archive','tag','author','date','search',);
$page_templates = array('default','front_page','page','single','404','attachment');
$custom_templates = array('template_1','template_2','template_3','template_4','template_5','template_6');

// in good practice, this should be in the settings.php file but because
// its so specific to this file I think we can keep it here.
function build_template_fields($templates){

    $temp = array();

    foreach($templates as $template){

        $positions = array('none','top','right','bottom','left');
        $position_toggles = array();

        foreach($positions as $position){
            if($position == 'none')
                continue;
            $position_toggles[$position] = $template.'_sidebar_visibility';
        }

        $temp[$template.'_sidebar'] = select_field(array(
                'name'=>$template.'_sidebar',
                'label'=>$template,
                'args'=>$positions,
                'toggle_fields'=>$position_toggles,
                'class'=>'js--sidebar-preview'
            )
        );

        $temp[$template.'_sidebar_visibility'] = sidebar_field(array(
                'name'=>$template.'_sidebar_visibility',
                'label'=>$template.' Visibility',
                'args'=>array('all','visible-phone','visible-tablet','visible-desktop','hidden-phone','hidden-tablet','hidden-desktop'),
                'toggled_by'=>array($template.'_sidebar'=>'top,right,bottom,left'),
            )
        );

    }

    return $temp;
}


// the different feeds
$feed_templates_fields = array(
    'section'=>'feed_templates',
    'tabs'=>array(
        'default'=>array(
            'label'=>'default',
            'fields'=>build_template_fields($feed_templates),
        ),
    ),
);


$page_templates_fields = array(
    'section'=>'page-templates',
    'tabs'=>array(
        'default'=>array(
            'label'=>'default',
            'fields'=>build_template_fields($page_templates),
        ),
    ),
);

$custom_templates_fields = array(
    'section'=>'custom-page-templates',
    'tabs'=>array(
        'default'=>array(
            'label'=>'default',
            'fields'=>build_template_fields($custom_templates),
        ),
    ),
);

$sidebar_settings_tabs = array(
    $feed_templates_fields,
    // $page_templates_fields,
    // $custom_templates_fields,
);