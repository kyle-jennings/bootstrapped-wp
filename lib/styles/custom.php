<?php 
function load_custom_style(){ 

	$sections = array('htmlTag','bodyTag','mastArea','header','navbar','dropdown-menu','cycler','contentArea','pageTitle','body','footer');

?>
<style>
/*
Theme Name: KJD user settings
Theme URI: http://kylejenningsdesign.com
Description: user customized color scheme
Version: 1.0
Author: Kyle Jennings Design

*/		
<?php 

// 	$parts = explode(':',$generalSettings['kjd_general_font']['font']);
// 	$parts = str_replace('+',' ',$parts[0]);
// 	$generalFont = "'".$parts."'";

	$generalSettings = get_option('kjd_theme_settings');
	$confineBackgrounds = $generalSettings['kjd_confine_page'];
	$responsive = $generalSettings['kjd_responsive_design'];
	$pageWrapperShadow = $generalSettings['kjd_box_shadow'];
	$stickyFooter = $generalSettings['sticky_footer'];
	if($responsive != 'true'){ ?>
		#navbar > .navbar-inner > .container > .collapse{overflow:visible !important;}
	<?php
	}
	if($confineBackgrounds=='true' && $responsive != 'true'){ ?>
		#pageWrapper{
			<?php if($pageWrapperShadow =='true'){ ?>
				-webkit-box-shadow: 0px 0px 20px rgba(50, 50, 50, 0.75);
				-moz-box-shadow:    0px 0px 20px rgba(50, 50, 50, 0.75);
				box-shadow:         0px 0px 20px rgba(50, 50, 50, 0.75);
				
			<?php }?>
			width:980px;
		}
		#footer{margin:0 auto; width:980px;}
	<?php
	}

	if($stickyFooter =='true'){
	?>

	<?php
	}
/* **************** */
/* Navbar settings  */
/* **************** */
	//kjd_navbar_misc_settings[kjd_navbar_misc][navbar_style]
	$navSettings = get_option('kjd_navbar_misc_settings');
	$navSettings = $navSettings['kjd_navbar_misc'];

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
	$navbarLink = $navbarLinksOptions['kjd_navbar_link'];
	$navbarLinkHovered = $navbarLinksOptions['kjd_navbar_linkHovered'];
	$navbarLinkActive = $navbarLinksOptions['kjd_navbar_linkActive'];
	$navbarLinkVisted = $navbarLinksOptions['kjd_navbar_linkVisited'];


	/* forms and wells */
	$navbarFormsOptions = get_option('kjd_navbar_forms_settings');
	$navbarForms = $navbarFormsOptions['kjd_navbar_forms'];

	/* subnav settings */

	$dropdownMenuSettings = get_option('kjd_dropdown-menu_options_settings');
	$dropdownMenuSettings = $dropdownMenuSettings['kjd_dropdown-menu_options'];

	$dropdownMenuBackgroundOptions = get_option('kjd_dropdown-menu_background_settings');
	$dropdownMenuBackgroundColors = $dropdownMenuBackgroundOptions['kjd_dropdown-menu_background_colors'];
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

// Positions navbar
	if($navSettings['navbar_alignment'] =='left'){ ?>
		#navbar .nav{ float:left;}
	<?php
	}elseif($navSettings['navbar_alignment'] =='center'){
		?>
		#navbar > .nav{ text-align: center;}
	<?php
	}elseif($navSettings['navbar_alignment'] =='right'){
	?>
		#navbar .nav{ float:right;}

	<?php
	}

	//pulls navbar up
	if($navSettings['kjd_navbar_pull_up'] == 'true'){ ?>
		#navbar{
			margin-top:<?php echo $navSettings['kjd_navbar_margin_top']; ?>px;
		}
		#logoWrapper,
		#logoWrapper a{
			float:left;
		}

		@media (max-width: 979px) {
			#navbar{
				position:relative;
				bottom:0;
				z-index:999;
			}
		}
	<?php
	}

	// Removes box shadow
	if($navbarBackgroundColors['gradient'] == 'none' || (!isset($navbarBackgroundColors['color']) || $navbarBackgroundColors['color'] == '' || empty($navbarBackgroundColors['color'])) ){ ?>
		.navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner,.navbar-inner {   
			box-shadow: none !important;		
		}
    <?php
	}

// navbar normal
if($navSettings['link_shadows'] =='true'){
	 ?>
.navbar .nav > .active > a, 
.navbar .nav > .active > a:hover,
.navbar .nav > .active > a:focus{box-shadow:none !important;}
	 <?php
	//echo "box-shadow:none !important;"
}
//layouts
	//confines layout to like, 960 and has border radius
	if($navSettings['navbar_style'] =="contained"){ ?>
		.navbar-inner{padding:0;}
		.navbar-inner .nav li:first-child a{border-radius:4px 0 0 4px;}
	<?php
	}
	//stickys to top of page
	if($navSettings['navbar_style'] =="sticky-top"){ ?>
		#header{padding-top:60px;}
	<?php
	}	
// colors
?>

.navbar .nav > li > a{
		color:<?php echo isset($navbarLink['color']) && $navbarLink['color'] != (' ') && $navbarLink['color'] != ('')? $navbarLink['color'] : 'black' ;?> !important;
		background-color:<?php $navbarLink['bg_color'];?>;
	}


.navbar .nav > li.active > a{
	background-color:<?php echo $navbarLinkActive['bg_color'];?>;
	color:<?php echo $navbarLinkActive['color'];?> !important;
	text-decoration:<?php echo $navbarLinkActive['decoration'];?> !important;
}
/* normal caret */
.navbar .nav > li > a.dropdown-toggle > .caret{
	border-top-color:<?php echo $navbarLink['color'];?> !important;
}
/* active caret*/
.navbar .nav > li.active > a.dropdown-toggle > .caret{
	border-top-color:<?php echo $navbarLinkActive['color'];?> !important;
}

