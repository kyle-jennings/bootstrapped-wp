<?php

namespace bswp\settings;

$options = get_option('bswp_site_settings');
$options = $options['available_components'];
$components = array();



if($options['activate_collapsibles'] == 'yes'){
    // Background settings
    $collapsibles = new SettingsGroup('collapsibles');
    $collapsibles->tabs['background_colors'] = $background_colors;
    $collapsibles->tabs['background_wallpapers'] = $background_wallpaper;
    $collapsibles->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );

    $collapsibles->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );



    $collapsibles->tabs['headings'] = array_merge(
        $h1,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $h2,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $h3,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $h4,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $h5,
        array( 'divider5'=>new \bswp\forms\fields\Divider()),
        $h6
    );

}

if($options['activate_tables'] == 'yes'){
    // Background settings
    $tables = new SettingsGroup('tables');
    $tables->tabs['header_background_colors'] = $background_colors;
    $tables->tabs['even_row_background_colors'] = $background_colors;
    $tables->tabs['odd_row_background_colors'] = $background_colors;

    $tables->tabs['header_row_text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

    $tables->tabs['even_row_text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

    $tables->tabs['odd_row_text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

    $tables->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );

}

if($options['activate_tabs'] == 'yes'){
    $tabs = new SettingsGroup('tables');
    $tabs->tabs['background_colors'] = $background_colors;

    $tabs->tabs['active_tab_borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );

    $tabs->tabs['inactive_tab_borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );

    $tabs->tabs['active_tab_text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

    $tabs->tabs['inactive_tab_text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );
}

if($options['activate_alerts'] == 'yes'){
    $alerts = new SettingsGroup('alerts');
    $alerts->tabs['background_colors'] = $background_colors;

    $alerts->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );

    $alerts->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

}

if($options['activate_tooltips'] == 'yes'){
    $tooltips = new SettingsGroup('tooltips');
    $tooltips->tabs['background_colors'] = $background_colors;

    $tooltips->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );


    $tooltips->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );
}

if($options['activate_modals'] == 'yes'){

    $modals = new SettingsGroup('modals');
    $modals->tabs['background_colors'] = $background_colors;

    $modals->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );


    $modals->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );
}

if($options['activate_quotes'] == 'yes'){

    $quotes = new SettingsGroup('quotes');
    $quotes->tabs['background_colors'] = $background_colors;

    $quotes->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );


    $quotes->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

}

if($options['activate_preformatted'] == 'yes'){

    $preformatted = new SettingsGroup('preformatted');
    $preformatted->tabs['background_colors'] = $background_colors;

    $preformatted->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );


    $preformatted->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

}

if($options['activate_breadcrumbs'] == 'yes'){
    $breadcrumbs = new SettingsGroup('breadcrumbs');
    $breadcrumbs->tabs['background_colors'] = $background_colors;

    $breadcrumbs->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );


    $breadcrumbs->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

}

if($options['activate_pagination'] == 'yes'){

    $pagination = new SettingsGroup('pagination');
    $pagination->tabs['background_colors'] = $background_colors;

    $pagination->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );


    $pagination->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

}

if($options['activate_well'] == 'yes'){

    $well = new SettingsGroup('well');
    $well->tabs['background_colors'] = $background_colors;

    $well->tabs['borders'] = array_merge(
        $top,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $right,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $bottom,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $left,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        array( 'label1'=>new \bswp\forms\fields\Label(array('name'=>'border_radius'))),
        $radii_fields
    );


    $well->tabs['text'] = array_merge(
        $regular_text,
        array( 'divider1'=>new \bswp\forms\fields\Divider()),
        $links,
        array( 'divider2'=>new \bswp\forms\fields\Divider()),
        $visited_links,
        array( 'divider3'=>new \bswp\forms\fields\Divider()),
        $hovered_links,
        array( 'divider4'=>new \bswp\forms\fields\Divider()),
        $active_links
    );

}
