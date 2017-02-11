<?php


function kjd_get_settings(){


    global $wpdb;
    $get_kjd_options = $wpdb->get_results( 'SELECT * FROM `wp_options` WHERE `option_name` LIKE "kjd_%"' );
    	$output = '';

    header( 'Content-Description: File Transfer' );
    header( 'Content-Disposition: attachment; filename=advanced-custom-field-export.xml' );
    header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ), true );


    $output .=  '<?xml version="1.0" encoding="' . get_bloginfo('charset') . "\" ?>\n";


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


}
