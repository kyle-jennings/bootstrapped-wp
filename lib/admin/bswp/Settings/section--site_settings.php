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
include dirname(__FILE__).'/field-sets/section-layout.php';
include dirname(__FILE__).'/field-sets/site-settings.php';
include dirname(__FILE__).'/field-sets/text.php';

// component settings
include dirname(__FILE__).'/field-sets/component-borders.php';

include dirname(__FILE__).'/components/header.php';


include dirname(__FILE__).'/components/navbar.php';
include dirname(__FILE__).'/components/preformatted.php';
include dirname(__FILE__).'/components/quotes.php';
include dirname(__FILE__).'/components/tables.php';
include dirname(__FILE__).'/components/images.php';
include dirname(__FILE__).'/components/forms.php';

$component_options = get_option('bswp_site_settings');
$component_options = $component_options['available_components']['components'];

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

// Background settings
$background = new SettingsGroup('background');
$background->add_tab('colors', $background_colors);
$background->add_tab('wallpapers', $background_wallpaper);


// Borders Settings
$borders = new SettingsGroup('borders');

$borders->add_tab('all_sides', $all_sides);
$borders->add_tab('top', $top);
$borders->add_tab('right', $right);
$borders->add_tab('bottom', $bottom);
$borders->add_tab('left', $left);
$borders->add_tab('border-radius', $radii_fields);



// text and headings settings
$text = new SettingsGroup('text');
$text->add_tab('text', $regular_text);
$text->add_tab('headings', $headings_normal);
$text->add_tab('headings_links', $headings_links);
$text->add_tab('headings_links_hovered', $headings_links_hovered);




// Link settings
$links = new SettingsGroup('links');
$links->add_tab('link', $link);
$links->add_tab('hovered_link', $hovered_link);
$links->add_tab('active_link', $active_link);
$links->add_tab('visited_link', $visited_link);







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
    'text' => $text,
    'links' => $links,
    'header' => $header,
    'navbar' => $navbar,
    'images' => $images,
    'forms' => $forms,
    'tables' => $tables,
    'preformatted' => $preformatted,
    'quotes' => $quotes,
    'misc' => $misc,
    'available_components' => $available_components,
    // 'available_sections' => $available_sections,
);


$groups = array_slice($groups, 0, 7, true) +
    $components +
    array_slice($groups, 7, count($groups) - 1, true);
