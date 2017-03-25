<?php
// tables
$tables = $this->values['tables'];

?>
// Tables
// -------------------------

// standard row
$tableBackground:                   <?php echo _tern($tables['rows']['background_color_rgba'],  '$offWhite'); ?> ;
$tablesTextColor:       <?php echo _tern($tables['rows']['text_color'],  '$grayDark'); ?>;
$tablesLinkColor:       <?php echo _tern($tables['rows']['links_color'],  '$linkColor'); ?>;
$tableBackgroundHover:              darken($tableBackground, 20%) ;

// hedaer
$tablesHeaderBackgroundColor:       <?php echo _tern($tables['table_header']['background_color_rgba'],  '$grayLighterDark'); ?>;
$tablesHeaderTextColor:       <?php echo _tern($tables['table_header']['text_color'],  '$gray'); ?>;

$tableBackgroundAccent:             <?php echo _tern($tables['striped_rows']['background_color_rgba'],  '$offWhite'); ?>  ;
$tableBackgroundAccentHover:              darken($tableBackgroundAccent, 20%) ;


// striped rows
$tableStripedBackground:        $tableBackgroundAccent;
$tableStripedBackground:        $white;
$tablesStripedTextColor:       <?php echo _tern($tables['striped_rows']['text_color'],  '$grayDark'); ?>;
$tablesStripedLinkColor:       <?php echo _tern($tables['striped_rows']['links_color'],  '$linkColor'); ?>;


// the row borders
$tableBorder:                       <?php echo _tern($tables['borders']['inner_border_color'], '$grayLighterDark'); ?> ;
$tableBorderStyle: <?php echo _tern($tables['borders']['inner_border_style'], 'solid'); ?> ;
$tableBorderWidth: <?php echo _tern($tables['borders']['inner_border_width'], '1px'); ?> ;

// the outer border
$tableOuterBorder: <?php echo _tern($tables['borders']['all_sides_border_color'], '$tableBorder'); ?> ;
$tableOuterBorderStyle: <?php echo _tern($tables['borders']['all_sides_border_style'], 'none'); ?> ;
$tableOuterBorderWidth: <?php echo _tern($tables['borders']['all_sides_border_width'], '0'); ?> ;


$tableTopBorder: <?php echo _tern($tables['borders']['top_border_color'],  'transparent'); ?> ;
$tableTopBorderStyle: <?php echo _tern($tables['borders']['top_border_style'], 'none'); ?> ;
$tableTopBorderWidth: <?php echo _tern($tables['borders']['top_border_width'], '0'); ?> ;

$tableRightBorder: <?php echo _tern($tables['borders']['right_border_color'],  'transparent'); ?> ;
$tableRightBorderStyle: <?php echo _tern($tables['borders']['right_border_style'], 'none'); ?> ;
$tableRightBorderWidth: <?php echo _tern($tables['borders']['right_border_width'], '0'); ?> ;

$tableBottomBorder: <?php echo _tern($tables['borders']['bottom_border_color'],  'transparent'); ?> ;
$tableBottomBorderStyle: <?php echo _tern($tables['borders']['bottom_border_style'], 'none'); ?> ;
$tableBottomBorderWidth: <?php echo _tern($tables['borders']['bottom_border_width'], '0'); ?> ;

$tableLeftBorder: <?php echo _tern($tables['borders']['left_border_color'],  'transparent'); ?> ;
$tableLeftBorderStyle: <?php echo _tern($tables['borders']['left_border_style'], 'none'); ?> ;
$tableLeftBorderWidth: <?php echo _tern($tables['borders']['left_border_width'], '0'); ?> ;


<?php
    if($tables['borders']['style_border_sides'] == 'yes'):
?>
$tableOuterBorder: $tableTopBorder $tableRightBorder $tableBottomBorder $tableLeftBorder;
$tableOuterBorderStyle: $tableTopBorderStyle $tableRightBorderStyle $tableBottomBorderStyle $tableLeftBorderStyle;
$tableOuterBorderWidth: $tableTopBorderWidth $tableRightBorderWidth $tableBottomBorderWidth $tableLeftBorderWidth;
<?php
    endif;
?>
