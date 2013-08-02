<?php


    

function kjd_settings_display($section) {  
	

	$options = get_option('kjd_posts_misc_settings');
	$options = $options['kjd_posts_misc'];
	
	$tabs = array(0 =>'background',1=>'borders',2=>'text',3=>'links',4=>'components',5=>'misc');
	if($section == "cycler"){
		array_pop($tabs);
		array_push($tabs, 'cycler Settings', 'cycler Images');
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

	if($options['style_posts'] !='true' && $section == 'posts'){
		unset($tabs[0]);
		unset($tabs[1]);
		unset($tabs[2]);
		unset($tabs[3]);
		unset($tabs[4]);
	}
	//include 'lib/kjd_field_settings.php';
	screen_icon('themes'); 
?> 

<h2><?php echo ucfirst($section); ?> Area Settings</h2>

<?php
	if( isset( $_GET[ 'tab' ] ) ) {  
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'background'; 
	}else{
	 $active_tab = 'background'; 
	}
?> 

<h2 class="nav-tab-wrapper">  

	<?php foreach($tabs as $tab){ ?>
		<a href="?page=kjd_<?php echo $section;?>_settings&tab=<?php echo $tab; ?>" class="nav-tab"<?php echo $active_tab == $tab ? 'id="active"' : 'none'; ?>><?php echo ucfirst($tab)?></a>  
	<?php }
 ?>

</h2>

    <?php settings_errors(); ?>  
	<form method="post" action="options.php"> 
		<div class="fields-wrapper">
	<?php 
	if( $active_tab == 'background' ) { 
		section_background_callback($section);
	}elseif($active_tab == 'borders' && ($section !='login' && $section !='bodyTag' && $section !='htmlTag')){
		section_borders_callback($section);
	}elseif($active_tab == 'text' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler' && $section!='dropdown-menu')){
		section_text_callback($section);
	}elseif($active_tab == 'links' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler')){
		section_link_callback($section);
	}elseif($active_tab == 'components' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){
		section_components_callback($section);
	}elseif($active_tab == 'misc' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){
		section_misc_callback($section);
	}elseif($active_tab == 'cycler Settings'){ // image cycler settings
		image_cycler_display_callback();
		cycler_settings_callback();
	}elseif($active_tab == 'cycler Images'){ // image cycler iamges
		image_cycler_display_callback();
		cycler_images_callback();
	}
	submit_button(); 
	?>  
		</div>
		<div class="preview-options">preview</div>
	</form>

<?php
}

////////////////////////////////////
// background color and wallpaper
////////////////////////////////////
function section_background_callback($section){
	include	'background_settings_form.php';
}

////////////////////////////////////
// borders
////////////////////////////////////

function section_borders_callback($section){
	include('borders_settings_form.php');	
}

////////////////////////////////////
// text styles
////////////////////////////////////
function section_text_callback($section){

	include('text_settings_form.php');
}

////////////////////////////////////
// links  styles
////////////////////////////////////
function section_link_callback($section){
	include('link_settings_form.php');
}

////////////////////////////////////
// components, buttons, and wells
////////////////////////////////////
function section_components_callback($section){
	include('components_settings_form.php');
}

//// image cycler
function image_cycler_display_callback(){
	include('image_cycler_form.php');
}

// misc sections
function section_misc_callback($section){ 
	include('misc_settings_form.php');
}
?>