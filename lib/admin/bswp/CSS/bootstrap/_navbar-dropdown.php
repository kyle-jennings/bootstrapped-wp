// -------------------------
// Navbar Dropdowns
// -------------------------

$navbarDropdownBackground:            <?php echo _tern($nav_submenu_bg['color'], '$white'); ?> !default;


$navbarDropdownTopBorderColor:                <?php echo _tern( $nav_submenu_border['top_border_color'], 'rgba(0,0,0,.2)'); ?> !default;
$navbarDropdownTopBorderStyle:                <?php echo _tern( $nav_submenu_border['top_border_style'], 'solid'); ?> !default;
$navbarDropdownTopBorderWidth:                <?php echo _tern( $nav_submenu_border['top_border_width'], '1px'); ?> !default;

$navbarDropdownRightBorderColor:                <?php echo _tern( $nav_submenu_border['right_border_color'], 'rgba(0,0,0,.2)'); ?> !default;
$navbarDropdownRightBorderStyle:                <?php echo _tern( $nav_submenu_border['right_border_style'], 'solid'); ?> !default;
$navbarDropdownRightBorderWidth:                <?php echo _tern( $nav_submenu_border['right_border_width'], '1px'); ?> !default;

$navbarDropdownBottomBorderColor:                <?php echo _tern( $nav_submenu_border['bottom_border_color'], 'rgba(0,0,0,.2)'); ?> !default;
$navbarDropdownBottomBorderStyle:                <?php echo _tern( $nav_submenu_border['bottom_border_style'], 'solid'); ?> !default;
$navbarDropdownBottomBorderWidth:                <?php echo _tern( $nav_submenu_border['bottom_border_width'], '1px'); ?> !default;

$navbarDropdownLeftBorderColor:                <?php echo _tern( $nav_submenu_border['left_border_color'], 'rgba(0,0,0,.2)'); ?> !default;
$navbarDropdownLeftBorderStyle:                <?php echo _tern( $nav_submenu_border['left_border_style'], 'solid'); ?> !default;
$navbarDropdownLeftBorderWidth:                <?php echo _tern( $nav_submenu_border['left_border_width'], '1px'); ?> !default;


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
