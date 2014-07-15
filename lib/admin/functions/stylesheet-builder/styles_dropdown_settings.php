<?php

function dropdown_menu_callback($kjd_section_misc_settings, $preview){

	$section = 'dropdown-menu';

	// $sidr_nav = $kjd_section_misc_settings['side_nav'];
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
	$dropdownMenuTopBorder = kjd_get_temp_settings(	$section,
											$dropdownMenuBordersOptions['kjd_dropdown-menu_top_border'],
											$preview, 
											'kjd_section_top_border' 
										);
	// $dropdownMenuRightBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_right_border'];
	$dropdownMenuRightBorder = kjd_get_temp_settings(	$section,
											$dropdownMenuBordersOptions['kjd_dropdown-menu_right_border'],
											$preview, 
											'kjd_section_right_border' 
										);

	// $dropdownMenuBottomBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_bottom_border'];
	$dropdownMenuBottomBorder = kjd_get_temp_settings(	$section,
											$dropdownMenuBordersOptions['kjd_dropdown-menu_bottom_border'],
											$preview, 
											'kjd_section_bottom_border' 
										);
	// $dropdownMenuLeftBorder = $dropdownMenuBordersOptions['kjd_dropdown-menu_left_border'];
	$dropdownMenuLeftBorder = kjd_get_temp_settings(	$section,
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

// $dropdown_markup .=".navbar-fixed-bottom.navbar .nav > li > .dropdown-menu:after{
// 	border-top: 7px solid ".$dropdownEndColor.";
// }";

$dropdown_markup .=".navbar .nav > li > .dropdown-menu:before{  
 	border-bottom: 7px solid ".$dropdownMenuTopBorder['color'].";
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
	border-top: 7px solid ".$dropdownMenuBottomBorder['color'].";
	border-bottom:0 none transparent;
	border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    left: 9px;
    bottom: -7px;
    top:auto;
}";

/* -------------------------------- 
     Navbar fixed to bottom 
----------------------------------- */

$dropdown_markup .= ".navbar-fixed-bottom .nav > li > .dropdown-menu:after{
	border-top: 7px solid ".$dropdownStartColor.";
	border-bottom: 0 none transparent;
    left: 10px;
    bottom: -6px;
    top:auto;
}";
$dropdown_markup .=".navbar-fixed-bottom.navbar .nav .sub-menu{margin-bottom:-32px;}";


/* ---------------------------- Dropdown links -------------------------------- */

/* -------------------------------------------------------------
			Insactive Links
--------------------------------------------------------------- */
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

/* -------------------------------------------------------------
		Active Links
--------------------------------------------------------------- */
$sub_bg_active = $dropdownMenuLinkActive['bg_color'] ? $dropdownMenuLinkActive['bg_color'] : 'transparent';



$dropdown_markup .= '.nav-tabs .open .dropdown-toggle,';
$dropdown_markup .= '.nav-pills .open .dropdown-toggle,';
$dropdown_markup .= '.nav > li.dropdown.open.active > a:focus,';
$dropdown_markup .='.dropdown-menu li.active > a,';
$dropdown_markup .= '.dropdown-menu > .active > a,';
$dropdown_markup .= '.dropdown-menu > .active > a:focus {';
	$dropdown_markup .= 'background:'.$sub_bg_active.' ; ';
	$dropdown_markup .= 'color:'.$dropdownMenuLinkActive['color'].';';
	$dropdown_markup .= 'text-decoration:'.$dropdownMenuLinkActive['decoration'].';';
$dropdown_markup .= '}';

$dropdown_markup .= '.nav-tabs .open .dropdown-toggle:after,';
$dropdown_markup .= '.nav-pills .open .dropdown-toggle:after,';
$dropdown_markup .= '.nav > li.dropdown.open.active > a:focus:after,';
$dropdown_markup .='.dropdown-menu li.active > a:after,';
$dropdown_markup .= '.dropdown-menu > .active > a:after,';
$dropdown_markup .= '.dropdown-menu > .active > a:focus:after,';
$dropdown_markup .='.dropdown-menu li.active > a:after {';
	$dropdown_markup .= 'border-left-color:'.$dropdownMenuLinkActive['color'].';';
$dropdown_markup .= '}';


$dropdown_markup .= '.dropdown-menu.sub-menu li.active >a,';
$dropdown_markup .= '.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li.active > ul > li > ul >li >a,';
$dropdown_markup .= '.current_page_item > a,.current-menu-item > a ,.current-page-ancestor > a{ ';
	$dropdown_markup .= 'background-color:none;';
	$dropdown_markup .= 'color:'.$kjd_section_linkHovered['color'].' ;';
$dropdown_markup .= '}';

$dropdown_markup .= '.nav-collapse.sub-menu li.active >a{';
	$dropdown_markup .=' background-color:none;';
	$dropdown_markup .=' color:'.$kjd_section_link['color'].' ;';
$dropdown_markup .='}';


/* -------------------------------------------------------------
		Hover Links
--------------------------------------------------------------- */
$sub_bg_hover = $dropdownMenuLinkHovered['bg_color'] ? $dropdownMenuLinkHovered['bg_color'] : 'transparent';

$dropdown_markup .= '.nav-tabs .open .dropdown-toggle:hover,';
$dropdown_markup .= '.nav-pills .open .dropdown-toggle:hover,';
$dropdown_markup .= '.nav > li.dropdown.open.active > a:hover,';
$dropdown_markup .= '.dropdown-menu li.active > a:hover,';
$dropdown_markup .= '.dropdown-menu > .active > a:hover,';
$dropdown_markup .= '.dropdown-menu li.active > a:hover,';
$dropdown_markup .='.dropdown-menu li > a:hover{
	background:'.$sub_bg_hover.' ; 
	color:'.$dropdownMenuLinkHovered['color'].' ;
	text-decoration:'.$dropdownMenuLinkHovered['decoration'].' ; }';


$submenu_after_caret = $dropdownMenuLinkHovered['color'] ? $dropdownMenuLinkHovered['color'] : $dropdownMenuLink['color'] ;

$dropdown_markup .= '.nav-tabs .open .dropdown-toggle:hover:after,';
$dropdown_markup .= '.nav-pills .open .dropdown-toggle:hover:after,';
$dropdown_markup .= '.nav > li.dropdown.open.active > a:hover:after,';
$dropdown_markup .= '.dropdown-menu li.active > a:hover:after,';
$dropdown_markup .= '.dropdown-menu > .active > a:hover:after,';
$dropdown_markup .= '.dropdown-menu li.active > a:hover:after,';
$dropdown_markup .= '.dropdown-menu li > a:hover:after,';
$dropdown_markup .= '.dropdown-submenu:hover > a:after {
	border-left-color: '.$submenu_after_caret.';	
}';


$dropdown_markup .= '.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus,
.dropdown-submenu:hover > a,
.dropdown-submenu:focus > a:hover{
	background:'.$dropdownMenuLinkHovered['bg_color'].' ; 
	color:'.$dropdownMenuLinkHovered['color'].' ;
}';

	return $dropdown_markup.$collapsed_markup;
}