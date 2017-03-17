<?php


foreach($links as $state=>$link):

    $state_name = lcfirst(str_replace(' ','',ucwords(str_replace('_',' ',$state))));

    $decoration = ($state != 'link') ? 'underline' : 'none';
    ?>
    $<?php echo $state_name; ?>Color:         <?php echo $link[$state.'_color'] ? $link[$state.'_color'] : '#08c'; ?> !default;
    $<?php echo $state_name; ?>BackgroundFill: <?php echo $link[$state.'_background_fill'] ? $link[$state.'_background_fill'] : 'none'; ?> !default;
    $<?php echo $state_name; ?>BackgroundColor: <?php echo $link[$state.'_background_color_rgba'] ? $link[$state.'_background_color_rgba'] : 'transparent'; ?> !default;
    $<?php echo $state_name; ?>Decoration: <?php echo $link[$state.'_text_decoration'] ? $link[$state.'_text_decoration'] : $decoration; ?> !default;
    $<?php echo $state_name; ?>TextShadow: <?php echo $link[$state.'_text_shadow'] ? $link[$state.'_text_shadow'] : 'darken($linkColor, 15%)'; ?> !default;


<?php
endforeach;

// _component_links_sass_vars('imageCaption', $image_captions);
