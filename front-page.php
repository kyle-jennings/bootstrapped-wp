<?php

get_header();

	
	$layoutSettings = kjd_get_layout_settings();
	
	$frontPageOptions = get_option('kjd_frontPage_layout_settings');
	$frontPageSidebar = $frontPageOptions['kjd_frontPage_sidebar'];
	$device_view = $layoutSettings['deviceView'];

	$components = $frontPageOptions['kjd_frontPage_layout'];
	$secondayContent = $frontPageOptions['kjd_frontPage_secondaryContent'];
	$arrayLength = count($components)-1;
	
	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];	
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

	$showImageSlider = get_option('kjd_cycler_misc_settings');
	$showImageSlider = $showImageSlider['kjd_cycler_misc']['enable'];

	$pagination_top = get_option('kjd_posts_misc_settings');
	$pagination_top = $pagination_top['pagination_top'];


if($showImageSlider =='true')
{
	kjd_image_slider_callback($confineBodyBackground,$position,$arrayLength,$layoutSettings);
}

if(!empty($components))
{ 
?>

<div id="body" class="frontPageBody <?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
	<div class="container">
	<div class="row">
<?php 
	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){ 

		if($layoutSettings['position'] == 'top'){
			echo kjd_get_sidebar($template,'horizontal',$position, $device_view);
		}
		
		echo '<div class="span12">';
	}else{
		if($layoutSettings['position'] == 'left'){
			echo kjd_get_sidebar($template,null,$position, $device_view);
		}

		echo '<div class="span9">';
	}

	kjd_front_page_layout($components, $layoutSettings, $frontPageOptions);


	if($layoutSettings['position'] == 'right' || $layoutSettings['position'] =='left')
	{
		echo '</div>'; // end left content
		if($layoutSettings['position'] == 'right'){
			echo kjd_get_sidebar($template,null,$position, $device_view);
		}
	}else{
		echo '</div>';

		if($layoutSettings['position'] == 'bottom'){
			echo kjd_get_sidebar($template,'horizontal',$position, $device_view);
		}
		
	}

	//end row, container, and body divs	
	echo '</div></div></div>';

}else{ 
/* ---------------------------- if the front page settings arent configured ---------------------------- */
?>
<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
	<div class="container">

		<div class="jumbotron">
		  <h1>Please set up your front page!</h1>
		  <p>And this ugly message goes away</p>
		  <p>
		    <a href="wp-admin/admin.php?page=kjd_page_layout_settings&tab=frontPage"class="btn btn-primary btn-large">
		      Go to your dashboard
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
function kjd_image_slider_callback($confineBodyBackground,$position,$arrayLength,$layoutSettings){
		include(dirname(__FILE__).'/lib/partials/image_slider_wrapper.php');
}

function kjd_widget_area_1_callback($layoutSettings, $deviceView){
	echo '<div class="row '.$deviceView.' frontpage-component">'; 
		dynamic_sidebar('front_page_widget_area_1');
	echo '</div>'; 
}

function kjd_widget_area_2_callback($layoutSettings, $deviceView){
	echo '<div class="row '.$deviceView.' frontpage-component">'; 
		dynamic_sidebar('front_page_widget_area_2');
	echo '</div>';
}


function kjd_content_callback($layoutSettings, $deviceView){
	echo '<div class="'.$deviceView.' frontpage-component">';
	
	if (have_posts()){

		if($pagination_top == 'true'){
			echo kjd_get_posts_pagination();
		}
		
		echo '<div class="content-list">';
		
		while(have_posts()){ 
			
			the_post(); 
			echo kjd_the_content_wrapper();
		}

		echo '</div>';
	}
	echo kjd_get_posts_pagination();

	echo '</div>';
}

function kjd_secondary_content_callback($frontPageOptions,$layoutSettings, $deviceView){ 
	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){ 
		echo '<div class="row '.$deviceView.' frontpage-component"><div class="span12">'; 
			echo do_shortcode($frontPageOptions['kjd_frontPage_secondaryContent']);
		echo '</div></div>'; 
	}else{
		echo '<div class="row '.$deviceView.' frontpage-component"><div class="span9">'; 
			echo do_shortcode($frontPageOptions['kjd_frontPage_secondaryContent']);
		echo '</div></div>'; 
	}

}

function kjd_front_page_layout($components, $layoutSetting, $frontPageOptions)
{

	foreach($components as $position => $component)
	{
		$deviceView = $component['componentDeviceView'];
		if($component['component'] =='widget_area_1'){
			 kjd_widget_area_1_callback($layoutSettings, $deviceView); 
		}elseif($component['component'] =='widget_area_2'){
			 kjd_widget_area_2_callback($layoutSettings, $deviceView);
		}elseif($component['component'] =='content'){
			kjd_content_callback($layoutSettings, $deviceView);
		}elseif($component['component'] =='secondary_content'){
			kjd_secondary_content_callback($frontPageOptions,$layoutSettings, $deviceView);
		}
	}
}