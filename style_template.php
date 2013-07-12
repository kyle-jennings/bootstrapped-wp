<?php
/*
Template Name: Style Sheet
*/

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
echo load_styles();
function load_styles()
{

	$sections = array('htmlTag','bodyTag','mastArea','header','navbar','dropdown-menu','cycler','contentArea','pageTitle','body','footer');
// Misc Settings
// header misc - height, display, confine - top and bottom margins


	$backgrounds = array('htmlTag','bodyTag','mastArea','contentArea');
	$scaffolding = array('header','cycler','pageTitle','body','footer');

	$media_767_markup ='@media(max-width:767px){';
	echo navbarStylesCallback($media_767_markup);
	echo mediaQuery767Callback($media_767_markup);

	foreach($sections as $section){


		// Misc Settings
		$miscSettings = get_option('kjd_'.$section.'_misc_settings');
		$miscSettings = $miscSettings['kjd_'.$section.'_misc'];
		$confineSectionBackground = $miscSettings['kjd_'.$section.'_confine_background'];


		// // Background Options
		$options_backgrounds = get_option('kjd_'.$section.'_background_settings');
		$backgroundColorSettings = $options_backgrounds['kjd_'.$section.'_background_colors'];
		$backgroundWallpaperSettings = $options_backgrounds['kjd_'.$section.'_background_wallpaper'];
		$backgroundSettings = array('backgroundColorSettings'=>$backgroundColorSettings,'backgroundWallpaperSettings'=>$backgroundWallpaperSettings);

		// //Border Options
		$options_border = get_option('kjd_'.$section.'_borders_settings');
		$sectionTopBorder = $options_border['kjd_'.$section.'_top_border'];
		$sectionRightBorder = $options_border['kjd_'.$section.'_right_border'];
		$sectionBottomBorder = $options_border['kjd_'.$section.'_bottom_border'];
		$sectionLeftBorder = $options_border['kjd_'.$section.'_left_border'];

		if($confineSectionBackground =='true' || $section =='dropdown-menu'){
			$sectionBorders = array('top'=>$sectionTopBorder,'right'=>$sectionRightBorder,'bottom'=>$sectionBottomBorder,'left'=>$sectionBottomBorder);
		}else{
			$sectionBorders = array('top'=>$sectionTopBorder,'right'=>$sectionRightBorder,'bottom'=>$sectionBottomBorder,'left'=>$sectionBottomBorder);
		}

		

		$sectionBorderRadius = $options_border['kjd_'.$section.'_border_radius'];
		$sectionBordersRadiuses = array('top-left'=>$sectionBorderRadius['top-left'],
			'top-right'=>$sectionBorderRadius['top-right'],
			'bottom-right'=>$sectionBorderRadius['bottom-right'],
			'bottom-left'=>$sectionBorderRadius['bottom-left']
		);
		
		// // Htag Options
		$options_htag = get_option('kjd_'.$section.'_text_settings');
		$sectionText = $options_htag['kjd_'.$section.'_text'];
		$sectionH1 = $options_htag['kjd_'.$section.'_H1'];
		$sectionH2 = $options_htag['kjd_'.$section.'_H2'];
		$sectionH3 = $options_htag['kjd_'.$section.'_H3'];
		$sectionH4 = $options_htag['kjd_'.$section.'_H4'];
		$hTags = array('h1' => $sectionH1,'h2' => $sectionH2,'h3' => $sectionH3,'h4' => $sectionH4);
		//print_r($options_htag);die();

		// // Link Options
		$options_links = get_option('kjd_'.$section.'_links_settings');
		$sectionLink = $options_links['kjd_'.$section.'_link'];
		$sectionLinkHovered = $options_links['kjd_'.$section.'_linkHovered'];
		$sectionLinkVisited = $options_links['kjd_'.$section.'_linkVisited'];
		$sectionLinkActive = $options_links['kjd_'.$section.'_linkActive'];
		$linkSettings = array('a' => $sectionLink,
			'a:hover' => $sectionLinkHovered,
			'a:visited' => $sectionLinkVisited,
			'a:active' => $sectionLinkActive
		);
		// // Form Options
		$options_components = get_option('kjd_'.$section.'_components_settings');
		$sectionComponents = $options_components['kjd_'.$section.'_components'];
		$tabbedContent = $sectionComponents['tabbed_content'];
		$collapsibleContent = $sectionComponents['collapsible_content'];
		$tableContent = $sectionComponents['table_content'];	
		$paginationContent = $sectionComponents['pagination'];
		$formStyles = $sectionComponents['forms'];

		$images = $sectionComponents['images'];
		$thumbnails = $sectionComponents['thumbnails'];
		// // Misc Options
		$options_misc = get_option('kjd_'.$section.'_misc_settings');
		$options_misc = $options_misc['kjd_'.$section.'_misc'];
		
		// // Confine BG
		$confineSectionBackground = $options_misc['kjd_'.$section.'_confine_background'];
		if($confineSectionBackground=='true'){
			$borders = array('top' =>$sectionTopBorder,'right' =>$sectionRightBorder,'bottom' =>$sectionBottomBorder,'left' =>$sectionLeftBorder);
		}else{
			$borders = array('top' =>$sectionTopBorder,'bottom' =>$sectionBottomBorder);
		}

		$section_options = array(
			'backgroundSettings' =>$backgroundSettings,
			'sectionBorders' =>$sectionBorders,
			'sectionBordersRadiuses' =>$sectionBordersRadiuses,
			'sectionText' =>$sectionText,
			'linkSettings' =>$linkSettings,
			'hTags' =>$hTags,
			'tabbedContent' =>$tabbedContent,
			'collapsibleContent' =>$collapsibleContent,
			'tableContent'=>$tableContent,
			'paginationContent'=>$paginationContent,
			'formStyles'=>$formStyles,
			'images'=>$images,
			'thumbnails'=>$thumbnails,
			'miscSettings'=>$miscSettings
		);
		echo section_markup_callback($section,$section_options);
		
	}

}

