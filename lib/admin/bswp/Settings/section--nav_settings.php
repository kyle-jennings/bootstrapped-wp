<?php

namespace bswp\Settings;


include dirname(__FILE__).'/_helpers.php';
include dirname(__FILE__).'/background-colors.php';
include dirname(__FILE__).'/background-wallpaper.php';
include dirname(__FILE__).'/borders.php';
include dirname(__FILE__).'/border-radius.php';
include dirname(__FILE__).'/headings.php';
include dirname(__FILE__).'/text.php';
include dirname(__FILE__).'/section-layout.php';





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



// this array is mounted by the section object
$groups = array(
    'background' => $background,
    'borders' => $borders,
    'text' => $text,
    'misc' => $misc,
);
