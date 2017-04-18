// Links
// -------------------------
<?php

$links = $values['links'];
$link = $links['link'];
$hovered_link = $links['hovered_link'];
$active_link = $links['active_link'];
?>

$linkColor:         <?php echo $link['link_color'] ? $link['link_color'] : '$blue'; ?> ;
$linkBackgroundFill: <?php echo $link['link_background_fill'] ? $link['link_background_fill'] : 'none'; ?> ;
$linkBackgroundColor: <?php echo $link['link_background_color_rgba'] ? $link['link_background_color_rgba'] : 'transparent'; ?> ;
$linkTextDecoration: <?php echo $link['link_text_decoration'] ? $link['link_text_decoration'] : 'none'; ?> ;
$linkTextShadow: <?php echo $link['link_text_shadow'] ? $link['link_text_shadow'] : 'darken($linkColor, 15%)'; ?> ;

$hoveredLinkColor:         <?php echo $hovered_link['hovered_link_color'] ? $hovered_link['hovered_link_color'] : '$blue'; ?> ;
$hoveredLinkBackgroundFill: <?php echo $hovered_link['hovered_link_background_fill'] ? $hovered_link['hovered_link_background_fill'] : 'none'; ?> ;
$hoveredLinkBackgroundColor: <?php echo $hovered_link['hovered_link_background_color_rgba'] ? $hovered_link['hovered_link_background_color_rgba'] : 'transparent'; ?> ;
$hoveredLinkTextDecoration: <?php echo $hovered_link['hovered_link_text_decoration'] ? $hovered_link['hovered_link_text_decoration'] : 'none'; ?> ;
$hoveredLinkTextShadow: <?php echo $hovered_link['hovered_link_text_shadow'] ? $link['hovered_link_text_shadow'] : 'darken($linkColor, 15%)'; ?> ;

$activeLinkColor:         <?php echo $active_link['active_color'] ? $active_link['active_color'] : '$blue'; ?> ;
$activeLinkBackgroundFill: <?php echo $active_link['active_background_fill'] ? $active_link['active_background_fill'] : 'none'; ?> ;
$activeLinkBackgroundColor: <?php echo $active_link['active_background_color_rgba'] ? $active_link['active_background_color_rgba'] : 'transparent'; ?> ;
$activeLinkTextDecoration: <?php echo $active_link['active_text_decoration'] ? $active_link['active_text_decoration'] : 'none'; ?> ;
$activeLinkTextShadow: <?php echo $active_link['active_text_shadow'] ? $link['active_text_shadow'] : 'darken($linkColor, 15%)'; ?> ;

$linkColorHover:        darken($hoveredLinkColor, 15%);
