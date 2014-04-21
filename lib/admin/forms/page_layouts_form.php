<?php
// -------------------------------
// Page Layout Settings 
// -------------------------------

function kjd_page_layout_settings_display() {  ?>
<div class="optionsWrapper wrap">  
	  <?php screen_icon('themes'); ?> 
	  <h2>Page Layouts</h2>  

<?php

	if( isset( $_GET[ 'tab' ] ) ) {  
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'posts'; 
	}else{
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'posts'; 
	}
?> 
	<h2 class="nav-tab-wrapper">  
	  <a href="?page=kjd_page_layout_settings&tab=posts" class="nav-tab"<?php echo $active_tab == 'posts' ? 'id="active"' : 'none'; ?>>Page Layouts</a> 
	  <a href="?page=kjd_page_layout_settings&tab=pages" class="nav-tab"<?php echo $active_tab == 'pages' ? 'id="active"' : 'none'; ?>>Template Layouts</a> 
	  <a href="?page=kjd_page_layout_settings&tab=frontPage" class="nav-tab"<?php echo $active_tab == 'frontPage' ? 'id="active"' : 'none'; ?>>Front Page Layout</a> 
	  <a href="?page=kjd_page_layout_settings&tab=attachments" class="nav-tab"<?php echo $active_tab == 'attachments' ? 'id="active"' : 'none'; ?>>Attachment Page</a> 
	 </h2>
    <?php settings_errors(); ?>  
	  <form method="post" action="options.php">  
		<?php 
			
			if( $active_tab == 'posts' ) { 
				kjd_post_templates_callback();
			}elseif( $active_tab == 'pages' ){
				kjd_page_templates_callback();
			}elseif($active_tab == 'frontPage'){
				kjd_front_page_settings();
			}elseif($active_tab == 'attachments'){
				kjd_attachment_page_callback();
			}
		 submit_button(); ?>  
	</form>
</div>
<?php
}

function kjd_attachment_page_callback(){

	settings_fields( 'kjd_attachment_page_layout_settings' );
	$options = get_option('kjd_attachment_page_layout_settings');

	$post_info = $options['kjd_attachment_info'];
	$page_layout = $options['kjd_attachment_layout'];
	$layouts = array(
		// 'text-left' =>'Text on the Left',
		// 'text-right' =>'Text on the Right',
		'text-below' => 'Text Below',
		'text-above' => 'Text Above'
	 );
?>
	<h3>Attachment Page Layout</h3>
	<div class='options-wrapper'>
		
		<div class="option">
			<label>Attachment Info</label>
			<select name="kjd_attachment_page_layout_settings[kjd_attachment_info]" >
					<option value="no" <?php selected( $post_info, 'no', true) ?>>
						No
					</option>
					<option value="yes" <?php selected( $post_info, 'yes', true) ?>>
						Yes
					</option>
			</select>			
		</div>

		<div class="option">
			<label>Layout</label>
			<select name="kjd_attachment_page_layout_settings[kjd_attachment_layout]">
				<?php
					foreach($layouts as $k => $v){
					?>
					<option value="<?php echo $k;?>" <?php selected( $page_layout, $k, true) ?> >
						<?php echo $v;?>
					</option>
					<?php	
					}
				?>
			</select>			
		</div>

	</div>
<?php
}

function kjd_page_templates_callback(){

	settings_fields( 'kjd_page_layout_settings' );
	$options = get_option('kjd_page_layout_settings');

	$pageLayoutSettings = $options['kjd_page_layouts'];
	$pageLayouts = array('template_1','template_2','template_3','template_4','template_5','template_6');
			
	echo "<h3>Template layouts</h3>";
	foreach($pageLayouts as $k => $v){
		kjd_layout_form_callback($pageLayoutSettings,'page',$v);
	}
  
}


