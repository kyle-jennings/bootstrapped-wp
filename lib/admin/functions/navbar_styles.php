<?php
	// $navSettings = kjd_get_temp_settings(	$section,
	// 										$navSettings['kjd_navbar_misc'],
	// 										$preview, 
	// 										'kjd_navbar_misc_settings' 
	// 									);


function navbarStylesCallback( $preview ){
	
	$section = 'navbar';

	$navSettings = get_option('kjd_navbar_misc_settings');
	$kjd_section_misc_settings = kjd_get_temp_settings(	$section,
														$navSettings['kjd_navbar_misc'],
														$preview, 
														'kjd_section_misc' 
														);


	
	if( $kjd_section_misc_settings['float'] =='true'){


		$margin_top = $kjd_section_misc_settings['margin_top'] ? $kjd_section_misc_settings['margin_top'] : '0' ;
		$margin_bottom = $kjd_section_misc_settings['margin_bottom'] ? $kjd_section_misc_settings['margin_bottom'] : '0' ;
		
		$sectionArea_markup .= "margin-top:".$margin_top."px;";
		$sectionArea_markup .= "margin-bottom:".$margin_bottom."px;";
		
	}


	$flush_links = $kjd_section_misc_settings['flush_first_link'];
	// $sidr_nav = $kjd_section_misc_settings['side_nav'];
	$dropdown_bg = $kjd_section_misc_settings['dropdown_bg'];


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
	
	$kjd_section_link = kjd_get_temp_settings(	$section,
												$navbarLinksOptions['kjd_navbar_link'],
												$preview,
												'kjd_section_link'
										);

	$kjd_section_linkHovered = kjd_get_temp_settings(	'navbar',
												$navbarLinksOptions['kjd_navbar_linkHovered'],
												$preview,
												'kjd_section_linkHovered'
										);

	$kjd_section_LinkActive = kjd_get_temp_settings(	'navbar',
												$navbarLinksOptions['kjd_navbar_linkActive'],
												$preview,
												'kjd_section_linkActive'
										);

	$kjd_section_LinkVisted =  kjd_get_temp_settings(	
											'navbar',
											$navbarLinksOptions['kjd_navbar_linkVisited'],
											$preview,
											'kjd_section_linkVisited'
										);


	/* forms and wells */
	$navbarFormsOptions = get_option('kjd_navbar_forms_settings');
	$navbarForms = kjd_get_temp_settings(	
										'navbar',
										$navbarFormsOptions['kjd_navbar_forms'],
										$preview,
										'kjd_section_forms_settings'
									);

 	$navbar_markup ='';
 	$dropdown_markup ='';
	$collapsed_markup = '';

	$navbar_markup .=".nav .divider-vertical{
		border-left: 1px solid ".$navbarBackgroundColors['endcolor'].";
		border-right: 1px solid ".$navbarBackgroundColors['color'].";
	}";

	// Positions navbar
	if($kjd_section_misc_settings['navbar_alignment'] =='left'){
		
		$navbar_markup .='#navbar .nav{ float:left;}';
	
	}elseif($kjd_section_misc_settings['navbar_alignment'] =='center'){
	
		$navbar_markup .='#navbar ul.nav { margin:0 auto; text-align: center; width:100%;}';
		$navbar_markup .='#navbar ul.nav > li{ display:inline-block; float:none;}';
	
	}elseif($kjd_section_misc_settings['navbar_alignment'] =='right'){
	
		$navbar_markup .='#navbar .nav{ float:right;}';
	
	}



	// Removes box shadow if there is no background color on the navbar - should probably just remove it period
	if($navbarBackgroundColors['gradient'] == 'none' || $kjd_section_misc_settings['kjd_navbar_section_shadow'] == 'none'){

		$navbar_markup .='.navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner,.navbar-inner {   
					box-shadow: none !important;		
				}';
	}

	// remove left padding on first link
	if($flush_links == 'true')
	{

		if($kjd_section_misc_settings['navbar_alignment'] == 'left' || 
			$kjd_section_misc_settings['navbar_alignment'] =='right'){
			
			if( $kjd_section_misc_settings['navbar_link_style'] != 'pills' || $kjd_section_misc_settings['navbar_link_style'] != 'tabs' 
				|| $kjd_section_misc_settings['navbar_link_style'] != 'tabs-below' ) {

				if( $kjd_section_misc_settings['navbar_alignment'] == 'left' ) {
					$navbar_markup .= '.navbar .nav > li:first-child { padding-'.$kjd_section_misc_settings['navbar_alignment'].':0; }';

				}else {
					$navbar_markup .= '.navbar .nav > li:last-child { padding-'.$kjd_section_misc_settings['navbar_alignment'].':0; }';
					
				}
			
			}
		}
	}
	//disable link inner shaddow
	if($kjd_section_misc_settings['link_shadows'] =='true'){
		$navbar_markup .='.navbar .nav > .active > a, ';
		$navbar_markup .='.navbar .nav > .active > a:hover,';
		$navbar_markup .='.navbar .nav > .active > a:focus{box-shadow:none !important;}';
		//echo "box-shadow:none !important;"
	}


	if( in_array($kjd_section_misc_settings['navbar_link_style'], array('tabs', 'tabs-below') ) ){

		// adjusts teh tabs to look nice
		$navbar_markup .= '.navbar .nav > li{';

			if( $kjd_section_misc_settings['navbar_link_style'] == 'tabs' ) {
				$navbar_markup .= 'border-bottom-size:0;';
			}elseif( $kjd_section_misc_settings['navbar_link_style'] == 'tabs-below' ){
				$navbar_markup .= 'border-top-size:0;';
			}
		$navbar_markup .= '}';
	

		$navbar_markup .= '.navbar .nav > li > a{';

			if( $kjd_section_misc_settings['navbar_link_style'] == 'tabs' ) {
				$navbar_markup .= 'border-bottom:0 none transparent !important;';

			}elseif( $kjd_section_misc_settings['navbar_link_style'] == 'tabs-below' ){
				$navbar_markup .= 'border-top:0 none transparent !important;';


			}
		$navbar_markup .= '}';

	}