/* top level nav when hovered */
 .navbar .nav > li > a:hover,.navbar .nav > li > a:focus{
	
	background-color:<?php echo $navbarLinkHovered['bg_color'];?> !important;
	color:<?php echo $navbarLinkHovered['color'];?> !important;
	text-decoration:<?php echo $navbarLinkHovered['decoration'];?> !important;
}
/*  caret  when hovered*/
.navbar .nav > li > a:hover.dropdown-toggle > .caret{
	border-top-color:<?php echo $navbarLinkHovered['color'];?> !important;
}	

/* cartent when navbar is on bottom */
.navbar-fixed-bottom .nav > li > a.dropdown-toggle > .caret{
		border-top-color:transparent !important;
	border-bottom-color:<?php echo $navbarLink['color'];?> !important;
}
.navbar-fixed-bottom .nav > li > a:hover.dropdown-toggle > .caret{
	border-top-color:transparent !important;
	border-bottom-color:<?php echo $navbarLinkHovered['color'];?> !important;
}
.navbar-fixed-bottom .nav > li.active > a.dropdown-toggle > .caret{
		border-top-color:transparent !important;
		border-bottom-color:<?php echo $navbarLinkActive['color'];?> !important;
}

/* top level nav when opened */
.navbar .nav > li.open > a{
	
	background-color:<?php echo $navbarLinkHovered['bg_color'];?> !important;
	color:<?php echo $navbarLinkHovered['color'];?> !important;
}


/*  caret  when opened*/
.navbar .nav > li.open > a.dropdown-toggle > .caret{
	border-top-color:<?php echo $navbarLinkHovered['color'];?> !important;
}
/*.navbar .nav li.open > a:after{
	border-color:<?php echo $navbarLinkHovered['color'];?> !important;
}*/

/* first level dropdown stuff: */
/* the triangle at the top of the dropdown */
.dropdown-menu:after {  
	border-bottom-color: <?php echo $dropdownMenuBackgroundColors['color'] ;?> !important;
}

.navbar .nav > li > .dropdown-menu:before{  
 	border-bottom: 7px solid <?php echo $dropdownMenuTopBorder['color'];?> !important;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    content: "";
    display: inline-block;
    left: 9px;
    position: absolute;
    top: -7px;
}

.navbar-fixed-bottom.navbar .nav > li > .dropdown-menu:before{
	border-top: 7px solid <?php echo $dropdownMenuBottomBorder['color'];?> !important;
	border-bottom: none !important;
	border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    content: "";
    display: inline-block;
    left: 9px;
    position: absolute;
    bottom: -7px;
    top:auto;
}
.navbar-fixed-bottom .nav > li > .dropdown-menu:after{
border-top-color: <?php echo $dropdownMenuBackgroundColors['color'] ;?> !important;
}
.navbar-fixed-bottom.navbar .nav .sub-menu{margin-bottom:-32px;}
/* first level dropdown link: */
.dropdown-menu li > a{
	background-color:transparent !important;
	color:<?php echo $dropdownMenuLink['color'];?> !important;
	text-decoration: <?php echo $dropdownMenuLink['decoration'];?> !important;
}
.dropdown-menu li > a:after {
    border-left-color: <?php echo $dropdownMenuLink['color'];?> !important;
}

/* first level dropdown link when active: */
.dropdown-menu li.active > a{
	background:<?php echo $dropdownMenuLinkActive['bg_color'];?> !important; 
	color:<?php echo $dropdownMenuLinkActive['color'];?> !important;
	text-decoration: <?php echo $dropdownMenuLinkActive['decoration'];?> !important;
}
.dropdown-menu li.active > a:after{
	border-left-color: <?php echo $dropdownMenuLinkActive['color'];?> !important;
}

/* first level dropdown link when hovered: */
.dropdown-menu li > a:hover{
	background:<?php echo $dropdownMenuLinkHovered['bg_color'];?> !important; 
	color:<?php echo $dropdownMenuLinkHovered['color'];?> !important;
	text-decoration: <?php echo $dropdownMenuLinkHovered['decoration'];?> !important;
}
.dropdown-menu li > a:hover:after{
	border-left-color: <?php echo $dropdownMenuLinkHovered['color'];?> !important;	
}

/* collapsable navbar */




.dropdown-menu.sub-menu li.active >a,
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li.active > ul > li > ul >li >a,
.current_page_item > a,.current-menu-item > a ,.current-page-ancestor > a,{
	background-color:none!important;
	color:<?php echo isset($navbarLinkHovered['color']) && $navbarLinkHovered['color'] != (' ') && $navbarLinkHovered['color'] != ('')? $navbarLinkHovered['color'] : 'black' ;?> !important;	
}

.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > a:hover,
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul, 
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > a:hover,
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > a:hover:after,
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > ul,
.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > ul > li > ul >li >a:hover{

	background-color:none!important;
	color:<?php echo isset($navbarLinkHovered['color']) && $navbarLinkHovered['color'] != (' ') && $navbarLinkHovered['color'] != ('')? $navbarLinkHovered['color'] : 'black' ;?> !important;	
}

.nav-collapse.navbar-responsive-collapse.in.collapse > ul > li > a > .caret{
}
.nav-collapse.navbar-responsive-collapse.in.collapse > .dropdown-menu li.active > a {

}

/* misc shit*/
.btn-navbar{ 
	background:<?php echo $navSettings['menu_btn_bg']?>;
	
}

