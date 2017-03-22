<?php

?>
// Scaffolding
// -------------------------
$bodyBackground:        <?php echo _tern($body_background_colors['background_start_color_rgba'], '$white'); ?> !default;
$bodyBackgroundEnd:        <?php echo _tern($body_background_colors['background_end_color_rgba'], '$bodyBackground'); ?> !default;
$bodyBackgroundFill: <?php echo _tern($body_background_colors['background_fill'], 'solid'); ?> !default;


$bodyUseBackgroundWallpaper: <?php echo _tern($body_background_wallpaper['background_use_wallpaper'], 'no'); ?> !default;

$bodyBackgroundImage: "<?php echo _tern($body_background_wallpaper['background_image'], 'none'); ?>" !default;
$bodyBackgroundRepeat: <?php echo _tern($body_background_wallpaper['background_repeat'], 'no-repeat'); ?> !default;
$bodyBackgroundAttachment: <?php echo _tern($body_background_wallpaper['background_attachment'], 'scroll'); ?> !default;

$bodyBackgroundPosition: <?php echo _tern($body_background_wallpaper['background_position'], 'left top'); ?> !default;
$bodyBackgroundPositionX: <?php echo _tern($body_background_wallpaper['background_positionX'], '0'); ?> !default;
$bodyBackgroundPositionY: <?php echo _tern($body_background_wallpaper['background_positionY'], '0'); ?> !default;

$bodyBackgroundSize: <?php echo _tern($body_background_wallpaper['background_size'], 'auto'); ?> !default;
$bodyBackgroundPercentage: <?php echo _tern($body_background_wallpaper['background_percentage'], '0%'); ?> !default;

$bodyBackgroundOverlay: <?php echo _tern($body_background_wallpaper['overlay_color_rgba'], 'transparent'); ?> !default;
