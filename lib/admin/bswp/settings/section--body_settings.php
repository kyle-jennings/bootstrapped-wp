<?php

namespace bswp\settings;


$background = new SettingsGroup('background');
$borders = new SettingsGroup('borders');
$headings = new SettingsGroup('headings');
$text = new SettingsGroup('text');


// Background settings
include dirname(__FILE__).'/background-color.php';
include dirname(__FILE__).'/background-wallpaper.php';
$background->tabs['colors'] = $background_colors;
$background->tabs['wallpapers'] = $background_wallpaper;


// Borders Settings
$borders->tabs['top'] = 'top';
$borders->tabs['right'] = 'right';
$borders->tabs['bottom'] = 'bottom';
$borders->tabs['left'] = 'left';
$borders->tabs['border-radius'] = 'border-radius';


// headings settings
$headings->tabs['h1'] = 'h1';
$headings->tabs['h2'] = 'h2';
$headings->tabs['h3'] = 'h3';
$headings->tabs['h4'] = 'h4';
$headings->tabs['h5'] = 'h5';
$headings->tabs['h6'] = 'h6';


// Text settings
$text->tabs['text'] = 'text';
$text->tabs['links'] = 'links';
$text->tabs['visted-link'] = 'visted-link';
$text->tabs['hovered-links'] = 'hovered-links';
$text->tabs['active-links'] = 'active-links';


$groups = array(
    'background' => $background,
    'borders' => $borders,
    'headings' => $headings,
    'text' => $text,
);
