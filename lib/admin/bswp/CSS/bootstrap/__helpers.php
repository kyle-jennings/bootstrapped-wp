<?php



/**
 * Sets the background color variables for a component
 */
function _component_background_colors_sass_vars($prefix = null, $settings = array()) {
    if(is_null($prefix) )
        return;

    // $things = array('background_start_color', 'background_end_color', 'background_fill');
    ?>

    $<?php echo $prefix; ?>BackgroundColor: <?php echo $settings['background_start_color_rgba'] ? $settings['background_start_color_rgba'] : '$bodyBackground'; ?> !default;
    $<?php echo $prefix; ?>BackgroundEndColor: <?php echo $settings['background_end_color_rgba'] ? $settings['background_end_color_rgba'] : '$bodyBackgroundEnd'; ?> !default;

    $<?php echo $prefix; ?>BackgroundFill: <?php echo $settings['background_fill'] ? $settings['background_fill'] : 'none'; ?> !default;
<?php
}


/**
 * Set the border radius
 */
function _component_border_radius_sass_vars($prefix = null, $borders = array()){
?>
    $<?php echo $prefix; ?>BorderRadius: <?php echo $borders['all_corners'] ? $borders['all_corners'] :'$baseBorderRadius' ; ?> !default;

    <?php
    if(is_null($prefix) || empty($borders) )
        return;

    $corners = array('top_left','top_right','bottom_right', 'bottom_left');
    ?>

    <?php
        foreach($corners as $corner):
            $cornerName = str_replace(' ','',ucwords(str_replace('_',' ',$corner)));
    ?>
        $<?php echo $prefix.$cornerName; ?>BorderRadius: <?php echo $borders[$corner] ? $borders[$corner] :'$baseBorderRadius' ; ?> !default;
    <?php endforeach; ?>

    <?php if($borders['style_corners'] == 'yes'):?>
        $<?php echo $prefix; ?>BorderRadius: $<?php echo $prefix?>TopLeftBorderRadius $<?php echo $prefix?>TopRightBorderRadius $<?php echo $prefix?>BottomRightBorderRadius $<?php echo $prefix?>BottomLeftBorderRadius;
    <?php endif;
}


/**
 * Set the borders for a component
 */
function _component_outer_border_sass_vars($prefix = null, $borders = array(), $defaults = array()){
    $count = 0;
?>
    $<?php echo $prefix; ?>BorderColor: <?php echo $borders['all_sides_border_color']
        ? $borders['all_sides_border_color']
        : _default('rgba(0,0,0, .2)', $defaults[$count], $count) ; ?> !default;

    $<?php echo $prefix; ?>BorderStyle: <?php echo $borders['all_sides_border_style']
        ? $borders['all_sides_border_style']
        : _default('solid', $defaults[$count], $count) ; ?> !default;

    $<?php echo $prefix; ?>BorderWidth: <?php echo $borders['all_sides_border_width']
        ? $borders['all_sides_border_width']
        :_default('1px', $defaults[$count], $count) ; ?> !default;

<?php
    if(is_null($prefix) || empty($borders) )
        return;

    $sides = array('top','right','bottom', 'left');
?>


    <?php foreach($sides as $side): ?>

    $<?php echo $prefix; ?><?php echo ucfirst($side);?>BorderColor: <?php echo $borders[$side.'_border_color']
        ? $borders[$side.'_border_color']
        : 'transparent' ; ?> !default;
    $<?php echo $prefix; ?><?php echo ucfirst($side);?>BorderStyle: <?php echo $borders[$side.'_border_style']
        ? $borders[$side.'_border_style']
        : 'none' ; ?> !default;
    $<?php echo $prefix; ?><?php echo ucfirst($side);?>BorderWidth: <?php echo $borders[$side.'_border_width']
        ? $borders[$side.'_border_width']
        : '0' ; ?> !default;
    <?php endforeach; ?>

    <?php if($borders['style_border_sides'] == 'yes'): ?>
        $<?php echo $prefix; ?>BorderColor:
            $<?php echo $prefix; ?>TopBorderColor
            $<?php echo $prefix; ?>RightBorderColor
            $<?php echo $prefix; ?>BottomBorderColor
            $<?php echo $prefix; ?>LeftBorderColor;
        $<?php echo $prefix; ?>BorderStyle:
            $<?php echo $prefix; ?>TopBorderStyle
            $<?php echo $prefix; ?>RightBorderStyle
            $<?php echo $prefix; ?>BottomBorderStyle
            $<?php echo $prefix; ?>LeftBorderStyle;
        $<?php echo $prefix; ?>BorderWidth:
            $<?php echo $prefix; ?>TopBorderWidth
            $<?php echo $prefix; ?>RightBorderWidth
            $<?php echo $prefix; ?>BottomBorderWidth
            $<?php echo $prefix; ?>LeftBorderWidth;
    <?php
    endif;

}


/**
 * function to set the link styles for a component (they are all on the same page)
 * @param  string $prefix used for naming the sass var
 * @param  array  $links  the settings
 */
function _component_links_sass_vars($prefix = null, $links = array()) {

?>

$<?php echo $prefix ?>LinksColor: $linkColor;

<?php
    if(is_null($prefix) )
        return;

    $states = array('links','hovered_links', 'active_links', 'visited_links');

    foreach($states as $state):
        $state_name = ($type == 'links') ? 'Link': str_replace(' ','',ucwords(str_replace('_',' ',$state)));
        $default = ($type == 'links') ? 'inherit' : $prefix.'LinksColor';

    ?>
    $<?php echo $prefix . $state_name; ?>Color: <?php echo $links[$state.'_color'] ? $links[$state.'_color'] : '$'.$prefix.'LinksColor'; ?> !default;
    $<?php echo $prefix . $state_name; ?>BackgroundStyle: <?php echo $links[$state.'_background_style'] ? $links[$state.'_background_style'] : 'none'; ?> !default;
    $<?php echo $prefix . $state_name; ?>BackgroundColor: <?php echo $links[$state.'_background_color_rgba'] ? $links[$state.'_background_color_rgba'] : 'transparent'; ?> !default;
    $<?php echo $prefix . $state_name; ?>Decoration: <?php echo $links[$state.'_text_decoration'] ? $links[$state.'_text_decoration'] : 'none'; ?> !default;
    $<?php echo $prefix . $state_name; ?>TextShadow: <?php echo $links[$state.'_text_shadow'] ? $links[$state.'_text_shadow'] : 'none'; ?> !default;


    <?php

    endforeach;

}




/**
 * depreciated link varss helper - this is used for the section's links
 */
function _link_sass_vars($links) {
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
}



function _default($fallback, $default = null, &$count = 0) {
    if(!$fallback)
        return '';

    $count ++;
    return $default ? $default : $fallback;

}
