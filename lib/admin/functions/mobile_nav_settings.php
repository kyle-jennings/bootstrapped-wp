<?php
		$section = 'mobileNav';

/* -------------------------------------------------
				Set options			
------------------------------------------------- */
		$use_mobile_background = get_option('kjd_navbar_misc_settings');
		$use_mobile_background = $use_mobile_background['kjd_navbar_misc']['dropdown_bg'];

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
		$options_borders = get_option('kjd_'.$section.'_borders_settings'); 
	

		$kjd_section_borders = kjd_get_temp_settings(	$section,  
															$options_borders, 
															$preview, 
															'kjd_section_borders_colors' 
														);

		$kjd_section_right_border = $kjd_section_borders['kjd_mobileNav_right_border'];

		
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


/* ---------------------------------------------------------
				Settings
------------------------------------------------------------ */

/* ---------------------------------------------------------
				Borders
------------------------------------------------------------ */
$mobile_dropdown_raidii = $dropdownMenuBordersOptions['kjd_dropdown-menu_border_radius'] ?
						  $dropdownMenuBordersOptions['kjd_dropdown-menu_border_radius'] :
						  '4px';

$top_left = $mobile_dropdown_raidii['top-left'];
$top_right = $mobile_dropdown_raidii['top-right'];
$bottom_right = $mobile_dropdown_raidii['bottom-right'];
$bottom_left = $mobile_dropdown_raidii['bottom-left'];


/* ---------------------------------------------------------
				Border
------------------------------------------------------------ */

/* ---------------------------------------------------------
				Backgrounds
------------------------------------------------------------ */


if($use_mobile_background == 'true'){

	$media_979_markup .= "#navbar .nav-collapse.collapse > .nav
		  {    
		      background-clip: padding-box;
		      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		      float: right;
		      left: 0;
		      list-style: none outside none;
		      margin: 10px 0 0;
		      min-width: 160px;
		      padding: 5px 0;
		      z-index: 1000;
		      width: 99%;";
	$media_979_markup .=  " } ";

}



$media_979_markup .= '.nav-collapse .dropdown-menu';
$media_979_markup .= '{';
	$media_979_markup .= 'display: block;';
$media_979_markup .= '}';

/* ------------------------- sidr ------------------------ */


	$media_979_markup .= '#sidr {';
		$media_979_markup .= 'border-right-color:'.$kjd_section_right_border['color'].';';
		$media_979_markup .= 'border-right-width:'.$kjd_section_right_border['size'].';';
		$media_979_markup .= 'border-right-style:'.$kjd_section_right_border['style'].' ;';
	$media_979_markup .= '}';
	

	$media_979_markup .='.sidr .nav-tabs.nav-stacked > li > a,
	.sidr .nav-tabs.nav-stacked > li > ul > li > a{
			background-color:'.$kjd_section_link['bg_color'].';
			border:1px solid '.$kjd_section_link['color'].';
			color:'.$kjd_section_link['color'].';
			background-image: none;
		}';


	$media_979_markup .= '.sidr > ul,';
	$media_979_markup .= '#sidr > .nav-tabs.nav-stacked';
	$media_979_markup .='{';
		$media_979_markup .= 'background-color:'.$kjd_section_link['bg_color'].';';
		$media_979_markup .= 'border: 1px solid '.$kjd_section_link['color'].';';
		$media_979_markup .= 'border-right: 1px solid '.$kjd_section_link['color'].';';
		$media_979_markup .= 'border-bottom: 1px solid '.$kjd_section_link['color'].';';
		$media_979_markup .= 'border-left: 1px solid '.$kjd_section_link['color'].';';

	$media_979_markup .= '}';

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
		border-top: none;
		border-bottom: none;
	}';


	$media_979_markup .= '.sidr a,';
	$media_979_markup .= '.sidr ul.sub-menu > li > a,';
	$media_979_markup .= '#sidr ul.sub-menu > li > a';
	$media_979_markup .= '{';
		$media_979_markup .= 'background:'.$kjd_section_link['bg_color'].';';
		$media_979_markup .= 'border-top:1px solid '.$kjd_section_link['color'].';';
	$media_979_markup .= '}';

	$media_979_markup .= '.sidr .dropdown-menu{
		background-color:'.$kjd_section_link['bg_color'].';
		background-image: none;
	}';

	// $media_979_markup .= '.sidr .sub-menu{ position: relative; }';
 	$media_979_markup .= '#sidr ul.sub-menu > li > a{';
 		// $media_979_markup .= 'border-top-color:white;';
 		$media_979_markup .= 'border-bottom-color:'.$kjd_section_link['color'].';';
 	$media_979_markup .= ' }';

 	$media_979_markup .= '#sidr ul.sub-menu > li > a:before{ 
 		  border-left-color:'.$kjd_section_link['color'].';
	}';

	$media_979_markup .= '#sidr ul.sub-menu > li > a:hover,';
	$media_979_markup .= '.sidr .dropdown-menu > li > a:hover,
	.sidr .nav > li.dropdown.open.active > a:hover{
		background-color:'.$kjd_section_linkHovered['bg_color'].';
		color:'.$kjd_section_linkHovered['color'].';
		text-decoration:'.$kjd_section_linkHovered['decoration'].';
	}';
 
	$media_979_markup .= '.sidr .nav-tabs.nav-stacked > li > ul > li > a:hover, 
	.sidr .sub-menu a:hover{
		color:'.$kjd_section_linkHovered['color'].';
		background-color:'.$kjd_section_linkHovered['bg_color'].';
		
		background-image: none;
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

/* carets hover */
	$media_979_markup .= '#sidr ul.sub-menu li a:hover:before{
		border-color: transparent transparent transparent '.$kjd_section_linkHovered['color'].';
	}';