.btn-navbar:hover,.btn-navbar:active{ 
	background:<?php echo $navSettings['menu_btn_bg_hovered']?>;
	
}
.nav .divider-vertical{
	border-left: 1px solid <?php echo $navbarBackground['endcolor'];?>;
	border-right: 1px solid <?php echo $navbarBackground['color'];?>;
}

<?php

	// Link styles
	if($navSettings['navbar_link_style'] == 'none'){ ?>
		.navbar .nav li.open a,.navbar .nav li.active a,.navbar .nav li a:hover{background:none !important;}
	<?php
	}elseif($navSettings['navbar_link_style'] == 'highlighted'){ ?>
	<?php
	}elseif($navSettings['navbar_link_style'] == 'pills'){

	}elseif($navSettings['navbar_link_style'] == 'tabs-below'){ ?>
		.nav-tabs, .nav{border-bottom:0 !important; margin-bottom:-2px;}
		.nav-tabs li a,
		 .navbar .nav li a{border-color:<?php echo $navbarLink['border_color'];?>; border-top:0 !important; border-radius: 0 0 4px 4px !important; height:17px;}
		.nav-tabs li a:hover, 
		.navbar .nav li a:hover, 
		.active a{border-color:<?php echo $navbarLinkHovered['border_color'];?> !important; }
		.current_page_item a{border-color:<?php echo $navbarLinkActive['border_color'];?> !important;}

	<?php
	}elseif($navSettings['navbar_link_style'] == 'tabs'){ ?>
		.nav-tabs, .nav{border-bottom:0 !important; margin-bottom:-2px;}
		.nav-tabs li a, .navbar .nav li a{border-color:<?php echo $navbarLink['border_color'];?>; border-bottom:0 !important; height:17px;}
		.nav-tabs li a:hover, .navbar .nav li a:hover, .active a{border-color:<?php echo $navbarLinkHovered['border_color'];?> !important; }
		.current_page_item a{border-color:<?php echo $navbarLinkActive['border_color'];?> !important;}
	<?php
	}


//////// END NAV BAR SETTINGS

