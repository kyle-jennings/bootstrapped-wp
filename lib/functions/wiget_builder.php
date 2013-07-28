<?php


	$widget_areas = array('single','index','category','archive','tag','taxonomy','author','date','search','attachment');
	foreach($widget_areas as $area){

		$width = set_width($layouts[$area]);
		register_sidebar(
			 array(
			'name' => __( $area. ' Widgets' ),
			'id' => $area,
			'description' => __( 'Widgets in this area will appear on the ' . $area ),
			'before_widget' =>'<div class="widget '.$width.'">',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'after_widget' => '</div>'
		)
		);

	}
