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
	$sidr_nav = $kjd_section_misc_settings['side_nav'];
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
	
		$navbar_markup .='#navbar ul.nav {margin:0 auto; text-align: center; width:100%;}';
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

	if($kjd_section_misc_settings['navbar_alignment'] == 'left' || $kjd_section_misc_settings['navbar_alignment'] =='right'){
		
		if( $kjd_section_misc_settings['navbar_link_style'] == 'pills' || $kjd_section_misc_settings['navbar_link_style'] == 'tabs' 
			|| $kjd_section_misc_settings['navbar_link_style'] == 'tabs-below' ) {

			$navbar_markup .= '.navbar .nav > li:first-child { padding-'.$kjd_section_misc_settings['navbar_alignment'].':0; }';
		
		}else{
		
		$navbar_markup .= '.navbar .nav > li:first-child > a{padding-'.$kjd_section_misc_settings['navbar_alignment'].':0;}';
		
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

//layouts
	//confines layout to like, 960 and has border radius
	if($kjd_section_misc_settings['navbar_style'] =="contained"){
		$navbar_markup .='.navbar-inner{padding:0;}';
		$navbar_markup .='.navbar-inner .nav li:first-child a{border-radius:4px 0 0 4px;}';
	}
	//stickys to top of page
	if($kjd_section_misc_settings['navbar_style'] =="sticky-top"){
		$navbar_markup .='#header{ padding-top:60px; }';
	}	


// /* *************** link colors ******************** */


/* ----------------------------
 link colors 
 ------------------------------*/

$navbar_markup .= '.navbar .nav > li > a {';
		$navbar_markup .= 'color:'.$kjd_section_link['color'].';';
		
		if( $kjd_section_link['bg_color']){
			$navbar_markup .= 'background-color:'.$kjd_section_link['bg_color'].';';

		}else{
			$navbar_markup .= 'background-color: transparent;';
		}

$navbar_markup .= '}';

	//  inactive carret
	$navbar_markup .= '.navbar .nav > li > a.dropdown-toggle > .caret,';
    $navbar_markup .= '.navbar .nav li.dropdown > .dropdown-toggle .caret {';
		$navbar_markup .= 'border-top-color:'.$kjd_section_link['color'].';';
	$navbar_markup .= '}';


/* ----------------------------
 active link colors 
 ------------------------------*/

 // da link
$navbar_markup .= '.navbar .nav > li.active > a,';
$navbar_markup .= '.navbar .nav li.dropdown.open > .dropdown-toggle,';
$navbar_markup .= '.navbar .nav li.dropdown.active > .dropdown-toggle,';
$navbar_markup .= '.navbar .nav li.dropdown.open.active > .dropdown-toggle,';
$navbar_markup .= '.dropdown-menu > .active > a,';
$navbar_markup .= '.dropdown-menu > .active > a:hover,';
$navbar_markup .= '.dropdown-menu > .active > a:focus {';
	if( $kjd_section_LinkActive['bg_color']){

		$navbar_markup .= 'background-color:'.$kjd_section_LinkActive['bg_color'].';';
		
	}else{
		$navbar_markup .= 'background-color: transparent;';

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

/* ----------------------------
 hovered link colors 
 ------------------------------*/

// the link
$navbar_markup .= '.navbar .nav > li > a:hover,';
$navbar_markup .= '.navbar .nav > li > a:focus {';
	$navbar_markup .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
	$navbar_markup .= 'border-color: '.$kjd_section_linkHovered['bg_color'].';';
	$navbar_markup .= 'color:'.$kjd_section_linkHovered['color'].';';
	$navbar_markup .= 'text-decoration:'.$kjd_section_linkHovered['decoration'].';';
$navbar_markup .= '}';

$navbar_markup .= '#navbar .nav-tabs { border-bottom: none; }';
$navbar_markup .= '#navbar .nav-tabs > li {margin-bottom: 0;}';

//hovered carret -->
$navbar_markup .='.navbar .nav > li > a:hover.dropdown-toggle > .caret{';
	$navbar_markup .=' border-top-color:'.$kjd_section_linkHovered['color'].';';
$navbar_markup .='}';

// carret when on bottom 
$navbar_markup .='.navbar-fixed-bottom .nav > li > a.dropdown-toggle > .caret{';
	$navbar_markup .='border-top-color:transparent;';
	$navbar_markup .='border-bottom-color:'.$kjd_section_link['color'].';';
$navbar_markup .='}';

// carret when on bottom:hovered -->
$navbar_markup .='.navbar-fixed-bottom .nav > li > a:hover.dropdown-toggle > .caret{';
	$navbar_markup .= 'border-top-color:transparent;';
	$navbar_markup .= 'border-bottom-color:'.$kjd_section_linkHovered['color'].';';
$navbar_markup .='}';

//carret when on bottom:active -->
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
						drop down colors
--------------------------------------------------------------------------------------- */

function dropdown_menu_callback($kjd_section_misc_settings, $preview){

	$section = 'dropdown-menu';

	$sidr_nav = $kjd_section_misc_settings['side_nav'];
	$dropdown_bg = $kjd_section_misc_settings['dropdown_bg'];
	
	$options = get_option('kjd_dropdown-menu_misc_settings');
	$options = $options['kjd_dropdown-menu_misc'];
	if($options['remove_padding'] == 'true') {
		$dropdown_markup .= '.dropdown-menu {padding: 0;}';
	}

	/* dropdown settings */

	$dropdownMenuSettings = get_option('kjd_dropdown-menu_options_settings');
	$dropdownMenuSettings = $dropdownMenuSettings['kjd_dropdown-menu_options'];

	$dropdownMenuBackgroundOptions = get_option('kjd_dropdown-menu_background_settings');
	// $dropdownMenuBackgroundColors = $dropdownMenuBackgroundOptions['kjd_dropdown-menu_background_colors'];
	$dropdownMenuBackgroundColors = kjd_get_temp_settings(	$section,
											$dropdownMenuBackgroundOptions['kjd_dropdown-menu_background_colors'],
											$preview, 
											'kjd_section_background_colors'
										);

	$dropdownStartColor = !empty($dropdownMenuBackgroundColors['start_rgba']) ? $dropdownMenuBackgroundColors['start_rgba'] : $dropdownMenuBackgroundColors['color'] ;
	$dropdownStartColor = $dropdownStartColor ? $dropdownStartColor : 'transparent' ;
	
	$dropdownEndColor =  !empty($dropdownMenuBackgroundColors['end_rgba']) ? $dropdownMenuBackgroundColors['end_rgba'] : $dropdownMenuBackgroundColors['endcolor'] ;

	$dropdownEndColor = !empty($dropdownStartEndColor) ? $dropdownEndColor : 'transparent';

	// $dropdownMenuWallpaper = $dropdownMenuBackgroundOptions['kjd_dropdown-menu_background_wallpaper'];
	$dropdownMenuWallpaper = kjd_get_temp_settings(	$section,
											$dropdownMenuBackgroundOptions['kjd_dropdown-menu_background_wallpaper'],
											$preview, 
											'kjd_section_background_wallpaper'
										);

	/* dropdown-menu borders */
	$dropdownMenuBordersOptions = get_option('kjd_dropdown-menu_borders_settings');

	// $dropdownMenuTopBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_top_border'];
	$dropdownMenuLinkHovered = kjd_get_temp_settings(	$section,
											$dropdownMenuBordersOptions['kjd_dropdown-menu_top_border'],
											$preview, 
											'kjd_section_top_border' 
										);
	// $dropdownMenuRightBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_right_border'];
	$dropdownMenuLinkHovered = kjd_get_temp_settings(	$section,
											$dropdownMenuBordersOptions['kjd_dropdown-menu_right_border'],
											$preview, 
											'kjd_section_right_border' 
										);

	// $dropdownMenuBottomBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_bottom_border'];
	$dropdownMenuLinkHovered = kjd_get_temp_settings(	$section,
											$dropdownMenuBordersOptions['kjd_dropdown-menu_bottom_border'],
											$preview, 
											'kjd_section_bottom_border' 
										);
	// $dropdownMenuLeftBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_left_border'];
	$dropdownMenuLinkHovered = kjd_get_temp_settings(	$section,
											$dropdownMenuBordersOptions['kjd_dropdown-menu_left_border'],
											$preview, 
											'kjd_section_left_border' 
										);


	/* dropdown-menu link style */
	$dropdownMenuLinksOptions = get_option('kjd_dropdown-menu_links_settings');
	$dropdownMenuLink = kjd_get_temp_settings(	$section,
		$dropdownMenuLinksOptions['kjd_dropdown-menu_link'],
		$preview, 
		'kjd_section_link' 
	);

	$dropdownMenuLinkHovered = kjd_get_temp_settings(	$section,
											$dropdownMenuLinksOptions['kjd_dropdown-menu_linkHovered'],
											$preview, 
											'kjd_section_linkHovered' 
										);

	// $dropdownMenuLinkActive = $dropdownMenuLinksOptions['kjd_dropdown-menu_linkActive'];

	$dropdownMenuLinkActive = kjd_get_temp_settings(	$section,
											$dropdownMenuLinksOptions['kjd_dropdown-menu_linkActive'],
											$preview, 
											'kjd_section_linkActive' 
										);


	// $dropdownMenuLinkVisted = $dropdownMenuLinksOptions['kjd_dropdown-menu_linkVisited'];
	$dropdownMenuLinkVisted  = kjd_get_temp_settings(	$section,
											$dropdownMenuLinksOptions['kjd_dropdown-menu_linkActive'],
											$preview, 
											'kjd_section_linkVisted' 
										);
/* --------------------------- first level dropdown stuff  --------------------------- */

/* the triangle at the top of the dropdown */


$dropdown_markup .= '.navbar .nav > li > .dropdown-menu:after {';  
 	$dropdown_markup .= 'border-bottom: 7px solid '.$dropdownStartColor.';';
$dropdown_markup.= '}';

$dropdown_markup .=".navbar-fixed-bottom.navbar .nav > li > .dropdown-menu:after{
	border-top: 7px solid ".$dropdownEndColor.";
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
	background-color:".$sub_bg.";
	color:".$dropdownMenuLink['color']." ;
	text-decoration:".$dropdownMenuLink['decoration']." ;
}";

//Drop down triangle
$dropdown_markup .=".dropdown-menu li > a:after {
    border-left-color:".$dropdownMenuLink['color'].";
}";

// active link -->
$sub_bg_active = $dropdownMenuLinkActive['bg_color'] ? $dropdownMenuLinkActive['bg_color'] : 'transparent';

$dropdown_markup .=".dropdown-menu li.active > a,
.dropdown-menu > .active > a,
.dropdown-menu > .active > a:hover,
.dropdown-menu > .active > a:focus{
	background:".$sub_bg_active." ; 
	color:".$dropdownMenuLinkActive['color']." ;
	text-decoration:".$dropdownMenuLinkActive['decoration']." ;
}";

$dropdown_markup .=".dropdown-menu li.active > a:after{
	border-left-color:".$dropdownMenuLinkActive['color'].";
}";

// hovered link -->
$sub_bg_hover = $dropdownMenuLinkHovered['bg_color'] ? $dropdownMenuLinkHovered['bg_color'] : 'transparent';

$dropdown_markup .=".dropdown-menu li > a:hover{
	background:".$sub_bg_hover." ; 
	color:".$dropdownMenuLinkHovered['color']." ;
	text-decoration:".$dropdownMenuLinkHovered['decoration']." ;
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
	background:'.$dropdownMenuLinkHovered['bg_color'].' ; 
	color:'.$dropdownMenuLinkHovered['color'].' ;
}
';

$dropdown_markup .=".dropdown-menu.sub-menu li.active >a,
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li.active > ul > li > ul >li >a,
.current_page_item > a,.current-menu-item > a ,.current-page-ancestor > a,{
	background-color:none;
	color:".$kjd_section_linkHovered['color']." ;	
}";

$dropdown_markup .=".nav-collapse.sub-menu li.active >a{
	background-color:none;
	color:".$kjd_section_link['color']." ;	
}";

/* ----------------------------------------------------------------------
				mobile nav
------------------------------------------------------------------------ */

	return $dropdown_markup.$collapsed_markup;
}