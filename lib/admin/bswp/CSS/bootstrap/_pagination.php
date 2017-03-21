<?php
// pagination
$pagination = $this->values['pagination'];
// examine($pagination);
?>


// Pagination
// -------------------------
$paginationBackground:                #fff !default;
$paginationBorder:                    #ddd !default;
$paginationActiveBackground:          #f5f5f5 !default;


<?php

    _component_outer_border_sass_vars('pagination', $pagination['borders']);
    _component_border_radius_sass_vars('pagination', $pagination['borders']);

    //    $componentLinkColor
    //    $componentLinkBackgroundColor

?>
$paginationLinkColor: <?php echo _tern($pagination['links']['link_color'],'$linkColor'); ?> !default;
$paginationLinkBackgroundColor: <?php echo _tern($pagination['links']['link_background_color_rgba'],'transparent'); ?> !default;

$paginationHoveredLinkColor: <?php echo _tern($pagination['links']['hovered_link_color'],'$linkColor'); ?> !default;
$paginationHoveredLinkBackgroundColor: <?php echo _tern($pagination['links']['hovered_link_background_color_rgba'],'transparent'); ?> !default;

$paginationActiveLinkColor: <?php echo _tern($pagination['links']['active_link_color'],'$linkColor'); ?> !default;
$paginationActiveLinkBackgroundColor: <?php echo _tern($pagination['links']['active_link_background_color_rgba'],'transparent'); ?> !default;