/* -------------------------------------------------------------------------------------------
						Build markup - calls th eappropriate fucntions for each section
----------------------------------------------------------------------------------------- */
function section_markup_callback($section,$section_options){
	extract($section_options);
	extract($backgroundSettings);

	if($section =='dropdown-menu'){
		$section_name = '.dropdown-menu';
	}elseif($section =='cycler'){
		$section_name = '#imageSliderWrapper';
	}elseif($section == 'navbar'){
		$section_name = '#'.$section.' .navbar-inner';
	}elseif($section =='htmlTag'){
		$section_name =  'html';
	}elseif($section =='bodyTag'){
		$section_name = 'body';
	}else{
		$section_name = '#'.$section;
	}

	$type = $backgroundColorSettings['gradient'];
	if(!empty($miscSettings['kjd_'.$section.'_section_shadow'])){
		$sectionShadow = $miscSettings['kjd_'.$section.'_section_shadow'];	
	}
	

	if($section =="header"){
		$hideHeader = $miscSettings['hide_header']; 
		$forceHeight = $miscSettings['force_height'];
		//$useMast = $miscSettings['use_mastArea'];				
	}

	$sectionArea_markup = '';
	$sectionArea_markup .= $section_name.'{';



	if(!empty($miscSettings['float']) && $miscSettings['float'] == 'true' && $section!='navbar'){
		$sectionArea_markup .= "margin-top:20px;";
		$sectionArea_markup .= "margin-bottom:20px;";
	}elseif(!empty($miscSettings['float']) && $miscSettings['float'] == 'true' && $section=='navbar'){
		$sectionArea_markup .= "margin-top:0px;";
		$sectionArea_markup .= "margin-bottom:20px;";
	}

	// if(!empty($forceHeight) &&$forceHeight =="true" && $navSettings['navbar_style'] != 'sticky-bottom'  && $section=='header' && !empty($miscSettings['header_height'])){
	// 	$sectionArea_markup .= "height:".$miscSettings['header_height']."px;";
	// }


	// //background functions
	$sectionArea_markup .= background_type_callback($type,$backgroundSettings);
	//wallpaper function
	$sectionArea_markup .= wallpaper_callback($backgroundWallpaperSettings);

			
	//borders function
	foreach($sectionBorders as $k =>$v){
		$sectionArea_markup .= borderSettingsCallback($k, $v);	
	}
	
	//border radius function
	foreach($sectionBordersRadiuses as $k =>$v){
		$sectionArea_markup .= borderRadiusCallback($k, $v);	
	}
	

	//color
	$sectionArea_markup .= 'color:'.$sectionText['color'].';';
	//hide header
	if($section =='header' && $hideHeader == 'true'){
		$sectionArea_markup .= 'display:none !important;';
	}
	
	//height -- if header, footer, or mast
	//margin -- if floated
	//padding -- if floated or spcified

	$sectionArea_markup .= '}';

	if($section == "body"){
		//color of the line underneath the post info
		$postInfoBorder = $miscSettings['post_info_border'] ? $miscSettings['post_info_border'] : 'rgba(0,0,0,.5)';
		$sectionArea_markup .= '.post-info';
		$sectionArea_markup .= '{';
			$sectionArea_markup .= 'border-bottom:1px solid '. $postInfoBorder.';';
		$sectionArea_markup .= '}';
	}


	// Link and HTgag styles
	if($section !='bodyTag' && $section !='htmlTag' && $section != 'mastArea' && $section !='cycler' && $section !="navbar" && $section !='dropdown-menu' && $section !='contentArea'){
		
		//Link settings
		foreach($linkSettings as $link_type => $v){
			$sectionArea_markup .= $section_name.' '.$link_type.'{';
			$sectionArea_markup .= linkSettingsCallback($v);
			$sectionArea_markup .= '}';
		}

		//htag settings
		foreach($hTags as $htag => $v){

			$sectionArea_markup .= $section_name.' '.$htag.'{';
			$sectionArea_markup .= hTagSettingsCallback($v);
			$sectionArea_markup .= '}';
		}

	}



	if($section =="cycler"){
		echo image_cycler_settings_callback($miscSettings);
	}



	if($section =='body' || $section =='footer'){
		//tabbed
		$sectionArea_markup .= tabbedMarkupCallback($section, $tabbedContent, $section_name);
		//collapsibles
		$sectionArea_markup .= collapsibleMarkupCallback($section, $collapsibleContent, $section_name);
		//tables
		$sectionArea_markup .= tableMarkupCallback($section, $tableContent, $section_name);
		//pagination
		$sectionArea_markup .= paginationMarkupCallback($section, $paginationContent, $section_name);
		//forms
		$sectionArea_markup .= formsMarkupCallback($section, $formStyles, $section_name);
		//images
		$sectionArea_markup .= imagesMarkupCallback($section, $images, $section_name);
		//thumbnails
		$sectionArea_markup .= thumbnailsMarkupCallback($section, $thumbnails, $section_name);
	}
	return $sectionArea_markup;

}
/* ------------------------------- image cycler settings--------------------------------- */
function image_cycler_settings_callback($miscSettings){
		$cycler_output = '';

		if($miscSettings['shadow'] == "false"){ 
			$cycler_output .= '#imageSlider{background:none !important; padding:20px 0 !important;}';
		}
		if($miscSettings['plugin'] == "single image"){
	
			$cycler_output .=".singleImage{
							border:".$miscSettings['borderSize']." ".$miscSettings['borderColor']." solid; 
						-webkit-border-radius:".$miscSettings['borderRadius'].";
						-moz-border-radius:".$miscSettings['borderRadius'].";
						border-radius:".$miscSettings['borderRadius'].";
						}";

			if($miscSettings['borderTransparency'] == 'true'){ 
				$cycler_output .=".singleImage{
									-moz-background-clip: border;    
									-webkit-background-clip: border;  
									background-clip: border-box;
								}";
			}
			
			if($miscSettings['singleCaption'] == "top"){
				$cycler_output .=".singleImage .caption{left:50%; width:100%;}";
			}elseif($miscSettings['singleCaption'] == "right"){
				$cycler_output .=".singleImage .caption{ width:25%;}";
			}elseif($miscSettings['singleCaption'] == "bottom"){
				$cycler_output .=".singleImage .caption{left:50%; width:100%;}";
			}elseif($miscSettings['singleCaption'] == "left"){
				$cycler_output .=".singleImage .caption{ width:25%;}";
			}else{
				$cycler_output .=".singleImage .caption{display:none !important;}";
			}

		}elseif($miscSettings['plugin'] == "nivo"){
			
			if($miscSettings['nivoCaption'] == "top"){
				$cycler_output .=".nivo-caption{top:0; bottom:auto !important;}";
			}elseif($miscSettings['nivoCaption'] == "right"){
				$cycler_output .=".nivo-caption{height:100% !important; left:auto !important; right:0  !important; width:25%  !important;}";
			}elseif($miscSettings['nivoCaption'] == "bottom"){ 
				
			}elseif($miscSettings['nivoCaption'] == "left"){ 
				$cycler_output .=".nivo-caption{height:100% !important; width:25% !important;}";
			}else{ 
				$cycler_output .=".nivo-caption{display:none !important;}";
			}

		}

		return $cycler_output;
}

