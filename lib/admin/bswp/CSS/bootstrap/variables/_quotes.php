<?php
// Quotes
$quotes = $this->values['quotes'];
$quotes_background_colors = $quotes['background_colors'];
$quotes_text = $quotes['text'];
$quotes_borders = $quotes['borders'];

?>
// Quotes
// -------------------------

$quotesColor: <?php echo _tern($quotes_text['text_color'], '$grayDark'); ?>;
$quotesBackgroundColor: <?php echo _tern($quotes_background_colors['background_start_color_rgba'], '$offWhite'); ?>;
$quotesBackgroundEndColor: <?php echo _tern($quotes_background_colors['background_end_color_rgba'], 'transparent'); ?>;
$quotesBackgroundFill: <?php echo _tern($quotes_background_colors['background_fill'], 'solid'); ?>;

$quotesBackgroundWallpaper: <?php echo _tern($quotes_wallpapers['background_use_wallpaper'], 'no'); ?> ;

$quotesBackgroundImage: "<?php echo _tern($quotes_wallpapers['background_image'], 'none'); ?>" ;
$quotesBackgroundRepeat: <?php echo _tern($quotes_wallpapers['background_repeat'], 'no-repeat'); ?> ;
$quotesBackgroundAttachment: <?php echo _tern($quotes_wallpapers['background_attachment'], 'scroll'); ?> ;

$quotesBackgroundPosition: <?php echo _tern($quotes_wallpapers['background_position'], 'left top'); ?> ;
$quotesBackgroundPositionX: <?php echo _tern($quotes_wallpapers['background_positionX'], '0'); ?> ;
$quotesBackgroundPositionY: <?php echo _tern($quotes_wallpapers['background_positionY'], '0'); ?> ;

$quotesBackgroundSize: <?php echo _tern($quotes_wallpapers['background_size'], 'auto'); ?> ;
$quotesBackgroundPercentage: <?php echo _tern($quotes_wallpapers['background_percentage'], '0%'); ?> ;

$quotesBorder: $grayLighter;
<?php

    _component_outer_border_sass_vars('quotes', $quotes_borders);
    _component_border_radius_sass_vars('quotes', $quotes_borders);
    _component_links_sass_vars('quotes', $quotes_text);

?>
