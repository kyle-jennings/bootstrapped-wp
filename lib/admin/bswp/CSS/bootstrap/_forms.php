// Forms
// -------------------------
$inputBackground:               $white !default;
$inputBorder:                   #ccc !default;
$inputBorderRadius:             $baseBorderRadius !default;
$inputDisabledBackground:       $grayLighter !default;
$formActionsBackground:         #f5f5f5 !default;
$inputHeight:                   $baseLineHeight + 10px; // base line-height + 8px vertical padding + 2px top/bottom border

$formTextColor: <?php echo $form['text_color'] ? $form['text_color'] : '$textColor';  ?> !default;
<?php

    _component_background_colors_sass_vars('form', $form);
    _component_outer_border_sass_vars('form', $form);
    _component_border_radius_sass_vars('form', $form);

?>

$fieldTextColor: <?php echo $field['text_color'] ? $field['text_color'] : '$textColor';  ?> !default;
<?php

    _component_background_colors_sass_vars('field', $field);
    _component_outer_border_sass_vars('field', $field);
    _component_border_radius_sass_vars('field', $field);

?>


$fieldActiveTextColor: <?php echo $field_active['text_color'] ? $field_active['text_color'] : '$textColor';  ?> !default;
<?php

    _component_background_colors_sass_vars('fieldActive', $field_active);
    _component_outer_border_sass_vars('fieldActive', $field_active);
    _component_border_radius_sass_vars('fieldActive', $field_active);

?>