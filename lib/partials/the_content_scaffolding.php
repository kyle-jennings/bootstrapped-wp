
<?php

if (have_posts()) :

	echo kjd_get_the_title();

	if($pagination_top == 'true'){
		posts_pagination();
	}
?>
<div id="body" class="<?php echo $confineBodyBackground =='true' ? 'container confined' : '' ;?>">
	<div class="container">
		<div class="row">	
<?php
 while (have_posts()) : the_post(); 
	
		if($layoutSettings['position'] =='top' || $layoutSettings['position'] =='bottom' || $layoutSettings['position'] =='none' ){
			$widthClass = 'span12';
		}else{
			$widthClass = 'span9';
		}

		 if($layoutSettings['position'] =='top' || $layoutSettings['position'] =='left'){ 
			echo ($layoutSettings['position'] =='top') ? kjd_get_sidebar($sidebar,'horizontal',$layoutSettings['position']) : kjd_get_sidebar($sidebar);
		} 
	?>

		<div id="mainContent" class="<?php echo $widthClass?>">
			<div class="content-wrapper">
				<div clas="the-content">
					<?php kjd_the_content();?>
				</div>
			</div>

		</div><!-- end main content end span9-->

	<?php
		 if($layoutSettings['position'] =='bottom' || $layoutSettings['position'] =='right'){ 
			echo ($layoutSettings['position'] =='bottom') ? kjd_get_sidebar($sidebar,'horizontal',$layoutSettings['position']) : kjd_get_sidebar($sidebar);
		} 
		
	?>


<!-- </div></div> -->

<?php

 	endwhile; 
	echo posts_pagination();

?>
		</div>	<!-- end row -->
	</div> <!-- end container -->
</div><!-- end body -->	
<?php
else: ?> 
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
					<?php //echo kjd_get_sidebar($sidebar); ?>
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
					<?php //echo kjd_get_sidebar($sidebar); ?>
					</div><!-- end sidebar content end span3-->
				</div>	<!-- end row -->
			</div> <!-- end container -->
		</div><!-- end body -->	

	<?php	
	}

endif;