<?php
// -------------------------------
// Page Layout Settings 
// -------------------------------

function kjd_page_layout_settings_display() {  ?>
<div class="optionsWrapper wrap">  
	  <?php screen_icon('themes'); ?> 
	  <h2>Template Layouts</h2>  

<?php

	if( isset( $_GET[ 'tab' ] ) ) {  
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'posts'; 
	}else{
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'posts'; 
	}
?> 
	<h2 class="nav-tab-wrapper">  
	  <a href="?page=kjd_page_layout_settings&tab=posts" class="nav-tab"<?php echo $active_tab == 'posts' ? 'id="active"' : 'none'; ?>>Post Layouts</a> 
	  <a href="?page=kjd_page_layout_settings&tab=pages" class="nav-tab"<?php echo $active_tab == 'pages' ? 'id="active"' : 'none'; ?>>Page Layouts</a> 
	  <a href="?page=kjd_page_layout_settings&tab=frontPage" class="nav-tab"<?php echo $active_tab == 'frontPage' ? 'id="active"' : 'none'; ?>>Front Page Layout</a> 
	  <a href="?page=kjd_page_layout_settings&tab=attachements" class="nav-tab"<?php echo $active_tab == 'attachements' ? 'id="active"' : 'none'; ?>>Attachment Page Layout</a>
	 </h2>
    <?php settings_errors(); ?>  
	  <form method="post" action="options.php">  
		<?php 
			
			if( $active_tab == 'posts' ) { 
				post_layout_callback();
			}elseif( $active_tab == 'pages' ){
				page_layout_callback();
			}elseif($active_tab == 'frontPage'){
				front_page_settings();
			}elseif($active_tab == 'attachment'){
				attachment_page_settings();
			}
		 submit_button(); ?>  
	</form>
</div>
<?php
}

function page_layout_callback(){

	settings_fields( 'kjd_page_layout_settings' );
	$options = get_option('kjd_page_layout_settings');

	$pageLayoutSettings = $options['kjd_page_layouts'];
	$pageLayouts = array('template_1','template_2','template_3','template_4','template_5','template_6','front_page_widgets');
			
	echo "<h3>Page layouts (default)</h3>";
	foreach($pageLayouts as $k => $v){
		layout_form_callback($pageLayoutSettings,'page',$v);
	}
  
}


function post_layout_callback(){

	settings_fields( 'kjd_post_layout_settings' );
	$options = get_option('kjd_post_layout_settings');
	
	$postLayouts = array('single','posts','category','archive','tag','taxonomy','author','date','search','attachment');
	$postLayoutSettings = $options['kjd_post_layouts'];

// echo "<pre>";
// var_dump($postLayoutSettings);
// echo "</pre>";
  ?>

	<h3>Post layouts</h3>
	<?php foreach($postLayouts as $layout){ 
		layout_form_callback($postLayoutSettings,'post',$layout);
	}
}


/////////////////////////
// form
/////////////////////////
function layout_form_callback($settings,$type, $layout){ 
	$deviceViews = array('all','visible-desktop','hidden-phone','hidden-tablet');
?>
<input type="hidden" name="kjd_<?php echo $type;?>_layout_settings[kjd_<?php echo $type; ?>_layouts][kjd_<?php echo $layout;?>][name]" value = "kjd_<?php echo $layout;?>">
	<div class="option"> 
		<a id="<?php echo $layout;?>"></a>
		<label><?php echo ucwords(str_replace("_"," ",$layout));?></label>
		<div class="optionComponent">
			<span class="sublabel">Widgets Area</span>
			<select class="layout_select" name="kjd_<?php echo $type;?>_layout_settings[kjd_<?php echo $type; ?>_layouts][kjd_<?php echo $layout;?>][position]">
				<?php if($type=='post' || $layout == 'front_page_widgets'){ ?>
					<option value="none" <?php selected( $settings['kjd_'.$layout]['position'], "none", true); ?>>
						No Sidebar
					</option>
				<?php
				}?>
				<option value="left" <?php selected( $settings['kjd_'.$layout]['position'], "left", true); ?>>
				Left
				</option>
				<option value="right" <?php selected( $settings['kjd_'.$layout]['position'], "right", true); ?>>
				Right
				</option>
				<?php if($layout != 'front_page_widgets'){ ?>
					<option value="top" <?php selected( $settings['kjd_'.$layout]['position'], "top", true); ?>>
					Top
					</option>
					<option value="bottom" <?php selected( $settings['kjd_'.$layout]['position'], "bottom", true); ?>>
					Bottom
					</option>
				<?php
				}?>
			</select>
			<div class="layout_preview">
				<img src="<?php bloginfo('template_directory'); ?>/images/widgetsright.png" class="right">
				<img src="<?php bloginfo('template_directory'); ?>/images/widgetstop.png" class="top">
				<img src="<?php bloginfo('template_directory'); ?>/images/widgetsbottom.png" class="bottom">
				<img src="<?php bloginfo('template_directory'); ?>/images/widgetsleft.png" class="left">
				<?php if($type=='post'){ ?>
					<img src="<?php bloginfo('template_directory'); ?>/images/widgetsnone.png" class="none">
				<?php
				}?>
				<?php if(isset($settings['kjd_'.$layout]['position'])){ ?>
					<img src="<?php bloginfo('template_directory'); ?>/images/widgets<?php echo $settings['kjd_'.$layout]['position'];?>.png" class="<?php echo $settings['kjd_'.$layout]['position'];?>" style="display:block;">
				<?php 
				}?>
			</div>
		</div>

		<div class="optionComponent">
			<span class="sublabel">Device Visibility<span>
			<select name="kjd_<?php echo $type; ?>_layout_settings[kjd_<?php echo $type; ?>_layouts][kjd_<?php echo $layout;?>][deviceView]">
				<?php foreach($deviceViews as $view){ ?>
					<option value="<?php echo $view; ?>" <?php selected( $settings['kjd_'.$layout]['deviceView'], $view, true); ?>>
						<?php echo $view; ?>
					</option>
				<?php }?>
			</select>
		</div>
	</div>

<?php
}

