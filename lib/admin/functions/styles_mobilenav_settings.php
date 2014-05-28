<?php

function kjd_build_mobile_styles_callback( $section = 'navbar', $override_nav ) {
	
		
	$media_979_markup = '';

	/* -------------------------------------------------
					Set options			
	------------------------------------------------- */
	$options_links = get_option('kjd_'.$section.'_links_settings');
	// echo '<pre>'
	// print_r($options_links['kjd_'.$section.'_link']); die();
	$kjd_section_link = kjd_get_temp_settings(	$section,
												$options_links['kjd_'.$section.'_link'],
												$preview,
												'kjd_section_link'
											);
	// link colors
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


	// border settings
	$sectionBorders = array('top'=>$kjd_section_top_border,
					'right'=>$kjd_section_right_border,
					'bottom'=>$kjd_section_bottom_border,
					'left'=>$kjd_section_bottom_border
					);
	$options_borders = get_option('kjd_'.$section.'_borders_settings'); 


	$kjd_section_borders = kjd_get_temp_settings(	$section,  
														$options_borders, 
														$preview, 
														'kjd_section_borders_colors' 
													);

	$kjd_section_right_border = $kjd_section_borders['kjd_mobileNav_right_border'];
	$kjd_section_top_border = $kjd_section_borders['kjd_mobileNav_top_border'];
	$kjd_section_bottom_border = $kjd_section_borders['kjd_mobileNav_bottom_border'];
	$kjd_section_left_border = $kjd_section_borders['kjd_mobileNav_left_border'];
	
	$kjd_borders = array(
		'top'=>$kjd_section_top_border,
		'right'=>$kjd_section_right_border,
		'bottom'=>$kjd_section_bottom_border,
		'left'=>$kjd_section_left_border
	);
	// border radius
	$kjd_section_border_radius = kjd_get_temp_settings(	$section,
														$options_borders['kjd_'.$section.'_border_radius'],
														$preview,
														'kjd_section_border_radius'
													);

	$kjd_section_border_radii = array(
		'top-left'=>$kjd_section_border_radius['top-left'],
		'top-right'=>$kjd_section_border_radius['top-right'],
		'bottom-right'=>$kjd_section_border_radius['bottom-right'],
		'bottom-left'=>$kjd_section_border_radius['bottom-left']
	);

	// Background Settings
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
	$type = $kjd_section_background_colors['gradient'];

	// Misc Settings
	$mobileNav_misc = get_option('kjd_mobileNav_misc_settings');
	
	$kjd_section_misc_settings = kjd_get_temp_settings(	$section,
														$mobileNav_misc['kjd_mobileNav_misc'],
														$preview, 
														'kjd_section_misc' 
														);

	$mobile_nav_style = $kjd_section_misc_settings['mobilenav_style'];

	if( $mobile_nav_style == 'dropdown') {
		
		$use_dropdown = 'true';
		$dropdown_settings = array(
			$type =>'type',
			$kjd_borders =>'kjd_borders',
			$kjd_section_top_border =>'kjd_section_top_border',
			$kjd_section_border_radii =>'kjd_section_border_radii',
			$kjd_section_background_colors =>'kjd_section_background_colors',
			$kjd_section_background_wallpaper =>'kjd_section_background_wallpaper'
		);

		$media_979_markup .= build_dropdown_styles( $dropdown_settings );

	}elseif( $mobile_nav_style == 'sidr' ) {
		$using_sidr = 'true';



		// Background Settings
		$options_backgrounds = get_option('kjd_sidrDrawer_background_settings');
		$kjd_sidrDrawer_background_colors = kjd_get_temp_settings(	$section,  
																$options_backgrounds['kjd_sidrDrawer_background_colors'], 
																$preview, 
																'kjd_section_background_colors' 
															);

		$kjd_sidrDrawer_background_wallpaper = kjd_get_temp_settings(	$section, 
																	$options_backgrounds['kjd_sidrDrawer_background_wallpaper'], 	
																	$preview, 
																	'kjd_section_background_wallpaper'
																);
		$sidr_settings = array(
			'kjd_section_link' => $kjd_section_link,
			'kjd_section_linkHovered' => $kjd_section_linkHovered,
			'kjd_section_linkActive' => $kjd_section_linkActive,
			'kjd_section_linkVisited' => $kjd_section_linkVisited,
			'kjd_sidrDrawer_background_colors' => $kjd_sidrDrawer_background_colors,
			'kjd_sidrDrawer_background_wallpaper' => $kjd_sidrDrawer_background_wallpaper,
			'kjd_sidr_border_settings' => $kjd_section_misc_settings,
			'type' => $kjd_sidrDrawer_background_colors['gradient']

		);


		$media_979_markup .= build_sidr_styles( $sidr_settings );
	
	}else{
		$use_default = 'true';

		$media_979_markup .= build_default_styles( );
	}


/* ---------------------------------------------------------
		styles
------------------------------------------------------------ */

	$media_979_markup .= '@media(max-width:979px) {';
		
		$media_979_markup .= '.navbar-wrapper .navbar-inner .nav-tabs.tabs > li > a, ';
		$media_979_markup .= '.navbar-wrapper .navbar-inner .nav-tabs.tabs-below > li > a {';
			$media_979_markup .= 'border-radius: 4px 4px 4px 4px;';
			$media_979_markup .= '-moz-border-radius: 4px 4px 4px 4px;';
			$media_979_markup .= '-webkit-border-radius: 4px 4px 4px 4px;';
			$media_979_markup .= '-0-border-radius: 4px 4px 4px 4px;';
		$media_979_markup .= '}';


		$media_979_markup .= '.navbar-wrapper .nav .dropdown-menu{ border-width:0px !important; }';

	$media_979_markup .='.navbar-wrapper ul.nav > li{ display:block; float:none; }';

	// Positions navbar
	if($kjd_section_misc_settings['menu_alignment'] =='left'){
		
		$media_979_markup .='.navbar-wrapper.mobile-menu ul.nav{ float:left;}';
	
	}elseif($kjd_section_misc_settings['menu_alignment'] =='center'){

		$media_979_markup .='.navbar-wrapper.mobile-menu ul.nav { margin:0 auto; text-align: center; width:100%;}';
		$media_979_markup .='.navbar-wrapper.mobile-menu ul.nav > li{ display:block; float:none;}';
	
	}elseif($kjd_section_misc_settings['menu_alignment'] =='right'){
	
		$media_979_markup .='.navbar-wrapper.mobile-menu ul.nav{ float:right; text-align:right;}';
	
	}


/* ---------------------------------------------------------
				Backgrounds and borders
------------------------------------------------------------ */

	$media_979_markup .= '.navbar-wrapper .navbar-inner {';
		// bg color and wallpaper
		$media_979_markup .= background_type_callback($type, $kjd_section_background_colors, 'mobileNav');
		$media_979_markup .= wallpaper_callback($kjd_section_background_wallpaper);

				// borders
		foreach($kjd_borders as $k =>$v){
			$media_979_markup .= borderSettingsCallback($k, $v);	
		}

		//border radius function
		foreach($kjd_section_border_radii as $k =>$v){
			$media_979_markup .= borderRadiusCallback($k, $v);	
		}

	$media_979_markup .= '}';


/* ---------------------------------------------------------
	brand and shit inside the navbar
------------------------------------------------------------ */
	$media_979_markup .='.navbar-inner .brand{ 
		color:'.$kjd_section_misc_settings['menu_btn_bg'].';
		text-shadow: 0 1px 0 '.$kjd_section_misc_settings['menu_btn_border'].';
	}';

	$media_979_markup .='.navbar-inner .brand:hover{ 
		color:'.$kjd_section_misc_settings['menu_btn_bg_hovered'].';
		text-shadow: 0 1px 0 '.$kjd_section_misc_settings['menu_btn_border_hovered'].';
	}';




