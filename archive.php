<?php

$layoutOptions = get_option('kjd_post_layout_settings');
$layoutSettings = $layoutOptions['kjd_post_layouts'];
$layoutSettings = $layoutSettings['kjd_archive'];
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

<div id="pageTitle" class="<?php echo $confineTitleBackground =='true' ? 'container' : '' ;?>">
	<div class="container">
		<h1>
			<?php
			if ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'the-bootstrap' ), '<span>' . get_the_date() . '</span>' );
			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'the-bootstrap' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'the-bootstrap' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
			else :
				_e( 'Blog Archives', 'the-bootstrap' );
			endif; ?>
		</h1>	
	</div> <!-- end page title wrapper-->
</div> <!-- end page title area-->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="pageTitle" class="<?php echo $confineTitleBackground =='true' ? 'container' : '' ;?>">
			<div class="container">
				<h2><?php the_title(); ?></h2>	
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
							<?php the_content(); ?>
						</div>

						<div class="post-meta">

						</div>
					</div><!-- end main content end span9-->

					<!-- sidebar-->
					<div id="sideContent" class="span3 <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
					<?php if(is_active_sidebar('blog-entry') ){  
						dynamic_sidebar('blog-entry');
					 } ?>
					</div><!-- end sidebar content end span3-->

				</div>	<!-- end row -->
			</div> <!-- end container -->
		</div><!-- end body -->	

<?php endwhile; endif;

get_footer();
?>
