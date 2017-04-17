<?php

include $this->src_dir . '__helpers.php';

ob_start();

// $section = reset($this->sections);
//
// $section_name = $this->getSectionName( $section );
// $values = get_option('bswp_site_settings');


foreach($this->sections as $section):
    $section_name = $this->getSectionName( $section );
    $values = get_option('bswp_'.$section);


    if ( $section == 'site_settings' ):
?>


    @import 'settings/constants';
    <?php
     echo $this->setVariables($values);
    ?>
    @import 'settings/mixins';
    @import 'settings/reset';
    @import 'settings/utilities'; // Has to be last to override when necessary
    @import 'settings/section-globals';

    @import 'settings/body';
    @import 'settings/grid';
    @import 'settings/layouts';
    @import 'components/section';
    @import 'components/navs';

    @import 'components/brand';
    @import 'settings/responsive-utilities'; // RESPONSIVE CLASSES
    @import 'settings/responsive-1200px-min'; // Large desktops
    @import 'settings/responsive-768px-979px'; // Tablets to regular desktops
    @import 'settings/responsive-767px-max'; // Phones to portrait tablets and narrow desktops
    @import 'components/component-animations';
    @import 'components/sprites';
    @import 'components/modals';

    @import 'components/frontpage';
<?php
    endif;

echo $section_name . ' {';
?>


    <?php
    echo $this->setVariables($values);
    ?>
    @import 'components/scaffolding';
<?php
    if ( in_array($section, array('sidebar_settings', 'site_settings', 'body_settings')) )
        echo "@import 'components/sidebar';";
?>
<?php
    if($section == 'sidebar_settings' ):
        echo "@import 'components/scaffolding-sidebar-bg';";
    else:
        echo "@import 'components/scaffolding-background';";
    endif;
?>

    @import 'components/scaffolding-borders';
    @import 'components/links';


    @import 'components/type';
    @import 'components/blockquotes';
    @import 'components/code';
    @import 'components/forms';
    @import 'components/tables';


    @import 'components/wells';
    @import 'components/close';


    @import 'components/buttons';
    @import 'components/button-groups';
    @import 'components/alerts';

    @import 'components/breadcrumbs';
    @import 'components/pagination';
    @import 'components/pager';

    @import 'components/tooltip';
    @import 'components/popovers';

    @import 'components/images';

    @import 'components/thumbnails';

    @import 'components/media';
    @import 'components/labels-badges';
    @import 'components/progress-bars';
    @import 'components/accordion';
    @import 'components/tabbables';
    @import 'components/carousel';
    @import 'components/hero-unit';
    @import 'components/content-column';

    @import 'components/header';

    @import 'components/navbar';
    @import 'components/dropdowns';
    @import 'components/navbar_dropdown';
    @import 'components/navbar-toggle';
    @import 'components/navbar-responsive';

<?php
echo '}';


$contents = ob_get_contents();
endforeach;

ob_end_clean();
$this->bootstrap_manifest = $contents;
