<?php
// navbar
$navbar = $values['navbar'];
$navsettings = $navbar['settings'];

// if($navsettings['settings'] == 'basic'){

    $navbg = $navbar['background_colors'];
    $navtext = $navbar['text'];
    $navborders = $navbar['borders'];
// }


?>
// Navbar
// -------------------------



$navbarCollapseWidth:             979px ;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

$navbarHeight:                    40px ;
$navbarBackgroundStart:           <?php echo _tern($navbg['background_start_color_rgba'], '$white'); ?> ;
$navbarBackgroundEnd:             <?php echo _tern($navbg['background_end_color_rgba'], 'darken($navbarBackgroundStart, 5%)'); ?> ;

$navbarBackgroundHighlight:       $navbarBackgroundStart ;
$navbarBackground:                $navbarBackgroundEnd ;

$navbarText:                      <?php echo _tern($navtext['text_color'], '$greyMedium'); ?> ;

$navbarLinkColor:                  <?php echo _tern($navtext['link_color'], '$navbarText'); ?> ;
$navbarLinkBackgroundFill:       <?php echo _tern($navtext['link_background_style'], 'none'); ?> ;
$navbarLinkBackgroundColor:       <?php echo _tern($navtext['link_background_color_rgba'], '$transparent'); ?> ;

$navbarLinkColorHover:            <?php echo _tern($navtext['hovered_link_color'], '$grayDark'); ?> ;
$navbarLinkBackgroundHoverFill:       <?php echo _tern($navtext['hovered_link_background_style'], 'highlight'); ?> ;
$navbarLinkBackgroundHoverColor:       <?php echo _tern($navtext['hovered_link_background_color_rgba'], '$grayLighter'); ?> ;

$navbarLinkColorActive:           <?php echo _tern($navtext['active_link_color'], '$navbarLinkColorHover'); ?> ;
$navbarLinkBackgroundActiveFill:      <?php echo _tern($navtext['active_link_background_style'], '$navbarLinkBackgroundHoverFill'); ?> ;
$navbarLinkBackgroundActiveColor:      <?php echo _tern($navtext['active_link_background_color_rgba'], '$navbarLinkBackgroundHoverColor'); ?> ;


$navbarBrandColor:                $navbarLinkColor ;

$navbarDisableBoxShadow:       <?php echo _tern($navsettings['box_shadow'], 'no'); ?> ;

$navbarBorder:                    rgba(0,0,0,.2) ;
$navbarBorderStyle:               solid;
$navbarBorderWidth:               1px;

$navbarAlign: <?php echo _tern($navsettings['align'], 'left');?>;
<?php

    _component_outer_border_sass_vars('nav', $navborders);
    _component_border_radius_sass_vars('nav', $navborders, '0px');

?>


// float the section?

$navbarFloatSection: <?php echo _tern($navsettings['float_section'], 'no'); ?> ;
$navbarTopMargin: <?php echo _tern($navsettings['top_margin'], '0'); ?> ;
$navbarBottomMargin: <?php echo _tern($navsettings['bottom_margin'], '0'); ?> ;
