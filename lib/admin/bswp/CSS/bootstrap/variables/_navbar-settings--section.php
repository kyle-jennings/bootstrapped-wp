<?php
// navbar

$navsettings = $values['settings']['settings'];
error_log(json_encode($navsettings));

$navbg = $values['background_and_borders']['background_colors'];
$nav_wallpaper = $values['background_and_borders']['wallpaper'];
$navborders = $values['background_and_borders']['borders'];
$navborder_radius = $values['background_and_borders']['border-radius'];

$navtext = $values['text'];
$navlinks = $values['links']['link'] + $values['links']['hovered_link'] + $values['links']['active_link'];


$navbar = $values['submenu'];
