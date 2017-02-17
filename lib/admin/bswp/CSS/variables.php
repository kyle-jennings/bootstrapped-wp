<?php

// background settings
$background = $this->values['background'];
$background_colors = $background['colors'];
$background_wallpapers = $background['wallpapers'];

// border settings
$borders = $this->values['borders'];

// headings

$headings = $this->values['headings'];
// text and links
$text = $this->values['text'];
$text_color = $text['text']['text_color'];

$links = array(
    'links' => $text['links'],
    'hovered_links' => $text['hovered-links'],
    'visited_links' => $text['visited-links'],
    'active_links' => $text['active-links'],
);

// tables
$tables = $this->values['tables'];
// examine($tables);


// navbar
$navbar = $this->values['navbar'];
$navbg = $navbar['background_colors'];
$navtext = $navbar['text'];
$navborders = $nav['borders'];

$nav_submenu_bg = $navbar['submenu_background_colors'];
$nav_submenu_text = $navbar['submenu_text'];
$nav_submenu_border = $navbar['submenu_borders'];

// examine($nav_submenu_border);
ob_start();
?>

//
// Variables
// --------------------------------------------------


// Global values
// --------------------------------------------------


// Grays
// -------------------------
$black:                 #000 !default;
$grayDarker:            #222 !default;
$grayDark:              #333 !default;
$gray:                  #555 !default;
$greyMedium:            #777 !default;
$grayLight:             #999 !default;
$grayLighter:           #eee !default;
$white:                 #fff !default;


// Accent colors
// -------------------------
$blue:                  #049cdb !default;
$blueDark:              #0064cd !default;
$green:                 #46a546 !default;
$red:                   #9d261d !default;
$yellow:                #ffc40d !default;
$orange:                #f89406 !default;
$pink:                  #c3325f !default;
$purple:                #7a43b6 !default;


// Scaffolding
// -------------------------
$bodyBackground:        <?php echo $background['colors']['background_start_color'] ? $background['colors']['background_start_color'] : '$white'; ?> !default;
$bodyBackgroundEnd:        <?php echo $background['colors']['background_end_color'] ? $background['colors']['background_end_color'] : '$bodyBackground'; ?> !default;
$backgroundStyle: <?php echo $background['colors']['background_fill'] ? $background['colors']['background_fill'] : 'none'; ?> !default;

// text
$textColor:             <?php echo $text_color ? $text_color : '$grayDark'; ?> !default;


