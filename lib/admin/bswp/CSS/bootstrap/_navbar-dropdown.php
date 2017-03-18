<?php
// navbar dropdow
$nav_submenu_bg = $navbar['submenu_background_colors'];
$nav_submenu_text = $navbar['submenu_text'];
$nav_submenu_border = $navbar['submenu_borders'];

?>

// -------------------------
// Navbar Dropdowns
// -------------------------

$navbarDropdownBackground:            <?php echo _tern($nav_submenu_bg['color'], '$white'); ?> !default;
$styleBorderSides: <?php echo _tern($nav_submenu_border['style_border_sides'], 'no'); ?>;
<?php
// $navbarDropdownTopBorderColor
// $navbarDropdownTopBorderStyle
// $navbarDropdownTopBorderWidth
_component_outer_border_sass_vars('navbarDropdown', $nav_submenu_border);
_component_border_radius_sass_vars('navbarDropdown', $nav_submenu_border);
?>



$navbarDropdownBorder:                $navbarDropdownTopBorderColor !default;
$navbarDropdownDividerTop:            #e5e5e5 !default;
$navbarDropdownDividerBottom:         $white !default;

// the links - too specific to use the helper
$navbarDropdownLinksColor: <?php echo _tern($nav_submenu_text['link_color'], '$grayDark'); ?> !default;
$navbarDropdownLinksBackgroundStyle: <?php echo _tern($nav_submenu_text['link_background_style'], 'none'); ?> !default;
$navbarDropdownLinksBackgroundColor: <?php echo _tern($nav_submenu_text['link_background_color_rgba'], '$white'); ?> !default;
$navbarDropdownLinksDecoration: <?php echo _tern($nav_submenu_text['link_text_decoration'], 'none'); ?> !default;
$navbarDropdownLinksTextShadow: <?php echo _tern($nav_submenu_text['link_text_shadow'], 'none'); ?> !default;



$navbarDropdownHoveredLinksColor: <?php echo _tern($nav_submenu_text['hovered_link_color'], '$white'); ?> !default;
$navbarDropdownHoveredLinksBackgroundStyle: <?php echo _tern($nav_submenu_text['hovered_link_background_style'], 'default'); ?> !default;
$navbarDropdownHoveredLinksBackgroundColor: <?php echo _tern($nav_submenu_text['hovered_link_background_color_rgba'], '$linkColor'); ?> !default;
$navbarDropdownHoveredLinksDecoration: <?php echo _tern($nav_submenu_text['hovered_link_text_decoration'], 'none'); ?> !default;
$navbarDropdownHoveredLinksTextShadow: <?php echo _tern($nav_submenu_text['hovered_link_text_shadow'], 'none'); ?> !default;



$navbarDropdownActiveLinksColor: <?php echo _tern($nav_submenu_text['active_link_color'], '$white'); ?> !default;
$navbarDropdownActiveLinksBackgroundStyle: <?php echo _tern($nav_submenu_text['active_link_background_style'], 'default'); ?> !default;
$navbarDropdownActiveLinksBackgroundColor: <?php echo _tern($nav_submenu_text['active_link_background_color_rgba'], '$linkColor'); ?> !default;
$navbarDropdownActiveLinksDecoration: <?php echo _tern($nav_submenu_text['active_link_text_decoration'], 'none'); ?> !default;
$navbarDropdownActiveLinksTextShadow: <?php echo _tern($nav_submenu_text['active_link_text_shadow'], 'none'); ?> !default;
