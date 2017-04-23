<?php

namespace bswp\Settings;


include dirname(__FILE__).'/_helpers.php';

include dirname(__FILE__).'/field-sets/available-components.php';
include dirname(__FILE__).'/field-sets/available-sections.php';
include dirname(__FILE__).'/field-sets/background-colors.php';
include dirname(__FILE__).'/field-sets/background-wallpaper.php';
include dirname(__FILE__).'/field-sets/borders.php';
include dirname(__FILE__).'/field-sets/border-radius.php';
include dirname(__FILE__).'/field-sets/links.php';
include dirname(__FILE__).'/field-sets/settings.php';
include dirname(__FILE__).'/field-sets/text.php';
include dirname(__FILE__).'/field-sets/component-borders.php';


// component settings
include dirname(__FILE__).'/components/header-settings.php';

include dirname(__FILE__).'/components/preformatted.php';
include dirname(__FILE__).'/components/quotes.php';
include dirname(__FILE__).'/components/tables.php';
include dirname(__FILE__).'/components/images.php';
include dirname(__FILE__).'/components/forms.php';
include dirname(__FILE__).'/components/buttons.php';
include dirname(__FILE__).'/components/alerts.php';

$component_options = get_option('bswp_site_settings');
$component_options = $component_options['settings']['components'];

// add components
// components are determined by the $available_components_toggles array
// see available-components.php
// settings are adding in components.php

$components = array();
if(!empty($component_options)){

    foreach($component_options as $component=>$active){

        if($active !== 'yes')
        continue;

        $name = str_replace('activate_','', $component);
        include_once('components/'.$name.'.php');
        $components[$name] = $$name;
    }
}



$section_name = basename(__FILE__, '.php');
$section_name = str_replace('section--','',$section_name);

// background and border colors
$background_and_borders = new SettingsGroup('background_and_borders');
$background_and_borders->add_tab('background_colors', $background_colors);
$background_and_borders->add_tab('wallpaper', $background_wallpaper);

$background_and_borders->add_tab('borders', $component_borders);
$background_and_borders->add_tab('border-radius', $radii_fields);



// text and headings settings
$text = new SettingsGroup('text');
$text->add_tab('text', $regular_text);
$text->add_tab('headings', $headings_normal);
$text->add_tab('headings_link', $headings_link);
$text->add_tab('headings_link_hovered', $headings_link_hovered);




// Link settings
$links = new SettingsGroup('links');
$links->add_tab('link', $link);
$links->add_tab('hovered_link', $hovered_link);
$links->add_tab('active_link', $active_link);

// settings and layout
$settings = new SettingsGroup('settings_and_layout');
$settings->add_tab('settings', $header_settings_tab );
$settings->add_tab('frontpage', $header_frontpage_settings);
$settings->add_tab('feed', $header_feed_settings);
$settings->add_tab('single', $header_single_settings);


// this array is mounted by the section object
// the Section object specifically looks for an array called "groups"
$groups = array(
    'background_and_borders' => $background_and_borders,
    'text' => $text,
    'links' => $links,
    'images' => $images,
    'forms' => $forms,
    'buttons' => $buttons,
    'tables' => $tables,
    'preformatted' => $preformatted,
    'quotes' => $quotes,
    'alerts' => $alerts,
    'settings_and_layout' => $settings
);


$groups = array_slice($groups, 0, 7, true) +
    $components +
    array_slice($groups, 7, count($groups) - 1, true);
