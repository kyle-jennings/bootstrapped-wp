<?php
/*
Template Name: Page Template 6
*/
	$options = get_option('kjd_page_layout_settings');
	$pageLayoutSettings = $options['kjd_page_layouts'];
	$layoutSettings = $options['kjd_page_layouts']['kjd_template_6'];

	$bodySettings = get_option('kjd_body_misc_settings');
	$bodySettings = $bodySettings['kjd_body_misc'];	
	$confineBodyBackground = $bodySettings['kjd_body_confine_background'];

	$pageTitleSettings = get_option('kjd_pageTitle_misc_settings');
	$pageTitleSettings = $pageTitleSettings['kjd_pageTitle_misc'];
	$confineTitleBackground = $pageTitleSettings['kjd_pageTitle_confine_background'];


get_header();

?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="pageTitle" class="<?php echo $confineTitleBackground =='true' ? 'container confined' : '' ;?>">
			<div class="container">
				<h1><?php the_title(); ?></h1>	
			</div> <!-- end page title wrapper-->
		</div> <!-- end page title area-->

<?php

	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){ 
	?>
		<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
			<div class="container">
		<?php 
		if($layoutSettings['position'] =='top'){ ?>
			<div id="sideContent" class="row <?php deviceViewSettings($layoutSettings['deviceView']); ?>" style="margin-bottom:10px;">		
				<?php if(is_active_sidebar('kjd_template_6') ){  
					dynamic_sidebar('kjd_template_6');
				 } ?>
			</div><!-- end sidebar content end-->
		<?php
		}
		?>
				<div class="theContent">
					<?php the_content(); ?>
				</div>
		<?php 
		if($layoutSettings['position'] =='bottom'){ ?>
			<div id="sideContent" class="row <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
				<?php if(is_active_sidebar('kjd_template_6') ){  
					dynamic_sidebar('kjd_template_6');
				 } ?>
			</div><!-- end sidebar content end-->
		<?php
		}
		?>
			</div> <!-- end container -->
		</div><!-- end body -->	

	<?php
	}else{ ?>

		<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
			<div class="container">
				<div class="row">	
				<?php if($layoutSettings['position'] =='right'){ ?>
					<div id="mainContent" class="span9">
						<div class="theContent">
							<?php the_content(); ?>
						</div>
					</div><!-- end main content end span9-->
				<?php } ?>

					<div id="sideContent" class="span3 <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
					<?php if(is_active_sidebar('kjd_template_6') ){  
						dynamic_sidebar('kjd_template_6');
					 } ?>
					</div><!-- end sidebar content end span3-->

				<?php if($layoutSettings['position'] =='left'){ ?>
					<div id="mainContent" class="span9">
						<div class="theContent">
							<?php the_content(); ?>
						</div>
					</div><!-- end main content end span9-->
				<?php } ?>	
				</div>	<!-- end row -->
			</div> <!-- end container -->
		</div><!-- end body -->	

	<?php	
	} 

?>

<?php endwhile; else: ?> 
		<div id="pageTitle" class="<?php echo $confineTitleBackground =='true' ? 'container confined' : '' ;?>">
			<div class="container">
				<h1> Content not found..</h1>	
			</div> <!-- end page title wrapper-->
		</div> <!-- end page title area-->
<?php 

	if($layoutSettings!= 'right' && $layoutSettings !='left'){ ?>

		<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
			<div class="container">
				<div class="row">	
					<div id="mainContent" class="span12">
						<div class="theContent">
							<?php the_content(); ?>
						</div>
					</div><!-- end main content end span9-->
				</div>	<!-- end row -->
				<div class="row">
				<div id="sideContent" class="span12 <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
					<?php if(is_active_sidebar('kjd_template_6') ){  
						dynamic_sidebar('kjd_template_6');
					 } ?>
					</div><!-- end sidebar content end span3-->
				</div>
			</div> <!-- end container -->
		</div><!-- end body -->	

	<?php
	}else{ ?>

		<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
			<div class="container">
				<div class="row">	
					<div id="mainContent" class="span9" <?php layoutSettings($layoutSettings['position']);?>>
						<div class="theContent">
							<?php the_content(); ?>
						</div>
					</div><!-- end main content end span9-->
					<div id="sideContent" class="span3 <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
					<?php if(is_active_sidebar('kjd_template_6') ){  
						dynamic_sidebar('kjd_template_6');
					 } ?>
					</div><!-- end sidebar content end span3-->
				</div>	<!-- end row -->
			</div> <!-- end container -->
		</div><!-- end body -->	

	<?php	
	}

endif;?>
<?php
get_footer();
?>
