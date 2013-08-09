<?php

$template = $layoutSettings['name'];


$bodySettings = get_option('kjd_body_misc_settings');
$bodySettings = $bodySettings['kjd_body_misc'];	
$confineBodyBackground = $bodySettings['kjd_body_confine_background'];
$confineClass = ($confineBodyBackground =='true' )? 'container confined' : '' ;
$device_view = $layoutSettings['deviceView'];
$position = $layoutSettings['position'];

$pagination_top = get_option('kjd_posts_misc_settings');
$pagination_top = $pagination_top['pagination_top'];


$scaffolding_markup = '';



if($position =='left' || $position =='right' ){
	$widthClass = 'span9';
}else{
	$widthClass = 'span12';
}

// get the title	
$scaffolding_markup .= kjd_get_the_title();

//start scaffolding
$scaffolding_markup .= '<div id="body" class="'.$confineClass.'">';
	$scaffolding_markup .= '<div class="container">';
		$scaffolding_markup .= '<div class="row">';


			// print_r($layoutSettings); die();
			/* ----------------- top or left sidebar ------------------- */
			 if($position =='top' || $position =='left'){ 
	
				$scaffolding_markup .= ($position =='top') ? 
				 kjd_get_sidebar($template,'horizontal',$position, $device_view) :
				 kjd_get_sidebar($template,null,$position, $device_view);
			} 

			//content div
			$scaffolding_markup .= '<div id="mainContent" class="'.$widthClass.'">';

			/* ---------------------- The Loop ----------------------- */
			if (have_posts()){

				if($pagination_top == 'true'){
					$scaffolding_markup .= kjd_get_posts_pagination();
				}

				//open content-list/single wrapper
				if( !is_single() && !is_page() && !is_attachment() ){
					$scaffolding_markup .= '<div class="content-list">';
				}else{
					$scaffolding_markup .= '<div class="content-single">';
				}
				 while (have_posts()){ 

					the_post(); 
					$scaffolding_markup .= kjd_the_content_wrapper();

				}

			 	//close content-list/single wrapper
				$scaffolding_markup .= '</div>';

				// pagination
				$scaffolding_markup .= kjd_get_posts_pagination();

			}else{
					$scaffolding_markup .= '<div class="content-wrapper">';
							$scaffolding_markup .= kjd_the_404();
					$scaffolding_markup .= '</div>';	
			}
			/* ---------------------- End Loop ----------------------- */

			//end main content
			$scaffolding_markup .= '</div>'; // end maincontent span

/* ----------------- right or bottom sidebar ------------------- */
	if($position =='bottom' || $position =='right'){ 
		$scaffolding_markup .= ($position =='bottom') ? kjd_get_sidebar($template,'horizontal',$position, $device_view) : kjd_get_sidebar($template,null,$position, $device_view);
	} 


// close scaffolding

		$scaffolding_markup .= '</div>';//	<!-- end row -->
	$scaffolding_markup .= '</div>';// <!-- end container -->
$scaffolding_markup .= '</div>'; //<!-- end body -->

echo $scaffolding_markup;