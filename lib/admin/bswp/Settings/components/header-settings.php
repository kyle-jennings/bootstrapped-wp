<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;
use bswp\Forms\Fields\TextArea;
use bswp\Forms\Fields\Text;


use function bswp\Settings\_helpers\remove_link_decoration;
use function bswp\Settings\_helpers\remove_link_bg;
use function bswp\Settings\_helpers\border_settings_map;


$header_settings_tab = array(
    'settings' => new Select(
        array(
            'label'=> 'Settings',
            'name'=>'settings',
            'args' => array(
                'basic',
                'advanced',
            ),
            'toggle_fields' => array(
                // 'basic'=>'brand,brand_image,position,movement,menu_toggle_type'
            ),
            'preview'=>'form_save_warning'
        )
    ),
    'height' => new Select(
        array(
            'label'=> 'Height',
            'name'=>'height',
            'args' => array(
                'small',
                'medium',
                'large',
                'fullpage',
                'custom'
            ),
            'toggle_fields'=>array(
                'custom'=>'header_padding',
            ),
        )
    ),
    'header_padding'=>new Text(array(
            'name'=>'header_padding',
            'label'=>'Header Veritcal Padding',
            'toggled_by'=>array('height'=>'custom')
        )
    ),
    'title_size' => new Select(
        array(
            'label'=> 'Title Size',
            'name'=>'title_size',
            'args' => array(
                'small',
                'medium',
                'large',
            ),
            'toggled_by' => array(),
        )
    ),
    // 'float_section' => new Select (
    //     array(
    //         'name'=>'float_section',
    //         'label'=>'Float Section',
    //         'args'=>array('no','yes'),
    //         'toggle_fields'=>array(
    //             'yes'=>'top_margin,bottom_margin,outer_glow'
    //         ),
    //     )
    // ),
    // 'top_margin' => new Text(
    //     array(
    //         'name'=>'top_margin',
    //         'label'=>'Top Margin',
    //         'args'=>array('suffix'=>'px'),
    //         'toggled_by'=>array('float_section'=>'yes')
    //     )
    // ),
    // 'bottom_margin' => new Text(
    //     array(
    //         'name'=>'bottom_margin',
    //         'label'=>'Bottom Margin',
    //         'args'=>array('suffix'=>'px'),
    //         'toggled_by'=>array('float_section'=>'yes')
    //     )
    // ),
    // 'outer_glow' => new Select (
    //     array(
    //         'name'=>'outer_glow',
    //         'label'=>'Outer Glow',
    //         'args'=>array('none','left_and_right','top_and_bottom','top','bottom','all_sides'),
    //         'toggled_by'=>array('float_section'=>'yes')
    //     )
    // ),

);

$rebuild_header_script = '
    if(json.output != "no-change"){
        var $preview = $(".preview-window").contents();
        var $output = $(json.output);
        var position = json.callback_args;
        var $settings = $preview.find(".js--header-content");
        $settings.replaceWith($output);
    }';

$header_frontpage_settings = array(
    'content_type' => new Select(
        array(
            'label'=> 'Content Type',
            'name'=>'content_type',
            'args' => array(
                'title',
                'custom_content',
            ),
            'toggle_fields' => array(
                'title'=>'title_alignment',
                'custom_content'=>'custom_content'

            ),
            'preview'=>'ajax',
            'preview_args'=>'rebuild_header',
            'preview_callback' => $rebuild_header_script,
            'preview_dependancies' => '$(\'#frontpage_custom_content_ifr\').contents().find(\'body\').html(),title_alignment'
        )
    ),
    'title_alignment' => new Select(
        array(
            'label'=> 'Title Alignment',
            'name'=>'title_alignment',
            'args' => array(
                'left',
                'center',
                'right'
            ),
            'toggled_by' => array(
                'content_type' => 'title'
            ),
        )
    ),

    'custom_content' => new TextArea(
        array(
            'label'=> 'Custom Content',
            'name'=>'custom_content',
            'toggled_by' => array(
                'content_type' => 'custom_content'
            ),
            'preview'=>'ajax',
            'preview_args' => 'rebuild_header_custom_content',
            'preview_callback' => $rebuild_header_script,
            'args'=> array(
                'type'=>'wp_editor',
                'args' => array(),
            ),
            'preview_dependancies' => '$(\'#frontpage_custom_content_ifr\').contents().find(\'body\').html(),title_alignment,content_type'
        )
    ),
);

$header_feed_settings = array(
    'content_type' => new Select(
        array(
            'label'=> 'Content Type',
            'name'=>'content_type',
            'args' => array(
                'title',
                'featured_post',
                'featured_post_and_excerpt',
            ),
            'preview'=>'ajax',
            'preview_args'=>'rebuild_header',
            'preview_callback' => $rebuild_header_script,
            'preview_dependancies' => ''
        )
    ),
    'title_alignment' => new Select(
        array(
            'label'=> 'Title Alignment',
            'name'=>'title_alignment',
            'args' => array(
                'left',
                'center',
                'right'
            )
        )
    ),

);

$header_single_settings = array(
    'content_type' => new Select(
        array(
            'label'=> 'Content Type',
            'name'=>'content_type',
            'args' => array(
                'title',
                'title_and_excerpt',
                'excerpt',
            ),
            'preview'=>'ajax',
            'preview_args'=>'rebuild_header',
            'preview_callback' => $rebuild_header_script,
            'preview_dependancies' => ''
        )
    ),
    'title_alignment' => new Select(
        array(
            'label'=> 'Title Alignment',
            'name'=>'title_alignment',
            'args' => array(
                'left',
                'center',
                'right'
            )
        )
    ),

);
