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
if(json.callback_args){
    var args = json.callback_args;
    window.args = args;
    var position  = args.position;
    var width = (position == "left" || position == "right") ? "span9" : "span12";
    var $preview = $(".preview-window").contents();
    var $output = $(json.output);
    var $content = $preview.find(".content-column");

    $content.removeClass("span9 span12").addClass(width);
    $preview.find(".sidebar").remove();

    if(position == "left" || position == "top")
        $output.insertBefore($content);
    else
        $output.insertAfter($content);
}
';

$layouts = new SettingsGroup('layouts');
$layouts->add_tab('sidebars',
    array(
        'frontpage' => new SidebarPosition(
            array(
                'label'=> 'Frontpage',
                'name'=>'frontpage',
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

        'feed' => new SidebarPosition(
            array(
                'label'=> 'Feed',
                'name'=>'feed',
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

        'single' => new SidebarPosition(
            array(
                'label'=> 'Single',
                'name'=>'single',
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
