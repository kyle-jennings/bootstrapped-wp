<?php

$admin_func_root = dirname(dirname(__FILE__));

include($admin_func_root.'/fields/settings.php');
include($admin_func_root.'/fields/settings-field-generators.php');


include('bswp-admin--build-form.php');
include('bswp-admin--section-nav.php');
include('bswp-admin--menu.php');
