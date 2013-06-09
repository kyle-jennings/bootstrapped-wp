<?php

$layoutOptions = get_option('kjd_post_layout_settings');
$layoutSettings = $layoutOptions['kjd_post_layouts'];
$layoutSettings = $layoutSettings['kjd_attachment'];
$position = $layoutSettings['position'];
$span = $position == 'left' || $position == 'right'? 'span9' : 'span12' ;

$bodySettings = get_option('kjd_body_misc_settings');
$bodySettings = $bodySettings['kjd_body_misc'];	
$confineBodyBackground = $bodySettings['kjd_body_confine_background'];
$confine = $confineBodyBackground =='true' ? 'container' : '';

$pageTitleSettings = get_option('kjd_pageTitle_misc_settings');
$pageTitleSettings = $pageTitleSettings['kjd_pageTitle_misc'];
$confineTitleBackground = $pageTitleSettings['kjd_pageTitle_confine_background'];


get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="pageTitle" class="<?php echo $confineTitleBackground =='true' ? 'container' : '' ;?>">
			<div class="container">
				<h1><?php the_title(); ?></h1>	
			</div> <!-- end page title wrapper-->
		</div> <!-- end page title area-->


		<div id="body" class="<?php echo $confine;?>">
			<div class="container">
				<div class="row">	
					<!-- main content -->
					<div id="mainContent" class="<?php echo $span;?>" >
						<div class="post-info">
							<span class="post-date">
								Posted on: <a href=""><?php the_date(); ?></a>, 
							</span>
							<span class="post-author">
								By: <a href=""><?php the_author(); ?></a>
							</span>
						</div>

						<div class="post-content">
							<?php// the_content(); ?>
							<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
							        <p class="attachment"><a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
							        </p>
							<?php endif; 
								if(!empty($post->post_content))
								{
									echo '<p class="excerpt">'.$post->post_content.'</p>';
								}
							?>							
						</div>

						<div class="post-meta">

						</div>
					</div><!-- end main content end span9-->

					<!-- sidebar-->
					<div id="sideContent" class="span3 <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
					<?php if(is_active_sidebar('attachment') ){  
						dynamic_sidebar('attachment');
					 } ?>
					</div><!-- end sidebar content end span3-->

				</div>	<!-- end row -->
			</div> <!-- end container -->
		</div><!-- end body -->	

<?php endwhile; endif;

get_footer();
?>

