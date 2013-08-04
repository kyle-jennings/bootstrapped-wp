<?php

// Page Template One Widgets
if ( function_exists('register_sidebar') ){
///////////////////////
// page widgets
///////////////////////


$options = get_option('kjd_post_layout_settings');
$postLayouts = $options['kjd_post_layouts'];

$options = get_option('kjd_page_layout_settings');
$pageLayouts = $options['kjd_page_layouts'];


if(!empty($pageLayouts) && empty($postLayouts)){ 
	$layouts = $pageLayouts;
}elseif(!empty($postLayouts) && empty($pageLayouts)){
	$layouts = $postLayouts;
}elseif(!empty($postLayouts) && !empty($pageLayouts)){
	$layouts = array_merge($pageLayouts,$postLayouts);
}else{
	$layouts = array();
}


function set_width($template,$frontpage_area = null)
{
	// print_r($template); die();

	if($template['name']== 'kjd_front_page_widgets'){
		$i = 1;
		$template = $layouts[$frontpage_area];
		$sidebars = wp_get_sidebars_widgets($frontpage_area);
		$widgetsCount = count($sidebars[$frontpage_area]);

		if($template['position'] !='none')
		{
			switch($widgetsCount){
				case 1:
					return 'span9';
					break;
				case 2:
					return 'span4';
					break;
				case 3:
					return 'span3';
					break;
				case 4:
					return 'span2';
					break;
				case 5:
					return 'span1';
					break;
				case 6:
					return 'span1';
					break;
			}
		}
}else
	{
		$sidebars = wp_get_sidebars_widgets($template['name']);
		$widgetsCount = count($sidebars[$template['name']]);
		 if($template['position'] !='left' && $template['position'] !='right')
		 {
			switch($widgetsCount){
				case 1:
					return 'span12';
					break;
				case 2:
					return 'span6';
					break;
				case 3:
					return 'span4';
					break;
				case 4:
					return 'span3';
					break;
				case 5:
					return 'span2';
					break;
				case 6:
					return 'span2';
					break;
			}
		}
	}

}



				
//////////////////////////////////////////
// header, footer, front page areas, index
//////////////////////////////////////////

$templates = array('header_widgets', 'front_page_widget_area_1', 'front_page_widget_area_2', 'footer_widgets', 'default');
foreach($templates as $template){
	
	if($template == 'front_page_widget_area_1' || $template == 'front_page_widget_area_2' ){
		$width = set_width($layouts['kjd_front_page_widgets'],$template );
	}elseif($template == 'header_widgets' || $template == 'footer_widgets' ){
		$temp = array('name' => $template, 'position' =>"top");
		$width = set_width($temp);
	}else{
		$width = set_width($layouts[$template]);
	}

	
	register_sidebar(
		 array(
			'name' => ucwords(str_replace('_',' ',$template)),
			'id' => $template,
			'description' => 'Widgets for the ' .ucwords(str_replace('_',' ',$template)),
			'before_widget' =>'<div class="widget '.$width.'">',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'after_widget' => '</div>'
		)
	);

}




///////////////////////
// posts widgets
///////////////////////

	$options = get_option('kjd_widget_areas_settings');
	// $widget_areas = array('single',category','archive','tag','author','date','search','attachment');
	
	if( !empty($options['widget_areas']) ){
		foreach($options['widget_areas'] as $k => $v){
			// echo $k;
			$width = set_width($layouts[$k]);
			register_sidebar(
				 array(
				'name' => ucwords(str_replace('_page', '',$k)) . ' Page',
				'id' => $k,
				'description' => 'Widgets for the ' .ucwords(str_replace('_page', '',$k)) . ' page',
				'before_widget' =>'<div class="widget '.$width.'">',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
				'after_widget' => '</div>'
			)
			);

		}
		
	}

//////////////////////////////
//	 Page templates
//////////////////////////////

	$templates = array('template_1', 'template_2', 'template_3', 'template_4', 'template_5', 'template_6' );
	foreach($templates as $template){
		
		$width = set_width($layouts[$template]);
		register_sidebar(
			 array(
				'name' => 'Page ' . ucwords(str_replace('kjd','', str_replace('_',' ',$template))),
				'id' => $template,
				'description' => 'Widgets for the ' .ucwords(str_replace('kjd','', str_replace('_',' ',$template))) . ' page',
				'before_widget' =>'<div class="widget '.$width.'">',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
				'after_widget' => '</div>'
			)
		);

	}

}
