<?php
		 

function kjd_misc_backgrounds_display() {  
	screen_icon('themes'); 
?> 
<div class="kjd-admin-page-title">
	<h2>Misc Background Settings</h2>
<!-- 	<span>
		<?php echo kjd_nav_select(); ?>
	</span> -->
</div>

<?php
	if( isset( $_GET[ 'tab' ] ) ) {  
	 $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'htmlTag'; 
	}else{
	 $active_tab = 'htmlTag'; 
	}
?> 

<h2 class="nav-tab-wrapper">  

	  <a href="?page=kjd_misc_background_settings&tab=htmlTag" class="nav-tab"<?php echo $active_tab == 'htmlTag' ? 'id="active"' : 'none'; ?>>HTML tag</a>  	
	  <a href="?page=kjd_misc_background_settings&tab=bodyTag" class="nav-tab"<?php echo $active_tab == 'bodyTag' ? 'id="active"' : 'none'; ?>>BODY Tag</a>  	
	  <a href="?page=kjd_misc_background_settings&tab=mastArea" class="nav-tab"<?php echo $active_tab == 'mastArea' ? 'id="active"' : 'none'; ?>>Mast</a>  	
	  <a href="?page=kjd_misc_background_settings&tab=contentArea" class="nav-tab"<?php echo $active_tab == 'contentArea' ? 'id="active"' : 'none'; ?>>Main Content</a>  	
 	 	
</h2>

    <?php 
    	settings_errors();
		kjd_build_theme_css();
     ?>  
	<form method="post" action="options.php">  
		<div class="fields-wrapper">
	<?php 
	if( $active_tab == 'htmlTag' ) { 
		kjd_htmlTag_background_callback('htmlTag');
	}elseif($active_tab == 'bodyTag'){
		kjd_bodyTag_background_callback('bodyTag');
	}elseif($active_tab == 'mastArea'){
		kjd_mastArea_background_callback('mastArea');
	}elseif($active_tab == 'contentArea'){
		kjd_contentArea_background_callback('contentArea');
	}
?>
<input  id="dropdown-id" type="hidden"
		name="kjd_<?php echo $section; ?>_misc_settings[kjd_<?php echo $section; ?>_tab]"
		value="<?php echo $options['kjd_'.$section.'_tab'] ? $options['kjd_'.$section.'_tab'] : 'none'; ?>"
  />
<?php
	submit_button(); 

	wp_enqueue_media();
	?>  
			</div>

		<?php if( $active_tab != 'cycler Images' && $active_tab != 'cycler Settings'){ ?>

		<div class="preview-options">
			<?php echo kjd_site_preview();?>
		</div>
		
		
		<?php } ?>


	</form>

<?php
}


////////////////////////////////////
// html background
////////////////////////////////////
function kjd_htmlTag_background_callback($section){
	include	'background.php';
	
}

////////////////////////////////////
// body background
////////////////////////////////////

function kjd_bodyTag_background_callback($section){
	include	'background.php';
}

////////////////////////////////////
// mast Area background
////////////////////////////////////
function kjd_mastArea_background_callback($section){
	
	include	'background_settings_form.php';
	$miscSettings = $options['kjd_'.$section.'_background_misc'];
	?>
	<h2>Settings</h2>
		

	<div class="option">
		<label>Confine mast wallpaper?</label>
		
		<select  name="kjd_<?php echo $section;?>_background_settings[kjd_<?php echo $section; ?>_background_misc][confine_mast]">
			<option value="false" <?php selected( $miscSettings['confine_mast'], 'false', true ) ?>>No</option>
			<option value="true" <?php selected( $miscSettings['confine_mast'], 'true', true ) ?>>Yes</option>
		</select>
		<span class="explanation">This will keep the mast wallpaper in the wrapper area of the page.</span>
	</div>

	<div class="option">
		<label>Mast Top Padding</label>
		<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_misc][use_top_padding]">
			<option value="false" <?php selected( $miscSettings['use_top_padding'], 'false', true ) ?>>No</option>
			<option value="true" <?php selected( $miscSettings['use_top_padding'], 'true', true ) ?>>Yes</option>
		</select>

		<input type="text" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_misc][top_padding]"
		value="<?php echo $miscSettings['top_padding'] ? $miscSettings['top_padding'] : '' ;?>" style="width:40px;">px
	</div>

	<div class="option">
		<label>Mast Bottom Padding</label>
		<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_misc][use_bottom_padding]">
			<option value="false" <?php selected( $miscSettings['use_bottom_padding'], 'false', true ) ?>>No</option>
			<option value="true" <?php selected( $miscSettings['use_bottom_padding'], 'true', true ) ?>>Yes</option>
		</select>

		<input type="text" name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section; ?>_background_misc][bottom_padding]"
		value="<?php echo $miscSettings['bottom_padding'] ? $miscSettings['bottom_padding'] : '' ;?>" style="width:40px;">px
	</div>

	<?php
}

////////////////////////////////////
// content area background
////////////////////////////////////
function kjd_contentArea_background_callback($section){
	include	'background_settings_form.php';
	?>
	<h2>Settings</h2>
	<div class="option">
		<label>Use Content Area? <small class="whatsThis"><a href="#">whats this?</a></small></label>
		<select name="kjd_<?php echo $section; ?>_background_settings[kjd_<?php echo $section;?>_misc_settings][toggle]">
			<option value="true" <?php selected( $options['kjd_'.$section.'_settings][toggle]'], "true", true) ?>>Yes</option>
			<option value="false" <?php selected( $options['kjd_'.$section.'_settings][toggle]'], "false", false) ?>>No</option>
		</select>

	</div>

	<?php
}
