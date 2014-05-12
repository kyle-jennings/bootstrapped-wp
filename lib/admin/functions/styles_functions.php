<?php

/* ---------------------------------------------------------------- 
					image cycler settings
------------------------------------------------------------------- */

function kjd_image_cycler_settings_callback($kjd_section_misc_settings){
		$cycler_output = '';

		if($kjd_section_misc_settings['shadow'] == "true"){ 
			$cycler_output .= '#imageSlider{';
				$cycler_output .= 'background:url(../images/shadow.png) no-repeat bottom center; ';
				$cycler_output .= 'padding:20px 0 60px; ';
			$cycler_output .= '}';
		}

		if($kjd_section_misc_settings['plugin'] == "single image"){
	
			$cycler_output .=".singleImage{
						background:".$kjd_section_misc_settings['backgroundColor'].";
						border:".$kjd_section_misc_settings['borderSize']." ".$kjd_section_misc_settings['borderColor']." solid; 
						-webkit-border-radius:".$kjd_section_misc_settings['borderRadius'].";
						-moz-border-radius:".$kjd_section_misc_settings['borderRadius'].";
						border-radius:".$kjd_section_misc_settings['borderRadius'].";
						}";

			if($kjd_section_misc_settings['borderTransparency'] == 'true'){ 
				$cycler_output .=".singleImage{
									-moz-background-clip: border;    
									-webkit-background-clip: border;  
									background-clip: border-box;
								}";
			}
			
			if($kjd_section_misc_settings['singleCaption'] == "top"){
				$cycler_output .=".singleImage .caption{left:50%; width:100%;}";
			}elseif($kjd_section_misc_settings['singleCaption'] == "right"){
				$cycler_output .=".singleImage .caption{ width:25%;}";
			}elseif($kjd_section_misc_settings['singleCaption'] == "bottom"){
				$cycler_output .=".singleImage .caption{left:50%; width:100%;}";
			}elseif($kjd_section_misc_settings['singleCaption'] == "left"){
				$cycler_output .=".singleImage .caption{ width:25%;}";
			}else{
				$cycler_output .=".singleImage .caption{display:none !important;}";
			}

		}elseif($kjd_section_misc_settings['plugin'] == "nivo"){
			
			if($kjd_section_misc_settings['nivoCaption'] == "top"){
				$cycler_output .=".nivo-caption{top:0; bottom:auto !important;}";
			}elseif($kjd_section_misc_settings['nivoCaption'] == "right"){
				$cycler_output .=".nivo-caption{height:100% !important; left:auto !important; right:0  !important; width:25%  !important;}";
			}elseif($kjd_section_misc_settings['nivoCaption'] == "bottom"){ 
				
			}elseif($kjd_section_misc_settings['nivoCaption'] == "left"){ 
				$cycler_output .=".nivo-caption{height:100% !important; width:25% !important;}";
			}else{ 
				$cycler_output .=".nivo-caption{display:none !important;}";
			}

		}

		return $cycler_output;
}

/* ----------------------------------------------------------------------------- *
						background functions
----------------------------------------------------------------------------- */

 //background type takes the $type argument and uses it to return the appropriate function
function background_type_callback($type = null,$kjd_section_background_colors = array(), $section = null ){


	if( !empty($kjd_section_background_colors) )
		extract($kjd_section_background_colors); 

	$start_color = !empty($kjd_section_background_colors['start_rgba']) ?
					$kjd_section_background_colors['start_rgba'] : 
					$kjd_section_background_colors['color'];
	$end_color = !empty($kjd_section_background_colors['endcolor']) ? 
					$kjd_section_background_colors['endcolor'] : 
					$kjd_section_background_colors['endcolor'];

	// $start_color =  $kjd_section_background_colors['color'];
	// $end_color =  $kjd_section_background_colors['endcolor'];

	$background_type = '';
	if($type =='vertical'){
		$background_type .= verticalGradientCallback($start_color, $end_color);
	}elseif($type =='horizontal'){ 
		$background_type .= horizontalGradientCallback($start_color, $end_color);
	}elseif($type =='radial'){ 
		$background_type .= radialGradientCallback($start_color, $end_color);
	}elseif($type =='solid'){
		$background_type .= 'background-color: '.$start_color.';';
		$background_type .= verticalGradientCallback($start_color, $start_color);
	}elseif($type =='none'){
		$background_type .= 'background-color:transparent;';
		$background_type .= 'background-image: none;';
	}elseif($type =='bootstrap_default'){

	}
	
	return $background_type;
}



////////////////////////
// vertical gradient
function verticalGradientCallback($startColor, $endColor, $section = null){ 
$gradient_markup = '';
	if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor = $startColor;
		}

		$gradient_markup .= 'background-color: '.$startColor.';';
		$gradient_markup .= 'background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from('.$startColor.'), to('.$endColor.'));';
		$gradient_markup .= 'background-image: -webkit-linear-gradient(top, '.$startColor.', '.$endColor.');';
		$gradient_markup .= 'background-image: -moz-linear-gradient(top, '.$startColor.', '.$endColor.');';
		$gradient_markup .= 'background-image: -ms-linear-gradient(top, '.$startColor.', '.$endColor.');';
		$gradient_markup .= 'background-image: -o-linear-gradient(top, '.$startColor.', '.$endColor.');';
		$gradient_markup .= 'filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr="'.$startColor.'", endColorstr="'.$endColor.'");';
		$gradient_markup .= '-ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr="'.$startColor.'", endColorstr="'.$endColor.'")";';
	}
	return $gradient_markup;
}// end vertical 

