
// popovers
// -------------------------


$popoverColor:            <?php echo $popover_content['text_color'] ? $popover_content['text_color'] : '#fff'; ?> !default;
$popoverBackgroundColor:       <?php echo $popover_content['background_start_color_rgba'] ? $popover_content['background_start_color_rgba'] : '#000'; ?> !default;
$popoverBackgroundEndColor:       <?php echo $popover_content['background_end_color_rgba'] ? $popover_content['background_end_color_rgba'] : '#000'; ?> !default;
$popoverBackgroundFill:       <?php echo $popover_content['background_fill'] ? $popover_content['background_fill'] : 'none'; ?> !default;

$popoverTitleColor:            <?php echo $popover_title['text_color'] ? $popover_title['text_color'] : '#fff'; ?> !default;

$popoverTitleBackgroundColor:       <?php echo $popover_title['background_start_color_rgba'] ? $popover_title['background_start_color_rgba'] : '#000'; ?> !default;
$popoverTitleBackgroundEndColor:       <?php echo $popover_title['background_end_color_rgba'] ? $popover_title['background_end_color_rgba'] : '#000'; ?> !default;
$popoverTitleBackgroundFill:       <?php echo $popover_title['background_fill'] ? $popover_title['background_fill'] : 'none'; ?> !default;

$popoverTitleBottomBorderStyle:    <?php echo $popover_title['title_bottom_border_style'] ? $popover_title['title_bottom_border_style'] : 'none' ?>;
$popoverTitleBottomBorderColor:    <?php echo $popover_title['title_bottom_border_color'] ? $popover_title['title_bottom_border_color'] : 'transparent' ?>;
$popoverTitleBottomBorderWidth:    <?php echo $popover_title['title_bottom_border_width'] ? $popover_title['title_bottom_border_width'] : '1px' ?>;


<?php

    _component_outer_border_sass_vars('popover', $popover_borders);
    _component_border_radius_sass_vars('popover', $popover_borders);
?>




// arrows
$popoverArrowWidth:       5px !default;
$popoverArrowColor:       $popoverBorderColor !default;

// Special enhancement for popovers
$popoverArrowOuterWidth:  $popoverArrowWidth + 1 !default;
$popoverArrowOuterColor:  rgba($popoverArrowColor, .25) !default;
