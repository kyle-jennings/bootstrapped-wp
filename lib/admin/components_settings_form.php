<?php	
		settings_fields( 'kjd_'.$section.'_forms_settings' );
		$options = get_option('kjd_'.$section.'_forms_settings'); 
		$sectionSettings = $options['kjd_'.$section.'_forms'];
		$imageSettings = $sectionSettings['kjd_image_border'];
		$borderSizes = range(1,20);
		$borderStyles = array('none','solid','dotted','dashed','double','groove','ridge','inset','outset');

		$tabParts = array('tabbed_content_background','tabbed_content_border','tabbed_content_text_color','active_tab_background','active_tab_link_color','inactive_tab_background', 'inactive_tab_link_color','hovered_tab_background','hovered_tab_link_color');
		$collapsibleParts = array('collapible_content_background','collapible_content_border','collapible_content_text_color','active_title_background','active_title_link_color','inactive_title_background', 'inactive_title_link_color','hovered_title_background','hovered_title_link_color');
		$tableParts = array('table_header_background','table_border','table_header_text_color','even_row_background','even_row_link_color','even_row_text_color','odd_row_background', 'odd_row_link_color','odd_row_text_color','hovered_row_background','hovered_row_link_color');
		$formParts =array('form_background','form_border','field_background','field_border','field_glow','field_text', 'button_background','button_background_end','button_border','button_text');
		$thumbnailParts =array('thumbnail_background','thumbnail_glow','thumbnail_border');
		$paginationParts =array('pagination_border','pagination_background','pagination_text','pagination_link','pagination_hover');
