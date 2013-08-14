<?php
	//////////////////////
	// General Settings	
		add_settings_section(
			'kjd_theme_settings_section', // ID hook name
			null,
			null,
			'kjd_theme_settings' // page (settings group) name
		);

			// site logo
			add_settings_field(
				'kjd_site_logo', // ID hook name
				 null, //label
				 null, //callback
				'kjd_theme_settings', // page name
				'kjd_theme_settings_section' // parent section
			);

			// misc settings
			add_settings_field(
				'kjd_misc_settings', // ID hook name
				 null, //label
				 null, //callback
				'kjd_theme_settings', // page name
				'kjd_theme_settings_section' // parent section
			);

			//google analytics code
			add_settings_field(
				'kjd_google_analytics', // ID hook name
				 null, //label
				 null, //callback
				'kjd_theme_settings', // page name
				'kjd_theme_settings_section' // parent section
			);

			//confine Page - also shows body and html bgs
			add_settings_field(
				'kjd_confine_page', // ID hook name
				 null, //label
				 null, //callback
				'kjd_theme_settings', // page name
				'kjd_theme_settings_section' // parent section
			);

			//Use responsive design
			add_settings_field(
				'kjd_responsive_design', // ID hook name
				 null, //label
				 null, //callback
				'kjd_responsive_design', // page name
				'kjd_responsive_design_section' // parent section
			);

			//disable body and html BGs
			add_settings_field(
				'kjd_disable_BGs', // ID hook name
				 null, //label
				 null, //callback
				'kjd_theme_settings', // page name
				'kjd_theme_settings_section' // parent section
			);

		register_setting('kjd_theme_settings','kjd_theme_settings', 'kjd_build_theme_css');

		// settings components
		add_settings_section(
			'kjd_component_settings_section', // ID hook name
			null,
			null,
			'kjd_component_settings' // page name
		);

			add_settings_field(
				'kjd_style_widgets',
				 null, //label
				 null, //callback
				'kjd_component_settings',
				'kjd_component_settings_section'
			);


			add_settings_field(
				'kjd_style_posts',
				 null, //label
				 null, //callback
				'kjd_component_settings',
				'kjd_component_settings_section'
			);

			add_settings_field(
				'featured_image',
				null,
				null,
				'kjd_component_settings',
				'kjd_component_settings_section'
			);

			add_settings_field(
				'author_image',
				null,
				null,
				'kjd_component_settings',
				'kjd_component_settings_section'
			);			

			add_settings_field(
				'kjd_style_image_cycler_section',
				null,
				null,
				'kjd_component_settings',
				'kjd_component_settings_section'
			);

		register_setting('kjd_component_settings','kjd_component_settings', 'kjd_build_theme_css');

		// Widget Areas
		add_settings_section(
			'kjd_widget_areas_settings_section', // ID hook name
			null,
			null,
			'kjd_widget_areas_settings' // page name
		);

			add_settings_field(
				'widget_areas',
				null,
				null,
				'kjd_widget_areas_settings',
				'kjd_widget_areas_settings_section'
			);

		register_setting('kjd_widget_areas_settings','kjd_widget_areas_settings', 'kjd_build_theme_css');

		///////////////////
		// cycler settings
		///////////////////
		add_settings_section(
			'kjd_cycler_misc_settings_section', // ID hook name
			null,
			null,
			'kjd_cycler_misc_settings' // page name
		);
			add_settings_field(
				'kjd_cycler_misc',
				null,
				null,
				'kjd_cycler_misc_settings',
				'kjd_cycler_misc_settings_section'
			);
		
		////////////////
		//cycler images
		add_settings_section(
			'kjd_cycler_images_settings_section', // ID hook name
			null,
			null,
			'kjd_cycler_images_settings' // page name
		);

			add_settings_field(
				'kjd_cycler_images', //
				null, //label
				null, //callback
				'kjd_cycler_images_settings', //
				'kjd_cycler_images_settings_section' //
			);

			add_settings_field(
				'kjd_cycler_counter', //
				null, //label
				null, //callback
				'kjd_cycler_images_settings', //
				'kjd_cycler_images_settings_section' //
			);

		register_setting('kjd_cycler_misc_settings','kjd_cycler_misc_settings', 'kjd_build_theme_css');
		register_setting('kjd_cycler_images_settings','kjd_cycler_images_settings', 'kjd_build_theme_css');


		///////////////////
		// navbar settings
		///////////////////
		add_settings_section(
			'kjd_navbar_options_settings_section', // ID hook name
			'navbar settings', // label
			'kjd_navbar_options_settings_callback', // function name
			'kjd_navbar_options_settings' // page name
		);
		add_settings_field(
			'kjd_navbar_options',
			null,
			null,
			'kjd_navbar_options_settings',
			'kjd_navbar_options_settings_section'
		);

		register_setting('kjd_navbar_options_settings','kjd_navbar_options_settings', 'kjd_build_theme_css');

		/////////////////////
		// page layouts
		////////////////////
		add_settings_section(
			'kjd_page_layout_settings_section', // ID hook name
			'Page Layout settings', // label
			'kjd_page_layout_settings_callback', // function name
			'kjd_page_layout_settings' // page name
		);

			add_settings_field(
				'kjd_page_layouts', // ID hook name
				null,
				null,
				'kjd_page_layout_settings', // page name
				'kjd_page_layout_settings_section' // parent section
			);
		//posts layouts
		add_settings_section(
			'kjd_post_layout_settings_section', // ID hook name
			null,
			null,
			'kjd_post_layout_settings' // page name
		);
			add_settings_field(
				'kjd_post_layouts', // ID hook name
				null,
				null,
				'kjd_post_layout_settings', // page name
				'kjd_post_layout_settings_section' // parent section
			);

		// front page layout
		add_settings_section(
			'kjd_frontPage_layout_section', // ID hook name
			'Page front page layout', // label
			'kjd_frontPage_layout_callback', // function name
			'kjd_frontPage_layout_settings' // page name
		);
			add_settings_field(
				'kjd_frontPage_layout', // ID hook name
				null,
			null,
				'kjd_frontPage_layout_settings', // page name
				'kjd_frontPage_layout_section' // parent section
			);
			add_settings_field(
				'kjd_frontPage_contentPage', // ID hook name
				null,
			null,
				'kjd_frontPage_layout_settings', // page name
				'kjd_frontPage_layout_section' // parent section
			);
			add_settings_field(
				'kjd_frontPage_secondaryContent', // ID hook name
				null,
			null,
				'kjd_frontPage_layout_settings', // page name
				'kjd_frontPage_layout_section' // parent section
			);		
				
		//post listings layouts
		add_settings_section(
			'kjd_post_listing_layout_settings_section', // ID hook name
			'Page Layout settings', // label
			'kjd_post_listing_layout_settings_callback', // function name
			'kjd_post_listing_layout_settings' // page name
		);
			add_settings_field(
				'post_listing_settings', // ID hook name
				null,
			null,
				'kjd_post_listing_layout_settings', // page name
				'kjd_post_listing_layout_settings_section' // parent section
			);

 		register_setting('kjd_post_layout_settings','kjd_post_layout_settings', 'kjd_build_theme_css');
 		register_setting('kjd_page_layout_settings','kjd_page_layout_settings', 'kjd_build_theme_css');
 		register_setting('kjd_frontPage_layout_settings','kjd_frontPage_layout_settings', 'kjd_build_theme_css');
 		register_setting('kjd_post_listing_layout_settings','kjd_post_listing_layout_settings', 'kjd_build_theme_css');

