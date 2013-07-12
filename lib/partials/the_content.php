<?php 
	$options = get_option('kjd_theme_settings');
	$pagination_top = $options['kjd_pagination_top'];

if (have_posts()) :
	
	if($pagination_top == 'true'){
		posts_pagination();
	}

	while (have_posts()) : the_post();

	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){ ?>
		<div class="span12 content-wrapper">
			<div class="the_content">
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
		</div><!-- end main content end span10-->
	<?php
	}else{ ?>

		<div class="span9 content-wrapper">
			<div class="the_content">
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
		</div><!-- end main content end span10-->
	<?php
	}
	
	endwhile; 
posts_pagination();

	endif;


?>