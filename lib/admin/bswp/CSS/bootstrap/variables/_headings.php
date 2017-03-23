// headgings
///////////////


$headingsFontFamily:    $baseFontFamily; // empty to use BS default, $baseFontFamily
$headingsFontWeight:    bold;    // instead of browser default, bold
<?php
    $headings = array(
        'headings_normal' => $text['headings'],
        'headings_link' => $text['headings_link'],
        'headings_link_hovered' => $text['headings_link_hovered'],
    );

    $heading_states = array('normal','link','link_hovered');


    foreach($headings as $state=>$heading):

        $state_name = ($state == 'headings_normal') ? 'headings': lcfirst(str_replace(' ','',ucwords(str_replace('_',' ',$state))));
        $base = ($state == 'headings_normal') ? '$textColor' : '$linkColor';
?>

        $<?php echo $state_name; ?>Color:         <?php echo $heading[$state.'_color'] ? $heading[$state.'_color'] : $base; ?> ;

        $<?php echo $state_name; ?>TextDecoration: <?php echo $heading[$state.'_text_decoration'] ? $heading[$state.'_text_decoration'] : 'none'; ?> ;
        $<?php echo $state_name; ?>TextShadow: <?php echo $heading[$state.'_text_shadow'] ? $heading[$state.'_text_shadow'] : 'darken($headingsColor, 15%)'; ?> ;



<?php
    endforeach;
