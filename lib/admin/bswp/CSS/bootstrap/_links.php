<?php

$output = '';
foreach($links as $type=>$link):

    $type_name = ($type == 'links') ? 'link': lcfirst(ucwords(str_replace('_','',$type)));

    $output .= '$'.$type_name.'Color:         '. ($link[$type.'_color'] ? $link[$type.'_color'] : 'inherit' ).' !default;';
    $output .= "\r\n";
    $output .= '$'.$type_name.'BackgroundStyle: '. ($link[$type.'_background_style'] ? $link[$type.'_background_style'] : 'none' ).' !default;';
    $output .= "\r\n";
    $output .= '$'.$type_name.'BackgroundColor: '. ($link[$type.'_background_color_rgba'] ? $link[$type.'_background_color_rgba'] : 'transparent' ).' !default;';
    $output .= "\r\n";
    $output .= '$'.$type_name.'Decoration: '. ($link[$type.'_text_decoration'] ? $link[$type.'_text_decoration'] : 'none' ).' !default;';
    $output .= "\r\n";
    $output .= '$'.$type_name.'TextShadow: '. ($link[$type.'_text_shadow'] ? $link[$type.'_text_shadow'] : 'darken($linkColor, 15%)' ).' !default;';

    $output .= "\r\n";
    $output .= "\r\n";
    $output .= "\r\n";


endforeach;

echo $output;
