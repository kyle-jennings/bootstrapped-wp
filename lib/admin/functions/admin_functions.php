<?php


include_once('styles_init.php');

// inits the live preview function
function kjd_live_preview(){

    if( isset($_POST['data']) ){
        $kill_list = array('option_page', 'action', '_wpnonce', '_wp_http_referer');

    $data = $_POST['data'];
    $lib = dirname( dirname( dirname(__FILE__) ) ) ;


        $settings = $data['settings'];
        foreach($settings as $k=>$v){
            $name = $v['name'];
            if( in_array($name, $kill_list) )
                unset($settings[$k]);
        }
        $data['settings'] = $settings;

        $lib = dirname( dirname( dirname(__FILE__) ) ) ;

        $file = $lib.'/styles/preview.css';


        if(file_exists($file)){
            unlink($file);
        }

        $file = fopen($file, "x+");

        ob_start();

        echo kjd_get_theme_options($data);
        $buffered_content = ob_get_contents();

        ob_end_clean();

        fwrite($file, $buffered_content);
        fclose($file);
    }

    die;
}
add_action('wp_ajax_kjd_live_preview', 'kjd_live_preview');


/**
 * After settings are saved, the style sheet is rebuilt
 */

function kjd_build_theme_css( $stylesheet = 'custom.css' ){


  $root = dirname( dirname(dirname(__FILE__)) );  // theme -> lib

  if( file_exists( $root . '/styles' ) ){

    chmod($root, 0777);
    $root = $root . '/styles';
    $file = $root . '/'. $stylesheet;

  }else{
    mkdir( $root . '/styles', 0777);
    $root = $root . '/styles';
    $file = $root . '/'. $stylesheet;
  }

  if(file_exists($file)){
    chmod($file, 0777);
    $file = fopen($file, "w+");
  }elseif( !file_exists( $file ) && file_exists( $root ) ){
    $file = fopen($file, "x+");
  }else{
    return;
  }
  ob_start();
    echo kjd_get_theme_options(null);
    $buffered_content = ob_get_contents();
  ob_end_clean();

  fwrite($file, $buffered_content);
  fclose($file);

  return $input;
}


/**
 * Navigation dropdown to different sections
 * @return [type] [description]
 */
function kjd_nav_select(){
  $nav_markup = '';
  $nav_markup .= '<select class="kjd-admin-page-title">';
  foreach( array(
    'General Settings'=>'admin.php?page=kjd_theme_settings',
    'Header Settings'=>'admin.php?page=kjd_header_settings',
    'Navbar Settings'=>'admin.php?page=kjd_navbar_settings',
    'Navbar Dropdown Settings'=>'admin.php?page=kjd_dropdown-menu_settings',
    'Image Banner Settings'=>'admin.php?page=kjd_cycler_settings',
    'Page Title Settings'=>'admin.php?page=kjd_pageTitle_settings',
    'Body Settings'=>'admin.php?page=kjd_body_settings',
    'Footer Settings'=>'admin.php?page=kjd_footer_settings',
    'Login Page Settings'=>'admin.php?page=kjd_login_settings',
    'Special Backgrounds'=>'admin.php?page=kjd_misc_background_settings',
    'Page Layouts'=>'admin.php?page=kjd_page_layout_settings'
      ) as $page => $path )
  {
    $nav_markup .= '<option value="'.$path.'">' . $page . '</option>';

  }
  $nav_markup .= '</select>';

  return $nav_markup;
}

/**
 * Control input for the iframe
 * @return [type] [description]
 */
function kjd_site_preview(){

  $preview_sizes = array('desktop','tablet','phone');

  $output ='';
  $output .= '<select class="preview-size">';

  foreach($preview_sizes as $size){
    $output .= '<option value="'.$size.'">'.$size.'</option>';
  }

  $output .= '</select>';

  $output .= '<div class="preview-wrapper">';
    $output .='<iframe class="preview-window" src="'.get_bloginfo('url').'" width="100%" height="600"></iframe>';
  $output .= '</div>';

  return $output;
}


///////////////////////////
// featured image settings
///////////////////////////

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');

  $options = get_option('kjd_component_settings');
  $image = $options['featured_image'];
    add_image_size( 'featured-image', $image['width'], $image['height'] );
}


/* ----------------------------------------------------------------
      Gallery options
------------------------------------------------------------------- */
add_action('print_media_templates', 'kjd_add_gallery_option_fields');

  // define your backbone template;
  // the "tmpl-" prefix is required,
  // and your input field should have a data-setting attribute
  // matching the shortcode name
function kjd_add_gallery_option_fields(){
  ?>

  <script type="text/html" id="tmpl-kjd-gallery-settings">
    <h3>Gallery Settings</h3>

    <label id ="type" class="setting">
      <span><?php _e('Gallery Type:'); ?></span>
      <select data-setting="style">

        <option>Choose</option>
        <option value="default"> Default </option>
        <option value="elastislide"> Elastislide</option>
        <option value="elastislideNav"> Elastislide with Nav </option>
        <option value="responsiveSlides"> Responsive Slides </option>
      </select>
    </label>

  </script>


  <script type="text/html" id="tmpl-kjd-gallery-link-settings">
    <label class="setting">
      <span><?php _e('Link image to:'); ?></span>
      <select data-setting="link">

        <option>Choose</option>
        <option value="post"> Post </option>
        <option value="file"> File </option>
        <option value="colorbox"> Modal </option>
        <option value="none"> No link </option>

      </select>
    </label>

  </script>

  <script type="text/html" id="tmpl-kjd-gallery-image-size-settings">
    <label class="setting">
      <span><?php _e('Image Size:'); ?></span>
      <select data-setting="image_size">

        <option>Choose</option>
        <option value="thumbnail"> Thumbnail </option>
        <option value="medium"> Medium </option>
        <option value="featured-image"> Featured </option>

      </select>
    </label>

  </script>

  <script type="text/html" id="tmpl-kjd-gallery-bg-color-settings">
    <label class="setting">
      <span><?php _e('Background Color:'); ?></span>
      <input type="text" class="minicolors" data-setting="bg_color" />

    </label>

  </script>



<script>

jQuery(document).ready(function($){

  $.extend(wp.media.gallery.defaults, {
    style: 'default',
    link: 'post',
    image_size: 'thumbnail',
    bg_color: 'rgba(0,0,0,.8)'
  });


  // merge default gallery settings template with yours
  wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({

    template: function(view){
      // return wp.media.template('gallery-settings')(view)
      return wp.media.template('kjd-gallery-settings')(view)
           + wp.media.template('kjd-gallery-link-settings')(view)
           + wp.media.template('kjd-gallery-image-size-settings')(view)
           + wp.media.template('kjd-gallery-bg-color-settings')(view)
      }

  });


});

</script>
<?php

}


/* ------------------------------------------------
    Widget Styles
 -------------------------------------------------*/

// Add style dropdown
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

// widget visibility
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

// //add options to widget
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

// // update widget
function kjd_update_widget( $instance, $new_instance ) {
  $instance['widget_style'] = $new_instance['widget_style'];
  $instance['device_visibility'] = $new_instance['device_visibility'];

  return $instance;
}
add_filter( 'widget_update_callback', 'kjd_update_widget', 10, 2 );



/**
 * Adds the tinymce plugin
 */
include('shortcode-injector/init.php');