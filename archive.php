<?php

$layoutOptions = get_option('kjd_post_layout_settings');
$layoutSettings = $layoutOptions['kjd_post_layouts'];
$layoutSettings = $layoutSettings['kjd_archive'];
$position = $layoutSettings['position'];
$span = $position == 'left' || $position == 'right'? 'span9' : 'span12' ;

$bodySettings = get_option('kjd_body_misc_settings');
$bodySettings = $bodySettings['kjd_body_misc'];	
$confineBodyBackground = $bodySettings['kjd_body_confine_background'];
$confine = $confineBodyBackground =='true' ? 'container confined' : '';

$pageTitleSettings = get_option('kjd_pageTitle_misc_settings');
$pageTitleSettings = $pageTitleSettings['kjd_pageTitle_misc'];
$confineTitleBackground = $pageTitleSettings['kjd_pageTitle_confine_background'];

$sidebar = 'blog-entry';
$content_type = 'archives';
get_header();


include('lib/partials/the_list_scaffolding.php');

get_footer();
?>