/* ------------------------------------------------------------------------------------------------------- */
/* ------------------------------------------- Page sections --------------------------------------------- */
/* ------------------------------------------------------------------------------------------------------- */

$sections = array('login','htmlTag','bodyTag','mastArea','contentArea','header',
	'navbar','dropdown-menu','cycler','pageTitle','body','posts','widgets','footer');
foreach($sections as $section){

	
	///////////////////////
	// background settings
	///////////////////////
	add_settings_section(
		'kjd_'.$section.'_background_settings_section', // ID hook name
		'body settings', // label
		'kjd_'.$section.'_background_settings_callback', // function name
		'kjd_'.$section.'_background_settings' // page name
	);

		//background colors - start color, end color, fill type (gradients, solid, none), opacity
		add_settings_field(
			'kjd_'.$section.'_background_colors', // ID hook name
			null,
			null,
			'kjd_'.$section.'_background_settings', // page name
			'kjd_'.$section.'_background_settings_section' // parent section
		);

		//background wallpaper - url to file, use wallpaper, repeat, position, custom position
		add_settings_field(
			'kjd_'.$section.'_background_wallpaper', // ID hook name
			null,
			null,
			'kjd_'.$section.'_background_settings', // page name
			'kjd_'.$section.'_background_settings_section' // parent section
		);
		// if($section == 'mastArea'){
			
		// }
			add_settings_field(
				'kjd_'.$section.'_background_misc', // ID hook name
				null,
			null,
				'kjd_'.$section.'_background_settings', // page name
				'kjd_'.$section.'_background_settings_section' // parent section
			);
	register_setting('kjd_'.$section.'_background_settings','kjd_'.$section.'_background_settings', 'kjd_build_theme_css');


	// The body, html, and login sections dont need border control
	if($section !='login' && $section !='bodyTag' && $section !='htmlTag'  && $section !='mastArea'  && $section !='contentArea'){
	
		//////////////////////
		// borders
  		//////////////////////
		add_settings_section(
			'kjd_'.$section.'_borders_settings_section', // ID hook name
			'body settings', // label
			'kjd_'.$section.'_borders_settings_callback', // function name
			'kjd_'.$section.'_borders_settings' // page name
		);

			//top borders
			add_settings_field(
				'kjd_'.$section.'_top_border', // ID hook name
				null,
				null,
				'kjd_'.$section.'_borders_settings', // page name
				'kjd_'.$section.'_borders_settings_section' // parent section
			);
			//right borders
			add_settings_field(
				'kjd_'.$section.'_right_border', // ID hook name
				null,
				null,
				'kjd_'.$section.'_borders_settings', // page name
				'kjd_'.$section.'_borders_settings_section' // parent section
			);
			//bottom borders
			add_settings_field(
				'kjd_'.$section.'_bottom_border', // ID hook name
				null,
			null,
				'kjd_'.$section.'_borders_settings', // page name
				'kjd_'.$section.'_borders_settings_section' // parent section
			);

			//left borders
			add_settings_field(
				'kjd_'.$section.'_left_border', // ID hook name
				null,
			null,
				'kjd_'.$section.'_borders_settings', // page name
				'kjd_'.$section.'_borders_settings_section' // parent section
			);


			//border Radius - top left, top right, bottom right, bottom left - should be array, each key only holds an int
			add_settings_field(
				'kjd_'.$section.'_border_radius', // ID hook name
				null,
			null,
				'kjd_'.$section.'_borders_settings', // page name
				'kjd_'.$section.'_borders_settings_section' // parent section
			);
		
		register_setting('kjd_'.$section.'_borders_settings','kjd_'.$section.'_borders_settings', 'kjd_build_theme_css');
	} //end if not login, body, or html

	// the body, html, and cycler sections dont need text or form controls
	if($section !='bodyTag' && $section !='htmlTag' && $section !='cycler'){

		///////////////////////////
		// text and H tag Settings
		///////////////////////////
		if($section !='dropdown-menu'){
		add_settings_section(
			'kjd_'.$section.'_text_settings_section', // ID hook name
			null,
			null,
			'kjd_'.$section.'_text_settings' // page name
		);

			//text color
			add_settings_field(
				'kjd_'.$section.'_text', // ID hook name
				null,
			null,
				'kjd_'.$section.'_text_settings', // page name

				'kjd_'.$section.'_text_settings_section' // parent section

			);

			// H1 settings - color, backbground, border, decoration
			add_settings_field(
				'kjd_'.$section.'_H1', // ID hook name
				null,
			null,
				'kjd_'.$section.'_text_settings', // page name

				'kjd_'.$section.'_text_settings_section' // parent section

			);

			// H2 settings - color, backbground, border, decoration
			add_settings_field(
				'kjd_'.$section.'_H2', // ID hook name
				null,
			null,
				'kjd_'.$section.'_text_settings', // page name

				'kjd_'.$section.'_text_settings_section' // parent section

			);

			// H3 settings - color, backbground, border, decoration
			add_settings_field(
				'kjd_'.$section.'_H3', // ID hook name
				null,
			null,
				'kjd_'.$section.'_text_settings', // page name

				'kjd_'.$section.'_text_settings_section' // parent section

			);

			// H4 settings - color, backbground, border, decoration
			add_settings_field(
				'kjd_'.$section.'_H4', // ID hook name
				null,
			null,
				'kjd_'.$section.'_text_settings', // page name

				'kjd_'.$section.'_text_settings_section' // parent section

			);
			register_setting('kjd_'.$section.'_text_settings','kjd_'.$section.'_text_settings', 'kjd_build_theme_css');
		}
		//////////////////////
		// text and link styles
		//////////////////////
		add_settings_section(
			'kjd_'.$section.'_link_settings_section', // ID hook name
			'Text color settings', // label
			'kjd_'.$section.'_link_settings_callback', // function name
			'kjd_'.$section.'_link_settings' // page name
		);

			// link settings - color, background color, border color
			add_settings_field(
				'kjd_'.$section.'_link', // ID hook name
				null,
				null,
				'kjd_'.$section.'_link_settings', // page name
				'kjd_'.$section.'_link_settings_section' // parent section
			);

			// hovered link settings - color, background color, border color
			add_settings_field(
				'kjd_'.$section.'_linkHovered', // ID hook name
				null,
				null,
				'kjd_'.$section.'_link_settings', // page name
				'kjd_'.$section.'_link_settings_section' // parent section
			);

			// visited link  - color, background color, border color
			add_settings_field(
				'kjd_'.$section.'_linkVisited', // ID hook name
				null,
				null,
				'kjd_'.$section.'_link_settings', // page name
				'kjd_'.$section.'_link_settings_section' // parent section
			);

			// active link - color, background color, border color
			add_settings_field(
				'kjd_'.$section.'_linkActive', // ID hook name
				null,
				null,
				'kjd_'.$section.'_link_settings', // page name
				'kjd_'.$section.'_link_settings_section' // parent section
			);

		///////////////////
		// forms
		///////////////////
		add_settings_section(
			'kjd_'.$section.'_components_settings_section', // ID hook name
			'Forms settings', // label
			'kjd_'.$section.'_components_settings_callback', // function name
			'kjd_'.$section.'_components_settings' // page name
		);
			add_settings_field(
				'kjd_'.$section.'_components',
				null,
				null,
				'kjd_'.$section.'_components_settings',
				'kjd_'.$section.'_components_settings_section'
			);

		
		register_setting('kjd_'.$section.'_links_settings','kjd_'.$section.'_links_settings', 'kjd_build_theme_css');
		register_setting('kjd_'.$section.'_components_settings','kjd_'.$section.'_components_settings', 'kjd_build_theme_css');

	} //end if not body or html

	add_settings_section(
		'kjd_'.$section.'_misc_settings_section', // ID hook name
		null,
			null,
		'kjd_'.$section.'_misc_settings' // page name
	);
		add_settings_field(
			'kjd_'.$section.'_misc',
			null,
			null,
			'kjd_'.$section.'_misc_settings',
			'kjd_'.$section.'_misc_settings_section'
		);
	register_setting('kjd_'.$section.'_misc_settings','kjd_'.$section.'_misc_settings', 'kjd_build_theme_css');
}//end loop

function kjd_build_theme_css($input){

	$root=dirname(dirname(__FILE__)); 
	$root = $root.'/styles';
	$file = $root.'/custom.css';

	if(file_exists($file)){
		chmod($file, 0777);
		unlink($file);
		$file = fopen($file, "w+");	
	}else{
		$file = fopen($file, "x+");
	}

	ob_start();
		echo kjd_get_theme_options();
		$buffered_content = ob_get_contents();
	ob_end_clean();

	fwrite($file, $buffered_content);
	fclose($file);

	return $input;
}