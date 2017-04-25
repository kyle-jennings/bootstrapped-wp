<?php



/**
 * Sets the background color variables for a component
 */
function _component_background_colors_sass_vars($prefix = null, $settings = array(), $default = '$white') {
    if(is_null($prefix) )
        return;
    $output = '';
    $output .= '$'.$prefix.'BackgroundColor: '. _tern($settings['background_start_color_rgba'], $default).';';
    $output .= '$'.$prefix.'BackgroundEndColor: '. _tern($settings['background_end_color_rgba'], $default).';';

    $output .= '$'.$prefix.'BackgroundFill: '. _tern($settings['background_fill'], 'none').';';
    echo $output;

}


/**
 * Set the border radius
 */
function _component_border_radius_sass_vars($prefix = null, $borders = array(), $default = '$baseBorderRadius' ){

    $output = '';
    $output .= '$'. $prefix . 'BorderRadius: ' . _tern($borders['all_corners'], $default).';';

    if(is_null($prefix) || empty($borders) ){
        echo $output;
        return;
    }


    // loop through each corner
    $corners = array('top_left','top_right','bottom_right', 'bottom_left');
    foreach($corners as $corner):
        $cornerName = $prefix . str_replace(' ','',ucwords(str_replace('_',' ',$corner)));
        $output .= '$'. $cornerName . 'BorderRadius: '. _tern($borders[$corner], $default).';';
    endforeach;

    // if the corners were set to be set individually, set those
    if($borders['style_corners'] == 'yes'):
        $output .= '$'. $prefix. 'BorderRadius: $'.$prefix.'TopLeftBorderRadius $'.$prefix.'TopRightBorderRadius
            $'.$prefix.'BottomRightBorderRadius $'.$prefix.'BottomLeftBorderRadius;';
    endif;

    echo $output;
}


/**
 * Set the borders for a component
 */
function _component_outer_border_sass_vars(
    $prefix = null,
    $borders = array(),
    $defaults = array('color'=>'$transGrayLight', 'style'=>'solid', 'width'=>'1px' ),
    $section = null
) {

    $output = '';
    // just incase there is an issue with teh defaults array, set it again
    $defaults = is_null($defaults) ? array('color'=>'$transGrayLight', 'style'=>'solid', 'width'=>'1px' ) : $defaults ;
    extract($defaults); // and extract it

    // set the initial border settings, this sets all the sides at onces
    $output .= '$'. $prefix . 'BorderColor:' . _tern( $borders['all_sides_border_color'], $color) .';';
    $output .= '$'. $prefix . 'BorderStyle:' . _tern( $borders['all_sides_border_style'], $style) .';';
    $output .= '$'. $prefix . 'BorderWidth:' . _tern( $borders['all_sides_border_width'], $width) .';';

    if(is_null($prefix) )
        return;

    // loop through the 4 sides
    $sides = array('top','right','bottom', 'left');
    foreach($sides as $side):
        $output .= '$'. $prefix . ucfirst($side) .'BorderColor:'. _tern($borders[$side.'_border_color'], 'transparent') .';';
        $output .= '$'. $prefix . ucfirst($side) .'BorderStyle:'. _tern($borders[$side.'_border_style'], 'none') .';';
        $output .= '$'. $prefix . ucfirst($side) .'BorderWidth:'. _tern($borders[$side.'_border_width'], '0') .';';

    endforeach;

    if($borders['style_border_sides'] == 'yes'):
        $output .= '$BorderColor: $TopBorderColor $RightBorderColor $BottomBorderColor $LeftBorderColor;';
        $output .= '$BorderStyle: $TopBorderStyle $RightBorderStyle $BottomBorderStyle $LeftBorderStyle;';
        $output .= '$BorderWidth: $TopBorderWidth $RightBorderWidth $BottomBorderWidth $LeftBorderWidth;';
    endif;

    // if($prefix == 'navbar')
    //     examine($output);


    echo $output;
}


/**
 * function to set the link styles for a component (they are all on the same page)
 *
 *    $componentLinkColor
 *    $componentLinkBackgroundStyle
 *    $componentLinkBackgroundColor
 *    $componentLinkTextDecpration
 *    $componentLinkTextShadow
 *    $componentHoveredLinkTextShadow
 *    ...
 */
function _component_links_sass_vars($prefix = null, $links = array(), $default = '$blue') {

    $output = '';
    $output .= '$'.$prefix .'LinkColor: $linkColor;';

    if(is_null($prefix) )
        return;

    $states = array('link','hovered_link', 'active_link');

    foreach($states as $state):
        // removes the underscore and StudyCases the link type
        // hovered_link => HoveredLink
        $state_name = $prefix . str_replace(' ','',ucwords(str_replace('_',' ',$state)));

        $output .= '$'.$state_name . 'Color:'. _tern($links[$state.'_color'], $default).';';
        $output .= '$'.$state_name . 'BackgroundStyle:'. _tern($links[$state.'_background_style'],'none').';';
        $output .= '$'.$state_name . 'BackgroundColor:'. _tern($links[$state.'_background_color_rgba'],'transparent').';';
        $output .= '$'.$state_name . 'TextDecoration:'. _tern($links[$state.'_text_decoration'],'none').';';
        $output .= '$'.$state_name . 'TextShadow:'. _tern($links[$state.'_text_shadow'],'none').';';

    endforeach;

    echo $output;
}


function _tern($try, $default) {
    return $try ? $try : $default;

}
