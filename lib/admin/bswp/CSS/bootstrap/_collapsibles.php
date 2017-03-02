
// collapsibles
// -------------------------

//scaffolding
$collapsiblesColor: <?php echo $collapsibles_text['text_color'] ? $collapsibles_text['text_color'] : '$textColor'; ?>;

// background colors
$collapsiblesBackgroundColor: <?php echo $collapsibles_background_colors['background_start_color_rgba'] ? $collapsibles_background_colors['background_start_color_rgba'] : '#f5f5f5'; ?>;
$collapsiblesBackgroundEndColor: <?php echo $collapsibles_background_colors['background_end_color_rgba'] ? $collapsibles_background_colors['background_end_color_rgba'] : 'transparent'; ?>;
$collapsiblesBackgroundFill: <?php echo $collapsibles_background_colors['background_fill'] ? $collapsibles_background_colors['background_fill'] : 'solid'; ?>;

// header
$collapsiblesHeaderBackgroundColor: <?php echo $collapsibles_header['background_start_color_rgba'] ? $collapsibles_header['background_start_color_rgba'] : '$collapsiblesBackgroundColor'; ?>;
$collapsiblesHeaderBackgroundEndColor: <?php echo $collapsibles_header['background_end_color_rgba'] ? $collapsibles_header['background_end_color_rgba'] : 'transparent'; ?>;
$collapsiblesHeaderBackgroundFill: <?php echo $collapsibles_header['background_fill'] ? $collapsibles_header['background_fill'] : 'solid'; ?>;
$collapsiblesHeaderTextColor: <?php echo $collapsibles_header['text_color'] ? $collapsibles_header['text_color'] : '$collapsiblesColor'; ?>;




// bg wallpapers
$collapsiblesBackgroundWallpaper: <?php echo $collapsibles_wallpapers['background_use_wallpaper'] ? $collapsibles_wallpapers['background_use_wallpaper'] : 'no'; ?> !default;

$collapsiblesBackgroundImage: "<?php echo $collapsibles_wallpapers['background_image'] ? $collapsibles_wallpapers['background_image'] : 'none'; ?>" !default;
$collapsiblesBackgroundRepeat: <?php echo $collapsibles_wallpapers['background_repeat'] ? $collapsibles_wallpapers['background_repeat'] : 'no-repeat'; ?> !default;
$collapsiblesBackgroundAttachment: <?php echo $collapsibles_wallpapers['background_attachment'] ? $collapsibles_wallpapers['background_attachment'] : 'scroll'; ?> !default;

$collapsiblesBackgroundPosition: <?php echo $collapsibles_wallpapers['background_position'] ? $collapsibles_wallpapers['background_position'] : 'left top'; ?> !default;
$collapsiblesBackgroundPositionX: <?php echo $collapsibles_wallpapers['background_positionX'] ? $collapsibles_wallpapers['background_positionX'] : '0'; ?> !default;
$collapsiblesBackgroundPositionY: <?php echo $collapsibles_wallpapers['background_positionY'] ? $collapsibles_wallpapers['background_positionY'] : '0'; ?> !default;

$collapsiblesBackgroundSize: <?php echo $collapsibles_wallpapers['background_size'] ? $collapsibles_wallpapers['background_size'] : 'auto'; ?> !default;
$collapsiblesBackgroundPercentage: <?php echo $collapsibles_wallpapers['background_percentage'] ? $collapsibles_wallpapers['background_percentage'] : '0%'; ?> !default;


<?php

    _component_outer_border_sass_vars('collapsibles', $collapsibles_borders);
    _component_border_radius_sass_vars('collapsibles', $collapsibles_borders);
    _component_links_sass_vars('collapsibles', $collapsibles_text);

?>


// borders
$collapsiblesInnerBorderColor: <?php echo $collapsibles_borders['inner_border_color'] ? $collapsibles_borders['inner_border_color'] : 'rgba(0, 0, 0, .6)'; ?>;
$collapsiblesInnerBorderStyle: <?php echo $collapsibles_borders['inner_border_style'] ? $collapsibles_borders['inner_border_style'] : 'solid'; ?>;
$collapsiblesInnerBorderWidth: <?php echo $collapsibles_borders['inner_border_width'] ? $collapsibles_borders['inner_border_width'] : '1px'; ?>;
