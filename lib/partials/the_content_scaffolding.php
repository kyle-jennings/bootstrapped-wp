<?php
function kjd_get_the_content()
{
		ob_start();
			the_content();
			$buffered_content = ob_get_contents();
		ob_end_clean();
		$the_content_markup = '<div class="the_content">';
		$the_content_markup .= $buffered_content;
		$the_content_markup .= '</div>';

		return $the_content_markup;
}

function kjd_get_the_title()
{
	$class= ($confineTitleBackground =='true') ? 'container confined' : '' ;
	$the_title_markup ='<div id="pageTitle" class="'.$class.'">';
	$the_title_markup .= '<div class="container">';
	$the_title_markup .= '<h1>'.get_the_title().'</h1>';
	$the_title_markup .=  '</div></div>';
	
	return $the_title_markup;
}

function kjd_get_the_post_info()
{
	$the_post_info_markup =	'<div class="post-info">';
	$the_post_info_markup .='<span class="post-date">';
	$the_post_info_markup .= 'Posted on: <a href="">'.get_the_date().'</a>, </span>';
	$the_post_info_markup .='<span class="post-author">';
	$the_post_info_markup .='By: <a href="">'.get_the_author().'</a>';
	$the_post_info_markup .= '</span></div>';

	return $the_post_info_markup;
}

function kjd_get_sidebar($sidebar, $location = null)
{
$location_class = $location == 'horizontal' ? 'row' : 'span3' ;
	ob_start();
		dynamic_sidebar($sidebar);
		$the_buffered_sidebar = ob_get_contents();
	ob_end_clean();
	$the_sidebar_markup = '<div id="sideContent" class="'.$location_class.' '.$location.'-widgets '.deviceViewSettings($layoutSettings['deviceView']).'">';
	$the_sidebar_markup .= $the_buffered_sidebar;
	$the_sidebar_markup .= '</div>';


	// return $the_buffered_sidebar;
	return $the_sidebar_markup;
}
echo kjd_get_the_title();

if (have_posts()) : while (have_posts()) : the_post(); 

	if($layoutSettings['position'] != 'right' && $layoutSettings['position'] !='left'){ 
	?>
		<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
			<div class="container">
				<div class="content_wrapper">
					<div clas-"the_content">
						<?php 
						if($layoutSettings['position'] =='top'){
							echo kjd_get_sidebar($sidebar,'horizontal');
						}

						if(is_single()){
							echo kjd_get_the_post_info();
						}

						if(get_the_content()){
							echo kjd_get_the_content();	
						}
						

						if($layoutSettings['position'] =='bottom'){ 
							echo kjd_get_sidebar($sidebar,'horizontal');
						}
						?>
					</div>
				</div>
			</div> <!-- end container -->
		</div><!-- end body -->	

	<?php
	}else{ ?>

		<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
			<div class="container">
				<div class="row">	


					<?php if($layoutSettings['position'] =='left'){ 
						echo kjd_get_sidebar($sidebar); 
					} ?>

					<div id="mainContent" class="span9">
						<?php echo kjd_get_the_content(); ?>
					</div><!-- end main content end span9-->


					<?php if($layoutSettings['position'] =='right'){ 
						echo kjd_get_sidebar($sidebar); 
					} ?>
				
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
							Nothing to see here. Move along.
						</div>
					</div><!-- end main content end span9-->
				</div>	<!-- end row -->
				<div class="row">
				<div id="sideContent" class="span12 <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
					<?php echo kjd_get_sidebar($sidebar); ?>
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
							Nothing to see here. Move along.
						</div>
					</div><!-- end main content end span9-->
					<div id="sideContent" class="span3 <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
					<?php echo kjd_get_sidebar($sidebar); ?>
					</div><!-- end sidebar content end span3-->
				</div>	<!-- end row -->
			</div> <!-- end container -->
		</div><!-- end body -->	

	<?php	
	}

endif;