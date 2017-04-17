<?php
// background settings
$background_colors = $background_and_borders['background_colors'];
$background_wallpaper = $background_and_borders['wallpaper'];

// border settings
$borders = $background_and_borders['borders'];
$border_radii = $background_and_borders['border-radius'];
// examine($background_and_borders);
?>
// Scaffolding
// -------------------------
$background:        <?php echo _tern($background_colors['background_start_color_rgba'], '$white'); ?> ;
$backgroundEnd:        <?php echo _tern($background_colors['background_end_color_rgba'], '$background'); ?> ;
$backgroundFill: <?php echo _tern($background_colors['background_fill'], 'solid'); ?> ;


$useBackgroundWallpaper: <?php echo _tern($background_wallpaper['background_use_wallpaper'], 'no'); ?> ;

$backgroundImage: "<?php echo _tern($background_wallpaper['background_image'], 'none'); ?>" ;
$backgroundRepeat: <?php echo _tern($background_wallpaper['background_repeat'], 'no-repeat'); ?> ;
$backgroundAttachment: <?php echo _tern($background_wallpaper['background_attachment'], 'scroll'); ?> ;

$backgroundPosition: <?php echo _tern($background_wallpaper['background_position'], 'left top'); ?> ;
$backgroundPositionX: <?php echo _tern($background_wallpaper['background_positionX'], '0'); ?> ;
$backgroundPositionY: <?php echo _tern($background_wallpaper['background_positionY'], '0'); ?> ;

$backgroundSize: <?php echo _tern($background_wallpaper['background_size'], 'auto'); ?> ;
$backgroundPercentage: <?php echo _tern($background_wallpaper['background_percentage'], '0%'); ?> ;

$backgroundOverlay: <?php echo _tern($background_wallpaper['overlay_color_rgba'], 'transparent'); ?> ;




// float the section?

$floatSection: <?php echo _tern($layout['float_section'], 'no'); ?> ;
$topMargin: <?php echo _tern($layout['top_margin'], '0'); ?> ;
$bottomMargin: <?php echo _tern($layout['bottom_margin'], '0'); ?> ;

$outerGlow: <?php echo _tern($layout['outer_glow'], 'none'); ?>;
<?php

_component_outer_border_sass_vars('', $borders);
_component_border_radius_sass_vars('', $border_radii);
