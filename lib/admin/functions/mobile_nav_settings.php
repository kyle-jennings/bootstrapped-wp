<?php
		$section = 'mobileNav';

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

		$sectionBorders = array('top'=>$kjd_section_top_border,
						'right'=>$kjd_section_right_border,
						'bottom'=>$kjd_section_bottom_border,
						'left'=>$kjd_section_bottom_border
						);

/* ------------------------- sidr ------------------------ */
	$media_979_markup .='.sidr .nav-tabs.nav-stacked > li > a,
	.sidr .nav-tabs.nav-stacked > li > ul > li > a{
			background-color:'.$kjd_section_link['bg_color'].';
			border:1px solid '.$sectionBorders['top']['color'].';
			color:'.$kjd_section_link['color'].';
			background-image: none !important;
		}';


	$sub_bg = $kjd_section_link['bg_color'] ? $kjd_section_link['bg_color'] : $dropdownStartColor ;
	$media_979_markup .= '.sidr .nav-tabs.nav-stacked > li > ul > li > a{background-color:'.$sub_bg.'}';

	$media_979_markup .= '.sidr .nav li.dropdown.open > a,
	.sidr .nav-pills .open .dropdown-toggle, 
	.sidr .nav li.dropdown.open > a,
	.sidr .nav li.dropdown.open:hover > a, 
	.sidr .nav li.dropdown.open:focus > a{
		background-color:'.$kjd_section_linkHovered['bg_color'].';
		color:'.$kjd_section_linkHovered['color'].';
	}';

	$media_979_markup .= '.sidr .nav-tabs.nav-stacked > li > ul > li > a, .sidr .sub-menu a{
		color:'.$kjd_section_link['color'].';
		border-left:1px solid '.$sectionBorders['top']['color'].';	
		border-right:1px solid '.$sectionBorders['top']['color'].';
		border-top: none;
		border-bottom: none;
	}';

	$media_979_markup .= '.sidr .dropdown-menu{
		background-color:'.$kjd_section_link['bg_color'].';
		background-image: none !important;
	}';

	// $media_979_markup .= '.sidr .sub-menu{ position: relative; }';
 	$media_979_markup .= '#sidr ul.sub-menu > li > a{';
 		// $media_979_markup .= 'border-top-color:white;';
 		$media_979_markup .= 'border-bottom-color:'.$sectionBorders['top']['color'].';';
 	$media_979_markup .= ' }';

 	$media_979_markup .= '#sidr ul.sub-menu > li > a:before{ 
 		  border-left-color:'.$sectionBorders['top']['color'].' !important;
	}';


	$media_979_markup .= '.sidr .dropdown-menu > li > a:hover,
	.sidr .nav > li.dropdown.open.active > a:hover{
		background-color:'.$kjd_section_linkHovered['bg_color'].';
		color:'.$kjd_section_linkHovered['color'].';
		background-image: none !important;
		border:none;
	}';
 
	$media_979_markup .= '.sidr .nav-tabs.nav-stacked > li > ul > li > a:hover, 
	.sidr .sub-menu a:hover{
		color:'.$kjd_section_linkHovered['color'].';
		background-color:'.$kjd_section_linkHovered['bg_color'].';
		
		background-image: none !important;
	}';

	$media_979_markup .='.sidr .nav-tabs.nav-stacked > li > a:hover
	{
		background-color:'.$kjd_section_linkHovered['bg_color'].';
		color:'.$kjd_section_linkHovered['color'].';

	}';


