<?php



function kjd_settings_display($section = null) {

    kjd_build_theme_css();

    $options = get_option('kjd_posts_misc_settings');
    $options = $options['kjd_posts_misc'];

    include('forms-navigation.php');
    settings_errors();
    nav_tabs($tabs, $active_tab,$section);
    sections_dropdown_nav();

 ?>

	<form method="post" action="options.php">
		<div class="<?php echo $fields_wrapper_class; ?>" >
		<?php

		if( $active_tab == 'background' ) {

			wp_enqueue_media();
			kjd_section_background_callback($section);

		}elseif($active_tab == 'borders' && ($section !='login' && $section !='bodyTag' && $section !='htmlTag')){

			kjd_section_borders_callback($section);

		}elseif($active_tab == 'headings' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler' && $section!='dropdown-menu')){

			kjd_section_headings_callback($section);

		}elseif($active_tab == 'text' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler')){

			kjd_section_text_callback($section);

		}elseif($active_tab == 'presentation' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){

			kjd_section_presentation_callback($section);

		}elseif($active_tab == 'images' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){

			kjd_section_images_callback($section);

		}elseif($active_tab == 'misc' &&($section !='bodyTag' && $section !='htmlTag' && $section !='cycler') ){

			wp_enqueue_media();
			kjd_section_misc_callback($section);

		}elseif($active_tab == 'image_banner_settings'){ // image cycler settings

			kjd_image_cycler_display_callback();
			kjd_cycler_settings_callback();

		}elseif($active_tab == 'image_banner_images'){ // image cycler iamges
			wp_enqueue_media();
			kjd_image_cycler_display_callback();
			kjd_cycler_images_callback();

		}elseif($active_tab == 'sidr'){ // image cycler iamges
			wp_enqueue_media();
			kjd_section_background_callback('sidrDrawer');
		}

		submit_button();
		?>

		</div>

		<?php if(
            $active_tab != 'image_banner_images' &&
            $active_tab != 'image_banner_settings' ): ?>

		<div class="preview-options">
            <?php echo kjd_site_preview();?>
		</div>


		<?php endif; ?>

	</form>

<?php
}


function kjd_section_background_callback($section){
	include('background.php');
}



function kjd_section_borders_callback($section){
	include('borders.php');
}


function kjd_section_headings_callback($section){

	include('headings.php');
}


function kjd_section_text_callback($section){
	include('text.php');
}


function kjd_section_presentation_callback($section){
	include('presentation.php');
}


function kjd_section_images_callback($section){

	include('images.php');
}


function kjd_image_cycler_display_callback(){
	include('image_banner.php');
}


function kjd_section_misc_callback($section){
	include('misc.php');
}
