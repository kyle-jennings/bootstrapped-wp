<?php

get_header();



$site_options = get_option('bswp_site_settings');
$layout_settings = $site_options['layouts'];
$sidebar_pos = $layout_settings['sidebars']['frontpage_sidebar_location'];
$sidebar_vis = $layout_settings['sidebars']['frontpage_sidebar_visibility'];

$components = $layout_settings['frontpage']['frontpage_layout_sortable'];
$components = json_decode($components);

$output = '';

$main_width = ($sidebar_pos == 'left' || $sidebar_pos == 'right') ? 'span9' : 'span12';
if(!empty($components)) {
?>

    <div class="section section--body section--frontpage">
        <div class="container">
            <div class="row">
                <?php

                if($sidebar_pos == 'top' || $sidebar_pos == 'left')
                    echo new Sidebar('frontpage', $sidebar_pos, $sidebar_vis);


                echo '<div id="main-content" class="'.$main_width.'">';
                    kjd_front_page_layout( $components );
                echo '</div>';

                if($sidebar_pos == 'right' || $sidebar_pos == 'bottom')
                    echo new Sidebar('frontpage', $sidebar_pos, $sidebar_vis);


                ?>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>  <!-- body -->
<?php
	// echo $output;
}else{
 default_frontpage();
}


get_footer(); // End page, start function
