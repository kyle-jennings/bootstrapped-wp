<?php
$buttons = $values['buttons'];
$default = $buttons['default_settings'];
$btn_borders = array(
    'all_sides_border_style' => $default['all_sides_border_style'],
    'all_sides_border_color' => $default['all_sides_border_color'],
    'all_sides_border_width' => $default['all_sides_border_width'],
    'style_border_sides' => $default['style_border_sides'],
    'top_border_style' => $default['top_border_style'],
    'top_border_color' => $default['top_border_color'],
    'top_border_width' => $default['top_border_width'],
    'right_border_style' => $default['right_border_style'],
    'right_border_color' => $default['right_border_color'],
    'right_border_width' => $default['right_border_width'],
    'bottom_border_style' => $default['bottom_border_style'],
    'bottom_border_color' => $default['bottom_border_color'],
    'bottom_border_width' => $default['bottom_border_width'],
    'left_border_style' => $default['left_border_style'],
    'left_border_color' => $default['left_border_color'],
    'left_border_width' => $default['left_border_width'],
    'all_corners' => $default['all_corners'],
    'style_corners' => $default['style_corners'],
    'top_left' => $default['top_left'],
    'top_right' => $default['top_right'],
    'bottom_right' => $default['bottom_right'],
    'bottom_left' => $default['bottom_left'],
);
$primary = $buttons['primary'];
$info = $buttons['info'];
$success = $buttons['success'];
$warning = $buttons['warning'];
$danger = $buttons['danger'];

?>
// Buttons
// -------------------------
$btnBackgroundColor:                     <?php echo _tern($default['background_start_color_rgba'], '$white'); ?>;
$btnBackground: $btnBackgroundColor;
$btnBackgroundEndColor:            <?php echo _tern($default['background_end_color_rgba'], 'darken($btnBackground, 10%)'); ?>;
$btnBackgroundHighlight: $btnBackgroundEndColor;

$btnBackgroundFill: <?php echo _tern($default['background_fill'], 'solid'); ?>;
$btnBorder:                        $grayLighterDark;
$btnText:                           <?php echo _tern($default['text_color'], '$grayDark'); ?>;


<?php
    $btn_defaults = array('color'=> '$grayLighterDark', 'style'=>'solid', 'width'=>'1px' );
    _component_outer_border_sass_vars('btn', $btn_borders, $btn_defaults);
    _component_border_radius_sass_vars('btn', $btn_borders, '4px');

?>

$btnPrimaryText:              <?php echo _tern($primary['text'], '$white'); ?>;
$btnPrimaryBorderColor:              <?php echo _tern($primary['border_color'], 'rgba(0, 0, 0, 0.1)'); ?>;
$btnPrimaryBorderColorHover:              <?php echo _tern($primary['border_color_hover'], 'rgba(0, 0, 0, 0.3)'); ?>;
$btnPrimaryBackgroundColor:              <?php echo _tern($primary['background_start_color_rgba'],'$linkColor'); ?>;
$btnPrimaryBackground: $btnPrimaryBackgroundColor;
$btnPrimaryBackgroundEndColor:     <?php echo _tern($primary['background_end_color_rgba'],'adjust-hue($btnPrimaryBackground, 20%)'); ?>;;

$btnInfoText:            <?php echo _tern($info['text'], '$white'); ?>;
$btnInfoBorderColor:              <?php echo _tern($info['border_color'], 'rgba(0, 0, 0, 0.1)'); ?>;
$btnInfoBorderColorHover:              <?php echo _tern($info['border_color_hover'], 'rgba(0, 0, 0, 0.3)'); ?>;
$btnInfoBackgroundColor:                 <?php echo _tern($info['background_start_color_rgba'],'#5bc0de'); ?>;
$btnInfoBackgroundEndColor:        <?php echo _tern($info['background_end_color_rgba'],'#2f96b4'); ?> ;

$btnSuccessText:              <?php echo _tern($success['text'], '$white'); ?>;
$btnSuccessBorderColor:              <?php echo _tern($success['border_color'], 'rgba(0, 0, 0, 0.1)'); ?>;
$btnSuccessBorderColorHover:              <?php echo _tern($success['border_color_hover'], 'rgba(0, 0, 0, 0.3)'); ?>;
$btnSuccessBackgroundColor:              <?php echo _tern($success['background_start_color_rgba'],'#62c462'); ?>;
$btnSuccessBackgroundEndColor:     <?php echo _tern($success['background_end_color_rgba'],'#51a351'); ?>;

$btnWarningText:              <?php echo _tern($warning['text'], '$white'); ?>;
$btnWarningBorderColor:              <?php echo _tern($warning['border_color'], 'rgba(0, 0, 0, 0.1)'); ?>;
$btnWarningBorderColorHover:              <?php echo _tern($warning['border_color_hover'], 'rgba(0, 0, 0, 0.3)'); ?>;
$btnWarningBackgroundColor:              <?php echo _tern($warning['background_start_color_rgba'],'lighten($orange, 15%)'); ?>;
$btnWarningBackgroundEndColor:     <?php echo _tern($warning['background_end_color_rgba'],'$orange'); ?>;

$btnDangerText:             <?php echo _tern($danger['text'], '$white'); ?>;
$btnDangerBorderColor:              <?php echo _tern($danger['border_color'], 'rgba(0, 0, 0, 0.1)'); ?>;
$btnDangerBorderColorHover:              <?php echo _tern($danger['border_color_hover'], 'rgba(0, 0, 0, 0.3)'); ?>;
$btnDangerBackgroundColor:               <?php echo _tern($danger['background_start_color_rgba'],'#ee5f5b'); ?>;
$btnDangerBackgroundEndColor:      <?php echo _tern($danger['background_end_color_rgba'],'#bd362f'); ?>;

$btnInverseBackgroundColor:              #444 ;
$btnInverseBackgroundEndColor:     $grayDarker ;