function front_page_settings(){
	settings_fields('kjd_frontPage_layout_settings');
	$options = get_option('kjd_frontPage_layout_settings');
	$layoutOrder = $options['kjd_frontPage_layout'];
	
	$components = array('widget_area_1','widget_area_2','content','secondary_content');//'image_slider'
	$activeComponents = array();
	if(!empty($layoutOrder)){
		foreach($layoutOrder as $orderNum){
			array_push($activeComponents, $orderNum['component']);
		}
		
	}

	
	$inactiveComponents = array_diff($components,$activeComponents);
?>

	<h3>Frontpage layout</h3>
	<div class="option">
<?php 
// echo "<pre>"; 
// var_dump($layoutOrder);
// echo "</pre>"; 

?>
		<div class="postbox frontPageLayoutList">
			<h3><span>Active Page Components</span></h3>
			
				<ul id="activeComponents" class="connectedSortable">
				<?php foreach($activeComponents as $key => $value){
					?>
					<li class="menu-item-handle" id="<?php echo 'componentOrder_'.$key; ?>">
						<?php echo $layoutOrder[$key]['component'] ? ucwords(str_replace('_',' ',$layoutOrder[$key]['component'])) : ucwords(str_replace('_',' ',$value));?>
						<div>
							<input class="component" type="hidden" name="kjd_frontPage_layout_settings[kjd_frontPage_layout][<?php echo $key;?>][component]" value="<?php echo $layoutOrder[$key]['component'] ? $layoutOrder[$key]['component'] : $value;?>"/>
							
							<input class="componentDisplay" type="hidden" name="kjd_frontPage_layout_settings[kjd_frontPage_layout][<?php echo $key;?>][display]" value="<?php echo $layoutOrder[$key]['componentDisplay'] ? $layoutOrder[$key]['componentDisplay'] : '';?>" />
						</div>
					</li>
				<?php
				}?>
				</ul>
			
		</div>
		<div class="postbox frontPageLayoutList">
			<h3><span>Inactive Components</span></h3>
			
				<ul id="inactiveComponents" class="connectedSortable">
				<?php foreach($inactiveComponents as $key => $value){ 

					?>
				<li class="menu-item-handle">
					<?php echo ucwords(str_replace('_',' ',$value));?>
					<div>
						<input class="component" type="hidden" value="<?php echo $value;?>" name=""/>
						<input class="componentDisplay" type="hidden" name="" value=""/>
					</div>
				</li>
				<?php
				}?>				
				</ul>
			
		</div>

	</div>

	<div class="option">
		<label>Front Page Content</label>
			<?php wp_editor( $options['kjd_frontPage_secondaryContent'], 'kjd_frontPage_layout_settings[kjd_frontPage_secondaryContent]' );?>
	</div>
<?php
}

function post_listing_page_settings(){
	settings_fields('kjd_post_listing_layout_settings');
	$options = get_option('kjd_post_listing_layout_settings');
	$layoutOrder = $options['kjd_post_listing_layout'];
	


}


function attachment_page_settings(){
	settings_fields('kjd_attachment_layout_settings');
	$options = get_option('kjd_attachment_layout_settings');
	$layoutOrder = $options['kjd_attachment_layout'];
	


}

?>