// /* ------------------------- backgrounds -----------------------------*/

 //background type takes the $type argument and uses it to return the appropriate function
function background_type_callback($type = null,$backgroundColorSettings = array()){
	extract($backgroundColorSettings); 

	$background_type = '';
	if($type =='vertical'){
		$background_type .= verticalGradientCallback($backgroundColorSettings['color'], $backgroundColorSettings['endcolor']);
	}elseif($type =='horizontal'){ 
		$background_type .= horizontalGradientCallback($backgroundColorSettings['color'], $backgroundColorSettings['endcolor']);
	}elseif($type =='radial'){ 
		$background_type .= radialGradientCallback($backgroundColorSettings['color'], $backgroundColorSettings['endcolor']);
	}elseif($type =='solid'){
		$background_type .= 'background-color: '.$backgroundColorSettings['color'].' !important;';
	}elseif($type =='none'){
		$background_type .= 'background-color:transparent !important;';
	}else{
		$background_type .= 'background-color:transparent !important;';
	}
	
	return $background_type;
}



////////////////////////
// vertical gradient
function verticalGradientCallback($startColor, $endColor){ 
$gradient_markup = '';
	if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor == "#ffffff";
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
			$endcolor = "#ffffff";
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
			$endcolor == "#ffffff";
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
function wallpaper_callback($backgroundWallpaperSettings){
	$backgroundImage = $backgroundWallpaperSettings['image'];
	if(!empty($backgroundWallpaperSettings['attachment'])){
		$backgroundAttachment = $backgroundWallpaperSettings['attachment'];	
	}
	$backgroundPosition = $backgroundWallpaperSettings['position'];
	$backgroundPositionX = $backgroundWallpaperSettings['positionX'];
	$backgroundPositionY = $backgroundWallpaperSettings['positionY'];
	$backgroundRepeat = $backgroundWallpaperSettings['repeat'];

	$wallpaper_markup ='';
	if($backgroundWallpaperSettings['use_wallpaper']=='true'){
	 	
		if(isset($backgroundImage) && $backgroundImage!=""){
			$wallpaper_markup .= 'background-image:url('.$backgroundImage.');';
		}
		if(isset($backgroundAttachment) && $backgroundAttachment!=""){
			$wallpaper_markup .= 'background-attachment:'.$backgroundAttachment.' !important;';	
		}else{
			$wallpaper_markup .= 'background-attachment:scroll !important;';
		}

		if(isset($backgroundPosition) && $backgroundPosition!=""){
			$wallpaper_markup .= 'background-position:'.$backgroundPosition.';';	
		}

		if(isset($backgroundPosition) && $backgroundPosition=="custom"){
			$wallpaper_markup .= 'background-position:'.$backgroundPositionX.' '.$backgroundPositionY.';';	
		}
		if(isset($backgroundRepeat) && $backgroundRepeat!=""){
			$wallpaper_markup .= 'background-repeat:'.$backgroundRepeat.';';	
		}


	}
	return $wallpaper_markup;
}





// /* ------------------------- border settings -----------------------------*/
function borderSettingsCallback($position, $border){
//	extract($sectionBorders); //

	$border_style_markup = '';
//$borders = array('top' =>$sectionTopBorder,'right' =>$sectionRightBorder,'bottom' =>$sectionBottomBorder,'left' =>$sectionLeftBorder);

	$borderStyle = $border['style'];
	$borderColor = $border['color'];
	$borderSize = $border['size'];

	if(isset($borderStyle) && $borderStyle!="none"){
		$border_style_markup .= 'border-'.$position.'-style:'.$borderStyle.';';

		if (isset($borderColor)&& !empty($borderColor)){
			$border_style_markup .= 'border-'.$position.'-color:'.$borderColor.';';
		}
		if (isset($borderSize) && !empty($borderSize)){
			$border_style_markup .= 'border-'.$position.'-width:'.$borderSize.';'; 
		}
	}


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
	$shadow = $hTag['textShadowColor'];
	$bg_style = $hTag['bg_style'];
	$bg_color = $hTag['bg_color'];
	$border_style = $hTag['border_style'];
	$border_color = $hTag['border_color'];

	$htag_markup = '';
	 if($bg_style == 'pills' || $bg_style == "squared"){
 		$htag_markup .= 'background-color:'.$bg_color.';';
		$htag_markup .= 'word-break:hypenate;';

	}elseif($bg_style =='tabs'){
   		$htag_markup .= 'border-radius: 4px 4px 0 0;';
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
function linkSettingsCallback($link){
	//print_r($link);die();
	$bg_style = $link['bg_style'];
	$bg_color = $link['bg_color'];
	$color = $link['color'];
	$decoration = $link['decoration'];
	if(!empty($link['text_shadow'])){
		$shadow = $link['text_shadow'];	
	}
	

	$link_style_markup = '';
	 if($bg_style == 'pills'){
		$link_style_markup .= 'background:'.$bg_color.';';
		$link_style_markup .= 'padding:4px;';
		$link_style_markup .= 'word-break:hyphenate;';
	}elseif($bg_style == "highlighted"){
		$link_style_markup .= 'background:'.$bg_color.';';
	}
	if(isset($color) && $color!=""){
		$link_style_markup .= 'color:'.$color.';';
	}
	if(isset($decoration) && $decoration!=""){
		$link_style_markup .= 'text-decoration:'.$decoration.';';
	}
	if(isset($shadow) && $shadow!=""){
		$link_style_markup .= 'text-shadow:'.$shadow.';';
	}

	return $link_style_markup;
}


// /* ------------------------- tables -----------------------------*/
function tableMarkupCallback($section, $tableContent){
$table_markup = '';
	
	$table_markup .= '#'.$section.' .table,';
	$table_markup .= '#'.$section.' .table td,';
	$table_markup .= '#'.$section.' .table th{';
	$table_markup .= '	border-color:'.$tableContent['table_border'].' !important;';
	$table_markup .= '}';

	$table_markup .= '#'.$section.' .table thead,';
	$table_markup .= '#'.$section.' .table tfoot{';
	$table_markup .= '	color:'.$tableContent['table_header_text_color'].';';
	$table_markup .= '	background:'.$tableContent['table_header_background'].';';
	$table_markup .= '	border-color:'.$tableContent['table_border'].' !important;';
	$table_markup .= '}';

	$table_markup .= '#'.$section.' .table-hover tbody tr td:hover{';
	$table_markup .= '	background:'.$tableContent['hovered_row_background'].' !important;';
	$table_markup .= '	color:'.$tableContent['hovered_row_text_color'].';';
	$table_markup .= '}';

	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(even) td,';
	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(even) th{';
	$table_markup .= '	background:'.$tableContent['even_row_background'].' !important;';
	$table_markup .= '	color:'.$tableContent['even_row_text_color'].';';
	$table_markup .= '}';

	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(odd) td,';
	$table_markup .= '#'.$section.' .table-striped tbody tr:nth-child(odd) th{';
	$table_markup .= '	background:'.$tableContent['odd_row_background'].' !important;';
	$table_markup .= '	color:'.$tableContent['odd_row_text_color'].';';
	$table_markup .= '}';

	return $table_markup;
}


// /* ------------------------- pagination -------------------------*/
function paginationMarkupCallback($section, $paginationContent){
$pagination_markup = '';

	$pagination_markup .= '.pagination ul li > *';
	$pagination_markup .= '{';
		$pagination_markup .= 'background:'. $paginationContent['pagination_background'].' ;';
		$pagination_markup .= 'border-color:'. $paginationContent['pagination_border'].' ;';
	$pagination_markup .= '}';

	$pagination_markup .= '.pagination li:hover span,';
	$pagination_markup .= '.pagination li:hover a';
	$pagination_markup .= '{';
		$pagination_markup .= 'background:'. $paginationContent['pagination_hover'].' ;';
	$pagination_markup .= '}';

	$pagination_markup .= '.pagination li a.page-numbers';
	$pagination_markup .= '{';
		$pagination_markup .= 'color:'. $paginationContent['pagination_link'].' ;';
	$pagination_markup .= '}';

	$pagination_markup .= '.pagination li span.page-numbers';
	$pagination_markup .= '{';
		$pagination_markup .= 'color:'. $paginationContent['pagination_text'].' ;	';
	$pagination_markup .= '}';


return $pagination_markup;
}

// /* ------------------------- forms -----------------------------*/
function formsMarkupCallback($section, $formStyles){
$form_markup = '';
$form_markup .= '#'. $section.' form{';
	$form_markup .= 'background:'. $formStyles['form_background'].' ; ';
	$form_markup .= 'border-color:'. $formStyles['form_border'].';';
	$form_markup .= 'color:'. $formStyles['container_text'].';';

if( (isset($formStyles['form_background']) && $formStyles['form_background']!= '' && $formStyles['form_background']!= ' ' ) || (isset($formStyles['container_border']) && $formStyles['container_border']!= '' && $formStyles['container_border']!= ' ') ){
	$form_markup .= ' "padding:10px; border-radius:4px;";';
}
'}';


$form_markup .= '#'. $section.' form button:hover,#'. $section.' form input[type=submit]:hover,#'. $section.' form .btn:hover{';
	$form_markup .= 'background-color:'. $formStyles['button_background_end'].' !important;';
	$form_markup .= '}';
$form_markup .= '#'. $section.' input[type="radio"], #'. $section.' input[type="checkbox"],#'. $section.' textarea,#'. $section.'  input[type="text"],#'. $section.'  input[type="password"],#'. $section.'  input[type="datetime"],#'. $section.'  input[type="datetime-local"],#'. $section.'  input[type="date"],#'. $section.'  input[type="month"],#'. $section.'  input[type="time"],#'. $section.'  input[type="week"],#'. $section.'  input[type="number"],#'. $section.'  input[type="email"],#'. $section.'  input[type="url"],#'. $section.'  input[type="search"],#'. $section.'  input[type="tel"],#'. $section.'  input[type="color"],#'. $section.'  .uneditable-input{';
	$form_markup .= 'color:'. $formStyles['field_text'].';';
	$form_markup .= 'background:'. $formStyles['field_background'].' ;  ';
	$form_markup .= 'border-color:'. $formStyles['field_border'].';';
$form_markup .= '}';
$form_markup .= '#'. $section.' input[type="radio"]:focus, #'. $section.' input[type="checkbox"]:focus, #'. $section.' textarea:focus,#'. $section.'  input[type="text"]:focus,#'. $section.'  input[type="password"]:focus,#'. $section.'  input[type="datetime"]:focus,#'. $section.'  input[type="datetime-local"]:focus,#'. $section.'  input[type="date"]:focus,#'. $section.'  input[type="month"]:focus,#'. $section.'  input[type="time"]:focus,#'. $section.'  input[type="week"]:focus,#'. $section.'  input[type="number"]:focus,#'. $section.'  input[type="email"]:focus,#'. $section.'  input[type="url"]:focus,#'. $section.'  input[type="search"]:focus,#'. $section.'  input[type="tel"]:focus,#'. $section.'  input[type="color"]:focus,#'. $section.'  .uneditable-input:focus {';
	$form_markup .= 'border-color: :'. $formStyles['field_border'].';';
	$form_markup .= 'box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px '. $formStyles['field_glow'].';';
$form_markup .= '}';

$form_markup .= '#'. $section.' form button,#'. $section.' form input[type=submit],#'. $section.' form .btn{';
	verticalGradientCallback($formStyles['button_background'], $formStyles['button_background_end']);
	$form_markup .= 'background-image:none;';
	$form_markup .= 'border-color:'. $formStyles['button_border'].' !important;';
	$form_markup .= 'color:'. $formStyles['button_text'].' !important;';
$form_markup .= '}';
	return $form_markup;
}

// /* ----------------------------- Collapsibles ------------------------------ */
function collapsibleMarkupCallback($section, $collapsibleContent)
{
	$collapsible_markup =''; 
$collapsible_markup .= '#'. $section.' .accordion-group{';
$collapsible_markup .= 'background:'. $collapsibleContent['collapible_content_background'].'; ';
$collapsible_markup .= 'border-color:'. $collapsibleContent['collapible_content_border'].' !important;';
$collapsible_markup .= '}';
/*the title*/
$collapsible_markup .= '#'. $section.' .accordion-heading > a.collapsed{';
$collapsible_markup .= 'background:'. $collapsibleContent['inactive_title_background'].'; ';
$collapsible_markup .= 'color:'. $collapsibleContent['inactive_title_link_color'].';';
$collapsible_markup .= '}';
$collapsible_markup .= '#'. $section.' .accordion-heading a{';
$collapsible_markup .= 'background:'. $collapsibleContent['active_title_background'].'; ';
$collapsible_markup .= 'color:'. $collapsibleContent['active_title_link_color'].';';
$collapsible_markup .= '}';
/* when closed*/
$collapsible_markup .= '#'. $section.' .accordion-heading > .collapsed{';
$collapsible_markup .= 'background:'. $collapsibleContent['inactive_title_background'].' !important;';
$collapsible_markup .= 'color:'. $collapsibleContent['inactive_title_link_color'].' !important;';
$collapsible_markup .= '}';
$collapsible_markup .= '#'. $section.' .accordion-heading a:hover{';
$collapsible_markup .= 'background:'. $collapsibleContent['hovered_title_background'].' !important;';
$collapsible_markup .= 'color:'. $collapsibleContent['hovered_title_link_color'].' !important;';
$collapsible_markup .= '}';
/*the content */
$collapsible_markup .= '#'. $section.' .accordion-inner {';
$collapsible_markup .= 'border-top-color:'. $collapsibleContent['collapible_content_border'].' !important;';
$collapsible_markup .= '}';
$collapsible_markup .= '#'. $section.' .accordion-heading > a.collapsed, ';
$collapsible_markup .= '#'. $section.' .accordion-heading >a,';
$collapsible_markup .= '#'. $section.' .accordion-heading >a:hover{ text-decoration:none !important;}';

return $collapsible_markup;
}

// /* -------------------------  Tabbed content ----------------------------------*/
function tabbedMarkupCallback($section, $tabbedContent){
$tabbed_markup = '';
$tabbed_markup .= '#'. $section.' .tabbable > ul.nav{';
$tabbed_markup .= 'border: 0px !important; margin:0;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav > li > a{ ';
$tabbed_markup .= 'background:'. $tabbedContent['inactive_tab_background'].'; ';
$tabbed_markup .= 'border-color:'. $tabbedContent['tabbed_content_border'].' !important; ';
$tabbed_markup .= 'color:'. $tabbedContent['inactive_tab_link_color'].' !important;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav > li > a:hover{';
$tabbed_markup .= 'background:'. $tabbedContent['hovered_tab_background'].';';
$tabbed_markup .= 'color:'. $tabbedContent['hovered_tab_link_color'].' !important;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav > li.active > a{';
$tabbed_markup .= 'background:'. $tabbedContent['tabbed_content_background'].';';
$tabbed_markup .= 'color:'. $tabbedContent['tabbed_content_text_color'].' !important;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > .tab-content{';
$tabbed_markup .= 'background:'. $tabbedContent['tabbed_content_background'].'; ';
$tabbed_markup .= 'border-color:'. $tabbedContent['tabbed_content_border'].' !important; ';
$tabbed_markup .= 'color:'. $tabbedContent['tabbed_content_text_color'].' !important;';
$tabbed_markup .= 'border-style: solid; border-width: 1px; padding:20px;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > .tab-content > a{';
$tabbed_markup .= 'color:'. $tabbedContent['tabbed_content_link_color'].' !important;';
$tabbed_markup .= '}';

/* tab directions */
$tabbed_markup .= '#'. $section.' .tabs-left > ul > li > a{';
$tabbed_markup .= 'border-right-color:'. $tabbedContent['tabbed_content_border'].' !important;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-left > ul > li.active > a{';
$tabbed_markup .= 'border-right-color:'. $tabbedContent['tabbed_content_background'].' !important;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-left .tab-content{';
$tabbed_markup .= '-webkit-border-radius: 4px;';
$tabbed_markup .= '-webkit-border-top-left-radius: 0;';
$tabbed_markup .= '-moz-border-radius: 4px;';
$tabbed_markup .= '-moz-border-radius-topleft: 0;';
$tabbed_markup .= 'border-radius: 4px;';
$tabbed_markup .= 'border-top-left-radius: 0;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-right > ul > li > a{';
$tabbed_markup .= 'border-left-color:'. $tabbedContent['tabbed_content_border'].' !important; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-right > ul > li.active > a{';
$tabbed_markup .= 'border-left-color:'. $tabbedContent['tabbed_content_background'].' !important; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-right .tab-content{';
$tabbed_markup .= '-webkit-border-radius: 4px;';
$tabbed_markup .= '-webkit-border-top-right-radius: 0;';
$tabbed_markup .= '-moz-border-radius: 4px;';
$tabbed_markup .= '-moz-border-radius-topright: 0;';
$tabbed_markup .= 'border-radius: 4px;';
$tabbed_markup .= 'border-top-right-radius: 0;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable.tabs > ul > li a{';
$tabbed_markup .= 'border-bottom-color:'. $tabbedContent['tabbed_content_border'].' !important;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable.tabs > ul > li.active a{';
$tabbed_markup .= 'border-bottom-color:'. $tabbedContent['tabbed_content_background'].' !important;';
$tabbed_markup .= '}';


$tabbed_markup .= '#'. $section.' .tabbable.tabs .tab-content{';
$tabbed_markup .= '-webkit-border-radius: 4px;';
$tabbed_markup .= '-webkit-border-top-left-radius: 0;';
$tabbed_markup .= '-moz-border-radius: 4px;';
$tabbed_markup .= '-moz-border-radius-topleft: 0;';
$tabbed_markup .= 'border-radius: 4px;';
$tabbed_markup .= 'border-top-left-radius: 0;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-below > ul > li > a{';
$tabbed_markup .= 'border-top-color:'. $tabbedContent['tabbed_content_border'].' !important; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-below > ul > li.active > a{';
$tabbed_markup .= 'border-top-color:'. $tabbedContent['tabbed_content_background'].' !important; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-below .tab-content{';
$tabbed_markup .= '-webkit-border-radius: 4px;';
$tabbed_markup .= '-webkit-border-bottom-left-radius: 0;';
$tabbed_markup .= '-moz-border-radius: 4px;';
$tabbed_markup .= '-moz-border-radius-bottomleft: 0;';
$tabbed_markup .= 'border-radius: 4px;';
$tabbed_markup .= 'border-bottom-left-radius: 0;';
$tabbed_markup .= '}';

return $tabbed_markup;
}	

//images
function imagesMarkupCallback($section,$images){

	$image_markup = '';
	$imageBackgroundColor = $images['background_color'];
	$imageBorderColor = $images['border_color'];
	$imageBorderSize = $images['border_size'];
	$imageBorderStyle = $images['border_style'];
	$imagePadding = $images['padding'];
	$imageBorderRadius = $images['border_radius'];

	$image_markup .= '#'.$section.' img, #'.$section.' iframe{';
		$image_markup .= 'background:'.$imageBackgroundColor.';';
		$image_markup .= 'border:'.$imageBorderColor.' '.$imageBorderSize.' '.$imageBorderStyle .';';
		$image_markup .= 'padding:'.$imagePadding.';';
		$image_markup .= 'border-raidus:'.$imageBorderRadius.';';
	$image_markup .= '}';

	return $image_markup;
}

// /* ------------------------- thumbnails -----------------------------*/
function thumbnailsMarkupCallback($section, $thumbnails){
$thumbnail_markup ='';

	$thumbnailBackgroundColor = $thumbnails['background_color'];
	$thumbnailGlow = $thumbnails['thumbnail_glow'];
	$thumbnailBorderColor = $thumbnails['border_color'];
	$thumbnailBorderSize = $thumbnails['border_size'];
	$thumbnailBorderStyle = $thumbnails['border_style'];
	$thumbnailPadding = $thumbnails['padding'];
	$thumbnailBorderRadius = $thumbnails['border_radius'];

// $thumbnail_markup .= '#'.$section.' img{ ';
// 	/*color: echo $thumbnail['thumbnail_text']; ;*/

// $thumbnail_markup .= 'background:'.$thumbnailBackgroundColor.'; ';  
// $thumbnail_markup .= 'border:'.$thumbnailBorderSize.' '.$thumbnailBorderStyle.' '.$thumbnailBorderColor.';';
// $thumbnail_markup .= 'padding:'.$thumbnailPadding.';';
// $thumbnail_markup .= 'border-radius:'.$thumbnailBorderRadius.';';
// $thumbnail_markup .= '}';

	$thumbnail_markup .= '#'.$section.'.thumbnail img{ ';
		/*color: echo $thumbnails['thumbnail_text']; ;*/
		$thumbnail_markup .= 'background:none !important;';
		$thumbnail_markup .= 'border:none !important;';
		$thumbnail_markup .= 'padding:0 !important;';
		$thumbnail_markup .= 'border-radius:0 !important;';
	$thumbnail_markup .= '}';

	$thumbnail_markup .= '#'.$section.' .thumbnail{';
		$thumbnail_markup .= 'background:'.$thumbnailBackgroundColor.'; ';  
		$thumbnail_markup .= 'border:'.$thumbnailBorderSize.' '.$thumbnailBorderStyle.' '.$thumbnailBorderColor.';';
		$thumbnail_markup .= 'padding:'.$thumbnailPadding.';';
		$thumbnail_markup .= 'border-radius:'.$thumbnailBorderRadius.';';
	$thumbnail_markup .= '}';
	$thumbnail_markup .= '#'.$section.' .thumbnail:hover{';
		$thumbnail_markup .= 'background:'.$thumbnailGlow.'; ';  
	    $thumbnail_markup .= 'box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 2px '.$thumbnailGlow.' ;';
	$thumbnail_markup .='}';

	return $thumbnail_markup;
}


/* -------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------- */
/* -------------------------------------------- Nav bar shit----------------------------------------- */
/* -------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------- */
function navbarStylesCallback(&$media_767_markup){

	$navSettings = get_option('kjd_navbar_misc_settings');
	$navSettings = $navSettings['kjd_navbar_misc'];
	


	$flush_left = $navSettings['flush_first_link'];
	$dropdown_bg = $navSettings['side_nav'];
	
	$navbarBackgroundOptions = get_option('kjd_navbar_background_settings');
	$navbarBackgroundColors = $navbarBackgroundOptions['kjd_navbar_background_colors'];
	$navbarWallpaper = $navbarBackgroundOptions['kjd_navbar_background_wallpaper'];

	/* borders */
	$navbarBordersOptions = get_option('kjd_navbar_borders_settings');
	$navbarTopBorder = $navbarBordersOptions['kjd_navbar_top_border'];
	$navbarRightBorder = $navbarBordersOptions['kjd_navbar_right_border'];
	$navbarBottomBorder = $navbarBordersOptions['kjd_navbar_bottom_border'];
	$navbarLeftBorder = $navbarBordersOptions['kjd_navbar_left_border'];
	/* link style */
	$navbarLinksOptions = get_option('kjd_navbar_links_settings');
	$navbarLink = $navbarLinksOptions['kjd_navbar_link'];
	$navbarLinkHovered = $navbarLinksOptions['kjd_navbar_linkHovered'];
	$navbarLinkActive = $navbarLinksOptions['kjd_navbar_linkActive'];
	$navbarLinkVisted = $navbarLinksOptions['kjd_navbar_linkVisited'];


	/* forms and wells */
	$navbarFormsOptions = get_option('kjd_navbar_forms_settings');
	$navbarForms = $navbarFormsOptions['kjd_navbar_forms'];

	/* subnav settings */

	$dropdownMenuSettings = get_option('kjd_dropdown-menu_options_settings');
	$dropdownMenuSettings = $dropdownMenuSettings['kjd_dropdown-menu_options'];

	$dropdownMenuBackgroundOptions = get_option('kjd_dropdown-menu_background_settings');
	$dropdownMenuBackgroundColors = $dropdownMenuBackgroundOptions['kjd_dropdown-menu_background_colors'];
	$dropdownMenuWallpaper = $dropdownMenuBackgroundOptions['kjd_dropdown-menu_background_wallpaper'];

	/* dropdown-menu borders */
	$dropdownMenuBordersOptions = get_option('kjd_dropdown-menu_borders_settings');
	$dropdownMenuTopBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_top_border'];
	$dropdownMenuRightBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_right_border'];
	$dropdownMenuBottomBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_bottom_border'];
	$dropdownMenuLeftBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_left_border'];
	/* dropdown-menu link style */
	$dropdownMenuLinksOptions = get_option('kjd_dropdown-menu_links_settings');
	$dropdownMenuLink = $dropdownMenuLinksOptions['kjd_dropdown-menu_link'];
	$dropdownMenuLinkHovered = $dropdownMenuLinksOptions['kjd_dropdown-menu_linkHovered'];
	$dropdownMenuLinkActive = $dropdownMenuLinksOptions['kjd_dropdown-menu_linkActive'];
	$dropdownMenuLinkVisted = $dropdownMenuLinksOptions['kjd_dropdown-menu_linkVisited'];


 	$navbar_markup ='';

// Positions navbar
	if($navSettings['navbar_alignment'] =='left'){
		$navbar_markup .=' #navbar .nav{ float:left;}';
	}elseif($navSettings['navbar_alignment'] =='center'){
		$navbar_markup .='#navbar > .nav{ text-align: center;}';
	}elseif($navSettings['navbar_alignment'] =='right'){
		$navbar_markup .='#navbar .nav{ float:right;}';
	}

	if($navSettings['kjd_navbar_pull_up'] == 'true'){
		$navbar_markup .="#navbar{
					margin-top:".$navSettings['kjd_navbar_margin_top']."px;
				}";

		$media_767_markup .='#navbar{
						float:right;
						margin-top: 0px !important;
						position:none
					}';
	}

	//pulls navbar up
	// if($navSettings['side_nav'] == 'true'){
	// 	$media_767_markup .= 'float:left;}';
	// }

	// Removes box shadow if there is no background color on the navbar - should probably just remove it period
	if($navbarBackgroundColors['gradient'] == 'none' || (!isset($navbarBackgroundColors['color']) || 
		$navbarBackgroundColors['color'] == '' || empty($navbarBackgroundColors['color'])) ){

		$navbar_markup .='.navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner,.navbar-inner {   
					box-shadow: none !important;		
				}';
	}

// remove left padding on first link
if($flush_left == 'true')
{
 $navbar_markup .= '.navbar .nav > li:first-child > a{padding-left:0;}';
}
//disable link inner shaddow
if($navSettings['link_shadows'] =='true'){
	$navbar_markup .='.navbar .nav > .active > a, ';
	$navbar_markup .='.navbar .nav > .active > a:hover,';
	$navbar_markup .='.navbar .nav > .active > a:focus{box-shadow:none !important;}';
	//echo "box-shadow:none !important;"
}

//layouts
	//confines layout to like, 960 and has border radius
	if($navSettings['navbar_style'] =="contained"){
		$navbar_markup .='.navbar-inner{padding:0;}';
		$navbar_markup .='.navbar-inner .nav li:first-child a{border-radius:4px 0 0 4px;}';
	}
	//stickys to top of page
	if($navSettings['navbar_style'] =="sticky-top"){
		$navbar_markup .='#header{padding-top:60px;}';
	}	


// /* *************** link colors ******************** */
//  normal link colors 

$navbar_markup .="
.navbar .nav > li > a{
		color:".$navbarLink['color']." !important;
		background-color:".$navbarLink['bg_color'].";
	}";

// active link colors 
$navbar_markup .=".navbar .nav > li.active > a{
	background-color:".$navbarLinkActive['bg_color'].";
	color:".$navbarLinkActive['color']."!important;
	text-decoration:".$navbarLinkActive['decoration']." !important;
}";

//  inactive carret
$navbar_markup .=".navbar .nav > li > a.dropdown-toggle > .caret{
	border-top-color:".$navbarLink['color']." !important;
}";
//  active carret 
$navbar_markup .=".navbar .nav > li.active > a.dropdown-toggle > .caret{
	border-top-color:".$navbarLinkActive['color']." !important;
}";

