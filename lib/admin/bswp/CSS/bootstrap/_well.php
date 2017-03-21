<?php
// Wells
$well = $this->values['well'];
$well_background_colors = $well['background_colors'];
$well_text = $well['text'];
$well_borders = $well['borders'];
?>
// Wells
// -------------------------

$wellColor: <?php echo _tern($well_text['text_color'], '$grayDark'); ?>;
$wellBackgroundColor: <?php echo _tern($well_background_colors['background_start_color_rgba'], '$offWhite'); ?>;
$wellBackgroundEndColor: <?php echo _tern($well_background_colors['background_end_color_rgba'], 'transparent'); ?>;
$wellBackgroundFill: <?php echo _tern($well_background_colors['background_fill'], 'solid'); ?>;

$wellBackgroundWallpaper: <?php echo _tern($well_wallpapers['background_use_wallpaper'], 'no'); ?> !default;

$wellBackgroundImage: "<?php echo _tern($well_wallpapers['background_image'], 'none'); ?>" !default;
$wellBackgroundRepeat: <?php echo _tern($well_wallpapers['background_repeat'], 'no-repeat'); ?> !default;
$wellBackgroundAttachment: <?php echo _tern($well_wallpapers['background_attachment'], 'scroll'); ?> !default;

$wellBackgroundPosition: <?php echo _tern($well_wallpapers['background_position'], 'left top'); ?> !default;
$wellBackgroundPositionX: <?php echo _tern($well_wallpapers['background_positionX'], '0'); ?> !default;
$wellBackgroundPositionY: <?php echo _tern($well_wallpapers['background_positionY'], '0'); ?> !default;

$wellBackgroundSize: <?php echo _tern($well_wallpapers['background_size'], 'auto'); ?> !default;
$wellBackgroundPercentage: <?php echo _tern($well_wallpapers['background_percentage'], '0%'); ?> !default;


<?php

    _component_outer_border_sass_vars('well', $well_borders);
    _component_border_radius_sass_vars('well', $well_borders);
    _component_links_sass_vars('well', $well_text);

?>
