<?php

include '__helpers.php';
foreach($this->section as $section):


    $section_name = $this->getSectionName($section);
    $background_and_borders = $this->values['background_and_borders'];

    // headings
    $text = $this->values['text'];
    $text_color = $text['text']['text_color'];

    // misc settings
    $misc = $this->values['misc'];
    $layout = $misc['layout'];

    ob_start();
    ?>


    $section: <?php echo $section; ?>;


    <?php

        if($section == 'site_settings'){
        }
        require_once 'variables/_body.php';
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
    require_once 'variables/_colors.php';
    require_once 'variables/_scaffolding.php';
    require_once 'variables/_typography.php';
    require_once 'variables/_links.php';
    require_once 'variables/_headings.php';

    require_once 'variables/_dropdown.php';
    require_once 'variables/_tables.php';
    require_once 'variables/_buttons.php';
    require_once 'variables/_images.php';
    require_once 'variables/_forms.php';
    require_once 'variables/_alerts.php';

    require_once 'variables/_quotes.php';
    require_once 'variables/_preformatted.php';
    require_once 'variables/_well.php';

    require_once 'variables/_header.php';
    require_once 'variables/_navbar.php';
    require_once 'variables/_navbar-dropdown.php';

    require_once 'variables/_pagination.php';
    require_once 'variables/_tooltips.php';
    require_once 'variables/_popovers.php';
    require_once 'variables/_collapsibles.php';
    require_once 'variables/_tabs.php';
    require_once 'variables/_hero-unit.php';
    ?>


    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    // examine($contents);
    $this->bootstrap_vars = $contents;


endforeach;
