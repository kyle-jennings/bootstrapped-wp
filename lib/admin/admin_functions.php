<?php
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