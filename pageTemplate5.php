<?php
/*
Template Name: Page Template 5
*/
	$options = get_option('kjd_page_layout_settings');
	$pageLayoutSettings = $options['kjd_page_layouts'];
	$layoutSettings = $options['kjd_page_layouts']['kjd_template_5'];

	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];	
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

	$pageTitleSettings = get_option('kjd_pageTitle_misc_settings');
	$pageTitleSettings = $pageTitleSettings['kjd_pageTitle_misc'];
	$confineTitleBackground = $pageTitleSettings['kjd_pageTitle_confine_background'];


	$sidebar = 'kjd_template_5';

get_header();
include('lib/partials/the_content_scaffolding.php');
get_footer();