// Links
// -------------------------
<?php

    $output = '';
    foreach($links as $type=>$link):

        $type_name = ($type == 'links') ? 'link': lcfirst(ucwords(str_replace('_','',$type)));

        $output .= '$'.$type_name.'Color:         '. ($link[$type.'_color'] ? $link[$type.'_color'] : 'inherit' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$type_name.'BackgroundStyle: '. ($link[$type.'_background_style'] ? $link[$type.'_background_style'] : 'none' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$type_name.'BackgroundColor: '. ($link[$type.'_background_color_rgba'] ? $link[$type.'_background_color_rgba'] : 'transparent' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$type_name.'Decoration: '. ($link[$type.'_text_decoration'] ? $link[$type.'_text_decoration'] : 'none' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$type_name.'TextShadow: '. ($link[$type.'_text_shadow'] ? $link[$type.'_text_shadow'] : 'darken($linkColor, 15%)' ).' !default;';

        $output .= "\r\n";
        $output .= "\r\n";
        $output .= "\r\n";


    endforeach;

    echo $output;

?>

$linkColorHover:        darken($hoveredlinksColor, 15%) !default;
// Typography
// -------------------------
$sansFontFamily:        "Helvetica Neue", Helvetica, Arial, sans-serif !default;
$serifFontFamily:       Georgia, "Times New Roman", Times, serif !default;
$monoFontFamily:        Monaco, Menlo, Consolas, "Courier New", monospace !default;

$baseFontSize:          14px !default;
$baseFontFamily:        $sansFontFamily !default;
$baseLineHeight:        20px !default;
$altFontFamily:         $serifFontFamily !default;

$headingsFontFamily:    inherit !default; // empty to use BS default, $baseFontFamily
$headingsFontWeight:    bold !default;    // instead of browser default, bold

<?php

    $output = '';

    foreach($headings as $size=>$heading):

        $size_name = ($size == 'h1') ? 'headings': $size;


        $output .= '$'.$size_name.'Color:         '. ($heading[$size.'_color'] ? $heading[$size.'_color'] : 'inherit' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$size_name.'BackgroundStyle: '. ($heading[$size.'_background_style'] ? $heading[$size.'_background_style'] : 'none' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$size_name.'BackgroundColor: '. ($heading[$size.'_background_color_rgba'] ? $heading[$size.'_background_color_rgba'] : 'transparent' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$size_name.'Decoration: '. ($heading[$size.'_text_decoration'] ? $heading[$size.'_text_decoration'] : 'none' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$size_name.'TextShadow: '. ($heading[$size.'_text_shadow'] ? $heading[$size.'_text_shadow'] : 'darken($headingsColor, 15%)' ).' !default;';
        $output .= "\r\n";
        $output .= "\r\n";


    endforeach;


    echo $output;
?>


// Component sizing
// -------------------------
// Based on 14px font-size and 20px line-height

$fontSizeLarge:         $baseFontSize * 1.25; // ~18px
$fontSizeSmall:         $baseFontSize * 0.85; // ~12px
$fontSizeMini:          $baseFontSize * 0.75; // ~11px

$paddingLarge:          11px 19px !default; // 44px
$paddingSmall:          2px 10px !default;  // 26px
$paddingMini:           0px 6px !default;   // 22px

$baseBorderRadius:      4px !default;
$borderRadiusLarge:     6px !default;
$borderRadiusSmall:     3px !default;


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


// Buttons
// -------------------------
$btnBackground:                     $white !default;
$btnBackgroundHighlight:            darken($white, 10%) !default;
$btnBorder:                         #ccc !default;

$btnPrimaryBackground:              $linkColor !default;
$btnPrimaryBackgroundHighlight:     adjust-hue($btnPrimaryBackground, 20%) !default;

$btnInfoBackground:                 #5bc0de !default;
$btnInfoBackgroundHighlight:        #2f96b4 !default;

$btnSuccessBackground:              #62c462 !default;
$btnSuccessBackgroundHighlight:     #51a351 !default;

$btnWarningBackground:              lighten($orange, 15%) !default;
$btnWarningBackgroundHighlight:     $orange !default;

$btnDangerBackground:               #ee5f5b !default;
$btnDangerBackgroundHighlight:      #bd362f !default;

$btnInverseBackground:              #444 !default;
$btnInverseBackgroundHighlight:     $grayDarker !default;


// Forms
// -------------------------
$inputBackground:               $white !default;
$inputBorder:                   #ccc !default;
$inputBorderRadius:             $baseBorderRadius !default;
$inputDisabledBackground:       $grayLighter !default;
$formActionsBackground:         #f5f5f5 !default;
$inputHeight:                   $baseLineHeight + 10px; // base line-height + 8px vertical padding + 2px top/bottom border


// Dropdowns
// -------------------------
$dropdownBackground:            $white !default;
$dropdownBorder:                rgba(0,0,0,.2) !default;
$dropdownDividerTop:            #e5e5e5 !default;
$dropdownDividerBottom:         $white !default;

$dropdownLinkColor:             $grayDark !default;
$dropdownLinkColorHover:        $white !default;
$dropdownLinkColorActive:       $white !default;

$dropdownLinkBackgroundActive:  $linkColor !default;
$dropdownLinkBackgroundHover:   $dropdownLinkBackgroundActive !default;



// COMPONENT VARIABLES
// --------------------------------------------------


// Z-index master list
// -------------------------
// Used for a bird's eye view of components dependent on the z-axis
// Try to avoid customizing these :)
$zindexDropdown:          1000 !default;
$zindexPopover:           1010 !default;
$zindexTooltip:           1030 !default;
$zindexFixedNavbar:       1030 !default;
$zindexModalBackdrop:     1040 !default;
$zindexModal:             1050 !default;


// Sprite icons path
// -------------------------
$iconSpritePath:          image-path("glyphicons-halflings.png") !default;
$iconWhiteSpritePath:     image-path("glyphicons-halflings-white.png") !default;


// Input placeholder text color
// -------------------------
$placeholderText:         $grayLight !default;


// Hr border color
// -------------------------
$hrBorder:                $grayLighter !default;


// Horizontal forms & lists
// -------------------------
$horizontalComponentOffset:       180px !default;


// Wells
// -------------------------
$wellBackground:                  #f5f5f5 !default;


// Navbar
// -------------------------
$navbarCollapseWidth:             979px !default;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

// Navbar
// -------------------------



$navbarCollapseWidth:             979px !default;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

$navbarHeight:                    40px !default;
$navbarBackgroundStart:           <?php echo $navbg['background_start_color'] ? $navbg['background_start_color'] : '$bodyBackground'; ?> !default;
$navbarBackgroundEnd:             <?php echo $navbg['background_end_color'] ? $navbg['background_end_color'] : 'darken($navbarBackgroundHighlight, 5%)'; ?> !default;

$navbarBackgroundHighlight:       $navbarBackgroundStart !default;
$navbarBackground:                $navbarBackgroundEnd !default;

$navbarBorder:                    darken($navbarBackground, 12%) !default;
$navbarBorderStyle:               'solid';
$navbarBorderWidth:               '1px';

$navbarTopBorder:                      <?php echo $navbg['top_border_color'] ? $navbg['top_border_color'] : '$navbarBorder'; ?> !default;
$navbarTopBorderStyle:                 <?php echo $navbg['top_border_style'] ? $navbg['top_border_style'] : '$navbarBorderStyle'; ?> !default;
$navbarTopBorderWidth:                 <?php echo $navbg['top_border_width'] ? $navbg['top_border_width'] : '$navbarBorderWidth'; ?> !default;

$navbarRightBorder:                      <?php echo $navbg['right_border_color'] ? $navbg['right_border_color'] : '$navbarTopBorder'; ?> !default;
$navbarRightBorderStyle:                 <?php echo $navbg['right_border_style'] ? $navbg['right_border_style'] : '$navbarTopBorderStyle'; ?> !default;
$navbarRightBorderWidth:                 <?php echo $navbg['right_border_width'] ? $navbg['right_border_width'] : '$navbarTopBorderWidth'; ?> !default;

$navbarBottomBorder:                      <?php echo $navbg['bottom_border_color'] ? $navbg['bottom_border_color'] : '$navbarTopBorder'; ?> !default;
$navbarBottomBorderStyle:                 <?php echo $navbg['bottom_border_style'] ? $navbg['bottom_border_style'] : '$navbarTopBorderStyle'; ?> !default;
$navbarBottomBorderWidth:                 <?php echo $navbg['bottom_border_width'] ? $navbg['bottom_border_width'] : '$navbarTopBorderWidth'; ?> !default;

$navbarLeftBorder:                      <?php echo $navbg['left_border_color'] ? $navbg['left_border_color'] : '$navbarTopBorder'; ?> !default;
$navbarLeftBorderStyle:                 <?php echo $navbg['left_border_style'] ? $navbg['left_border_style'] : '$navbarTopBorderStyle'; ?> !default;
$navbarLeftBorderWidth:                 <?php echo $navbg['left_border_width'] ? $navbg['left_border_width'] : '$navbarTopBorderWidth'; ?> !default;
$navbarText:                      <?php echo $navtext['text_color'] ? $navtext['text_color'] : '$textColor'; ?> !default;
$navbarLinkColor:                 <?php echo $navtext['links_color'] ? $navtext['links_color'] : '$linkColor'; ?> !default;
$navbarLinkColorHover:            <?php echo $navtext['hovered_links_color'] ? $navtext['hovered_links_color'] : 'darken($navbarBackground, 5%)'; ?> !default;
$navbarLinkColorActive:           <?php echo $navtext['active_links_color'] ? $navtext['active_links_color'] : 'darken($navbarBackground, 5%)'; ?> !default;

$navbarLinkBackground:       <?php echo $navtext['links_background_color_rgba'] ? $navtext['links_background_color_rgba'] : 'transparent' ;?> !default;
$navbarLinkBackgroundHover:       <?php echo $navtext['hovered_links_background_color_rgba'] ? $navtext['hovered_links_background_color_rgba'] : 'transparent' ;?> !default;
$navbarLinkBackgroundActive:      <?php echo $navtext['active_links_background_color_rgba'] ? $navtext['active_links_background_color_rgba'] : 'darken($navbarBackground, 5%)' ;?> !default;

$navbarBrandColor:                $navbarLinkColor !default;





// -------------------------
// Navbar Dropdowns
// -------------------------

$navbarDropdownBackground:            <?php echo $nav_submenu_bg['color'] ? $nav_submenu_bg['color'] : '$white'; ?> !default;


$navbarDropdownTopBorderColor:                <?php echo $nav_submenu_border['top_border_color'] ? $nav_submenu_border['top_border_color'] : 'rgba(0,0,0,.2)'; ?> !default;
$navbarDropdownTopBorderStyle:                <?php echo $nav_submenu_border['top_border_style'] ? $nav_submenu_border['top_border_style'] : 'solid'; ?> !default;
$navbarDropdownTopBorderWidth:                <?php echo $nav_submenu_border['top_border_width'] ? $nav_submenu_border['top_border_width'] : '1px'; ?> !default;

$navbarDropdownRightBorderColor:                <?php echo $nav_submenu_border['right_border_color'] ? $nav_submenu_border['right_border_color'] : 'rgba(0,0,0,.2)'; ?> !default;
$navbarDropdownRightBorderStyle:                <?php echo $nav_submenu_border['right_border_style'] ? $nav_submenu_border['right_border_style'] : 'solid'; ?> !default;
$navbarDropdownRightBorderWidth:                <?php echo $nav_submenu_border['right_border_width'] ? $nav_submenu_border['right_border_width'] : '1px'; ?> !default;

$navbarDropdownBottomBorderColor:                <?php echo $nav_submenu_border['bottom_border_color'] ? $nav_submenu_border['bottom_border_color'] : 'rgba(0,0,0,.2)'; ?> !default;
$navbarDropdownBottomBorderStyle:                <?php echo $nav_submenu_border['bottom_border_style'] ? $nav_submenu_border['bottom_border_style'] : 'solid'; ?> !default;
$navbarDropdownBottomBorderWidth:                <?php echo $nav_submenu_border['bottom_border_width'] ? $nav_submenu_border['bottom_border_width'] : '1px'; ?> !default;

$navbarDropdownLeftBorderColor:                <?php echo $nav_submenu_border['left_border_color'] ? $nav_submenu_border['left_border_color'] : 'rgba(0,0,0,.2)'; ?> !default;
$navbarDropdownLeftBorderStyle:                <?php echo $nav_submenu_border['left_border_style'] ? $nav_submenu_border['left_border_style'] : 'solid'; ?> !default;
$navbarDropdownLeftBorderWidth:                <?php echo $nav_submenu_border['left_border_width'] ? $nav_submenu_border['left_border_width'] : '1px'; ?> !default;


$navbarDropdownBorder:                $navbarDropdownTopBorderColor !default;

$navbarDropdownDividerTop:            #e5e5e5 !default;
$navbarDropdownDividerBottom:         $white !default;

$navbarDropdownLinkColor:             <?php echo $nav_submenu_text['links_color'] ? $nav_submenu_text['links_color'] : '$grayDark'; ?> !default;
$navbarDropdownLinkBackground:   <?php echo $nav_submenu_text['links_background_color_rgba'] ? $nav_submenu_text['links_background_color_rgba'] : 'transparent' ?> !default;

$navbarDropdownLinkColorHover:        <?php echo $nav_submenu_text['hovered_links_color'] ? $nav_submenu_text['hovered_links_color'] : '$white'; ?> !default;
$navbarDropdownLinkBackgroundHover:   <?php echo $nav_submenu_text['hovered_links_background_color_rgba'] ? $nav_submenu_text['hovered_links_background_color_rgba'] : 'darken($navbarDropdownBackground, 5%)' ?> !default;

$navbarDropdownLinkColorActive:       <?php echo $nav_submenu_text['active_links_color'] ? $nav_submenu_text['active_links_color'] : '$white'; ?> !default;
$navbarDropdownLinkBackgroundActive:  <?php echo $nav_submenu_text['active_links_background_color_rgba'] ? $nav_submenu_text['active_links_background_color_rgba'] : '$navbarDropdownLinkColor'; ?> !default;




// Pagination
// -------------------------
$paginationBackground:                $white !default;
$paginationBorder:                    #ddd !default;
$paginationActiveBackground:          #f5f5f5 !default;


// Hero unit
// -------------------------
$heroUnitBackground:              $grayLighter !default;
$heroUnitHeadingColor:            inherit !default;
$heroUnitLeadColor:               inherit !default;


// Form states and alerts
// -------------------------
$warningText:             #c09853 !default;
$warningBackground:       #fcf8e3 !default;
$warningBorder:           darken(adjust-hue($warningBackground, -10), 3%) !default;

$errorText:               #b94a48 !default;
$errorBackground:         #f2dede !default;
$errorBorder:             darken(adjust-hue($errorBackground, -10), 3%) !default;

$successText:             #468847 !default;
$successBackground:       #dff0d8 !default;
$successBorder:           darken(adjust-hue($successBackground, -10), 5%) !default;

$infoText:                #3a87ad !default;
$infoBackground:          #d9edf7 !default;
$infoBorder:              darken(adjust-hue($infoBackground, -10), 7%) !default;


// Tooltips and popovers
// -------------------------
$tooltipColor:            #fff !default;
$tooltipBackground:       #000 !default;
$tooltipArrowWidth:       5px !default;
$tooltipArrowColor:       $tooltipBackground !default;

$popoverBackground:       #fff !default;
$popoverArrowWidth:       10px !default;
$popoverArrowColor:       #fff !default;
$popoverTitleBackground:  darken($popoverBackground, 3%) !default;

// Special enhancement for popovers
$popoverArrowOuterWidth:  $popoverArrowWidth + 1 !default;
$popoverArrowOuterColor:  rgba(0,0,0,.25) !default;



// GRID
// --------------------------------------------------


// Default 940px grid
// -------------------------
$gridColumns:             12 !default;
$gridColumnWidth:         60px !default;
$gridGutterWidth:         20px !default;
$gridRowWidth:            ($gridColumns * $gridColumnWidth) + ($gridGutterWidth * ($gridColumns - 1)) !default;

// 1200px min
$gridColumnWidth1200:     70px !default;
$gridGutterWidth1200:     30px !default;
$gridRowWidth1200:        ($gridColumns * $gridColumnWidth1200) + ($gridGutterWidth1200 * ($gridColumns - 1)) !default;

// 768px-979px
$gridColumnWidth768:      42px !default;
$gridGutterWidth768:      20px !default;
$gridRowWidth768:         ($gridColumns * $gridColumnWidth768) + ($gridGutterWidth768 * ($gridColumns - 1)) !default;


// Fluid grid
// -------------------------
$fluidGridColumnWidth:    percentage($gridColumnWidth/$gridRowWidth) !default;
$fluidGridGutterWidth:    percentage($gridGutterWidth/$gridRowWidth) !default;

// 1200px min
$fluidGridColumnWidth1200:     percentage($gridColumnWidth1200/$gridRowWidth1200) !default;
$fluidGridGutterWidth1200:     percentage($gridGutterWidth1200/$gridRowWidth1200) !default;

// 768px-979px
$fluidGridColumnWidth768:      percentage($gridColumnWidth768/$gridRowWidth768) !default;
$fluidGridGutterWidth768:      percentage($gridGutterWidth768/$gridRowWidth768) !default;


<?php
$contents = ob_get_contents();
ob_end_clean();
// examine($contents);
$this->bootstrap_vars = $contents;
