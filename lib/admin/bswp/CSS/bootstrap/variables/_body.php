<?php

$body_background_colors = $background_and_borders['body_background_colors'];
$body_background_wallpaper = $background_and_borders['body_wallpaper'];

?>
// Body Background
// -------------------------
$bodyBackground:        <?php echo _tern($body_background_colors['background_start_color_rgba'], 'white'); ?>;
$bodyBackgroundEnd:        <?php echo _tern($body_background_colors['background_end_color_rgba'], '$bodyBackground'); ?>;
$bodyBackgroundFill: <?php echo _tern($body_background_colors['background_fill'], 'solid'); ?>;


$bodyUseBackgroundWallpaper: <?php echo _tern($body_background_wallpaper['background_use_wallpaper'], 'no'); ?>;

$bodyBackgroundImage: <?php echo '"'._tern($body_background_wallpaper['background_image'].'"', 'none'); ?>;
$bodyBackgroundRepeat: <?php echo _tern($body_background_wallpaper['background_repeat'], 'no-repeat'); ?>;
$bodyBackgroundAttachment: <?php echo _tern($body_background_wallpaper['background_attachment'], 'scroll'); ?>;

$bodyBackgroundPosition: <?php echo _tern($body_background_wallpaper['background_position'], 'left top'); ?>;
$bodyBackgroundPositionX: <?php echo _tern($body_background_wallpaper['background_positionX'], '0'); ?>;
$bodyBackgroundPositionY: <?php echo _tern($body_background_wallpaper['background_positionY'], '0'); ?>;

$bodyBackgroundSize: <?php echo _tern($body_background_wallpaper['background_size'], 'auto'); ?>;
$bodyBackgroundPercentage: <?php echo _tern($body_background_wallpaper['background_percentage'], '0%'); ?>;

$bodyBackgroundOverlay: <?php echo _tern($body_background_wallpaper['overlay_color_rgba'], 'transparent'); ?>;
