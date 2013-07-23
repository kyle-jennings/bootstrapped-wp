<?php
/*
Template Name: widgets
*/
// function get_width($template,$frontpage_area = null)
// {
// 	if($template['name']== 'kjd_front_page_widgets'){
// 		$i = 1;
// 		$template = $layouts[$frontpage_area];
// 		$sidebars = wp_get_sidebars_widgets($frontpage_area);
// 		$widgetsCount = count($sidebars[$frontpage_area]);
// 		if($template['position'] !='none')
// 		{
// 			switch($widgetsCount){
// 				case 1:
// 					return 'span9';
// 					break;
// 				case 2:
// 					return 'span4';
// 					break;
// 				case 3:
// 					return 'span3';
// 					break;
// 				case 4:
// 					return 'span2';
// 					break;
// 				case 5:
// 					return 'span1';
// 					break;
// 				case 6:
// 					return 'span1';
// 					break;
// 			}
// 		}else{
// 			return '';
// 		}
// }else
// 	{
// 		$sidebars = wp_get_sidebars_widgets($template['name']);
// 		$widgetsCount = count($sidebars[$template['name']]);
// 		 if($template['position'] !='left' && $template['position'] !='right')
// 		 {
// 			switch($widgetsCount){
// 				case 1:
// 					return 'span12';
// 					break;
// 				case 2:
// 					return 'span6';
// 					break;
// 				case 3:
// 					return 'span4';
// 					break;
// 				case 4:
// 					return 'span3';
// 					break;
// 				case 5:
// 					return 'span2';
// 					break;
// 				case 6:
// 					return 'span2';
// 					break;
// 			}
// 		}else{
// 			return '';
// 		}
// 	}

// }

	$pageLayouts = array('kjd_template_1','kjd_template_2','kjd_template_3','kjd_template_4','kjd_template_5','kjd_template_6','front_page_widgets');

		'name' => __( 'Template Six Widgets' ),
		'id' => 'kjd_template_6',
		'description' => __( 'Widgets in this area will appear on pages using template six.' ),
		'before_widget' =>'',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
foreach($templates as $k =>$v){
	//$new_width = !empty(get_width($k)) ? get_width($k) : '' ;
	$v['before_widget'] = '<div class="widget '.$new_width.'">';
	// register_sidebar($k);
}

echo '<code>';
print_r($templates);
echo '</code>';

$misc = array(

'front_page_sidebar'=> array(
		'name' => __( 'Frontpage Widget Sidebar' ),
		'id' => 'front_page_sidebar',
		'description' => __( 'Widgets in this area will appear on the front page.' ),
		'before_widget' =>'<div class="widget">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'front_page_widget_area_1' => array(
		'name' => __( 'Frontpage Widgets 1' ),
		'id' => 'front_page_widget_area_1',
		'description' => __( 'Widgets in this area will appear on the front page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'front_page_widget_area_2'=> array(
		'name' => __( 'Header Area Widgets' ),
		'id' => 'header_widgets',
		'description' => __( 'Widgets in this area will appear in the header on the right.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'header_widgets'=> array(
		'name' => __( 'Header Area Widgets' ),
		'id' => 'header_widgets',
		'description' => __( 'Widgets in this area will appear in the header on the right.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'footer_widgets'=> array(
		'name' => __( 'Footer Widgets' ),
		'id' => 'footer_widgets',
		'description' => __( 'Widgets in this area will appear in the footer.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	)
);

$posts = array(
'single'=> array(
		'name' => __( 'Single Post Widgets' ),
		'id' => 'kjd_single',
		'description' => __( 'Widgets in this area will appear on single posts.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'posts'=>array(
		'name' => __( 'Posts Widgets' ),
		'id' => 'posts',
		'description' => __( 'Widgets in this area will appear on the posts index.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'category'=>array(
		'name' => __( 'Category Page Widgets' ),
		'id' => 'category',
		'description' => __( 'Widgets in this area will appear the category page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'archive'=>array(
		'name' => __( 'Archive Page Widgets' ),
		'id' => 'archive',
		'description' => __( 'Widgets in this area will appear the archives page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'tag'=>array(
		'name' => __( 'Tags Page Widgets' ),
		'id' => 'tags',
		'description' => __( 'Widgets in this area will appear the tags page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'taxonomy'=>array(
		'name' => __( 'Taxonomy Page Widgets' ),
		'id' => 'taxonomy',
		'description' => __( 'Widgets in this area will appear the taxonomy page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'author'=>array(
		'name' => __( 'Author Page Widgets' ),
		'id' => 'author',
		'description' => __( 'Widgets in this area will appear the author page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'date'=>array(
		'name' => __( 'Date Page Widgets' ),
		'id' => 'date',
		'description' => __( 'Widgets in this area will appear the dates page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'search'=>array(
		'name' => __( 'Search Page Widgets' ),
		'id' => 'search',
		'description' => __( 'Widgets in this area will appear the search page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	),
'attachment'=> array(
		'name' => __( 'Attachment Page Widgets' ),
		'id' => 'attachment',
		'description' => __( 'Widgets in this area will appear the attachment page.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	)
);