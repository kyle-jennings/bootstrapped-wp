<?php
// tabs
$tabs = $this->values['tabs'];
$tabs_bg = $tabs['background_colors'];
$tabs_text = $tabs['text'];
$tabs_borders = $tabs['borders'];
$tabs_inactive_colors = $tabs['inactive_tab_colors'];

?>
// Tabs - Active
// -------------------------

//scaffolding
$tabsColor: <?php echo $tabs_text['text_color'] ? $tabs_text['text_color'] : '$textColor'; ?>;

// background colors
$tabsBackgroundColor: <?php echo $tabs_bg['background_start_color_rgba'] ? $tabs_bg['background_start_color_rgba'] : '#f5f5f5'; ?>;
$tabsBackgroundEndColor: <?php echo $tabs_bg['background_end_color_rgba'] ? $tabs_bg['background_end_color_rgba'] : 'transparent'; ?>;
$tabsBackgroundFill: <?php echo $tabs_bg['background_fill'] ? $tabs_bg['background_fill'] : 'solid'; ?>;

$tabsCorners: <?php echo $tabs_borders['style_corners'] ? $tabs_borders['style_corners'] : 'no' ?>;
$tabsBorders: <?php echo $tabs_borders['style_border_sides'] ? $tabs_borders['style_border_sides'] : 'no' ?>;

<?php

    _component_outer_border_sass_vars('tabs', $tabs_borders);
    _component_border_radius_sass_vars('tabs', $tabs_borders);
    _component_links_sass_vars('tabs', $tabs_text);

?>


// Tabs - Inactive
// -------------------------

// scaffolding
$tabsInActiveColor: <?php echo $tabs_inactive_colors['text_color'] ? $tabs_inactive_colors['text_color'] : '$textColor'; ?>;

// background colors
$tabsInActiveBackgroundColor: <?php echo $tabs_inactive_colors['background_start_color_rgba'] ? $tabs_inactive_colors['background_start_color_rgba'] : '#f5f5f5'; ?>;
$tabsInActiveBackgroundEndColor: <?php echo $tabs_inactive_colors['background_end_color_rgba'] ? $tabs_inactive_colors['background_end_color_rgba'] : 'transparent'; ?>;
$tabsInActiveBackgroundFill: <?php echo $tabs_inactive_colors['background_fill'] ? $tabs_inactive_colors['background_fill'] : 'solid'; ?>;

$tabInActiveCorners: <?php echo $tabs_inactive_colors['style_corners'] ? $tabs_inactive_colors['style_corners'] : 'no' ?>;
$tabInActiveBorders: <?php echo $tabs_inactive_colors['style_border_sides'] ? $tabs_inactive_colors['style_border_sides'] : 'no' ?>;


<?php

    _component_outer_border_sass_vars('tabsInActive', $tabs_inactive_colors);
    _component_border_radius_sass_vars('tabsInActive', $tabs_inactive_colors);

?>
