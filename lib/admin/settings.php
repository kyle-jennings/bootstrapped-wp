<?php
    

function kjd_settings_display($section) {  
	

	$options = get_option('kjd_posts_misc_settings');
	$options = $options['kjd_posts_misc'];
	
	$tabs = array(0 =>'background',1=>'borders',2=>'text',3=>'links',4=>'components',5=>'misc');
	if($section == "cycler"){
		array_pop($tabs);
		array_push($tabs, 'cycler_settings', 'cycler_images');
	}
	if($section =='bodyTag' || $section =='htmlTag' || $section =='cycler'){
		unset($tabs[2]);
		unset($tabs[3]);
		unset($tabs[4]);
	}
	if($section =='dropdown-menu'){
		unset($tabs[2]);
		
		unset($tabs[4]);
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

	//include 'lib/kjd_field_settings.php';
	screen_icon('themes'); 


?> 

	<h2><?php echo ucfirst($section); ?> Area Settings 
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


	$fields_wrapper_class = ( $active_tab != 'cycler_images' && $active_tab != 'cycler_settings') ? 'fields-wrapper ' : '' ;
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
		
		}elseif($active_tab == 'text' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler' && $section!='dropdown-menu')){
		
			kjd_section_text_callback($section);
		
		}elseif($active_tab == 'links' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler')){
		
			kjd_section_link_callback($section);
		
		}elseif($active_tab == 'components' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){
		
			kjd_section_components_callback($section);
		
		}elseif($active_tab == 'misc' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){
		
			wp_enqueue_media();
			kjd_section_misc_callback($section);
		
		}elseif($active_tab == 'cycler_settings'){ // image cycler settings
		
			kjd_image_cycler_display_callback();
			kjd_cycler_settings_callback();
		
		}elseif($active_tab == 'cycler_images'){ // image cycler iamges
			wp_enqueue_media();		
			kjd_image_cycler_display_callback();
			kjd_cycler_images_callback();
		}
		
		submit_button(); 
		?>  

		</div>

		<?php if( $active_tab != 'cycler_images' && $active_tab != 'cycler_settings'){ ?>

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
	include	'background_settings_form.php';
}

////////////////////////////////////
// borders
////////////////////////////////////

function kjd_section_borders_callback($section){
	include('borders_settings_form.php');	
}

////////////////////////////////////
// text styles
////////////////////////////////////
function kjd_section_text_callback($section){

	include('text_settings_form.php');
}

////////////////////////////////////
// links  styles
////////////////////////////////////
function kjd_section_link_callback($section){
	include('link_settings_form.php');
}

////////////////////////////////////
// components, buttons, and wells
////////////////////////////////////
function kjd_section_components_callback($section){
	include('components_settings_form.php');
}

//// image cycler
function kjd_image_cycler_display_callback(){
	include('image_cycler_form.php');
}

// misc sections
function kjd_section_misc_callback($section){ 
	include('misc_settings_form.php');
}
?>