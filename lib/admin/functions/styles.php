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


		if($kjd_section_confine_background =='true' || $section =='dropdown-menu' || 
			$section =='posts' || $section == "mobileNav" || $section == 'widgets'){
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
	include('mobile_nav_settings.php');
	
	$navArea_markup = navbarStylesCallback( $preview );

	$mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
	$mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];
	$override_nav = $mobileNavSettings['override_nav'];
	
	if( $override_nav == 'true') {
		$media_979_markup = kjd_build_mobile_styles_callback( 'mobileNav' );
	}else {
		$media_979_markup = kjd_build_mobile_styles_callback( 'navbar' );
	}


/* ----------------------------------------------------------------
			User Custom Styles
-------------------------------------------------------------------*/

	$user_styles = get_option('kjd_custom_styles_settings');
	$user_styles = $user_styles['kjd_custom_styles'];


	return $miscMarkup . $section_output . $navArea_markup . $media_979_markup . $media_767_output . $user_styles; 
	
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
		$section_name = '#'.$section.'.primary-menu .navbar-inner';
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
			$section_name = '#sideContent .widget .well';
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

if($section == 'cycler') {
	if( $kjd_section_misc_settings['plugin'] == 'nivo' && $kjd_section_misc_settings['full_width'] == 'true'){
		$sectionArea_markup .= '.nivo-controlNav {
					position: absolute;
					bottom: 0;
					left: 50%;
					z-index: 999;
				}';
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

		$height = !empty($kjd_section_misc_settings['height']) ? $kjd_section_misc_settings['height'] : '' ;
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
	if( $section =='body' || $section =='footer' || $section =='header' || $section == 'widgets' ){

		//tabbed
		$sectionArea_markup .= tabbedMarkupCallback($section_name, $tabbed_content);
		//collapsibles
		$sectionArea_markup .= collapsibleMarkupCallback($section_name, $collapsible_content);
		//tables
		$sectionArea_markup .= tableMarkupCallback($section_name, $table_content);
		//forms
		$sectionArea_markup .= formsMarkupCallback($section_name, $forms);
		//images
		$sectionArea_markup .= imagesMarkupCallback($section_name, $images);
		//thumbnails
		$sectionArea_markup .= thumbnailsMarkupCallback($section_name, $thumbnails);
		//image captions
		$sectionArea_markup .= captionImagesMarkupCallback($section_name, $captions);
		//lists
		$sectionArea_markup .= listsMarkupCallback($section_name, $list);
	}

	if($section =='body') {
		//pagination
		$sectionArea_markup .= paginationMarkupCallback($section_name, $pagination_content);
	}

	if($section =='navbar' || $section !='mobileNav') {
		$sectionArea_markup .= formsMarkupCallback($section_name, $forms);
	}
	return $sectionArea_markup;

}

include('style_functions.php');