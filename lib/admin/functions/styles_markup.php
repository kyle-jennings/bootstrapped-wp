<?php


/* -------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------

			Build markup - calls the appropriate fucntions for each section

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
			// $section_name = '#'.$section.'.primary-menu .navbar-inner';
			$section_name = '.'.$section.'-wrapper.primary-menu .navbar-inner';
			break;
		case 'htmlTag':
			$section_name = 'html';
			break;		
		case 'bodyTag':
			$section_name = 'body';
			break;
		case 'posts':
			$section_name = '#body .the-content-wrapper.well';
			break;
		case 'widgets':
			$section_name = '#sideContent .widget .styled, #side-content .widget .styled';
			break;

		case 'horizontalWidgets':
			$section_name = '#main-content .widget .styled';
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
	}


	$sectionArea_markup = '';



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


/* ---------------------------------------------------
 			start section markup
 ----------------------------------------------------- */

	$sectionArea_markup .= $section_name.'{';

	
	// adds a box shaddow to the section, must finish building
	if(!empty($kjd_section_misc_settings[$section.'_section_shadow']) ) {



		switch( $kjd_section_misc_settings[$section.'_section_shadow'] ){
			case 'left and right':
				$sectionArea_markup .='-moz-box-shadow: 10px 0px 10px -10px rgba(0,0,0, 0.8), -7px 0px 10px -10px rgba(0,0,0, 0.8);';
				$sectionArea_markup .='-webkit-box-shadow: 10px 0px 10px -10px rgba(0,0,0, 0.8), -7px 0px 10px -10px rgba(0,0,0, 0.8);';
				$sectionArea_markup .='box-shadow: 10px 0px 10px -10px rgba(0,0,0, 0.8), -7px 0px 10px -10px rgba(0,0,0, 0.8);';				
				break;
			case 'top and bottom':
				$sectionArea_markup .= '-webkit-box-shadow: 0 -7px 10px -10px rgba(0, 0, 0, 0.8),  0 10px 10px -10px rgba(0, 0, 0, 0.8);';
				$sectionArea_markup .= '-moz-box-shadow: 0 -7px 10px -10px rgba(0, 0, 0, 0.8),  0 10px 10px -10px rgba(0, 0, 0, 0.8);';
				$sectionArea_markup .= 'box-shadow: 0 -7px 10px -10px rgba(0, 0, 0, 0.8),  0 10px 10px -10px rgba(0, 0, 0, 0.8);';
				break;
			case 'top':
				$sectionArea_markup .= '-webkit-box-shadow: 0 -7px 10px -10px rgba(0, 0, 0, 0.8);';
				$sectionArea_markup .= '-moz-box-shadow: 0 -7px 10px -10px rgba(0, 0, 0, 0.8);';
				$sectionArea_markup .= 'box-shadow: 0 -7px 10px -10px rgba(0, 0, 0, 0.8);';
				break;
			case 'bottom':
				$sectionArea_markup .= '-webkit-box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.8);';
				$sectionArea_markup .= '-moz-box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.8);';
				$sectionArea_markup .= 'box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.8);';
				break;
			case 'all sides':
				$sectionArea_markup .= '-webkit-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.8);';
				$sectionArea_markup .= 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.8);';
				break;
			default:
				$sectionArea_markup .= 'box-shadow: none;';
				break;
		}

	}

/* -----------------------------------------------------
			'floats' the section
------------------------------------------------------- */
	if( $kjd_section_misc_settings['float'] =='true'){

		$margin_top = $kjd_section_misc_settings['margin_top'] ? $kjd_section_misc_settings['margin_top'] : '0' ;
		$margin_bottom = $kjd_section_misc_settings['margin_bottom'] ? $kjd_section_misc_settings['margin_bottom'] : '0' ;
		

		$sectionArea_markup .=  "margin-top:".$margin_top."px;";
		$sectionArea_markup .=  "margin-bottom:".$margin_bottom."px;";

	}
