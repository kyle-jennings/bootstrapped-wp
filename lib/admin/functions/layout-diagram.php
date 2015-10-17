<?php



// Section lists - deprecating
$GLOBALS['sections'] = array(
    'header'=> array(
        'name' => 'Header',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'navbar'=> array(
        'name' => 'Navbar',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'dropdown-menu'=> array(
        'name' => 'Nav Dropdowns',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'mobileNav'=> array(
        'name' => 'Mobile Nav',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'sidr'=> array(
        'name' => 'Side Drawer',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'cycler'=> array(
        'name' => 'Image Banner',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'pageTitle'=> array(
        'name' => 'Title Area',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'body'=> array(
        'name' => 'Body',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'posts'=> array(
        'name' => 'Post contents',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'footer'=> array(
        'name' => 'Footer',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'login'=> array(
        'name' => 'Login Page',
        'settings' => array('background','borders','text','headings', 'presentation', 'images','misc') ),
    'misc_background'=> array(
        'name' => 'Special Backgrounds',
        'settings' => array('htmlTag','bodyTag','mastArea','contentArea') ),
    'page_layouts' => array(
        'name' => 'Page Layouts',
        'settings' => array('posts','pages','frontPage','attachments') ),
);


function layout_diagram(){

?>

<div class="layout-diagram">

	<div class="layout-diagram__html">
		<div class="layout-diagram__body">
			<div class="layout-diagram__page-wrap">

				<div class="layout-diagram__mast">

					<div class="layout-diagram__header">

					</div>	<!-- header -->
					<div class="layout-diagram__navbar">

					</div>	<!-- navbar -->

				</div>	<!-- mast -->

				<div class="layout-diagram__content-area">
					<div class="layout-diagram__main">

					</div>	<!-- mast -->
					<div class="layout-diagram__aside">

					</div>	<!-- mast -->
					<div style="clear:both;"></div>
				</div><!-- content area -->

			</div> <!-- page wrap -->
			<div class="layout-diagram__footer">

			</div> <!-- footer -->
		</div>	<!-- body -->
	</div><!-- html -->


</div><!-- diagram -->
<?php

}

function section_settings_list(){
	$sections = $GLOBALS['sections'];
?>
	<ul class="options-list">
		<?php foreach( $sections as $k=>$section): ?>
			<li class="options-list__secttion options-list__section--<?php echo strtolower($section['name']); ?>">
				<a href="?page=kjd_<?php echo $k;?>_settings"><?php echo $section['name']; ?></a>
				<?php if( empty($section['settings']) ) continue; ?>
				<ul class="options-list__settings">
					<?php foreach($section['settings'] as $setting): ?>
					<li><a href="?page=kjd_<?php echo $k;?>_settings&tab=<?php echo $setting;?>"><?php echo $setting; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
		<?php endforeach; ?>
	</ul>
<?php
}

section_settings_list();