//////// BEGIN SECTION SETTINGS
foreach ($sections as $section){
		
			$options = get_option('kjd_'.$section.'_background_settings');
			$sectionBackgroundColorSettings = $options['kjd_'.$section.'_background_colors'];
			$sectionBackgroundWallpaperSettings = $options['kjd_'.$section.'_background_wallpaper'];
			
			if($section !='login' && $section !='bodyTag' && $section !='htmlTag'  && $section !='mastArea'  && $section !='contentArea'){
				$options = get_option('kjd_'.$section.'_borders_settings');
				$sectionTopBorder = $options['kjd_'.$section.'_top_border'];
				$sectionRightBorder = $options['kjd_'.$section.'_right_border'];
				$sectionBottomBorder = $options['kjd_'.$section.'_bottom_border'];
				$sectionLeftBorder = $options['kjd_'.$section.'_left_border'];
				$sectionBorderRadius = $options['kjd_'.$section.'_border_radius'];

				if(($confineBackgrounds=='true' && $responsive != 'true') || $section =='dropdown-menu'){
				$borders = array('top' =>$sectionTopBorder,'right' =>$sectionRightBorder,'bottom' =>$sectionBottomBorder,'left' =>$sectionLeftBorder);
				}else{
					$borders = array('top' =>$sectionTopBorder,'bottom' =>$sectionBottomBorder);
				}

//				$borders = array('top' =>$sectionTopBorder,'right' =>$sectionRightBorder,'bottom' =>$sectionBottomBorder,'left' =>$sectionLeftBorder);
			}

			if($section !='bodyTag' && $section !='htmlTag' && $section!='mastArea' && $section!='contentArea' && $section !='cycler'){
				if($section !='dropdown-menu'){
					$options = get_option('kjd_'.$section.'_text_settings');
					$sectionText = $options['kjd_'.$section.'_text'];
					$sectionH1 = $options['kjd_'.$section.'_H1'];
					$sectionH2 = $options['kjd_'.$section.'_H2'];
					$sectionH3 = $options['kjd_'.$section.'_H3'];
					$sectionH4 = $options['kjd_'.$section.'_H4'];
					$hTags = array('h1' => $sectionH1,'h2' => $sectionH2,'h3' => $sectionH3,'h4' => $sectionH4);
				}
				$options = get_option('kjd_'.$section.'_links_settings');
				$sectionLink = $options['kjd_'.$section.'_link'];

				$sectionLinkHovered = $options['kjd_'.$section.'_linkHovered'];
				$sectionLinkVisited = $options['kjd_'.$section.'_linkVisited'];
				$sectionLinkActive = $options['kjd_'.$section.'_linkActive'];

				$linkSettings = array('link' => $sectionLink,'hover' => $sectionLinkHovered,'visited' => $sectionLinkVisited,'active' => $sectionLinkActive);

				$options = get_option('kjd_'.$section.'_forms_settings');
				$sectionForms = $options['kjd_'.$section.'_forms'];
			}

			/* misc settings */
			$options = get_option('kjd_'.$section.'_misc_settings');
			$options = $options['kjd_'.$section.'_misc'];
			
			$confineSectionBackground = $options['kjd_'.$section.'_confine_background'];
			$sectionShadow = $options['kjd_'.$section.'_section_shadow'];

			if($section =="header"){
				$forceHeight = $options['force_height'];
				$useMast = $options['kjd_header_misc']['use_mastArea'];				
			}
			if($section =="cycler"){
				$options = get_option('kjd_cycler_misc_settings');
				$options = $options['kjd_cycler_misc']; 
				if($options['shadow'] == "false"){ ?>
					#imageSlider{background:none !important; padding:20px 0 !important;}
				<?php
				}
				if($options['plugin'] == "single image"){
				?>
					.singleImage{
						border:<?php echo $options['borderSize'].' '.$options['borderColor']; ?> solid; 
					
					-webkit-border-radius: <?php echo $options['borderRadius'];?>;
					-moz-border-radius: <?php echo $options['borderRadius'];?>;
					border-radius: <?php echo $options['borderRadius'];?>;
					}
			<?php
					if($options['borderTransparency'] == 'true'){ ?>
						.singleImage{
							-moz-background-clip: border;     /* Firefox 3.6 */
							-webkit-background-clip: border;  /* Safari 4? Chrome 6? */
							background-clip: border-box;
						}
					<?php
					}
					if($options['singleCaption'] == "top"){?>
						.singleImage .caption{left:50%; width:100%;}
					<?php
					}elseif($options['singleCaption'] == "right"){?>
						.singleImage .caption{ width:25%;}
					<?php
					}elseif($options['singleCaption'] == "bottom"){ ?>
						.singleImage .caption{left:50%; width:100%;}
					<?php
					}elseif($options['singleCaption'] == "left"){ ?>
						.singleImage .caption{ width:25%;}
					<?php
					}else{ ?>
						.singleImage .caption{display:none !important;}
					<?php
					}
				}elseif($options['plugin'] == "nivo"){
					
					if($options['nivoCaption'] == "top"){?>
						.nivo-caption{top:0; bottom:auto !important;}
					<?php
					}elseif($options['nivoCaption'] == "right"){?>
						.nivo-caption{height:100% !important; left:auto !important; right:0  !important; width:25%  !important;}
					<?php
					}elseif($options['nivoCaption'] == "bottom"){ ?>
						
					<?php
					}elseif($options['nivoCaption'] == "left"){ ?>
						.nivo-caption{height:100% !important; width:25% !important;}
					<?php
					}else{ ?>
						.nivo-caption{display:none !important;}
					<?php
					}

				}
			}
//////////////////////////
// Start Styling sections
//////////////////////////
	if($section =='dropdown-menu'){ ?>
		.dropdown-menu
	<?php
	}elseif($section =='cycler'){ ?>
		#<?php echo 'imageSliderWrapper'; ?>
	<?php
	}elseif($section == 'navbar'){ ?>
		#<?php echo $section.' .navbar-inner' ;?>
	<?php
	}elseif($section =='htmlTag'){
		echo "html";
	}elseif($section =='bodyTag'){
		echo "body";
	}else{ ?>
		#<?php echo $section ;?>
	<?php	
	}
	?>
		{
			<?php

			if($sectionBackgroundColorSettings['gradient'] =='vertical'){
				verticalGradientCallback($sectionBackgroundColorSettings['color'], $sectionBackgroundColorSettings['endcolor']);
			}elseif($sectionBackgroundColorSettings['gradient'] =='horizontal'){ 
				horizontalGradientCallback($sectionBackgroundColorSettings['color'], $sectionBackgroundColorSettings['endcolor']);
			}elseif($sectionBackgroundColorSettings['gradient'] =='radial'){ 
				radialGradientCallback($sectionBackgroundColorSettings['color'], $sectionBackgroundColorSettings['endcolor']);
			}elseif($sectionBackgroundColorSettings['gradient'] =='solid'){ ?>
				background-color: <?php echo $sectionBackgroundColorSettings['color'];?> !important;
			<?php 
			}elseif($sectionBackgroundColorSettings['gradient'] =='none'){ ?>
				background-color:transparent !important;
			<?php
			}
			
			if($sectionBackgroundWallpaperSettings['use_wallpaper']=='true'){

				wallpaperCallback($sectionBackgroundWallpaperSettings['image'], $sectionBackgroundWallpaperSettings['position'], $sectionBackgroundWallpaperSettings['repeat']);			
			}

		if($section !='login' && $section !='bodyTag' && $section !='htmlTag'  && $section !='mastArea'  && $section !='contentArea'){

			foreach ($borders as $border => $value){ 
				borderSettingsCallback($border, $value['color'], $value['size'], $value['style']);
			}
		}
			
			if($confineSectionBackground=='true' && $confineBackgrounds == 'false'){ ?>
					padding:0 20px !important;
			<?php
			}
			?>
			<?php echo "color:".$sectionText['color'].";"; ?>
			<?php if($options['float'] == 'true'){
				echo "margin-top:10px;";
				echo "margin-bottom:10px;";
			}
			
			if($forceHeight =="true" && $navSettings['navbar_style'] != 'sticky-bottom'){

			echo "height:".$options['header_height']."px;";
			}

			if($section =='mastArea'){
				$miscOptions = get_option('kjd_mastArea_background_settings');
				$miscSettings = $miscOptions['kjd_mastArea_background_misc'];
				
				if($miscSettings['use_top_padding'] =="true"){ ?>
					padding-top:<?php echo $miscSettings['top_padding']; ?>px;
				<?php
				}
				if($miscSettings['use_bottom_padding'] =="true"){ ?>
					padding-bottom:<?php echo $miscSettings['bottom_padding']; ?>px;
				<?php	
				}
			}
			?>
		}
<?php
////////////////////////
// end section styling
////////////////////////

	/// links and h-tags
	if($section !='bodyTag' && $section !='htmlTag' && $section != 'mastArea' && $section !='cycler' && $section !="navbar" && $section !='dropdown-menu' && $section !='contentArea'){
			
			foreach($linkSettings as $link => $value){ ?>
				#<?php echo $section; ?> a<?php echo $link!="link" ? ":$link" : "" ;?>{
					<?php 
						linkSettingsCallback($value['color'], $value['decoration'],$value['text_shadow'], $value['bg_style'], 
							$value['bg_color'],$value['border_color']); 
					?>
				}
			<?php
			}
			foreach($hTags as $hTag => $value){ ?>
				#<?php echo $section; ?> <?php echo $hTag; ?>{
					<?php 
					
	hTagSettingsCallback($value['color'], $value['decoration'],$value['textShadowColor'], $value['bg_style'], 
							$value['bg_color'], $value['border_style'],$value['border_color']);
					?>
				}
			<?php
			}
	}
