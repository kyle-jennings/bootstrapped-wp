<?php

get_header();


$frontpage_settings = get_frontpage_settings();
extract($frontpage_settings);


if(!empty($components))
    $content = kjd_front_page_layout( $components );
else
    $content = default_frontpage();

$layout = new Layout($content);
echo $layout::scaffolding_init();

get_footer(); // End page, start function
