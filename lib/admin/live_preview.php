<?php 

  $root=dirname(dirname(__FILE__)); 
  $root = $root.'/styles';
  $file = $root.'/preview.css';

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