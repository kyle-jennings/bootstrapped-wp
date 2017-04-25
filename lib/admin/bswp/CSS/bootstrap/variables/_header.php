// header
//////////////////////
<?php

// header
$header = $values['header'];
$header_bgcolors = $header['background_colors'];
$header_wallpaper = $header['background_wallpaper'];
$header_text = $header['text'];
$header_links = $header['links'];
$header_borders = $header['borders'];
$header_settings = $header['settings'];
$header_frontpage = $header['frontpage'];
$header_feed = $header['feed'];
$header_single = $header['single'];


?>

// base settings
$headingAlignment: <?php echo _tern($header_settings['title_alignment'], 'left'); ?>;


// the background colors
$headerBackgroundStartColor:           <?php echo _tern($header_bgcolors['background_start_color_rgba'], '$transparent'); ?> ;
$headerBackgroundEndColor:             <?php echo _tern($header_bgcolors['background_end_color_rgba'], '$headerBackgroundStartColor'); ?> ;
$headerBackgroundFill: <?php echo _tern($header_bgcolors['background_fill'], 'solid'); ?> ;

// background wallpaper
$headerUseBackgroundWallpaper: <?php echo _tern($header_wallpaper['background_use_wallpaper'], 'no'); ?> ;

$headerBackgroundImage: "<?php echo _tern($header_wallpaper['background_image'], 'none'); ?>" ;
$headerBackgroundRepeat: <?php echo _tern($header_wallpaper['background_repeat'], 'no-repeat'); ?> ;
$headerBackgroundAttachment: <?php echo _tern($header_wallpaper['background_attachment'], 'scroll'); ?> ;

$headerBackgroundPosition: <?php echo _tern($header_wallpaper['background_position'], 'left top'); ?> ;
$headerBackgroundPositionX: <?php echo _tern($header_wallpaper['background_positionX'], '0'); ?> ;
$headerBackgroundPositionY: <?php echo _tern($header_wallpaper['background_positionY'], '0'); ?> ;

$headerBackgroundSize: <?php echo _tern($header_wallpaper['background_size'], 'auto'); ?> ;
$headerBackgroundPercentage: <?php echo _tern($header_wallpaper['background_percentage'], '0%'); ?> ;

$headerBackgroundOverlay: <?php echo _tern($header_wallpaper['overlay_color_rgba'], 'transparent'); ?> ;


// Text and Headings
$headerText:                      <?php echo _tern($header_text['text_color'], '$headingsColor'); ?> ;

// fullheight
$headerHeight: <?php echo ($header_settings['height'] == 'fullpage') ? '100vh' : 'auto' ; ?> ;

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
$headerPadding:  <?php echo $header_padding; ?> ;


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
$headerTitleSize:       <?php echo $header_title_size; ?> ;
<!-- $headerBorderRadius: 0; -->

<?php
    $default_borders = array('color'=>'$transGrayLight', 'style'=>'none', 'width'=>'1px');
    _component_outer_border_sass_vars('header', $header_borders, $default_borders);
    _component_border_radius_sass_vars('header', $header_borders, '0px');
    _component_links_sass_vars('header', $header_links);

?>


$headerHeadingsColor:         <?php echo _tern( $header_text['headings_normal_color'],'$headerText'); ?> ;
$headerHeadingsTextDecoration: <?php echo _tern( $header_text['headings_normal_text_decoration'], 'none'); ?> ;
$headerHeadingsTextShadow: <?php echo _tern( $header_text['headings_normal_text_shadow_rgba'], 'rgba(0,0,0,0)'); ?> ;

$headerHeadingsLinkColor:         <?php echo _tern( $header_text['headings_link_color'],'$headerText'); ?> ;
$headerHeadingsLinkTextDecoration: <?php echo _tern( $header_text['headings_link_text_decoration'], 'none'); ?> ;
$headerHeadingsLinkTextShadow: <?php echo _tern( $header_text['headings_link_text_shadow_rgba'], 'rgba(0,0,0,0)'); ?> ;

$headerHeadingsLinkHoveredColor:         <?php echo _tern( $header_text['headings_link_hovered_color'],'$headerText'); ?> ;
$headerHeadingsLinkHoveredTextDecoration: <?php echo _tern( $header_text['headings_link_hovered_text_decoration'], 'none'); ?> ;
$headerHeadingsLinkHoveredTextShadow: <?php echo _tern( $header_text['headings_link_hovered_text_shadow_rgba'], 'rgba(0,0,0,0)'); ?> ;

// front page settings
$frontpageAlignment: <?php echo $header_frontpage['title_alignment'] ? $header_frontpage['title_alignment'] : '$headingAlignment' ?>;


// feed page settings
$feedAlignment: <?php echo $header_feed['title_alignment'] ? $header_feed['title_alignment'] : '$headingAlignment' ?>;

// single page settings
$singleAlignment: <?php echo $header_single['title_alignment'] ? $header_single['title_alignment'] : '$headingAlignment' ?>;
