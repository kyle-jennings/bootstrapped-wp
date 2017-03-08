// Navbar
// -------------------------



$navbarCollapseWidth:             979px !default;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

$navbarHeight:                    40px !default;
$navbarBackgroundStart:           <?php echo $navbg['background_start_color_rgba'] ? $navbg['background_start_color_rgba'] : '$bodyBackground'; ?> !default;
$navbarBackgroundEnd:             <?php echo $navbg['background_end_color_rgba'] ? $navbg['background_end_color_rgba'] : '$navbarBackgroundStart'; ?> !default;

$navbarBackgroundHighlight:       $navbarBackgroundStart !default;
$navbarBackground:                $navbarBackgroundEnd !default;

$navbarText:                      <?php echo $navtext['text_color'] ? $navtext['text_color'] : '#777'; ?> !default;
$navbarLinkColor:                  <?php echo $navtext['links_color'] ? $navtext['links_color'] : '$navbarText'; ?> !default;
$navbarLinkBackgroundFill:       <?php echo $navtext['links_background_style'] ? $navtext['links_background_style'] : 'none' ;?> !default;
$navbarLinkBackgroundColor:       <?php echo $navtext['links_background_color_rgba'] ? $navtext['links_background_color_rgba'] : 'transparent' ;?> !default;

$navbarLinkColorHover:            <?php echo $navtext['hovered_links_color'] ? $navtext['hovered_links_color'] : '$grayDark'; ?> !default;
$navbarLinkBackgroundHoverFill:       <?php echo $navtext['hovered_links_background_style'] ? $navtext['hovered_links_background_style'] : 'transparent' ;?> !default;
$navbarLinkBackgroundHoverColor:       <?php echo $navtext['hovered_links_background_color_rgba'] ? $navtext['hovered_links_background_color_rgba'] : 'transparent' ;?> !default;

$navbarLinkColorActive:           <?php echo $navtext['active_links_color'] ? $navtext['active_links_color'] : '$navbarLinkColorHover'; ?> !default;
$navbarLinkBackgroundActiveFill:      <?php echo $navtext['active_links_background_style'] ? $navtext['active_links_background_style'] : '$navbarLinkBackgroundHoverFill' ;?> !default;
$navbarLinkBackgroundActiveColor:      <?php echo $navtext['active_links_background_color_rgba'] ? $navtext['active_links_background_color_rgba'] : '$navbarLinkBackgroundHoverColor' ;?> !default;


$navbarBrandColor:                $navbarLinkColor !default;

$navbarDisableBoxShadow:       <?php echo $navsettings['box_shadow'] ? $navsettings['box_shadow'] : 'no'; ?> !default;

$navbarBorder:                    rgba(0,0,0,.2) !default;
$navbarBorderStyle:               solid;
$navbarBorderWidth:               1px;


<?php
    $defaults = array('$navbarBorder', '$navbarBorderStyle', '$navbarBorderWidth');
    _component_outer_border_sass_vars('nav', $navborders, $defaults);
    _component_border_radius_sass_vars('nav', $navborders);

?>
