<?php
	settings_fields('kjd_'.$section.'_links_settings' );
	$options = get_option('kjd_'.$section.'_links_settings'); 

	$linkElements = array('Normal Link' => 'link','Hovered Link' => 'linkHovered','Active Link' => 'linkActive','Visited Link' => 'linkVisited');
	
	$backgroundStyles = array('none','highlighted','pills');
	$decorationStyles = array('none','overline','underline','line-through','text-shadow','outline');
?>


	<?php foreach($linkElements as $elementName => $element){  
		
		$value = $options['kjd_'.$section.'_'.$element];
					
		if(($section =="navbar" || $section =="dropdown-menu") && $element == 'linkVisited'){
			continue;
		}
	?>
<div class="options-wrapper float-options"> <!-- started background stuff-->
		<h2><?php echo ucwords($elementName); ?> Settings</h2>
		<!-- font and link colors -->
		<div class="color-option option">

			<label>Color</label>

			<input class="minicolors" name="kjd_<?php echo $section;?>_links_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][color]" 
				value="<?php echo $value['color'] ? $value['color'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		
	<div class='full-option'>		
	
	<?php if($section !='navbar' && $section != 'dropdown-menu'){ ?>
		<div class="option">
			<label>Background Style</label>
			<select name="kjd_<?php echo $section;?>_links_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][bg_style]">
				<?php foreach($backgroundStyles as $style){ ?>
					<option value="<?php echo $style;?>" <?php selected( $value['bg_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?>
					</option>
				<?php } ?>
			</select>
		</div>
		<?php
		}
		?>

		<div class="color_option option" style="position: relative;">
			<label><?php echo $elementName;?> BG Color</label>

			<input class="minicolors" 
			name="kjd_<?php echo $section;?>_links_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][bg_color]" 
				value="<?php echo $value['bg_color'] ? $value['bg_color'] : 'none'; ?>" />
				<a class="clearColor">Clear</a>
		</div>		
	
	</div> <!-- end bg colors -->

	<div class='full-option'>
		<div class="option">
			<label>Decoration</label>
			<select class="decorationList" name="kjd_<?php echo $section;?>_links_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][decoration]">
				<?php foreach($decorationStyles as $decoration){ ?>
					<option value="<?php echo $decoration;?>" <?php selected( $value['decoration'], $decoration, true) ?>><?php echo $decoration ?></option>
				<?php } ?>
			</select>
		</div>

		<div class="shadowColor color_option option" style="<?php echo $value['decoration'] == 'text-shadow'? 'display:block;' : 'display:none;' ;?>">
			<label>Text-shadow Color</label>
			<input class="minicolors" name="kjd_<?php echo $section;?>_links_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][textShadowColor]" 
				value="<?php echo $value['textShadowColor'] ? $value['textShadowColor'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
	</div> <!-- end decoration -->

	<div class='full-option'>
		<?php if($section == "navbar"){ ?>
		<div class="color_option option" style="position: relative;">
			<label><?php echo $elementName;?> Border Color</label>

			<input class="minicolors" 
			name="kjd_<?php echo $section;?>_links_settings[kjd_<?php echo $section;?>_<?php echo $element;?>][border_color]" 
				value="<?php echo $value['border_color'] ? $value['border_color'] : 'none'; ?>" />
				<a class="clearColor">Clear</a>
		</div>
		<?php
			}
		 ?>
	</div> <!-- end border-->

</div> <!-- end wrapper-->
<?php
		} //end foreach loop through font and link colors 
