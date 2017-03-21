<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;


if($component_options['activate_pagination'] == 'yes'){

    $pagination = new SettingsGroup('pagination');
    $pagination->add_tab('background_colors', $background_colors);


    // links
    $plink = $link;
    unset($plink['link_background_style']);
    unset($plink['link_text_decoration']);
    unset($plink['link_text_shadow']);
    unset($plink['link_text_shadow_rgba']);

    $plink['link_background_color'] = clone $link['link_background_color'];
    unset($plink['link_background_color']->toggled_by);


    // hovered links
    $plink_hovered = $hovered_link;
    unset($plink_hovered['hovered_link_background_style']);
    unset($plink_hovered['hovered_link_text_decoration']);
    unset($plink_hovered['hovered_link_text_shadow']);
    unset($plink_hovered['hovered_link_text_shadow_rgba']);
    $plink_hovered['hovered_link_background_color'] = clone $hovered_link['hovered_link_background_color'];
    unset($plink_hovered['hovered_link_background_color']->toggled_by);

    // active links
    $plink_active = $active_link;
    unset($plink_active['active_link_background_style']);
    unset($plink_active['active_link_text_decoration']);
    unset($plink_active['active_link_text_shadow']);
    unset($plink_active['active_link_text_shadow_rgba']);

    $plink_active['active_link_background_color'] = clone $active_link['active_link_background_color'];
    unset($plink_active['active_link_background_color']->toggled_by);


    $pagination->add_tab('links',
        array_merge(
            $regular_text,
            array( 'divider0'=>new Divider()),
            $plink,
            array( 'divider1'=>new Divider()),
            $plink_hovered,
            array( 'divider2'=>new Divider()),
            $plink_active
        )
    );

    $pagination->add_tab('borders', array_merge(
            $component_borders,
            array( 'divider1'=>new Divider()),
            array( 'label1'=>new Label(array('name'=>'border_radius'))),
            $radii_fields
        )
    );


}