/* ************************************************************
					link colors 
************************************************************ */


/* -----------------------------------------------------------------
 link colors 
------------------------------------------------------------------- */

$navbar_markup .= '.navbar .nav > li > a {';
		
		if( $kjd_section_link['bg_color'] != ''){
			$navbar_markup .= 'background-color:'.$kjd_section_link['bg_color'].';';

		}else{
			$navbar_markup .= 'background-color: transparent;';
		}
		$navbar_markup .= 'color:'.$kjd_section_link['color'].';';

		if( in_array($kjd_section_misc_settings['navbar_link_style'], array('pills', 'tabs', 'tabs-below') ) ){
			$navbar_markup .= 'border-color:'.$kjd_section_link['border_color'].';';
		}
		$navbar_markup .= 'text-decoration:'.$kjd_section_link['decoration'].' !important;';
$navbar_markup .= '}';

	//  inactive carret
	$navbar_markup .= '.navbar .nav > li > a.dropdown-toggle > .caret,';
    $navbar_markup .= '.navbar .nav li.dropdown > .dropdown-toggle .caret {';
		$navbar_markup .= 'border-top-color:'.$kjd_section_link['color'].';';
	$navbar_markup .= '}';


/* --------------------------------------------------------------------
 active link colors 
---------------------------------------------------------------------- */

 // da link
$navbar_markup .= '.navbar .nav > li.active > a,';
$navbar_markup .= '.navbar .nav li.dropdown.open > .dropdown-toggle,';
$navbar_markup .= '.navbar .nav li.dropdown.active > .dropdown-toggle,';
$navbar_markup .= '.navbar .nav li.dropdown.open.active > .dropdown-toggle,';
$navbar_markup .= '.navbar .nav > .active > a,';
$navbar_markup .= '.dropdown-menu > .active > a';
$navbar_markup .= '{';

	if( $kjd_section_LinkActive['bg_color']){

		$navbar_markup .= 'background-color:'.$kjd_section_LinkActive['bg_color'].';';
		
	}else{
		$navbar_markup .= 'background-color: transparent;';

	}
	
	if( in_array($kjd_section_misc_settings['navbar_link_style'], array('pills', 'tabs', 'tabs-below') ) ){
		$navbar_markup .= 'border-color:'.$kjd_section_LinkActive['border_color'].';';
	}

	$navbar_markup .= 'color:'.$kjd_section_LinkActive['color'].';';
	$navbar_markup .= 'text-decoration:'.$kjd_section_LinkActive['decoration'].' !important;';

$navbar_markup .= '}';

