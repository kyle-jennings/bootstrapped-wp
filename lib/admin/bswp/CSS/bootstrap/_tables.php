<?php
// tables
$tables = $this->values['tables'];

?>
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



$tableBorder:                       <?php echo $tables['borders']['inner_border_color'] ? $tables['borders']['inner_border_color'] :'#ddd' ; ?> !default; // table and cell border
$tableBorderStyle: <?php echo $tables['borders']['inner_border_style'] ? $tables['borders']['inner_border_style'] :'none' ; ?> !default; //
$tableBorderWidth: <?php echo $tables['borders']['inner_border_width'] ? $tables['borders']['inner_border_width'] :'0' ; ?> !default; //


$tableOuterBorder: <?php echo $tables['borders']['all_sides_border_color'] ? $tables['borders']['all_sides_border_color'] :'$tableBorder' ; ?> !default; //
$tableOuterBorderStyle: <?php echo $tables['borders']['all_sides_border_style'] ? $tables['borders']['all_sides_border_style'] :'none' ; ?> !default; //
$tableOuterBorderWidth: <?php echo $tables['borders']['all_sides_border_width'] ? $tables['borders']['all_sides_border_width'] :'0' ; ?> !default; //


$tableTopBorder: <?php echo $tables['borders']['top_border_color'] ? $tables['borders']['top_border_color'] : 'transparent' ; ?> !default; //
$tableTopBorderStyle: <?php echo $tables['borders']['top_border_style'] ? $tables['borders']['top_border_style'] :'none' ; ?> !default; //
$tableTopBorderWidth: <?php echo $tables['borders']['top_border_width'] ? $tables['borders']['top_border_width'] :'0' ; ?> !default; //

$tableRightBorder: <?php echo $tables['borders']['right_border_color'] ? $tables['borders']['right_border_color'] : 'transparent' ; ?> !default; //
$tableRightBorderStyle: <?php echo $tables['borders']['right_border_style'] ? $tables['borders']['right_border_style'] :'none' ; ?> !default; //
$tableRightBorderWidth: <?php echo $tables['borders']['right_border_width'] ? $tables['borders']['right_border_width'] :'0' ; ?> !default; //

$tableBottomBorder: <?php echo $tables['borders']['bottom_border_color'] ? $tables['borders']['bottom_border_color'] : 'transparent' ; ?> !default; //
$tableBottomBorderStyle: <?php echo $tables['borders']['bottom_border_style'] ? $tables['borders']['bottom_border_style'] :'none' ; ?> !default; //
$tableBottomBorderWidth: <?php echo $tables['borders']['bottom_border_width'] ? $tables['borders']['bottom_border_width'] :'0' ; ?> !default; //

$tableLeftBorder: <?php echo $tables['borders']['left_border_color'] ? $tables['borders']['left_border_color'] : 'transparent' ; ?> !default; //
$tableLeftBorderStyle: <?php echo $tables['borders']['left_border_style'] ? $tables['borders']['left_border_style'] :'none' ; ?> !default; //
$tableLeftBorderWidth: <?php echo $tables['borders']['left_border_width'] ? $tables['borders']['left_border_width'] :'0' ; ?> !default; //


<?php
    if($tables['borders']['style_border_sides'] == 'yes'):
?>
$tableOuterBorder: $tableTopBorder $tableRightBorder $tableBottomBorder $tableLeftBorder;
$tableOuterBorderStyle: $tableTopBorderStyle $tableRightBorderStyle $tableBottomBorderStyle $tableLeftBorderStyle;
$tableOuterBorderWidth: $tableTopBorderWidth $tableRightBorderWidth $tableBottomBorderWidth $tableLeftBorderWidth;
<?php
    endif;
?>
