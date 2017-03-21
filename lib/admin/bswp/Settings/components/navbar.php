<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;
use bswp\Forms\Fields\File;
use bswp\Forms\Fields\Text;

use function bswp\Settings\_helpers\remove_link_decoration;
use function bswp\Settings\_helpers\remove_link_bg;
use function bswp\Settings\_helpers\border_settings_map;

$navbar = new SettingsGroup('navbar');



$rebuild_nav_script = '
    var $preview = $(".preview-window").contents();
    var $output = $(json.output);
    var position = json.callback_args;
    var $navbar = $preview.find("#navbar");
    var $header = $preview.find("#header");

    if( position == "above_header" || position == "stickied_to_top" ){
        console.log($navbar);
        $navbar.insertBefore($header);
    }else if( position == "in_header_top" ){
        $navbar.prependTo($header);
    }else if( position == "in_header_bottom" ) {
        $navbar.appendTo($header);
    }else if (position == "below_header" || position == "stickied_to_bottom") {
        $navbar.insertAfter($header);
    }else {
        $navbar.insertAfter($header);
    }
    $navbar.replaceWith($output);
';

$navbar->add_tab('settings', array(
        'settings' => new Select(
            array(
                'label'=> 'Settings',
                'name'=>'settings',
                'args' => array(
                    'basic',
                    'advanced',
                ),
                'toggle_fields' => array(
                    'basic'=>'brand,brand_image,position,movement,menu_toggle_type,box_shadow'
                ),
                'preview'=>'form_save_warning'
            )
        ),
        'box_shadow' => new Select(array(
            'label'=> 'Disable Box Shadow?',
            'name' => 'box_shadow',
            'args' => array(
                'no',
                'yes'
            ),
            'toggled_by' => array(
                'settings'=>'basic'
            ),
        )),
        'brand' => new Select(array(
                'label'=> 'Brand',
                'name'=>'brand',
                'args' => array(
                    'text',
                    'none',
                    'image',
                ),
                'toggle_fields' => array(
                    'image'=>'brand_image'
                ),
                'toggled_by' => array(
                    'settings'=>'basic'
                ),
                'preview'=>'ajax',
                'preview_args'=>'rebuild_nav',
                'preview_callback' => $rebuild_nav_script,
                'preview_dependancies' => 'brand,brand_image,position,movement,menu_toggle_type'
        )),
        'brand_image'=>new File(array(
            'name'=>'brand_image',
            'label'=>'Upload Image',
            'toggled_by'=>array(
                'brand'=>'image',
                'settings'=>'basic'

            ),
            'preview'=>'ajax',
            'preview_args'=>'rebuild_nav',
            'preview_callback' => $rebuild_nav_script,
            'preview_dependancies' => 'brand,brand_image,position,movement,menu_toggle_type'
        )),
        'position' => new Select(
            array(
                'label'=> 'Position',
                'name'=>'position',
                'args'=> array(
                    'default',
                    'stickied_to_top',
                    'above_header',
                    'in_header_top',
                    'in_header_bottom',
                    'below_header',
                    'stickied_to_bottom'
                ),
                'toggled_by' => array(
                    'settings'=>'basic'
                ),
                'preview'=>'ajax',
                'preview_args'=>'rebuild_nav',
                'preview_callback' => $rebuild_nav_script,
                'preview_dependancies' => 'brand,brand_image,position,movement,menu_toggle_type'
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
                'toggled_by' => array(
                    'settings'=>'basic'
                ),
                'preview'=>'ajax',
                'preview_args'=>'rebuild_nav',
                'preview_callback' => $rebuild_nav_script,
                'preview_dependancies' => 'brand,brand_image,position,movement,menu_toggle_type'

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
                'toggled_by' => array(
                    'settings'=>'basic'
                ),
                'preview'=>'ajax',
                'preview_args'=>'rebuild_nav',
                'preview_callback' => $rebuild_nav_script,
                'preview_dependancies' => 'brand,brand_image,position,movement,menu_toggle_type'

            )
        ),
        'float_section' => new Select (
            array(
                'name'=>'float_section',
                'label'=>'Float Section',
                'args'=>array('no','yes'),
                'toggle_fields'=>array(
                    'yes'=>'top_margin,bottom_margin,outer_glow'
                ),
            )
        ),
        'top_margin' => new Text(
            array(
                'name'=>'top_margin',
                'label'=>'Top Margin',
                'args'=>array('suffix'=>'px'),
                'toggled_by'=>array('float_section'=>'yes')
            )
        ),
        'bottom_margin' => new Text(
            array(
                'name'=>'bottom_margin',
                'label'=>'Bottom Margin',
                'args'=>array('suffix'=>'px'),
                'toggled_by'=>array('float_section'=>'yes')
            )
        ),
        'outer_glow' => new Select (
            array(
                'name'=>'outer_glow',
                'label'=>'Outer Glow',
                'args'=>array('none','left_and_right','top_and_bottom','top','bottom','all_sides'),
                'toggled_by'=>array('float_section'=>'yes')
            )
        ),
    ) // end array of settings
);