//  toplevel nav when hovered 
$navbar_markup .=" .navbar .nav > li > a:hover,.navbar .nav > li > a:focus{
	
	background-color:".$navbarLinkHovered['bg_color']." !important;
	color:".$navbarLinkHovered['color']." !important;
	text-decoration:".$navbarLinkHovered['decoration']." !important;
}";
//hovered carret -->
$navbar_markup .=".navbar .nav > li > a:hover.dropdown-toggle > .caret{
		border-top-color:".$navbarLinkHovered['color']." !important;
	}";

// carret when on bottom 
$navbar_markup .=".navbar-fixed-bottom .nav > li > a.dropdown-toggle > .caret{
		border-top-color:transparent !important;
	border-bottom-color:".$navbarLink['color']." !important;
}";
// carret when on bottom:hovered -->
$navbar_markup .=".navbar-fixed-bottom .nav > li > a:hover.dropdown-toggle > .caret{
	border-top-color:transparent !important;
	border-bottom-color:".$navbarLinkHovered['color']." !important;
}";
//carret when on bottom:active -->
$navbar_markup .=".navbar-fixed-bottom .nav > li.active > a.dropdown-toggle > .caret{
		border-top-color:transparent !important;
		border-bottom-color:".$navbarLinkActive['color']." !important;
}";

