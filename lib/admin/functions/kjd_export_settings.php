<?php
// $wp_dir = dirname(dirname( dirname( dirname( dirname (dirname( dirname(__FILE__) ) ) ) ) ) )  ;
// //        root >  wp-content > themes > kjd    > lib    > admin > functions  > this

// include( $wp_dir. '/wp-blog-header.php');
// include( $wp_dir. '/wp-admin/includes/plugin.php');

function kjd_get_settings(){


	global $wpdb;
	$get_kjd_options = $wpdb->get_results( 'SELECT * FROM `wp_options` WHERE `option_name` LIKE "kjd_%"' );	
	

	$output =  "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

	$output .= '<!DOCTYPE note SYSTEM "Note.dtd">';
	$output .= '<xml>';
		foreach($get_kjd_options as $option){
			$option->option_value = strip_tags(html_entity_decode( $option->option_value) );
			$output .= '<option>';
				$output .= '<name>';
					$output .= $option->option_name;
				$output .= '</name>';

				$output .= '<value>';
				$output .= $option->option_value;
				$output .= '</value>';
			$output .= '</option>'; 
		}
	$output .= '</xml>';

	file_put_contents("export.xml", $output);
	echo "<a href='export.xml' target='_blank'>Export database as XML</a>";

	
}


function kjd_import_settings(){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 20000)
	&& in_array($extension, 'xml'))
	  {
	  if ($_FILES["file"]["error"] > 0)
	    {
	    echo "Error: " . $_FILES["file"]["error"] . "<br>";
	    }
	  else
	    {
	    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	    echo "Type: " . $_FILES["file"]["type"] . "<br>";
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	    echo "Stored in: " . $_FILES["file"]["tmp_name"];
	    }
	  }
	else
	  {
	  echo "Invalid file";
	  }
	
}