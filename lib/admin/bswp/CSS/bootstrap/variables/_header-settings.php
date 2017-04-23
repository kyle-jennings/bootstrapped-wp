<?php
$header = $values['settings_and_layout'];
$header_settings = $header['settings'];
$header_frontpage = $header['frontpage'];

$header_feed = $header['feed'];
$header_single = $header['single'];


?>

// base settings
$headingAlignment: <?php echo _tern($header_settings['title_alignment'], 'left'); ?>;

// front page settings
$frontpageAlignment: <?php echo _tern($header_frontpage['title_alignment'], '$headingAlignment'); ?>;


// feed page settings
$feedAlignment: <?php echo _tern($header_feed['title_alignment'],'$headingAlignment'); ?>;

// single page settings
$singleAlignment: <?php echo _tern($header_single['title_alignment'], '$headingAlignment'); ?>;

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
