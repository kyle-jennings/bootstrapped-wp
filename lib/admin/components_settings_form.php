<?php	
		settings_fields( 'kjd_'.$section.'_components_settings' );
		$options = get_option('kjd_'.$section.'_components_settings'); 
		$sectionSettings = $options['kjd_'.$section.'_components'];

		$tabParts = array('tabbed_content_background','tabbed_content_border','tabbed_content_text_color','active_tab_background','active_tab_link_color','inactive_tab_background', 'inactive_tab_link_color','hovered_tab_background','hovered_tab_link_color');
		$collapsibleParts = array('collapible_content_background','collapible_content_border','collapible_content_text_color','active_title_background','active_title_link_color','inactive_title_background', 'inactive_title_link_color','hovered_title_background','hovered_title_link_color');
		$tableParts = array('table_header_background','table_border','table_header_text_color','even_row_background','even_row_link_color','even_row_text_color','odd_row_background', 'odd_row_link_color','odd_row_text_color','hovered_row_background','hovered_row_link_color','hovered_row_text_color');
		$formParts =array('form_background','form_border','form_text','field_background','field_border','field_glow','field_text', 'button_background','button_background_end','button_border','button_text');		
		$paginationParts =array('pagination_border','pagination_background','pagination_text','pagination_link','pagination_hover_background','pagination_hover_link', 'pagination_current_background','pagination_current_text');
?>
	<input type="hidden" id="active_tab" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][tabID]" 
value="<?php echo $sectionSettings['tabID'] ? $sectionSettings['tabID'] : 'none'; ?>"  />		
  <script>
  	jQuery(document).ready(function(){
  		jQuery('.tabbable a[href="#<?php echo $sectionSettings["tabID"]; ?>"]').tab('show');
  	});
  </script>


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
			<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][tabbed_content][<?php echo $part;?>]" value="<?php echo $sectionSettings['tabbed_content'][$part] ? $sectionSettings['tabbed_content'][$part] : 'none'; ?>"  />		
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
			<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][collapsible_content][<?php echo $part;?>]" value="<?php echo $sectionSettings['collapsible_content'][$part] ? $sectionSettings['collapsible_content'][$part] : 'none'; ?>"  />		
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
			<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][table_content][<?php echo $part;?>]" value="<?php echo $sectionSettings['table_content'][$part] ? $sectionSettings['table_content'][$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
	<?php
	}
	?>
    </div>

    <div class="tab-pane" id="thumbnails">
 <?php imagesFormFields($section,$sectionSettings); ?>

    </div>

    <div class="tab-pane" id="forms">
     <h3>Forms</h3>
<?php foreach($formParts as $part){ ?>

		<div class="option" style="position: relative;">

			<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
			<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][forms][<?php echo $part;?>]" value="<?php echo $sectionSettings['forms'][$part] ? $sectionSettings['forms'][$part] : 'none'; ?>"  />		
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
			<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][pagination][<?php echo $part;?>]" value="<?php echo $sectionSettings['pagination'][$part] ? $sectionSettings['pagination'][$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
	<?php
	}
	?>
    </div>

  </div>
</div>

<?php 
function imagesFormFields($section,$sectionSettings){
	$borderSizes = range(0,20);
	$borderStyles = array('none','solid','dotted','dashed','double','groove','ridge','inset','outset');

	foreach(array('thumbnails','images') as $image_type){
		?>

		<h2><?php echo ucwords($image_type);?></h2>
			<div class="option">
			<label>Background color</label>
			<input class="minicolors" 
			name="kjd_<?php echo $section;?>_components_settings[kjd_<?php echo $section;?>_components][<?php echo $image_type;?>][background_color]"
				value="<?php echo $sectionSettings[$image_type]['background_color'] ? $sectionSettings[$image_type]['background_color'] : '' ;?>"
				 />		
				<a class="clearColor">Clear</a>
			</div> 
			<div class="option">
			<label>Border color</label>
			<input class="minicolors" 
			name="kjd_<?php echo $section;?>_components_settings[kjd_<?php echo $section;?>_components][<?php echo $image_type;?>][border_color]"
				value="<?php echo $sectionSettings[$image_type]['border_color'] ? $sectionSettings[$image_type]['border_color'] : '' ;?>"
				 />		
			<a class="clearColor">Clear</a>
		</div> 
		<?php
		if($image_type =='thumbnails'){
			?>
			<div class="option">
			<label>Thumbnail Hover Glow</label>
			<input class="minicolors" 
			name="kjd_<?php echo $section;?>_components_settings[kjd_<?php echo $section;?>_components][<?php echo $image_type;?>][thumbnail_glow]"
				value="<?php echo $sectionSettings[$image_type]['thumbnail_glow'] ? $sectionSettings[$image_type]['thumbnail_glow'] : '' ;?>"
				 />		
				<a class="clearColor">Clear</a>
			</div> 
		<?php
		}
		?>

		<!-- border size -->
		<div class="option">
			<label>Border size</label>
			<select name="kjd_<?php echo $section;?>_components_settings[kjd_<?php echo $section;?>_components][<?php echo $image_type;?>][border_size]">
				<?php foreach($borderSizes as $size){?>
					<option value="<?php echo $size.'px';?>" <?php selected( $sectionSettings[$image_type]['border_size'], $size.'px', true) ?>><?php echo $size.'px';?></option>
				<?php }?>
			</select>
		</div>

		<!-- border style -->
		<div class="option">
			<label>Border style</label>
			<select name="kjd_<?php echo $section;?>_components_settings[kjd_<?php echo $section;?>_components][<?php echo $image_type;?>][border_style]">
				<?php foreach($borderStyles as $style){?>
					<option value="<?php echo $style;?>"<?php selected( $sectionSettings[$image_type]['border_style'], $style, true) ?>><?php echo $style;?></option>
				<?php }?>
			</select>
		</div>

		<div class="option">
			<label>Padding</label>
			<select
		name="kjd_<?php echo $section;?>_components_settings[kjd_<?php echo $section;?>_components][<?php echo $image_type;?>][padding]">
				<?php foreach($borderSizes as $size){?>
					<option value="<?php echo $size.'px';?>"<?php selected( $sectionSettings[$image_type]['padding'], $size.'px', true) ?>><?php echo $size.'px';?></option>
				<?php }?>

			</select>
		</div>

		<div class="option">
			<label>Border Radius</label>
			<select name="kjd_<?php echo $section;?>_components_settings[kjd_<?php echo $section;?>_components][<?php echo $image_type;?>][border_radius]">
				<?php foreach($borderSizes as $size){?>
					<option value="<?php echo $size.'px';?>"<?php selected( $sectionSettings[$image_type]['border_radius'], $size.'px', true) ?>><?php echo $size.'px';?></option>
				<?php }?>
				<option value="50%"<?php selected( $sectionSettings[$image_type]['border_radius'], '50%', true) ?>>50%</option>
			</select>
		</div>

		<?php
	}
}