// Tables
// -------------------------
$tableBackground:                   <?php echo $tables['rows']['background_color_rgba'] ? $tables['rows']['background_color_rgba'] : 'transparent' ;?> !default; // overall background-color
$tablesTextColor:       <?php echo $tables['rows']['text_color'] ? $tables['rows']['text_color'] : '$textColor' ;?>;
$tablesLinkColor:       <?php echo $tables['rows']['links_color'] ? $tables['rows']['links_color'] : '$linkColor' ;?>;

$tableBackgroundHover:              darken($tableBackground, 20%) !default; // for hover

$tablesHeaderBackgroundColor:       <?php echo $tables['table_header']['background_color_rgba'] ? $tables['table_header']['background_color_rgba'] : 'darken($tableBackground, 30%)' ;?>;
$tablesHeaderTextColor:       <?php echo $tables['table_header']['text_color'] ? $tables['table_header']['text_color'] : 'darken($tablesTextColor, 30%)' ;?>;



$tableBackgroundAccent:             <?php echo $tables['striped_rows']['background_color_rgba'] ? $tables['striped_rows']['background_color_rgba'] : '#f9f9f9' ; ?>  !default; // for striping
$tableBackgroundAccentHover:              darken($tableBackgroundAccent, 20%) !default; // for hover

$tableStripedBackground:        $tableBackgroundAccent;
$tablesStripedTextColor:       <?php echo $tables['striped_rows']['text_color'] ? $tables['striped_rows']['text_color'] : '$textColor' ;?>;
$tablesStripedLinkColor:       <?php echo $tables['striped_rows']['links_color'] ? $tables['striped_rows']['links_color'] : '$linkColor' ;?>;



$tableBorder:                       <?php echo $tables['borders']['border_color'] ? $tables['borders']['border_color'] :'#ddd' ; ?> !default; // table and cell border
$tableBorderStyle: <?php echo $tables['borders']['border_style'] ? $tables['borders']['border_style'] :'none' ; ?> !default; //
$tableBorderWidth: <?php echo $tables['borders']['border_width'] ? $tables['borders']['border_width'] :'0' ; ?> !default; //


$tableOuterBorder: <?php echo $tables['borders']['outer_border_color'] ? $tables['borders']['outer_border_color'] :'$tableBorder' ; ?> !default; //
$tableOuterBorderStyle: <?php echo $tables['borders']['outer_border_style'] ? $tables['borders']['outer_border_style'] :'none' ; ?> !default; //
$tableOuterBorderWidth: <?php echo $tables['borders']['outer_border_width'] ? $tables['borders']['outer_border_width'] :'0' ; ?> !default; //
