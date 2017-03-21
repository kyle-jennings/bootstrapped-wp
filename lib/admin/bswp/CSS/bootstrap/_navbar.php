<?php
// navbar
$navbar = $this->values['navbar'];
$navsettings = $navbar['settings'];
// if($navsettings['settings'] == 'basic'){

    $navbg = $navbar['background_colors'];
    $navtext = $navbar['text'];
    $navborders = $navbar['borders'];
// }


?>
// Navbar
// -------------------------



$navbarCollapseWidth:             979px !default;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

$navbarHeight:                    40px !default;
$navbarBackgroundStart:           <?php echo _tern($navbg['background_start_color_rgba'], '$bodyBackground'); ?> !default;
$navbarBackgroundEnd:             <?php echo _tern($navbg['background_end_color_rgba'], '$navbarBackgroundStart'); ?> !default;

$navbarBackgroundHighlight:       $navbarBackgroundStart !default;
$navbarBackground:                $navbarBackgroundEnd !default;

$navbarText:                      <?php echo _tern($navtext['text_color'], '#777'); ?> !default;
$navbarLinkColor:                  <?php echo _tern($navtext['link_color'], '$navbarText'); ?> !default;
$navbarLinkBackgroundFill:       <?php echo _tern($navtext['link_background_style'], 'none'); ?> !default;
$navbarLinkBackgroundColor:       <?php echo _tern($navtext['link_background_color_rgba'], 'rgba(0,0,0,0)'); ?> !default;

$navbarLinkColorHover:            <?php echo _tern($navtext['hovered_link_color'], '$grayDark'); ?> !default;
$navbarLinkBackgroundHoverFill:       <?php echo _tern($navtext['hovered_link_background_style'], '$navbarLinkBackgroundFill'); ?> !default;
$navbarLinkBackgroundHoverColor:       <?php echo _tern($navtext['hovered_link_background_color_rgba'], '$navbarLinkBackgroundColor'); ?> !default;

$navbarLinkColorActive:           <?php echo _tern($navtext['active_link_color'], '$navbarLinkColorHover'); ?> !default;
$navbarLinkBackgroundActiveFill:      <?php echo _tern($navtext['active_link_background_style'], '$navbarLinkBackgroundHoverFill'); ?> !default;
$navbarLinkBackgroundActiveColor:      <?php echo _tern($navtext['active_link_background_color_rgba'], '$navbarLinkBackgroundHoverColor'); ?> !default;


$navbarBrandColor:                $navbarLinkColor !default;

$navbarDisableBoxShadow:       <?php echo _tern($navsettings['box_shadow'], 'no'); ?> !default;

$navbarBorder:                    rgba(0,0,0,.2) !default;
$navbarBorderStyle:               solid;
$navbarBorderWidth:               1px;


<?php
    $defaults = array('$navbarBorder', '$navbarBorderStyle', '$navbarBorderWidth');
    _component_outer_border_sass_vars('nav', $navborders, $defaults);
    _component_border_radius_sass_vars('nav', $navborders);

?>


// float the section?

$navbarFloatSection: <?php echo _tern($navsettings['float_section'], 'no'); ?> !default;
$navbarTopMargin: <?php echo _tern($navsettings['top_margin'], '0'); ?> !default;
$navbarBottomMargin: <?php echo _tern($navsettings['bottom_margin'], '0'); ?> !default;