function kjd_post_templates_callback(){

	settings_fields( 'kjd_post_layout_settings' );
	$options = get_option('kjd_post_layout_settings');
	$postLayoutSettings = $options['kjd_post_layouts'];

	$widget_areas = array('default','front_page','page','single','404','category','archive','tag','author','date','search','attachment');
  ?>

	<h3>Page layouts</h3>

	<?php


	foreach($widget_areas as $v){
	
		kjd_layout_form_callback($postLayoutSettings,'post',$v);
	
	}

}


/////////////////////////
// form
/////////////////////////
function kjd_layout_form_callback($settings,$type, $layout){ 
	
	$deviceViews = array('all','visible-phone','visible-tablet','visible-desktop','hidden-phone','hidden-tablet','hidden-desktop');
	

	if( $settings[$layout]['toggled'] != 'true' && $type=='post' && $layout !='default' ){
		$disabled = 'disabled="disabled"';
	}

?>

<input type="hidden" name="kjd_<?php echo $type;?>_layout_settings[kjd_<?php echo $type; ?>_layouts][<?php echo $layout;?>][name]" value = "<?php echo $layout;?>">
	<div class="option"> 
		<a id="<?php echo $layout;?>"></a>
		<label><?php echo ucwords(str_replace("_"," ",$layout));?></label>
			<?php if($type=='post' && $layout !='default'){
			?>
					<div class="option-component">
						<span class="sub-label" >Enable</span>
						<input type="checkbox"
								name="kjd_<?php echo $type;?>_layout_settings[kjd_<?php echo $type; ?>_layouts][<?php echo $layout;?>][toggled]"
								<?php checked( $settings[$layout]['toggled'], "true", true); ?>
								value="true"
								class="toggle-widgetarea"
						/>
					</div>

			<?php
			} ?>

  
		<div class="option-component" <?php echo $layout =='default' ? 'style="padding-left: 50px;"' : '' ; ?> >

			<span class="sub-label">Position</span>
			<select class="layout_select" <?php echo $disabled; ?> name="kjd_<?php echo $type;?>_layout_settings[kjd_<?php echo $type; ?>_layouts][<?php echo $layout;?>][position]">
				<option value="none" <?php selected( $settings[$layout]['position'], "none", true); ?>> No Sidebar </option>
				<option value="left" <?php selected( $settings[$layout]['position'], "left", true); ?>> Left </option>
				<option value="right" <?php selected( $settings[$layout]['position'], "right", true); ?>> Right </option>
				<?php if($layout != 'front_page'){ ?>
					<option value="top" <?php selected( $settings[$layout]['position'], "top", true); ?>> Top </option>
					<option value="bottom" <?php selected( $settings[$layout]['position'], "bottom", true); ?>> Bottom </option>
				<?php
				}?>
			</select>

			<div class="layout_preview">
				<img src="<?php bloginfo('template_directory'); ?>/images/widgetsright.png" class="right">
				<img src="<?php bloginfo('template_directory'); ?>/images/widgetstop.png" class="top">
				<img src="<?php bloginfo('template_directory'); ?>/images/widgetsbottom.png" class="bottom">
				<img src="<?php bloginfo('template_directory'); ?>/images/widgetsleft.png" class="left">

				<img src="<?php bloginfo('template_directory'); ?>/images/widgetsnone.png" class="none">
				<?php if(isset($settings[$layout]['position'])){ ?>
					<img src="<?php bloginfo('template_directory'); ?>/images/widgets<?php echo $settings[$layout]['position'];?>.png" class="<?php echo $settings[$layout]['position'];?>" style="display:block;">
				<?php 
				}?>
			</div>
		
		</div>

		<div class="option-component">
			<span class="sub-label">Device Visibility</span>
			<select  <?php echo $disabled; ?> name="kjd_<?php echo $type; ?>_layout_settings[kjd_<?php echo $type; ?>_layouts][<?php echo $layout;?>][deviceView]">
				<?php foreach($deviceViews as $view){ ?>
					<option value="<?php echo $view; ?>" <?php selected( $settings[$layout]['deviceView'], $view, true); ?>>
						<?php echo $view; ?>
					</option>
				<?php }?>
			</select>
		</div>
	</div>

<?php
}

