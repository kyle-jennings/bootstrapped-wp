<?php

// collapsibles
$collapsibles = $values['collapsibles'];
$collapsibles_header = $collapsibles['header'];
$collapsibles_background_colors = $collapsibles['background_colors'];
$collapsibles_text = $collapsibles['text'];
$collapsibles_borders = $collapsibles['borders'];


?>
// collapsibles
// -------------------------

//scaffolding
$collapsiblesColor: <?php echo _tern($collapsibles_text['text_color'], '$grayDark'); ?>;

// background colors
$collapsiblesBackgroundColor: <?php echo _tern($collapsibles_background_colors['background_start_color_rgba'], '$offWhite'); ?>;
$collapsiblesBackgroundEndColor: <?php echo _tern($collapsibles_background_colors['background_end_color_rgba'], 'transparent'); ?>;
$collapsiblesBackgroundFill: <?php echo _tern($collapsibles_background_colors['background_fill'], 'solid'); ?>;

// header
$collapsiblesHeaderBackgroundColor: <?php echo _tern($collapsibles_header['background_start_color_rgba'], '$collapsiblesBackgroundColor'); ?>;
$collapsiblesHeaderBackgroundEndColor: <?php echo _tern($collapsibles_header['background_end_color_rgba'], 'transparent'); ?>;
$collapsiblesHeaderBackgroundFill: <?php echo _tern($collapsibles_header['background_fill'], 'solid'); ?>;
$collapsiblesHeaderTextColor: <?php echo _tern($collapsibles_header['text_color'], '$collapsiblesColor'); ?>;




// bg wallpapers
$collapsiblesBackgroundWallpaper: <?php echo _tern($collapsibles_wallpapers['background_use_wallpaper'], 'no'); ?> ;

$collapsiblesBackgroundImage: "<?php echo _tern($collapsibles_wallpapers['background_image'], 'none'); ?>" ;
$collapsiblesBackgroundRepeat: <?php echo _tern($collapsibles_wallpapers['background_repeat'], 'no-repeat'); ?> ;
$collapsiblesBackgroundAttachment: <?php echo _tern($collapsibles_wallpapers['background_attachment'], 'scroll'); ?> ;

$collapsiblesBackgroundPosition: <?php echo _tern($collapsibles_wallpapers['background_position'], 'left top'); ?> ;
$collapsiblesBackgroundPositionX: <?php echo _tern($collapsibles_wallpapers['background_positionX'], '0'); ?> ;
$collapsiblesBackgroundPositionY: <?php echo _tern($collapsibles_wallpapers['background_positionY'], '0'); ?> ;

$collapsiblesBackgroundSize: <?php echo _tern($collapsibles_wallpapers['background_size'], 'auto'); ?> ;
$collapsiblesBackgroundPercentage: <?php echo _tern($collapsibles_wallpapers['background_percentage'], '0%'); ?> ;


<?php

    _component_outer_border_sass_vars('collapsibles', $collapsibles_borders);
    _component_border_radius_sass_vars('collapsibles', $collapsibles_borders);
    _component_links_sass_vars('collapsibles', $collapsibles_text, '$blue');

?>


// borders
$collapsiblesInnerBorderColor: <?php echo _tern($collapsibles_borders['inner_border_color'], '$grayLight'); ?>;
$collapsiblesInnerBorderStyle: <?php echo _tern($collapsibles_borders['inner_border_style'], 'solid'); ?>;
$collapsiblesInnerBorderWidth: <?php echo _tern($collapsibles_borders['inner_border_width'], '1px'); ?>;
