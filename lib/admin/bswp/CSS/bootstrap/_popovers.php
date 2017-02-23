
// popovers
// -------------------------


$popoverColor:            <?php echo $popovers_text ? $popovers_text : '#fff'; ?> !default;
$popoverBackgroundColor:       <?php echo $popovers_content['background_start_color_rgba'] ? $popovers_content['background_start_color_rgba'] : '#000'; ?> !default;
$popoverBackgroundEndColor:       <?php echo $popovers_content['background_end_color_rgba'] ? $popovers_content['background_end_color_rgba'] : '#000'; ?> !default;
$popoverBackgroundFill:       <?php echo $popovers_content['background_fill'] ? $popovers_content['background_fill'] : 'none'; ?> !default;

$popoverTitleColor:            <?php echo $popovers_title['text'] ? $popovers_title['text'] : '#fff'; ?> !default;

$popoverTitleBackgroundColor:       <?php echo $popovers_title['background_start_color_rgba'] ? $popovers_title['background_start_color_rgba'] : '#000'; ?> !default;
$popoverTitleBackgroundEndColor:       <?php echo $popovers_title['background_end_color_rgba'] ? $popovers_title['background_end_color_rgba'] : '#000'; ?> !default;
$popoverTitleBackgroundFill:       <?php echo $popovers_title['background_fill'] ? $popovers_title['background_fill'] : 'none'; ?> !default;

$popoverTitleBottomBorderStyle:    <?php echo $popovers_title['title_bottom_border_style'] ? $popovers_title['title_bottom_border_style'] : 'none' ?>;
$popoverTitleBottomBorderColor:    <?php echo $popovers_title['title_bottom_border_color'] ? $popovers_title['title_bottom_border_color'] : 'transparent' ?>;
$popoverTitleBottomBorderWidth:    <?php echo $popovers_title['title_bottom_border_width'] ? $popovers_title['title_bottom_border_width'] : '1px' ?>;


<?php

    _component_outer_border_sass_vars('popover', $popovers_borders);
    _component_border_radius_sass_vars('popover', $popovers_borders);
?>




// arrows
$popoverArrowWidth:       5px !default;
$popoverArrowColor:       $popoverBorderColor !default;

// Special enhancement for popovers
$popoverArrowOuterWidth:  $popoverArrowWidth + 1 !default;
$popoverArrowOuterColor:  rgba($popoverArrowColor, .25) !default;
