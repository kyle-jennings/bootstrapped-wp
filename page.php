<?php


	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];	
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

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

		<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container' : '' ;?>">
			<div class="container">
				<div class="row">	
					<div id="mainContent" class="span12">
						<div class="theContent">
							<?php the_content(); ?>
						</div>
					</div><!-- end main content end span9-->
				</div>	<!-- end row -->
			</div> <!-- end container -->
		</div><!-- end body -->	

<?php endwhile; else: ?> 
		<div id="pageTitle" class="<?php echo $confineTitleBackground =='true' ? 'container' : '' ;?>">
			<div class="container">
				<h1> Content not found..</h1>	
			</div> <!-- end page title wrapper-->
		</div> <!-- end page title area-->

		<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container' : '' ;?>">
			<div class="container">
				<div class="row">	
					<div id="mainContent" class="span12">
						<div class="theContent">
							Nothing to see here!
						</div>
					</div><!-- end main content end span10-->

				</div><!-- end row -->
			</div> <!-- end container -->
		</div><!-- end body -->	

<?php endif;?>
<?php
get_footer();
?>
