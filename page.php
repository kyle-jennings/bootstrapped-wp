<?php


	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];	
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

	$pageTitleSettings = get_option('kjd_pageTitle_misc_settings');
	$pageTitleSettings = $pageTitleSettings['kjd_pageTitle_misc'];
	$confineTitleBackground = $pageTitleSettings['kjd_pageTitle_confine_background'];

$sidebar = 'kjd_page';

get_header();
include('lib/partials/the_content_scaffolding.php');
get_footer();