// top level nav when opened  -->
$navbar_markup .=".navbar .nav > li.open > a{
	background-color:".$navbarLinkHovered['bg_color']." !important;
	color:".$navbarLinkHovered['color']." !important;
}";


// carret when opened  -->
$navbar_markup .=".navbar .nav > li.open > a.dropdown-toggle > .caret{
	border-top-color:".$navbarLinkHovered['color']." !important;
}";

// top level nav when opened  -->
$navbar_markup .=".navbar .nav li.open > a:after{
	border-color:".$navbarLinkHovered['color']." !important;
}";

// first level dropdown stuff  -->
//the triangle at the top of the dropdown -->
$navbar_markup .=".dropdown-menu:after {  
	border-bottom-color:".$dropdownMenuBackgroundColors['color']." !important;
}";

$navbar_markup .=".navbar .nav > li > .dropdown-menu:before{  
 	border-bottom: 7px solid ".$dropdownMenuTopBorder['color']." !important;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    content: '';
    display: inline-block;
    left: 9px;
    position: absolute;
    top: -7px;
}";

$navbar_markup .=".navbar-fixed-bottom.navbar .nav > li > .dropdown-menu:before{
	border-top: 7px solid ".$dropdownMenuBottomBorder['color']." !important;
	border-bottom: none !important;
	border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    content: '';
    display: inline-block;
    left: 9px;
    position: absolute;
    bottom: -7px;
    top:auto;
}";

