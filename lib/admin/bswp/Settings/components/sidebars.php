<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;
use bswp\Forms\Fields\SidebarPosition;
use bswp\Forms\Fields\TextArea;
use bswp\Forms\Fields\Text;

use function bswp\Settings\_helpers\remove_link_decoration;
use function bswp\Settings\_helpers\remove_link_bg;
use function bswp\Settings\_helpers\border_settings_map;


$rebuild_sidebar_script = '
    console.log(json.output);
    console.log(json.args);
    console.log(json);
    // var $preview = $(".preview-window").contents();
    // var $output = $(json.output);
    // var $body = $preview.find(".section--body");
    //
    // $body.replaceWith($output);
';

$layouts = new SettingsGroup('layouts');
$layouts->add_tab('sidebars',
    array(
        'frontpage_widgets' => new SidebarPosition(
            array(
                'label'=> 'Frontpage',
                'name'=>'frontpage_widgets',
                'args' => array(
                    'none',
                    'top',
                    'right',
                    'bottom',
                    'left',
                ),
                'preview'=>'form_save_warning',
                'preview_args'=>'rebuild_sidebar',
                'preview_callback' => $rebuild_sidebar_script,
            )
        ),

        'divider1'=>new Divider(),

        'feed_widgets' => new SidebarPosition(
            array(
                'label'=> 'Feed',
                'name'=>'feed_widgets',
                'args' => array(
                    'none',
                    'top',
                    'right',
                    'bottom',
                    'left',
                ),
                'preview'=>'form_save_warning',
                'preview_args'=>'rebuild_sidebar',
                'preview_callback' => $rebuild_sidebar_script,
            )
        ),

        'divider2'=>new Divider(),

        'single_widgets' => new SidebarPosition(
            array(
                'label'=> 'Single',
                'name'=>'single_widgets',
                'args' => array(
                    'none',
                    'top',
                    'right',
                    'bottom',
                    'left',
                ),
                'preview'=>'form_save_warning',
                'preview_args'=>'rebuild_sidebar',
                'preview_callback' => $rebuild_sidebar_script,

            )
        ),


    )
);