function kjd_front_page_settings(){
	settings_fields('kjd_frontPage_layout_settings');
	$options = get_option('kjd_frontPage_layout_settings');
	$layoutOrder = $options['kjd_frontPage_layout'];
	
	$image_banner = get_option('kjd_cycler_misc_settings');
	$image_banner = $image_banner['kjd_cycler_misc'];

	$components = array('widget_area_1','widget_area_2','widget_area_3','content','secondary_content');//'image_slider'
	if($image_banner['enable'] == 'true' && $image_banner['location'] == 'sortable'){
		$components[] = 'image_banner';
	}
	
	
	$deviceViews = array('all','visible-phone','visible-tablet','visible-desktop','hidden-phone','hidden-tablet','hidden-desktop');

	$activeComponents = array();
	if(!empty($layoutOrder)){
		foreach($layoutOrder as $orderNum){
			array_push($activeComponents, $orderNum['component']);
		}
		
	}

	
	$inactiveComponents = array_diff($components,$activeComponents);
?>

	<h3>Frontpage layout</h3>
<div id='frontpage-sortables' class="option">
	<div class="postbox frontPageLayoutList">
		<h3><span>Active Page Components</span></h3>
		
			<ul id="activeComponents" class="connectedSortable">
			<?php foreach($activeComponents as $key => $value){
				?>
				<li class="menu-item-handle" id="<?php echo 'componentOrder_'.$key; ?>">
					<?php echo $layoutOrder[$key]['component'] ? ucwords(str_replace('_',' ',$layoutOrder[$key]['component'])) : ucwords(str_replace('_',' ',$value));?>
					<div>
						<input class="component" type="hidden" name="kjd_frontPage_layout_settings[kjd_frontPage_layout][<?php echo $key;?>][component]" value="<?php echo $layoutOrder[$key]['component'] ? $layoutOrder[$key]['component'] : $value;?>"/>
						
						<select class="componentDeviceView" name="kjd_frontPage_layout_settings[kjd_frontPage_layout][<?php echo $key;?>][componentDeviceView]">
						<?php foreach($deviceViews as $view){ ?>
							<option value="<?php echo $view; ?>" <?php selected( $layoutOrder[$key]['componentDeviceView'], $view, true); ?>>
								<?php echo $view; ?>
							</option>
						<?php } ?>
						</select>
						
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

						<select class="componentDeviceView" name="">
						<?php foreach($deviceViews as $view){ ?>
							<option value="" >
								<?php echo $view; ?>
							</option>
						<?php } ?>
						</select>
					</div>
				</li>
				<?php
				}?>				
				</ul>
			
		</div>

	</div>
	
	<div class='option'>
		<label>Content Title</label>
		<input type="text" name='kjd_frontPage_layout_settings[kjd_frontPage_content_title]' 
		value="<?php echo $options['kjd_frontPage_content_title'] ? $options['kjd_frontPage_content_title'] : '' ;?>"/>
	</div>
	
	<div class='option'>
		<label>Secondary Content Title</label>
		<input type="text" name='kjd_frontPage_layout_settings[kjd_frontPage_secondary_content_title]' 
		value="<?php echo $options['kjd_frontPage_secondary_content_title'] ? $options['kjd_frontPage_secondary_content_title'] : '' ;?>"/>
	</div>
	
	<div class="option">
		<label>Secondary Content</label>
			<?php wp_editor( $options['kjd_frontPage_secondaryContent'], 
			'kjd_frontPage_layout_settings[kjd_frontPage_secondaryContent]', 
			$settings = array('content_css' => get_stylesheet_directory_uri() . '/lib/styles/bootstrap/bootstrap.css')  );?>
	</div>
<?php
}
