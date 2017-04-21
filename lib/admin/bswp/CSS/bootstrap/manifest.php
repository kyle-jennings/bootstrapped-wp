<?php

include $this->src_dir . '__helpers.php';

ob_start();

// if we are in the body, we need to include the sidebar settings
if($this->preview == true && reset($this->sections) == 'body_settings')
    $this->sections[] = 'sidebar_settings';


// loop through each section
foreach($this->sections as $k=>$section):
    // grab the section name
    $section_name = $this->getSectionName( $section );

    // if no values are provided (not in a preview), then we grab them from the DB
    $values = !empty($this->values) ? $this->values : $values = get_option('bswp_'.$section);

    // if the previed section is the body settings, and the current iteration is
    // on the sidebar settings, and we are in preview mode,
    // then get the saved sidebar values
    if( reset($this->sections) == 'body_settings'
        && $section == 'sidebar_settings'
        && $this->preview == true
    ){
        $values = get_option('bswp_sidebar_settings');
    }

    // ok, so only include the global settings once, if we are on the
    // site_settings iteration, or we are in preview mode (and in the first iteration)
    if ( $section == 'site_settings' || ($this->preview == true && $k == 0)):
?>


    @import 'settings/constants';
    <?php
     echo $this->setVariables($values, $section);
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

    echo $this->setVariables($values, $section);

    // if we are building the sidebar, site, or body settings, we need to
    // include the sidebar component
    if ( in_array($section, array('sidebar_settings', 'site_settings', 'body_settings')) )
        echo "@import 'components/sidebar';";

    // if we are styling the sidebar (its activated) then we give it
    // special bg rules
    if($section == 'sidebar_settings' ):
        echo "@import 'components/scaffolding-sidebar-bg';";
        echo "@import 'components/scaffolding-sidebar-borders';";
    else:
        echo "@import 'components/scaffolding-background';";
        echo "@import 'components/scaffolding-borders';";
    endif;
?>
    @import 'components/scaffolding';
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

<?php
    // if we are in the site settings section and neither the headier or navbar
    // settings sections have been set, then we style the header and navbar
    if( $section == 'site_settings'
        && (!in_array('header_settings', $this->sections)
        && !in_array('navbar_settings', $this->sections) )
    ):
    echo "@import 'components/header';";
    echo "@import 'components/navbar';";
    echo "@import 'components/dropdowns';";
    echo "@import 'components/navbar_dropdown';";
    echo "@import 'components/navbar-toggle';";
    echo "@import 'components/navbar-responsive';";

    endif;

    // if we are in the header section, style the header
    if( $section == 'header_settings'):
        echo "@import 'components/header';";
    endif;

    // if we are in the navbar section, style the navbar
    if( $section == 'navbar_settings'):
        echo "@import 'components/navbar';";
        echo "@import 'components/dropdowns';";
        echo "@import 'components/navbar_dropdown';";
        echo "@import 'components/navbar-toggle';";
        echo "@import 'components/navbar-responsive';";
    endif;
?>


<?php
echo '}';


$contents = ob_get_contents();
endforeach;

ob_end_clean();
$this->bootstrap_manifest = $contents;
