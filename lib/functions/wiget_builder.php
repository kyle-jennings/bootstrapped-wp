
	$width = set_width($layouts['index']);

	$widget_areas = array('single','index','category','archive','tag','taxonomy','author','date','search','attachment');
	
	foreach($widget_areas as $area){
		register_sidebar(
			 array(
			'name' => __( 'Posts Widgets' ),
			'id' => 'index',
			'description' => __( 'Widgets in this area will appear on the index index.' ),
			'before_widget' =>'<div class="widget '.$width.'">',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'after_widget' => '</div>'
		)
		);

	}
	

	$posts_template = array(
		'name' => __( 'Posts Widgets' ),
		'id' => 'index',
		'description' => __( 'Widgets in this area will appear on the index index.' ),
		'before_widget' =>'<div class="widget '.$width.'">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	);