<?php

    $output = '';

    foreach($headings as $size=>$heading):

        $size_name = ($size == 'h1') ? 'headings': $size;


        $output .= '$'.$size_name.'Color:         '. ($heading[$size.'_color'] ? $heading[$size.'_color'] : 'inherit' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$size_name.'BackgroundStyle: '. ($heading[$size.'_background_style'] ? $heading[$size.'_background_style'] : 'none' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$size_name.'BackgroundColor: '. ($heading[$size.'_background_color_rgba'] ? $heading[$size.'_background_color_rgba'] : 'transparent' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$size_name.'Decoration: '. ($heading[$size.'_text_decoration'] ? $heading[$size.'_text_decoration'] : 'none' ).' !default;';
        $output .= "\r\n";
        $output .= '$'.$size_name.'TextShadow: '. ($heading[$size.'_text_shadow'] ? $heading[$size.'_text_shadow'] : 'darken($headingsColor, 15%)' ).' !default;';
        $output .= "\r\n";
        $output .= "\r\n";


    endforeach;


    echo $output;
