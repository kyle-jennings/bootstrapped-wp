<?php

/**
 * All the code pertaining to the live preview stuff goes here
 */


/**
 * Control size of iframe
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



/**
 * build the CSS to preview.css
 * @return [type] [description]
 */
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