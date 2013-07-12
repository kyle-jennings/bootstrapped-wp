<?php

function kjd_get_the_title($content_type)
{
	$the_title_markup ='<div id="pageTitle" class="<?php echo $confineTitleBackground ==\'true\' ? \'container confined\' : \'\' ;?>">';
	$the_title_markup .= '<div class="container"><h1>';
	if($content_type == 'archives'){

		if ( is_day() ) :
			$the_title_markup .= 'Daily Archives: <span>'.get_the_date() . '</span>';
		elseif ( is_month() ) :
			$the_title_markup .= 'Monthly Archives: <span>' . get_the_date( 'F Y' ) . '</span>';
		elseif ( is_year() ) :
			$the_title_markup .= 'Yearly Archives: <span>' . get_the_date( 'Y' ) . '</span>';
		else :
			$the_title_markup .= 'Blog Archives';
		endif;		
	}elseif($content_type =='category'){
		$the_title_markup .= get_the_title();
	}

	$the_title_markup .=  '</h1></div></div>';

	
	return $the_title_markup;
}

	echo kjd_get_the_title($content_type);

 if (have_posts()) : while (have_posts()) : the_post(); ?>


		<div id="body" class="<?php echo $confine;?>">
			<div class="container">
				<div class="row">	
					<!-- main content -->
					<div id="mainContent" class="<?php echo $span;?>" >
						<div class="row">
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
							</div><!-- end content wrapper-->

							<!-- sidebar-->
							<div id="sideContent" class="span3 <?php deviceViewSettings($layoutSettings['deviceView']); ?>">		
							<?php if(is_active_sidebar('blog-entry') ){  
								dynamic_sidebar('blog-entry');
							 } ?>
							</div><!-- end sidebar content end span3-->
					</div> <!-- end row -->
				</div>	<!-- end main content -->
			</div> <!-- end container -->
		</div><!-- end body -->	

<?php endwhile; endif;