//////////////////////////////
// images
if($section !='bodyTag' && $section !='htmlTag' && $section != 'mastArea' && $section !='cycler' && $section !="navbar" && $section !='dropdown-menu' && $section !='contentArea'){

$imageBorderColor = $sectionForms['kjd_image_border']['color'];
$imageBorderSize = $sectionForms['kjd_image_border']['size'];
$imageBorderStyle = $sectionForms['kjd_image_border']['style']; ?>
	
	#<?php echo $section; ?> img,#<?php echo $section; ?> iframe{
		border:<?php echo $imageBorderColor.' '.$imageBorderSize.' '.$imageBorderStyle ;?>;
	}
<?php
}

/////////////////////////////
////////////////////////////
// section forms, tabbed content, and acordians
	if($section !='bodyTag' && $section !='htmlTag' && $section != 'mastArea' && $section !='cycler' && $section !='dropdown-menu' && $section !='contentArea' && $section !='pageTitle'){ 
		
// container_bg','container_border','container_font','active_bg','active_link_color','inactive_bg', 'inactive_link_color','hover_bg','hover_link_color'
		//tabbed content
		?>

		#<?php echo $section; ?> .tabbable > ul.nav{
			border: 0px !important; margin:0;
		}

		#<?php echo $section; ?> .tabbable > ul.nav > li > a{ 
			background:<?php echo $sectionForms['inactive_tab_background'];?>; 
			border-color:<?php echo $sectionForms['tabbed_content_border'];?> !important; 
			color:<?php echo $sectionForms['inactive_tab_link_color'];?> !important;
		}
		#<?php echo $section; ?> .tabbable > ul.nav > li > a:hover{
			background:<?php echo $sectionForms['hovered_tab_background'];?>;
			color:<?php echo $sectionForms['hovered_tab_link_color'];?> !important;
		}
		#<?php echo $section; ?> .tabbable > ul.nav > li.active > a{
			background:<?php echo $sectionForms['tabbed_content_background'];?>;
			color:<?php echo $sectionForms['tabbed_content_text_color'];?> !important;
		}

		#<?php echo $section; ?> .tabbable > .tab-content{
			background:<?php echo $sectionForms['tabbed_content_background'];?>; 
			border-color:<?php echo $sectionForms['tabbed_content_border'];?> !important; 
			color:<?php echo $sectionForms['tabbed_content_text_color'];?> !important;
			border-style: solid; border-width: 1px; padding:20px;
		}
		#<?php echo $section; ?> .tabbable > .tab-content > a{
			color:<?php echo $sectionForms['tabbed_content_link_color'];?> !important;
		}

		/* tab directions */
		#<?php echo $section; ?> .tabs-left > ul > li > a{
			border-right-color:<?php echo $sectionForms['tabbed_content_border'];?> !important;
		}
		#<?php echo $section; ?> .tabs-left > ul > li.active > a{
			border-right-color:<?php echo $sectionForms['tabbed_content_background'];?> !important;
		}
		#<?php echo $section; ?> .tabs-left .tab-content{
			-webkit-border-radius: 4px;
			-webkit-border-top-left-radius: 0;
			-moz-border-radius: 4px;
			-moz-border-radius-topleft: 0;
			border-radius: 4px;
			border-top-left-radius: 0;
		}
		#<?php echo $section; ?> .tabs-right > ul > li > a{
			border-left-color:<?php echo $sectionForms['tabbed_content_border']; ?> !important; 
	}
	#<?php echo $section; ?> .tabs-right > ul > li.active > a{
			border-left-color:<?php echo $sectionForms['tabbed_content_background']; ?> !important; 
	}
		#<?php echo $section; ?> .tabs-right .tab-content{
			-webkit-border-radius: 4px;
			-webkit-border-top-right-radius: 0;
			-moz-border-radius: 4px;
			-moz-border-radius-topright: 0;
			border-radius: 4px;
			border-top-right-radius: 0;
		}
		#<?php echo $section; ?> .tabbable.tabs > ul > li a{
			border-bottom-color:<?php echo $sectionForms['tabbed_content_border'];?> !important;
		}
		#<?php echo $section; ?> .tabbable.tabs > ul > li.active a{
			border-bottom-color:<?php echo $sectionForms['tabbed_content_background'];?> !important;
		}
		#<?php echo $section; ?> .tabbable.tabs .tab-content{
			-webkit-border-radius: 4px;
			-webkit-border-top-left-radius: 0;
			-moz-border-radius: 4px;
			-moz-border-radius-topleft: 0;
			border-radius: 4px;
			border-top-left-radius: 0;
		}

		#<?php echo $section; ?> .tabs-below > ul > li > a{
			border-top-color:<?php echo $sectionForms['tabbed_content_border'];?> !important; 
			}
