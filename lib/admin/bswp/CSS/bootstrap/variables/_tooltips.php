<?php

// Tooltips
$tooltips = $values['tooltips'];

$tooltip_bg = $tooltips['background_colors'];
$tooltip_text = $tooltips['text']['text_color'];
$tooltip_borders = $tooltips['borders'];

?>

// Tooltips
// -------------------------
$tooltipColor:            <?php echo _tern($tooltip_text, '$white'); ?> ;
$tooltipBackgroundColor:       <?php echo _tern($tooltip_bg['background_start_color_rgba'], '$black'); ?> ;
$tooltipBackgroundEndColor:       <?php echo _tern($tooltip_bg['background_end_color_rgba'], '$black'); ?> ;
$tooltipBackgroundFill:       <?php echo _tern($tooltip_bg['background_fill'], 'none'); ?> ;

$tooltipArrowWidth:       5px ;
$tooltipArrowColor:       $tooltipBackgroundColor ;


<?php

    _component_outer_border_sass_vars('tooltip', $tooltip_borders);
    _component_border_radius_sass_vars('tooltip', $tooltip_borders);

?>
