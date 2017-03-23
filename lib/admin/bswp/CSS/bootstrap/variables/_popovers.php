<?php

// popovers
$popovers = $this->values['popovers'];
$popover_content = $popovers['content_colors'];
$popover_title = $popovers['title_colors'];
$popover_borders = $popovers['borders'];
?>

// popovers
// -------------------------


$popoverColor:            <?php echo _tern($popover_content['text_color'], '$white'); ?> ;
$popoverBackgroundColor:       <?php echo _tern($popover_content['background_start_color_rgba'], '$black'); ?> ;
$popoverBackgroundEndColor:       <?php echo _tern($popover_content['background_end_color_rgba'], '$popoverBackgroundColor'); ?> ;
$popoverBackgroundFill:       <?php echo _tern($popover_content['background_fill'], 'none'); ?> ;

$popoverTitleColor:            <?php echo _tern($popover_title['text_color'], '$white'); ?> ;

$popoverTitleBackgroundColor:       <?php echo _tern($popover_title['background_start_color_rgba'], '$popoverBackgroundColor'); ?> ;
$popoverTitleBackgroundEndColor:       <?php echo _tern($popover_title['background_end_color_rgba'], '$popoverTitleBackgroundColor'); ?> ;
$popoverTitleBackgroundFill:       <?php echo _tern($popover_title['background_fill'], 'none'); ?> ;

$popoverTitleBottomBorderStyle:    <?php echo _tern($popover_title['title_bottom_border_style'], 'none') ?>;
$popoverTitleBottomBorderColor:    <?php echo _tern($popover_title['title_bottom_border_color'], 'transparent') ?>;
$popoverTitleBottomBorderWidth:    <?php echo _tern($popover_title['title_bottom_border_width'], '1px') ?>;


<?php

    _component_outer_border_sass_vars('popover', $popover_borders);
    _component_border_radius_sass_vars('popover', $popover_borders);
?>




// arrows
$popoverArrowWidth:       5px ;
$popoverArrowColor:       $popoverBackgroundColor ;

// Special enhancement for popovers
$popoverArrowOuterWidth:  $popoverArrowWidth + 1 ;
$popoverArrowOuterColor:  rgba($popoverArrowColor, .25) ;
