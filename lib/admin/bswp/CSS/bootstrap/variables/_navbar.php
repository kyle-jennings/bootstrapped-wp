// Navbar
// -------------------------


$navbarCollapseWidth:             979px ;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

$navbarHeight:                    40px ;
$navbarBackgroundStart:           <?php echo _tern($navbg['background_start_color_rgba'], '$white'); ?> ;
$navbarBackgroundEnd:             <?php echo _tern($navbg['background_end_color_rgba'], 'darken($navbarBackgroundStart, 5%)'); ?> ;
$navbarBackgroundFill:            <?php echo _tern($navbg['background_fill'], 'solid'); ?> ;


$navbarBackgroundHighlight:       darken($navbarBackgroundStart, 5%);
$navbarBackground:                $navbarBackgroundStart;

$navbarText:                      <?php echo _tern($navtext['text_color'], '$greyMedium'); ?> ;

$navbarLinkColor:                <?php echo _tern($navlinks['link_color'], '$navbarText'); ?> ;
$navbarLinkBackgroundFill:       <?php echo _tern($navlinks['link_background_style'], 'none'); ?> ;
$navbarLinkBackgroundColor:       <?php echo _tern($navlinks['link_background_color_rgba'], '$transparent'); ?> ;

$navbarLinkColorHover:            <?php echo _tern($navlinks['hovered_link_color'], '$navbarLinkColor'); ?> ;
$navbarLinkBackgroundHoverFill:       <?php echo _tern($navlinks['hovered_link_background_style'], '$navbarLinkBackgroundFill'); ?> ;
$navbarLinkBackgroundHoverColor:       <?php echo _tern($navlinks['hovered_link_background_color_rgba'], '$navbarLinkBackgroundColor'); ?> ;
<?php
    // examine($navlinks);
?>
$navbarLinkColorActive:           <?php echo _tern($navlinks['active_link_color'], '$navbarLinkColorHover'); ?> ;
$navbarLinkBackgroundActiveFill:      <?php echo _tern($navlinks['active_link_background_style'], '$navbarLinkBackgroundHoverFill'); ?> ;
$navbarLinkBackgroundActiveColor:      <?php echo _tern($navlinks['active_link_background_color_rgba'], '$navbarLinkBackgroundHoverColor'); ?> ;


$navbarBorder:                    rgba(0,0,0,.2) ;
$navbarBorderStyle:               solid;
$navbarBorderWidth:               1px;

<?php

    _component_outer_border_sass_vars('nav', $navborders);
    _component_border_radius_sass_vars('nav', $navborder_radius, '0px');

?>

// settings
$navbarBrandColor:                $navbarLinkColor;

$navbarDisableBoxShadow:       <?php echo _tern($navsettings['box_shadow'], 'no'); ?> ;
$navbarAlign: <?php echo _tern($navsettings['align'], 'left');?>;

$navbarFloatSection: <?php echo _tern($navsettings['float_section'], 'no'); ?> ;
$navbarTopMargin: <?php echo _tern($navsettings['top_margin'], '0'); ?> ;
$navbarBottomMargin: <?php echo _tern($navsettings['bottom_margin'], '0'); ?> ;