// the colors
$navbar->add_tab('background_colors', $background_colors);

// // set navbar link, theyre special
$navbar_link = $link;

unset($navbar_link['link_text_decoration']);
unset($navbar_link['link_text_shadow']);
unset($navbar_link['link_text_shadow_rgba']);
unset($navbar_link['link_background_style']);
unset($navbar_link['link_background_color']);
unset($navbar_link['link_background_color_rgba']);

$navbar_hovered_link = $hovered_link;
$navbar_hovered_link['hovered_link_background_style'] = clone $hovered_link['hovered_link_background_style'];
unset($navbar_hovered_link['hovered_link_background_style']->args[2]);
unset($navbar_hovered_link['hovered_link_background_style']->toggle_fields['pills']);
unset($navbar_hovered_link['hovered_link_text_decoration']);
unset($navbar_hovered_link['hovered_link_text_shadow']);
unset($navbar_hovered_link['hovered_link_text_shadow_rgba']);

$navbar_active_link = $active_link;
$navbar_active_link['active_link_background_style'] = clone $active_link['active_link_background_style'];
unset($navbar_active_link['active_link_background_style']->args[2]);
unset($navbar_active_link['active_link_background_style']->toggle_fields['pills']);
unset($navbar_active_link['active_link_text_decoration']);
unset($navbar_active_link['active_link_text_shadow']);
unset($navbar_active_link['active_link_text_shadow_rgba']);



$navbar->add_tab('text',
    array_merge(
        $regular_text,
        array( 'divider1'=>new Divider()),
        $navbar_link,
        array( 'divider2'=>new Divider()),
        $navbar_hovered_link,
        array( 'divider3'=>new Divider()),
        $navbar_active_link
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


// add the "default" option to the background styles


$sub_link = remove_link_bg($link);
$sub_link = remove_link_decoration($sub_link);
$sub_hovered = $hovered_link;

$sub_hovered['hovered_link_background_style'] = clone $sub_hovered['hovered_link_background_style'];
array_unshift($sub_hovered['hovered_link_background_style']->args,  'default');
unset($sub_hovered['hovered_link_text_decoration']);
unset($sub_hovered['hovered_link_text_shadow']);
unset($sub_hovered['hovered_link_text_shadow_rgba']);

$sub_active = $active_link;
$sub_active['active_link_background_style'] = clone $sub_active['active_link_background_style'];
array_unshift($sub_active['active_link_background_style']->args,  'default');
unset($sub_active['active_link_text_decoration']);
unset($sub_active['active_link_text_shadow']);
unset($sub_active['active_link_text_shadow_rgba']);


$navbar->add_tab('submenu_text',
    array_merge(
        $sub_link,
        $sub_hovered,
        $sub_active
    )
);


// subnav borders
$navbar->add_tab('submenu_borders', array_merge(
        $component_borders,
        array( 'divider4'=>new Divider()),
        array( 'label1'=>new Label(array('name'=>'border_radius'))),
        $radii_fields
    )
);
