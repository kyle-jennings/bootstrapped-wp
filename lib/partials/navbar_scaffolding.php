<?php 

$navbarSettings = get_option('kjd_navbar_misc_settings');
$navSettings = $navbarSettings['kjd_navbar_misc'];
$sideNav = $navSettings['side_nav'];


	if(empty($navbarSettings) || !has_nav_menu( 'primary-menu' )){ 
	?>
		<div class="container">


	<?php
	
	if(empty($navbarSettings)){ 
	?>
		<a href="wp-admin/admin.php?page=kjd_navbar_settings&tab=misc" class="btn btn-primary btn-large">
			Dont forget to configure your navbar settings
	    </a>
	<?php
	}
	if( !has_nav_menu( 'primary-menu' ) ){
?>
		<a href="wp-admin/nav-menus.php"class="btn btn-primary btn-large">
			Dont forget to set a menu.
	    </a>
<?php
	}
	echo '</div>';
}else{

	
	
$navbarSettings = $navbarSettings['kjd_navbar_misc'];
$navbarLinkStyle = $navbarSettings['navbar_link_style'];
$form = $navbarSetting['form_type'];

$confineNavbarBackground = $navbarSettings['kjd_navbar_confine_background'];

if($navbarLinkStyle == "dividers"){
	?>
	<script>
	jQuery(document).ready(function() {  
		jQuery('.nav > .menu-item').after('<li class="divider-vertical"></li>');
		
	});
	</script>
<?php
}

	if($navbarSettings['hideNav'] == "false"){

		if($navbarSettings['navbar_style'] == "full_width"){
			$navbar_open = '<div id="navbar" class="navbar navbar-static-top">';
		}elseif($navbarSettings['navbar_style'] =="contained"){
			$navbar_open = '<div id="navbar" class="navbarWrapper container"><div class="navbar">';
		}elseif($navbarSettings['navbar_style'] == "sticky-top"){
			$navbar_open = '<div id="navbar" class="navbar navbar-fixed-top">';
		}elseif($navbarSettings['navbar_style'] == "sticky-bottom"){
			$navbar_open = '<div id="navbar" class="navbar navbar-fixed-bottom">';
		}elseif($navbarSettings['navbar_style'] == "page-top"){
			$navbar_open = '<div id="navbar" class="navbar navbar-static-top">';
		}else{ 
			$navbar_open = '<div id="navbar" class="navbar navbar-static-top">';
		} 

		$navbar_inner = '';
			$navbar_inner .= '<div class="navbar-inner">';
			$navbar_inner .= '<div class="container">';
			if($sideNav == 'true'){
				$navbar_inner .= '<a id="sidr-toggle" class="btn btn-navbar">
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>';
			}else{
				$navbar_inner .= '<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>';
			}
				
					$navbar_inner .='<div class="nav-collapse collapse navbar-responsive-collapse">';
					ob_start();
					menuStyleCallback($navbarLinkStyle);
					$navbar_contents = ob_get_contents();
					ob_end_clean();
					$navbar_inner .= $navbar_contents;
					$navbar_inner .= '</div>';

				$navbar_inner .='</div>'; // end container -->
			$navbar_inner .='</div>'; // end navbar-inner-->

		 if($navbarSettings['navbar_style'] == "full_width"){
			$navbar_close = '</div>';
		}elseif($navbarSettings['navbar_style'] =="contained"){
			$navbar_close = '</div></div>';
		}elseif($navbarSettings['navbar_style'] == "sticky-top"){
			$navbar_close = '</div>';
		}elseif($navbarSettings['navbar_style'] == "sticky-bottom"){
			$navbar_close = '</div>';
		}else{
			$navbar_close = '</div>';
		} 
	}
echo $navbar_open; 
echo $navbar_inner;
echo $navbar_close; 
}
	


function menuStyleCallback($navbarLinkStyle){
	if($navbarLinkStyle == "none" ){
		wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' =>'nav nav-noBG','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "dividers" ){
		wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' =>'nav','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "highlighted" ){
		wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' =>'nav','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "pills"){
			wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' =>'nav nav-pills','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "tabs"){
			wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' =>'nav nav-tabs','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "tabs-below"){
			wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' =>'nav nav-tabs tabs-below','container'=> '','walker'=> new dropDown() ) );
	}else{

	}
}