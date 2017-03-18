<?php
// pagination
$pagination = $this->values['pagination'];
?>


// Pagination
// -------------------------
$paginationLinkColor:                 #000 !default;
$paginationBackground:                $white !default;

$paginationBorder:                    #ddd !default;


$paginationActiveBackground:          #f5f5f5 !default;

<?php

    _component_outer_border_sass_vars('pagination', $pagination['borders']);
    _component_border_radius_sass_vars('pagination', $pagination['borders']);
    _component_links_sass_vars('pagination', $pagination['text']);
?>
