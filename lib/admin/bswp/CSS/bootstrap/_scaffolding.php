
// Scaffolding
// -------------------------
$bodyBackground:        <?php echo $background['colors']['background_start_color'] ? $background['colors']['background_start_color'] : '$white'; ?> !default;
$bodyBackgroundEnd:        <?php echo $background['colors']['background_end_color'] ? $background['colors']['background_end_color'] : '$bodyBackground'; ?> !default;
$backgroundFill: <?php echo $background['colors']['background_fill'] ? $background['colors']['background_fill'] : 'none'; ?> !default;


$useBackgroundWallpaper: <?php echo $background_wallpapers['background_use_wallpaper'] ? $background_wallpapers['background_use_wallpaper'] : 'no'; ?> !default;

$backgroundImage: "<?php echo $background_wallpapers['background_image'] ? $background_wallpapers['background_image'] : 'none'; ?>" !default;
$backgroundRepeat: <?php echo $background_wallpapers['background_repeat'] ? $background_wallpapers['background_repeat'] : 'no-repeat'; ?> !default;
$backgroundAttachment: <?php echo $background_wallpapers['background_attachment'] ? $background_wallpapers['background_attachment'] : 'scroll'; ?> !default;

$backgroundPosition: <?php echo $background_wallpapers['background_position'] ? $background_wallpapers['background_position'] : 'left top'; ?> !default;
$backgroundPositionX: <?php echo $background_wallpapers['background_positionX'] ? $background_wallpapers['background_positionX'] : '0'; ?> !default;
$backgroundPositionY: <?php echo $background_wallpapers['background_positionY'] ? $background_wallpapers['background_positionY'] : '0'; ?> !default;

$backgroundSize: <?php echo $background_wallpapers['background_size'] ? $background_wallpapers['background_size'] : 'auto'; ?> !default;
$backgroundPercentage: <?php echo $background_wallpapers['background_percentage'] ? $background_wallpapers['background_percentage'] : '0%'; ?> !default;


// text
$textColor:             <?php echo $text_color ? $text_color : '$grayDark'; ?> !default;
