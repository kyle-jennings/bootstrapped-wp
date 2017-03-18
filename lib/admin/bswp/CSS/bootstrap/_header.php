// header
//////////////////////
<?php

// header
$header = $this->values['header'];
$header_bgcolors = $header['background_colors'];
$header_wallpaper = $header['background_wallpaper'];
$header_text = $header['text'];
$header_links = $header['links'];
$header_borders = $header['borders'];
$header_settings = $header['settings'];
$header_frontpage = $header['front_page'];
$header_feed = $header['feed_page'];
$header_single = $header['single_page'];


?>

// base settings
$headingAlignment: <?php echo _tern($header_settings['title_alignment'], 'center'); ?>;


// the background colors
$headerBackgroundStartColor:           <?php echo _tern($header_bgcolors['background_start_color_rgba'], '$bodyBackground'); ?> !default;
$headerBackgroundEndColor:             <?php echo _tern($header_bgcolors['background_end_color_rgba'], '$headerBackgroundStartColor'); ?> !default;
$headerBackgroundFill: <?php echo _tern($header_bgcolors['background_fill'], 'solid'); ?> !default;

// background wallpaper
$headerUseBackgroundWallpaper: <?php echo _tern($header_wallpaper['background_use_wallpaper'], 'no'); ?> !default;

$headerBackgroundImage: "<?php echo _tern($header_wallpaper['background_image'], 'none'); ?>" !default;
$headerBackgroundRepeat: <?php echo _tern($header_wallpaper['background_repeat'], 'no-repeat'); ?> !default;
$headerBackgroundAttachment: <?php echo _tern($header_wallpaper['background_attachment'], 'scroll'); ?> !default;

$headerBackgroundPosition: <?php echo _tern($header_wallpaper['background_position'], 'left top'); ?> !default;
$headerBackgroundPositionX: <?php echo _tern($header_wallpaper['background_positionX'], '0'); ?> !default;
$headerBackgroundPositionY: <?php echo _tern($header_wallpaper['background_positionY'], '0'); ?> !default;

$headerBackgroundSize: <?php echo _tern($header_wallpaper['background_size'], 'auto'); ?> !default;
$headerBackgroundPercentage: <?php echo _tern($header_wallpaper['background_percentage'], '0%'); ?> !default;

$headerBackgroundOverlay: <?php echo _tern($header_wallpaper['overlay_color_rgba'], 'transparent'); ?> !default;;


// Text and Headings
$headerText:                      <?php echo _tern($header_text['text_color'], '$headingsColor'); ?> !default;

// fullheight
$headerHeight: <?php echo ($header_settings['height'] == 'fullpage') ? '100vh' : 'auto' ; ?> !default;

// container and title sizes
<?php
    switch($header_settings['height']):
        case 'small':
            $header_padding = '20px 0';
            break;
        case 'medium':
            $header_padding = '40px 0';
            break;
        case 'large':
            $header_padding = '60px 0';
            break;
        case 'custom':
            $header_padding = isset($header_settings['header_padding']) ? $header_settings['header_padding'].'px 0' : '0';
            break;
        default:
            $header_padding = '20px 0';
            break;
    endswitch;

?>
$headerPadding:  <?php echo $header_padding; ?> !default;


<?php
    switch($header_settings['title_size']):
        case 'small':
            $header_title_size = '39px';
            break;
        case 'medium':
            $header_title_size = '52px';
            break;
        case 'large':
            $header_title_size = '72px';
            break;
        default:
            $header_title_size = '39px';
            break;
    endswitch;

?>
// Text and Headings
$headerTitleSize:       <?php echo $header_title_size; ?> !default;


<?php

    _component_outer_border_sass_vars('header', $header_borders);
    _component_border_radius_sass_vars('header', $header_borders);
    _component_links_sass_vars('header', $header_links);

?>


$headerHeadingsColor:         <?php echo _tern( $header_text['headings_normal_color'],'$headerText'); ?> !default;
$headerHeadingsTextDecoration: <?php echo _tern( $header_text['headings_normal_text_decoration'], 'none'); ?> !default;
$headerHeadingsTextShadow: <?php echo _tern( $header_text['headings_normal_text_shadow_rgba'], 'rgba(0,0,0,0)'); ?> !default;

$headerHeadingsLinkColor:         <?php echo _tern( $header_text['headings_link_color'],'$headerText'); ?> !default;
$headerHeadingsLinkTextDecoration: <?php echo _tern( $header_text['headings_link_text_decoration'], 'none'); ?> !default;
$headerHeadingsLinkTextShadow: <?php echo _tern( $header_text['headings_link_text_shadow_rgba'], 'rgba(0,0,0,0)'); ?> !default;

$headerHeadingsLinkHoveredColor:         <?php echo _tern( $header_text['headings_link_hovered_color'],'$headerText'); ?> !default;
$headerHeadingsLinkHoveredTextDecoration: <?php echo _tern( $header_text['headings_link_hovered_text_decoration'], 'none'); ?> !default;
$headerHeadingsLinkHoveredTextShadow: <?php echo _tern( $header_text['headings_link_hovered_text_shadow_rgba'], 'rgba(0,0,0,0)'); ?> !default;

// front page settings
$frontpageAlignment: <?php echo $header_frontpage['title_alignment'] ? $header_frontpage['title_alignment'] : 'center' ?>;


// feed page settings
$feedAlignment: <?php echo $header_feed['title_alignment'] ? $header_feed['title_alignment'] : 'center' ?>;

// single page settings
$singleAlignment: <?php echo $header_single['title_alignment'] ? $header_single['title_alignment'] : 'center' ?>;
