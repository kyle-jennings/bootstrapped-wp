<?php	
		settings_fields( 'kjd_'.$section.'_components_settings' );
		$options = get_option('kjd_'.$section.'_components_settings'); 
		$section_settings = $options['kjd_'.$section.'_components'];

		$tab_parts = array('tabbed_content_background',
							'tabbed_content_border',
							'tabbed_content_text_color',
							'tabbed_content_link_color',
							'active_tab_background',
							'active_tab_border',
							'active_tab_link_color',
							'inactive_tab_border',
							'inactive_tab_background',
							'inactive_tab_link_color',
							'hovered_tab_background',
							'hovered_tab_border',
							'hovered_tab_link_color'
		);

		$collapsible_parts = array('collapible_content_background',
									'collapible_content_border',
									'collapible_content_link_color',
									'collapible_content_text_color',
									'active_title_background',
									'active_title_link_color',
									'inactive_title_background',
									 'inactive_title_link_color',
		 							'hovered_title_background',
									'hovered_title_link_color'
								);

		$table_parts = array('table_header_background',
							'table_border',
							'table_header_link_color',
							'table_header_text_color',
							'even_row_background',
							'even_row_link_color',
							'even_row_text_color',
							'odd_row_background',
							'odd_row_link_color',
		 					'odd_row_text_color',
							'hovered_row_background',
							'hovered_row_link_color',
							'hovered_row_text_color'
						);

		$form_parts = array('form_background',
							'form_border',
							'form_text',
							'field_background',
							'field_border',
							'field_glow',
							'field_text',
							'button_background',
							'button_background_end',
							'button_border',
							'button_text'
						);		
		
		$pagination_parts = array('pagination_border',
									'pagination_background',
									'pagination_text',
									'pagination_link',
									'pagination_hover_background',
									'pagination_hover_link',
									'pagination_current_background',
									'pagination_current_text'
								);
?>

<input type="hidden" id="active_tab" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][tabID]" 
value="<?php echo $section_settings['tabID'] ? $section_settings['tabID'] : 'none'; ?>"  />		
 
  <div class="btn-group ">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="btn-face">Tabbed Content</span>
		<span class="caret"></span>
	</a>
    <ul class="dropdown-menu">
       <?php if($section != 'navbar') : ?>
  
	    <li class="active"><a href="#tabs" data-toggle="tab">Tabbed Content</a></li>
	    <li><a href="#collapsibles" data-toggle="tab">Collapsibles</a></li>
	    <li><a href="#tables" data-toggle="tab">Tables</a></li>
	    <li><a href="#pagination" data-toggle="tab">Pagination</a></li>
<?php 	
		
		foreach( array('pre','address','blockquote') as $format ):
			echo '<li><a href="#'.$format.'" data-toggle="tab">'.ucwords($format).'</a></li>';
		endforeach; 

	endif; 
?>
	  	<li <?php echo $section == 'navbar' ? 'class="active"' : '' ; ?> ><a href="#forms" data-toggle="tab">Forms</a></li>

    </ul>
  </div>

  <div class="tab-content">
  

  <?php if($section != 'navbar') : ?>
<!-- ***************** -->
<!--   Tabbed Colors   -->
<!-- ***************** -->
    <div class="tab-pane cf active" id="tabs">
		<h3>Tabbed Content</h3>
		<?php foreach($tab_parts as $part){ ?>


		<div class="option" style="position: relative;">

			<label><?php echo ucwords(str_replace('_', ' ', $part ) ) ;?></label>
			<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][tabbed_content][<?php echo $part;?>]" value="<?php echo $section_settings['tabbed_content'][$part] ? $section_settings['tabbed_content'][$part] : 'none'; ?>"  />		
		<a class="clearColor">Clear</a>
		</div> 
		<?php
		}

		?>
    </div>



<!-- ****************** -->
<!-- Collapsible Colors -->
<!-- ****************** -->

    <div class="tab-pane cf" id="collapsibles">
      	<h3>Collapsibles</h3>
		<?php foreach($collapsible_parts as $part){ ?>

			<div class="option" style="position: relative;">

				<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
				<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][collapsible_content][<?php echo $part;?>]" value="<?php echo $section_settings['collapsible_content'][$part] ? $section_settings['collapsible_content'][$part] : 'none'; ?>"  />		
			<a class="clearColor">Clear</a>
			</div> 
		<?php
		}

		?>
    </div>



