<?php

get_header();



	$front_page = new kjdLayout();
	$layoutSettings = $front_page->kjd_get_layout_settings();

	$template = $layoutSettings['name'];

	$frontPageOptions = get_option('kjd_frontPage_layout_settings');

	$frontPageSidebar = $frontPageOptions['kjd_frontPage_sidebar'];
	$content_title = $frontPageOptions['kjd_frontPage_content_title'];
	$secondary_title = $frontPageOptions['kjd_frontPage_secondary_content_title'];

	$device_view = $layoutSettings['deviceView'];

	$components = $frontPageOptions['kjd_frontPage_layout'];
	$secondayContent = $frontPageOptions['kjd_frontPage_secondaryContent'];
	$arrayLength = count($components)-1;

	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

	$showImageSlider = get_option('kjd_cycler_misc_settings');
	$showImageSlider = $showImageSlider['kjd_cycler_misc'];

	$pagination_top = get_option('kjd_posts_misc_settings');
	$pagination_top = $pagination_top['pagination_top'];


	$output = '';

	if( $showImageSlider['enable'] =='true' && $showImageSlider['location'] != 'sortable')
	{
		kjd_image_slider_callback( $confineBodyBackground, $position, $arrayLength, $layoutSettings, 'default' );
	}

if(!empty($components)) {
?>

<div id="body" class="frontPageBody <?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
	<div class="container">
	<div class="row">
<?php
	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){

		if($layoutSettings['position'] == 'top'){
			echo $front_page->kjd_get_sidebar($template,'horizontal',$position, $device_view);
		}

		echo '<div id="main-content" class="span12">';
	}else{
		if($layoutSettings['position'] == 'left'){
			echo $front_page->kjd_get_sidebar($template, null, $position, $device_view);
		}

		echo '<div id="main-content" class="span9">';
	}


	kjd_front_page_layout( $components,
							$layoutSettings,
							$frontPageOptions,
							$confineBodyBackground,
							$arrayLength,
							$showImageSlider,
							$content_title,
							$secondary_title,
							$front_page
						);


	if($layoutSettings['position'] == 'right' )//|| $layoutSettings['position'] =='left'
	{
		echo '</div>'; // end left content

		if($layoutSettings['position'] == 'right'){
			echo $front_page->kjd_get_sidebar($template, null, $position, $device_view);
		}
	}else{
		echo '</div>';

		if($layoutSettings['position'] == 'bottom'){
			echo $front_page->kjd_get_sidebar($template,'horizontal',$position, $device_view);
		}

	}

	//end row, container, and body divs
	echo '</div></div></div>';

	// echo $output;
}else{
/* ---------------------------- if the front page settings arent configured ---------------------------- */
?>
<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
	<div class="container">

		<div class="jumbotron">
		  <h1>Please set up your front page!</h1>
		  <p>And this ugly message goes away</p>
		  <p>
		    <a href="wp-admin/admin.php?page=kjd_page_layout_settings&tab=frontPage"class="btn btn-warning btn-large">
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
/* ------------------------------- Front Page Components ----------------------------------------- */
/* ---------------------------------------------------------------------------------------------- */

/* --------------------------------------------------------------------
			Image Banner
 -------------------------------------------------------------------- */
function kjd_image_slider_callback( $confineBodyBackground, $position, $arrayLength, $layoutSettings, $location = 'defualt',$deviceView = null ){
		include(dirname(__FILE__).'/lib/partials/image_slider_wrapper.php');
}

/* --------------------------------------------------------------------
			Widget Areas
 -------------------------------------------------------------------- */
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

function kjd_widget_area_3_callback($layoutSettings, $deviceView){
	echo '<div class="row '.$deviceView.' frontpage-component">';
		dynamic_sidebar('front_page_widget_area_3');
	echo '</div>';
}

/* --------------------------------------------------------------------
			Default Content
 -------------------------------------------------------------------- */
function kjd_content_callback( $layoutSettings, $deviceView, $content_title = '', $front_page){
	echo '<div class="'.$deviceView.' frontpage-component">';

	if (have_posts()){

		if($pagination_top == 'true'){
			echo $front_page->kjd_get_posts_pagination();
		}

		echo '<h2>'.$content_title.'</h2>';
		echo '<div class="content-list">';

		while(have_posts()){

			the_post();
			echo $front_page->kjd_the_content_wrapper();
		}

		echo '</div>';
	}
	echo $front_page->kjd_get_posts_pagination();

	echo '</div>';
}

/* --------------------------------------------------------------------
			Secondary Content
 -------------------------------------------------------------------- */
function kjd_secondary_content_callback($frontPageOptions,$layoutSettings, $deviceView, $secondary_title){
	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){
		echo '<div class="row '.$deviceView.' frontpage-component"><div class="span12">';
			echo '<h2>'. $secondary_title .'</h2>';
			echo do_shortcode($frontPageOptions['kjd_frontPage_secondaryContent']);
		echo '</div></div>';
	}else{
		echo '<div class="row '.$deviceView.' frontpage-component"><div class="span9">';
			echo '<h2>'. $secondary_title .'</h2>';
			echo do_shortcode($frontPageOptions['kjd_frontPage_secondaryContent']);
		echo '</div></div>';
	}

}

/* -----------------------------------------------------------------
		Choose layout
------------------------------------------------------------------- */
function kjd_front_page_layout( $components,
								$layoutSettings,
								$frontPageOptions,
								$confineBodyBackground,
								$arrayLength,
								$showImageSlider,
								$content_title,
								$secondary_title,
								$front_page
								){
	foreach($components as $position => $component)
	{
		$deviceView = $component['componentDeviceView'];

		switch( $component['component'] ):
			case 'widget_area_1':
				kjd_widget_area_1_callback($layoutSettings, $deviceView);
				break;
			case 'widget_area_2':
				kjd_widget_area_2_callback($layoutSettings, $deviceView);
				break;
			case 'widget_area_3':
				kjd_widget_area_3_callback($layoutSettings, $deviceView);
				break;
			case 'content':
				kjd_content_callback($layoutSettings, $deviceView, $content_title, $front_page);
				break;
			case 'secondary_content':
				kjd_secondary_content_callback($frontPageOptions, $layoutSettings, $deviceView, $secondary_title);
				break;
			case 'image_banner':
				if( $showImageSlider['enable'] =='true' && $showImageSlider['location'] == 'sortable' ){
					kjd_image_slider_callback( $confineBodyBackground, $position, $arrayLength, $layoutSettings, 'sortable', $deviceView );
				}
				break;
		endswitch;

	}

}
