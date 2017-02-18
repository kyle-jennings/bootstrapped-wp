// Tables
// -------------------------
$tableBackground:                   <?php echo $tables['rows']['background_color_rgba'] ? $tables['rows']['background_color_rgba'] : 'transparent' ;?> !default; // overall background-color
$tablesTextColor:       <?php echo $tables['rows']['text_color'] ? $tables['rows']['text_color'] : '$textColor' ;?>;
$tablesLinkColor:       <?php echo $tables['rows']['links_color'] ? $tables['rows']['links_color'] : '$linkColor' ;?>;

$tableBackgroundHover:              darken($tableBackground, 20%) !default; // for hover

$tablesHeaderBackgroundColor:       <?php echo $tables['header']['background_color_rgba'] ? $tables['header']['background_color_rgba'] : 'darken($tableBackground, 30%)' ;?>;
$tablesHeaderTextColor:       <?php echo $tables['header']['text_color'] ? $tables['header']['text_color'] : 'darken($tablesTextColor, 30%)' ;?>;




$tableBackgroundAccent:             <?php echo $tables['striped_rows']['background_color_rgba'] ? $tables['striped_rows']['background_color_rgba'] : '#f9f9f9' ; ?>  !default; // for striping
$tableBackgroundAccentHover:              darken($tableBackgroundAccent, 20%) !default; // for hover
$tablesStripedTextColor:       <?php echo $tables['striped_rows']['text_color'] ? $tables['striped_rows']['text_color'] : '$textColor' ;?>;
$tablesStripedLinkColor:       <?php echo $tables['striped_rows']['links_color'] ? $tables['striped_rows']['links_color'] : '$linkColor' ;?>;



$tableBorder:                       <?php echo $tables['borders']['border_color'] ? $tables['borders']['border_color'] :'#ddd' ; ?> !default; // table and cell border
