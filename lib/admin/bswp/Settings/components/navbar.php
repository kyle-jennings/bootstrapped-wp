<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;
use bswp\Forms\Fields\File;

use function bswp\Settings\_helpers\remove_link_decoration;
use function bswp\Settings\_helpers\remove_link_bg;
use function bswp\Settings\_helpers\border_settings_map;

$navbar = new SettingsGroup('navbar');
$navbar->add_tab('background_colors', $background_colors);

$navbar_links = $links;
unset($navbar_links['links_background_style']);
unset($navbar_links['links_background_color']);
unset($navbar_links['links_text_decoration']);
unset($navbar_links['links_text_shadow']);

$navbar->add_tab('text',
    array_merge(
        $regular_text,
        $navbar_links,
        $hovered_links,
        $active_links
    )
);



$navbar->add_tab('borders', array_merge(
        $component_borders,
        array( 'divider1'=>new Divider()),
        array( 'label1'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);



$navbar->add_tab('submenu_background_colors', array(
    'color'=>new ColorPicker(
        array(
            'name'=>'color',
            'label'=>'Color',
            'args'=>'transparency'
        )
    ),
    'color_rgba'=>new Hidden(
        array(
            'name'=>'color_rgba',
            'label'=>''
        )
    )
));

$sub_links = remove_link_decoration(remove_link_bg($links));
$navbar->add_tab('submenu_text',
    array_merge(
        $sub_links,
        $hovered_links,
        $active_links
    )
);

$navbar->add_tab('submenu_borders', array_merge(
        $top,
        array( 'divider1'=>new Divider()),
        $right,
        array( 'divider2'=>new Divider()),
        $bottom,
        array( 'divider3'=>new Divider()),
        $left,
        array( 'divider4'=>new Divider()),
        array( 'label1'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);


$navbar->add_tab('settings', array(
        'brand' => new Select(array(
                'label'=> 'Brand',
                'name'=>'brand',
                'args' => array(
                    'none',
                    'image',
                    'text'
                ),
                'toggle_fields' => array(
                    'image'=>'brand_image'
                )
        )),
        'brand_image'=>new File(array(
            'name'=>'brand_image',
            'label'=>'Upload Image',
            'toggled_by'=>array('brand'=>'image')
        )),
        'position' => new Select(
            array(
                'label'=> 'Position',
                'name'=>'position',
                'args'=> array(
                    'stickied_to_top',
                    'above_header',
                    'in_header_bottom',
                    'in_header_top',
                    'below_header',
                    'stickied_to_bottom'
                ),
                'preview'=>null
            )
        ),
        'movement' => new Select(
            array(
                'label'=> 'Movement',
                'name'=>'movement',
                'args'=> array(
                    'none',
                    'stick_to_top_on_scroll',
                ),
                'preview'=>null

            )
        ),
        'menu_toggle_type' => new Select(
            array(
                'label'=> 'Menu Toggle Type',
                'name'=>'menu_toggle_type',
                'args'=> array(
                    'default',
                    'text'
                ),
                'preview'=>null

            )
        )
    ) // end array of settings
);
