<?php

include_once('stylesheet-builder/styles_init.php');

///////////////////////////
// featured image settings
///////////////////////////

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');

  $options = get_option('kjd_component_settings');
  $image = $options['featured_image'];
    add_image_size( 'featured-image', $image['width'], $image['height'] );
}

include('live-preview.php');
include('gallery.php');
include('kjd-widgets.php');
include('shortcode-injector/init.php');