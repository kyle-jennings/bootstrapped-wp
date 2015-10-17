<?php
	settings_fields('kjd_'.$section.'_text_settings' );
	$options = get_option('kjd_'.$section.'_text_settings');

	$textElements = array('H1','H2','H3','H4', 'H5');
	if($section == 'pageTitle'){
		unset($textElements[2]);
		// unset($textElements[3]);
		unset($textElements[4]);
	}
	$backgroundStyles = array('none','tabs','squared','pills');
	$decorationStyles = array('none','overline','underline','line-through','text-shadow');
	$borderStyles = array('none','solid','dotted','dashed','double','groove','ridge','inset','outset');
?>

<input  id="dropdown-id" type="hidden"
		name="kjd_<?php echo $section; ?>text_settings[kjd_<?php echo $section; ?>_tab]"
		value="<?php echo $options['kjd_'.$section.'_tab'] ? $options['kjd_'.$section.'_tab'] : 'none'; ?>"
  />
<!-- Tab Navigation-->
  <div class="btn-group tab-switcher ">
	<a class="btn btn-primary dropdown-toggle tab-switcher__dropdown" data-toggle="dropdown" href="#">
		<span class="btn-face">H1</span>
		<span class="caret"></span>
	</a>
    <ul class="dropdown-menu">
		<?php foreach($textElements as $element){
			$active = ($element == 'H1') ? 'class="active"' : '' ;
			echo '<li '.$active.'><a href="#'.$element.'" data-toggle="tab">'.ucwords(str_replace('_','none',$element)).'</a></li>';
		}
		?>
    </ul>
  </div>

<!-- Tabbed content  -->
<div class="tab-content">


	<?php foreach($textElements as $element):
		$active = ($element == 'H1') ? 'active' : '' ;

		$value = $options['kjd_'.$section.'_'.$element];
		if($section =="navbar" && ($element == 'H1' || $element == 'H2' || $element == 'H3' || $element == 'H4')){
			continue;
		}
	?>
	<!-- Start Tab -->
	<div class="tab-pane cf <?php echo $active;?>" id="<?php echo $element;?>">


			<h2><?php echo ucwords(str_replace('_','none',$element)); ?> Settings</h2>
			<!-- font and link colors -->
			<div class="color-option option" style="position: relative;">

				<label>Color</label>

				<input class="minicolors" name="kjd_<?php echo $section;?>_text_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][color]"
					value="<?php echo $value['color'] ? $value['color'] : ''; ?>"/>
				<a class="clearColor">Clear</a>
			</div>


	<div class="option">
		<label>Background Style</label>
		<select name="kjd_<?php echo $section;?>_text_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][bg_style]">
			<?php foreach($backgroundStyles as $style){ ?>
				<option value="<?php echo $style;?>" <?php selected( $value['bg_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?>
				</option>
			<?php } ?>
		</select>
	</div>


	<div class="color_option option" style="position: relative;">
		<label><?php echo $elementName;?> BG Color</label>

		<input class="minicolors"
		name="kjd_<?php echo $section;?>_text_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][bg_color]"
			value="<?php echo $value['bg_color'] ? $value['bg_color'] : 'none'; ?>" />
			<a class="clearColor">Clear</a>
	</div>

	<div class="option">
		<label>Border style</label>
		<select name="kjd_<?php echo $section;?>_text_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][border_style]">
			<?php foreach($borderStyles as $style){?>
				<option value="<?php echo $style;?>"<?php selected( $value['border_style'], $style, true) ?>><?php echo $style;?></option>
			<?php }?>
		</select>
	</div>

	<div class="color_option option" style="position: relative;">

		<label>Border color</label>
		<input type="minicolors" class="minicolors" data-default="none" name="kjd_<?php echo $section;?>_text_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][border_color]"
		value="<?php echo $value['border_color'] ? $value['border_color'] : '' ;?>"
		 />
		<a class="clearColor">Clear</a>
	</div>

	<div class="option">
		<label>Decoration</label>
		<select class="decorationList" name="kjd_<?php echo $section;?>_text_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][decoration]">
			<?php foreach($decorationStyles as $decoration){ ?>
				<option value="<?php echo $decoration;?>" <?php selected( $value['decoration'], $decoration, true) ?>><?php echo $decoration ?></option>
			<?php } ?>
		</select>
	</div>


	<div class="shadowColor option" style="<?php echo $value['decoration'] == 'text-shadow'? 'display:block;' : 'display:none;' ;?>">
		<label>Text-shadow Color</label>

		<input class="minicolors" name="kjd_<?php echo $section;?>_text_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][textShadowColor]"
			value="<?php echo $value['textShadowColor'] ? $value['textShadowColor'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>

	</div> <!-- end tab -->
<?php
		endforeach; //end foreach loop through font and link colors
?>

</div> <!-- end tabbed content -->