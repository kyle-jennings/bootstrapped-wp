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

                'preview'=> null
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


            )
        ),


    )
);
