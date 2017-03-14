<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;
use bswp\Forms\Fields\TextArea;


use function bswp\Settings\_helpers\remove_link_decoration;
use function bswp\Settings\_helpers\remove_link_bg;
use function bswp\Settings\_helpers\border_settings_map;

$header = new SettingsGroup('header');


$header->add_tab('settings', array(
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
            'toggled_by' => array(),
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
            'toggled_by' => array(),
        )
    ),
));

// the colors
$header->add_tab('background_colors', $background_colors);
$header->add_tab('background_wallpaper', array_merge(
        $background_wallpaper,
        array(
            'overlay_color'=>new ColorPicker(
                array(
                    'name'=>'overlay_color',
                    'label'=>'Overlay Color',
                    'args'=>'transparency'
                )
            ),
            'overlay_color_rgba'=>new Hidden(
                array(
                    'name'=>'overlay_color_rgba',
                    'label'=>''
                )
            ),
        )
    )
);

$header->add_tab('text',
    array_merge(
        $regular_text,
        array( 'divider0'=>new Divider()),
        array( 'label0'=>new Label(array('name'=>'Headings'))),
        $headings_normal,
        array( 'divider1'=>new Divider()),
        $headings_links,
        array( 'divider2'=>new Divider()),
        $headings_links_hovered

    )
);

$header->add_tab('links',
    array_merge(
        $links,
        array( 'divider0'=>new Divider()),
        $hovered_links,
        array( 'divider1'=>new Divider()),
        $active_links
    )
);

$header->add_tab('borders', array_merge(
        $component_borders,
        array( 'divider1'=>new Divider()),
        array( 'label1'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);


$rebuild_header_script = '
    if(json.output != "no-change"){
        var $preview = $(".preview-window").contents();
        var $output = $(json.output);
        var position = json.callback_args;
        var $header = $preview.find(".js--header-content");
        $header.replaceWith($output);
    }
';

$header->add_tab('front_page',array(
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
            'preview_dependancies' => '$(\'#front_page_custom_content_ifr\').contents().find(\'body\').html(),title_alignment'
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
            'preview_dependancies' => '$(\'#front_page_custom_content_ifr\').contents().find(\'body\').html(),title_alignment,content_type'
        )
    ),
));


$header->add_tab('feed_page',array(
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

));


$header->add_tab('single_page',array(
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

));
