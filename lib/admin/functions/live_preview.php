<?php 
echo 'boom';
$wp_dir = dirname(dirname( dirname( dirname( dirname (dirname( dirname(__FILE__) ) ) ) ) ) )  ;
//        root >  wp-content > themes > kjd    > lib    > admin > functions  > this

include( $wp_dir. '/wp-blog-header.php');
include( $wp_dir. '/wp-admin/includes/plugin.php');


/* ---------------------------------
        style using the post data
------------------------------------ */

if(isset($_POST['data']))
{
  $data = $_POST['data'];
  // print_r($data); die();
  include('styles.php');
  

  $root = dirname( dirname( dirname(__FILE__) ) ) ; 
  $file = $root.'/styles/preview.css';

  if(file_exists($file)){
    // chmod($file, 0777);
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