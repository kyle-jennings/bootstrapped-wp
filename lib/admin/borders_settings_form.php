<?php
	settings_fields('kjd_'.$section.'_borders_settings');
	$options = get_option('kjd_'.$section.'_borders_settings'); 

	$borderRadius = $options['kjd_'.$section.'_border_radius'];

	// $generalSettings = get_option('kjd_general_settings');
	// $confinePage = $generalSettings['kjd_confine_page'];
	// if($confinePage == 'true'){ 

	// }else{

	// }
	$confinePage ='true';
	$borders = array("top","right","bottom","left");
	$corners = array('top-left', 'top-right','bottom-left','bottom-right');
	$borderSizes = range(0,20);
	$borderStyles = array('none','solid','dotted','dashed','double','groove','ridge','inset','outset');
?>
		<!--**************-->
		<!-- Border stuff -->
		<!--***************-->
		<h2>Border style and colors</h2>

			<?php foreach($borders as $border){ 

				$borderValue = $options['kjd_'.$section.'_'.$border.'_border'];
				$color = $options['kjd_'.$section.'_'.$border.'_border']['color'];
				$size = $options['kjd_'.$section.'_'.$border.'_border']['size'];
				$style = $options['kjd_'.$section.'_'.$border.'_border']['style'];

			?>
			
		<div class="optionsWrapper float-options">
			<h3><?echo ucfirst($border);?> Border</h3>
			<!-- border color -->
			<div class="color-option option" style="position: relative;">

				<label>Border color</label>
				<input class="minicolors" name="kjd_<?php echo $section;?>_borders_settings[kjd_<?php echo $section;?>_<?php echo $border;?>_border][color]"
				value="<?php echo $color ? $color : '' ;?>"
				 />		
				<a class="clearColor">Clear</a>
			</div> 

			<!-- border size -->
			<div class="option">
				<label>Border size</label>
				<select name="kjd_<?php echo $section;?>_borders_settings[kjd_<?php echo $section;?>_<?php echo $border;?>_border][size]">
					<?php foreach($borderSizes as $size){?>
						<option value="<?php echo $size.'px';?>" <?php selected( $borderValue['size'], $size.'px', true) ?>><?php echo $size.'px';?></option>
					<?php }?>
				</select>
			</div>

			<!-- border style -->
			<div class="option">
				<label>Border style</label>
				<select name="kjd_<?php echo $section;?>_borders_settings[kjd_<?php echo $section;?>_<?php echo $border;?>_border][style]">
					<?php foreach($borderStyles as $style){?>
						<option value="<?php echo $style;?>"<?php selected( $borderValue['style'], $style, true) ?>><?php echo $style;?></option>
					<?php }?>
				</select>
			</div>
			
		</div><!-- end options wrapper -->

			<?php }	?>


		<div class="optionsWrapper float-options">
						<!-- border radius -->
			<h2>Border Radius</h2>
			<?php 
			if($confinePage == 'true'){ 			
			foreach($corners as $corner){ 
			?>
			
			<div class="option">
				<label><?php echo ucwords(str_replace('-',' ',$corner)); ?></label>
				<select name="kjd_<?php echo $section;?>_borders_settings[kjd_<?php echo $section; ?>_border_radius][<?php echo $corner; ?>]">
					<?php foreach($borderSizes as $radius){?>
						<option value="<?php echo $radius.'px';?>" <?php selected( $borderRadius[$corner], $radius.'px', true) ?>><?php echo $radius.'px';?>
						</option>
					<?php }?>
				</select>
			</div>

			<?php } } ?>
			
		</div><!-- end options wrapper -->
