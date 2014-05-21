<?php

/*
	$section = markup section (header, body ect)
	$array = current settings (stored in the DB)
	$preview = js object containing the section, field name value ect (AJAXed brah)
	$part = the settings section
*/
function kjd_get_temp_settings($section, $array, $preview, $part) {
	if($preview != null){


		// print_r($preview['settings'][4]['value']); die;
		if( $section == $preview['section'] ){

			if($section == 'kjd_custom_styles'){

				// print_r( $preview['settings'] ); die;		
				return $preview['settings'][4]['value'];
			}

			foreach( $preview['settings'] as $settings ){
				if($settings['name'] == $part){
					$array[ $settings['field'] ] = $settings['value'];
				} // end field matching


			} // end looping through preview settings
		} // end setting section checking
	} // end preview
	
	return $array;
}


function kjd_get_theme_options($preview = null){

	settings_fields( 'kjd_component_settings' ); 
	$options = get_option('kjd_component_settings');

	$sections = array('htmlTag','bodyTag','mastArea','header','navbar','dropdown-menu',
		'cycler','contentArea','pageTitle','body','footer', 'sidr');


	//adds widget and post style sections
    if($options['style_widgets']=='true'){
		$sections[] = 'widgets';
		$sections[] = 'horizontalWidgets';
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
			$section =='posts' || $section == "mobileNav" || $section == 'widgets' || $section == 'horizontalWidgets'){
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

		$kjd_section_H5 = kjd_get_temp_settings(	$section,
													$options_htag['kjd_'.$section.'_H5'],
													$preview,
													'kjd_section_H5'
												);

		$hTags = array(
						'h1' => $kjd_section_H1,
						'h2' => $kjd_section_H2,
						'h3' => $kjd_section_H3,
						'h4' => $kjd_section_H4,
						'h5' => $kjd_section_H5
					);

		/* ----------------------------------------------------- 
		Link Options
		 ----------------------------------------------------- */
		$options_links = get_option('kjd_'.$section.'_links_settings');

		$kjd_section_text = kjd_get_temp_settings(	$section,
													$options_links['kjd_'.$section.'_text'],
													$preview,
													'kjd_section_text'
												);

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
		$nav_list = kjd_get_temp_settings(	
											$section,
											$kjd_section_components['nav_list'],
											$preview,
											'nav_list'
										);

		/* ----------------------------------------------------- 
		text formatting stuff
		 ----------------------------------------------------- */
		 $pre = kjd_get_temp_settings(
		 	$section,
		 	$kjd_section_components['pre'],
		 	$preview,
		 	'pre'
		 	);

		 $address = kjd_get_temp_settings(
		 	$section,
		 	$kjd_section_components['address'],
		 	$preview,
		 	'address'
		 	);
		 $blockquote = kjd_get_temp_settings(
		 	$section,
		 	$kjd_section_components['blockquote'],
		 	$preview,
		 	'blockquote'
		 	);

		/* ----------------------------------------------------- 
			Images Options
		 ----------------------------------------------------- */
 		$options_images = get_option('kjd_'.$section.'_images_settings');

		$kjd_section_images = $options_images['kjd_'.$section.'_images'];
		
		$images = kjd_get_temp_settings(	
											$section,
											$kjd_section_images['images'],
											$preview,
											'images'
										);
		$thumbnails = kjd_get_temp_settings(	
											$section,
											$kjd_section_images['thumbnails'],
											$preview,
											'thumbnails'
										);
		$captions = kjd_get_temp_settings(	
											$section,
											$kjd_section_images['captions'],
											$preview,
											'captions'
										);
		/* ----------------------------------------------------- 
			iFrames - In the images section for no good reason
		----------------------------------------------------- */
		$iframes = kjd_get_temp_settings(	
											$section,
											$kjd_section_images['iframe'],
											$preview,
											'iframe'
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
			'nav_list' => $nav_list,
			'images'=>$images,
			'thumbnails'=>$thumbnails,
			'captions'=>$captions,
			'iframes' => $iframes,
			'pre'=>$pre,
			'address'=>$address,
			'blockquote'=>$blockquote,
			'kjd_section_misc_settings'=>$kjd_section_misc_settings
		);


		$section_output .= section_markup_callback( $section, $section_options );
		
	} // End section loop
	
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
		$media_979_markup = kjd_build_mobile_styles_callback( 'mobileNav', 'true' );
	}else {
		$media_979_markup = kjd_build_mobile_styles_callback( 'navbar' );
	}


/* ----------------------------------------------------------------
			User Custom Styles
-------------------------------------------------------------------*/

	$user_styles = get_option('kjd_custom_styles_settings');
	$user_styles = $user_styles['kjd_custom_styles'];

	$user_styles = kjd_get_temp_settings(	
		'kjd_custom_styles',
		$user_styles, 	
		$preview,
		'kjd_custom_styles'
	);

	return $miscMarkup . $section_output . $navArea_markup . $media_979_markup . $media_767_output . $user_styles; 
	
} // end build css function


include('styles_markup.php');
include('styles_functions.php');