#<?php echo $section; ?> .tabs-below > ul > li.active > a{
			border-top-color:<?php echo $sectionForms['tabbed_content_background'];?> !important; 
			}
		#<?php echo $section; ?> .tabs-below .tab-content{
			-webkit-border-radius: 4px;
			-webkit-border-bottom-left-radius: 0;
			-moz-border-radius: 4px;
			-moz-border-radius-bottomleft: 0;
			border-radius: 4px;
			border-bottom-left-radius: 0;
		}

		/* accordion 

collapible_content_background','collapible_content_border','collapible_content_text_color','active_title_background','active_title_link_color','inactive_title_background', 'inactive_title_link_color','hovered_title_background','hovered_title_link_color

		*/
		#<?php echo $section; ?> .accordion-group{
			background:<?php echo $sectionForms['collapible_content_background'];?>; 
			border-color:<?php echo $sectionForms['collapible_content_border'];?> !important;
		}
		/*the title*/
		#<?php echo $section; ?> .accordion-heading > a.collapsed{
			background:<?php echo $sectionForms['inactive_title_background'];?>; 
			color:<?php echo $sectionForms['inactive_title_link_color'];?>;
		}
		#<?php echo $section; ?> .accordion-heading a{
			background:<?php echo $sectionForms['active_title_background'];?>; 
			color:<?php echo $sectionForms['active_title_link_color'];?>;
		}

		/* when closed*/
		#<?php echo $section; ?> .accordion-heading > .collapsed{
			background:<?php echo $sectionForms['inactive_title_background'];?> !important;
			color:<?php echo $sectionForms['inactive_title_link_color'];?> !important;
		}

		#<?php echo $section; ?> .accordion-heading a:hover{
			background:<?php echo $sectionForms['hovered_title_background'];?> !important;
			color:<?php echo $sectionForms['hovered_title_link_color'];?> !important;
			
		}
		/*the content */
		#<?php echo $section; ?> .accordion-inner {
			border-top-color:<?php echo $sectionForms['collapible_content_border'];?> !important;
		}

		#<?php echo $section; ?> .accordion-heading > a.collapsed, 
		#<?php echo $section; ?> .accordion-heading >a,
		#<?php echo $section; ?> .accordion-heading >a:hover{ text-decoration:none !important;}
		/* thumbnail settings 
thumbnail_background','thumbnail_border','thumbnail_glow','thumbnail_text
		*/

/* pagination */
<?php
if($section=='header' || $section=='body' || $section=='footer'){
?>

#<?php echo $section; ?> img{ 
	/*color:<?php echo $sectionForms['thumbnail_text']; ?>;*/
	background:<?php echo $sectionForms['kjd_image_background_color']; ?> ;  
	border:<?php echo $sectionForms['kjd_image_border']['size'].' '.$sectionForms['kjd_image_border']['style'].' '.$sectionForms['kjd_image_border']['color']; ?>;
	padding:<?php echo $sectionForms['kjd_image_padding']; ?>;
	border-radius:<?php echo $sectionForms['kjd_image_radius']; ?>;
}

#<?php echo $section; ?> .thumbnail img{ 
	/*color:<?php echo $sectionForms['thumbnail_text']; ?>;*/
	background:none !important;
	border:none !important;
	padding:0 !important;
	border-radius:0 !important;
}
#<?php echo $section; ?> .thumbnail
{
	background:<?php echo $sectionForms['thumbnail_background']; ?>;
	border-color:<?php echo $sectionForms['thumbnail_border']; ?>;
}
#<?php echo $section; ?> .thumbnail:hover{
	border-color:<?php echo $sectionForms['thumbnail_glow']; ?>;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 2px <?php echo $sectionForms['thumbnail_glow']; ?>;
}

		/* tables settings
'table_header_background','table_border','table_header_text_color','even_row_background','even_row_link_color','even_row_text_color','odd_row_background', 'odd_row_link_color','odd_row_text_color','hovered_row_background','hovered_row_link_color')
		*/
		#<?php echo $section; ?> .table,
		#<?php echo $section; ?> .table td,
		#<?php echo $section; ?> .table th{
			border-color:<?php echo $sectionForms['table_border'];?> !important;
		}

		#<?php echo $section; ?> .table thead{
			color:<?php echo $sectionForms['table_header_text_color']; ?>;
			background:<?php echo $sectionForms['table_header_background']; ?>;
			border-color:<?php echo $sectionForms['table_border'];?> !important;
		}
		#<?php echo $section; ?> .table-hover tbody tr td:hover{
			background:<?php echo $sectionForms['hovered_row_background'];?> !important;
			color:<?php echo $sectionForms['hovered_row_text_color']; ?>;
		}
		#<?php echo $section; ?> .table-striped tbody tr:nth-child(even) td,
		#<?php echo $section; ?> .table-striped tbody tr:nth-child(even) th{
			background:<?php echo $sectionForms['even_row_background'];?> !important;
			color:<?php echo $sectionForms['even_row_text_color']; ?>;
		}
		#<?php echo $section; ?> .table-striped tbody tr:nth-child(odd) td,
		#<?php echo $section; ?> .table-striped tbody tr:nth-child(odd) th{
			background:<?php echo $sectionForms['odd_row_background'];?> !important;
			color:<?php echo $sectionForms['odd_row_text_color']; ?>;
		}

<?php
}
?>
<?php if($section=='body'){
	?>

.pagination ul
{
	
}
.pagination ul li > *
{
	background:<?php echo $sectionForms['pagination_background']; ?> ;
	border-color:<?php echo $sectionForms['pagination_border']; ?> ;
}
.pagination li:hover span,
.pagination li:hover a
{
	background:<?php echo $sectionForms['pagination_hover']; ?> ;
}
.pagination li a.page-numbers
{
	color:<?php echo $sectionForms['pagination_link']; ?> ;
}
.pagination li span.page-numbers
{
	color:<?php echo $sectionForms['pagination_text']; ?> ;	
}

<?php
} ?>


