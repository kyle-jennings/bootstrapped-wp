// -------------------------
// Navbar Dropdowns
// -------------------------

$navbarDropdownBackground:            <?php echo $nav_submenu_bg['color'] ? $nav_submenu_bg['color'] : '$white'; ?> !default;


$navbarDropdownTopBorderColor:                <?php echo $nav_submenu_border['top_border_color'] ? $nav_submenu_border['top_border_color'] : 'rgba(0,0,0,.2)'; ?> !default;
$navbarDropdownTopBorderStyle:                <?php echo $nav_submenu_border['top_border_style'] ? $nav_submenu_border['top_border_style'] : 'solid'; ?> !default;
$navbarDropdownTopBorderWidth:                <?php echo $nav_submenu_border['top_border_width'] ? $nav_submenu_border['top_border_width'] : '1px'; ?> !default;

$navbarDropdownRightBorderColor:                <?php echo $nav_submenu_border['right_border_color'] ? $nav_submenu_border['right_border_color'] : 'rgba(0,0,0,.2)'; ?> !default;
$navbarDropdownRightBorderStyle:                <?php echo $nav_submenu_border['right_border_style'] ? $nav_submenu_border['right_border_style'] : 'solid'; ?> !default;
$navbarDropdownRightBorderWidth:                <?php echo $nav_submenu_border['right_border_width'] ? $nav_submenu_border['right_border_width'] : '1px'; ?> !default;

$navbarDropdownBottomBorderColor:                <?php echo $nav_submenu_border['bottom_border_color'] ? $nav_submenu_border['bottom_border_color'] : 'rgba(0,0,0,.2)'; ?> !default;
$navbarDropdownBottomBorderStyle:                <?php echo $nav_submenu_border['bottom_border_style'] ? $nav_submenu_border['bottom_border_style'] : 'solid'; ?> !default;
$navbarDropdownBottomBorderWidth:                <?php echo $nav_submenu_border['bottom_border_width'] ? $nav_submenu_border['bottom_border_width'] : '1px'; ?> !default;

$navbarDropdownLeftBorderColor:                <?php echo $nav_submenu_border['left_border_color'] ? $nav_submenu_border['left_border_color'] : 'rgba(0,0,0,.2)'; ?> !default;
$navbarDropdownLeftBorderStyle:                <?php echo $nav_submenu_border['left_border_style'] ? $nav_submenu_border['left_border_style'] : 'solid'; ?> !default;
$navbarDropdownLeftBorderWidth:                <?php echo $nav_submenu_border['left_border_width'] ? $nav_submenu_border['left_border_width'] : '1px'; ?> !default;


$navbarDropdownBorder:                $navbarDropdownTopBorderColor !default;

$navbarDropdownDividerTop:            #e5e5e5 !default;
$navbarDropdownDividerBottom:         $white !default;

$navbarDropdownLinkColor:             <?php echo $nav_submenu_text['links_color'] ? $nav_submenu_text['links_color'] : '$grayDark'; ?> !default;
$navbarDropdownLinkBackground:   <?php echo $nav_submenu_text['links_background_color_rgba'] ? $nav_submenu_text['links_background_color_rgba'] : 'transparent' ?> !default;

$navbarDropdownLinkColorHover:        <?php echo $nav_submenu_text['hovered_links_color'] ? $nav_submenu_text['hovered_links_color'] : '$white'; ?> !default;
$navbarDropdownLinkBackgroundHover:   <?php echo $nav_submenu_text['hovered_links_background_color_rgba'] ? $nav_submenu_text['hovered_links_background_color_rgba'] : 'darken($navbarDropdownBackground, 5%)' ?> !default;

$navbarDropdownLinkColorActive:       <?php echo $nav_submenu_text['active_links_color'] ? $nav_submenu_text['active_links_color'] : '$white'; ?> !default;
$navbarDropdownLinkBackgroundActive:  <?php echo $nav_submenu_text['active_links_background_color_rgba'] ? $nav_submenu_text['active_links_background_color_rgba'] : '$navbarDropdownLinkColor'; ?> !default;
