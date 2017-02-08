<?php

namespace bswp\settings;


include dirname(__FILE__).'/_helpers.php';
include dirname(__FILE__).'/background-color.php';
include dirname(__FILE__).'/background-wallpaper.php';
include dirname(__FILE__).'/borders.php';
include dirname(__FILE__).'/border-radius.php';
include dirname(__FILE__).'/headings.php';
include dirname(__FILE__).'/text.php';
include dirname(__FILE__).'/section-layout.php';
include dirname(__FILE__).'/available-sections.php';
include dirname(__FILE__).'/site-settings.php';



// Background settings
$background = new SettingsGroup('background');
$background->tabs['colors'] = $background_colors;
$background->tabs['wallpapers'] = $background_wallpaper;

// Borders Settings
$borders = new SettingsGroup('borders');
$borders->tabs['top'] = $top;
$borders->tabs['right'] = $right;
$borders->tabs['bottom'] = $bottom;
$borders->tabs['left'] = $left;
$borders->tabs['border-radius'] = $radii_fields;


// headings settings
$headings = new SettingsGroup('headings');
$headings->tabs['h1'] = $h1;
$headings->tabs['h2'] = $h2;
$headings->tabs['h3'] = $h3;
$headings->tabs['h4'] = $h4;
$headings->tabs['h5'] = $h5;
$headings->tabs['h6'] = $h6;


// Text settings
$text = new SettingsGroup('text');
$text->tabs['text'] = $regular_text;
$text->tabs['links'] = $links;
$text->tabs['visted-link'] = $visited_links;
$text->tabs['hovered-links'] = $hovered_links;
$text->tabs['active-links'] = $active_links;


// Misc settings
$misc = new SettingsGroup('misc');
$misc->tabs['layout'] = $section_layout;
$misc->tabs['sections'] = $available_sections_toggles;
$misc->tabs['misc'] = $site_settings;



// this array is mounted by the section object
$groups = array(
    'background' => $background,
    'borders' => $borders,
    'headings' => $headings,
    'text' => $text,
    'misc' => $misc,
    'available_sections' => $available_sections,
);
