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

// $pageLayouts['front_page_widget_area_1']=array('position' => 'bottom','deviceView' => 'all');
// $pageLayouts['front_page_widget_area_2']=array('position' => 'bottom','deviceView' => 'all');
if(!empty($pageLayouts) && empty($postLayouts)){ 
	$layouts = $pageLayouts;
}elseif(!empty($postLayouts) && empty($pageLayouts)){
	$layouts = $postLayouts;
}else{
	$layouts = array_merge($pageLayouts,$postLayouts);
}



//echo count($sidebars[$layouts['kjd_template_1']]);


function set_width($template,$frontpage_area = null)
{
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


//////////////////////////////
//	 Page templates
//////////////////////////////

	$width = set_width($layouts['kjd_template_1']);
	$template_1 = array(
		'name' => __( 'Template One Widgets' ),
		'id' => 'kjd_template_1',
		'description' => __( 'Widgets in this area will appear on pages using template one.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
register_sidebar($template_1);
$width = set_width($layouts['kjd_template_2']);
	$template_2 = array(
		'name' => __( 'Template Two Widgets' ),
		'id' => 'kjd_template_2',
		'description' => __( 'Widgets in this area will appear on pages using template two.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
register_sidebar($template_2);
$width = set_width($layouts['kjd_template_3']);
	$template_3 = array(
		'name' => __( 'Template Three Widgets' ),
		'id' => 'kjd_template_3',
		'description' => __( 'Widgets in this area will appear on pages using template three.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
register_sidebar($template_3);
$width = set_width($layouts['kjd_template_4']);
	$template_4 = array(
		'name' => __( 'Template Four Widgets' ),
		'id' => 'kjd_template_4',
		'description' => __( 'Widgets in this area will appear on pages using template four.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
register_sidebar($template_4);
$width = set_width($layouts['kjd_template_5']);
	$template_5 = array(
		'name' => __( 'Template Five Widgets' ),
		'id' => 'kjd_template_5',
		'description' => __( 'Widgets in this area will appear on pages using template five.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
register_sidebar($template_5);
$width = set_width($layouts['kjd_template_6']);
	$template_6 = array(
		'name' => __( 'Template Six Widgets' ),
		'id' => 'kjd_template_6',
		'description' => __( 'Widgets in this area will appear on pages using template six.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);

register_sidebar($template_6);
				
/////////////////////////////
// index, header, and footer
/////////////////////////////

	$front_page_sidebar = array(
		'name' => __( 'Front page Widget Sidebar' ),
		'id' => 'front_page_sidebar',
		'description' => __( 'Widgets in this area will appear on the front page.' ),
		'before_widget' =>'<div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($front_page_sidebar);
//frontPage_widget_area1

	$width = set_width($layouts['kjd_front_page_widgets'],'front_page_widget_area_1' );

	$front_page_widget_area_1 = 
	array(
		'name' => __( 'Front page Widgets 1' ),
		'id' => 'front_page_widget_area_1',
		'description' => __( 'Widgets in this area will appear on the front page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($front_page_widget_area_1);
	
	$width = set_width($layouts['kjd_front_page_widgets'],'front_page_widget_area_2');
	$front_page_widget_area_2 = array(
		'name' => __( 'Front page Widgets 2' ),
		'id' => 'front_page_widget_area_2',
		'description' => 'Widgets in this area will appear on the front page.',
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($front_page_widget_area_2);
	
	$temp = array('name' => 'header_widgets', 'position' =>"top");
	$width = set_width($temp);
	$header_widgets = array(
		'name' => __( 'Header Area Widgets' ),
		'id' => 'header_widgets',
		'description' => __( 'Widgets in this area will appear in the header on the right.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($header_widgets);	

	$temp = array('name' => 'footer_widgets', 'position' =>"top");
	$width = set_width($temp);
	$footer_widgets = array(
		'name' => __( 'Footer Widgets' ),
		'id' => 'footer_widgets',
		'description' => __( 'Widgets in this area will appear in the footer. Only use FOUR!' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($footer_widgets);	

///////////////////////
// posts widgets
///////////////////////


	$width = set_width($layouts['posts']);
	$posts_template = array(
		'name' => __( 'Posts Widgets' ),
		'id' => 'posts',
		'description' => __( 'Widgets in this area will appear on the posts index.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($posts_template);

	$width = set_width($layouts['single']);
	$singlePost_template = array(
		'name' => __( 'Single Post Widgets' ),
		'id' => 'kjd_single',
		'description' => __( 'Widgets in this area will appear on single posts.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($singlePost_template);

	
	$width = set_width($layouts['category']);
	$category_template = array(
		'name' => __( 'Category Page Widgets' ),
		'id' => 'category',
		'description' => __( 'Widgets in this area will appear the category page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($category_template);

	$width = set_width($layouts['archive']);
	$archive_template = array(
		'name' => __( 'Archive Page Widgets' ),
		'id' => 'archive',
		'description' => __( 'Widgets in this area will appear the archives page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($archive_template);

	$width = set_width($layouts['tag']);
	$tags_template = array(
		'name' => __( 'Tags Page Widgets' ),
		'id' => 'tags',
		'description' => __( 'Widgets in this area will appear the tags page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($tags_template);


	$width = set_width($layouts['taxonomy']);
	$taxonomy_template = array(
		'name' => __( 'Taxonomy Page Widgets' ),
		'id' => 'taxonomy',
		'description' => __( 'Widgets in this area will appear the taxonomy page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($taxonomy_template);


	$width = set_width($layouts['author']);
	$author_template = array(
		'name' => __( 'Author Page Widgets' ),
		'id' => 'author',
		'description' => __( 'Widgets in this area will appear the author page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);	
	register_sidebar($author_template);

	$width = set_width($layouts['date']);
	$date_template = array(
		'name' => __( 'Date Page Widgets' ),
		'id' => 'date',
		'description' => __( 'Widgets in this area will appear the dates page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($date_template);

	$width = set_width($layouts['search']);	
	$search_template = array(
		'name' => __( 'Search Page Widgets' ),
		'id' => 'search',
		'description' => __( 'Widgets in this area will appear the search page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($search_template);


	$width = set_width($layouts['attachment']);
	$attachment_template = array(
		'name' => __( 'Attachment Page Widgets' ),
		'id' => 'attachment',
		'description' => __( 'Widgets in this area will appear the attachment page.' ),
		'before_widget' =>'<div class="'.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);
	register_sidebar($attachment_template);


}


?>