// ////////////////////////
// // horizontal gradient
function horizontalGradientCallback($startColor, $endColor){ 
	$gradient_markup = '';
if(isset($startColor) && $startColor !=""){ 
		if(empty($endcolor) || !isset($endcolor) || $endcolor == "" || $endcolor == " "){
			$endcolor = $startColor;
		}

		$gradient_markup .= 'background-color: '.$startColor.';';
		$gradient_markup .= 'background-image: -webkit-gradient(linear, left top, right top, from('.$startColor.'), color-stop(0.5,  '.$endColor.'), to( '.$startColor.'));';
		$gradient_markup .= 'background-image: -webkit-linear-gradient(left, '.$startColor.', '.$endColor.','.$startColor.');';
		$gradient_markup .= 'background-image: -moz-linear-gradient(left, '.$startColor.', '.$endColor.','.$startColor.');';
		$gradient_markup .= 'background-image: -ms-linear-gradient(left, '.$startColor.', '.$endColor.','.$startColor.');';
		$gradient_markup .= 'background-image: -o-linear-gradient(left, '.$startColor.', '.$endColor.','.$startColor.');';
		$gradient_markup .= 'filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr="'.$startColor.'", endColorstr="'.$endColor.'");';
		$gradient_markup .= '-ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr="'.$startColor.'", endColorstr="'.$endColor.'")";';
		}

		return $gradient_markup;
}

// ////////////////////////
// // radial Gradient
function radialGradientCallback($startColor, $endColor){
	$gradient_markup = '';
	if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor = $startColor;
		}
			$gradient_markup .= 'background-color: '.$startColor.';';
			$gradient_markup .= 'background-image: -webkit-gradient(radial, center center, 0, center center, 460, from('.$startColor.'), to('.$endColor.'));';
			$gradient_markup .= 'background-image: -webkit-radial-gradient(circle, '.$startColor.', '.$endColor.');';
			$gradient_markup .= 'background-image: -moz-radial-gradient(circle, '.$startColor.', '.$endColor.');';
			$gradient_markup .= 'background-image: -ms-radial-gradient(circle, '.$startColor.', '.$endColor.');';
		}
		return $gradient_markup;
}
// /* ------------------------- wallpaper settings -----------------------------*/
function wallpaper_callback($kjd_section_background_wallpaper){
	$backgroundImage = $kjd_section_background_wallpaper['image'];
	
	$backgroundPosition = $kjd_section_background_wallpaper['position'];
	$backgroundPositionX = !empty($kjd_section_background_wallpaper['positionX'])? $kjd_section_background_wallpaper['positionX'] : '0' ;
	$backgroundPositionY = !empty($kjd_section_background_wallpaper['positionY'])? $kjd_section_background_wallpaper['positionY'] : '0' ;
	$backgroundRepeat = $kjd_section_background_wallpaper['repeat'];

	$backgroundSize = $kjd_section_background_wallpaper['size'];
	$backgroundPercentage = !empty($kjd_section_background_wallpaper['percentage'])? $kjd_section_background_wallpaper['percentage'] : '0' ;;

	$wallpaper_markup ='';

	if(!empty($kjd_section_background_wallpaper['attachment'])){
		$wallpaper_markup .= 'background-attachment:'.$kjd_section_background_wallpaper['attachment'].';';	
	}

	if($kjd_section_background_wallpaper['use_wallpaper']=='true'){

		if(isset($backgroundImage) && $backgroundImage!=""){
			$wallpaper_markup .= 'background-image:url('.$backgroundImage.');';
		}
		if(isset($backgroundPosition) && $backgroundPosition!="" && $backgroundPosition !='custom'){
			$wallpaper_markup .= 'background-position:'.$backgroundPosition.';';	
		}

		if(isset($backgroundPosition) && $backgroundPosition=="custom"){
			$wallpaper_markup .= 'background-position:'.$backgroundPositionX.'px '.$backgroundPositionY.'px;';	
		}
		if(isset($backgroundRepeat) && $backgroundRepeat!=""){
			$wallpaper_markup .= 'background-repeat:'.$backgroundRepeat.';';	
		}

		if( isset($backgroundSize) && $backgroundSize != 'default'){
			if( $backgroundSize == 'percentage' ){

				$wallpaper_markup .= 'background-size:'.$backgroundPercentage .'% auto ;';

			}else{

				$wallpaper_markup .= 'background-size:'.$backgroundSize .';';
			}
		}

	}
	return $wallpaper_markup;
}





// /* ------------------------- border settings -----------------------------*/
function borderSettingsCallback($position, $border){
//	extract($sectionBorders); //

	$border_style_markup = '';

	$borderStyle = $border['style'];
	$borderColor = $border['color'];
	$borderSize = $border['size'];

	// if(isset($borderStyle) && $borderStyle!="none"){
		$border_style_markup .= 'border-'.$position.'-style:'.$borderStyle.';';

		if (isset($borderColor)&& !empty($borderColor)){
			$border_style_markup .= 'border-'.$position.'-color:'.$borderColor.';';
		}
		if (isset($borderSize) && !empty($borderSize)){
			$border_style_markup .= 'border-'.$position.'-width:'.$borderSize.';'; 
		}
	// }


	return $border_style_markup;
}

