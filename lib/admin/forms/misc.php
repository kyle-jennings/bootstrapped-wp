<?php


if($section =="header"){

	include('misc/header.php');
	kjd_header_misc_settings_callback($section);

}elseif($section =="login"){

	include('misc/login.php');
	kjd_login_misc_settings_callback($section);

}elseif($section =="navbar"){

	include('misc/navbar.php');
	kjd_navbar_misc_settings_callback($section);

}elseif($section =="dropdown-menu"){

	kjd_dropdown_misc_settings_callback($section);

}elseif($section =="mobileNav"){

	include('misc/mobile.php');
	kjd_mobileNav_misc_settings_callback($section);

}elseif($section =="pageTitle"){

	include('misc/title.php');
	kjd_title_misc_settings_callback($section);

}elseif($section =="body"){

	include('misc/body.php');
	kjd_body_misc_settings_callback($section);

}elseif($section =="posts"){

	include('misc/posts.php');
	kjd_posts_misc_settings_callback($section);	

}elseif($section =="footer"){

	include('misc/footer.php');
	kjd_footer_misc_settings_callback($section);

}



?>
<input  id="dropdown-id" type="hidden"
		name="kjd_<?php echo $section; ?>_misc_settings[kjd_<?php echo $section; ?>_tab]"
		value="<?php echo $options['kjd_'.$section.'_tab'] ? $options['kjd_'.$section.'_tab'] : 'none'; ?>"
  />
<?php

/**
* misc settings
*/
function kjd_confine_section_toggle($section, $options) {

	$option_markup ='';
	$option_markup .= '<div class="option">';
		$option_markup .= '<label>Confine Background?</label>';
		$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][kjd_'.$section.'_confine_background]">';
			$option_markup .= '<option value="true" '. selected( $options['kjd_'.$section.'_confine_background'], 'true', false) .'>Yes</option>';
			$option_markup .= '<option value="false" '. selected( $options['kjd_'.$section.'_confine_background'], 'false', false ) .'>No</option>';
		$option_markup .= '</select>';
	$option_markup .= '</div>';

	return $option_markup;
}

function kjd_float_section_toggle($section, $options) {

	$option_markup ='';
	$option_markup .= '<div class="option float-toggle">';
		$option_markup .= '<label>Float Section?</label>';
		$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][float]">';
				$option_markup .= '<option value="true" '.selected( $options["float"], "true", false) .'>Yes</option>';
				$option_markup .= '<option value="false" '.selected( $options["float"], "false", false) .'>No</option>';
		$option_markup .= '</select>';
	$option_markup .= '</div>';
	
	return $option_markup;
}

function kjd_set_section_margin($section, $options) {
	$option_markup ='';
	
	$toggle_class = $options['float'] =='true' ? 'style="display:block;"' : 'style="display:none;"' ;
	$margin_top_toggle = $options['margin_top'] ? $options['margin_top'] : '0';
	$margin_bottom_toggle = $options['margin_bottom'] ? $options['margin_bottom'] : '0';

	$option_markup .= '<div class="option float-option" '. $toggle_class .'>';
		$option_markup .= '<label>Floated Section Margin</label>';
		$option_markup .= '<div class="margin-label"><span>Top</span>';
			$option_markup .= '<input name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][margin_top]" ';
				$option_markup .= 'value="'. $margin_top_toggle .'"';
				$option_markup .= 'style="width:40px;"/>px.';
		$option_markup .= '</div>';
	$option_markup .= '<div class="margin-label"><span>Bottom</span>';
		$option_markup .= '<input name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][margin_bottom]" ';
			$option_markup .= 'value="'. $margin_bottom_toggle .'"';
			$option_markup .= 'style="width:40px;"/>px.';
		$option_markup .= '</div>';
	$option_markup .= '</div>';

	return $option_markup;
}



function kjd_section_glow_toggle($section, $options) {
	
	$sides = array('none','left and right','top and bottom', 'top','bottom', 'all sides');

	$option_markup = '';
	$option_markup .= '<div class="option">';
	$option_markup .= '<label>Outer glow</label>';
	$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc]['.$section.'_section_shadow]">';

	foreach($sides as $shadow){ 
			$option_markup .= '<option value="'.$shadow.'" '.selected( $options[$section.'_section_shadow'], $shadow, false) . '>';
				$option_markup .= $shadow;
			$option_markup .= '</option>';
	}

	$option_markup .= '</select>';
	$option_markup .= '</div>';
return $option_markup;
}