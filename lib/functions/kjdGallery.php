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
	'size' => null,
	'wrapper' => null,
	'color' => null
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

		// I think this is here to prvent galleries from showing up on the blog feed
		if ( is_feed() ) {
		$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		$output .= "<ul class='thumbnails'>";
		foreach ( $attachments as $id => $attachment ) {
		
			$url = wp_get_attachment_image_src($id, 'thumbnail');
			$output .= "<li class='span2'>";

			$output .= "<div class='thumbnail'>";
			//$output .= '<img src="'.get_attachment_link($id, $size, false, false).'" />';
			if($link == 'post'){
				$output .= '<a href="'.get_attachment_link( $id ).'"><img src="'.$url[0].'" /></a>';
			}else{
				$output .= '<a href="'.wp_get_attachment_url( $id ).'"><img src="'.$url[0].'" /></a>';
			}
			
			$output .= "</div>";

			$output .= "</li>";
		}

		$output .= "</ul>\n";
		return $output;


	}else{
		if($style=='wallofthumbs'){
		
			return ' ';
		}elseif($style=='elastislide'){


				$template = '<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">  ';
				$template .= '<div class="rg-image-wrapper" style="background:'.$color.';">';
				$template .= '{{if itemsCount > 1}}';
				$template .= '<div class="rg-image-nav">';
				$template .= '<a href="#" class="rg-image-nav-prev" style="background-color:'.$color.';">Previous Image</a>';
				$template .= '<a href="#" class="rg-image-nav-next" style="background-color:'.$color.';">Next Image</a>';
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
			$output .= '<div class="es-carousel-wrapper" style="background:'.$color.';">';
				$output .= '<div class="es-nav">';
				$output .= '<span class="es-nav-prev">Previous</span>';
				$output .= '<span class="es-nav-next">Next</span>';
				$output .= '</div>';

				$output .= '<div class="es-carousel">';
				$output .= '<ul>';
				
				$thumbnails = get_post_images(get_the_ID(), 'thumbmail');
				$fullImages = get_post_images(get_the_ID(), 'large');
				foreach ($thumbnails as $image) {
		    		$output .= '<li><a href="#"><img src="'.$image['thumbnail'].'" alt="'.$title.'" data-large="'.$image['full'].'" alt="'.$image['alt'].'" data-description="'.$img["content"].'" /></a></li>';
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