/* forms 
'form_background','form_border','field_background','field_border','field_glow','field_text', 'button_background','button_background_end','button_border','button_text'
*/
		#<?php echo $section; ?> form{
			background:<?php echo $sectionForms['form_background']; ?> ; 
			border-color:<?php echo $sectionForms['form_border']; ?>;
			color:<?php echo $sectionForms['container_text']; ?>;

			<?php if( (isset($sectionForms['form_background']) && $sectionForms['form_background']!= '' && $sectionForms['form_background']!= ' ' ) || (isset($sectionForms['container_border']) && $sectionForms['container_border']!= '' && $sectionForms['container_border']!= ' ') ){
					echo "padding:10px; border-radius:4px;";
				}?>
		}

		#<?php echo $section; ?> form button,#<?php echo $section; ?> form input[type=submit],#<?php echo $section; ?> form .btn{
			<?php verticalGradientCallback($sectionForms['button_background'], $sectionForms['button_background_end']); ?>
			background-image:none;
			border-color:<?php echo $sectionForms['button_border']; ?> !important;
			color:<?php echo $sectionForms['button_text']; ?> !important;
		}

		#<?php echo $section; ?> form button:hover,#<?php echo $section; ?> form input[type=submit]:hover,#<?php echo $section; ?> form .btn:hover{
			background-color:<?php echo $sectionForms['button_background_end']; ?> !important;
.		}

#<?php echo $section; ?> input[type="radio"], #<?php echo $section; ?> input[type="checkbox"],#<?php echo $section; ?> textarea,#<?php echo $section; ?>  input[type="text"],#<?php echo $section; ?>  input[type="password"],#<?php echo $section; ?>  input[type="datetime"],#<?php echo $section; ?>  input[type="datetime-local"],#<?php echo $section; ?>  input[type="date"],#<?php echo $section; ?>  input[type="month"],#<?php echo $section; ?>  input[type="time"],#<?php echo $section; ?>  input[type="week"],#<?php echo $section; ?>  input[type="number"],#<?php echo $section; ?>  input[type="email"],#<?php echo $section; ?>  input[type="url"],#<?php echo $section; ?>  input[type="search"],#<?php echo $section; ?>  input[type="tel"],#<?php echo $section; ?>  input[type="color"],#<?php echo $section; ?>  .uneditable-input{
	color:<?php echo $sectionForms['field_text']; ?>;
	background:<?php echo $sectionForms['field_background']; ?> ;  
	border-color:<?php echo $sectionForms['field_border']; ?>;
}

#<?php echo $section; ?> input[type="radio"]:focus, #<?php echo $section; ?> input[type="checkbox"]:focus, #<?php echo $section; ?> textarea:focus,#<?php echo $section; ?>  input[type="text"]:focus,#<?php echo $section; ?>  input[type="password"]:focus,#<?php echo $section; ?>  input[type="datetime"]:focus,#<?php echo $section; ?>  input[type="datetime-local"]:focus,#<?php echo $section; ?>  input[type="date"]:focus,#<?php echo $section; ?>  input[type="month"]:focus,#<?php echo $section; ?>  input[type="time"]:focus,#<?php echo $section; ?>  input[type="week"]:focus,#<?php echo $section; ?>  input[type="number"]:focus,#<?php echo $section; ?>  input[type="email"]:focus,#<?php echo $section; ?>  input[type="url"]:focus,#<?php echo $section; ?>  input[type="search"]:focus,#<?php echo $section; ?>  input[type="tel"]:focus,#<?php echo $section; ?>  input[type="color"]:focus,#<?php echo $section; ?>  .uneditable-input:focus {
    border-color: :<?php echo $sectionForms['field_border']; ?>;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px <?php echo $sectionForms['field_glow']; ?>;
   }
<?php
	}

} //end foreach

?>

</style>
<?php
} // end function



////////////////////////////
// functions
////////////////////////////

////////////////////////
// vertical gradient
function verticalGradientCallback($startColor, $endColor){ ?>
<?php if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor == "#ffffff";
		}
?>
				background-color: <?php echo $startColor;?>;
				background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $startColor;?>), to(<?php echo $endColor;?>));
				background-image: -webkit-linear-gradient(top, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -moz-linear-gradient(top, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -ms-linear-gradient(top, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -o-linear-gradient(top, <?php echo $startColor;?>, <?php echo $endColor;?>);
				filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='<?php echo $startColor;?>', endColorstr='<?php echo $endColor;?>'); /* IE6 & IE7 */

		    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='<?php echo $startColor;?>', endColorstr='<?php echo $endColor;?>')"; /* IE8 */
<?php	}?>
<?php
}// end vertical 

////////////////////////
// horizontal gradient
function horizontalGradientCallback($startColor, $endColor){ ?>
<?php if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor == "#ffffff";
		}
		?>
				background-color: <?php echo $startColor;?>;
		  background-image: -webkit-gradient(linear, left top, right top, from(<?php echo $startColor;?>), color-stop(0.5,  <?php echo $endColor;?>), to( <?php echo $startColor;?>));
				background-image: -webkit-linear-gradient(left, <?php echo $startColor;?>, <?php echo $endColor;?>,<?php echo $startColor;?>);
				background-image: -moz-linear-gradient(left, <?php echo $startColor;?>, <?php echo $endColor;?>,<?php echo $startColor;?>);
				background-image: -ms-linear-gradient(left, <?php echo $startColor;?>, <?php echo $endColor;?>,<?php echo $startColor;?>);
				background-image: -o-linear-gradient(left, <?php echo $startColor;?>, <?php echo $endColor;?>,<?php echo $startColor;?>);
				filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr='<?php echo $startColor;?>', endColorstr='<?php echo $endColor;?>'); /* IE6 & IE7 */
		    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr='<?php echo $startColor;?>', endColorstr='<?php echo $endColor;?>')"; /* IE8 */
