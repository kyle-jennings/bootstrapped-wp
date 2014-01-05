<?php
////////////////////////////////
// cycler settings
function kjd_cycler_settings_callback(){ 
settings_fields('kjd_cycler_misc_settings');
$options = get_option('kjd_cycler_misc_settings');


$deviceViews = array('all','visible-phone','visible-tablet','visible-desktop','hidden-phone','hidden-tablet','hidden-desktop');
$plugins = array('single image','nivo','flexslider2','responsive_slider','bootstrap_slider',); //'piecemaker3d'
$themes = array('dark','light');
$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');

if($options['kjd_cycler_misc']['plugin'] == 'nivo'){

	$effects = array('random','sliceDown','sliceDownLeft','sliceUp','sliceUpLeft','sliceUpDown',
'sliceUpDownLeft','fold','fade','slideInRight','slideInLeft','boxRandom','boxRain',
'boxRainReverse','boxRainGrow','boxRainGrowReverse');

}elseif($options['kjd_cycler_misc']['plugin'] == "flexslider2"){

$effects = array('fade','slide');

}else{

$effects = '';

}

?>
	<h3>Image Cycler settings</h3>

<!-- ******** -->
<!-- buttons  -->
<!-- ******** -->
	<div class="option">
		<label>Enable Image Cycler?</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][enable]">
			<option value="true"<?php selected( $options['kjd_cycler_misc']['enable'], $plugin, true) ?>>
			Yes</option>
			<option value="false"<?php selected( $options['kjd_cycler_misc']['enable'], $plugin, true) ?>>
			No</option>
		</select>
	</div>

	<div class="option">
		<label>Cycler Plugin</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][plugin]" class="pluginSelect pre_option">
			<?php foreach($plugins as $plugin){ ?>
				<option value="<?php echo $plugin; ?>"
				<?php selected( $options['kjd_cycler_misc']['plugin'], $plugin, true) ?>>
					<?php echo ucwords(str_replace('_',' ',$plugin));?>
				</option>
			<?php }?>
		</select>
	</div>



	<div class="option nivoOptions" style="display:<?php echo $options['kjd_cycler_misc']['plugin'] == 'nivo' ? 'block': 'none' ;?>;">
		<label>Controls color scheme</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][nivoTheme]" class="pre_option">
			<?php foreach($themes as $theme){ ?>
				<option value="<?php echo $theme; ?>"
				<?php selected( $options['kjd_cycler_misc']['nivoTheme'], $theme, true) ?>>
					<?php echo $theme;?>
				</option>
			<?php }?>
		</select>
	</div>

	<div class="option nivoOptions" style="display:<?php echo $options['kjd_cycler_misc']['plugin'] == 'nivo' ? 'block': 'none' ;?>;">
		<label>Caption position</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][nivoCaption]" class="pre_option">
			<option value="none"
			<?php selected( $options['kjd_cycler_misc']['nivoCaption'], 'none', true) ?>>
				none
			</option>
			<option value="top"
			<?php selected( $options['kjd_cycler_misc']['nivoCaption'], 'top', true) ?>>
				Top
			</option>
			<option value="right"
			<?php selected( $options['kjd_cycler_misc']['nivoCaption'], 'right', true) ?>>
				Right Side
			</option>
			<option value="bottom"
			<?php selected( $options['kjd_cycler_misc']['nivoCaption'], 'bottom', true) ?>>
				Bottom
			</option>

			<option value="left"
			<?php selected( $options['kjd_cycler_misc']['nivoCaption'], 'left', true) ?>>
				Left Side
			</option>
		</select>
	</div>	

	<div class="option singleOptions" style="display:<?php echo $options['kjd_cycler_misc']['plugin'] == 'single image' ? 'block': 'none' ;?>;">
		<label>Caption position</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][singleCaption]" class="pre_option">
			<option value="none"
			<?php selected( $options['kjd_cycler_misc']['singleCaption'], 'none', true) ?>>
				None
			</option>
			<option value="top"
			<?php selected( $options['kjd_cycler_misc']['singleCaption'], 'top', true) ?>>
				Top
			</option>
			<option value="right"
			<?php selected( $options['kjd_cycler_misc']['singleCaption'], 'right', true) ?>>
				Right Side
			</option>
			<option value="bottom"
			<?php selected( $options['kjd_cycler_misc']['singleCaption'], 'bottom', true) ?>>
				Bottom
			</option>

			<option value="left"
			<?php selected( $options['kjd_cycler_misc']['singleCaption'], 'left', true) ?>>
				Left Side
			</option>
		</select>
	</div>