$navbar_markup .=".navbar-fixed-bottom .nav > li > .dropdown-menu:after{
border-top-color: ".$dropdownMenuBackgroundColors['color']." !important;
}";
$navbar_markup .=".navbar-fixed-bottom.navbar .nav .sub-menu{margin-bottom:-32px;}";


// Drop down Menus -->
$navbar_markup .=".dropdown-menu li > a{
	background-color:transparent !important;
	color:".$dropdownMenuLink['color']." !important;
	text-decoration:".$dropdownMenuLink['decoration']." !important;
}";

//Drop down triangle
$navbar_markup .=".dropdown-menu li > a:after {
    border-left-color:".$dropdownMenuLink['color']." !important;
}";

// active link -->
$navbar_markup .=".dropdown-menu li.active > a{
	background:".$dropdownMenuLinkActive['bg_color']." !important; 
	color:".$dropdownMenuLinkActive['color']." !important;
	text-decoration:".$dropdownMenuLinkActive['decoration']." !important;
}";

$navbar_markup .=".dropdown-menu li.active > a:after{
	border-left-color:".$dropdownMenuLinkActive['color']." !important;
}";

// hovered link -->
$navbar_markup .=".dropdown-menu li > a:hover{
	background:".$dropdownMenuLinkHovered['bg_color']." !important; 
	color:".$dropdownMenuLinkHovered['color']." !important;
	text-decoration:".$dropdownMenuLinkHovered['decoration']." !important;
}";
$navbar_markup .=".dropdown-menu li > a:hover:after{
	border-left-color:".$dropdownMenuLinkHovered['color']." !important;	
}";

