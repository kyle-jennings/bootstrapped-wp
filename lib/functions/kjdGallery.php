<?php

add_filter('post_gallery', 'kjd_override_gallery', 1, 2);
function kjd_override_gallery($empty, $attr){
	$root = get_bloginfo('template_directory'); 
	$root .= '/lib';
	global $post;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
	$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	if ( !$attr['orderby'] )
		unset( $attr['orderby'] );
	}

	// extract args
	extract(shortcode_atts(array(
	'order'      => 'ASC',
	'orderby'    => 'menu_order ID',
	'id'         => $post->ID,
	'itemtag'    => '',
	'icontag'    => '',
	'captiontag' => '',
	'columns'    => 3,
	'size'       => 'thumbnail',
	'include'    => '',
	'exclude'    => '',
	'style' => null,
	'thumbspos' => null,
	'captionpos' => null
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
	$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
	$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if(!$style){
		if ( empty($attachments) )
		return '';

		if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
		}


		$captiontag = tag_escape($captiontag);

		$size_class = sanitize_html_class( $size );
		$gallery_div = "<ul class='thumbnails'>";
		$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		$output .= "<li class='span2'>";

		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<div class='thumbnail'>";
					$output .= $link;
					$output .= wptexturize($attachment->post_excerpt) . 
				"</div>";
		}else{
			$output .= "
				<div class='thumbnail'>";
					$output .= $link;
				"</div>";
		}

		$output .= "</li>";
		}

		$output .= "</ul>\n";
		return $output;


	}else{
		if($style=='wallofthumbs'){
		
			return ' ';
		}elseif($style=='elastislide'){
				$template = '<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">  ';
				$template .= '<div class="rg-image-wrapper">';
				$template .= '{{if itemsCount > 1}}';
				$template .= '<div class="rg-image-nav">';
				$template .= '<a href="#" class="rg-image-nav-prev">Previous Image</a>';
				$template .= '<a href="#" class="rg-image-nav-next">Next Image</a>';
				$template .= '</div>';
				$template .= '{{/if}}';
				$template .= '<div class="rg-image"></div>';
				$template .= '<div class="rg-loading"></div>';
				$template .= '<div class="rg-caption-wrapper">';
				$template .= '<div class="rg-caption" style="display:none;">';
				$template .= '<p></p>';
				$template .= '</div>';
				$template .= '</div>';
				$template .= '</div>';
				$template .= '</script>';
			$output = $template;
			$output .= '<div id="rg-gallery" class="rg-gallery"> ';

			$output .= '<div class="rg-thumbs">';
			$output .= '<!-- Elastislide Carousel Thumbnail Viewer -->';
			$output .= '<div class="es-carousel-wrapper">';
				$output .= '<div class="es-nav">';
				$output .= '<span class="es-nav-prev">Previous</span>';
				$output .= '<span class="es-nav-next">Next</span>';
				$output .= '</div>';

				$output .= '<div class="es-carousel">';
				$output .= '<ul>';
				
				$fullImages = get_post_images(get_the_ID(), 'large');
				foreach ($fullImages as $img) {
		    		$output .= '<li><a href="#"><img src="'.$img[0].'" alt="'.$title.'" data-large="'.$img[0].'" alt="image01" data-description="'.$img["title"].'" /></a></li>';
				}
				$output .= '</ul>';
				$output .= '</div>';
			$output .= '</div>';
			$output .= '<!-- End Elastislide Carousel Thumbnail Viewer -->';

			$output .= '</div><!-- rg-thumbs -->';
			$output .= '</div><!-- rg-gallery -->';

			$elastislideDir = get_bloginfo('template_directory').'/lib/scripts/elastislide/';

			wp_enqueue_script( 'tmpl', $elastislideDir.'tmpl.min.js', false, false, true );
			wp_enqueue_script( 'easing', $elastislideDir.'easing.js', false, false, true );			
			wp_enqueue_script( 'elastislide', $elastislideDir.'elastislide.js', false, false, true );
			wp_enqueue_script( 'gallery', $elastislideDir.'gallery.js', false, false, true );
			wp_enqueue_style('elastislide', $elastislideDir.'elastislide.css');
			wp_enqueue_style('elastislidestyle', $elastislideDir.'style.css');
			
			
			return $output;
		}

	} // end gallery override
}

?>