<?php 

	$borderSizes = range(0,20);

?>
	<div class="option singleOptions" style="display:<?php echo $options['kjd_cycler_misc']['plugin'] == 'single image' ? 'block': 'none' ;?>;">
		<h2>Image Frame</h2>

		<div class="color_option option" style="position: relative;">

			<label>Background color</label>
			<input class="minicolors" 
			name="kjd_cycler_misc_settings[kjd_cycler_misc][backgroundColor]"
			value="<?php echo $options['kjd_cycler_misc']['backgroundColor'] ?  $options['kjd_cycler_misc']['backgroundColor'] : '' ;?>"
			 />		
			<a class="clearColor">Clear</a>
		</div> 
			
		<div class="color_option option" style="position: relative;">

			<label>Border color</label>
			<input class="minicolors" 
			name="kjd_cycler_misc_settings[kjd_cycler_misc][borderColor]"
			value="<?php echo $options['kjd_cycler_misc']['borderColor'] ?  $options['kjd_cycler_misc']['borderColor'] : '' ;?>"
			 />		
			<a class="clearColor">Clear</a>
		</div> 

		<!-- border size -->
		<div class="option">
			<label>Border size</label>
			<select name="kjd_cycler_misc_settings[kjd_cycler_misc][borderSize]">
				<?php foreach($borderSizes as $size){?>
					<option value="<?php echo $size.'px';?>" <?php selected(  $options['kjd_cycler_misc']['borderSize'], $size.'px', true) ?>><?php echo $size.'px';?></option>
				<?php }?>
			</select>
		</div>

		<div class="option">
				<label>Border radius</label>
				<select name="kjd_cycler_misc_settings[kjd_cycler_misc][borderRadius]">
					<?php foreach($borderSizes as $radius){?>
						<option value="<?php echo $radius.'px';?>" <?php selected(  $options['kjd_cycler_misc']['borderRadius'], $radius.'px', true) ?>><?php echo $radius.'px';?>
						</option>
					<?php }?>
				</select>
		</div>

		<div class="option">
				<label>Border Transparency</label>
				<select name="kjd_cycler_misc_settings[kjd_cycler_misc][borderTransparency]">
					<option value="true" <?php selected(  $options['kjd_cycler_misc']['borderTransparency'], 'true', true) ?>>True
					</option>
					<option value="false" <?php selected(  $options['kjd_cycler_misc']['borderTransparency'], 'false', true) ?>>False
					</option>					
				</select>
		</div>

	</div>
				
<!-- ************************************ -->
<!-- General settings/not plugin specifc  -->
<!-- ************************************ -->
<h4>General settings</h4>
<hr />
	<div class="option">
		<label>Phone View</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][deviceView]">
			<?php foreach($deviceViews as $view){ ?>
				<option value="<?php echo $view; ?>"
				<?php selected( $options['kjd_cycler_misc']['deviceView'], $view, true) ?>>
					<?php echo ucwords(str_replace('-', ' ', $view));?>
				</option>
			<?php }?>
		</select>
	</div>

	<div class="option">
		<label>Use Shadow?</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][shadow]">
			<option value="false" <?php selected( $options['kjd_cycler_misc']['shadow'], 'false', true) ?>>No</option>
			<option value="true" <?php selected( $options['kjd_cycler_misc']['shadow'], 'true', true) ?>>Yes</option>
		</select>
	</div>


	<div class="option" style="display:<?php echo $options['kjd_cycler_misc']['plugin'] != 'single image' ? 'block': 'none' ;?>;" >
		<label>Transition effect</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][effect]" class="effectSelect pre_option">
			<?php	foreach($effects as $effect){ ?>
				<option value="<?php echo $effect; ?>"
				<?php selected( $options['kjd_cycler_misc']['effect'], $effect, true) ?>>
					<?php echo $effect;?>
				</option>
			<?php }?>
		</select>
	</div>

