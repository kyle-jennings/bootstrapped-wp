<?php

?>
// Scaffolding
// -------------------------
$bodyBackground:        <?php echo _tern($background_colors['background_start_color_rgba'], '$white'); ?> !default;
$bodyBackgroundEnd:        <?php echo _tern($background_colors['background_end_color_rgba'], '$bodyBackground'); ?> !default;
$backgroundFill: <?php echo _tern($background_colors['background_fill'], 'solid'); ?> !default;


$useBackgroundWallpaper: <?php echo _tern($background_wallpaper['background_use_wallpaper'], 'no'); ?> !default;

$backgroundImage: "<?php echo _tern($background_wallpaper['background_image'], 'none'); ?>" !default;
$backgroundRepeat: <?php echo _tern($background_wallpaper['background_repeat'], 'no-repeat'); ?> !default;
$backgroundAttachment: <?php echo _tern($background_wallpaper['background_attachment'], 'scroll'); ?> !default;

$backgroundPosition: <?php echo _tern($background_wallpaper['background_position'], 'left top'); ?> !default;
$backgroundPositionX: <?php echo _tern($background_wallpaper['background_positionX'], '0'); ?> !default;
$backgroundPositionY: <?php echo _tern($background_wallpaper['background_positionY'], '0'); ?> !default;

$backgroundSize: <?php echo _tern($background_wallpaper['background_size'], 'auto'); ?> !default;
$backgroundPercentage: <?php echo _tern($background_wallpaper['background_percentage'], '0%'); ?> !default;

$backgroundOverlay: <?php echo _tern($background_wallpaper['overlay_color_rgba'], 'transparent'); ?> !default;




// float the section?
$section: body;
$floatSection: <?php echo _tern($layout['float_section'], 'no'); ?> !default;
$topMargin: <?php echo _tern($layout['top_margin'], '0'); ?> !default;
$bottomMargin: <?php echo _tern($layout['bottom_margin'], '0'); ?> !default;

<?php

_component_outer_border_sass_vars('', $borders);
_component_border_radius_sass_vars('', $border_radii);
