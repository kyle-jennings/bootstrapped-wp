<?php

?>
// text
$textColor:             <?php echo $text_color ? $text_color : '$grayDark'; ?>;


// Typography
// -------------------------
$sansFontFamily:        "Helvetica Neue", Helvetica, Arial, sans-serif;
$serifFontFamily:       Georgia, "Times New Roman", Times, serif;
$monoFontFamily:        Monaco, Menlo, Consolas, "Courier New", monospace;

$baseFontSize:          14px;
$baseFontFamily:        $sansFontFamily;
$baseLineHeight:        20px;
$altFontFamily:         $serifFontFamily;

$fontSizeLarge:         $baseFontSize * 1.25; // ~18px
$fontSizeSmall:         $baseFontSize * 0.85; // ~12px
$fontSizeMini:          $baseFontSize * 0.75; // ~11px

$hrBorder:                $grayLighter;
