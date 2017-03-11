<?php



/**
 * All the code pertaining to the live preview stuff goes here
 */


/**
 * Control size of iframe
 * @return [type] [description]
 */
function kjd_site_preview($src = null){

    if( $src != 'login_settings' )
        $src = get_bloginfo('url');
    else
        $src = get_bloginfo('url').'/wp-login.php';

    if(is_ssl())
        $src = str_replace('http://', 'https://', $src);


    $preview_sizes = array('desktop','tablet','phone');

    $output ='';
    $output .= '<select class="preview-size">';

    foreach($preview_sizes as $size){
        $output .= '<option value="'.$size.'">'.$size.'</option>';
    }

    $output .= '</select>';

    $output .= '<div class="preview-wrapper">';
        $output .= '<iframe id="preview-window" class="preview-window" src="'.$src.'" width="100%" height="600" seamless></iframe>';
    $output .= '</div>';

    return $output;
}
