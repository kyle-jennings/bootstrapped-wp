<?php


/* ------------------------- Update Style sheet after settigns are saved ------------------------------------ */

function kjd_build_theme_css(){

  $root=dirname(dirname(__FILE__)); 
  $root = $root.'/styles';
  $file = $root.'/custom.css';

  if(file_exists($file)){
    chmod($file, 0777);
    $file = fopen($file, "w+"); 
  }else{
    $file = fopen($file, "x+");
  }

  ob_start();
    echo kjd_get_theme_options();
    $buffered_content = ob_get_contents();
  ob_end_clean();

  fwrite($file, $buffered_content);
  fclose($file);

  return $input;
}


/* ------------------------- select form for admin pages ------------------------ */
function kjd_nav_select(){
  $nav_markup = '';
  $nav_markup .= '<select class="kjd-admin-page-title">';
  foreach( array(
    'General Settings'=>'admin.php?page=kjd_theme_settings',
    'Header Settings'=>'admin.php?page=kjd_header_settings',
    'Navbar Settings'=>'admin.php?page=kjd_navbar_settings',
    'Navbar Dropdown Settings'=>'admin.php?page=kjd_dropdown-menu_settings',
    'Image Carousel Settings'=>'admin.php?page=kjd_cycler_settings',
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

/* ------------------------ site preview iframe ----------------------------*/
function kjd_site_preview(){

  $preview_sizes = array('desktop','tablet','phone');
  
  $site_preview ='';
  $site_preview .= '<select class="preview-size">';
  
  foreach($preview_sizes as $size){
    $site_preview .= '<option value="'.$size.'">'.$size.'</option>';  
  }

  $site_preview .= '</select>';
  $site_preview .='<iframe class="preview-window" src="'.get_site_url().'" width="100%" height="600"></iframe>';

  return $site_preview;
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


add_action('print_media_templates', function(){

  // define your backbone template;
  // the "tmpl-" prefix is required,
  // and your input field should have a data-setting attribute
  // matching the shortcode name
  ?>

  <script type="text/html" id="tmpl-kjd-gallery-settings">
    <h3>Gallery Settings</h3>

    <label class="setting">
      <span><?php _e('Gallery Type:'); ?></span>
      <select data-setting="style">

        <option>Choose</option>
        <option value="default"> Default </option>
        <option value="elastislide"> Elastislide</option>      
        <option value="elastislideNav"> Elastislide with Nav </option>        
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

  <script>

    jQuery(document).ready(function($){

      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      $.extend(wp.media.gallery.defaults, {
        style: 'default',
        link: 'post',
        image_size: 'thumbnail'
      });

      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          // return wp.media.template('gallery-settings')(view)
          return wp.media.template('kjd-gallery-settings')(view)
               + wp.media.template('kjd-gallery-link-settings')(view)
               + wp.media.template('kjd-gallery-image-size-settings')(view)               
          }
      });

    });

  </script>
  <?php

});