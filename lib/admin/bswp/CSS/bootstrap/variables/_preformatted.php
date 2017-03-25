<?php
// Preformatted and Code text
$pre = $this->values['preformatted'];
$pre_background_colors = $pre['background_colors'];
$pre_text = $pre['text'];
$pre_borders = $pre['borders'];

?>
// Preformatted and Code
// -------------------------

$preColor: <?php echo _tern($pre_text['text_color'], '$grayDark'); ?>;
$preBackgroundColor: <?php echo _tern($pre_background_colors['background_start_color_rgba'], '$offWhite'); ?>;
$preBackgroundEndColor: <?php echo _tern($pre_background_colors['background_end_color_rgba'], 'transparent'); ?>;
$preBackgroundFill: <?php echo _tern($pre_background_colors['background_fill'], 'solid'); ?>;


$preBackgroundWallpaper: <?php echo _tern($pre_wallpapers['background_use_wallpaper'], 'no'); ?> ;

$preBackgroundImage: "<?php echo _tern($pre_wallpapers['background_image'], 'none'); ?>" ;
$preBackgroundRepeat: <?php echo _tern($pre_wallpapers['background_repeat'], 'no-repeat'); ?> ;
$preBackgroundAttachment: <?php echo _tern($pre_wallpapers['background_attachment'], 'scroll'); ?> ;

$preBackgroundPosition: <?php echo _tern($pre_wallpapers['background_position'], 'left top'); ?> ;
$preBackgroundPositionX: <?php echo _tern($pre_wallpapers['background_positionX'], '0'); ?> ;
$preBackgroundPositionY: <?php echo _tern($pre_wallpapers['background_positionY'], '0'); ?> ;

$preBackgroundSize: <?php echo _tern($pre_wallpapers['background_size'], 'auto'); ?> ;
$preBackgroundPercentage: <?php echo _tern($pre_wallpapers['background_percentage'], '0%'); ?> ;


<?php

    _component_outer_border_sass_vars('pre', $pre_borders);
    _component_border_radius_sass_vars('pre', $pre_borders);
    _component_links_sass_vars('pre', $pre_text);

?>