//  active carret 
$navbar_markup .='.navbar .nav > li.active > a.dropdown-toggle > .caret, ';
$navbar_markup .= '.navbar .nav li.dropdown.open > .dropdown-toggle .caret,';
$navbar_markup .= '.navbar .nav li.dropdown.active > .dropdown-toggle .caret,';
$navbar_markup .= '.navbar .nav li.dropdown.open.active > .dropdown-toggle .caret{';
	$navbar_markup .= 'border-top-color:'.$kjd_section_LinkActive['color'].';';
$navbar_markup .= '}';

/* ---------------------------------------------------------------
 hovered link colors 
------------------------------------------------------------------ */

// the link
 $navbar_markup .= '.navbar .nav > .active > a:hover,';
$navbar_markup .= '.dropdown-menu > .active > a:hover,';
$navbar_markup .= '.navbar .nav > li > a:hover,';
$navbar_markup .= '.navbar .nav > .active > a:focus,';
$navbar_markup .= '.navbar .dropdown-menu > .active > a:focus,';
$navbar_markup .= '.navbar .nav > li > a:focus {';

	if( $kjd_section_linkHovered['bg_color'] ){

		$navbar_markup .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
		
	}else{
		$navbar_markup .= 'background-color: transparent;';

	}
	
	if( in_array($kjd_section_misc_settings['navbar_link_style'], array('pills', 'tabs', 'tabs-below') ) ){
		$navbar_markup .= 'border-color:'.$kjd_section_linkHovered['border_color'].';';
	}

	$navbar_markup .= 'color:'.$kjd_section_linkHovered['color'].';';
	$navbar_markup .= 'text-decoration:'.$kjd_section_linkHovered['decoration'].';';
$navbar_markup .= '}';


// $navbar_markup .= '#navbar .nav-tabs { border-bottom: none; }';
// $navbar_markup .= '#navbar .nav-tabs > li {margin-bottom: 0;}';

//hovered carret -->
$navbar_markup .='.navbar .nav > li > a:hover.dropdown-toggle > .caret{';
	$navbar_markup .=' border-top-color:'.$kjd_section_linkHovered['color'].';';
$navbar_markup .='}';

// carret when on bottom 
$navbar_markup .= '.navbar-fixed-bottom .nav > li > a.dropdown-toggle > .caret,';
$navbar_markup .= '.navbar-fixed-bottom .nav li.dropdown > .dropdown-toggle .caret,';
$navbar_markup .= '.navbar-fixed-bottom .nav > li > a.dropdown-toggle > .caret{';
	$navbar_markup .='border-top-color:transparent;';
	$navbar_markup .='border-bottom-color:'.$kjd_section_link['color'].';';
$navbar_markup .='}';

// carret when on bottom:hovered -->
$navbar_markup .='.navbar-fixed-bottom .nav > li > a:hover.dropdown-toggle > .caret{';
	$navbar_markup .= 'border-top-color:transparent;';
	$navbar_markup .= 'border-bottom-color:'.$kjd_section_linkHovered['color'].';';
$navbar_markup .='}';

//carret when on bottom:active -->
$navbar_markup .= '.navbar-fixed-bottom .nav li.dropdown.open > .dropdown-toggle .caret,';
$navbar_markup .= '.navbar-fixed-bottom .nav li.dropdown.active > .dropdown-toggle .caret,';
$navbar_markup .= '.navbar-fixed-bottom .nav li.dropdown.open.active > .dropdown-toggle .caret,';
$navbar_markup .= '.navbar-fixed-bottom .nav > li.active > a.dropdown-toggle > .caret{';
	$navbar_markup .= 'border-top-color:transparent;';
	$navbar_markup .= 'border-bottom-color:'.$kjd_section_LinkActive['color'].';';
$navbar_markup .= '}';

// top level nav when opened  -->
$navbar_markup .='.navbar .nav > li.open > a{';
	$navbar_markup .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
	$navbar_markup .= 'color:'.$kjd_section_linkHovered['color'].';';
$navbar_markup .= '}';


// carret when opened  -->
$navbar_markup .=".navbar .nav > li.open > a.dropdown-toggle > .caret{
	border-top-color:".$kjd_section_linkHovered['color'].";
}";

// top level nav when opened  -->
$navbar_markup .=".navbar .nav li.open > a:after{
	border-color:".$kjd_section_linkHovered['color'].";
}";

	$navbar_markup .= dropdown_menu_callback($kjd_section_misc_settings, $preview);
	
	return ($navbar_markup);
}


/* ---------------------------------------------------------------------------------------
						dropdown colors
--------------------------------------------------------------------------------------- */
include('navbar_dropdown_styles.php');