/* carets active */

	$media_979_markup .= '
	.sidr .dropdown-submenu.open > a:after,
	.sidr .dropdown-submenu:focus > a:after{
		border-color: transparent transparent transparent '.$kjd_section_linkHovered['color'].';
	}';





/*---------------------------------- Dropdown -----------------------------------*/

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

		// $media_979_markup .= ".nav-collapse .navbar .nav > li > a.dropdown-toggle > .caret,";
		// $media_979_markup .= ".navbar .nav > li.open > a.dropdown-toggle > .caret,";
		// $media_979_markup .= ".nav-collapse .navbar .nav > li > a.dropdown-toggle > .caret:hover{";
		// 	$media_979_markup .= "border-top-color:". $kjd_section_link['color'] ." !important;";
		// $media_979_markup .= "}";



/* ------------------------ Normal Links ------------------------ */

	  $media_979_markup .= '.nav-collapse .nav > li > a,
	   .nav-collapse .dropdown-menu a,
	   .dropdown-menu li > a {';
	  	 $media_979_markup .= 'color:'. $kjd_section_link['color'] .';';
	  	 
	  	 if($kjd_section_link['bg_style'] != 'none'){
	  	 	$media_979_markup .= 'background-color:'.$kjd_section_link['bg_color'].';';
	  	 }else{
	  	 	$media_979_markup .= 'background-color: transparent;';

	  	 }

	  	 $media_979_markup .= 'text-decoration:'.$kjd_section_link['decoration'].';';
	   $media_979_markup .= '}';

	$media_979_markup .= '#navbar .nav > li > a.dropdown-toggle > .caret,';
	$media_979_markup .= '#navbar .nav li.dropdown > .dropdown-toggle .caret {';
		$media_979_markup .= 'border-top-color:'. $kjd_section_link['color'] .';';
	$media_979_markup .= '}';

// caret
	$media_979_markup .= "#navbar .dropdown-menu li > a:after, .dropdown-toggle:after {";
		$media_979_markup .= "border-left-color:". $kjd_section_link['color'] ." ;";
	$media_979_markup .= "}";



	/* ------------------------ Active Links ------------------------ */

  	$media_979_markup .= ".navbar .nav > li.active > a,
  	.dropdown-menu > .active > a,
  	.navbar .nav > li.active > a, 
	.navbar .nav li.dropdown.active > 
	.navbar .nav li.dropdown.open.active > 
	.active .dropdown-toggle, 
  	.navbar .nav li.dropdown.open > .dropdown-toggle,
  	.navbar .nav li.dropdown.active > .dropdown-toggle,
  	.navbar .nav li.dropdown.open.active > .dropdown-toggle,
	.dropdown-menu > .active > a, 
	.dropdown-menu li.active > a {";

	  	$media_979_markup .= "color:". $kjd_section_linkActive['color'] .";";
 	  	
 	  	 if($kjd_section_linkActive['bg_style'] != 'none'){
	  	 	$media_979_markup .= 'background-color:'.$kjd_section_linkActive['bg_color'].';';
	  	 }else{
	  	 	$media_979_markup .= 'background-color: transparent;';
	  	 }
	  	
	  	$media_979_markup .= "text-decoration:".$kjd_section_linkActive['decoration'].";";
	
	$media_979_markup .= "}";



	$media_979_markup .= "#navbar .dropdown-menu li.active > a:after,";
	$media_979_markup .= ".dropdown.active .dropdown-toggle:after {";
		$media_979_markup .= "border-left-color:". $kjd_section_linkActive['color'] ." ;";
	$media_979_markup .= "}";

	$media_979_markup .= '#navbar .dropdown-menu li.active > a:after {';
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
	$media_979_markup .= '.navbar .nav li.dropdown.open.active > .dropdown-toggle:hover';

	  $media_979_markup .= '{';

	  	 $media_979_markup .= 'color:'. $kjd_section_linkHovered['color'] .';';
 	  	 
 	  	 if($kjd_section_linkHovered['bg_style'] != 'none'){
	  	 	$media_979_markup .= 'background-color:'.$kjd_section_linkHovered['bg_color'].';';
	  	 }else{
	  	 	$media_979_markup .= 'background-color: transparent;';
	  	 }

	  	 $media_979_markup .= 'text-decoration:'.$kjd_section_linkHovered['decoration'].';';
	   $media_979_markup .= '}';

	$media_979_markup .= '#navbar .nav > li > a.dropdown-toggle:hover > .caret,';
	$media_979_markup .= '#navbar .nav li.dropdown > .dropdown-toggle:hover .caret {';
		$media_979_markup .= 'border-top-color:'. $kjd_section_linkHovered['color'] .';';
	$media_979_markup .= '}';	

	$media_979_markup .= '#navbar .dropdown-menu li > a:hover:after,'; 
	$media_979_markup .= '.dropdown-toggle:hover:after';
	$media_979_markup .= '{';
		$media_979_markup .= 'border-left-color:'. $kjd_section_linkHovered['color'] .' ;';
	$media_979_markup .= '}';

	

	$media_979_markup .= '.navbar .nav > li > .dropdown-menu:before { display: none;}';
