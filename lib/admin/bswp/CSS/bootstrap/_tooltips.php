// Tooltips
// -------------------------
$tooltipColor:            <?php echo $tooltips_text ? $tooltips_text : '#fff'; ?> !default;
$tooltipBackgroundColor:       <?php echo $tooltips_bg['background_start_color_rgba'] ? $tooltips_bg['background_start_color_rgba'] : '#000'; ?> !default;
$tooltipBackgroundEndColor:       <?php echo $tooltips_bg['background_end_color_rgba'] ? $tooltips_bg['background_end_color_rgba'] : '#000'; ?> !default;
$tooltipBackgroundFill:       <?php echo $tooltips_bg['background_fill'] ? $tooltips_bg['background_fill'] : 'none'; ?> !default;

$tooltipArrowWidth:       5px !default;
$tooltipArrowColor:       $tooltipBackgroundColor !default;


<?php

    _component_outer_border_sass_vars('tooltip', $tooltips_borders);
    _component_border_radius_sass_vars('tooltip', $tooltips_borders);

?>
