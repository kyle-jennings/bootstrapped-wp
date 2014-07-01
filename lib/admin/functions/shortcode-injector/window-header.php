<?php

$path  = ''; 

if ( !defined('WP_LOAD_PATH') ) {

	$file_found = false;	
	$this_dir = dirname(__FILE__);

	while ($file_found == false ){

		if( !file_exists( $this_dir . '/wp-load.php') ){

			$this_dir = dirname($this_dir);
			if ($this_dir == ''){
				exit('couldnt find the wp-load.php file...');
			}
		}else{

			define( 'WP_LOAD_PATH', $this_dir);
			$file_found = true;
		}
	}

}
require_once( WP_LOAD_PATH . '/wp-load.php');

$adminRoot = dirname( dirname( dirname(__FILE__)));
$site_root = get_bloginfo('template_directory');
$site_url = get_option('siteurl');