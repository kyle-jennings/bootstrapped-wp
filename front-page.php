<?php

get_header();

	$layoutOptions = get_option('kjd_page_layout_settings');
	$layoutSettings = $layoutOptions['kjd_page_layouts']['kjd_front_page_widgets'];

	$frontPageOptions = get_option('kjd_frontPage_layout_settings');
	$frontPageSidebar = $frontPageOptions['kjd_frontPage_sidebar'];

	$components = $frontPageOptions['kjd_frontPage_layout'];
	$secondayContent = $frontPageOptions['kjd_frontPage_secondaryContent'];
	$arrayLength = count($components) -1;
	
	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];	
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

	$showImageSlider = get_option('kjd_cycler_misc_settings');
	$showImageSlider = $showImageSlider['kjd_cycler_misc']['enable'];



if($showImageSlider =='true')
{
	image_slider_callback($confineBodyBackground,$position,$arrayLength,$layoutSettings);
}

if(!empty($components))
{ 
	// $class = ($confineBodyBackground =='true') ? 'container confined' : '' ;
	// $frontpage_markup ='';
	// $frontpage_markup .='<div id="body" class="frontPageBody '.$class.'">';
	// $frontpage_markup .='';
	// $frontpage_markup .='';
?>

<div id="body" class="frontPageBody <?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
	<div class="container">
	<div class="row">
<?php 
	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){ 
		echo '<div class="span12">';
	}else{
		if($layoutSettings['position'] == 'left'){
			echo kjd_get_sidebar('front_page_sidebar');
		}

		echo '<div class="span9">';
	}

	front_page_layout($components,$layoutSettings);

	if($layoutSettings['position'] == 'right' || $layoutSettings['position'] =='left')
	{
		echo '</div>'; // end left content
		if($layoutSettings['position'] == 'right'){
			echo kjd_get_sidebar('front_page_sidebar');
		}
	}else{
		echo '</div>';
	}

	//end row, container, and body divs	
	echo '</div></div></div>';

}else{ 
/* ---------------------------- if the front page settings arent configured ---------------------------- */
?>
<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
	<div class="container">
		<br /><br /><br /><br />
		<div class="hero-unit">
		  <h1>Please set up your theme</h1>
		  <p>so this ugly message goes away</p>
		  <p>
		    <a href="wp-admin/admin.php?page=kjd_page_layout_settings&tab=frontPage"class="btn btn-primary btn-large">
		      go to your dashboard
		    </a>
		  </p>
		</div>
	</div>
</div>			
<?php
}


get_footer(); // End page, start function




/* ---------------------------------------------------------------------------------------------- */
/* ------------------------------- Front Page Functions ----------------------------------------- */
/* ---------------------------------------------------------------------------------------------- */
function image_slider_callback($confineBodyBackground,$position,$arrayLength,$layoutSettings){
		include(dirname(__FILE__).'/lib/partials/image_slider_wrapper.php');
}

function widget_area_1_callback($layoutSettings){
	echo '<div class="row">'; 
		dynamic_sidebar('front_page_widget_area_1');
	echo '</div>'; 
}

function widget_area_2_callback($layoutSettings){
	echo '<div class="row">'; 
		dynamic_sidebar('front_page_widget_area_2');
	echo '</div>';
}


function content_callback($layoutSettings){
	if (have_posts()){

		if($pagination_top == 'true'){
			echo posts_pagination();
		}
		
		echo '<div class="content-list">';
		
		while(have_posts()){ 
			
			the_post(); 
			echo kjd_the_content();
		}

		echo '</div>';
	}
	echo posts_pagination();
}

function secondary_content_callback($frontPageOptions,$layoutSettings){ 
	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){ 
		echo '<div class="row"><div class="span12">'; 
			echo do_shortcode($frontPageOptions['kjd_frontPage_secondaryContent']);
		echo '</div></div>'; 
	}else{
		echo '<div class="row"><div class="span9">'; 
			echo do_shortcode($frontPageOptions['kjd_frontPage_secondaryContent']);
		echo '</div></div>'; 
	}

}

function front_page_layout($components,$layoutSettings)
{
	foreach($components as $position => $component)
	{
		if($component['component'] =='widget_area_1'){
			 widget_area_1_callback($layoutSettings); 
		}elseif($component['component'] =='widget_area_2'){
			 widget_area_2_callback($layoutSettings);
		}elseif($component['component'] =='content'){
			content_callback($layoutSettings);
		}elseif($component['component'] =='secondary_content'){
			secondary_content_callback($frontPageOptions,$layoutSettings);
		}
	}
}