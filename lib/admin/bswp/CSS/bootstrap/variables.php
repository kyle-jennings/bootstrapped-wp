<?php



// get the setting and section nam3


ob_start();
?>
// Component sizing
// Based on 14px font-size and 20px line-height

$paddingLarge:          11px 19px; // 44px
$paddingSmall:          2px 10px;  // 26px
$paddingMini:           0px 6px;   // 22px

$baseBorderRadius:      4px;
$borderRadiusLarge:     6px;
$borderRadiusSmall:     3px;
<?php

require 'variables/_vars.php';
require 'variables/_body.php';

require 'variables/_colors.php';
require 'variables/_scaffolding.php';
require 'variables/_typography.php';
require 'variables/_links.php';
require 'variables/_headings.php';

require 'variables/_dropdown.php';
require 'variables/_tables.php';
require 'variables/_buttons.php';
require 'variables/_images.php';
require 'variables/_forms.php';
require 'variables/_alerts.php';

require 'variables/_quotes.php';
require 'variables/_preformatted.php';
require 'variables/_well.php';


// header things
if($section == 'header_settings'){
    require 'variables/_header-settings.php';
}

if($section == 'site_settings')
    require 'variables/_header.php';


require 'variables/_navbar.php';
require 'variables/_navbar-dropdown.php';

require 'variables/_pagination.php';
require 'variables/_tooltips.php';
require 'variables/_popovers.php';
require 'variables/_collapsibles.php';
require 'variables/_tabs.php';
require 'variables/_hero-unit.php';


$contents = ob_get_contents();
ob_end_clean();
