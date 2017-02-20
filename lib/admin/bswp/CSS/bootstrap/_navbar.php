// Navbar
// -------------------------



$navbarCollapseWidth:             979px !default;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

$navbarHeight:                    40px !default;
$navbarBackgroundStart:           <?php echo $navbg['background_start_color'] ? $navbg['background_start_color'] : '$bodyBackground'; ?> !default;
$navbarBackgroundEnd:             <?php echo $navbg['background_end_color'] ? $navbg['background_end_color'] : 'darken($navbarBackgroundHighlight, 5%)'; ?> !default;

$navbarBackgroundHighlight:       $navbarBackgroundStart !default;
$navbarBackground:                $navbarBackgroundEnd !default;

$navbarText:                      <?php echo $navtext['text_color'] ? $navtext['text_color'] : '$textColor'; ?> !default;
$navbarLinkColor:                 <?php echo $navtext['links_color'] ? $navtext['links_color'] : '$linkColor'; ?> !default;
$navbarLinkColorHover:            <?php echo $navtext['hovered_links_color'] ? $navtext['hovered_links_color'] : 'darken($navbarBackground, 5%)'; ?> !default;
$navbarLinkColorActive:           <?php echo $navtext['active_links_color'] ? $navtext['active_links_color'] : 'darken($navbarBackground, 5%)'; ?> !default;

$navbarLinkBackground:       <?php echo $navtext['links_background_color_rgba'] ? $navtext['links_background_color_rgba'] : 'transparent' ;?> !default;
$navbarLinkBackgroundHover:       <?php echo $navtext['hovered_links_background_color_rgba'] ? $navtext['hovered_links_background_color_rgba'] : 'transparent' ;?> !default;
$navbarLinkBackgroundActive:      <?php echo $navtext['active_links_background_color_rgba'] ? $navtext['active_links_background_color_rgba'] : 'darken($navbarBackground, 5%)' ;?> !default;

$navbarBrandColor:                $navbarLinkColor !default;


$navbarBorder:                    darken($navbarBackground, 12%) !default;
$navbarBorderStyle:               'solid';
$navbarBorderWidth:               '1px';


<?php

    _component_outer_border_sass_vars('nav', $navborders);
    _component_border_radius_sass_vars('nav', $navborders);

?>