<!-- ***************** -->
<!-- 	Table Colors   -->
<!-- ***************** -->
    <div class="tab-pane cf" id="tables">
      	<h3>Tables</h3>
		<?php foreach($table_parts as $part){ ?>

			<div class="option" style="position: relative;">

				<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
				<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][table_content][<?php echo $part;?>]" 
				value="<?php echo $section_settings['table_content'][$part] ? $section_settings['table_content'][$part] : 'none'; ?>"  />		
			<a class="clearColor">Clear</a>
			</div> 
		<?php
		}
		?>
    </div>


<!-- ***************** -->
<!-- Pagination Colors -->
<!-- ***************** -->

    <div class="tab-pane cf" id="pagination">
     <h3>Paginator</h3>
		<?php foreach($pagination_parts as $part){ ?>

			<div class="option" style="position: relative;">

				<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
				<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][pagination][<?php echo $part;?>]" value="<?php echo $section_settings['pagination'][$part] ? $section_settings['pagination'][$part] : 'none'; ?>"  />		
			<a class="clearColor">Clear</a>
			</div> 
		<?php
		}
		?>
    </div>

<?php endif; ?>



<!-- ***************** -->
<!--    Form Colors    -->
<!-- ***************** -->
    <div class="tab-pane cf <?php echo $section == 'navbar' ? 'active' : '' ; ?>" id="forms">
    	<h3>Forms</h3>
		<?php foreach($form_parts as $part){ ?>

			<div class="option" style="position: relative;">

				<label><?php echo ucwords(str_replace('_', ' ', $part));?></label>
				<input class="minicolors" 
				name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][forms][<?php echo $part;?>]" 
				value="<?php echo $section_settings['forms'][$part] ? $section_settings['forms'][$part] : 'none'; ?>"  />		
			<a class="clearColor">Clear</a>
			</div> 
		<?php
		}
		?>
    </div>



<!-- ***************** -->
<!-- Text Formatting   -->
<!-- ***************** -->
<?php
	foreach( array('pre','address','blockquote') as $format ):
?>
    <div class="tab-pane cf" id="<?php echo $format; ?>">
		<?php 
			kjd_special_format_colors($section, $section_settings, $format);
		?>
    </div>
<?php
	endforeach;
?>




</div> <!-- end tabbed content -->


<?php


function kjd_special_format_colors($section, $options, $type){

?>
	<h3><?php echo ucwords($type);?></h3>
	<div class="color_option option" style="position: relative;">
		<label><?php echo ucwords($type);?> Background</label>

		<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][<?php echo $type;?>][<?php echo $type;?>_background]" 
			value="<?php echo $options[$type][$type.'_background'] ? $options[$type][$type.'_background'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>

	<div class="color_option option" style="position: relative;">
		<label><?php echo ucwords($type);?> Border</label>

		<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][<?php echo $type;?>][<?php echo $type;?>_border_color]" 
			value="<?php echo $options[$type][$type.'_border_color'] ? $options[$type][$type.'_border_color'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>

	<div class="color_option option" style="position: relative;">
		<label><?php echo ucwords($type);?> Text</label>

		<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][<?php echo $type;?>][<?php echo $type;?>_text]" 
			value="<?php echo $options[$type][$type.'_text'] ? $options[$type][$type.'_text'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>

	<div class="color_option option" style="position: relative;">
		<label><?php echo ucwords($type);?> Link</label>

		<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][<?php echo $type;?>][<?php echo $type;?>_link]" 
			value="<?php echo $options[$type][$type.'_link'] ? $options[$type][$type.'_link'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>

	<div class="color_option option" style="position: relative;">
		<label><?php echo ucwords($type);?> Hovered Link</label>

		<input class="minicolors" name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][<?php echo $type;?>][<?php echo $type;?>_hovered_link]" 
			value="<?php echo $options[$type][$type.'_hovered_link'] ? $options[$type][$type.'_hovered_link'] : ''; ?>"/>
		<a class="clearColor">Clear</a>
	</div>

		
	<div class="option">
		<label>Border size</label>
		<select name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][<?php echo $type;?>][<?php echo $type;?>_border]" >
			<?php foreach(range(0,20) as $size){?>
				<option value="<?php echo $size.'px';?>" <?php selected( $options[$type][$type.'_border'], $size.'px', true) ?>><?php echo $size.'px';?></option>
			<?php }?>
		</select>
	</div>

	<div class="option">
		<label>Padding size</label>
		<select name="kjd_<?php echo $section; ?>_components_settings[kjd_<?php echo $section; ?>_components][<?php echo $type;?>][<?php echo $type;?>_padding]" >
			<?php foreach(range(0,20) as $size){?>
				<option value="<?php echo $size.'px';?>" <?php selected( $options[$type][$type.'_padding'], $size.'px', true) ?>><?php echo $size.'px';?></option>
			<?php }?>
		</select>
	</div>

	<?php

}