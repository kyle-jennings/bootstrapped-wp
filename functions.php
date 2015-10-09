<?php


// Check for WP3.6 installation
global $wp_version;
if (!defined ('IS_WP36'))
	define('IS_WP36', version_compare($wp_version, '3.6', '>=') );

	//This works only in WP2.6 or higher
	if ( IS_WP36 == FALSE) {
		add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade"><p><strong>' . __('Sorry, this theme only works for WordPress 3.6 or higher',"bootstrappedVersion") . '</strong></p></div>\';'));
		return;
	}




///////////////////////////////////////////////////////////////////
// DO NOT DELETE THE LINE OF CODE BELOW - IT WILL BREAK THE THEME!
include( dirname(__FILE__).'/lib/init.php' );