<?php	}?>

<?php
}

////////////////////////
// radial Gradient
function radialGradientCallback($startColor, $endColor){ ?>

<?php if(isset($startColor) && $startColor !=""){ 
		if(!isset($endcolor) || $endcolor == ""){
			$endcolor == "#ffffff";
		}
	?>
				background-color: <?php echo $startColor;?>;
				background-image: -webkit-gradient(radial, center center, 0, center center, 460, from(<?php echo $startColor;?>), to(<?php echo $endColor;?>));
				background-image: -webkit-radial-gradient(circle, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -moz-radial-gradient(circle, <?php echo $startColor;?>, <?php echo $endColor;?>);
				background-image: -ms-radial-gradient(circle, <?php echo $startColor;?>, <?php echo $endColor;?>);
<?php	}?>

<?php
}

////////////////////////
// use wallpaper
function wallpaperCallback($backgroundImage, $backgroundPosition, $backgroundRepeat){

	if(isset($backgroundImage) && $backgroundImage!=""){ ?>
		background-image:url(<?php echo $backgroundImage ;?>);<?php	
	}
	if(isset($backgroundAttachment) && $backgroundAttachment!=""){ ?>
		background-attachment:<?php echo $backgroundAttachment ;?> !important;<?php	
	}else{
		echo 'background-attachment:scroll !important;';
	}

	if(isset($backgroundPosition) && $backgroundPosition!=""){ ?>
		background-position:<?php echo $backgroundPosition;?>; <?php	
	}
	if(isset($backgroundRepeat) && $backgroundRepeat!=""){ ?>
		background-repeat:<?php echo $backgroundRepeat;?>; <?php	
	}
}

//////////////////////
// borders
//////////////////////

//////////////////////
// borders
//////////////////////
function borderSettingsCallback($border, $borderColor, $borderSize, $borderStyle){
	if(isset($borderStyle) && $borderStyle!="none"){
		if((isset($borderColor) && $borderColor!=" " && !empty($borderColor)) && 
		   (isset($borderSize) && $borderSize!=" " && !empty($borderSize))) { ?>
		border-<?php echo $border?>:<?php echo $borderColor.' '.$borderSize.' '.$borderStyle; ?>; 
	<?php
		}
	}
}

function borderRadiusCallback($borderCorner, $radiusSize){
	//$boder == borderCorner
	if(isset($radiusSize) && $radiusSize!=""){ 
		?>

		-webkit-border-<?php echo $borderCorner; ?>-radius: <?php echo $radiusSize;?>;
		-webkit-border-<?php echo $borderCorner; ?>-radius: <?php echo $radiusSize;?>;
		-webkit-border-<?php echo $borderCorner; ?>-radius: <?php echo $radiusSize;?>;
		-webkit-border-<?php echo $borderCorner; ?>-radius: <?php echo $radiusSize;?>;

		border-<?php echo $borderCorner; ?>-radius: <?php echo $radiusSize;?>;
		border-<?php echo $borderCorner; ?>-radius: <?php echo $radiusSize;?>;
		border-<?php echo $borderCorner; ?>-radius: <?php echo $radiusSize;?>;
		border-<?php echo $borderCorner; ?>-radius: <?php echo $radiusSize;?>;
		<?php $borderCorner = str_replace('-', '', $borderCorner);?>

		-moz-border-radius-<?php echo $borderCorner; ?>: <?php echo $radiusSize;?>;
		-moz-border-radius-<?php echo $borderCorner; ?>: <?php echo $radiusSize;?>;
		-moz-border-radius-<?php echo $borderCorner; ?>: <?php echo $radiusSize;?>;
		-moz-border-radius-<?php echo $borderCorner; ?>: <?php echo $radiusSize;?>;
<?php
	}
}

////////////////////////////
//  text and link styles
////////////////////////////
// hTagSettingsCallback($value['color'], $value['decoration'],$value['text_shadow'],  $value['bg_style], $value['bg_color']);

function hTagSettingsCallback($color, $decoration, $textShadow, $bgStyle, $bgColor, $borderStyle, $borderColor){
	 if($bgStyle == 'pills' || $bgStyle == "squared"){ ?>
		background:<?php echo $bgColor;?>;
		word-break:hyphenate;
		<?php
	}elseif($bgStyle =='tabs'){ ?>
   		border-radius: 4px 4px 0 0;
    	line-height: 20px;
	<?php
	}

	if(isset($borderStyle)){
		if(isset($borderColor) && $borderColor !='' && $borderColor != ' '){ ?>
			border:1px <?php echo $borderStyle; ?> <?php echo $borderColor; ?>;
		<?php
		}
	}

	if(isset($color) && $color!=""){ ?>
		color:<?php echo $color;?>;
<?php	}
	if(isset($decoration) && $decoration!=""){ ?>
			text-decoration:<?php echo $decoration;?>;
<?php	}
	if($decoration=="text-shadow"){ ?>
		text-shadow:2px 2px <?php echo $textShadow; ?> !important;
	<?php
	}
}

function linkSettingsCallback($color, $decoration,$textShadow, $bgStyle, $bgColor, $bgBorder){
	 if($bg_style == 'pills'){ ?>
		background:<?php echo $bg_color;?>;
		padding:4px;
		word-break:hyphenate;
		<?php
	}elseif($bg_style == "highlighted"){ ?>

	<?php
	}
	if(isset($color) && $color!=""){ ?>
		color:<?php echo $color;?>;
<?php	}
	if(isset($decoration) && $decoration!=""){ ?>
			text-decoration:<?php echo $decoration;?>;
<?php	}
}



load_custom_style();			
?>