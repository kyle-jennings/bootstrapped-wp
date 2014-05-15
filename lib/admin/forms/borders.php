<?php
	settings_fields('kjd_'.$section.'_borders_settings');
	$options = get_option('kjd_'.$section.'_borders_settings'); 
	
	$mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
	$mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];
	$override_nav = $mobileNavSettings['override_nav'];
	if( $override_nav == 'true') {
		$mobilenav_style = $mobileNavSettings['mobilenav_style'];
	}


	$borderRadius = $options['kjd_'.$section.'_border_radius'];

	$borders = array("top","right","bottom","left");
	$corners = array('top-left', 'top-right','bottom-left','bottom-right');
	$borderSizes = range(0,20);
	$borderStyles = array('none','solid','dotted','dashed','double','groove','ridge','inset','outset');
?>
<input  id="dropdown-id" type="hidden"
		name="kjd_<?php echo $section; ?>_border_settings[kjd_<?php echo $section; ?>_tab]"
		value="<?php echo $options['kjd_'.$section.'_tab'] ? $options['kjd_'.$section.'_tab'] : 'none'; ?>"
  />

<h2>Border style and colors</h2>

<!-- Tab Navigation-->
  <div class="btn-group ">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="btn-face">Top</span>
		<span class="caret"></span>
	</a>
    <ul class="dropdown-menu">
<?php
	$tabs = array("top","right","bottom","left", "border-radius");
	foreach($tabs as $border){  
		$active = ($border == 'top') ? 'class="active"' : '' ;
		echo '<li '.$active.'><a href="#'.$border.'" data-toggle="tab">'.ucwords($border).'</a></li>';
	}
?>
    </ul>
  </div>

<div class="tab-content">
<?php foreach($borders as $border):

	$borderValue = $options['kjd_'.$section.'_'.$border.'_border'];
	$color = $options['kjd_'.$section.'_'.$border.'_border']['color'];
	$size = $options['kjd_'.$section.'_'.$border.'_border']['size'];
	$style = $options['kjd_'.$section.'_'.$border.'_border']['style'];

	$active = ($border == 'top') ? 'active' : '' ;
?>

<div class="tab-pane cf <?php echo $active;?>" id="<?php echo $border;?>">			
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
	</div><!-- end border tabb -->
<?php 
	endforeach;
?>
		
<div class="tab-pane cf" id="border-radius">	
		<div class="optionsWrapper float-options">
		<!-- border radius -->
		<h2>Border Radius</h2>
		<?php 		
			foreach($corners as $corner):
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

		<?php
			endforeach;
		?>
			
	</div><!-- end options wrapper -->
</div><!-- end final tab -->


</div><!-- end tabbed container -->