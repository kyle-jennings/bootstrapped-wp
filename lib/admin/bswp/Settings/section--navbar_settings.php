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
include dirname(__FILE__).'/components/navbar-settings.php';

include dirname(__FILE__).'/components/forms.php';
include dirname(__FILE__).'/components/buttons.php';


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

//submenu
$submenu = new SettingsGroup('submenu');
$submenu->add_tab('submenu_background_colors', $submenu_background_colors);
$submenu->add_tab('submenu_text', $submenu_text);
$submenu->add_tab('submenu_borders', $submenu_borders);


// settings
$settings = new SettingsGroup('settings');
$settings->add_tab('settings', $submenu_settings);


// this array is mounted by the section object
// the Section object specifically looks for an array called "groups"
$groups = array(
    'background_and_borders' => $background_and_borders,
    'text' => $text,
    'links' => $links,
    'forms' => $forms,
    'buttons' => $buttons,
    'submenu' => $submenu,
    'settings' => $settings,
);
