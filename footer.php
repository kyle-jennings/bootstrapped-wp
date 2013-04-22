<?php

$sidebars = wp_get_sidebars_widgets();
$footerWidgetCount =  count( $sidebars['footer-widgets'] );

	$footerSettings = get_option('kjd_footer_misc_settings');
	$footerSettings = $footerSettings['kjd_footer_misc'];
	$confineFooterBackground = $footerSettings['kjd_footer_confine_background'];	

?>
		<div id="push"></div>
	</div> <!-- end pageWrapper-->
	<div id="footer" <?php echo $confineFooterBackground == 'true' ? 'class="container"': '' ; ?>>
		<div class="container">
			<ul class="row widgetsWrapper">
				<?php if(is_active_sidebar('footer_widgets') ){  
					dynamic_sidebar('footer_widgets');
				 } ?>
			</ul>
		</div> <!-- End of container-->
	</div> <!-- End of footer-->
<?php wp_footer(); ?>
</body>
</html>