<!-- ******* -->
<!-- Timeout -->
<!-- ******* -->
	<div class="option">
		<label>Timeout period<small> in ms</small></label>
		<input name="kjd_cycler_misc_settings[kjd_cycler_misc][timeout]" 
value="<?php echo $options['kjd_cycler_misc']['timeout']?$options['kjd_cycler_misc']['timeout'] : '30000' ;?>" type="text" />
	</div>



	<div class="option">
		<label>Confine Background?</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][kjd_cycler_confine_background]">
			<option value="true" <?php selected( $options['kjd_cycler_misc']['kjd_cycler_confine_background'], 'true', true) ?>>Yes</option>
			<option value="false" <?php selected( $options['kjd_cycler_misc']['kjd_cycler_confine_background'], 'false', true ) ?>>No</option>
		</select>
	</div>	

	<div class="option">
		<label>Full Width?</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][full_width]">
			<option value="false" <?php selected( $options['kjd_cycler_misc']['full_width'], 'false', true) ?>>No</option>
			<option value="true" <?php selected( $options['kjd_cycler_misc']['full_width'], 'true', true) ?>>Yes</option>
		</select>
	</div>

	<div class="option float-toggle">
		<label>Float cycler</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][float]">
				<option value="true" <?php selected( $options['kjd_cycler_misc']['float'], 'true', true) ?>>Yes</option>
				<option value="false" <?php selected( $options['kjd_cycler_misc']['float'], 'false', true) ?>>No</option>
		</select>
	</div>

<?php
	$option_markup ='';
	
	$toggle_class = $options['kjd_cycler_misc']['float'] =='true' ? 'style="display:block;"' : 'style="display:none;"' ;
	$margin_top_toggle = $options['kjd_cycler_misc']['margin_top'] ? $options['kjd_cycler_misc']['margin_top'] : '0';
	$margin_bottom_toggle = $options['kjd_cycler_misc']['margin_bottom'] ? $options['kjd_cycler_misc']['margin_bottom'] : '0';

	$option_markup .= '<div class="option float-option" '. $toggle_class .'>';
		$option_markup .= '<label>Floated Section Margin</label>';
		$option_markup .= '<div class="margin-label"><span>Top</span>';
			$option_markup .= '<input name="kjd_cycler_misc_settings[kjd_cycler_misc][margin_top]" ';
				$option_markup .= 'value="'. $margin_top_toggle .'"';
				$option_markup .= 'style="width:40px;"/>px.';
		$option_markup .= '</div>';
	$option_markup .= '<div class="margin-label"><span>Bottom</span>';
		$option_markup .= '<input name="kjd_cycler_misc_settings[kjd_cycler_misc][margin_bottom]" ';
			$option_markup .= 'value="'. $margin_bottom_toggle .'"';
			$option_markup .= 'style="width:40px;"/>px.';
		$option_markup .= '</div>';
	$option_markup .= '</div>';

	echo $option_markup;


?>
	<div class="option">
		<label>Outer glow</label>
		<select name="kjd_cycler_misc_settings[kjd_cycler_misc][kjd_cycler_section_shadow]">
			<?php foreach($glowSettings as $glow){ ?>
				<option value="<?php echo $glow;?>" <?php selected( $options['kjd_cycler_misc']['kjd_cycler_section_shadow'], $glow, true) ?>>
					<?php echo $glow; ?>
				</option>
			<?php } ?>
		</select>
	</div>


