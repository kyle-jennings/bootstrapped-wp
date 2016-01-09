<?php
/* -----------------------------------------------------------------------------------
				Mobile  Nav
----------------------------------------------------------------------------------- */

function kjd_mobileNav_misc_settings_callback(){

	settings_fields( 'kjd_mobileNav_misc_settings' );

	$options = get_option('kjd_mobileNav_misc_settings');
	$options = $options['kjd_mobileNav_misc'];
	$navBarLinkStyles = array('none','highlighted','pills','tabs', 'tabs-below');


	$corners = array('top-left', 'top-right','bottom-left','bottom-right');
	$borderSizes = range(0,20);
	$borderStyles = array('none','solid','dotted','dashed','double','groove','ridge','inset','outset');

	$button_types = array('Bootstrap Default' => 'default',
	 'Hamburger' => 'hamburger',
	 'Image' => 'image',
	 'Text Button' => 'button',
	 'Text' => 'text')
?>

<h3>Mobile Nav Styles</h3>

<!-- Tab Navigation-->
<div class="btn-group ">
	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="btn-face">General</span>
		<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
		<li class="active"><a href="#general-mobile" data-toggle="tab">General</a></li>
		<li><a href="#mobile-style" data-toggle="tab">Mobile Style</a></li>
		<li><a href="#menu-button-styles" data-toggle="tab">Menu Button Style</a></li>
		<!-- <li><a href="#drawer-styles" data-toggle="tab">Drawer Style</a></li> -->
	</ul>
</div>
<!-- end nav -->

<!-- tabbed content -->
<div class="tab-content cf">

<!-- new tab -->
	<div class="tab-pane cf active" id="general-mobile">

<!-- 		<div class="option">
			<label>Menu</label>
			<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][use_mobile_menu]">
				<option value="false" <?php selected( $options['use_mobile_menu'], 'false', true ) ?>>Primary</option>
				<option value="true" <?php selected( $options['use_mobile_menu'], 'true', true) ?>>Mobile</option>
			</select>
		</div> -->

		<div class="option">
			<label>Display something in navbar?</label>
			<select class="toggle-switch" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][display_logo]">
				<option value="none" <?php selected( $options['display_logo'], 'none', true ) ?>>None</option>
				<option value="logo" <?php selected( $options['display_logo'], 'logo', true) ?>>Logo</option>
				<option value="title" <?php selected( $options['display_logo'], 'title', true) ?>>Title</option>
			</select>
		</div>

		<div class="option toggle-options mobile-nav-logo"
		<?php echo ( $options['display_logo'] != 'none' && $options['display_logo'] != '' && $options['display_logo'] == 'logo') ?
			'style="display:block;"' : 'style="display:none;"' ;?> >

			<div id="mobile-site-logo" class="option">

				<label>Upload your site logo</label>

				<input type="text" class="media_input" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][mobile_site_logo]" value="<?php echo $options['mobile_site_logo'] ? $options['mobile_site_logo'] : ' '; ?>" />
			  	<input type="button"  class="button upload_image" value="Upload image" />

				<div id="logo-preview" class="image_preview">
					<img style="max-width:100%;" src="<?php echo esc_url( $options['mobile_site_logo'] ); ?>" />
				</div>
			</div>

		</div>
	</div>


<!-- new tab -->
	<div class="tab-pane cf" id="mobile-style">
<!-- 		<div class="option">
			<label>Override navbar styles on mobile?</label>
			<select class="toggle-switch" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][override_nav]">
				<option value="false" <?php selected( $options['override_nav'], 'false', true ) ?>>No</option>
				<option value="true" <?php selected( $options['override_nav'], 'true', true) ?>>Yes</option>
			</select>
		</div> -->

		<div class="option toggle-options"
			<?php echo  $options['override_nav'] == 'true' ? 'style="display:block;"' : 'style="display:none;"' ;?>
		>

			<div class="option">
				<label>Menu Style</label>
				<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][mobilenav_style]" class="toggle-switch">
					<option value="default" <?php selected( $options['mobilenav_style'], 'default', true) ?>>Default</option>
					<option value="sidr" <?php selected( $options['mobilenav_style'], 'sidr', true ) ?>>Side Drawer</option>
					<option value="dropdown" <?php selected( $options['mobilenav_style'], 'dropdown', true ) ?>>Dropdown</option>

				</select>
			</div>

<!-- 			<div class="option">
				<label>Navbar Width</label>
				<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][mobilenav_width]">
					<option value="default" <?php selected( $options['mobilenav_width'], 'default', true) ?>>Full Width</option>
					<option value="contained" <?php selected( $options['mobilenav_width'], 'contained', true ) ?>>Contained</option>
				</select>
			</div> -->
			<div class="option">
				<label>Position</label>
				<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][mobilenav_position]" >
					<option value="default" <?php selected( $options['mobilenav_position'], 'default', true) ?>>Default</option>
					<option value="fixed-top" <?php selected( $options['mobilenav_position'], 'fixed-top', true ) ?>>Fixed at top</option>
					<option value="fixed-bottom" <?php selected( $options['mobilenav_position'], 'fixed-bottom', true ) ?>>Fixed at bottom</option>
					<option value="static-top" <?php selected( $options['mobilenav_position'], 'static-top', true ) ?>>Top of Page</option>
				</select>
			</div>
