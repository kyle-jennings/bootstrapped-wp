<?php
$buttons = $this->values['buttons'];
$buttons_bg = $buttons['background_colors'];
$buttons_borders = $buttons['borders'];
$buttons_text = $buttons['text'];

?>
// Buttons
// -------------------------
$btnBackground:                     <?php echo _tern($buttons_bg['background_start_color_rgba'], '$white'); ?>;
$btnBackgroundHighlight:            <?php echo _tern($buttons_bg['background_end_color_rgba'], 'darken($btnBackground, 10%)'); ?>;
$btnBorder:                        $grayLighterDark;
$btnText:                           <?php echo _tern($buttons_text['text_color'], '$grayDark'); ?>;
<?php
    $btn_defaults = array('color'=> '$grayLighterDark', 'style'=>'solid', 'width'=>'1px' );
    _component_outer_border_sass_vars('btn', $buttons_borders, $btn_defaults);
    _component_border_radius_sass_vars('btn', $buttons_borders, '4px');

?>

$btnPrimaryBackground:              $linkColor ;
$btnPrimaryBackgroundHighlight:     adjust-hue($btnPrimaryBackground, 20%) ;

$btnInfoBackground:                 #5bc0de ;
$btnInfoBackgroundHighlight:        #2f96b4 ;

$btnSuccessBackground:              #62c462 ;
$btnSuccessBackgroundHighlight:     #51a351 ;

$btnWarningBackground:              lighten($orange, 15%) ;
$btnWarningBackgroundHighlight:     $orange ;

$btnDangerBackground:               #ee5f5b ;
$btnDangerBackgroundHighlight:      #bd362f ;

$btnInverseBackground:              #444 ;
$btnInverseBackgroundHighlight:     $grayDarker ;
