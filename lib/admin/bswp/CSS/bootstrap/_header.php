// header
//////////////////////
<?php

// $header = $this->values['header'];
// $header_bgcolors = $header['background_colors'];
// $header_wallpaper = $header['background_wallpaper'];
// $header_text = $header['text'];
// $header_links = $header['links'];
// $header_borders = $header['borders'];

?>

// base settings
$headingAlignment: <?php echo $header_settings['title_alignment'] ? $header_settings['title_alignment'] : 'center' ?>;


// the background colors
$headerBackgroundStartColor:           <?php echo $header_bgcolors['background_start_color_rgba'] ? $header_bgcolors['background_start_color_rgba'] : '$bodyBackground'; ?> !default;
$headerBackgroundEndColor:             <?php echo $header_bgcolors['background_end_color_rgba'] ? $header_bgcolors['background_end_color_rgba'] : '$headerBackgroundStartColor'; ?> !default;
$headerBackgroundFill: <?php echo $header_bgcolors['background_fill'] ? $header_bgcolors['background_fill'] : 'solid'; ?> !default;

// background wallpaper
$headerUseBackgroundWallpaper: <?php echo $header_wallpaper['background_use_wallpaper'] ? $header_wallpaper['background_use_wallpaper'] : 'no'; ?> !default;

$headerBackgroundImage: "<?php echo $header_wallpaper['background_image'] ? $header_wallpaper['background_image'] : 'none'; ?>" !default;
$headerBackgroundRepeat: <?php echo $header_wallpaper['background_repeat'] ? $header_wallpaper['background_repeat'] : 'no-repeat'; ?> !default;
$headerBackgroundAttachment: <?php echo $header_wallpaper['background_attachment'] ? $header_wallpaper['background_attachment'] : 'scroll'; ?> !default;

$headerBackgroundPosition: <?php echo $header_wallpaper['background_position'] ? $header_wallpaper['background_position'] : 'left top'; ?> !default;
$headerBackgroundPositionX: <?php echo $header_wallpaper['background_positionX'] ? $header_wallpaper['background_positionX'] : '0'; ?> !default;
$headerBackgroundPositionY: <?php echo $header_wallpaper['background_positionY'] ? $header_wallpaper['background_positionY'] : '0'; ?> !default;

$headerBackgroundSize: <?php echo $header_wallpaper['background_size'] ? $header_wallpaper['background_size'] : 'auto'; ?> !default;
$headerBackgroundPercentage: <?php echo $header_wallpaper['background_percentage'] ? $header_wallpaper['background_percentage'] : '0%'; ?> !default;

$headerBackgroundOverlay: <?php echo $header_wallpaper['overlay_color_rgba'] ? $header_wallpaper['overlay_color_rgba'] : 'transparent'; ?> !default;;


// Text and Headings
$headerText:                      <?php echo $header_text['text_color'] ? $header_text['text_color'] : '$headingsColor'; ?> !default;

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


<?php
$heading_states = array('normal','links','links_hovered');
foreach($headings as $state=>$heading):

    $state_name = ($state == 'headings_normal') ? 'Headings': ucfirst(str_replace(' ','',ucwords(str_replace('_',' ',$state))));
    $base = ($state == 'headings_normal') ? '$headerText' : '$headerLinksColor';
?>

    $header<?php echo $state_name; ?>Color:         <?php echo $heading[$state.'_color'] ? $heading[$state.'_color'] : $base; ?> !default;

    $header<?php echo $state_name; ?>Decoration: <?php echo $heading[$state.'_text_decoration'] ? $heading[$state.'_text_decoration'] : 'none'; ?> !default;
    $header<?php echo $state_name; ?>TextShadow: <?php echo $heading[$state.'_text_shadow'] ? $heading[$state.'_text_shadow'] : 'darken($headingsColor, 15%)'; ?> !default;

<?php
    endforeach;
?>
// front page settings
$frontpageAlignment: <?php echo $header_frontpage['title_alignment'] ? $header_frontpage['title_alignment'] : 'center' ?>;


// feed page settings
$feedAlignment: <?php echo $header_feed['title_alignment'] ? $header_feed['title_alignment'] : 'center' ?>;

// single page settings
$singleAlignment: <?php echo $header_single['title_alignment'] ? $header_single['title_alignment'] : 'center' ?>;