/* ---------------------------------------------------------
		drawer toggle
------------------------------------------------------------ */
	$media_979_markup .='.navbar .btn-navbar{ 
		background:'.$kjd_section_misc_settings['menu_btn_bg'].';
		border-color:'.$kjd_section_misc_settings['menu_btn_border'].';
	}';

	$media_979_markup .='.navbar .btn-navbar:hover, .navbar .btn-navbar:active{ 
		background:'.$kjd_section_misc_settings['menu_btn_bg_hovered'].';
		border-color:'.$kjd_section_misc_settings['menu_btn_border_hovered'].';
	}';
	
	$media_979_markup .= '.navbar .btn-navbar .icon-bar{ background: rgba(0,0,0,.1);}';


/* ---------------------------------------------------------
				dropdown detaults
------------------------------------------------------------ */
if($dropdown_bg != 'true'){
	$media_979_markup .= ".nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > a:hover,
			.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul, 
			.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > a:hover,
			.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > a:hover:after,
			.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > ul,
			.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > ul >li >a:hover{
	
				background-color: transparent;
				color:".$kjd_section_linkHovered['color']." !important;	
			}";
}else{

  $media_979_markup .= '.navbar-wrapper .navbar-inner {height: 40px}';
  $media_979_markup .= ".nav-collapse.collapse > .nav:before
  	  {
  	     border-bottom: 7px solid ".$kjd_section_link['color']." !important;
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



} 


	$media_979_markup .= ".navbar .nav > li:first-child > a { padding:9px 15px;}";


/**
 * Navbar links
 * these get style regardless of drawer type
 */
	
/* ------------------------ Normal Links ------------------------ */

	$media_979_markup .= '.nav-collapse .nav > li > a,';
	$media_979_markup .= '.nav-collapse .dropdown-menu a,';
	$media_979_markup .= '.dropdown-menu li > a {';
		$media_979_markup .= 'color:'. $kjd_section_link['color'] .';';

		if($kjd_section_link['bg_style'] != 'none' && $kjd_section_link['bg_style'] != ''){
			$media_979_markup .= 'background-color:'.$kjd_section_link['bg_color'].';';
		}else{
			$media_979_markup .= 'background-color: transparent;';
		}

		$media_979_markup .= 'text-decoration:'.$kjd_section_link['decoration'].';';
	$media_979_markup .= '}';

	$media_979_markup .= '.navbar-wrapper .nav > li > a.dropdown-toggle > .caret,';
	$media_979_markup .= '.navbar-wrapper .nav li.dropdown > .dropdown-toggle .caret {';
		$media_979_markup .= 'border-top-color:'. $kjd_section_link['color'] .';';
	$media_979_markup .= '}';

	// caret
	$media_979_markup .= ".navbar-wrapper .dropdown-menu li > a:after, .dropdown-toggle:after {";
		$media_979_markup .= 'border-left-color:'. $kjd_section_link['color'] .' ;';
	$media_979_markup .= "}";



/* ------------------------ Active Links ------------------------ */

  	$media_979_markup .= ".navbar .nav > li.active > a,
  	.dropdown-menu > .active > a,
  	.navbar .nav > li.active > a, 
	.navbar .nav li.dropdown.active > , 
	.navbar .nav li.dropdown.open.active > .active .dropdown-toggle, 
  	.navbar .nav li.dropdown.open > .dropdown-toggle,
  	.navbar .nav li.dropdown.active > .dropdown-toggle,
  	.navbar .nav li.dropdown.open.active > .dropdown-toggle,
	.navbar .dropdown-menu > .active > a, 
	.navbar .dropdown-menu li.active > a {";

	  	$media_979_markup .= "color:". $kjd_section_linkActive['color'] .";";
 	  	
 	  	 if($kjd_section_linkActive['bg_style'] != 'none' && $kjd_section_linkActive['bg_style'] != ''){
	  	 	$media_979_markup .= 'background-color:'.$kjd_section_linkActive['bg_color'].';';
	  	 }else{
	  	 	$media_979_markup .= 'background-color: transparent;';
	  	 }
	  	
	  	$media_979_markup .= "text-decoration:".$kjd_section_linkActive['decoration'].";";
	
	$media_979_markup .= "}";


	$media_979_markup .= '.navbar-wrapper .nav > li.open > a.dropdown-toggle > .caret,';
	$media_979_markup .= '#sidr .nav > li.active > a.dropdown-toggle > .caret,';
	$media_979_markup .= '#sidr .nav > li.open > a.dropdown-toggle > .caret{';
		$media_979_markup .= 'border-top-color:'. $kjd_section_linkActive['color'] .';';
	$media_979_markup .= '}';	


	$media_979_markup .= ".navbar-wrapper .dropdown-menu li.active > a:after,";
	$media_979_markup .= ".dropdown.active .dropdown-toggle:after {";
		$media_979_markup .= "border-left-color:". $kjd_section_linkActive['color'] ." ;";
	$media_979_markup .= "}";

	$media_979_markup .= '.navbar-wrapper .dropdown-menu li.active > a:after {';
		$media_979_markup .= 'border-top-color:'. $kjd_section_linkActive['color'] .';';
	$media_979_markup .= '}';


/* ------------------------ Hovered Links ------------------------ */


	$media_979_markup .= '.nav-collapse .nav > li > a:hover,';
	$media_979_markup .= '.nav-collapse .dropdown-menu a:hover,';
	$media_979_markup .= '.dropdown-toggle:hover,';
	$media_979_markup .= '.nav-collapse .dropdown-menu li > a:hover,';
	$media_979_markup .= '.navbar .nav > li.active > a:hover,';
	$media_979_markup .= '.dropdown-menu > .active > a:hover,';
	$media_979_markup .= '.navbar .nav > li.active > a:hover, ';
	$media_979_markup .= '.navbar .nav li.dropdown.open > .dropdown-toggle:hover,';
	$media_979_markup .= '.navbar .nav li.dropdown.active > .dropdown-toggle:hover,';
	$media_979_markup .= '.navbar .nav li.dropdown.open.active > .dropdown-toggle:hover,';
	$media_979_markup .= '.navbar .nav-collapse .nav > li > a:hover,';
	$media_979_markup .= '.navbar .nav-collapse .nav > li > a:focus,';
	$media_979_markup .= '.navbar .nav-collapse .dropdown-menu a:hover,';
	$media_979_markup .= '.navbar .nav-collapse .dropdown-menu a:focus';
	  $media_979_markup .= '{';

	  	 $media_979_markup .= 'color:'. $kjd_section_linkHovered['color'] .';';
 	  	 
 	  	 if( $kjd_section_linkHovered['bg_style'] != 'none' && $kjd_section_linkHovered['bg_color'] != ''){
	  	 	$media_979_markup .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
	  	 }else{
	  	 	$media_979_markup .= 'background-color: transparent;';
	  	 }

	  	 $media_979_markup .= 'text-decoration:'.$kjd_section_linkHovered['decoration'].';';
	   $media_979_markup .= '}';


	$media_979_markup .= '.navbar-wrapper .nav > li.open > a.dropdown-toggle > .caret,';
	$media_979_markup .= '.navbar-wrapper .nav > li > a.dropdown-toggle:hover > .caret,';
	$media_979_markup .= '.navbar-wrapper .nav li.dropdown > .dropdown-toggle:hover .caret {';
		$media_979_markup .= 'border-top-color:'. $kjd_section_linkHovered['color'] .';';
	$media_979_markup .= '}';	

	$media_979_markup .= '.navbar-wrapper .dropdown-menu li > a:hover:after,'; 
	$media_979_markup .= '.dropdown-toggle:hover:after';
	$media_979_markup .= '{';
		$media_979_markup .= 'border-left-color:'. $kjd_section_linkHovered['color'] .' ;';
	$media_979_markup .= '}';

	

	$media_979_markup .= '.navbar .nav > li > .dropdown-menu:before { display: none;}';

	$media_979_markup .= '}'; // end media query

	return $media_979_markup;

} // end kjd_build_mobile_styles_callback


/**
 * Build styles for eth default menu type
 * 
 * @return [type]
 */
function build_default_styles(){

	$output = '';

	return;

}

/**
 * Build the "dropdown" manu, its like a larger verion of the desktop nav dropdown
 * @return [type]
 */
function build_dropdown_styles( $dropdown_settings ){
	
	$output = '';

	$output .= '.navbar-wrapper .navbar-inner {';
			$output .= 'background: none;';
			$output .= 'background-color: none;';
			$output .= 'background-image: none;';
			$output .= 'border-top: 0 none transparent;';
			$output .= 'border-bottom: 0 none transparent;';
			$output .= 'box-shadow: 0 0 0 transparent;';
	$output .= '}';
		

	$output .= '.navbar-wrapper .nav-collapse.collapse > .nav{';


		// bg color and wallpaper
		$output .= background_type_callback($type,$kjd_section_background_colors, 'mobileNav');
		$output .= wallpaper_callback($kjd_section_background_wallpaper);

		// borders
		foreach($kjd_borders as $k =>$v){
			$output .= borderSettingsCallback($k, $v);	
		}

		//border radius function
		foreach($kjd_section_border_radii as $k =>$v){
			$output .= borderRadiusCallback($k, $v);	
		}

	$output .= '}';

	$output .= ".navbar-wrapper .nav-collapse.collapse > .nav:before {";
		$output .= "border-bottom: 8px solid ".$kjd_section_top_border['color'].";";
		$output .= "border-left: 8px solid rgba(0, 0, 0, 0);";
		$output .= "border-right: 8px solid rgba(0, 0, 0, 0);";
		$output .= "content: '';";
		$output .= "display: inline-block;";
		$output .= "right: 8px;";
		$output .= "position: absolute;";
		$output .= "top: -8px;";
	$output .= "}";

	$output .= ".navbar-wrapper .nav-collapse.collapse > .nav:after {";
		$output .= "border-bottom: 7px solid ".$kjd_section_background_colors['color'].";";
		$output .= "border-left: 7px solid rgba(0, 0, 0, 0);";
		$output .= "border-right: 7px solid rgba(0, 0, 0, 0);";
		$output .= "content: '';";
		$output .= "display: inline-block;";
		$output .= "right: 9px;";
		$output .= "position: absolute;";
		$output .= "top: -7px;";
	$output .= "}";



	$output .= '.navbar-wrapper .nav-collapse.collapse > .nav { ';
		      $output .= 'background-clip: padding-box;';
		      $output .= 'margin-top:10px;';
		      $output .= 'padding: 10px;';
		      $output .= 'width: auto;';
	$output .=  ' } ';


	return $output;
}

/**
 * Build the sidr drawer styles
 * 
 * @param  array  - all the sidr settings
 * @return string - the css styles
 * 
 */
function build_sidr_styles( $sidr_settings ){

	extract( $sidr_settings );

	$output ='';

	$output .= '#sidr{';

		// bg color and wallpaper
		$output .= background_type_callback( $type, $kjd_sidrDrawer_background_colors );
		$output .= wallpaper_callback( $kjd_sidrDrawer_background_wallpaper );
		
		// borders
		$output .= 'border-right-color:' . $kjd_sidr_border_settings['drawer_border_color'] . ';';
		$output .= 'border-right-style:' . $kjd_sidr_border_settings['drawer_border_style'] . ';';
		$output .= 'border-right-width:' . $kjd_sidr_border_settings['drawer_border_size'] . ';';



	$output .= '}';

		$output .= '#sidr .nav-tabs.nav-stacked > li > a,';
		$output .= '#sidr .nav-tabs.nav-stacked > li > ul > li > a {';
			$output .= 'background-color:'.$kjd_section_link['bg_color'].';';
			$output .= 'border:1px solid '.$kjd_section_link['color'].';';
			$output .= 'color:'.$kjd_section_link['color'].';';
			$output .= 'background-image: none;';
		$output .= '}';


		$output .= '#sidr > ul,';
		$output .= '#sidr > .nav-tabs.nav-stacked';
		$output .='{';
			$output .= 'background-color:'.$kjd_section_link['bg_color'].';';
			// $output .= 'border: 1px solid '.$kjd_section_link['color'].';';
			// $output .= 'border-right: 1px solid '.$kjd_section_link['color'].';';
			// $output .= 'border-bottom: 1px solid '.$kjd_section_link['color'].';';
			// $output .= 'border-left: 1px solid '.$kjd_section_link['color'].';';

		$output .= '}';

		$sub_bg = $kjd_section_link['bg_color'] ? $kjd_section_link['bg_color'] : $dropdownStartColor ;
		$output .= '#sidr .nav-tabs.nav-stacked > li > ul > li > a{background-color:'.$sub_bg.'}';

		$output .= '#sidr .nav li.dropdown.open > a,';
			$output .= '#sidr .nav-pills .open .dropdown-toggle, ';
			$output .= '#sidr .nav li.dropdown.open > a,';
			$output .= '#sidr .nav li.dropdown.open:hover > a, ';
			$output .= '#sidr .nav li.dropdown.open:focus > a{';
			$output .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
			$output .= 'color:'.$kjd_section_linkHovered['color'].';';
		$output .= '}';

		$output .= '#sidr .nav-tabs.nav-stacked > li > ul > li > a, #sidr .sub-menu a{
			color:'.$kjd_section_link['color'].';
			border-top: none;
			border-bottom: none;
		}';


		$output .= '#sidr a,';
		$output .= '#sidr ul.sub-menu > li > a,';
		$output .= '#sidr ul.sub-menu > li > a';
		$output .= '{';
			$output .= 'background:'.$kjd_section_link['bg_color'].';';
			$output .= 'border-top:1px solid '.$kjd_section_link['color'].';';
		$output .= '}';

		$output .= '#sidr .dropdown-menu{
			background-color:'.$kjd_section_link['bg_color'].';
			background-image: none;
		}';

		// $output .= '#sidr .sub-menu{ position: relative; }';
	 	$output .= '#sidr ul.sub-menu > li > a{';
	 		// $output .= 'border-top-color:white;';
	 		$output .= 'border-bottom-color:'.$kjd_section_link['color'].';';
	 	$output .= ' }';

	 	$output .= '#sidr ul.sub-menu > li > a:before{ 
	 		  border-left-color:'.$kjd_section_link['color'].';
		}';

		$output .= '#sidr ul.sub-menu > li > a:hover,';
		$output .= '#sidr .dropdown-menu > li > a:hover,';
			$output .= '#sidr .nav > li.dropdown.open.active > a:hover{';
			$output .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
			$output .= 'color:'.$kjd_section_linkHovered['color'].';';
			$output .= 'text-decoration:'.$kjd_section_linkHovered['decoration'].';';
		$output .= '}';
	 
		$output .= '#sidr .nav-tabs.nav-stacked > li > ul > li > a:hover, 
		#sidr .sub-menu a:hover{
			color:'.$kjd_section_linkHovered['color'].';
			background-color:'.$kjd_section_linkHovered['bg_color'].';
			
			background-image: none;
		}';

		// hovered link
		$output .='#sidr .nav-tabs.nav-stacked > li > a:hover {';
		if( $kjd_section_linkHovered['bg_style'] != 'none' ) {

			$output .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
		}else{
			$output .= 'background-color:transparent;';

		}
			$output .= 'color:'.$kjd_section_linkHovered['color'].';';
		$output .= '}';


		// active links
		$output .='#sidr .nav-tabs.nav-stacked  li.current-menu-parent > a,';
		$output .='#sidr .nav-tabs.nav-stacked  li.current_page_item > a {';
		if( $kjd_section_linkActive['bg_style'] != 'none' ) {

			$output .= 'background-color:'.$kjd_section_linkActive['bg_color'].';';
		}else{
			$output .= 'background-color:transparent;';

		}
			$output .= 'color:'.$kjd_section_linkActive['color'].';';
		$output .= '}';




	/* carets reg*/

		$output .= '
		#sidr .nav .dropdown-toggle .caret{
			border-top-color:'.$kjd_section_link['color'].';
		}';

		$output .= '
		#sidr .nav .dropdown-toggle:hover .caret{
			border-top-color:'.$kjd_section_linkHovered['color'].';
		}';

		$output .= '#sidr .nav li.dropdown.open:hover a .caret, 
		#sidr .nav li.dropdown.open:focus a .caret{
			border-top-color:'.$kjd_section_linkHovered['color'].';
		}';

		$output .= '
		#sidr .dropdown-submenu > a:after{
			border-color: transparent transparent transparent '.$kjd_section_link['color'].';
		}';



		$output .= '#sidr .nav-tabs.nav-stacked li > a:before, ';
		$output .= '#sidr .nav-tabs.nav-stacked li > a:before, ';
		$output .= '#sidr ul.sub-menu > li > a:before, ';
		$output .= '#sidr ul.sub-menu > li > a:before {';
			$output .= 'border-left-color:'.$kjd_section_link['color'].';';
		$output .= '}';
	/* carets active */

		$output .='#sidr .nav-tabs.nav-stacked  li.current-menu-parent > a:before,';
		$output .='#sidr .nav-tabs.nav-stacked  li.current_page_item > a:before,';
		$output .='#sidr ul.sub-menu > li.current-menu-parent > a:before,';
		$output .='#sidr ul.sub-menu > li.current_page_item > a:before {';
			$output .= 'border-left-color:'.$kjd_section_linkActive['color'].';';
		$output .= '}';



	/* carets hover */

		$output .= '#sidr ul.sub-menu li a:hover:before{
			border-color: transparent transparent transparent '.$kjd_section_linkHovered['color'].';
		}';

	return $output;
}