// collapsible navbar link -->

$navbar_markup .=".dropdown-menu.sub-menu li.active >a,
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li.active > ul > li > ul >li >a,
.current_page_item > a,.current-menu-item > a ,.current-page-ancestor > a,{
	background-color:none!important;
	color:".$navbarLinkHovered['color']." !important;	
}";

/* ************************ sidr Nav ******************************* */
$navbar_markup .=".sidr
	{
		background-color:".$dropdownMenuBackgroundColors['color']." !important;
		-webkit-box-shadow:inset 0 0 5px 5px rgba(0,0,0,.2);
		-moz-box-shadow:inset 0 0 5px 5px rgba(0,0,0,.2);
		box-shadow:inset 0 0 5px 5px rgba(0,0,0,.2)}
	}";

	$navbar_markup .=".sidr ul
		{
			border:none;
		}";
	$navbar_markup .=".sidr ul li
		{
			border-top:none;
			border-bottom:none;
		}";
	$navbar_markup .=".sidr ul li a,
		.sidr ul li span
		{
			color:".$dropdownMenuLink['color']." !important;
		}";

	$navbar_markup .=".sidr ul li:hover a,
		.sidr ul li:hover span
		{
			color:".$dropdownMenuLinkHovered['color']." !important;
		}";
	$navbar_markup .=".sidr ul li ul li:hover>a,
		.sidr ul li ul li:hover>span,
		.sidr ul li ul li.active>a,
		.sidr ul li ul li.active>span,
		.sidr ul li ul li.sidr-class-active>a,
		.sidr ul li ul li.sidr-class-active>span
		{
			-webkit-box-shadow:none;
			-moz-box-shadow:none;
			box-shadow:none;
		}";

