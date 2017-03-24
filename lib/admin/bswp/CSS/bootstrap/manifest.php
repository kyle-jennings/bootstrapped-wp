// Settings
///////////////////////


// Core variables and mixins
@import "settings/variables"; // Modify this for custom colors, font-sizes, etc
@import "settings/mixins";

// CSS Reset
@import "settings/reset";
// Utility classes
@import "settings/utilities"; // Has to be last to override when necessary

@if($section == site_settings){
    @import "body";
}
// Components
///////////////////////////
<?php
    echo $section_name . '{'; 
?>
// Grid system and page structure
@import "components/scaffolding";
@import "components/links";
@import "components/grid";
@import "components/layouts";
@import "components/section";



// Base CSS
@import "components/type";
@import "components/blockquotes";
@import "components/code";
@import "components/forms";
@import "components/tables";

// Components: common
@import "components/sprites";
@import "components/dropdowns";
@import "components/wells";
@import "components/component-animations";
@import "components/close";

// Components: Buttons & Alerts
@import "components/buttons";
@import "components/button-groups";
@import "components/alerts"; // Note: alerts share common CSS with buttons and thus have styles in buttons

// Components: Nav
@import "components/navs";
@import "components/navbar";
@import "components/navbar_dropdown";

@import "components/brand";
@import "components/navbar-toggle";


@import "components/breadcrumbs";
@import "components/pagination";
@import "components/pager";

// Components: Popovers
@import "components/modals";
@import "components/tooltip";
@import "components/popovers";

// images
@import "components/images";
// @import "components/thumbnails";
@import "components/thumbnails";


// Components: Misc
@import "components/media";
@import "components/labels-badges";
@import "components/progress-bars";
@import "components/accordion";
@import "components/tabbables";
@import "components/carousel";
@import "components/hero-unit";

@import "components/header";
<?
    echo '}';
?>




// RESPONSIVE CLASSES
// ------------------
@import "settings/responsive-utilities";
// MEDIA QUERIES
// ------------------
// Large desktops
@import "components/responsive-1200px-min";
// Tablets to regular desktops
@import "components/responsive-768px-979px";
// Phones to portrait tablets and narrow desktops
@import "components/responsive-767px-max";
// RESPONSIVE NAVBAR
// ------------------
// From 979px and below, show a button to toggle navbar contents
@import "components/responsive-navbar";