// /* ------------------------- border-radius -----------------------------*/
function borderRadiusCallback($position, $radius){
	$border_radius_markup = '';
	if(isset($radius) && $radius!=""){ 

		$border_radius_markup .= '-webkit-border-'.$position.'-radius: '.$radius.';';
		$border_radius_markup .= '-webkit-border-'.$position.'-radius: '.$radius.';';
		$border_radius_markup .= '-webkit-border-'.$position.'-radius: '.$radius.';';
		$border_radius_markup .= '-webkit-border-'.$position.'-radius: '.$radius.';';
		$border_radius_markup .= 'border-'.$position.'-radius: '.$radius.';';
		$border_radius_markup .= 'border-'.$position.'-radius: '.$radius.';';
		$border_radius_markup .= 'border-'.$position.'-radius: '.$radius.';';
		$border_radius_markup .= 'border-'.$position.'-radius: '.$radius.';';
		
		$position = str_replace('-', '', $position);
		
		$border_radius_markup .= '-moz-border-radius-'.$position.': '.$radius.';';
		$border_radius_markup .= '-moz-border-radius-'.$position.': '.$radius.';';
		$border_radius_markup .= '-moz-border-radius-'.$position.': '.$radius.';';
		$border_radius_markup .= '-moz-border-radius-'.$position.': '.$radius.';';

	}

	return $border_radius_markup;
}

// /* ------------------------- htag settings ----------------------------*/
function hTagSettingsCallback($hTag){
	$color = $hTag['color'];
	$decoration = $hTag['decoration'];
	$shadow = $hTag['textShadowColor'] ? $hTag['textShadowColor'] : 'rgba(0,0,0,.6)' ;
	$bg_style = $hTag['bg_style'];
	$bg_color = $hTag['bg_color']; 
	$border_style = $hTag['border_style'];
	$border_color = $hTag['border_color'];

	$htag_markup = '';
	 if($bg_style == 'pills' || $bg_style == "squared"){
 		$htag_markup .= 'background-color:'.$bg_color.';';
 		
 		if($bg_style == 'pills' ){
			$htag_markup .= 'border-radius: 4px;';
 		}

		$htag_markup .= 'word-break:hypenate;';

	}elseif($bg_style =='tabs'){
		$htag_markup .= 'background-color:'.$bg_color.';';
   		$htag_markup .= 'border-radius: 4px 4px 0 0;';
   		$htag_markup .= 'padding: 15px 0;';
    	$htag_markup .= 'line-height: 20px;';
	}


	if(isset($border_style) && !empty($border_style)){
		$htag_markup .= 'border-style:'.$border_style.';';
		$htag_markup .= 'border-width:1px;';
	}
	if(isset($border_color) && $border_color !='' && $border_color != ' '){ 
		$htag_markup .= 'border-color:'.$border_color.';';
	}
	

	if(isset($color) && $color!=""){
		$htag_markup .= 'color:'.$color.';';
	}
	if(isset($decoration) && $decoration!=""){
		$htag_markup .= 'text-decoration:'.$decoration.';';
	}
	if($decoration=="text-shadow"){
		$htag_markup .= 'text-shadow:2px 2px '.$shadow.' !important;';
	}

	return $htag_markup;
}

// /* ------------------------- links -----------------------------*/
function linkSettingsCallback($link, $section){


	$bg_style = $link['bg_style'];
	$bg_color = $link['bg_color'];
	$color = $link['color'];
	$decoration = $link['decoration'];
	$shadow = $link['text_shadow'];	
	$shadow_color = $link['textShadowColor'];	


	$link_style_markup = '';
	 if($bg_style == 'pills'){
		$link_style_markup .= 'background:'.$bg_color.';';
		$link_style_markup .= 'padding:4px 6px;';
		$link_style_markup .= 'border-radius: 4px;';
		$link_style_markup .= 'word-break:hyphenate;';
	}elseif( $bg_style == "highlighted" ){
		$link_style_markup .= 'background:'.$bg_color.';';
	}
	
	if(isset($color) && $color!=""){
		$link_style_markup .= 'color:'.$color.';';
	}
	
	if(isset($decoration) && $decoration!=""){
		$link_style_markup .= 'text-decoration:'.$decoration.';';
	}

	if($decoration == 'text-shadow'){
		if(isset($shadow_color) && $shadow_color!=""){
			$link_style_markup .= 'text-shadow:2px 2px 2px'.$shadow_color.';';
		}
	
	}
	

	return $link_style_markup;
}


