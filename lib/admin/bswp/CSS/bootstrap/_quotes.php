<?php
// Quotes
$quotes = $this->values['quotes'];
$quotes_background_colors = $quotes['background_colors'];
$quotes_text = $quotes['text'];
$quotes_borders = $quotes['borders'];

?>
// Quotes
// -------------------------

$quotesColor: <?php echo $quotes_text['text_color'] ? $quotes_text['text_color'] : '$textColor'; ?>;
$quotesBackgroundColor: <?php echo $quotes_background_colors['background_start_color_rgba'] ? $quotes_background_colors['background_start_color_rgba'] : '#f5f5f5'; ?>;
$quotesBackgroundEndColor: <?php echo $quotes_background_colors['background_end_color_rgba'] ? $quotes_background_colors['background_end_color_rgba'] : 'transparent'; ?>;
$quotesBackgroundFill: <?php echo $quotes_background_colors['background_fill'] ? $quotes_background_colors['background_fill'] : 'solid'; ?>;

$quotesBackgroundWallpaper: <?php echo $quotes_wallpapers['background_use_wallpaper'] ? $quotes_wallpapers['background_use_wallpaper'] : 'no'; ?> !default;

$quotesBackgroundImage: "<?php echo $quotes_wallpapers['background_image'] ? $quotes_wallpapers['background_image'] : 'none'; ?>" !default;
$quotesBackgroundRepeat: <?php echo $quotes_wallpapers['background_repeat'] ? $quotes_wallpapers['background_repeat'] : 'no-repeat'; ?> !default;
$quotesBackgroundAttachment: <?php echo $quotes_wallpapers['background_attachment'] ? $quotes_wallpapers['background_attachment'] : 'scroll'; ?> !default;

$quotesBackgroundPosition: <?php echo $quotes_wallpapers['background_position'] ? $quotes_wallpapers['background_position'] : 'left top'; ?> !default;
$quotesBackgroundPositionX: <?php echo $quotes_wallpapers['background_positionX'] ? $quotes_wallpapers['background_positionX'] : '0'; ?> !default;
$quotesBackgroundPositionY: <?php echo $quotes_wallpapers['background_positionY'] ? $quotes_wallpapers['background_positionY'] : '0'; ?> !default;

$quotesBackgroundSize: <?php echo $quotes_wallpapers['background_size'] ? $quotes_wallpapers['background_size'] : 'auto'; ?> !default;
$quotesBackgroundPercentage: <?php echo $quotes_wallpapers['background_percentage'] ? $quotes_wallpapers['background_percentage'] : '0%'; ?> !default;

$quotesBorder: $grayLighter;
<?php

    _component_outer_border_sass_vars('quotes', $quotes_borders);
    _component_border_radius_sass_vars('quotes', $quotes_borders);
    _component_links_sass_vars('quotes', $quotes_text);

?>
