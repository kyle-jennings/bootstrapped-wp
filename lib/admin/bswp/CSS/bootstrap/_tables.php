<?php
// tables
$tables = $this->values['tables'];

?>
// Tables
// -------------------------
$tableBackground:                   <?php echo _tern($tables['rows']['background_color_rgba'],  '$offWhite'); ?> !default;
$tablesTextColor:       <?php echo _tern($tables['rows']['text_color'],  '$grayDark'); ?>;
$tablesLinkColor:       <?php echo _tern($tables['rows']['links_color'],  '$linkColor'); ?>;

$tableBackgroundHover:              darken($tableBackground, 20%) !default;

$tablesHeaderBackgroundColor:       <?php echo _tern($tables['table_header']['background_color_rgba'],  'darken($tableBackground, 30%)'); ?>;
$tablesHeaderTextColor:       <?php echo _tern($tables['table_header']['text_color'],  'darken($tablesTextColor, 30%)'); ?>;



$tableBackgroundAccent:             <?php echo _tern($tables['striped_rows']['background_color_rgba'],  '$offWhite'); ?>  !default;
$tableBackgroundAccentHover:              darken($tableBackgroundAccent, 20%) !default;

$tableStripedBackground:        $tableBackgroundAccent;
$tableStripedBackground:        darken($tableBackgroundAccent, 20%) !default;
$tablesStripedTextColor:       <?php echo _tern($tables['striped_rows']['text_color'],  '$grayDark'); ?>;
$tablesStripedLinkColor:       <?php echo _tern($tables['striped_rows']['links_color'],  '$linkColor'); ?>;



$tableBorder:                       <?php echo _tern($tables['borders']['inner_border_color'], '$grayLighter'); ?> !default;
$tableBorderStyle: <?php echo _tern($tables['borders']['inner_border_style'], 'none'); ?> !default;
$tableBorderWidth: <?php echo _tern($tables['borders']['inner_border_width'], '0'); ?> !default;


$tableOuterBorder: <?php echo _tern($tables['borders']['all_sides_border_color'], '$tableBorder'); ?> !default;
$tableOuterBorderStyle: <?php echo _tern($tables['borders']['all_sides_border_style'], 'none'); ?> !default;
$tableOuterBorderWidth: <?php echo _tern($tables['borders']['all_sides_border_width'], '0'); ?> !default;


$tableTopBorder: <?php echo _tern($tables['borders']['top_border_color'],  'transparent'); ?> !default;
$tableTopBorderStyle: <?php echo _tern($tables['borders']['top_border_style'], 'none'); ?> !default;
$tableTopBorderWidth: <?php echo _tern($tables['borders']['top_border_width'], '0'); ?> !default;

$tableRightBorder: <?php echo _tern($tables['borders']['right_border_color'],  'transparent'); ?> !default;
$tableRightBorderStyle: <?php echo _tern($tables['borders']['right_border_style'], 'none'); ?> !default;
$tableRightBorderWidth: <?php echo _tern($tables['borders']['right_border_width'], '0'); ?> !default;

$tableBottomBorder: <?php echo _tern($tables['borders']['bottom_border_color'],  'transparent'); ?> !default;
$tableBottomBorderStyle: <?php echo _tern($tables['borders']['bottom_border_style'], 'none'); ?> !default;
$tableBottomBorderWidth: <?php echo _tern($tables['borders']['bottom_border_width'], '0'); ?> !default;

$tableLeftBorder: <?php echo _tern($tables['borders']['left_border_color'],  'transparent'); ?> !default;
$tableLeftBorderStyle: <?php echo _tern($tables['borders']['left_border_style'], 'none'); ?> !default;
$tableLeftBorderWidth: <?php echo _tern($tables['borders']['left_border_width'], '0'); ?> !default;


<?php
    if($tables['borders']['style_border_sides'] == 'yes'):
?>
$tableOuterBorder: $tableTopBorder $tableRightBorder $tableBottomBorder $tableLeftBorder;
$tableOuterBorderStyle: $tableTopBorderStyle $tableRightBorderStyle $tableBottomBorderStyle $tableLeftBorderStyle;
$tableOuterBorderWidth: $tableTopBorderWidth $tableRightBorderWidth $tableBottomBorderWidth $tableLeftBorderWidth;
<?php
    endif;
?>