/* -------------------------------------------------- 
tables 
------------------------------------------------------*/
function tableMarkupCallback($section_name, $table_content, $section){
$table_markup = '';


	$table_markup .= '#'. $section.' .table,';
	$table_markup .= '#'. $section.' .table td,';
	$table_markup .= '#'. $section.' .table th{';
		$table_markup .= 'border-color:'.$table_content['table_border'].';';
	$table_markup .= '}';

	$table_markup .= '#'.$section.' .table thead,';
	$table_markup .= '#'.$section.' .table tfoot{';
		$table_markup .= 'color:'.$table_content['table_header_text_color'].';';
		$table_markup .= 'background:'.$table_content['table_header_background'].';';
		$table_markup .= 'border-color:'.$table_content['table_border'].';';
	$table_markup .= '}';

	$table_markup .= '#'.$section.' .table thead a,';
	$table_markup .= '#'.$section.' .table tfoot a{';
		$table_markup .= 'color:'.$table_content['table_header_link_color'].';';
	$table_markup .= '}';

	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(even) td a{';
		$table_markup .= 'color:'.$table_content['even_row_link_color'].';';
	$table_markup .= '}';


	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(even) td,';
	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(even) th,';
	$table_markup .= '#'.$section.' .table tbody tr:nth-child(even) td{';
		$table_markup .= 'background:'.$table_content['even_row_background'].';';
		$table_markup .= 'color:'.$table_content['even_row_text_color'].';';
	$table_markup .= '}';

	
	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(odd) td,';
	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(odd) th{';
		$table_markup .= 'background:'.$table_content['odd_row_background'].';';
		$table_markup .= 'color:'.$table_content['odd_row_text_color'].';';
	$table_markup .= '}';

	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(odd) td a{';
		$table_markup .= 'color:'.$table_content['odd_row_link_color'].';';
	$table_markup .= '}';


	$table_markup .= '#'.$section.' .table-hover tbody tr:hover > td,';
	$table_markup .= '#'.$section.' .table-hover tbody tr:hover > td{';
		$table_markup .= 'background:'.$table_content['hovered_row_background'].';';
		$table_markup .= 'color:'.$table_content['hovered_row_text_color'].';';
	$table_markup .= '}';

	return $table_markup;
}


/* -------------------------------------------------- 
pagination 
---------------------------------------------------------------------------*/
function paginationMarkupCallback($section, $pagination_content){

$border = $pagination_content['pagination_border'];
$background  = $pagination_content['pagination_background'];
$text  = $pagination_content['pagination_text'];
$link  = $pagination_content['pagination_link'];
$background_hover  = $pagination_content['pagination_hover_background'];
$link_hover  = $pagination_content['pagination_hover_link'];
$background_current  = $pagination_content['pagination_current_background'];
$text_current  = $pagination_content['pagination_current_text'];

$pagination_markup = '';

	$pagination_markup .= '#body .pagination ul li > *,';
	$pagination_markup .= '#body .pagination ul > li > a, ';
		$pagination_markup .= '#body .pagination ul > li > span';
	$pagination_markup .= '{';
		$pagination_markup .= 'background:'. $background.' ;';
		$pagination_markup .= 'padding: 4px 12px;';
		$pagination_markup .= 'border-color:'. $border.' ;';
		
	$pagination_markup .= '}';

	$pagination_markup .= '#body .pagination ul > li span.current{';
		$pagination_markup .= 'background:'. $background_current.' ;';
		$pagination_markup .= 'color:'. $text_current.' ;';
	$pagination_markup .= '}';


	$pagination_markup .= '#body .pagination ul > li a.page-numbers';
	$pagination_markup .= '{';
		$pagination_markup .= 'color:'. $link.' ;';
		$pagination_markup .= 'border-radius: inherit;';
	$pagination_markup .= '}';

	$pagination_markup .= '#body .pagination ul > li > a:hover, ';
	$pagination_markup .= '#body .pagination ul > li > a:focus,';
	$pagination_markup .= '#body .pagination ul > .active > a,';
	$pagination_markup .=  '#body .pagination ul > .active > span';
	$pagination_markup .= '{';
		$pagination_markup .= 'background:'.$background_hover.' ;';
		$pagination_markup .= 'padding: 4px 12px;';
		$pagination_markup .= 'color:'. $link_hover.' ;';
	$pagination_markup .= '}';


	$pagination_markup .= '#body .pagination ul > li span.page-numbers';
	$pagination_markup .= '{';
		$pagination_markup .= 'color:'. $text.' ;';
		$pagination_markup .= 'text-shadow: none ;';
	$pagination_markup .= '}';

$pagination_markup .= '#body .pagination ul > li:last-child > a,';
$pagination_markup .= '#body .pagination ul > li:last-child > span {';
    $pagination_markup .= 'border-bottom-right-radius: 4px;';
    $pagination_markup .= 'border-top-right-radius: 4px;';
$pagination_markup .= '}';

return $pagination_markup;
}

/* -------------------------------------------------- 
Lists 
--------------------------------------------------*/
function listsMarkupCallback($section, $list){

	$background = !empty($list['background_color']) ? $list['background_color'] : 'transparent' ;
	$background_hover = !empty($list['background_hover_color']) ? $list['background_hover_color'] : 'transparent';

	$list_markup = '';
	$list_markup .= $section.' .content-nav.li > nav > span{';
		$list_markup .= 'color:'.$list['text_color'].';';
	$list_markup .= '}';

	$list_markup .= $section.' .content-nav.nav > li > span:hover{';
		$list_markup .= 'color:'.$list['text_hover_color'].';';
	$list_markup .= '}';

	$list_markup .= $section.' .content-nav.nav > li > a,';
	$list_markup .= $section.' .content-nav.nav > li > span {';
		$list_markup .= 'background-color:'.$background.';';
		$list_markup .= 'border-color:'.$list['border_color'].';';
	$list_markup .= '}';

	$list_markup .= $section.' .content-nav.nav > li > a{';
		$list_markup .= 'color:'.$list['link_color'].';';
	$list_markup .= '}';

	$list_markup .= $section.' .content-nav.nav > li > a:hover,';
	$list_markup .= $section.' .content-nav.nav > li.current-menu-item > a,';
	$list_markup .= $section.' .content-nav.nav > li > span:hover {';
		$list_markup .= 'background-color:'.$background_hover.';';
		$list_markup .= 'border-color:'.$list['border_hover_color'].';';
	$list_markup .= '}';

	$list_markup .= $section.' .content-nav.nav > li > a:hover,';
	$list_markup .= $section.' .content-nav.nav > li.current-menu-item > a{';
		$list_markup .= 'color:'.$list['link_hover_color'].';';	
	$list_markup .= '}';

	return $list_markup;

}

/* -------------------------------------------------- 
forms 
------------------------------------------------------*/
function formsMarkupCallback($section_name, $forms, $section){

$form_markup = '';
$form_markup .= $section_name.' form{';
	$form_markup .= 'background:'. $forms['form_background'].' ; ';
	if( $forms['form_border'] && isset($forms['form_border']) ){
		$form_markup .= 'border:1px solid '. $forms['form_border'].';';
		
	}
	$form_markup .= 'color:'. $forms['form_text'].';';

if( (isset($forms['form_background']) && $forms['form_background']!= '' && $forms['form_background']!= ' ' ) || (isset($forms['container_border']) && $forms['container_border']!= '' && $forms['container_border']!= ' ') ){
	$form_markup .= ' "padding:10px; border-radius:4px;";';
}
$form_markup .= '}';


//input areas
$form_markup .= $section_name.' input[type="radio"],'; 
$form_markup .= $section_name.' input[type="checkbox"],';
$form_markup .= $section_name.' textarea,';
$form_markup .= $section_name.' input[type="text"],';
$form_markup .= $section_name.' input[type="password"],';
$form_markup .= $section_name.' input[type="datetime"],';
$form_markup .= $section_name.' input[type="datetime-local"],';
$form_markup .= $section_name.' input[type="date"],';
$form_markup .= $section_name.' input[type="month"],';
$form_markup .= $section_name.' input[type="time"],';
$form_markup .= $section_name.' input[type="week"],';
$form_markup .= $section_name.' input[type="number"],';
$form_markup .= $section_name.' input[type="email"],';
$form_markup .= $section_name.' input[type="url"],';
$form_markup .= $section_name.' input[type="search"],';
$form_markup .= $section_name.' input[type="tel"],';
$form_markup .= $section_name.' input[type="color"],';
$form_markup .= $section_name.' select,';
$form_markup .= $section_name.' input[type="file"] {';
	$form_markup .= 'color:'. $forms['field_text'].';';
	$form_markup .= 'background:'. $forms['field_background'].';';
	$form_markup .= 'border-color:'. $forms['field_border'].';';
$form_markup .= '}';

//input areas on focus
$form_markup .= $section_name.' input[type="radio"]:focus, '
. $section_name .' input[type="checkbox"]:focus, '
. $section_name .' textarea:focus,'
. $section_name .'  input[type="text"]:focus,'
. $section_name .'  input[type="password"]:focus,'
. $section_name .'  input[type="datetime"]:focus,'
. $section_name .'  input[type="datetime-local"]:focus,'
. $section_name .'  input[type="date"]:focus,'
. $section_name .'  input[type="month"]:focus,'
. $section_name .'  input[type="time"]:focus,'
. $section_name .'  input[type="week"]:focus,'
. $section_name .'  input[type="number"]:focus,'
. $section_name .'  input[type="email"]:focus,'
. $section_name .'  input[type="url"]:focus,'
. $section_name .'  input[type="search"]:focus,'
. $section_name .'  input[type="tel"]:focus,'
. $section_name .'  input[type="color"]:focus,'
. $section_name .'  .uneditable-input:focus {';
	$form_markup .= 'border-color: :'. $forms['field_border'].';';
	$form_markup .= 'box-shadow: 0 0 8px '. $forms['field_glow'].';';
$form_markup .= '}';

$form_markup .= $section_name.' form button,';
$form_markup .= $section_name.' form input[type=submit],';
$form_markup .= $section_name.' form .btn {';
	$form_markup .= 'background-image:none;';
	$form_markup .= verticalGradientCallback($forms['button_background'], $forms['button_background_end']);
	$form_markup .= 'border-color:'. $forms['button_border'].' !important;';
	$form_markup .= 'color:'. $forms['button_text'].' !important;';
$form_markup .= '}';

//form buttons - mostly the submit button on hover
$form_markup .= $section_name.' form button:hover,';
$form_markup .= $section_name.' form input[type=submit]:hover,';
$form_markup .= $section_name.' form .btn:hover{';
	$form_markup .= 'background-color:'. $forms['button_background_end'].' !important;';
	$form_markup .= '}';

	return $form_markup;
}

/* ------------------------------------------------------ 
Navlists
------------------------------------------------------ */
function nav_list_markup_callback($section_name, $forms, $section){
	$markup ='';

	$markup .= $section_name . ' .nav-list nav-stacked{';
		$markup .= 'color:;';
	$markup .= '}';

	$markup .= $section_name . ' .nav-list nav-stacked a{';
		$markup .= 'color:;';
	$markup .= '}';

	$markup .= $section_name . ' .nav-list nav-stacked a:hover{';
		$markup .= 'color:;';
	$markup .= '}';

	return;
}

/* ------------------------------------------------------ 
Collapsibles -
------------------------------------------------------ */
function collapsibleMarkupCallback($section, $collapsible_content)
{
	$collapsible_markup =''; 
$collapsible_markup .= $section.' .accordion-group{';
$collapsible_markup .= 'background:'. $collapsible_content['collapible_content_background'].'; ';
$collapsible_markup .= 'border-color:'. $collapsible_content['collapible_content_border'].' ;';
$collapsible_markup .= '}';
/*the title*/
$collapsible_markup .= $section.' .accordion-heading > a.collapsed{';
$collapsible_markup .= 'background:'. $collapsible_content['inactive_title_background'].'; ';
$collapsible_markup .= 'color:'. $collapsible_content['inactive_title_link_color'].';';
$collapsible_markup .= '}';
$collapsible_markup .= $section.' .accordion-heading a{';
$collapsible_markup .= 'background:'. $collapsible_content['active_title_background'].'; ';
$collapsible_markup .= 'color:'. $collapsible_content['active_title_link_color'].';';
$collapsible_markup .= '}';
/* when closed*/
$collapsible_markup .= $section.' .accordion-heading > .collapsed{';
$collapsible_markup .= 'background:'. $collapsible_content['inactive_title_background'].' ;';
$collapsible_markup .= 'color:'. $collapsible_content['inactive_title_link_color'].' ;';
$collapsible_markup .= '}';
$collapsible_markup .= $section.' .accordion-heading a:hover{';
$collapsible_markup .= 'background:'. $collapsible_content['hovered_title_background'].' ;';
$collapsible_markup .= 'color:'. $collapsible_content['hovered_title_link_color'].' ;';
$collapsible_markup .= '}';
/*the content */
$collapsible_markup .= $section.' .accordion-inner {';
$collapsible_markup .= 'border-top-color:'. $collapsible_content['collapible_content_border'].' ;';
$collapsible_markup .= 'color:'. $collapsible_content['collapible_content_text_color'].';';
$collapsible_markup .= '}';

/*the content */
$collapsible_markup .= $section.' .accordion-inner a{';
$collapsible_markup .= 'color:'. $collapsible_content['collapible_content_link_color'].';';
$collapsible_markup .= '}';


$collapsible_markup .= $section.' .accordion-heading > a.collapsed, ';
$collapsible_markup .= $section.' .accordion-heading >a,';
$collapsible_markup .= $section.' .accordion-heading >a:hover{ text-decoration:none ;}';

return $collapsible_markup;
}





/* --------------------------------------------------  
Tabbed content 
-----------------------------------------------------------*/
function tabbedMarkupCallback($section, $tabbed_content){
$tabbed_markup = '';

$tabbed_markup .= $section.' .tabbable > ul.nav{';
	$tabbed_markup .= 'border: 0px !important; margin:0;';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabbable > ul.nav > li > a{ ';
	$tabbed_markup .= 'background:'. $tabbed_content['inactive_tab_background'].'; ';
	$tabbed_markup .= 'border-color:'. $tabbed_content['inactive_tab_border'].'; ';
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['inactive_tab_border'].' ; ';
	$tabbed_markup .= 'color:'. $tabbed_content['inactive_tab_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabbable > ul.nav > li > a:hover{';
	$tabbed_markup .= 'background:'. $tabbed_content['hovered_tab_background'].';';
	$tabbed_markup .= 'border-color:'. $tabbed_content['hovered_tab_border'].'; ';
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['hovered_tab_border'].' ; ';	
	$tabbed_markup .= 'color:'. $tabbed_content['hovered_tab_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabbable > ul.nav > li.active > a{';
	$tabbed_markup .= 'background:'. $tabbed_content['tabbed_content_background'].';';
	$tabbed_markup .= 'border-color:'. $tabbed_content['active_tab_border'].'; ';
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['active_tab_border'].' ; ';	
	$tabbed_markup .= 'color:'. $tabbed_content['active_tab_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabbable > .tab-content{';
	$tabbed_markup .= 'background:'. $tabbed_content['tabbed_content_background'].'; ';
	$tabbed_markup .= 'border-color:'. $tabbed_content['tabbed_content_border'].'; ';
	$tabbed_markup .= 'color:'. $tabbed_content['tabbed_content_text_color'].';';
	$tabbed_markup .= 'border-style: solid; border-width: 1px; padding:20px;';
$tabbed_markup .= '}';


$tabbed_markup .= $section.' .tabbable > .tab-content a{';
$tabbed_markup .= 'color:'. $tabbed_content['tabbed_content_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabbable > .tab-content > a{';
	$tabbed_markup .= 'color:'. $tabbed_content['tabbed_content_link_color'].';';
$tabbed_markup .= '}';

/* tabs on teh left */
$tabbed_markup .= $section.' .tabs-left > ul.nav > li > a{';
	$tabbed_markup .= 'border-right-color:'. $tabbed_content['tabbed_content_border'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabs-left > ul.nav > li.active > a{';
	$tabbed_markup .= 'border-right-color:'. $tabbed_content['tabbed_content_background'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabs-left > ul.nav > li > a:hover{';
	$tabbed_markup .= 'border-right-color:'. $tabbed_content['tabbed_content_background'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabs-left .tab-content{';
$tabbed_markup .= '-webkit-border-radius: 4px;';
$tabbed_markup .= '-webkit-border-top-left-radius: 0;';
$tabbed_markup .= '-moz-border-radius: 4px;';
$tabbed_markup .= '-moz-border-radius-topleft: 0;';
$tabbed_markup .= 'border-radius: 4px;';
$tabbed_markup .= 'border-top-left-radius: 0;';
$tabbed_markup .= '}';

// tabs on teh right
$tabbed_markup .= $section.' .tabs-right > ul.nav > li > a{';
$tabbed_markup .= 'border-left-color:'. $tabbed_content['tabbed_content_border'].'; ';

$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabs-right > ul.nav > li.active > a{';
$tabbed_markup .= 'border-left-color:'. $tabbed_content['tabbed_content_background'].'; ';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabs-right > ul.nav > li > a:hover{';
$tabbed_markup .= 'border-left-color:'. $tabbed_content['tabbed_content_background'].'; ';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabs-right .tab-content{';
$tabbed_markup .= '-webkit-border-radius: 4px;';
$tabbed_markup .= '-webkit-border-top-right-radius: 0;';
$tabbed_markup .= '-moz-border-radius: 4px;';
$tabbed_markup .= '-moz-border-radius-topright: 0;';
$tabbed_markup .= 'border-radius: 4px;';
$tabbed_markup .= 'border-top-right-radius: 0;';
$tabbed_markup .= '}';

// normal tabs
$tabbed_markup .= $section.' .tabbable.tabs > ul.nav > li a{';
$tabbed_markup .= 'border-bottom-color:'. $tabbed_content['tabbed_content_border'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabbable.tabs > ul.nav > li.active a{';
$tabbed_markup .= 'border-bottom-color:'. $tabbed_content['tabbed_content_background'].';';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabbable.tabs > ul.nav > li a:hover{';
$tabbed_markup .= 'border-bottom-color:'. $tabbed_content['tabbed_content_background'].';';
$tabbed_markup .= '}';


$tabbed_markup .= $section.' .tabbable.tabs .tab-content{';
$tabbed_markup .= '-webkit-border-radius: 4px;';
$tabbed_markup .= '-webkit-border-top-left-radius: 0;';
$tabbed_markup .= '-moz-border-radius: 4px;';
$tabbed_markup .= '-moz-border-radius-topleft: 0;';
$tabbed_markup .= 'border-radius: 4px;';
$tabbed_markup .= 'border-top-left-radius: 0;';
$tabbed_markup .= '}';

// tabs on the bottom
$tabbed_markup .= $section.' .tabs-below > ul.nav > li > a{';
	$tabbed_markup .= 'border-top-color:'. $tabbed_content['tabbed_content_border'].'; ';
$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabs-below > ul.nav > li.active > a{';
	$tabbed_markup .= 'border-top-color:'. $tabbed_content['tabbed_content_background'].'; ';

$tabbed_markup .= '}';
$tabbed_markup .= $section.' .tabs-below > ul.nav > li > a:hover{';
	$tabbed_markup .= 'border-top-color:'. $tabbed_content['tabbed_content_background'].'; ';

$tabbed_markup .= '}';

$tabbed_markup .= $section.' .tabs-below .tab-content{';
	$tabbed_markup .= '-webkit-border-radius: 4px;';
	$tabbed_markup .= '-webkit-border-bottom-left-radius: 0;';
	$tabbed_markup .= '-moz-border-radius: 4px;';
	$tabbed_markup .= '-moz-border-radius-bottomleft: 0;';
	$tabbed_markup .= 'border-radius: 4px;';
	$tabbed_markup .= 'border-bottom-left-radius: 0;';
$tabbed_markup .= '}';

return $tabbed_markup;
}	

/* ---------------------------------------------------------
images
-------------------------------------------------------------*/
function imagesMarkupCallback($section_name, $images, $section){

	$image_markup = '';
	$imageBackgroundColor = $images['background_color'];
	$imageBorderColor = $images['border_color'];
	$imageBackgroucaptionsr = $images['backgroundcaptions'];
	$imageBorderSize = $images['border_size'];
	$imagecaptionsColor = $images['bordercaptions'];
	$imageBorderStyle = $images['border_style'];
	$imacaptionserSize = $images['bordecaptions'];
	$imagePadding = $images['padding'];
	$imagecaptionsStyle = $images['bordercaptions'];
	$imageBorderRadius = $images['border_radius'];

	// $image_markup .= $images['border_captions'];
	$image_markup .= $section_name.' img {';
		$image_markup .= 'background:'.$imageBackgroundColor.';';
		$image_markup .= 'border:'.$imageBorderColor.' '.$imageBorderSize.' '.$imageBorderStyle .';';
		$image_markup .= 'padding:'.$imagePadding.';';
		$image_markup .= 'border-radius:'.$imageBorderRadius.';';
	$image_markup .= '}';

	return $image_markup;
}


//images
function captionImagesMarkupCallback($section,$captions){

	$captionBackgroundColor = $captions['background_color'] ? $captions['background_color'] : 'transparent';
	$captionBorderColor = $captions['border_color'] ? $captions['border_color'] : 'transparent';
	$captionBorderSize = $captions['border_size'] ? $captions['border_size'] : '0px' ;
	$captionBorderStyle = $captions['border_style'] ? $captions['border_style'] : 'none' ;
	$captionText = $captions['text_color'];
	$captionPadding = $captions['padding'] ? $captions['padding'] : '0px';
	$captionBorderRadius = $captions['border_radius'] ? $captions['border_radius'] : '0px' ;
	$captionGlow = $captions['thumbnail_glow'] ? $captions['thumbnail_glow'] : 'transparent';

	
	$caption_markup = '';
	$caption_markup .= $section.' .wp-caption img{';
		$caption_markup .='padding: 0; border: none;';
		$caption_markup .= 'border-radius:'.$captionBorderRadius.';';
	$caption_markup .= '}';

	$caption_markup .= $section.' .wp-caption{';
		$caption_markup .= 'background:'.$captionBackgroundColor.';';
		$caption_markup .= 'border:'.$captionBorderColor.' '.$captionBorderSize.' '.$captionBorderStyle .';';
		$caption_markup .= 'color:'.$captionText.';';
		$caption_markup .= 'border-radius:'.$captionBorderRadius.';';
	$caption_markup .= '}';

	$caption_markup .= $section.' .wp-caption:hover{';
	    $caption_markup .= 'box-shadow: 0 2px 2px rgba(0, 0, 0, 0.075) inset, 0 0 2px '.$captionGlow.' ;';
	$caption_markup .='}';	

	return $caption_markup;
}

// thumbnails
function thumbnailsMarkupCallback($section, $thumbnails){
$thumbnail_markup ='';

	$thumbnailBackgroundColor = $thumbnails['background_color'];
	$thumbnailGlow = $thumbnails['thumbnail_glow'];
	$thumbnailBorderColor = $thumbnails['border_color'];
	$thumbnailBorderSize = $thumbnails['border_size'];
	$thumbnailBorderStyle = $thumbnails['border_style'];
	$thumbnailPadding = $thumbnails['padding'];
	$thumbnailBorderRadius = $thumbnails['border_radius'];


	$thumbnail_markup .= $section.' .thumbnail{ ';
		$thumbnail_markup .= 'background:transparent;';
		$thumbnail_markup .= 'border:none ;';
		$thumbnail_markup .= 'padding:0 ;';
		$thumbnail_markup .= 'border-radius:0 ;';
	$thumbnail_markup .= '}';

	$thumbnail_markup .= $section.' .thumbnail img{';
		$thumbnail_markup .= 'background:'.$thumbnailBackgroundColor.'; ';  
		$thumbnail_markup .= 'border:'.$thumbnailBorderSize.' '.$thumbnailBorderStyle.' '.$thumbnailBorderColor.';';
		$thumbnail_markup .= 'padding:'.$thumbnailPadding.';';
		$thumbnail_markup .= 'border-radius:'.$thumbnailBorderRadius.';';
	$thumbnail_markup .= '}';
	$thumbnail_markup .= $section.' .thumbnail img:hover{';
		$thumbnail_markup .= 'background:'.$thumbnailGlow.'; ';  
	    $thumbnail_markup .= 'box-shadow: 0 2px 2px rgba(0, 0, 0, 0.075) inset, 0 0 2px '.$thumbnailGlow.' ;';
	$thumbnail_markup .='}';

	return $thumbnail_markup;
}


/* ---------------------------------------------------------
images
-------------------------------------------------------------*/
function iFrameMarkupCallback($section_name, $iframes, $section){


	$iframe_markup = '';
	$iframeBackgroundColor = $iframes['background_color'];
	$iframeBorderColor = $iframes['border_color'];

	$iframeBorderSize = $iframes['border_size'];

	$iframeBorderStyle = $iframes['border_style'];

	$iframePadding = $iframes['padding'];

	$iframeBorderRadius = $iframes['border_radius'];

	// $iframe_markup .= $iframes['border_captions'];
	$iframe_markup .= $section_name.' iframe{';
		$iframe_markup .= 'background:'.$iframeBackgroundColor.';';
		$iframe_markup .= 'border:'.$iframeBorderColor.' '.$iframeBorderSize.' '.$iframeBorderStyle .';';
		$iframe_markup .= 'padding:'.$iframePadding.';';
		$iframe_markup .= 'border-radius:'.$iframeBorderRadius.';';
	$iframe_markup .= '}';

	return $iframe_markup;
}

/* -----------------------------------------------------------
	text formatting components
 -------------------------------------------------------------- */

function textFormattingCallback($section_name, $section, $type ,$format){



		
	$formatting_markup = '';
	$formatting_markup .= $section_name . ' '.$type.'{';
		$formatting_markup .= 'background-color:'.$format[$type . '_background'].';';
		
		if( $type != 'blockquote' ){
			if( $format[$type . '_border_color'] ){
				$formatting_markup .= 'border:1px solid '.$format[$type . '_border_color'].';';
			}else {
				$formatting_markup .= 'border:0px none transparent';
			}
		}else{
			$formatting_markup .= 'border-color:'.$format[$type . '_border_color'].';';
		}
		
			
		if( $format[$type . '_padding'] != '0px' && $format[$type . '_padding']  ){
			$formatting_markup .= 'padding: '.$format[$type . '_padding'].';';
		}

		$formatting_markup .= 'color:'.$format[$type . '_text'].';';
	$formatting_markup .= '}';
	
	$formatting_markup .= $section_name . ' '.$type.' a {';
		$formatting_markup .= 'color:'.$format[$type . '_link'].';';
	$formatting_markup .= '}';

	$formatting_markup .= $section_name . ' '.$type.' a:hover {';
		$formatting_markup .= 'color:'.$format[$type . '_hovered_link'].';';
	$formatting_markup .= '}';


	return $formatting_markup;
}

/* ---------------------------------------------------------
Misc
------------------------------------------------------------- */

function miscStylesCallback(){

	//get footer height
	$footerOptions = get_option('kjd_footer_misc_settings');
	$footerOptions = $footerOptions['kjd_footer_misc'];
	$footerHeight = !empty($footerOptions["height"]) ? $footerOptions["height"] : '' ;
	if($footerOptions['kjd_footer_confine_background'] =='true'){
		$footerHeight = $footerHeight+'40';
	}

	$misc_markup = '';
	$misc_markup .='#pageWrapper{ margin: 0 auto -'.$footerHeight.'px;}';
	$misc_markup .='#push{height:'.$footerHeight.'px;}';
	$misc_markup .='#footer{margin-top:-'.$footerHeight.'px;}';

	return $misc_markup;
}

function post_settings_callback( $section = null, $kjd_section_misc_settings = null){


		
		//color of the line underneath the post info
		$postInfoBorder = $kjd_section_misc_settings['post_info_border'] ? $kjd_section_misc_settings['post_info_border'] : 'rgba(0,0,0,.5)';
		// $blockquote = $kjd_section_misc_settings['blockquote'] ? $kjd_section_misc_settings['blockquote'] : 'rgba(0,0,0,.5)';


		$post_misc_markup ='';

		$post_misc_markup .= $section . ' .post-info {';
			$post_misc_markup .= 'border-bottom:1px solid '. $postInfoBorder.';';
		$post_misc_markup .= '}';


		

	return $post_misc_markup;
}