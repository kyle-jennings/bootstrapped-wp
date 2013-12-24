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

		// this makes sure that the new settings were passed in
		// echo $part."\n"; 
		// print_r($preview); 

		// die();

		//ensures we are in the correct section
		if( $section == $preview['section'] ){
			// echo 'Part: '.$part."\n";
			// echo 'preview settings:';
			// print_r($preview['settings'] ); die();

			foreach( $preview['settings'] as $settings ){

				if($settings['name'] == $part){

					// echo 'Part: '.$part;
					// echo "\n".'old'."\n";
					// print_r($array);
					// echo "\n".'preview: '."\n";
					// print_r($settings); 

					$array[ $settings['field'] ] = $settings['value'];

					// echo "\n".'NEW: '."\n";
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

	$sections = array('htmlTag','bodyTag','mastArea','header','navbar','dropdown-menu',
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
	$miscMarkup = miscStylesCallback();


	foreach($sections as $section){


		// Misc Settings
		$kjd_section_misc_settings = get_option('kjd_'.$section.'_misc_settings');
		$kjd_section_misc_settings = $kjd_section_misc_settings['kjd_'.$section.'_misc'];
		$kjd_section_confine_background = $kjd_section_misc_settings['kjd_'.$section.'_confine_background'];


		/* -----------------------------------------------------
		 Background Options 
		 ----------------------------------------------------- */
		$options_backgrounds = get_option('kjd_'.$section.'_background_settings');

		$kjd_section_background_colors = kjd_get_temp_settings(	$section,  
																$options_backgrounds['kjd_'.$section.'_background_colors'], 
																$preview, 
																'kjd_section_background_colors' 
															);



		$kjd_section_background_wallpaper = kjd_get_temp_settings(	$section, 
																	$options_backgrounds['kjd_'.$section.'_background_wallpaper'], 	
																	$preview, 
																	'kjd_section_background_wallpaper'
																);
		$backgroundSettings = array('kjd_section_background_colors'=>$kjd_section_background_colors,
							'kjd_section_background_wallpaper'=>$kjd_section_background_wallpaper);

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


		if($kjd_section_confine_background =='true' || $section =='dropdown-menu' || $section =='posts' || $section == "mobileNav"){
			$sectionBorders = array('top'=>$kjd_section_top_border,
									'right'=>$kjd_section_right_border,
									'bottom'=>$kjd_section_bottom_border,
									'left'=>$kjd_section_left_border
									);
		}else{
			$sectionBorders = array('top'=>$kjd_section_top_border,
									'bottom'=>$kjd_section_bottom_border
									);
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
		$kjd_section_misc_settings = kjd_get_temp_settings(	
											$section,
											$options_misc['kjd_'.$section.'_misc'],
											$preview,
											'kjd_section_misc'
									);



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
			'kjd_section_misc_settings'=>$kjd_section_misc_settings
		);


		$section_output .= section_markup_callback($section,$section_options);
		
	}

    if($options['style_posts']=='true'){
		$section_output .= postSettingsCallback();
	}
	
	/* ----------------------------------------------------- 
	Responsive markup
	 ----------------------------------------------------- */
	$media_767_output = '@media(max-width: 768px){';
			$media_767_output .= '#navbar{';
				$media_767_output .= 'clear: both;';
				$media_767_output .= 'float: none;';
				$media_767_output .= 'margin-top: 0;';
			$media_767_output .= '}';
		$media_767_output .= '}';

	// return $section_output;


/* ----------------------------------------------------------------
			get navbr styles
-------------------------------------------------------------------*/
	include('navbar_styles.php');
	$navArea_markup = navbarStylesCallback( $preview );

	include('mobile_nav_settings.php');
	$media_979_markup = kjd_build_mobile_styles_callback();


/* ----------------------------------------------------------------
			User Custom Styles
-------------------------------------------------------------------*/

	$user_styles = get_option('kjd_custom_styles_settings');
	$user_styles = $user_styles['kjd_custom_styles'];


	return $miscMarkup.$section_output.$navArea_markup.$media_979_markup.$media_767_output.$user_styles; 
	
} // end build css function



/* -------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------

			Build markup - calls th eappropriate fucntions for each section

-------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------
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
	case 'posts':
			$section_name = '#body .the-content-wrapper.well';
		break;
	case 'widgets':
			$section_name = '#sideContent widget';
		break;
	default:
		$section_name = '#'.$section;
		break;
}


	$type = $kjd_section_background_colors['gradient'];
	if(!empty($kjd_section_misc_settings['kjd_'.$section.'_section_shadow'])){
		$sectionShadow = $kjd_section_misc_settings['kjd_'.$section.'_section_shadow'];	
	}
	
	if($section =="header"){
		$hideHeader = $kjd_section_misc_settings['hide_header']; 
		$forceHeight = $kjd_section_misc_settings['force_height'];
		$logo_alignment = $kjd_section_misc_settings['logo_align'];
		$logo_pull = $kjd_section_misc_settings['logo_margin'];
		//$useMast = $kjd_section_misc_settings['use_mastArea'];				
	}


	$sectionArea_markup = '';

	if($section =="cycler"){
		$forceHeight = $kjd_section_misc_settings['force_height'];
		if($forceHeight =='true'){
			$section_height = !empty($kjd_section_misc_settings['height']) ? $kjd_section_misc_settings['height'] : '' ;
		}
		$sectionArea_markup .= $section_name.' #imageSlider, .rslides{';
			$sectionArea_markup .= "height:".$section_height."px;";
		$sectionArea_markup .= '}';		
	}


	if($section == 'posts'){
		if($kjd_section_misc_settings['style_posts'] == 'true'){
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

// adds a box shaddow to the section, must finish building
	if(!empty($kjd_section_misc_settings[$section.'_section_shadow']) 
		&& $kjd_section_misc_settings[$section.'_section_shadow'] != 'none') {


		switch( $kjd_section_misc_settings[$section.'_section_shadow'] ){
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


	if( $kjd_section_misc_settings['float'] =='true'){

		$margin_top = $kjd_section_misc_settings['margin_top'] ? $kjd_section_misc_settings['margin_top'] : '0' ;
		$margin_bottom = $kjd_section_misc_settings['margin_bottom'] ? $kjd_section_misc_settings['margin_bottom'] : '0' ;
		

		$sectionArea_markup .=  "margin-top:".$margin_top."px;";
		$sectionArea_markup .=  "margin-bottom:".$margin_bottom."px;";

	}

	if($section=='header' && $forceHeight =="true" && !empty($kjd_section_misc_settings['header_height'])){
		$sectionArea_markup .= "height:".$kjd_section_misc_settings['header_height']."px;";
	}

	if($section=='cycler' && $forceHeight =="true" && !empty($kjd_section_misc_settings['height'])){
		$sectionArea_markup .= "height:".$kjd_section_misc_settings['height']."px;";
	}

	if($section =='footer'){

		$height = !empty($kjd_section_misc_settings['height']) ? $kjd_section_misc_settings['height'] : '300' ;
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
		$kjd_section_misc_settings = $miscOptions['kjd_mastArea_background_misc'];
		if(!empty($kjd_section_misc_settings['use_top_padding']) && $kjd_section_misc_settings['use_top_padding'] =="true"){
			$sectionArea_markup .= "padding-top:".$kjd_section_misc_settings['top_padding']."px;";
		}
		if(!empty($kjd_section_misc_settings['use_bottom_padding']) && $kjd_section_misc_settings['use_bottom_padding'] =="true"){
			$sectionArea_markup .= "padding-bottom:".$kjd_section_misc_settings['bottom_padding']."px;";
		}
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

	if($section == 'body'){

		$kjd_section_misc_settings = get_option('kjd_body_misc_settings');
		$kjd_section_misc_settings = $kjd_section_misc_settings['kjd_body_misc'];

		//color of the line underneath the post info
		$postInfoBorder = $kjd_section_misc_settings['post_info_border'] ? $kjd_section_misc_settings['post_info_border'] : 'rgba(0,0,0,.5)';
		$blockquote = $kjd_section_misc_settings['blockquote'] ? $kjd_section_misc_settings['blockquote'] : 'inherit';

		$sectionArea_markup .= '#body .post-info';
		$sectionArea_markup .= '{';
			$sectionArea_markup .= 'border-bottom:1px solid '. $postInfoBorder.';';
		$sectionArea_markup .= '}';

		$sectionArea_markup .= '#body blockquote';
		$sectionArea_markup .= '{';
			$sectionArea_markup .= 'border-color:'. $blockquote.';';
		$sectionArea_markup .= '}';


		foreach(array('pre','code') as $type){
			$background = $kjd_section_misc_settings[$type.'_background'] ? $kjd_section_misc_settings[$type.'_background'] : 'inherit';
			$text = $kjd_section_misc_settings[$type.'_text'] ? $kjd_section_misc_settings[$type.'_text'] : 'inherit';
			$link = $kjd_section_misc_settings[$type.'_link'] ? $kjd_section_misc_settings[$type.'_link'] : 'inherit';
			$hovered_link = $kjd_section_misc_settings[$type.'_hovered_link'] ? $kjd_section_misc_settings[$type.'_hovered_link'] : 'inherit';

			$sectionArea_markup .= '#body '.$type.'';
			$sectionArea_markup .= '{';
				$sectionArea_markup .= 'border:'.$background.';';
				$sectionArea_markup .= 'background:'.$background.';';
				$sectionArea_markup .= 'color:'.$text.';';
			$sectionArea_markup .= '}';

			$sectionArea_markup .= '#body '.$type.' a';
			$sectionArea_markup .= '{';
				$sectionArea_markup .= 'color:'.$link.';';
			$sectionArea_markup .= '}';

			$sectionArea_markup .= '#body '.$type.' a:hover';
			$sectionArea_markup .= '{';
				$sectionArea_markup .= 'color:'.$hovered_link .';';
			$sectionArea_markup .= '}';
		}


	}


/* ----------------------------------------------------------------------------- *
						Link and heading tag styles
----------------------------------------------------------------------------- */
	if(	 $section !='bodyTag' && $section !='htmlTag' && $section != 'mastArea' &&
		 $section !='cycler' && $section !="navbar" && $section !='dropdown-menu'  && $section !='mobileNav' 
		 && $section !='contentArea'){
		
		// Links
		foreach($linkSettings as $link_type => $v){
			$sectionArea_markup .= $section_name.' '.$link_type.':not(.btn) {';
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
		$sectionArea_markup .= kjd_image_cycler_settings_callback($kjd_section_misc_settings);
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

	if($section =='body') {
		//pagination
		$sectionArea_markup .= paginationMarkupCallback($section, $pagination_content);
	}

	if($section =='navbar' || $section !='mobileNav') {
		$sectionArea_markup .= formsMarkupCallback($section, $forms);
	}
	return $sectionArea_markup;

}
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
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['inactive_tab_border'].' ; ';
	$tabbed_markup .= 'color:'. $tabbed_content['inactive_tab_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav > li > a:hover{';
	$tabbed_markup .= 'background:'. $tabbed_content['hovered_tab_background'].';';
	$tabbed_markup .= 'border-color:'. $tabbed_content['hovered_tab_border'].'; ';
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['hovered_tab_border'].' ; ';	
	$tabbed_markup .= 'color:'. $tabbed_content['hovered_tab_link_color'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable > ul.nav > li.active > a{';
	$tabbed_markup .= 'background:'. $tabbed_content['tabbed_content_background'].';';
	$tabbed_markup .= 'border-color:'. $tabbed_content['active_tab_border'].'; ';
	$tabbed_markup .= 'border-bottom-color: '. $tabbed_content['active_tab_border'].' ; ';	
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

/* tabs on teh left */
$tabbed_markup .= '#'. $section.' .tabs-left > ul.nav > li > a{';
	$tabbed_markup .= 'border-right-color:'. $tabbed_content['tabbed_content_border'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-left > ul.nav > li.active > a{';
	$tabbed_markup .= 'border-right-color:'. $tabbed_content['tabbed_content_background'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-left > ul.nav > li > a:hover{';
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

// tabs on teh right
$tabbed_markup .= '#'. $section.' .tabs-right > ul.nav > li > a{';
$tabbed_markup .= 'border-left-color:'. $tabbed_content['tabbed_content_border'].'; ';

$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-right > ul.nav > li.active > a{';
$tabbed_markup .= 'border-left-color:'. $tabbed_content['tabbed_content_background'].'; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-right > ul.nav > li > a:hover{';
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

// normal tabs
$tabbed_markup .= '#'. $section.' .tabbable.tabs > ul.nav > li a{';
$tabbed_markup .= 'border-bottom-color:'. $tabbed_content['tabbed_content_border'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable.tabs > ul.nav > li.active a{';
$tabbed_markup .= 'border-bottom-color:'. $tabbed_content['tabbed_content_background'].';';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabbable.tabs > ul.nav > li a:hover{';
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
// tabs on teh bottom
$tabbed_markup .= '#'. $section.' .tabs-below > ul.nav > li > a{';
$tabbed_markup .= 'border-top-color:'. $tabbed_content['tabbed_content_border'].'; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-below > ul.nav > li.active > a{';
$tabbed_markup .= 'border-top-color:'. $tabbed_content['tabbed_content_background'].'; ';
$tabbed_markup .= '}';

$tabbed_markup .= '#'. $section.' .tabs-below > ul.nav > li > a:hover{';
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


		$kjd_section_misc_settings = get_option('kjd_posts_misc_settings');
		$kjd_section_misc_settings = $kjd_section_misc_settings['kjd_posts_misc'];

		//color of the line underneath the post info
		$postInfoBorder = $kjd_section_misc_settings['post_info_border'] ? $kjd_section_misc_settings['post_info_border'] : 'rgba(0,0,0,.5)';
		$blockquote = $kjd_section_misc_settings['blockquote'] ? $kjd_section_misc_settings['blockquote'] : 'rgba(0,0,0,.5)';

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