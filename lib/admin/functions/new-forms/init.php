<?php

$theme_root = get_template_directory();
include($theme_root.'/lib/admin/functions/fields/class--bswpFields.php');

$field_settings = new bswpFields;
add_action('admin_init', array($field_settings, 'register_section_settings'));

// include($theme_root.'/lib/admin/functions/live-preview.php');
include('class--bswpForm.php');
include('class--bswpNav.php');
include('class--bswpAdminMenu.php');