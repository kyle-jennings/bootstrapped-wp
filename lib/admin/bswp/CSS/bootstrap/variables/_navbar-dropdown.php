<?php
// navbar dropdow
$nav_submenu_bg = $navbar['submenu_background_colors'];
$nav_submenu_text = $navbar['submenu_text'];
$nav_submenu_border = $navbar['submenu_borders'];

?>

// -------------------------
// Navbar Dropdowns
// -------------------------

$navbarDropdownBackground:            <?php echo _tern($nav_submenu_bg['color'], '$white'); ?> ;
$styleBorderSides: <?php echo _tern($nav_submenu_border['style_border_sides'], 'no'); ?>;
<?php
// $navbarDropdownTopBorderColor
// $navbarDropdownTopBorderStyle
// $navbarDropdownTopBorderWidth
_component_outer_border_sass_vars('navbarDropdown', $nav_submenu_border);
_component_border_radius_sass_vars('navbarDropdown', $nav_submenu_border);
?>



$navbarDropdownBorder:                $navbarDropdownTopBorderColor ;
$navbarDropdownDividerTop:            #e5e5e5 ;
$navbarDropdownDividerBottom:         $white ;

// the links - too specific to use the helper
$navbarDropdownLinksColor: <?php echo _tern($nav_submenu_text['link_color'], '$grayDark'); ?> ;
$navbarDropdownLinksBackgroundStyle: <?php echo _tern($nav_submenu_text['link_background_style'], 'none'); ?> ;
$navbarDropdownLinksBackgroundColor: <?php echo _tern($nav_submenu_text['link_background_color_rgba'], '$white'); ?> ;
$navbarDropdownLinksDecoration: <?php echo _tern($nav_submenu_text['link_text_decoration'], 'none'); ?> ;
$navbarDropdownLinksTextShadow: <?php echo _tern($nav_submenu_text['link_text_shadow'], 'none'); ?> ;



$navbarDropdownHoveredLinksColor: <?php echo _tern($nav_submenu_text['hovered_link_color'], '$white'); ?> ;
$navbarDropdownHoveredLinksBackgroundStyle: <?php echo _tern($nav_submenu_text['hovered_link_background_style'], 'default'); ?> ;
$navbarDropdownHoveredLinksBackgroundColor: <?php echo _tern($nav_submenu_text['hovered_link_background_color_rgba'], '$linkColor'); ?> ;
$navbarDropdownHoveredLinksDecoration: <?php echo _tern($nav_submenu_text['hovered_link_text_decoration'], 'none'); ?> ;
$navbarDropdownHoveredLinksTextShadow: <?php echo _tern($nav_submenu_text['hovered_link_text_shadow'], 'none'); ?> ;



$navbarDropdownActiveLinksColor: <?php echo _tern($nav_submenu_text['active_link_color'], '$white'); ?> ;
$navbarDropdownActiveLinksBackgroundStyle: <?php echo _tern($nav_submenu_text['active_link_background_style'], 'default'); ?> ;
$navbarDropdownActiveLinksBackgroundColor: <?php echo _tern($nav_submenu_text['active_link_background_color_rgba'], '$linkColor'); ?> ;
$navbarDropdownActiveLinksDecoration: <?php echo _tern($nav_submenu_text['active_link_text_decoration'], 'none'); ?> ;
$navbarDropdownActiveLinksTextShadow: <?php echo _tern($nav_submenu_text['active_link_text_shadow'], 'none'); ?> ;
