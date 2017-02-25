<?php


    $heading_states = array('normal','links','links_hovered');


    foreach($headings as $state=>$heading):

        $state_name = ($state == 'headings_normal') ? 'headings': lcfirst(str_replace(' ','',ucwords(str_replace('_',' ',$state))));
        $base = ($state == 'headings_normal') ? '$textColor' : '$linkColor';
?>

        $<?php echo $state_name; ?>Color:         <?php echo $heading[$state.'_color'] ? $heading[$state.'_color'] : $base; ?> !default;

        $<?php echo $state_name; ?>Decoration: <?php echo $heading[$state.'_text_decoration'] ? $heading[$state.'_text_decoration'] : 'none'; ?> !default;
        $<?php echo $state_name; ?>TextShadow: <?php echo $heading[$state.'_text_shadow'] ? $heading[$state.'_text_shadow'] : 'darken($headingsColor, 15%)'; ?> !default;



<?php
    endforeach;
