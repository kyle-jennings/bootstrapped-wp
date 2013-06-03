<?php 

$navbarSettings = get_option('kjd_navbar_misc_settings');
$navSettings = $navbarSettings['kjd_navbar_misc'];
$sideNav = $navSettings['side_nav'];

if(empty($navbarSettings))
{ ?>
<div class="container">
	<a href="wp-admin/admin.php?page=kjd_navbar_settings&tab=misc"class="btn btn-primary btn-large">
		Dont forget to configure your navbar settings
    </a>

	<a href="nav-menus.php"class="btn btn-primary btn-large">
		Dont forget to set a menu.
    </a>
 </div>

<?php
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

	if($navbarSettings['navbar_style'] == "full_width"){ ?>
		<div id="navbar" class="navbar navbar-static-top">
		
	<?php
	}elseif($navbarSettings['navbar_style'] =="contained"){
	?>
	<div id="navbar" class="navbarWrapper container">
		<div class="navbar">
	<?php
	}elseif($navbarSettings['navbar_style'] == "sticky-top"){
	?>
		<div id="navbar" class="navbar navbar-fixed-top">
	<?php
	}elseif($navbarSettings['navbar_style'] == "sticky-bottom"){
	?>
		<div id="navbar" class="navbar navbar-fixed-bottom">
	<?php
	}elseif($navbarSettings['navbar_style'] == "page-top"){ ?>
		<div id="navbar" class="navbar navbar-static-top">
	<?php
	}else{ ?>
		<div id="navbar" class="navbar navbar-static-top">
	<?php	
	} ?>

		<div class="navbar-inner">
			<div class="container">
		<?php if($sideNav == 'true'){
			echo '<a id="sidr-toggle" class="btn btn-navbar">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>';
		}else{
			echo '<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>';
		}?>
			
				<div class="nav-collapse collapse navbar-responsive-collapse">
				<?php	menuStyleCallback($navbarLinkStyle);	?>
				</div>

			</div> <!-- end container -->
		</div> <!-- end navbar-inner-->

	<?php if($navbarSettings['navbar_style'] == "full_width"){ ?>
	</div>
	<?php
	}elseif($navbarSettings['navbar_style'] =="contained"){
	?>
		</div>
	</div>
	<?php
	}elseif($navbarSettings['navbar_style'] == "sticky-top"){
	?>
	</div>
	<?php
	}elseif($navbarSettings['navbar_style'] == "sticky-bottom"){
	?>
	</div>
	<?php
	}else{ ?>
		</div>
	<?php
	} ?>

<?php
}

}
	


function menuStyleCallback($navbarLinkStyle){
	if($navbarLinkStyle == "none" ){
		wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' =>'nav nav-noBG','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "dividers" ){
		wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' =>'nav','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "highlighted" ){
		wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' =>'nav','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "pills"){
			wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' =>'nav nav-pills','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "tabs"){
			wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' =>'nav nav-tabs','container'=> '','walker'=> new dropDown() ) );
	}elseif($navbarLinkStyle == "tabs-below"){
			wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' =>'nav nav-tabs tabs-below','container'=> '','walker'=> new dropDown() ) );
	}else{

	}
}
?>