// collapsed navbar button -->
$navbar_markup .=".btn-navbar{ 
	background:".$navSettings['menu_btn_bg'].";
}";

$navbar_markup .=".btn-navbar:hover,.btn-navbar:active{ 
	background:".$navSettings['menu_btn_bg_hovered'].";
	
}";
$navbar_markup .=".nav .divider-vertical{
	border-left: 1px solid ".$navbarBackground['endcolor'].";
	border-right: 1px solid ".$navbarBackground['color'].";
}";

// Navlink Tyles -->


	// Link styles
	if($navSettings['navbar_link_style'] == 'none'){
		$navbar_markup .=".navbar .nav li.open a,.navbar .nav li.active a,.navbar .nav li a:hover{background:none !important;}";
	}elseif($navSettings['navbar_link_style'] == 'highlighted'){

	}elseif($navSettings['navbar_link_style'] == 'pills'){

	}elseif($navSettings['navbar_link_style'] == 'tabs-below'){
		$navbar_markup .=".nav-tabs, .nav{border-bottom:0 !important; margin-bottom:-2px;}";
		$navbar_markup .=".nav-tabs li a,
				 .navbar .nav li a{border-color:".$navbarLink['border_color']."; border-top:0 !important; border-radius: 0 0 4px 4px !important; height:17px;}";
		$navbar_markup .=".nav-tabs li a:hover, 
				.navbar .nav li a:hover, 
				.active a{border-color:".$navbarLinkHovered['border_color']." !important; }";
		$navbar_markup .=".current_page_item a{border-color:".$navbarLinkActive['border_color']." !important;}";

	}elseif($navSettings['navbar_link_style'] == 'tabs'){
		$navbar_markup .=".nav-tabs, .nav{border-bottom:0 !important; margin-bottom:-2px;}";
		$navbar_markup .=".nav-tabs li a, .navbar .nav li a{border-color:".$navbarLink['border_color']."; border-bottom:0 !important; height:17px;}";
		$navbar_markup .=".nav-tabs li a:hover, .navbar .nav li a:hover, .active a{border-color:".$navbarLinkHovered['border_color']." !important; }";
		$navbar_markup .= ".current_page_item a{border-color:".$navbarLinkActive['border_color']." !important;}";
	}


if($dropdown_bg != true){
		$media_767_markup .= ".nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > a:hover,
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul, 
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > a:hover,
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > a:hover:after,
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > ul,
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > ul >li >a:hover{
		
					background-color:none!important;
					color:".$navbarLinkHovered['color']." !important;	
				}";
	}else{
	  $media_767_markup .= ".nav-collapse.collapse > .nav:before
	  	  {
	  	     border-bottom: 7px solid ".$dropdownMenuTopBorder['color']." !important;
	  	      border-left: 7px solid transparent;
	  	      border-right: 7px solid transparent;
	  	      content: '';
	  	      display: inline-block;
	  	      right: 9px;
	  	      position: absolute;
	  	      top: -7px;
	  	  }";

	  $media_767_markup .= ".nav-collapse.collapse > .nav:after
	  	  {
	  	       border-bottom: 6px solid ".$dropdownMenuBackgroundColors['color']." !important;
	  	      border-left: 6px solid transparent;
	  	      border-right: 6px solid transparent;
	  	      content: '';
	  	      display: inline-block;
	  	      right: 10px;
	  	      position: absolute;
	  	      top: -6px;
	  	  }";
	  $media_767_markup .= ".nav-collapse.collapse > .nav
	  	  {    
	  	      background-clip: padding-box;
	  	      background-color:".$dropdownMenuBackgroundColors['color']." !important;
	  	      border: 1px solid rgba(0, 0, 0, 0.2);
	  	      border-radius: 6px 6px 6px 6px;
	  	      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	  	      float: right;
	  	      left: 0;
	  	      list-style: none outside none;
	  	      margin: 10px 0 0;
	  	      min-width: 160px;
	  	      padding: 5px 0;
	  	      z-index: 1000;
	  	  } ";
	} 

	return ($navbar_markup);
}

function mediaQuery767Callback(&$media_767_markup){


	$media_767_markup .= '}';
	return $media_767_markup;
}