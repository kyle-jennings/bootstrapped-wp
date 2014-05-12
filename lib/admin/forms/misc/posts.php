<?php

/* ----------------------------------------------------------------------------------------
			Posts - Content 
---------------------------------------------------------------------------------------- */

function kjd_posts_misc_settings_callback($section)
{
	settings_fields('kjd_posts_misc_settings');
	$options = get_option('kjd_posts_misc_settings');
	$options = $options['kjd_posts_misc'];


?>

	<div class="optionsWrapper">
		<h3>Post/Page Styles</h3>

		<div class="option"> 
			<label>Style Posts?</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][style_posts]">
				<option value="false" <?php selected( $options['style_posts'], "false", true) ?>>No</option>
				<option value="true" <?php selected( $options['style_posts'], "true", true) ?>>Yes</option>
			<select>
		</div>


		<h3>Misc Colors</h3>

		<div class="color_option option" style="position: relative;">
			<label>Post Titles Bottom Border</label>

			<input class="minicolors" name="kjd_posts_misc_settings[kjd_posts_misc][post_info_border]" 
				value="<?php echo $options['post_info_border'] ? $options['post_info_border'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label>Blockquote Color</label>

			<input class="minicolors" name="kjd_posts_misc_settings[kjd_posts_misc][blockquote]" 
				value="<?php echo $options['blockquote'] ? $options['blockquote'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
	
		


	
	</div>

	<div class="optionsWrapper">

		<h3>Post/Page Listing</h3>

		<div class="option">
			<label>Display paginator at top of posts</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][pagination_top]">
				<option value="false" <?php selected( $options['pagination_top'], "false", true) ?>>No</option>
				<option value="true" <?php selected( $options['pagination_top'], "true", true) ?>>Yes</option>
			</select>

		</div>
		

		<div class="option"> 
			<label>Show Excerpt or Content</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][post_listing_type]" class="post-listing-toggle">
				<option value="excerpt" <?php selected( $options['post_listing_type'], "excerpt", true) ?>>Excerpt</option>
				<option value="content" <?php selected( $options['post_listing_type'], "content", true) ?>>Content</option>
			<select>
		</div>

	</div>

<!-- Post Thumbnail settings -->
	<div class="optionsWrapper image-settings" <?php echo $options['post_listing_type'] == 'excerpt' ? 'style="display:block;"' : 'style="display:none;"';?>>
		<h3>Featured Image</h3>

		<div class="option"> 
			<label>Show Featured/Author Image</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][show_featured_image]" class='featured-image-toggle'>
				<option value="false" <?php selected( $options['show_featured_image'], "false", true) ?>>No</option>
				<option value="true" <?php selected( $options['show_featured_image'], "true", true) ?>>Yes</option>
			<select>
		</div> 
	</div>

	<div class="option-wraper featured-image-settings" <?php echo $options['show_featured_image'] == 'true' ? 'style="display:block;"' : 'style="display:none;"';?>>
		<div class="option"> 
			<label>Featured/Author Image Position</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][featured_position]">
				<?php
					$positions = array('atop_post','left_of_post','right_of_post','after_post','before_post_info', 'before_content','before_post_meta');
					foreach($positions as $position){
						$selected = selected( $options['featured_position'], $position, true);
						echo '<option value="'.$position.'" '.$selected.' >'.ucwords(str_replace('_',' ',$position)).'</option>';
					}
				?>
			<select>
		</div> 

		<div class="option"> 
			<label>Show Featured or Author Image</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][image_type]">
				<option value="featured" <?php selected( $options['image_type'], "featured", true) ?>>Featured</option>
				<option value="author" <?php selected( $options['image_type'], "author", true) ?>>Author</option>
			<select>
		</div> 

	</div>

<?php

}