<?php
}


//////////////////////////////////
// cycler images

function kjd_cycler_images_callback(){
	settings_fields('kjd_cycler_images_settings');
	$options = get_option('kjd_cycler_images_settings');
	$cycler = $options['kjd_cycler_images'];
	$counter = $options['kjd_cycler_counter'];

	$totalCount = count($cycler);
	if($totalCount<1){
		$cycler[0]= array();
	}
	if ($counter =='1'){
		array_push($cycler, array());
		$totalCount = count($cycler);
	}

?> 

	<p>Upload as many front page banner images as you want, but there are few things to remember: </p>
	<ol>
		<li>All images should be the EXACT same size. Otherwise, you will not see smooth transitions.</li>
		<li>We reccommend uploading images which are at least 1200 pixels wide, and no more than 400 pixels tall.</li>
		<li>To reorder your images, just click and drag them!</li>
		<li>When you remove or reorder an image, <b>dont forget to click "save changes"</b>. We are working on this.</li>
	</ol>

	<div class="option banner_image_options">
		<div class="option">
			<input type="hidden" id="element_counter" name="kjd_cycler_images_settings[kjd_cycler_counter]" value="<?php echo $cycler ? $cycler: ''; ?>" />
			<input type="hidden" id="totalCount" value="<?php echo $totalCount ? $totalCount : ''; ?>" />
		</div>

		<h3>Upload Images for your front page banner</h3>
		<?php submit_button(); ?>

		<ul class="cycler_mgmt">
<!-- begining image list -->
<?php foreach ($cycler as $key => $value) { ?>

		<li class="cycler_image postbox" id="<?php echo 'image_id_'.$key; ?>">
			<div class="handlediv" title="Click to toggle"><br></div>
			<h3 class="handle"><span><?php $imageNum = $key+1; echo 'Image number: '.$imageNum; ?></span></h3>
			<div class="inside">
			<div class="halfWidth">
				<div class="option">
					<label>Upload Image</label>

					<input class="url media_input" name="kjd_cycler_images_settings[kjd_cycler_images][<?php echo $key;?>][url]" type="text" value="<?php echo $cycler[$key]['url'] ? $cycler[$key]['url'] : ''; ?>"/>  
	    			<a href="#" class="button upload_image"> Upload image</a>

    				<div class="image_preview" style="height: 100px; clear:both;">  
					<?php if( !empty($cycler[$key]['url']) ){
				      echo '<img src="'.esc_url( $cycler[$key]['url'] ).'" style="max-width:auto; height:100px;" /> ';
					} ?>
		  			</div> 
				</div>

				<div class="option">
					<label>Alt Text </label>
					<input type="text" class="alt" name="kjd_cycler_images_settings[kjd_cycler_images][<?php echo $key;?>][alt]" value="<?php echo $cycler[$key]['alt'] ? $cycler[$key]['alt'] : ''; ?>" />
				</div>
				
				<div class="option">
					<a href="#" class="remove_image" >Remove Image</a>
				</div>
			</div>

			<div class="halfWidth">
				<div class="option">
					<label class="banner">Banner Text <?php echo $key; ?></label>
<?php 

	$mce_instance = $cycler[$key]['text'];
	$mce_ID = 'kjd_cycler_images_settings[kjd_cycler_images]['.$key.'][text]';
	$style = '.mceIframeContainer{background-image:url('. $cycler[$key]['url'] .'); background-size:cover; }';
	$settings = array(
				'textarea_rows' =>4,
				'editor_class'=>'whiteBackground',
				'editor_css'=>'<style scoped>' . $style . '</style>',
			);
	wp_editor( $mce_instance, $mce_ID, $settings );

?>
				</div>
			</div>
		
			<div style="clear:both;"></div>
		</div>
		</li>


<?php } ?>
<!-- end image list -->

		</ul> <!-- end image cycler mgmt-->
		<input type="submit" value="Add Image" class="button-primary" id="add_image">

	</div>
<?php 
}