<!-- 			<div class="option">
				<label>Link style</label>
				<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][mobilenav_link_style]">
					<?php foreach($navBarLinkStyles as $style){ ?>
						<option value="<?php echo $style;?>" <?php selected( $options['mobilenav_link_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?></option>
					<?php } ?>
				</select>
			</div> -->

<!-- 			<div class="option">
				<label>Nav alignment</label>
				<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_alignment]">
					<option value="left" <?php selected( $options['menu_alignment'], 'left', true) ?>>Left</option>
					<option value="center" <?php selected( $options['menu_alignment'], 'center', true) ?>>Center</option>
					<option value="right" <?php selected( $options['menu_alignment'], 'right', true) ?>>Right</option>
				</select>
			</div> -->

		</div>
	</div>


<!-- new tab -->
	<div class="tab-pane cf" id="menu-button-styles">

		<h3>Open Menu Button Settings</h3>
		<!-- border style -->
		<div class="option menu-button-select">
			<label>Button type</label>
			<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_button_type]">
				<?php foreach($button_types as $k=>$v){?>
					<option value="<?php echo $v;?>"<?php selected( $options['menu_button_type'], $v, true); ?>><?php echo $k;?></option>
				<?php }?>
			</select>
		</div>

		<div class="option-group text-settings"
			<?php echo ( $options['menu_button_type'] == 'text' ||  $options['menu_button_type'] == 'button' )? 'style="display:block;"' : 'style="display:none;"' ;?>

		>
			<div class="option">
				<label>Button Text</label>

				<input name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_text]"
					value="<?php echo  $options['menu_btn_text'] ?  $options['menu_btn_text'] : ''; ?>"/>
			</div>
		</div>

		<div class="option-group button-settings"
			<?php echo  $options['menu_button_type'] == 'button' ? 'style="display:block;"' : 'style="display:none;"' ;?>

		>
		<?php
			$button_colors = array(
				'blue' =>'btn-primary',
				'light blue' => 'btn-info',
				'green' => 'btn-success',
				'yellow' => 'btn-warning',
				'red' => 'btn-danger',
				'black' => 'btn-inverse'
				);
		?>
			<div class="option">
				<label>Button Colors</label>
				<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_button_color]">
					<?php

						foreach($button_colors as $label=>$color ){
						?>
							<option value="<?php echo $color; ?>" <?php selected( $options['menu_button_color'], $color, true); ?> > <?php echo $label; ?></option>
						<?php
						}
					?>
				</select>
			</div>
		</div>

		<div class="option-group hamburger-colors"
			<?php echo ($options['menu_button_type'] == 'default' || $options['menu_button_type'] == 'hamburger' )? 'style="display:block;"' : 'style="display:none;"' ;?>

		>
			<div class="color_option option" style="position: relative;">
				<label>Background</label>

				<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_bg]"
					value="<?php echo  $options['menu_btn_bg'] ?  $options['menu_btn_bg'] : ''; ?>"/>
				<a class="clearColor">Clear</a>
			</div>
			<div class="color_option option" style="position: relative;">
				<label>Border</label>

				<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_border]"
					value="<?php echo $options['menu_btn_border'] ? $options['menu_btn_border'] : ''; ?>"/>
				<a class="clearColor">Clear</a>
			</div>

			<div class="color_option option" style="position: relative;">
				<label>Background - hovered/active</label>

				<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_bg_hovered]"
					value="<?php echo  $options['menu_btn_bg_hovered'] ?  $options['menu_btn_bg_hovered'] : ''; ?>"/>
				<a class="clearColor">Clear</a>
			</div>
			<div class="color_option option" style="position: relative;">
				<label>Border - hovered/active</label>

				<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][menu_btn_border_hovered]"
					value="<?php echo $options['menu_btn_border_hovered'] ? $options['menu_btn_border_hovered'] : ''; ?>"/>
				<a class="clearColor">Clear</a>
			</div>
		</div>

	</div>

<!-- new tab -->
	<div class="tab-pane cf" id="drawer-styles">
		<h3>Drawer Border</h3>
		<!-- border color -->
		<div class="color-option option" style="position: relative;">

			<label>Border color</label>
			<input class="minicolors" name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][drawer_border_color]"
			value="<?php echo $options['drawer_border_color'] ? $options['drawer_border_color'] : '' ;?>"
			 />
			<a class="clearColor">Clear</a>
		</div>

		<!-- border size -->
		<div class="option">
			<label>Border size</label>
			<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][drawer_border_size]">
				<?php foreach($borderSizes as $size){?>
					<option value="<?php echo $size.'px';?>" <?php selected( $options['drawer_border_size'], $size.'px', true) ?>><?php echo $size.'px';?></option>
				<?php }?>
			</select>
		</div>

		<!-- border style -->
		<div class="option">
			<label>Border style</label>
			<select name="kjd_mobileNav_misc_settings[kjd_mobileNav_misc][drawer_border_style]">
				<?php foreach($borderStyles as $style){?>
					<option value="<?php echo $style;?>"<?php selected( $options['drawer_border_style'], $style, true) ?>><?php echo $style;?></option>
				<?php }?>
			</select>
		</div>

	</div>


</div>


<?php


}
