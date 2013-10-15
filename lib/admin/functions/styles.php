<?php
/*
Template Name: Style Sheet
*/
/*
	$section = section
	$array =
	$preview = js object containing the section, field name
*/
function kjd_get_temp_settings($section, $array, $preview, $part) {
	if($preview != null){
		if( $section == $preview['section'] ){
			// echo 'Part: '.$part;
			// echo 'preview settings:';
			// print_r($preview['settings'] ); die();
			foreach( $preview['settings'] as $settings ){

				if($settings['name'] == $part){

					// echo 'Part: '.$part;
					// echo'old'."\n";
					// print_r($array);
					// echo 'preview: '."\n";
					// print_r($settings);
					$array[ $settings['field'] ] = $settings['value'];
					// echo 'NEW: '."\n";
					// print_r($array);
					// die();
				} // end field matching
				

			} // end looping through preview settings

			// if($part == 'kjd_section_link'){
			// 	print_r($array); die();
			// }
		} // end setting section checking
	} // end preview
	return $array;
}


function kjd_get_theme_options($preview = null){


	settings_fields( 'kjd_component_settings' ); 
	$options = get_option('kjd_component_settings');

	$sections = array('htmlTag','bodyTag','mastArea','sidrDrawer','header','navbar','dropdown-menu',
		'cycler','contentArea','pageTitle','body','footer');


	//adds widget and post style sections
    if($options['style_widgets']=='true'){
		$sections[] = 'widgets';
    }

	$options = get_option('kjd_posts_misc_settings');
	$options = $options['kjd_posts_misc'];
	
    if($options['style_posts']=='true'){
		$sections[] = 'posts';
    }


	$section_output = '';
	$media_979_markup ='@media(max-width:979px){';

	$miscMarkup = miscStylesCallback();

	$navArea_markup = navbarStylesCallback($media_979_markup);
	$media_979_markup .= mediaQuery979Callback($media_979_markup);

	foreach($sections as $section){


		// Misc Settings
		$miscSettings = get_option('kjd_'.$section.'_misc_settings');
		$miscSettings = $miscSettings['kjd_'.$section.'_misc'];
		$kjd_section_confine_background = $miscSettings['kjd_'.$section.'_confine_background'];


		/* -----------------------------------------------------
		 Background Options 
		 ----------------------------------------------------- */
		$options_backgrounds = get_option('kjd_'.$section.'_background_settings');

		$kjd_section_background_colors = kjd_get_temp_settings(	$section,  
																$options_backgrounds['kjd_'.$section.'_background_colors'], 
																$preview, 
																'kjd_section_background_colors' 
															);


		$kjd_section_background_wallpaper = kjd_get_temp_settings($section, $options_backgrounds['kjd_'.$section.'_background_wallpaper'], $preview, 'kjd_section_background_wallpaper');
		$backgroundSettings = array('kjd_section_background_colors'=>$kjd_section_background_colors,'kjd_section_background_wallpaper'=>$kjd_section_background_wallpaper);

		/* ----------------------------------------------------- 
		Border Options
		 ----------------------------------------------------- */
		$options_border = get_option('kjd_'.$section.'_borders_settings');

		$kjd_section_top_border = kjd_get_temp_settings(	$section, 
															$options_border['kjd_'.$section.'_top_border'],
															$preview, 
															'kjd_section_top_border' 
															);

		$kjd_section_right_border = kjd_get_temp_settings(	$section,
															$options_border['kjd_'.$section.'_right_border'],
															$preview, 
															'kjd_section_right_border' 
															);
		$kjd_section_bottom_border = kjd_get_temp_settings(	$section,
															$options_border['kjd_'.$section.'_bottom_border'],
															$preview, 
															'kjd_section_bottom_border' 															
															);
		$kjd_section_left_border = kjd_get_temp_settings(	$section,
															$options_border['kjd_'.$section.'_left_border'],
															$preview, 
															'kjd_section_left_border' 
															);


		if($kjd_section_confine_background =='true' || $section =='dropdown-menu' || $section =='posts'){
			$sectionBorders = array('top'=>$kjd_section_top_border,'right'=>$kjd_section_right_border,'bottom'=>$kjd_section_bottom_border,'left'=>$kjd_section_bottom_border);
		}else{
			$sectionBorders = array('top'=>$kjd_section_top_border,'bottom'=>$kjd_section_bottom_border);
		}

		
		/* ----------------------------------------------------- 
		Border Radius Options
		 ----------------------------------------------------- */
		$kjd_section_border_radius = kjd_get_temp_settings(	$section,
															$options_border['kjd_'.$section.'_border_radius'],
															$preview,
															'kjd_section_border_radius'
															);
		$sectionBordersRadiuses = array(
			'top-left'=>$kjd_section_border_radius['top-left'],
			'top-right'=>$kjd_section_border_radius['top-right'],
			'bottom-right'=>$kjd_section_border_radius['bottom-right'],
			'bottom-left'=>$kjd_section_border_radius['bottom-left']
		);
		
		/* ----------------------------------------------------- 
		Heading Tag Options
		 ----------------------------------------------------- */
		$options_htag = get_option('kjd_'.$section.'_text_settings');

		$kjd_section_text = kjd_get_temp_settings(	$section,
													$options_htag['kjd_'.$section.'_text'],
													$preview,
													'kjd_section_text'
													);


		$kjd_section_H1 =  kjd_get_temp_settings(	$section,
													$options_htag['kjd_'.$section.'_H1'],
													$preview,
													'kjd_section_H1'
												);
		
		$kjd_section_H2 = kjd_get_temp_settings(	$section,
													$options_htag['kjd_'.$section.'_H2'],
													$preview,
													'kjd_section_H2'
												);
		
		$kjd_section_H3 = kjd_get_temp_settings(	$section,
													$options_htag['kjd_'.$section.'_H3'],
													$preview,
													'kjd_section_H3'
												);
		
		$kjd_section_H4 = kjd_get_temp_settings(	$section,
													$options_htag['kjd_'.$section.'_H4'],
													$preview,
													'kjd_section_H4'
												);

		$hTags = array(
						'h1' => $kjd_section_H1,
						'h2' => $kjd_section_H2,
						'h3' => $kjd_section_H3,
						'h4' => $kjd_section_H4
					);

		/* ----------------------------------------------------- 
		Link Options
		 ----------------------------------------------------- */
		$options_links = get_option('kjd_'.$section.'_links_settings');

		$kjd_section_link = kjd_get_temp_settings(	$section,
													$options_links['kjd_'.$section.'_link'],
													$preview,
													'kjd_section_link'
												);

		$kjd_section_linkHovered = kjd_get_temp_settings(	$section,
															 $options_links['kjd_'.$section.'_linkHovered'], 
															 $preview,
													'kjd_section_linkHovered'
								);
		$kjd_section_linkVisited = kjd_get_temp_settings(	$section,
															 $options_links['kjd_'.$section.'_linkVisited'], 
															 $preview,
													'kjd_section_linkVisited'
								);
		$kjd_section_linkActive =  kjd_get_temp_settings(	$section,
																$options_links['kjd_'.$section.'_linkActive'], 
																$preview,
													'kjd_section_linkActive'
								);


		$linkSettings = array(
			'a' => $kjd_section_link,
			'a:hover' => $kjd_section_linkHovered,
			'a:visited' => $kjd_section_linkVisited,
			'a:active' => $kjd_section_linkActive
		);


		/* ----------------------------------------------------- 
		Componenets Options
		 ----------------------------------------------------- */
		$options_components = get_option('kjd_'.$section.'_components_settings');

		$kjd_section_components = $options_components['kjd_'.$section.'_components'];

		$tabbed_content = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['tabbed_content'],
											$preview,
											'tabbed_content'
										);
		$collapsible_content = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['collapsible_content'],
											$preview,
											'collapsible_content'
										);
		$table_content = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['table_content'],
											$preview,
											'table_content'
										);	
		$pagination_content = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['pagination'],
											$preview,
											'pagination'
										);
		$list = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['list'],
											$preview,
											'list'
										);
		$forms = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['forms'],
											$preview,
											'forms'
										);




		/* ----------------------------------------------------- 
		Images Options
		 ----------------------------------------------------- */
		$images = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['images'],
											$preview,
											'images'
										);
		$thumbnails = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['thumbnails'],
											$preview,
											'thumbnails'
										);
		$captions = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['captions'],
											$preview,
											'captions'
										);
		/* ----------------------------------------------------- 
		Misc Options
		----------------------------------------------------- */
		$options_misc = get_option('kjd_'.$section.'_misc_settings');
		$kjd_section_misc = kjd_get_temp_settings(	
											$section,
											$kjd_section_misc['kjd_'.$section.'_misc'],
											$preview,
											'kjd_section_misc'
									);
		
		/* ----------------------------------------------------- 
		Confine Section - activates left and right borders
		 ----------------------------------------------------- */
		$kjd_section_confine_background = $kjd_section_misc['kjd_'.$section.'_confine_background'];
		
		if($kjd_section_confine_background=='true' || $section =='dropdown-menu'){
		
			$borders = array(	
				'top' =>$kjd_section_top_border,
				'right' =>$kjd_section_right_border,
				'bottom' =>$kjd_section_bottom_border,
				'left' =>$kjd_section_left_border
			);
		
		}else{
		
			$borders = array(
				'top' =>$kjd_section_top_border,
				'bottom' =>$kjd_section_bottom_border
			);
		
		}

		/* ----------------------------------------------------- 
		Add all options to a large array for each section
		----------------------------------------------------- */
		$section_options = array(
			'backgroundSettings' =>$backgroundSettings,
			'sectionBorders' =>$sectionBorders,
			'sectionBordersRadiuses' =>$sectionBordersRadiuses,
			'kjd_section_text' =>$kjd_section_text,
			'linkSettings' =>$linkSettings,
			'hTags' =>$hTags,
			'tabbed_content' =>$tabbed_content,
			'collapsible_content' =>$collapsible_content,
			'table_content'=>$table_content,
			'pagination_content'=>$pagination_content,
			'list' =>$list,
			'forms'=>$forms,
			'images'=>$images,
			'thumbnails'=>$thumbnails,
			'captions'=>$captions,
			'miscSettings'=>$miscSettings
		);


		$section_output .= section_markup_callback($section,$section_options);
		
	}

		
	$section_output .= postSettingsCallback();
	
	/* ----------------------------------------------------- 
	Responsive markup
	 ----------------------------------------------------- */
	$media_767_output = '@media(max-width: 768px){ #navbar{';
			$media_767_output .= 'clear: both;';
			$media_767_output .= 'float: none;';
			$media_767_output .= 'margin-top: 0;';
		$media_767_output .= '} }';

	// return $section_output;
	return $miscMarkup.$section_output.$navArea_markup.$media_979_markup.$media_767_output; 
	
} // end build css function



