<?php


/* --------------------------------------------------------------------
			Widget Areas
 -------------------------------------------------------------------- */
function kjd_widget_area_1_callback($visibility){
	echo '<div class="row '.$visibility.' frontpage-component">';
		dynamic_sidebar('front_page_widget_area_1');
	echo '</div>';
}

function kjd_widget_area_2_callback($visibility){
	echo '<div class="row '.$visibility.' frontpage-component">';
		dynamic_sidebar('front_page_widget_area_2');
	echo '</div>';
}

function kjd_widget_area_3_callback($visibility){
	echo '<div class="row '.$visibility.' frontpage-component">';
		dynamic_sidebar('front_page_widget_area_3');
	echo '</div>';
}

/* --------------------------------------------------------------------
			Default Content
 -------------------------------------------------------------------- */
function kjd_frontpage_content($visibility){

    $visibility = $visibility == 'all' ? '' : $visibility;

    $front_page = new Content();


	echo '<div class="'.$visibility.' frontpage-component">';

	if (have_posts()){

		if($pagination_top == 'true'){
			echo new Pagination();
		}


		echo '<div class="content-list">';

		while(have_posts()){

			the_post();
			echo $front_page->kjd_the_content_wrapper();
		}

		echo '</div>';
	}
	echo new Pagination();

	echo '</div>';
}


/* -----------------------------------------------------------------
		Choose layout
------------------------------------------------------------------- */
function kjd_front_page_layout( $components ){

	foreach($components as $position => $component)
	{
        $name = $component->name;
        $visibility = $component->visibility;

		switch( $name ):
			case 'widget_area_1':
				kjd_widget_area_1_callback($visibility);
				break;
			case 'widget_area_2':
				kjd_widget_area_2_callback($visibility);
				break;
			case 'widget_area_3':
				kjd_widget_area_3_callback($visibility);
				break;
			case 'page_content':
				kjd_frontpage_content($visibility);
				break;
            default:
                kjd_frontpage_content($visibility);
                break;
		endswitch;

	}

}



function default_frontpage() {
    ?>
    <div class="section section--body section--frontpage">
    	<div class="container">
    		<div class="jumbotron">
    		  <h1>Please set up your front page!</h1>
    		  <p>And this ugly message goes away</p>
    		  <p>
    		    <a href="wp-admin/admin.php?page=kjd_page_layout_settings&tab=frontPage"class="btn btn-warning btn-large">
    		      Go to your dashboard
    		    </a>
    		  </p>
    		</div>
    	</div>
    </div>
    <?php
}
