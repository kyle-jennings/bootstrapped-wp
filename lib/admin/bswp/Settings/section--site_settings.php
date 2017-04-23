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
include dirname(__FILE__).'/components/sidebars.php';
include dirname(__FILE__).'/components/frontpage-layout.php';
include dirname(__FILE__).'/components/header.php';
include dirname(__FILE__).'/components/navbar.php';
include dirname(__FILE__).'/components/preformatted.php';
include dirname(__FILE__).'/components/quotes.php';
include dirname(__FILE__).'/components/tables.php';
include dirname(__FILE__).'/components/images.php';
include dirname(__FILE__).'/components/forms.php';
include dirname(__FILE__).'/components/buttons.php';
include dirname(__FILE__).'/components/alerts.php';

$site_settings_options = get_option('bswp_site_settings');
$component_options = $site_settings_options['settings']['components'];

$active_sections = $site_settings_options['settings']['sections'];

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
$background_and_borders->add_tab('body_background_colors', $background_colors);
$background_and_borders->add_tab('body_wallpaper', $background_wallpaper);

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



// Misc settings
$settings = new SettingsGroup('settings');
$settings->add_tab('layout', $section_layout);
$settings->add_tab('components', $available_components_toggles);
$settings->add_tab('sections', $available_sections);


// this array is mounted by the section object
// the Section object specifically looks for an array called "groups"
$groups = array(
    'background_and_borders' => $background_and_borders,
    'text' => $text,
    'links' => $links,
    'header' => $header,
    'navbar' => $navbar,
    'images' => $images,
    'forms' => $forms,
    'buttons' => $buttons,
    'tables' => $tables,
    'preformatted' => $preformatted,
    'quotes' => $quotes,
    'alerts' => $alerts,
    'layouts' => $layouts,
    'settings' => $settings,
);

if($active_sections['header'] == 'yes')
    unset($groups['header']);

// if($active_sections['navbar'] == 'yes')
    // unset($groups['navbar']);


$groups = array_slice($groups, 0, 7, true) +
    $components +
    array_slice($groups, 7, count($groups) - 1, true);