?>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-pills">
    <li class="active"><a href="#tabs" data-toggle="tab">Tabbed Content</a></li>
    <li><a href="#collapsibles" data-toggle="tab">Collapsibles</a></li>
    <li><a href="#tables" data-toggle="tab">Tables</a></li>
    <li><a href="#thumbnails" data-toggle="tab">Images</a></li>
    <li><a href="#forms" data-toggle="tab">Forms</a></li>
    <li><a href="#pagination" data-toggle="tab">Pagination</a></li>

  </ul>

  <div class="tab-content">
  
    <div class="tab-pane active" id="tabs">
     <h3>Tabbed Content</h3>
	<?php foreach($tabParts as $part){ ?>

		<div class="option" style="position: relative;">

			<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
			<input class="minicolors" name="kjd_<?php echo $section; ?>_forms_settings[kjd_<?php echo $section; ?>_forms][<?php echo $part;?>]" value="<?php echo $sectionSettings[$part] ? $sectionSettings[$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
	<?php
	}

	?>
    </div>

    <div class="tab-pane" id="collapsibles">
      	<h3>Collapsibles</h3>
	<?php foreach($collapsibleParts as $part){ ?>

		<div class="option" style="position: relative;">

			<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
			<input class="minicolors" name="kjd_<?php echo $section; ?>_forms_settings[kjd_<?php echo $section; ?>_forms][<?php echo $part;?>]" value="<?php echo $sectionSettings[$part] ? $sectionSettings[$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
	<?php
	}

	?>
    </div>

    <div class="tab-pane" id="tables">
      	<h3>Tables</h3>
	<?php foreach($tableParts as $part){ ?>

		<div class="option" style="position: relative;">

			<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
			<input class="minicolors" name="kjd_<?php echo $section; ?>_forms_settings[kjd_<?php echo $section; ?>_forms][<?php echo $part;?>]" value="<?php echo $sectionSettings[$part] ? $sectionSettings[$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
	<?php
	}
	?>
    </div>

    <div class="tab-pane" id="thumbnails">
      	<h3>Thumbnails</h3>
	<?php foreach($thumbnailParts as $part){ ?>

		<div class="option" style="position: relative;">

			<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
			<input class="minicolors" name="kjd_<?php echo $section; ?>_forms_settings[kjd_<?php echo $section; ?>_forms][<?php echo $part;?>]" value="<?php echo $sectionSettings[$part] ? $sectionSettings[$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
	<?php
	}


	?>

		<h2>Normal Images</h2>
		<div class="option" style="position: relative;">
		<div class="option">
		<label>Background color</label>
		<input class="minicolors" 
		name="kjd_<?php echo $section;?>_forms_settings[kjd_<_color?php echo $section;?>_forms][kjd_image_background_color]"
			value="<?php echo $sectionSettings['kjd_image_background_color'] ? $sectionSettings['kjd_image_background_color'] : '' ;?>"
			 />		
			<a class="clearColor">Clear</a>
		</div> 

		<label>Border color</label>
		<input class="minicolors" 
		name="kjd_<?php echo $section;?>_forms_settings[kjd_<?php echo $section;?>_forms][kjd_image_border][color]"
			value="<?php echo $imageSettings['color'] ? $imageSettings['color'] : '' ;?>"
			 />		
			<a class="clearColor">Clear</a>
		</div> 

		<!-- border size -->
		<div class="option">
			<label>Border size</label>
			<select name="kjd_<?php echo $section;?>_forms_settings[kjd_<?php echo $section;?>_forms][kjd_image_border][size]">
				<?php foreach($borderSizes as $size){?>
					<option value="<?php echo $size.'px';?>" <?php selected( $imageSettings['size'], $size.'px', true) ?>><?php echo $size.'px';?></option>
				<?php }?>
			</select>
		</div>

		<!-- border style -->
		<div class="option">
			<label>Border style</label>
			<select name="kjd_<?php echo $section;?>_forms_settings[kjd_<?php echo $section;?>_forms][kjd_image_border][style]">
				<?php foreach($borderStyles as $style){?>
					<option value="<?php echo $style;?>"<?php selected( $imageSettings['style'], $style, true) ?>><?php echo $style;?></option>
				<?php }?>
			</select>
		</div>

		<div class="option">
			<label>Padding</label>
			<select
		name="kjd_<?php echo $section;?>_forms_settings[kjd_<?php echo $section;?>_forms][kjd_image_padding]">
				<?php foreach($borderSizes as $size){?>
					<option value="<?php echo $size.'px';?>"<?php selected( $sectionSettings['kjd_image_padding'], $size.'px', true) ?>><?php echo $size.'px';?></option>
				<?php }?>
			</select>
		</div>

		<div class="option">
			<label>Border Radius</label>
			<select name="kjd_<?php echo $section;?>_forms_settings[kjd_<?php echo $section;?>_forms][kjd_image_radius]">
				<?php foreach($borderSizes as $size){?>
					<option value="<?php echo $size.'px';?>"<?php selected( $sectionSettings['kjd_image_radius'], $size.'px', true) ?>><?php echo $size.'px';?></option>
				<?php }?>
			</select>
		</div>

    </div>

    <div class="tab-pane" id="forms">
     <h3>Forms</h3>
<?php foreach($formParts as $part){ ?>

		<div class="option" style="position: relative;">

			<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
			<input class="minicolors" name="kjd_<?php echo $section; ?>_forms_settings[kjd_<?php echo $section; ?>_forms][<?php echo $part;?>]" value="<?php echo $sectionSettings[$part] ? $sectionSettings[$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
	<?php
	}
	?>
    </div>

    <div class="tab-pane" id="pagination">
     <h3>Forms</h3>
	<?php foreach($paginationParts as $part){ ?>

		<div class="option" style="position: relative;">

			<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
			<input class="minicolors" name="kjd_<?php echo $section; ?>_forms_settings[kjd_<?php echo $section; ?>_forms][<?php echo $part;?>]" value="<?php echo $sectionSettings[$part] ? $sectionSettings[$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
	<?php
	}
	?>
    </div>

  </div>
</div>

<div class="optionsWrapper">
</div>
