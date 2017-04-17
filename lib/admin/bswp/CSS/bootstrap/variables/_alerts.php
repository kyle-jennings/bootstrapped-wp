<?php
$alerts = $values['alerts'];
$alerts_bg = $alerts['background_colors'];
$alerts_borders = $alerts['borders'];
$alerts_text = $alerts['text'];
?>

// alerts
// -------------------------

$alertsBackgroundColor:                     <?php echo _tern($alerts_bg['background_start_color_rgba'], '$white'); ?>;
$alertsBackgroundHighlight:            <?php echo _tern($alerts_bg['background_end_color_rgba'], 'darken($alertsBackgroundColor, 10%)'); ?>;
$alertsBackgroundEndColor: <?php echo _tern($alerts_background_colors['background_end_color_rgba'], 'transparent'); ?>;
$alertsBackgroundFill: <?php echo _tern($alerts_background_colors['background_fill'], 'solid'); ?>;

$alertsBorder:                        $grayLighterDark;
$alertsText:                           <?php echo _tern($alerts_text['text_color'], '$white'); ?>;
<?php
    $alerts_defaults = array('color'=> '$grayLighterDark', 'style'=>'solid', 'width'=>'1px' );
    _component_outer_border_sass_vars('alerts', $alerts_borders, $alerts_defaults);
    _component_border_radius_sass_vars('alerts', $alerts_borders, '4px');
?>

$warningText:             #c09853 ;
$warningBackground:       #fcf8e3 ;
$warningBorder:           darken(adjust-hue($warningBackground, -10), 3%) ;

$errorText:               #b94a48 ;
$errorBackground:         #f2dede ;
$errorBorder:             darken(adjust-hue($errorBackground, -10), 3%) ;

$successText:             #468847 ;
$successBackground:       #dff0d8 ;
$successBorder:           darken(adjust-hue($successBackground, -10), 5%) ;

$infoText:                #3a87ad ;
$infoBackground:          #d9edf7 ;
$infoBorder:              darken(adjust-hue($infoBackground, -10), 7%) ;