/* -------------------------------------------------------------------------------------------
						Build markup - calls th eappropriate fucntions for each section
----------------------------------------------------------------------------------------- */
function section_markup_callback($section,$section_options){
	extract($section_options);
	extract($backgroundSettings);

	
switch($section)
{
	case 'dropdown-menu':
		$section_name = '.dropdown-menu';
		break;
	case 'cycler':
		$section_name = '#imageSliderWrapper';
		break;
	case 'navbar':

			$section_name = '#'.$section.' .navbar-inner';
		
		break;
	case 'htmlTag':
		$section_name =  'html';
		break;		
	case 'bodyTag':
		$section_name = 'body';
		break;
	case 'sidrDrawer':
		$section_name = '#sidr';
		break;
	case 'posts':
			$section_name = '.the-content-wrapper.well';
		break;
	case 'widgets':
			$section_name = '#sideContent widget';
		break;
	default:
		$section_name = '#'.$section;
		break;
}


	$type = $kjd_section_background_colors['gradient'];
	if(!empty($miscSettings['kjd_'.$section.'_section_shadow'])){
		$sectionShadow = $miscSettings['kjd_'.$section.'_section_shadow'];	
	}
	
	if($section =="header"){
		$hideHeader = $miscSettings['hide_header']; 
		$forceHeight = $miscSettings['force_height'];
		$logo_alignment = $miscSettings['logo_align'];
		$logo_pull = $miscSettings['logo_margin'];
		//$useMast = $miscSettings['use_mastArea'];				
	}


	$sectionArea_markup = '';

	if($section =="cycler"){
		$forceHeight = $miscSettings['force_height'];
		if($forceHeight =='true'){
			$section_height = !empty($miscSettings['height']) ? $miscSettings['height'] : '' ;
		}
		$sectionArea_markup .= $section_name.' #imageSlider, .rslides{';
			$sectionArea_markup .= "height:".$section_height."px;";
		$sectionArea_markup .= '}';		
	}





	if($section == 'posts'){
		if($miscSettings['style_posts'] == 'true'){
			$sectionArea_markup .= 	'.content-list > .the-content-wrapper.well{';
				$sectionArea_markup .= 'margin-bottom:40px;';
			$sectionArea_markup .=' }';

			$sectionArea_markup .= 	'.content-list > .the-content-wrapper.well h3 {';
				$sectionArea_markup .= 'margin-top:0;';
			$sectionArea_markup .=' }';
		}

	}


// start section markup
	$sectionArea_markup .= $section_name.'{';


	if(!empty($miscSettings[$section.'_section_shadow']) && $miscSettings[$section.'_section_shadow'] != 'none'){


		switch( $miscSettings[$section.'_section_shadow'] ){
			case 'left and right':

				$sectionArea_markup .= 'box-shadow: 0 9px 0px 0px white, 0 -9px 0px 0px white, ';
				$sectionArea_markup .= '12px 0 15px -4px rgba(31, 73, 125, 0.8), -12px 0 15px -4px rgba(31, 73, 125, 0.8);';
				break;
			case 'top and bottom':
				break;
			case 'top':
				break;
			case 'bottom':
				break;
			case 'all sides':
				break;

		}

	}

	if(!empty($miscSettings['float']['toggle']) && $miscSettings['float']['toggle'] == 'true'){

		$margin_top = !empty($miscSettings['float']['margin_top']) ? $miscSettings['float']['margin_top'] : '0' ;
		$margin_bottom = !empty($miscSettings['float']['margin_bottom']) ? $miscSettings['float']['margin_bottom'] : '0' ;
		
		$sectionArea_markup .= "margin-top:".$margin_top."px;";
		$sectionArea_markup .= "margin-bottom:".$margin_bottom."px;";
	}

	if($section=='header' && $forceHeight =="true" && !empty($miscSettings['header_height'])){
		$sectionArea_markup .= "height:".$miscSettings['header_height']."px;";
	}

	if($section=='cycler' && $forceHeight =="true" && !empty($miscSettings['height'])){
		$sectionArea_markup .= "height:".$miscSettings['height']."px;";
	}

	if($section =='footer'){

		$height = !empty($miscSettings['height']) ? $miscSettings['height'] : '300' ;
		$sectionArea_markup .= "height:".$height."px;";	

	}
	/* ----------------------------------------------------------------------------- *
							background stuff
	----------------------------------------------------------------------------- */
	$sectionArea_markup .= background_type_callback($type,$kjd_section_background_colors);
	//wallpaper function
	$sectionArea_markup .= wallpaper_callback($kjd_section_background_wallpaper);

			
	/* ----------------------------------------------------------------------------- *
						borders stuff
	----------------------------------------------------------------------------- */
	foreach($sectionBorders as $k =>$v){
		$sectionArea_markup .= borderSettingsCallback($k, $v);	
	}
	
	//border radius function
	foreach($sectionBordersRadiuses as $k =>$v){
		$sectionArea_markup .= borderRadiusCallback($k, $v);	
	}
	

	/* ----------------------------------------------------------------------------- *
						font colors
	---------------------------------------------------------------------------- */
	$sectionArea_markup .= 'color:'.$kjd_section_text['color'].';';
	
	/* ----------------------------------------------------------------------------- *
						Misc section styles
	----------------------------------------------------------------------------- */
	if($section =='header' && $hideHeader == 'true'){
		$sectionArea_markup .= 'display:none !important;';
		$sectionArea_markup .= 'height:0 !important;';
	}
	

	if($section =='mastArea'){
		$miscOptions = get_option('kjd_mastArea_background_settings');
		$miscSettings = $miscOptions['kjd_mastArea_background_misc'];
		if(!empty($miscSettings['use_top_padding']) && $miscSettings['use_top_padding'] =="true"){
			$sectionArea_markup .= "padding-top:".$miscSettings['top_padding']."px;";
		}
		if(!empty($miscSettings['use_bottom_padding']) && $miscSettings['use_bottom_padding'] =="true"){
			$sectionArea_markup .= "padding-bottom:".$miscSettings['bottom_padding']."px;";
		}
	}

	if($section =='sidrDrawer'){
		$sectionArea_markup .= 'border-right: 5px solid'.$kjd_section_background_colors['sidr_border'];
	}
	$sectionArea_markup .= '}';

	if($section == 'header'){
		$sectionArea_markup .= '.logo-wrapper{ ';

			if ( !empty($logo_pull) && isset($logo_pull) ){
				$sectionArea_markup .= 'margin-bottom: '.$logo_pull .'px;';
			}

			if($logo_alignment == 'left' || $logo_alignment == 'right'){
				$sectionArea_markup .= 'text-align: ' . $logo_alignment . ' ;';
			}elseif($logo_alignment == 'center'){
				$sectionArea_markup .= 'display: block; float: none;  text-align: center;';	
			}
			
		$sectionArea_markup .= '}';
	}

	if($section == 'dropdown-menu'){
		$sectionArea_markup .= '.dropdown-submenu > .dropdown-menu{ ';

		foreach($sectionBordersRadiuses as $k =>$v){
			$sectionArea_markup .= borderRadiusCallback($k, $v);	
		}
		$sectionArea_markup .= '}';
	}


/* ----------------------------------------------------------------------------- *
						Link and heading tag styles
----------------------------------------------------------------------------- */
	if(	 $section !='bodyTag' && $section !='htmlTag' && $section != 'mastArea' && $section != 'sidrDrawer' &&
		 $section !='cycler' && $section !="navbar" && $section !='dropdown-menu' && $section !='contentArea'){
		
		// Links
		foreach($linkSettings as $link_type => $v){
			$sectionArea_markup .= $section_name.' '.$link_type.'{';
				$sectionArea_markup .= linkSettingsCallback($v, $section);
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
		$sectionArea_markup .= kjd_image_cycler_settings_callback($miscSettings);
	}


/* ----------------------------------------------------------------------------- *
						Components
----------------------------------------------------------------------------- */
	if($section =='body' || $section =='footer' || $section =='header'){
		//tabbed
		$sectionArea_markup .= tabbedMarkupCallback($section, $tabbed_content);
		//collapsibles
		$sectionArea_markup .= collapsibleMarkupCallback($section, $collapsible_content);
		//tables
		$sectionArea_markup .= tableMarkupCallback($section, $table_content);
		//pagination
		$sectionArea_markup .= paginationMarkupCallback($section, $pagination_content);
		//forms
		$sectionArea_markup .= formsMarkupCallback($section, $forms);
		//images
		$sectionArea_markup .= imagesMarkupCallback($section, $images);
		//thumbnails
		$sectionArea_markup .= thumbnailsMarkupCallback($section, $thumbnails);
		//image captions
		$sectionArea_markup .= captionImagesMarkupCallback($section, $captions);
		//lists
		$sectionArea_markup .= listsMarkupCallback($section, $list);
	}

	if($section =='navbar') {
		$sectionArea_markup .= formsMarkupCallback($section, $forms);
	}
	return $sectionArea_markup;

}
/* ---------------------------------------------------------------- 
					image cycler settings
------------------------------------------------------------------- */

function kjd_image_cycler_settings_callback($miscSettings){
		$cycler_output = '';

		if($miscSettings['shadow'] == "true"){ 
			$cycler_output .= '#imageSlider{';
				$cycler_output .= 'background:url(../images/shadow.png) no-repeat bottom center; ';
				$cycler_output .= 'padding:20px 0 60px; ';
			$cycler_output .= '}';
		}

		if($miscSettings['plugin'] == "single image"){
	
			$cycler_output .=".singleImage{
						background:".$miscSettings['backgroundColor'].";
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

/* ----------------------------------------------------------------------------- *
						background functions
----------------------------------------------------------------------------- */

 //background type takes the $type argument and uses it to return the appropriate function
function background_type_callback($type = null,$kjd_section_background_colors = array()){
	if( !empty($kjd_section_background_colors) )
		extract($kjd_section_background_colors); 

	// $start_color = !empty($kjd_section_background_colors['start_rgba']) ? $kjd_section_background_colors['start_rgba'] : $kjd_section_background_colors['color'];
	// $end_color = !empty($kjd_section_background_colors['endcolor']) ? $kjd_section_background_colors['endcolor'] : $kjd_section_background_colors['endcolor'];
$start_color =  $kjd_section_background_colors['color'];
	$end_color =  $kjd_section_background_colors['endcolor'];

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
function verticalGradientCallback($startColor, $endColor){ 
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
function wallpaper_callback($kjd_section_background_wallpaper){
	$backgroundImage = $kjd_section_background_wallpaper['image'];
	
	$backgroundPosition = $kjd_section_background_wallpaper['position'];
	$backgroundPositionX = !empty($kjd_section_background_wallpaper['positionX'])? $kjd_section_background_wallpaper['positionX'] : '0' ;
	$backgroundPositionY = !empty($kjd_section_background_wallpaper['positionY'])? $kjd_section_background_wallpaper['positionY'] : '0' ;
	$backgroundRepeat = $kjd_section_background_wallpaper['repeat'];

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


	}
	return $wallpaper_markup;
}





// /* ------------------------- border settings -----------------------------*/
function borderSettingsCallback($position, $border){
//	extract($sectionBorders); //

	$border_style_markup = '';
//$borders = array('top' =>$kjd_section_top_border,'right' =>$kjd_section_right_border,'bottom' =>$kjd_section_bottom_border,'left' =>$kjd_section_left_border);

	$borderStyle = $border['style'];
	$borderColor = $border['color'];
	$borderSize = $border['size'];

	if(isset($borderStyle) && $borderStyle!="none"){
		$border_style_markup .= 'border-'.$position.'-style:'.$borderStyle.' !important;';

		if (isset($borderColor)&& !empty($borderColor)){
			$border_style_markup .= 'border-'.$position.'-color:'.$borderColor.' !important;';
		}
		if (isset($borderSize) && !empty($borderSize)){
			$border_style_markup .= 'border-'.$position.'-width:'.$borderSize.' !important;'; 
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
		$link_style_markup .= 'padding:4px;';
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


// /* ------------------------- tables -----------------------------*/
function tableMarkupCallback($section, $table_content){
$table_markup = '';


	$table_markup .= '#'.$section.' .table,';
	$table_markup .= '#'.$section.' .table td,';
	$table_markup .= '#'.$section.' .table th{';
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


// /* ------------------------- pagination -------------------------*/
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
	$pagination_markup .= '#body .pagination ul>li>a, .pagination ul>li>span';
	$pagination_markup .= '{';
		$pagination_markup .= 'background:'. $background.' ;';
		$pagination_markup .= 'border-color:'. $border.' ;';
	$pagination_markup .= '}';

	$pagination_markup .= '#body .pagination ul > li span.current{';
		$pagination_markup .= 'background:'. $background_current.' ;';
		$pagination_markup .= 'color:'. $text_current.' ;';
	$pagination_markup .= '}';


	$pagination_markup .= '#body .pagination ul > li a.page-numbers';
	$pagination_markup .= '{';
		$pagination_markup .= 'color:'. $link.' ;';
	$pagination_markup .= '}';

	$pagination_markup .= '#body .pagination ul > li > a:hover, .pagination ul > li > a:focus, .pagination ul > .active > a,';
	$pagination_markup .=  '#body .pagination ul > .active > span';
	$pagination_markup .= '{';
		$pagination_markup .= 'background:'.$background_hover.' ;';
		$pagination_markup .= 'color:'. $link_hover.' ;';
	$pagination_markup .= '}';


	$pagination_markup .= '#body .pagination ul > li span.page-numbers';
	$pagination_markup .= '{';
		$pagination_markup .= 'color:'. $text.' ;	';
	$pagination_markup .= '}';


return $pagination_markup;
}

// /* ------------------------- Lists -------------------------*/
function listsMarkupCallback($section, $list){

	$background = !empty($list['background_color']) ? $list['background_color'] : 'transparent' ;
	$background_hover = !empty($list['background_hover_color']) ? $list['background_hover_color'] : 'transparent';

	$list_markup = '';
	$list_markup .= '#'. $section.' .content-nav.li > nav > span{';
		$list_markup .= 'color:'.$list['text_color'].';';
	$list_markup .= '}';

	$list_markup .= '#'. $section.' .content-nav.nav > li > span:hover{';
		$list_markup .= 'color:'.$list['text_hover_color'].';';
	$list_markup .= '}';

	$list_markup .= '#'. $section.' .content-nav.nav > li > a,';
	$list_markup .= '#'. $section.' .content-nav.nav > li > span {';
		$list_markup .= 'background-color:'.$background.';';
		$list_markup .= 'border-color:'.$list['border_color'].';';
	$list_markup .= '}';

	$list_markup .= '#'. $section.' .content-nav.nav > li > a{';
		$list_markup .= 'color:'.$list['link_color'].';';
	$list_markup .= '}';

	$list_markup .= '#'. $section.' .content-nav.nav > li > a:hover,';
	$list_markup .= '#'. $section.' .content-nav.nav > li.current-menu-item > a,';
	$list_markup .= '#'. $section.' .content-nav.nav > li > span:hover {';
		$list_markup .= 'background-color:'.$background_hover.';';
		$list_markup .= 'border-color:'.$list['border_hover_color'].';';
	$list_markup .= '}';

	$list_markup .= '#'. $section.' .content-nav.nav > li > a:hover,';
	$list_markup .= '#'. $section.' .content-nav.nav > li.current-menu-item > a{';
		$list_markup .= 'color:'.$list['link_hover_color'].';';	
	$list_markup .= '}';

	return $list_markup;

}

// /* ------------------------- forms -----------------------------*/
function formsMarkupCallback($section, $forms){
$form_markup = '';
$form_markup .= '#'. $section.' form{';
	$form_markup .= 'background:'. $forms['form_background'].' ; ';
	$form_markup .= 'border-color:'. $forms['form_border'].';';
	$form_markup .= 'color:'. $forms['container_text'].';';

if( (isset($forms['form_background']) && $forms['form_background']!= '' && $forms['form_background']!= ' ' ) || (isset($forms['container_border']) && $forms['container_border']!= '' && $forms['container_border']!= ' ') ){
	$form_markup .= ' "padding:10px; border-radius:4px;";';
}
$form_markup .= '}';


//input areas
$form_markup .= '#'. $section.' input[type="radio"],'; 
$form_markup .= '#'. $section.' input[type="checkbox"],';
$form_markup .= '#'. $section.' textarea,';
$form_markup .= '#'. $section.' input[type="text"],';
$form_markup .= '#'. $section.' input[type="password"],';
$form_markup .= '#'. $section.' input[type="datetime"],';
$form_markup .= '#'. $section.' input[type="datetime-local"],';
$form_markup .= '#'. $section.' input[type="date"],';
$form_markup .= '#'. $section.' input[type="month"],';
$form_markup .= '#'. $section.' input[type="time"],';
$form_markup .= '#'. $section.' input[type="week"],';
$form_markup .= '#'. $section.' input[type="number"],';
$form_markup .= '#'. $section.' input[type="email"],';
$form_markup .= '#'. $section.' input[type="url"],';
$form_markup .= '#'. $section.' input[type="search"],';
$form_markup .= '#'. $section.' input[type="tel"],';
$form_markup .= '#'. $section.' input[type="color"],';
$form_markup .= '#'. $section.' select,';
$form_markup .= '#'. $section.' input[type="file"] {';
	$form_markup .= 'color:'. $forms['field_text'].';';
	$form_markup .= 'background:'. $forms['field_background'].';';
	$form_markup .= 'border-color:'. $forms['field_border'].';';
$form_markup .= '}';

//input areas on focus
$form_markup .= '#'. $section.' input[type="radio"]:focus, 
#'. $section.' input[type="checkbox"]:focus, 
#'. $section.' textarea:focus,#'. $section.'  input[type="text"]:focus,
#'. $section.'  input[type="password"]:focus,
#'. $section.'  input[type="datetime"]:focus,
#'. $section.'  input[type="datetime-local"]:focus,
#'. $section.'  input[type="date"]:focus,
#'. $section.'  input[type="month"]:focus,
#'. $section.'  input[type="time"]:focus,
#'. $section.'  input[type="week"]:focus,
#'. $section.'  input[type="number"]:focus,
#'. $section.'  input[type="email"]:focus,
#'. $section.'  input[type="url"]:focus,
#'. $section.'  input[type="search"]:focus,
#'. $section.'  input[type="tel"]:focus,
#'. $section.'  input[type="color"]:focus,
#'. $section.'  .uneditable-input:focus {';
	$form_markup .= 'border-color: :'. $forms['field_border'].';';
	$form_markup .= 'box-shadow: 0 0 8px '. $forms['field_glow'].';';
$form_markup .= '}';

$form_markup .= '#'. $section.' form button,';
$form_markup .=' #'. $section.' form input[type=submit],';
$form_markup .= '#'. $section.' form .btn {';
	$form_markup .= 'background-image:none;';
	$form_markup .= verticalGradientCallback($forms['button_background'], $forms['button_background_end']);
	$form_markup .= 'border-color:'. $forms['button_border'].' !important;';
	$form_markup .= 'color:'. $forms['button_text'].' !important;';
$form_markup .= '}';

//form buttons - mostly the submit button on hover
$form_markup .= '#'. $section.' form button:hover,';
$form_markup .= '#'. $section.' form input[type=submit]:hover,';
$form_markup .= '#'. $section.' form .btn:hover{';
	$form_markup .= 'background-color:'. $forms['button_background_end'].' !important;';
	$form_markup .= '}';

// echo $form_markup;die();
	return $form_markup;
}

// /* ----------------------------- Collapsibles ------------------------------ */
function collapsibleMarkupCallback($section, $collapsible_content)
{
	$collapsible_markup =''; 
$collapsible_markup .= '#'. $section.' .accordion-group{';
$collapsible_markup .= 'background:'. $collapsible_content['collapible_content_background'].'; ';
$collapsible_markup .= 'border-color:'. $collapsible_content['collapible_content_border'].' ;';
$collapsible_markup .= '}';
/*the title*/
$collapsible_markup .= '#'. $section.' .accordion-heading > a.collapsed{';
$collapsible_markup .= 'background:'. $collapsible_content['inactive_title_background'].'; ';
$collapsible_markup .= 'color:'. $collapsible_content['inactive_title_link_color'].';';
$collapsible_markup .= '}';
$collapsible_markup .= '#'. $section.' .accordion-heading a{';
$collapsible_markup .= 'background:'. $collapsible_content['active_title_background'].'; ';
$collapsible_markup .= 'color:'. $collapsible_content['active_title_link_color'].';';
$collapsible_markup .= '}';
/* when closed*/
$collapsible_markup .= '#'. $section.' .accordion-heading > .collapsed{';
$collapsible_markup .= 'background:'. $collapsible_content['inactive_title_background'].' ;';
$collapsible_markup .= 'color:'. $collapsible_content['inactive_title_link_color'].' ;';
$collapsible_markup .= '}';
$collapsible_markup .= '#'. $section.' .accordion-heading a:hover{';
$collapsible_markup .= 'background:'. $collapsible_content['hovered_title_background'].' ;';
$collapsible_markup .= 'color:'. $collapsible_content['hovered_title_link_color'].' ;';
$collapsible_markup .= '}';
/*the content */
$collapsible_markup .= '#'. $section.' .accordion-inner {';
$collapsible_markup .= 'border-top-color:'. $collapsible_content['collapible_content_border'].' ;';
$collapsible_markup .= 'color:'. $collapsible_content['collapible_content_text_color'].';';
$collapsible_markup .= '}';

/*the content */
$collapsible_markup .= '#'. $section.' .accordion-inner a{';
$collapsible_markup .= 'color:'. $collapsible_content['collapible_content_link_color'].';';
$collapsible_markup .= '}';


$collapsible_markup .= '#'. $section.' .accordion-heading > a.collapsed, ';
$collapsible_markup .= '#'. $section.' .accordion-heading >a,';
$collapsible_markup .= '#'. $section.' .accordion-heading >a:hover{ text-decoration:none ;}';

return $collapsible_markup;
}

// /* -------------------------  Tabbed content ----------------------------------*/
function tabbedMarkupCallback($section, $tabbed_content){
$tabbed_markup = '';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav{';
	$tabbed_markup .= 'border: 0px !important; margin:0;';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav > li > a{ ';
	$tabbed_markup .= 'background:'. $tabbed_content['inactive_tab_background'].'; ';
	$tabbed_markup .= 'border-color:'. $tabbed_content['inactive_tab_border'].'; ';
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['tabbed_content_background'].' ; ';
	$tabbed_markup .= 'color:'. $tabbed_content['inactive_tab_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav > li > a:hover{';
	$tabbed_markup .= 'background:'. $tabbed_content['hovered_tab_background'].';';
	$tabbed_markup .= 'border-color:'. $tabbed_content['hovered_tab_border'].'; ';
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['tabbed_content_background'].' ; ';	
	$tabbed_markup .= 'color:'. $tabbed_content['hovered_tab_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav > li.active > a{';
	$tabbed_markup .= 'background:'. $tabbed_content['tabbed_content_background'].';';
	$tabbed_markup .= 'border-color:'. $tabbed_content['active_tab_border'].'; ';
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['tabbed_content_background'].' ; ';	
	$tabbed_markup .= 'color:'. $tabbed_content['active_tab_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > .tab-content{';
	$tabbed_markup .= 'background:'. $tabbed_content['tabbed_content_background'].'; ';
	$tabbed_markup .= 'border-color:'. $tabbed_content['tabbed_content_border'].'; ';
	$tabbed_markup .= 'color:'. $tabbed_content['tabbed_content_text_color'].';';
	$tabbed_markup .= 'border-style: solid; border-width: 1px; padding:20px;';
$tabbed_markup .= '}';


$tabbed_markup .= '#'. $section.' .tabbable > .tab-content a{';
$tabbed_markup .= 'color:'. $tabbed_content['tabbed_content_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > .tab-content > a{';
	$tabbed_markup .= 'color:'. $tabbed_content['tabbed_content_link_color'].';';
$tabbed_markup .= '}';

/* tab directions */
$tabbed_markup .= '#'. $section.' .tabs-left > ul > li > a{';
	$tabbed_markup .= 'border-right-color:'. $tabbed_content['tabbed_content_border'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-left > ul > li.active > a{';
	$tabbed_markup .= 'border-right-color:'. $tabbed_content['tabbed_content_background'].';';
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
$tabbed_markup .= 'border-left-color:'. $tabbed_content['tabbed_content_border'].'; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-right > ul > li.active > a{';
$tabbed_markup .= 'border-left-color:'. $tabbed_content['tabbed_content_background'].'; ';
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
$tabbed_markup .= 'border-bottom-color:'. $tabbed_content['tabbed_content_border'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable.tabs > ul > li.active a{';
$tabbed_markup .= 'border-bottom-color:'. $tabbed_content['tabbed_content_background'].';';
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
$tabbed_markup .= 'border-top-color:'. $tabbed_content['tabbed_content_border'].'; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-below > ul > li.active > a{';
$tabbed_markup .= 'border-top-color:'. $tabbed_content['tabbed_content_background'].'; ';
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
	$imageBackgroucaptionsr = $images['backgroundcaptions'];
	$imageBorderSize = $images['border_size'];
	$imagecaptionsColor = $images['bordercaptions'];
	$imageBorderStyle = $images['border_style'];
	$imacaptionserSize = $images['bordecaptions'];
	$imagePadding = $images['padding'];
	$imagecaptionsStyle = $images['bordercaptions'];
	$imageBorderRadius = $images['border_radius'];

$image_markup .= $images['border_captions'];
	$image_markup .= '#'.$section.' img, #'.$section.' iframe{';
		$image_markup .= 'background:'.$imageBackgroundColor.';';
		$image_markup .= 'border:'.$imageBorderColor.' '.$imageBorderSize.' '.$imageBorderStyle .';';
		$image_markup .= 'padding:'.$imagePadding.';';
		$image_markup .= 'border-radius:'.$imageBorderRadius.';';
	$image_markup .= '}';

	return $image_markup;
}


//images
function captionImagesMarkupCallback($section,$captions){

	$caption_markup = '';
	$captionBackgroundColor = $captions['background_color'];
	$captionBorderColor = $captions['border_color'];
	$captionBorderSize = $captions['border_size'];
	$captionBorderStyle = $captions['border_style'];
	$captionText = $captions['text_color'];
	$captionPadding = $captions['padding'];
	$captionBorderRadius = $captions['border_radius'];
	$captionGlow = $captions['thumbnail_glow'];

	$caption_markup .= '#'.$section.' .wp-caption img{';
		$caption_markup .='padding: 0; border: none;';
		$caption_markup .= 'border-radius:'.$captionBorderRadius.';';
	$caption_markup .= '}';

	$caption_markup .= '#'.$section.' .wp-caption{';
		$caption_markup .= 'background:'.$captionBackgroundColor.';';
		$caption_markup .= 'border:'.$captionBorderColor.' '.$captionBorderSize.' '.$captionBorderStyle .';';
		$caption_markup .= 'color:'.$captionText.';';
		$caption_markup .= 'border-radius:'.$captionBorderRadius.';';
	$caption_markup .= '}';

	$caption_markup .= '#'.$section.' .wp-caption:hover{';
	    $caption_markup .= 'box-shadow: 0 2px 2px rgba(0, 0, 0, 0.075) inset, 0 0 2px '.$captionGlow.' ;';
	$caption_markup .='}';	

	return $caption_markup;
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


	$thumbnail_markup .= '#'.$section.' .thumbnail{ ';
		$thumbnail_markup .= 'background:transparent;';
		$thumbnail_markup .= 'border:none ;';
		$thumbnail_markup .= 'padding:0 ;';
		$thumbnail_markup .= 'border-radius:0 ;';
	$thumbnail_markup .= '}';

	$thumbnail_markup .= '#'.$section.' .thumbnail img{';
		$thumbnail_markup .= 'background:'.$thumbnailBackgroundColor.'; ';  
		$thumbnail_markup .= 'border:'.$thumbnailBorderSize.' '.$thumbnailBorderStyle.' '.$thumbnailBorderColor.';';
		$thumbnail_markup .= 'padding:'.$thumbnailPadding.';';
		$thumbnail_markup .= 'border-radius:'.$thumbnailBorderRadius.';';
	$thumbnail_markup .= '}';
	$thumbnail_markup .= '#'.$section.' .thumbnail img:hover{';
		$thumbnail_markup .= 'background:'.$thumbnailGlow.'; ';  
	    $thumbnail_markup .= 'box-shadow: 0 2px 2px rgba(0, 0, 0, 0.075) inset, 0 0 2px '.$thumbnailGlow.' ;';
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
function navbarStylesCallback(&$media_979_markup){

	$navSettings = get_option('kjd_navbar_misc_settings');
	$navSettings = $navSettings['kjd_navbar_misc'];
	
	if(!empty($navSettings['float']) && $navSettings['float']=='true'){


		$margin_top = !empty($navSettings['float']['margin_top']) ? $navSettings['float']['margin_top'] : '0' ;
		$margin_bottom = !empty($navSettings['float']['margin_bottom']) ? $navSettings['float']['margin_bottom'] : '0' ;
		
		$sectionArea_markup .= "margin-top:".$margin_top."px;";
		$sectionArea_markup .= "margin-bottom:".$margin_bottom."px;";
	}


	$flush_links = $navSettings['flush_first_link'];
	$sidr_nav = $navSettings['side_nav'];
	$dropdown_bg = $navSettings['dropdown_bg'];


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

 	$navbar_markup ='';
 	$dropdown_markup ='';
	$collapsed_markup = '';

$navbar_markup .=".nav .divider-vertical{
	border-left: 1px solid ".$navbarBackgroundColors['endcolor'].";
	border-right: 1px solid ".$navbarBackgroundColors['color'].";
}";

// Positions navbar
	if($navSettings['navbar_alignment'] =='left'){
	
		$navbar_markup .='#navbar .nav{ float:left;}';
	
	}elseif($navSettings['navbar_alignment'] =='center'){
	
		$navbar_markup .='#navbar ul.nav {margin:0 auto; text-align: center; width:100%;}';
		$navbar_markup .='#navbar ul.nav > li{ display:inline-block; float:none;}';
		$media_979_markup .='#navbar ul.nav > li{ display:block; float:none;}';
	
	}elseif($navSettings['navbar_alignment'] =='right'){
	
		$navbar_markup .='#navbar .nav{ float:right;}';
	
	}



	// Removes box shadow if there is no background color on the navbar - should probably just remove it period
	if($navbarBackgroundColors['gradient'] == 'none' || $navSettings['kjd_navbar_section_shadow'] == 'none'){

		$navbar_markup .='.navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner,.navbar-inner {   
					box-shadow: none !important;		
				}';
	}

// remove left padding on first link
if($flush_links == 'true')
{

	if($navSettings['navbar_alignment'] == 'left' || $navSettings['navbar_alignment'] =='right'){
		
		if( $navSettings['navbar_link_style'] == 'pills' || $navSettings['navbar_link_style'] == 'tabs' 
			|| $navSettings['navbar_link_style'] == 'tabs-below' ) {

			$navbar_markup .= '.navbar .nav > li:first-child { padding-'.$navSettings['navbar_alignment'].':0; }';
		
		}else{
		
		$navbar_markup .= '.navbar .nav > li:first-child > a{padding-'.$navSettings['navbar_alignment'].':0;}';
		
		}
	}
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
		$navbar_markup .='#header{ padding-top:60px; }';
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
$navbar_markup .=" .navbar .nav > li > a:hover, .navbar .nav > li > a:focus{
	
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

	$navbar_markup .= dropdown_menu_callback($navSettings, $media_979_markup);
	return ($navbar_markup);
}

function dropdown_menu_callback($navSettings, &$media_979_markup){

	$sidr_nav = $navSettings['side_nav'];
	$dropdown_bg = $navSettings['dropdown_bg'];

	/* dropdown settings */

	$dropdownMenuSettings = get_option('kjd_dropdown-menu_options_settings');
	$dropdownMenuSettings = $dropdownMenuSettings['kjd_dropdown-menu_options'];

	$dropdownMenuBackgroundOptions = get_option('kjd_dropdown-menu_background_settings');
	$dropdownMenuBackgroundColors = $dropdownMenuBackgroundOptions['kjd_dropdown-menu_background_colors'];


	$dropdownStartColor = !empty($dropdownMenuBackgroundColors['start_rgba']) ? $dropdownMenuBackgroundColors['start_rgba'] : $dropdownMenuBackgroundColors['color'] ;
	$dropdownStartColor = $dropdownStartColor ? $dropdownStartColor : 'transparent' ;
	
	$dropdownEndColor =  !empty($dropdownMenuBackgroundColors['end_rgba']) ? $dropdownMenuBackgroundColors['end_rgba'] : $dropdownMenuBackgroundColors['endcolor'] ;
	$dropdownEndColor = !empty($dropdownStartEndColor) ? $dropdownEndColor : 'transparent';

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

/* --------------------------- first level dropdown stuff  --------------------------- */

/* the triangle at the top of the dropdown */
$dropdown_markup .=".dropdown-menu:after {  
	border-bottom-color:".$dropdownStartColor." !important;
}";

$dropdown_markup .=".navbar .nav > li > .dropdown-menu:before{  
 	border-bottom: 7px solid ".$dropdownMenuTopBorder['color']." !important;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    content: '';
    display: inline-block;
    left: 9px;
    position: absolute;
    top: -7px;";
	// if(!empty($dropdownMenuTopBorder['color'])){
	// 	$dropdown_markup.= 'box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);';
	// }

$dropdown_markup.= "}";

$dropdown_markup .=".navbar-fixed-bottom.navbar .nav > li > .dropdown-menu:before{
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

$dropdown_markup .=".navbar-fixed-bottom .nav > li > .dropdown-menu:after{
border-top-color: ".$dropdownStartColor." !important;
}";
$dropdown_markup .=".navbar-fixed-bottom.navbar .nav .sub-menu{margin-bottom:-32px;}";


/* ---------------------------- Dropdown links -------------------------------- */
$sub_bg = $dropdownMenuLink['bg_color'] ? $dropdownMenuLink['bg_color'] : 'transparent' ;
$dropdown_markup .=".dropdown-menu li > a{
	background-color:".$sub_bg." !important;
	color:".$dropdownMenuLink['color']." !important;
	text-decoration:".$dropdownMenuLink['decoration']." !important;
}";

//Drop down triangle
$dropdown_markup .=".dropdown-menu li > a:after {
    border-left-color:".$dropdownMenuLink['color'].";
}";

// active link -->
$sub_bg_active['bg_color'] = $dropdownMenuLinkActive['bg_color'] ? $dropdownMenuLinkActive['bg_color'] : 'transparent';

$dropdown_markup .=".dropdown-menu li.active > a{
	background:".$sub_bg_active." !important; 
	color:".$dropdownMenuLinkActive['color']." !important;
	text-decoration:".$dropdownMenuLinkActive['decoration']." !important;
}";

$dropdown_markup .=".dropdown-menu li.active > a:after{
	border-left-color:".$dropdownMenuLinkActive['color'].";
}";

// hovered link -->
$sub_bg_hover = $dropdownMenuLinkHovered['bg_color'] ? $dropdownMenuLinkHovered['bg_color'] : 'transparent';

$dropdown_markup .=".dropdown-menu li > a:hover{
	background:".$sub_bg_hover." !important; 
	color:".$dropdownMenuLinkHovered['color']." !important;
	text-decoration:".$dropdownMenuLinkHovered['decoration']." !important;
}";

$submenu_after_caret = $dropdownMenuLinkHovered['color'] ? $dropdownMenuLinkHovered['color'] : $dropdownMenuLink['color'] ;
$dropdown_markup .=".dropdown-menu li > a:hover:after,
	.dropdown-submenu:hover > a:after{
	border-left-color: ".$submenu_after_caret.";	
}";


$dropdown_markup .= '.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus,
.dropdown-submenu:hover > a,
.dropdown-submenu:focus > a:hover{
	background:'.$dropdownMenuLinkHovered['bg_color'].' !important; 
	color:'.$dropdownMenuLinkHovered['color'].' !important;
}
';

$dropdown_markup .=".dropdown-menu.sub-menu li.active >a,
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li.active > ul > li > ul >li >a,
.current_page_item > a,.current-menu-item > a ,.current-page-ancestor > a,{
	background-color:none!important;
	color:".$navbarLinkHovered['color']." !important;	
}";

$dropdown_markup .=".nav-collapse.sub-menu li.active >a{
	background-color:none!important;
	color:".$navbarLink['color']." !important;	
}";


/* ************************ sidr Nav ******************************* */


	$sidr_markup .='.sidr .nav-tabs.nav-stacked > li > a,
	.sidr .nav-tabs.nav-stacked > li > ul > li > a{
			background-color:'.$dropdownStartColor.';
			border:1px solid '.$dropdownMenuTopBorder['color'].';
			color:'.$dropdownMenuLink['color'].';
			background-image: none !important;
		}';


	$sub_bg = $dropdownMenuLink['bg_color'] ? $dropdownMenuLink['bg_color'] : $dropdownStartColor ;
	$sidr_markup .= '.sidr .nav-tabs.nav-stacked > li > ul > li > a{background-color:'.$sub_bg.'}';

	$sidr_markup .= '.sidr .nav li.dropdown.open > a,
	.sidr .nav-pills .open .dropdown-toggle, 
	.sidr .nav li.dropdown.open > a,
	.sidr .nav li.dropdown.open:hover > a, 
	.sidr .nav li.dropdown.open:focus > a{
		background-color:'.$dropdownMenuLinkHovered['bg_color'].';
		color:'.$dropdownMenuLinkHovered['color'].';
	}';

	$sidr_markup .= '.sidr .nav-tabs.nav-stacked > li > ul > li > a, .sidr .sub-menu a{
		color:'.$dropdownMenuLink['color'].';
		border-left:1px solid '.$dropdownMenuTopBorder['color'].';	
		border-right:1px solid '.$dropdownMenuTopBorder['color'].';
		border-top: none;
		border-bottom: none;
	}';

	$sidr_markup .= '.sidr .dropdown-menu{
		background-color:'.$dropdownMenuLink['bg_color'].';
		background-image: none !important;
	}';

	// $sidr_markup .= '.sidr .sub-menu{ position: relative; }';
 	$sidr_markup .= '#sidr ul.sub-menu > li > a{';
 		// $sidr_markup .= 'border-top-color:white;';
 		$sidr_markup .= 'border-bottom-color:'.$dropdownMenuTopBorder['color'].';';
 	$sidr_markup .= ' }';

 	$sidr_markup .= '#sidr ul.sub-menu > li > a:before{ 
 		  border-left-color:'.$dropdownMenuTopBorder['color'].' !important;
	}';


	$sidr_markup .= '.sidr .dropdown-menu > li > a:hover,
	.sidr .nav > li.dropdown.open.active > a:hover{
		background-color:'.$dropdownMenuLinkHovered['bg_color'].';
		color:'.$dropdownMenuLinkHovered['color'].';
		background-image: none !important;
				border:none;
	}';
 
	$sidr_markup .= '.sidr .nav-tabs.nav-stacked > li > ul > li > a:hover, 
	.sidr .sub-menu a:hover{
		color:'.$dropdownMenuLinkHovered['color'].';
		background-color:'.$dropdownMenuLinkHovered['bg_color'].';
		
		background-image: none !important;
	}';

	$sidr_markup .='.sidr .nav-tabs.nav-stacked > li > a:hover
	{
		background-color:'.$dropdownMenuLinkHovered['bg_color'].';
		color:'.$dropdownMenuLinkHovered['color'].';

	}';


/* carets reg*/

	$sidr_markup .= '
	.sidr .nav .dropdown-toggle .caret{
		border-top-color:'.$dropdownMenuLink['color'].';
	}';

	$sidr_markup .= '
	.sidr .nav .dropdown-toggle:hover .caret{
		border-top-color:'.$dropdownMenuLinkHovered['color'].';
	}';

	$sidr_markup .= '.sidr .nav li.dropdown.open:hover a .caret, 
	.sidr .nav li.dropdown.open:focus a .caret{
		border-top-color:'.$dropdownMenuLinkHovered['color'].';
	}';

	$sidr_markup .= '
	.sidr .dropdown-submenu > a:after{
		border-color: transparent transparent transparent '.$dropdownMenuLink['color'].';
	}';

	$sidr_markup .= '
	.sidr .dropdown-submenu > a:hover:after{
		border-color: transparent transparent transparent '.$dropdownMenuLinkHovered['color'].';
	}';

	$sidr_markup .= '
	.sidr .dropdown-submenu.open > a:after,
	.sidr .dropdown-submenu:focus > a:after{
		border-color: transparent transparent transparent '.$dropdownMenuLinkHovered['color'].';
	}';


/* ------------------ collapsed navbar button -------------------------------- */



// Navlink styles -->


	// Link styles
	if($navSettings['navbar_link_style'] == 'none'){
	
		$collapsed_markup .=".navbar .nav > li > a,";
		$collapsed_markup .=".navbar .nav > li.open > a,";
		$collapsed_markup .=".navbar .nav > li.active > a,";
		$collapsed_markup .=".navbar .nav > li > a:hover{";
		$collapsed_markup .="background:none !important;}";
	
	}elseif($navSettings['navbar_link_style'] == 'highlighted'){
	
		$collapsed_markup .="#navbar .nav li{margin:0 4px 0 0;}";		
	
	}elseif($navSettings['navbar_link_style'] == 'pills'){
	
		$collapsed_markup .=".nav-pills li a{border-color:".$navbarLink['border_color']."; border-top:0 !important; border-radius: 4px !important; height:17px;}";		
	
	}elseif($navSettings['navbar_link_style'] == 'tabs-below'){
	
		$collapsed_markup .=".nav-tabs, .nav{border-bottom:0 !important; margin-bottom:-2px;}";
		$collapsed_markup .=".nav-tabs li a{border-color:".$navbarLink['border_color']."; border-top:0 !important; border-radius: 0 0 4px 4px !important; height:17px;}";
		$collapsed_markup .=".nav-tabs li a:hover, .navbar .nav li a:hover, .active a{border-color:".$navbarLinkHovered['border_color']." !important; }";
		$collapsed_markup .=".current_page_item a{border-color:".$navbarLinkActive['border_color']." !important;}";

	}elseif($navSettings['navbar_link_style'] == 'tabs'){
	
		$collapsed_markup .=".nav-tabs, .nav{border-bottom:0 !important; margin-bottom:-2px;}";
		$collapsed_markup .=".nav-tabs li a, .navbar .nav li a{border-color:".$navbarLink['border_color']."; border-bottom:0 !important; height:17px;}";
		$collapsed_markup .=".nav-tabs li a:hover, .navbar .nav li a:hover, .active a{border-color:".$navbarLinkHovered['border_color']." !important; }";
		$collapsed_markup .= ".current_page_item a{ border-color:".$navbarLinkActive['border_color']." !important;}";
	
	}

/*---------------------------------- mobile only -----------------------------------*/

		// mobile bar button
		$media_979_markup .='.navbar .btn-navbar{ 
			background:'.$navSettings['menu_btn_bg'].';
			border-color:'.$navSettings['menu_btn_border'].';
		}';

		$media_979_markup .='.navbar .btn-navbar:hover, .navbar .btn-navbar:active{ 
			background:'.$navSettings['menu_btn_bg_hovered'].';
			border-color:'.$navSettings['menu_btn_border_hovered'].';
		}';
		
		$media_979_markup .= '.navbar .btn-navbar .icon-bar{ background: rgba(0,0,0,.1);}';

if($dropdown_bg != 'true'){
		$media_979_markup .= ".nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > a:hover,
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul, 
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > a:hover,
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > a:hover:after,
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > ul,
				.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > ul >li >a:hover{
		
					background-color:none!important;
					color:".$navbarLinkHovered['color']." !important;	
				}";
	}else{
	  $media_979_markup .= '#navbar .navbar-inner {height: 40px}';
	  $media_979_markup .= ".nav-collapse.collapse > .nav:before
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

	  $media_979_markup .= ".nav-collapse.collapse > .nav:after
	  	  {
	  	      border-bottom: 6px solid ".$dropdownStartColor." !important;
	  	      border-left: 6px solid transparent;
	  	      border-right: 6px solid transparent;
	  	      content: '';
	  	      display: inline-block;
	  	      right: 10px;
	  	      position: absolute;
	  	      top: -6px;
	  	  }";

$mobile_dropdown_raidii = $dropdownMenuBordersOptions['kjd_dropdown-menu_border_radius'] ? $dropdownMenuBordersOptions['kjd_dropdown-menu_border_radius'] : '4px';
$top_left = $mobile_dropdown_raidii['top-left'];
$top_right = $mobile_dropdown_raidii['top-right'];
$bottom_right = $mobile_dropdown_raidii['bottom-right'];
$bottom_left = $mobile_dropdown_raidii['bottom-left'];

	  $media_979_markup .= "#navbar .nav-collapse.collapse > .nav
	  	  {    
	  	      background-clip: padding-box;
	  	      background-color:".$dropdownStartColor." !important;
	  	      border: 1px solid ". $dropdownMenuTopBorder['color'] .";
	  	      border-radius: ".$top_left." ".$top_right." ".$bottom_right." ".$bottom_left.";
	  	      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	  	      float: right;
	  	      left: 0;
	  	      list-style: none outside none;
	  	      margin: 10px 0 0;
	  	      min-width: 160px;
	  	      padding: 5px 0;
	  	      z-index: 1000;
	  	      width: 99%;
	  	  } ";


	  $media_979_markup .= ".navbar .nav > li:first-child > a { padding:9px 15px;}";

	  $media_979_markup .= ".nav-collapse .nav > li > a, .nav-collapse .dropdown-menu a {
	  	color:". $dropdownMenuLink['color'] ." !important;
	  }";

	  $media_979_markup .= ".nav-collapse .nav > li > a:hover, .nav-collapse .dropdown-menu a:hover {
	  	color:". $dropdownMenuLinkHovered['color'] ." !important;
	  }";

		$media_979_markup .= ".nav-collapse .navbar .nav > li > a.dropdown-toggle > .caret,";
		$media_979_markup .= ".navbar .nav > li.open > a.dropdown-toggle > .caret,";
		$media_979_markup .= ".nav-collapse .navbar .nav > li > a.dropdown-toggle > .caret:hover{";
			$media_979_markup .= "border-top-color:". $dropdownMenuLink['color'] ." !important;";
		$media_979_markup .= "}";

		$media_979_markup .= ".dropdown-menu li > a:after,";
		$media_979_markup .= ".dropdown-menu li > a:hover:after{";
			$media_979_markup .= "border-left-color:". $dropdownMenuLink['color'] ." !important;";
		$media_979_markup .= "}";


	} 

	return $dropdown_markup.$sidr_markup.$collapsed_markup;
}

function mediaQuery979Callback(&$media_979_markup){

		  	$media_979_markup .= '#navbar .nav .dropdown-menu{ border-width:0px !important; }';

	$media_979_markup .= '}';
	return $media_979_markup;
}

function miscStylesCallback(){

	//get footer height
	$footerOptions = get_option('kjd_footer_misc_settings');
	$footerOptions = $footerOptions['kjd_footer_misc'];
	$footerHeight = !empty($footerOptions["height"]) ? $footerOptions["height"] : '300' ;
	if($footerOptions['kjd_footer_confine_background'] =='true'){
		$footerHeight = $footerHeight+'40';
	}

	$misc_markup = '';
	$misc_markup .='#pageWrapper{ margin: 0 auto -'.$footerHeight.'px;}';
	$misc_markup .='#push{height:'.$footerHeight.'px;}';
	$misc_markup .='#footer{margin-top:-'.$footerHeight.'px;}';

	return $misc_markup;
}

function postSettingsCallback(){


		$miscSettings = get_option('kjd_posts_misc_settings');
		$miscSettings = $miscSettings['kjd_posts_misc'];

		//color of the line underneath the post info
		$postInfoBorder = $miscSettings['post_info_border'] ? $miscSettings['post_info_border'] : 'rgba(0,0,0,.5)';
		$blockquote = $miscSettings['blockquote'] ? $miscSettings['blockquote'] : 'rgba(0,0,0,.5)';

		$post_misc_markup ='';

		$post_misc_markup .= '#body .post-info';
		$post_misc_markup .= '{';
			$post_misc_markup .= 'border-bottom:1px solid '. $postInfoBorder.';';
		$post_misc_markup .= '}';

		$post_misc_markup .= '#body blockquote';
		$post_misc_markup .= '{';
			$post_misc_markup .= 'border-color:'. $blockquote.';';
		$post_misc_markup .= '}';

	return $post_misc_markup;
}