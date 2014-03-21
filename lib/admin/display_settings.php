<?php
    

function kjd_settings_display($section) {  
	

	$options = get_option('kjd_posts_misc_settings');
	$options = $options['kjd_posts_misc'];
	
	$tabs = array(0 =>'background',1=>'borders',2=>'headings',3=>'Text',4=>'presentation', 5=>'images',6=>'misc');
	if($section == "cycler"){
		array_pop($tabs);
		array_push($tabs, 'image_banner_settings', 'image_banner_images');
	}
	if($section =='bodyTag' || $section =='htmlTag' || $section =='cycler'){
		unset($tabs[2]);
		unset($tabs[3]);
		unset($tabs[4]);
	}
	if($section =='dropdown-menu'){
		unset($tabs[2]);
		
		unset($tabs[4]);
		unset($tabs[5]);
	}
	if($section =="navbar"){
		unset($tabs[2]);
		// unset($tabs[4]);
	}
	if($section =='login'){
		unset($tabs[1]);
	}
	if($section =="pageTitle"){
		unset($tabs[4]);
	}
	if($section == "mobileNav"){

		unset($tabs[2]);
	
		//	mobile nav settings
		$mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
		$mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];
		$override_nav = $mobileNavSettings['override_nav'];
		if( $override_nav == 'true') {

			$mobilenav_style = $mobileNavSettings['mobilenav_style'];
			if( $mobilenav_style == 'sidr'){

				array_push($tabs, 'sidr');
			}
		}

	}

	

	screen_icon('themes'); 


?> 

	<h2><?php echo $section != 'cycler' ? ucfirst($section) : "Image Banner" ; ?> Area Settings 
	
	<?php #echo kjd_nav_select(); ?>

	</h2>
<?php

	if( isset( $_GET[ 'tab' ] ) ) {  
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'background'; 
	}else{
	 $active_tab = 'background'; 
	}
?> 

<h2 class="nav-tab-wrapper">  

	<?php foreach($tabs as $tab){ ?>
		<a href="?page=kjd_<?php echo $section;?>_settings&tab=<?php echo $tab; ?>" class="nav-tab"<?php echo $active_tab == $tab ? 'id="active"' : 'none'; ?>><?php echo ucwords( str_replace('_',' ',$tab) )?></a>  
	<?php }

	kjd_build_theme_css();
	$fields_wrapper_class = ( $active_tab != 'image_banner_images' && $active_tab != 'image_banner_settings') ? 'fields-wrapper ' : 'banner-fields-wrapper' ;
 ?>

</h2>

    <?php settings_errors(); ?>  
	<form method="post" action="options.php"> 

		<div class="<?php echo $fields_wrapper_class; ?>" >
		<?php 

		if( $active_tab == 'background' ) { 
		
			wp_enqueue_media();
			kjd_section_background_callback($section);
		
		}elseif($active_tab == 'borders' && ($section !='login' && $section !='bodyTag' && $section !='htmlTag')){
		
			kjd_section_borders_callback($section);
		
		}elseif($active_tab == 'headings' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler' && $section!='dropdown-menu')){
		
			kjd_section_headings_callback($section);
		
		}elseif($active_tab == 'Text' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler')){
		
			kjd_section_text_callback($section);
		
		}elseif($active_tab == 'presentation' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){
		
			kjd_section_presentation_callback($section);
		
		}elseif($active_tab == 'images' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){
		
			kjd_section_images_callback($section);
		
		}elseif($active_tab == 'misc' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){
		
			wp_enqueue_media();
			kjd_section_misc_callback($section);
		
		}elseif($active_tab == 'image_banner_settings'){ // image cycler settings
		
			kjd_image_cycler_display_callback();
			kjd_cycler_settings_callback();
		
		}elseif($active_tab == 'image_banner_images'){ // image cycler iamges
			wp_enqueue_media();		
			kjd_image_cycler_display_callback();
			kjd_cycler_images_callback();

		}elseif($active_tab == 'sidr'){ // image cycler iamges
			wp_enqueue_media();
			kjd_section_background_callback('sidrDrawer');
		}
		
		submit_button(); 
		?>  

		</div>

		<?php if( $active_tab != 'image_banner_images' && $active_tab != 'image_banner_settings'){ ?>

		<div class="preview-options">
			<?php echo kjd_site_preview();?>
		</div>
		
		
		<?php } ?>

	</form>

<?php
}

////////////////////////////////////
// background color and wallpaper
////////////////////////////////////
function kjd_section_background_callback($section){
	include('forms/background_settings_form.php');
}

////////////////////////////////////
// borders
////////////////////////////////////

function kjd_section_borders_callback($section){
	include('forms/borders.php');	
}

////////////////////////////////////
// headings styles
////////////////////////////////////
function kjd_section_headings_callback($section){

	include('forms/headings.php');
}

////////////////////////////////////
// Text  styles
////////////////////////////////////
function kjd_section_text_callback($section){
	include('forms/text.php');
}

////////////////////////////////////
// presentation, buttons, and wells
////////////////////////////////////
function kjd_section_presentation_callback($section){
	include('forms/presentation_settings_form.php');
}

////////////////////////////////////
// Images
////////////////////////////////////
function kjd_section_images_callback($section){

	include('forms/images_settings_form.php');
}

//// image cycler
function kjd_image_cycler_display_callback(){
	include('forms/image_banner.php');
}

// misc sections
function kjd_section_misc_callback($section){ 
	include('forms/misc_settings_form.php');
}
