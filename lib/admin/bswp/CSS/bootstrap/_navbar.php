// Navbar
// -------------------------



$navbarCollapseWidth:             979px !default;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

$navbarHeight:                    40px !default;
$navbarBackgroundStart:           <?php echo $navbg['background_start_color'] ? $navbg['background_start_color'] : '$bodyBackground'; ?> !default;
$navbarBackgroundEnd:             <?php echo $navbg['background_end_color'] ? $navbg['background_end_color'] : 'darken($navbarBackgroundHighlight, 5%)'; ?> !default;

$navbarBackgroundHighlight:       $navbarBackgroundStart !default;
$navbarBackground:                $navbarBackgroundEnd !default;

$navbarBorder:                    darken($navbarBackground, 12%) !default;
$navbarBorderStyle:               'solid';
$navbarBorderWidth:               '1px';

$navbarTopBorder:                      <?php echo $navbg['top_border_color'] ? $navbg['top_border_color'] : '$navbarBorder'; ?> !default;
$navbarTopBorderStyle:                 <?php echo $navbg['top_border_style'] ? $navbg['top_border_style'] : '$navbarBorderStyle'; ?> !default;
$navbarTopBorderWidth:                 <?php echo $navbg['top_border_width'] ? $navbg['top_border_width'] : '$navbarBorderWidth'; ?> !default;

$navbarRightBorder:                      <?php echo $navbg['right_border_color'] ? $navbg['right_border_color'] : '$navbarTopBorder'; ?> !default;
$navbarRightBorderStyle:                 <?php echo $navbg['right_border_style'] ? $navbg['right_border_style'] : '$navbarTopBorderStyle'; ?> !default;
$navbarRightBorderWidth:                 <?php echo $navbg['right_border_width'] ? $navbg['right_border_width'] : '$navbarTopBorderWidth'; ?> !default;

$navbarBottomBorder:                      <?php echo $navbg['bottom_border_color'] ? $navbg['bottom_border_color'] : '$navbarTopBorder'; ?> !default;
$navbarBottomBorderStyle:                 <?php echo $navbg['bottom_border_style'] ? $navbg['bottom_border_style'] : '$navbarTopBorderStyle'; ?> !default;
$navbarBottomBorderWidth:                 <?php echo $navbg['bottom_border_width'] ? $navbg['bottom_border_width'] : '$navbarTopBorderWidth'; ?> !default;

$navbarLeftBorder:                      <?php echo $navbg['left_border_color'] ? $navbg['left_border_color'] : '$navbarTopBorder'; ?> !default;
$navbarLeftBorderStyle:                 <?php echo $navbg['left_border_style'] ? $navbg['left_border_style'] : '$navbarTopBorderStyle'; ?> !default;
$navbarLeftBorderWidth:                 <?php echo $navbg['left_border_width'] ? $navbg['left_border_width'] : '$navbarTopBorderWidth'; ?> !default;
$navbarText:                      <?php echo $navtext['text_color'] ? $navtext['text_color'] : '$textColor'; ?> !default;
$navbarLinkColor:                 <?php echo $navtext['links_color'] ? $navtext['links_color'] : '$linkColor'; ?> !default;
$navbarLinkColorHover:            <?php echo $navtext['hovered_links_color'] ? $navtext['hovered_links_color'] : 'darken($navbarBackground, 5%)'; ?> !default;
$navbarLinkColorActive:           <?php echo $navtext['active_links_color'] ? $navtext['active_links_color'] : 'darken($navbarBackground, 5%)'; ?> !default;

$navbarLinkBackground:       <?php echo $navtext['links_background_color_rgba'] ? $navtext['links_background_color_rgba'] : 'transparent' ;?> !default;
$navbarLinkBackgroundHover:       <?php echo $navtext['hovered_links_background_color_rgba'] ? $navtext['hovered_links_background_color_rgba'] : 'transparent' ;?> !default;
$navbarLinkBackgroundActive:      <?php echo $navtext['active_links_background_color_rgba'] ? $navtext['active_links_background_color_rgba'] : 'darken($navbarBackground, 5%)' ;?> !default;

$navbarBrandColor:                $navbarLinkColor !default;
