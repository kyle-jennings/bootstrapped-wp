<?php

get_header();
	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];	
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

	$pageTitleSettings = get_option('kjd_pageTitle_misc_settings');
	$pageTitleSettings = $pageTitleSettings['kjd_pageTitle_misc'];
	$confineTitleBackground = $pageTitleSettings['kjd_pageTitle_confine_background'];
if (have_posts()) : while (have_posts()) : the_post();
?>
		<div id="mainContent" class="span12">
			<div class="page-header">
				<h1><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h1>
			</div>
			<div class="post-info">
				<span class="post-date">
					Posted on: <a href=""><?php the_date(); ?></a>, 
				</span>
				<span class="post-author">
					By: <a href=""><?php the_author(); ?></a>
				</span>
			</div>
			
			<div class="post-content">
				<?php the_content(); ?>
			</div>

			<div class="post-meta">

			</div>
		</div>
<?php endwhile; endif;

get_footer();
?>