
// Wellsss
// -------------------------

$wellColor: <?php echo $well_text['text_color'] ? $well_text['text_color'] : '$textColor'; ?>;
$wellBackgroundColor: <?php echo $well_background_colors['background_start_color_rgba'] ? $well_background_colors['background_start_color_rgba'] : '#f5f5f5'; ?>;
$wellBackgroundEndColor: <?php echo $well_background_colors['background_end_color_rgba'] ? $well_background_colors['background_end_color_rgba'] : 'transparent'; ?>;
$wellBackgroundFill: <?php echo $well_background_colors['background_fill'] ? $well_background_colors['background_fill'] : 'solid'; ?>;

$wellBackgroundWallpaper: <?php echo $well_wallpapers['background_use_wallpaper'] ? $well_wallpapers['background_use_wallpaper'] : 'no'; ?> !default;

$wellBackgroundImage: "<?php echo $well_wallpapers['background_image'] ? $well_wallpapers['background_image'] : 'none'; ?>" !default;
$wellBackgroundRepeat: <?php echo $well_wallpapers['background_repeat'] ? $well_wallpapers['background_repeat'] : 'no-repeat'; ?> !default;
$wellBackgroundAttachment: <?php echo $well_wallpapers['background_attachment'] ? $well_wallpapers['background_attachment'] : 'scroll'; ?> !default;

$wellBackgroundPosition: <?php echo $well_wallpapers['background_position'] ? $well_wallpapers['background_position'] : 'left top'; ?> !default;
$wellBackgroundPositionX: <?php echo $well_wallpapers['background_positionX'] ? $well_wallpapers['background_positionX'] : '0'; ?> !default;
$wellBackgroundPositionY: <?php echo $well_wallpapers['background_positionY'] ? $well_wallpapers['background_positionY'] : '0'; ?> !default;

$wellBackgroundSize: <?php echo $well_wallpapers['background_size'] ? $well_wallpapers['background_size'] : 'auto'; ?> !default;
$wellBackgroundPercentage: <?php echo $well_wallpapers['background_percentage'] ? $well_wallpapers['background_percentage'] : '0%'; ?> !default;


<?php

    _component_outer_border_sass_vars('well', $well_borders);
    _component_border_radius_sass_vars('well', $well_borders);
    _component_links_sass_vars('well', $well_text);

?>
