<?php

// Tooltips
$tooltips = $this->values['tooltips'];

$tooltip_bg = $tooltips['background_colors'];
$tooltip_text = $tooltips['text']['text_color'];
$tooltip_borders = $tooltips['borders'];

?>

// Tooltips
// -------------------------
$tooltipColor:            <?php echo $tooltip_text ? $tooltip_text : '#fff'; ?> !default;
$tooltipBackgroundColor:       <?php echo $tooltip_bg['background_start_color_rgba'] ? $tooltip_bg['background_start_color_rgba'] : '#000'; ?> !default;
$tooltipBackgroundEndColor:       <?php echo $tooltip_bg['background_end_color_rgba'] ? $tooltip_bg['background_end_color_rgba'] : '#000'; ?> !default;
$tooltipBackgroundFill:       <?php echo $tooltip_bg['background_fill'] ? $tooltip_bg['background_fill'] : 'none'; ?> !default;

$tooltipArrowWidth:       5px !default;
$tooltipArrowColor:       $tooltipBackgroundColor !default;


<?php

    _component_outer_border_sass_vars('tooltip', $tooltip_borders);
    _component_border_radius_sass_vars('tooltip', $tooltip_borders);

?>
