<?php

namespace bswp\settings;

include dirname(__FILE__).'/_helpers.php';
include dirname(__FILE__).'/background-colors.php';
include dirname(__FILE__).'/background-wallpaper.php';
include dirname(__FILE__).'/borders.php';
include dirname(__FILE__).'/border-radius.php';
include dirname(__FILE__).'/headings.php';
include dirname(__FILE__).'/text.php';
include dirname(__FILE__).'/section-layout.php';
include dirname(__FILE__).'/site-settings.php';
include dirname(__FILE__).'/available-sections.php';
include dirname(__FILE__).'/available-components.php';

$section_name = basename(__FILE__, '.php');
$section_name = str_replace('section--','',$section_name);

// Background settings
$background = new SettingsGroup('background');
$background->add_tab('colors', $background_colors);
$background->add_tab('wallpapers', $background_wallpaper);


// Borders Settings
$borders = new SettingsGroup('borders');
$borders->add_tab('top', $top);
$borders->add_tab('right', $right);
$borders->add_tab('bottom', $bottom);
$borders->add_tab('left', $left);
$borders->add_tab('border-radius', $radii_fields);



// headings settings
$headings = new SettingsGroup('headings');
$headings->add_tab('h1', $h1);
$headings->add_tab('h2', $h2);
$headings->add_tab('h3', $h3);
$headings->add_tab('h4', $h4);
$headings->add_tab('h5', $h5);
$headings->add_tab('h6', $h6);



// Text settings
$text = new SettingsGroup('text');
$text->add_tab('text', $regular_text);
$text->add_tab('links', $links);
$text->add_tab('visted-link', $visited_links);
$text->add_tab('hovered-links', $hovered_links);
$text->add_tab('active-links', $active_links);




// add components
// components are determined by the $available_components_toggles array
// see available-components.php
// settings are adding in components.php
include dirname(__FILE__).'/components.php';

foreach($options as $component=>$active){
    if($active !== 'yes')
        continue;

    $name = str_replace('activate_','', $component);
    $components[$name] = $$name;
}
//


// Misc settings
$misc = new SettingsGroup('misc');
$misc->add_tab('layout', $section_layout);
$misc->add_tab('misc', $site_settings);


// activate  components
$available_components = new SettingsGroup('available_components');
$available_components->add_tab('components', $available_components_toggles);



// activate sections
$available_sections = new SettingsGroup('available_sections');
$available_sections->add_tab('sections', $available_sections_toggles);




// this array is mounted by the section object
// the Section object specifically looks for an array called "groups"
$groups = array(
    'background' => $background,
    'borders' => $borders,
    'headings' => $headings,
    'text' => $text,
    'misc' => $misc,
    'available_sections' => $available_sections,
    'available_components' => $available_components,
);


// $groups = array_merge($groups, $components);

$groups = array_slice($groups, 0, 4, true) +
    $components +
    array_slice($groups, 4, count($groups) - 1, true);
