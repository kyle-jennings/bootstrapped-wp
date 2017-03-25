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
?>
$paginationLinkColor: <?php echo _tern($pagination['links']['link_color'],'$blue'); ?> ;
$paginationLinkBackgroundColor: <?php echo _tern($pagination['links']['link_background_color_rgba'], '$transparent'); ?> ;

$paginationHoveredLinkColor: <?php echo _tern($pagination['links']['hovered_link_color'],'$white'); ?> ;
$paginationHoveredLinkBackgroundColor: <?php echo _tern($pagination['links']['hovered_link_background_color_rgba'], '$blue'); ?> ;

$paginationActiveLinkColor: <?php echo _tern($pagination['links']['active_link_color'],'$white'); ?> ;
$paginationActiveLinkBackgroundColor: <?php echo _tern($pagination['links']['active_link_background_color_rgba'], '$blue'); ?> ;