/* ----------------------------------------------------
				forces height
------------------------------------------------------- */
	if($section=='header' && $forceHeight =="true" && !empty($kjd_section_misc_settings['header_height'])){
		$sectionArea_markup .= "height:".$kjd_section_misc_settings['header_height']."px;";
	}
	
	// look into these seemingly similar functions
	if($section=='cycler' && $forceHeight =="true" && !empty($kjd_section_misc_settings['height'])){
		$sectionArea_markup .= "height:".$kjd_section_misc_settings['height']."px;";
	}

	if($section =="cycler"){
		$forceHeight = $kjd_section_misc_settings['force_height'];
		if($forceHeight =='true'){
			$section_height = !empty($kjd_section_misc_settings['height']) ? $kjd_section_misc_settings['height'] : '' ;
		}
		$sectionArea_markup .= $section_name.' #imageSlider, .rslides{';
			$sectionArea_markup .= "height:".$section_height."px;";
		$sectionArea_markup .= '}';		
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

$sectionArea_markup .= '}'; // Ends the section div markup


/* ------------------------------------------------------------
---------------------------------------------------------------
				starts things like links and shit
---------------------------------------------------------------
--------------------------------------------------------------- */

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

		if( $kjd_section_misc_settings['mobile_hide_header'] == 'true' ){
			$sectionArea_markup .= '@media(max-width:979px){ #header{ display: none; } }';
		}

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

			$sectionArea_markup .= $section_name.' '.$htag.', ';
			$sectionArea_markup .= $section_name.' '.$htag.' a,';
			$sectionArea_markup .= $section_name.' '.$htag.' a:not(.btn),';
			$sectionArea_markup .= $section_name.' '.$htag.' a:hover:not(.btn), ';
			$sectionArea_markup .= $section_name.' '.$htag.' a:visited:not(.btn){ ';

				$sectionArea_markup .= hTagSettingsCallback($v);
			$sectionArea_markup .= '}';
		}

	}



	if($section =="cycler"){
		$sectionArea_markup .= kjd_image_cycler_settings_callback($kjd_section_misc_settings);
	}


/* ----------------------------------------------------------------------------- 
						special text formatting
----------------------------------------------------------------------------- */
	if( $section =='header' || $section == 'body' || $section == 'posts' || $section == 'widgets' || $section == 'footer'){


		$sectionArea_markup .= post_settings_callback($section, $kjd_section_misc_settings);

	}

/* ----------------------------------------------------------------------------- *
						Components
----------------------------------------------------------------------------- */
	if( $section =='header' || $section == 'widgets' || $section =='body' || $section =='footer' ){

		//tabbed
		$sectionArea_markup .= tabbedMarkupCallback($section_name, $tabbed_content, $section);
		//collapsibles
		$sectionArea_markup .= collapsibleMarkupCallback($section_name, $collapsible_content, $section);
		//tables
		$sectionArea_markup .= tableMarkupCallback($section_name, $table_content, $section);
		//forms
		$sectionArea_markup .= formsMarkupCallback($section_name, $forms, $section);
		//nav list
		$sectionArea_markup .= nav_list_markup_callback($section_name, $forms, $section);

		$sectionArea_markup .= textFormattingCallback($section_name, $section,'pre', $pre);
		$sectionArea_markup .= textFormattingCallback($section_name, $section,'address', $address);
		$sectionArea_markup .= textFormattingCallback($section_name, $section,'blockquote', $blockquote);
	
		//lists i dont think these are used yet
		$sectionArea_markup .= listsMarkupCallback($section_name, $list, $section);

/* ----------------------------------------------------------------------------- *
						images
----------------------------------------------------------------------------- */
		//images
		$sectionArea_markup .= imagesMarkupCallback($section_name, $images, $section);
		//thumbnails
		$sectionArea_markup .= thumbnailsMarkupCallback($section_name, $thumbnails, $section);
		//image captions
		$sectionArea_markup .= captionImagesMarkupCallback($section_name, $captions, $section);
		

		//iframes
		$sectionArea_markup .= iFrameMarkupCallback($section_name, $iframes, $section);

	}

	if($section =='body') {
		//pagination
		$sectionArea_markup .= paginationMarkupCallback($section_name, $pagination_content, $section);
	}

	if($section =='navbar' || $section !='mobileNav') {
		$sectionArea_markup .= formsMarkupCallback($section_name, $forms, $section);
	}
	return $sectionArea_markup;

}
