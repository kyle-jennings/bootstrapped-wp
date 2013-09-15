<?php
	//////////////////////
	// General Settings	
		add_settings_section(
			'kjd_theme_settings_section', // ID hook name
			null,
			null,
			'kjd_theme_settings' // page (settings group) name
		);

		$general_settings = array('site_logo','logo_toggle','misc_settings','google_analytics','confine_page','responsive_design','_disable_BGs');
		foreach($general_settings as $setting){

			add_settings_field(
				'kjd_'.$setting, // ID hook name
				 null, //label
				 null, //callback
				'kjd_theme_settings', // page name
				'kjd_theme_settings_section' // parent section
			);
			
		}

		register_setting('kjd_theme_settings','kjd_theme_settings');

		// settings components
		add_settings_section(
			'kjd_component_settings_section', // ID hook name
			null,
			null,
			'kjd_component_settings' // page name
		);

		$general_settings_misc = array('style_widgets','style_posts','featured_image','author_image');
		foreach($general_settings_misc as $setting){
			add_settings_field(
				$setting,
				 null, //label
				 null, //callback
				'kjd_component_settings',
				'kjd_component_settings_section'
			);
		}
	

		register_setting('kjd_component_settings','kjd_component_settings');

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

		register_setting('kjd_widget_areas_settings','kjd_widget_areas_settings');

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

		register_setting('kjd_cycler_images_settings','kjd_cycler_images_settings');

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

 		register_setting('kjd_post_layout_settings','kjd_post_layout_settings');
 		register_setting('kjd_page_layout_settings','kjd_page_layout_settings');
 		register_setting('kjd_frontPage_layout_settings','kjd_frontPage_layout_settings');
 		register_setting('kjd_post_listing_layout_settings','kjd_post_listing_layout_settings');

/* ------------------------------------------------------------------------------------------------------- */
/* ------------------------------------------- Page sections --------------------------------------------- */
/* ------------------------------------------------------------------------------------------------------- */

$sections = array('login','htmlTag','bodyTag','mastArea','contentArea','sidrDrawer','header',
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

	$background_settings = array('colors','wallpaper','misc');
	foreach($background_settings as $setting){
		add_settings_field(
			'kjd_'.$section.'_background_'.$setting, // ID hook name
			null,
			null,
			'kjd_'.$section.'_background_settings', // page name
			'kjd_'.$section.'_background_settings_section' // parent section
		);
	}

	register_setting('kjd_'.$section.'_background_settings','kjd_'.$section.'_background_settings');


	// The body, html, and login sections dont need border control
	if($section !='login' && $section !='bodyTag' && $section !='htmlTag' && $section != 'sidrDrawer'  && $section !='mastArea'  && $section !='contentArea'){
	
		//////////////////////
		// borders
  		//////////////////////
		add_settings_section(
			'kjd_'.$section.'_borders_settings_section', // ID hook name
			'body settings', // label
			'kjd_'.$section.'_borders_settings_callback', // function name
			'kjd_'.$section.'_borders_settings' // page name
		);
	
			// create settings for each border side
	  		$border_sides = array('top', 'right', 'bottom', 'left');
	  		foreach ($border_sides as $side){

				//top borders
				add_settings_field(
					'kjd_'.$section.'_'.side.'_border', // ID hook name
					null,
					null,
					'kjd_'.$section.'_borders_settings', // page name
					'kjd_'.$section.'_borders_settings_section' // parent section
				);
	  		
	  		}

			//border Radius - top left, top right, bottom right, bottom left - should be array, each key only holds an int
			add_settings_field(
				'kjd_'.$section.'_border_radius', // ID hook name
				null,
				null,
				'kjd_'.$section.'_borders_settings', // page name
				'kjd_'.$section.'_borders_settings_section' // parent section
			);
		
		register_setting('kjd_'.$section.'_borders_settings','kjd_'.$section.'_borders_settings');
	} //end if not login, body, or html

	// the body, html, and cycler sections dont need text or form controls
	if($section !='bodyTag' && $section !='htmlTag' && $section != 'sidrDrawer' && $section !='cycler'){

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

			$htags = array('H1', 'H2', 'H3','H4');
			foreach($htags as $size){
				add_settings_field(
					'kjd_'.$section.'_'.$size, // ID hook name
					null,
					null,
					'kjd_'.$section.'_text_settings', // page name
					'kjd_'.$section.'_text_settings_section' // parent section
				);
			}
			register_setting('kjd_'.$section.'_text_settings','kjd_'.$section.'_text_settings');
		}
		//////////////////////
		// link styles
		//////////////////////
		add_settings_section(
			'kjd_'.$section.'_link_settings_section', // ID hook name
			'Text color settings', // label
			'kjd_'.$section.'_links_settings_callback', // function name
			'kjd_'.$section.'_links_settings' // page name
		);

		$link_types = array('link','linkHovered','linkVisited','linkActive');

		foreach( $link_types as $type){
			add_settings_field(
				'kjd_'.$section.'_'.$type, // ID hook name
				null,
				null,
				'kjd_'.$section.'_links_settings', // page name
				'kjd_'.$section.'_links_settings_section' // parent section
			);			
		}
		register_setting('kjd_'.$section.'_links_settings','kjd_'.$section.'_links_settings');
		

		///////////////////
		// components
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

		
		register_setting('kjd_'.$section.'_components_settings','kjd_'.$section.'_components_settings');

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
	register_setting('kjd_'.$section.'_misc_settings','kjd_'.$section.'_misc_settings');
}//end loop
