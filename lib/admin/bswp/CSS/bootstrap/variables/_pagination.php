<?php
// pagination
$pagination = $this->values['pagination'];
// examine($pagination);
?>


// Pagination
// -------------------------
$paginationBackground:                #fff ;
$paginationBorder:                    #ddd ;
$paginationActiveBackground:          #f5f5f5 ;


<?php

    _component_outer_border_sass_vars('pagination', $pagination['borders']);
    _component_border_radius_sass_vars('pagination', $pagination['borders']);

    //    $componentLinkColor
    //    $componentLinkBackgroundColor

?>
$paginationLinkColor: <?php echo _tern($pagination['links']['link_color'],'$linkColor'); ?> ;
$paginationLinkBackgroundColor: <?php echo _tern($pagination['links']['link_background_color_rgba'],'transparent'); ?> ;

$paginationHoveredLinkColor: <?php echo _tern($pagination['links']['hovered_link_color'],'$linkColor'); ?> ;
$paginationHoveredLinkBackgroundColor: <?php echo _tern($pagination['links']['hovered_link_background_color_rgba'],'transparent'); ?> ;

$paginationActiveLinkColor: <?php echo _tern($pagination['links']['active_link_color'],'$linkColor'); ?> ;
$paginationActiveLinkBackgroundColor: <?php echo _tern($pagination['links']['active_link_background_color_rgba'],'transparent'); ?> ;
