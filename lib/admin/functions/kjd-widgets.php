<?php


/* ------------------------------------------------
    Widget Styles
 -------------------------------------------------*/

/**
 * Adds the style settings field to the widget
 */
function kjd_widget_style( $widget, $return, $instance ){


  $widget_styles = array('not styled' => 'unstyled', 'use background' =>'well styled','no background' => 'no-well styled');

  $output = '';
  $output .= '<h4>Widget Settings</h4>';
  $output .= '<div>';

    $output .= "\t<label for='widget-{$widget->id_base}-{$widget->number}-widget_style'>"."Widget Style:</label>\n";
    $output .= "\t<select name='widget-{$widget->id_base}[{$widget->number}][widget_style]' id='widget-{$widget->id_base}-{$widget->number}-widget_style'>\n";
    foreach ( $widget_styles as $k => $v ) {
      if ( $v != '' ) {
        $output .= "\t<option value='".$v."' ".selected( $instance['widget_style'], $v, 0 ).">".$k."</option>\n";
      }
    }
    $output .= "</select>\n";
  $output .= '</div>';

  echo $output;

  return $instance;

}

/**
 * Adds the visiblity settings field to the widget
 */
function kjd_widget_visibility( $widget, $return, $instance ){

  $widget_styles = array(
    'All' => 'all',
    'Visible Desktop' => 'visible-desktop',
    'Visible Tablet' => 'visible-tablet',
    'Visible Phone' => 'visible-phone',
    'Hidden Desktop' => 'hidden-desktop',
    'Hidden Tablet' => 'hidden-tablet',
    'Hidden Phone' => 'hidden-phone',
   );

  $output = '';

  $output .= '<div>';
    $output .= "\t<label for='widget-{$widget->id_base}-{$widget->number}-device_visibility'> Device Visibility:</label>\n";
    $output .= "\t<select name='widget-{$widget->id_base}[{$widget->number}][device_visibility]' id='widget-{$widget->id_base}-{$widget->number}-device_visibility'>\n";
    foreach ( $widget_styles as $k => $v ) {
      if ( $v != '' ) {
        $output .= "\t<option value='".$v."' ".selected( $instance['device_visibility'], $v, 0 ).">".$k."</option>\n";
      }
    }
    $output .= "</select>\n";
  $output .= '</div>';

  echo $output;
  return $instance;

}

/**
 * I dont remember
 */
function kjd_extend_widget_form($instance, $widget ){

  $options = get_option('kjd_component_settings');
  $style = $options['style_widgets'];

  $output = '<hr />';
  $output .= '<h4>Theme Settings</h4>';

  echo $output;

  if( $style == 'true' ):
    add_action( 'in_widget_form', 'kjd_widget_style', 10, 3 );
  endif;

  add_action( 'in_widget_form', 'kjd_widget_visibility', 10, 3 );

  return $instance;
}
add_action( 'widget_form_callback', 'kjd_extend_widget_form', 10, 2 );

/**
 * Saves the widget settings
 */
function kjd_update_widget( $instance, $new_instance ) {
  $instance['widget_style'] = $new_instance['widget_style'];
  $instance['device_visibility'] = $new_instance['device_visibility'];

  return $instance;
}
add_filter( 'widget_update_callback', 'kjd_update_widget', 10, 2 );