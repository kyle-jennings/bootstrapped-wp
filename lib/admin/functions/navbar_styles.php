<?php


function navbarStylesCallback(&$media_979_markup, $preview){
	// $navSettings = kjd_get_temp_settings(	$section,
	// 										$navSettings['kjd_navbar_misc'],
	// 										$preview, 
	// 										'kjd_navbar_misc_settings' 
	// 									);
	
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
		$media_979_markup .='#navbar ul.nav > li{ display:block; float:none;}';
	
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
//  normal link colors 

$navbar_markup .="
.navbar .nav > li > a{
		color:".$kjd_section_link['color'].";
		background-color:".$kjd_section_link['bg_color'].";
	}";

	//  inactive carret
	$navbar_markup .=".navbar .nav > li > a.dropdown-toggle > .caret,
					  .navbar .nav li.dropdown > .dropdown-toggle .caret{
						border-top-color:".$kjd_section_link['color'].";
					}";


// active link colors 
$navbar_markup .=".navbar .nav > li.active > a,
.navbar .nav li.dropdown.open > .dropdown-toggle,
.navbar .nav li.dropdown.active > .dropdown-toggle,
.navbar .nav li.dropdown.open.active > .dropdown-toggle{
	background-color:".$kjd_section_LinkActive['bg_color'].";
	color:".$kjd_section_LinkActive['color'].";
	text-decoration:".$kjd_section_LinkActive['decoration']." !important;
}";
	//  active carret 
	$navbar_markup .=".navbar .nav > li.active > a.dropdown-toggle > .caret,
	 .navbar .nav li.dropdown.open > .dropdown-toggle .caret,
	 .navbar .nav li.dropdown.active > .dropdown-toggle .caret,
	 .navbar .nav li.dropdown.open.active > .dropdown-toggle .caret{
		border-top-color:".$kjd_section_LinkActive['color'].";
	  }";


//  toplevel nav when hovered 
$navbar_markup .=" .navbar .nav > li > a:hover, 
.navbar .nav > li > a:focus{
	
	background-color:".$kjd_section_linkHovered['bg_color']." !important;
	border-color: ".$kjd_section_linkHovered['bg_color'].";
	color:".$kjd_section_linkHovered['color']." !important;
	text-decoration:".$kjd_section_linkHovered['decoration']." !important;
}";

$navbar_markup .= "#navbar .nav-tabs { border-bottom: none; }";
$navbar_markup .= "#navbar .nav-tabs > li {margin-bottom: 0;}";

//hovered carret -->
$navbar_markup .=".navbar .nav > li > a:hover.dropdown-toggle > .caret{
		border-top-color:".$kjd_section_linkHovered['color']." !important;
	}";

// carret when on bottom 
$navbar_markup .=".navbar-fixed-bottom .nav > li > a.dropdown-toggle > .caret{
		border-top-color:transparent !important;
	border-bottom-color:".$kjd_section_link['color']." !important;
}";
// carret when on bottom:hovered -->
$navbar_markup .=".navbar-fixed-bottom .nav > li > a:hover.dropdown-toggle > .caret{
	border-top-color:transparent !important;
	border-bottom-color:".$kjd_section_linkHovered['color']." !important;
}";
//carret when on bottom:active -->
$navbar_markup .=".navbar-fixed-bottom .nav > li.active > a.dropdown-toggle > .caret{
		border-top-color:transparent !important;
		border-bottom-color:".$kjd_section_LinkActive['color']." !important;
}";

// top level nav when opened  -->
$navbar_markup .=".navbar .nav > li.open > a{
	background-color:".$kjd_section_linkHovered['bg_color']." !important;
	color:".$kjd_section_linkHovered['color']." !important;
}";


// carret when opened  -->
$navbar_markup .=".navbar .nav > li.open > a.dropdown-toggle > .caret{
	border-top-color:".$kjd_section_linkHovered['color']." !important;
}";

// top level nav when opened  -->
$navbar_markup .=".navbar .nav li.open > a:after{
	border-color:".$kjd_section_linkHovered['color']." !important;
}";

	$navbar_markup .= dropdown_menu_callback($kjd_section_misc_settings, $media_979_markup);
	return ($navbar_markup);
}

function dropdown_menu_callback($kjd_section_misc_settings, &$media_979_markup){

	$sidr_nav = $kjd_section_misc_settings['side_nav'];
	$dropdown_bg = $kjd_section_misc_settings['dropdown_bg'];

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
	color:".$kjd_section_linkHovered['color']." !important;	
}";

$dropdown_markup .=".nav-collapse.sub-menu li.active >a{
	background-color:none!important;
	color:".$kjd_section_link['color']." !important;	
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
	if($kjd_section_misc_settings['navbar_link_style'] == 'none'){
	
		$collapsed_markup .=".navbar .nav > li > a,";
		$collapsed_markup .=".navbar .nav > li.open > a,";
		$collapsed_markup .=".navbar .nav > li.active > a,";
		$collapsed_markup .=".navbar .nav > li > a:hover{";
		$collapsed_markup .="background:none !important;}";
	
	}elseif($kjd_section_misc_settings['navbar_link_style'] == 'highlighted'){
	
		$collapsed_markup .="#navbar .nav li{margin:0 4px 0 0;}";		
	
	}elseif($kjd_section_misc_settings['navbar_link_style'] == 'pills'){
	
		$collapsed_markup .=".nav-pills li a{border-color:".$kjd_section_link['border_color']."; border-top:0 !important; border-radius: 4px !important; height:17px;}";		
	
	}elseif($kjd_section_misc_settings['navbar_link_style'] == 'tabs-below'){
	
		$collapsed_markup .=".nav-tabs, .nav{border-bottom:0 !important; margin-bottom:-2px;}";
		$collapsed_markup .=".nav-tabs li a{border-color:".$kjd_section_link['border_color']."; border-top:0 !important; border-radius: 0 0 4px 4px !important; height:17px;}";
		$collapsed_markup .=".nav-tabs li a:hover, .navbar .nav li a:hover, .active a{border-color:".$kjd_section_linkHovered['border_color']." !important; }";
		$collapsed_markup .=".current_page_item a{border-color:".$kjd_section_LinkActive['border_color']." !important;}";

	}elseif($kjd_section_misc_settings['navbar_link_style'] == 'tabs'){
	
		$collapsed_markup .=".nav-tabs, .nav{border-bottom:0 !important; margin-bottom:-2px;}";
		$collapsed_markup .=".nav-tabs li a, .navbar .nav li a{border-color:".$kjd_section_link['border_color']."; border-bottom:0 !important; height:17px;}";
		$collapsed_markup .=".nav-tabs li a:hover, .navbar .nav li a:hover, .active a{border-color:".$kjd_section_linkHovered['border_color']." !important; }";
		$collapsed_markup .= ".current_page_item a{ border-color:".$kjd_section_LinkActive['border_color']." !important;}";
	
	}

/*---------------------------------- mobile only -----------------------------------*/

		// mobile bar button
		$media_979_markup .='.navbar .btn-navbar{ 
			background:'.$kjd_section_misc_settings['menu_btn_bg'].';
			border-color:'.$kjd_section_misc_settings['menu_btn_border'].';
		}';

		$media_979_markup .='.navbar .btn-navbar:hover, .navbar .btn-navbar:active{ 
			background:'.$kjd_section_misc_settings['menu_btn_bg_hovered'].';
			border-color:'.$kjd_section_misc_settings['menu_btn_border_hovered'].';
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
					color:".$kjd_section_linkHovered['color']." !important;	
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