<?php

// popovers
$popovers = $this->values['popovers'];
$popover_content = $popovers['content_colors'];
$popover_title = $popovers['title_colors'];
$popover_borders = $popovers['borders'];
?>

// popovers
// -------------------------


$popoverColor:            <?php echo _tern($popover_content['text_color'], '$white'); ?> !default;
$popoverBackgroundColor:       <?php echo _tern($popover_content['background_start_color_rgba'], '$black'); ?> !default;
$popoverBackgroundEndColor:       <?php echo _tern($popover_content['background_end_color_rgba'], '$popoverBackgroundColor'); ?> !default;
$popoverBackgroundFill:       <?php echo _tern($popover_content['background_fill'], 'none'); ?> !default;

$popoverTitleColor:            <?php echo _tern($popover_title['text_color'], '$white'); ?> !default;

$popoverTitleBackgroundColor:       <?php echo _tern($popover_title['background_start_color_rgba'], '$popoverBackgroundColor'); ?> !default;
$popoverTitleBackgroundEndColor:       <?php echo _tern($popover_title['background_end_color_rgba'], '$popoverTitleBackgroundColor'); ?> !default;
$popoverTitleBackgroundFill:       <?php echo _tern($popover_title['background_fill'], 'none'); ?> !default;

$popoverTitleBottomBorderStyle:    <?php echo _tern($popover_title['title_bottom_border_style'], 'none') ?>;
$popoverTitleBottomBorderColor:    <?php echo _tern($popover_title['title_bottom_border_color'], 'transparent') ?>;
$popoverTitleBottomBorderWidth:    <?php echo _tern($popover_title['title_bottom_border_width'], '1px') ?>;


<?php

    _component_outer_border_sass_vars('popover', $popover_borders);
    _component_border_radius_sass_vars('popover', $popover_borders);
?>




// arrows
$popoverArrowWidth:       5px !default;
$popoverArrowColor:       $popoverBackgroundColor !default;

// Special enhancement for popovers
$popoverArrowOuterWidth:  $popoverArrowWidth + 1 !default;
$popoverArrowOuterColor:  rgba($popoverArrowColor, .25) !default;
