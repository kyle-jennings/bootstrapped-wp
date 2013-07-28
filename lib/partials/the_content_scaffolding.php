<?php
$scaffolding_markup = '';


$confineClass = ($confineBodyBackground =='true' )? 'container confined' : '' ;

if($layoutSettings['position'] =='left' || $layoutSettings['position'] =='right' ){
	$widthClass = 'span9';
}else{
	$widthClass = 'span12';
}

	$scaffolding_markup .= kjd_get_the_title();

//start scaffolding
$scaffolding_markup .= '<div id="body" class="'.$confineClass.'">';
	$scaffolding_markup .= '<div class="container">';
		$scaffolding_markup .= '<div class="row">';

/* ----------------- top or left sidebar ------------------- */
 if($layoutSettings['position'] =='top' || $layoutSettings['position'] =='left'){ 
	$scaffolding_markup .= ($layoutSettings['position'] =='top') ? kjd_get_sidebar($sidebar,'horizontal',$layoutSettings['position']) : kjd_get_sidebar($sidebar);
} 

//content div
$scaffolding_markup .= '<div id="mainContent" class="'.$widthClass.'">';

/* ---------------------- The Loop ----------------------- */
if (have_posts()){

	if($pagination_top == 'true'){
		$scaffolding_markup .= posts_pagination();
	}

	//open content-list/single wrapper
	if( !is_single() && !is_page() && !is_attachment() ){
		$scaffolding_markup .= '<div class="content-list">';
	}else{
		$scaffolding_markup .= '<div class="content-single">';
	}
	 while (have_posts()){ 

		the_post(); 
		$scaffolding_markup .= kjd_the_content();

	}

 	//close content-list/single wrapper
	$scaffolding_markup .= '</div>';

	// pagination
	$scaffolding_markup .= posts_pagination();

}else{
		$scaffolding_markup .= '<div class="content-wrapper">';
				$scaffolding_markup .= kjd_the_404();
		$scaffolding_markup .= '</div>';	
}
/* ---------------------- End Loop ----------------------- */

//end main content
$scaffolding_markup .= '</div>'; // end maincontent span

/* ----------------- right or bottom sidebar ------------------- */
	if($layoutSettings['position'] =='bottom' || $layoutSettings['position'] =='right'){ 
		$scaffolding_markup .= ($layoutSettings['position'] =='bottom') ? kjd_get_sidebar($sidebar,'horizontal',$layoutSettings['position']) : kjd_get_sidebar($sidebar);
	} 


// close scaffolding

		$scaffolding_markup .= '</div>';//	<!-- end row -->
	$scaffolding_markup .= '</div>';// <!-- end container -->
$scaffolding_markup .= '</div>'; //<!-- end body -->

echo $scaffolding_markup;