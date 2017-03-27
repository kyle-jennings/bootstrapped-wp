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
        'frontpage_sidebar_location' => new SidebarPosition(
            array(
                'label'=> 'Frontpage',
                'name'=>'frontpage_sidebar_location',
                'args' => array(
                    'none',
                    'top',
                    'right',
                    'bottom',
                    'left',
                ),
                'toggle_fields' => array(
                    'top'=>'frontpage_sidebar_visibility',
                    'right'=>'frontpage_sidebar_visibility',
                    'bottom'=>'frontpage_sidebar_visibility',
                    'left'=>'frontpage_sidebar_visibility',
                ),
                'preview'=> null
            )
        ),
        'frontpage_sidebar_visibility' => new Select(
            array(
                'label' => 'Sidebar Visibilty',
                'name'=>'frontpage_sidebar_visibility',
                'args' => array(
                    'all',
                    'visible_phone',
                    'visible_tablet',
                    'visible_desktop',
                    'hidden_phone',
                    'hidden_tablet',
                    'hidden_desktop',
                ),
                'toggled_by'=> array(
                    'frontpage_sidebar_location'=>'top,right,bottom,left'
                )
            )
        ),
        'divider1'=>new Divider(),

        'feed_sidebar_location' => new SidebarPosition(
            array(
                'label'=> 'Feed',
                'name'=>'feed_sidebar_location',
                'args' => array(
                    'none',
                    'top',
                    'right',
                    'bottom',
                    'left',
                ),
                'toggle_fields' => array(
                    // 'basic'=>'brand,brand_image,position,movement,menu_toggle_type'
                ),
                'toggle_fields' => array(
                    'top'=>'feed_sidebar_visibility',
                    'right'=>'feed_sidebar_visibility',
                    'bottom'=>'feed_sidebar_visibility',
                    'left'=>'feed_sidebar_visibility',
                ),
            )
        ),
        'feed_sidebar_visibility' => new Select(
            array(
                'label' => 'Sidebar Visibilty',
                'name'=>'feed_sidebar_visibility',
                'args' => array(
                    'all',
                    'visible_phone',
                    'visible_tablet',
                    'visible_desktop',
                    'hidden_phone',
                    'hidden_tablet',
                    'hidden_desktop',
                ),
                'toggled_by'=> array(
                    'feed_sidebar_location'=>'top,right,bottom,left'
                )
            )
        ),
        'divider2'=>new Divider(),

        'single_sidebar_location' => new SidebarPosition(
            array(
                'label'=> 'Single',
                'name'=>'single_sidebar_location',
                'args' => array(
                    'none',
                    'top',
                    'right',
                    'bottom',
                    'left',
                ),
                'toggle_fields' => array(
                    // 'basic'=>'brand,brand_image,position,movement,menu_toggle_type'
                ),
                'toggle_fields' => array(
                    'top'=>'single_sidebar_visibility',
                    'right'=>'single_sidebar_visibility',
                    'bottom'=>'single_sidebar_visibility',
                    'left'=>'single_sidebar_visibility',
                ),
            )
        ),
        'single_sidebar_visibility' => new Select(
            array(
                'label' => 'Sidebar Visibilty',
                'name'=>'single_sidebar_visibility',
                'args' => array(
                    'all',
                    'visible_phone',
                    'visible_tablet',
                    'visible_desktop',
                    'hidden_phone',
                    'hidden_tablet',
                    'hidden_desktop',
                ),
                'toggled_by'=> array(
                    'single_sidebar_location'=>'top,right,bottom,left'
                )
            )
        ),

    )
);