/* carets reg*/

	$media_979_markup .= '
	.sidr .nav .dropdown-toggle .caret{
		border-top-color:'.$kjd_section_link['color'].';
	}';

	$media_979_markup .= '
	.sidr .nav .dropdown-toggle:hover .caret{
		border-top-color:'.$kjd_section_linkHovered['color'].';
	}';

	$media_979_markup .= '.sidr .nav li.dropdown.open:hover a .caret, 
	.sidr .nav li.dropdown.open:focus a .caret{
		border-top-color:'.$kjd_section_linkHovered['color'].';
	}';

	$media_979_markup .= '
	.sidr .dropdown-submenu > a:after{
		border-color: transparent transparent transparent '.$kjd_section_link['color'].';
	}';

	$media_979_markup .= '
	.sidr .dropdown-submenu > a:hover:after{
		border-color: transparent transparent transparent '.$kjd_section_linkHovered['color'].';
	}';

	$media_979_markup .= '
	.sidr .dropdown-submenu.open > a:after,
	.sidr .dropdown-submenu:focus > a:after{
		border-color: transparent transparent transparent '.$kjd_section_linkHovered['color'].';
	}';



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
	  	     border-bottom: 7px solid ".$sectionBorders['top']['color']." !important;
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
	  	      border: 1px solid ". $sectionBorders['top']['color'] .";
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

	} 

	  $media_979_markup .= ".navbar .nav > li:first-child > a { padding:9px 15px;}";

		// $media_979_markup .= ".nav-collapse .navbar .nav > li > a.dropdown-toggle > .caret,";
		// $media_979_markup .= ".navbar .nav > li.open > a.dropdown-toggle > .caret,";
		// $media_979_markup .= ".nav-collapse .navbar .nav > li > a.dropdown-toggle > .caret:hover{";
		// 	$media_979_markup .= "border-top-color:". $kjd_section_link['color'] ." !important;";
		// $media_979_markup .= "}";

		// $media_979_markup .= ".dropdown-menu li > a:after,";
		// $media_979_markup .= ".dropdown-menu li > a:hover:after{";
		// 	$media_979_markup .= "border-left-color:". $kjd_section_link['color'] ." !important;";
		// $media_979_markup .= "}";


/* ------------------------ Normal Links ------------------------ */

	  $media_979_markup .= '.nav-collapse .nav > li > a, .nav-collapse .dropdown-menu a {';
	  	 $media_979_markup .= 'color:'. $kjd_section_link['color'] .';';
	  	 
	  	 if($kjd_section_link['bg_style'] != 'none'){
	  	 	$media_979_markup .= 'background-color:'.$kjd_section_link['bg_color'].';';
	  	 }

	  	 $media_979_markup .= 'text-decoration:'.$kjd_section_link['decoration'].';';
	   $media_979_markup .= '}';

	$media_979_markup .= '#navbar .nav > li > a.dropdown-toggle > .caret,';
	$media_979_markup .= '#navbar .nav li.dropdown > .dropdown-toggle .caret {';
		$media_979_markup .= 'border-top-color:'. $kjd_section_link['color'] .';';
	$media_979_markup .= '}';


	/* ------------------------ Hovered Links ------------------------ */


	  $media_979_markup .= '.nav-collapse .nav > li > a:hover, .nav-collapse .dropdown-menu a:hover{';
	  	 $media_979_markup .= 'color:'. $kjd_section_linkHovered['color'] .';';
 	  	 if($kjd_section_linkHovered['bg_style'] != 'none'){
	  	 	$media_979_markup .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
	  	 }
	  	 $media_979_markup .= 'text-decoration:'.$kjd_section_linkHovered['decoration'].';';
	   $media_979_markup .= '}';

	$media_979_markup .= '#navbar .nav > li > a.dropdown-toggle:hover > .caret,';
	$media_979_markup .= '#navbar .nav li.dropdown > .dropdown-toggle:hover .caret {';
		$media_979_markup .= 'border-top-color:'. $kjd_section_linkHovered['color'] .';';
	$media_979_markup .= '}';	

	/* ------------------------ Active Links ------------------------ */

  	$media_979_markup .= ".navbar .nav > li.active > a,
  	.navbar .nav li.dropdown.open > .dropdown-toggle,
  	.navbar .nav li.dropdown.active > .dropdown-toggle,
  	.navbar .nav li.dropdown.open.active > .dropdown-toggle,
  	.dropdown-menu > .active > a,
  	.dropdown-menu > .active > a:hover,
  	.dropdown-menu > .active > a:focus {";

	
	  	$media_979_markup .= "color:". $kjd_section_linkActive['color'] .";";
 	  	 if($kjd_section_linkActive['bg_style'] != 'none'){
	  	 	$media_979_markup .= 'background-color:'.$kjd_section_linkActive['bg_color'].';';
	  	 }
	  	$media_979_markup .= "text-decoration:".$kjd_section_linkActive['decoration'].";";
	  $media_979_markup .= "}";


	$media_979_markup .= '#navbar .nav > li.open > a.dropdown-toggle > .caret,';
	$media_979_markup .= '#navbar .nav li.dropdown.open > .dropdown-toggle .caret {';
		$media_979_markup .= 'border-top-color:'. $kjd_section_linkActive['color'] .';';
	$media_979_markup .= '}';
