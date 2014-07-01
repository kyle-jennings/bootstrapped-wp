<?php

include_once('window-header.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width" />

<script src="<?php echo $site_root;?>/lib/admin/js/jquery.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="<?php echo $site_url; ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $site_url; ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $site_url; ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $site_root;?>/lib/scripts/bootstrap.min.js"></script>

<link rel='stylesheet' id='bootstrap'  href="<?php echo $site_root;?>/lib/styles/bootstrap/bootstrap.css" type='text/css' media='all' />

<script language="javascript" type="text/javascript" src="<?php echo $site_root;?>/lib/admin/functions/shortcode-injector/shortCodePlugin.js"></script>

<style>
	*{outline:none !important;}
	#thumbsStyle, #background-color,.buttonGroupSelect{display:none;}
	.buttonLabel{display:inline-block; width:80px;}
	.halfWidth{float:left; width:45%;}
	#shortCodeForm{ padding:0 10px;}
	.tab-content{height:450px;}
	#selectedShortCodeName{margin-left:10px;}

</style>

</head>
<body>


<div class="tabbable"> 
  <ul class="nav nav-pills">

    <li class="active"><a href="#tab1" data-toggle="tab">Columns</a></li>
    <li><a href="#tab2" data-toggle="tab">Buttons</a></li>
    <li><a href="#tab3" data-toggle="tab">Callouts</a></li>
    <li><a href="#tab4" data-toggle="tab">Tabbed</a></li>
    <li><a href="#tab5" data-toggle="tab">Collapsibles</a></li>
    <li><a href="#tab7" data-toggle="tab">Formatting</a></li>
    <li><a href="#tab8" data-toggle="tab">Tables</a></li>
    <li><a href="#tab9" data-toggle="tab">Magic</a></li>
    
  </ul>
<form class="form-horizontal" id="shortCodeForm" action="#">
  <div class="tab-content">
  
	  <div class="tab-pane active" id="tab1">
		  	<h4>Insert newspaper columns</h4>

			<div class="control-group">
				<label class="control-label">Add row?</label>
				<div class="controls controls-row">
					<input id="addRow" type="checkbox" />
				</div>
			</div>
			<!-- Column 1-->
			<div id="spanBuilder">
				<div id='column1' class="control-group columnSelect">
					<label class="control-label">Column <span>1</span> - Width</label>
					<div class="controls controls-row">
						<select class='width' style="width:60px;">
							<?php foreach (range(0, 12) as $number) { ?>
						    <option value='size="<?php echo $number;?>"'><?php echo $number;?></option>
						   <?php
						}
						?>
						</select>
						<span>Pull right?</span>
						<select class='offset' style="width:60px;">
							<?php foreach (range(0, 12) as $number) { ?>
						    <option value='offset="<?php echo $number;?>"'><?php echo $number;?></option>
						   <?php
						}
						?>
						</select>
						<a class="btn btn-danger btn-mini removeColumn" href="#">Remove Column</a>
					</div>
				</div>
			</div>
<a id='addColumn' class="btn btn-primary btn-mini" href="#">Add Column</a>

</div>


	  <div class="tab-pane" id="tab2">
	    <h4>Buttons</h4>
		<div class="control-group">
			<label class="control-label">Group Buttons?</label>
			<div class="controls">
				<input id="buttonGroup" type="checkbox"/>
			</div>
		</div>

	    <div id="buttonBuilder">
	    	<div id="button1" class="control-group">
	    		<label class="control-label">Button <span>1</span><br/><a class="btn btn-danger btn-mini removeButton" href="#">Remove Button</a></label>
	    		
	    		<div class="controls">
	    		<div class="halfWidth">
	    			<p>
		    		<span class="buttonLabel">Full Width?</span>
					<input class="buttonBlock buttonSelect" type="checkbox"/>
					</p>
					<p>
					<span class="buttonLabel">Target</span>
					<input class="buttonTarget buttonSelect" type="text" placeholder='http://google.com'/>
					</p>
				</div>
				<div class="halfWidth">
					<p>
					<span class="buttonLabel">Button Size</span>
					
						<select class="buttonSizeSelect buttonSelect span2">
							<option value="">Normal</option>
							<option value='size="btn-large"'>Large</option>
							<option value='size="btn-small"'>Small</option>
							<option value='size="btn-mini"'>Mini</option>
						</select>
					</p>
					<p>
					<span class="buttonLabel">Button Color</span>
					
						<select class="buttonColorSelect buttonSelect span3">
							<option value='style="btn-default"'>Browser Default</option>
							<option value='style="btn-primary"'>Blue</option>
							<option value='style="btn-info"'>Bright blue</option>
							<option value='style="btn-success"'>Green</option>
							<option value='style="btn-warning"'>Yellow</option>
							<option value='style="btn-danger"'>Red</option>
							<option value='style="btn-inverse"'>Black</option>
							<option value='style="btn-custom"'>Section Custom</option>
						</select>
					</p>
					</div>
				</div>	
			</div>
		</div>
		
		<a id='addButton' class="btn btn-primary btn-mini buttonGroupSelect" href="#">Add Button</a>
	  </div>

	  <div class="tab-pane" id="tab3">
	    <h4>Callouts</h4>

	    <div class="control-group">
			<label class="control-label">Callout Type</label>
			<div class="controls">
				<select id="calloutType" class="calloutSelect">
					<option value=''>Select One</option>
					<option value='type="jumbotron"'>Jumbotron</option>
					<option value='type="hero-unit"'>Hero Unit</option>
					<option value='type="page-header"'>Page Header</option>
					<option value='type="featurette"'>Featurette</option>
					<option value='type="well"'>Well</option>
				</select>
			</div>
		</div>


		<div class="control-group">
			<label class="control-label">Background Color</label>
			<div class="controls">
				<select id="calloutBG" class="calloutSelect">
					<option value='style="alert-transparent"'>none</option>
					<option value='style="well-grey"'>Light Grey</option>
					<option value='style="well-dark-grey"'>Dark Grey</option>
					<option value='style="alert-info"'>Light Blue</option>
					<option value='style="label-info"'>Dark Blue</option>
					<option value='style="alert-success"'>Light Green</option>
					<option value='style="label-success"'>Dark Green</option>
					<option value='style="alert"'>Light Yellow</option>
					<option value='style="label-warning"'>Dark Yellow</option>
					<option value='style="alert-error"'>Light Red</option>
					<option value='style="label-important"'>Light Red</option>
					<option value='style="label-inverse"'>Black</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Well Size</label>
			<div class="controls">
				<select id="calloutSize" class="calloutSelect">
					<option value=''>Normal</option>
					<option value='size="well-large"'>Large</option>

				</select>
			</div>
		</div>	  

	  </div>


	  <div class="tab-pane" id="tab4">
	    <h4>Tabbed Content</h4>
		
		<div class="control-group">
			<label class="control-label">Style</label>
			<div class="controls">
				<select id="tabsType">
					<option value='style="nav-pills"'>Pills</option>
					<option value='style="tabs"'>Tabs</option>
					<option value='style="tabs-right"'>Tabs Right</option>
					<option value='style="tabs-below"'>Tabs Below</option>
					<option value='style="tabs-left"'>Tabs Left</option>
				</select>
			</div>
		</div>
		<div id="tabBuilder">
			<div id='tab1' class="control-group">
				<label class="control-label">Tab <span>1</span> Title:</label>
				<div class="controls controls-row">
					<input class='tabTitle' type="text" placeholder="Tab Title" />
					<a class="btn btn-danger btn-mini removeTab" href="#">Remove Tab</a>
				</div>
			</div>
		</div>

		<a id='addTab' class="btn btn-primary btn-mini" href="#">Add Tab</a>
	  </div>

	  <div class="tab-pane" id="tab5">
	    <h4>Collapsible Content</h4>
		<div class="control-group">
			<label class="control-label">Group Collapsibles?</label>
			<div class="controls">
				<input id="collapsibleGroup" class="collapsibleSelect" type="checkbox"/>
			</div>
		</div>

		<div id="collapsibleBuilder">
			<div id='collapsible1' class="control-group">
				<label class="control-label">Collapsible <span>1</span> Title:</label>
				<div class="controls controls-row">
					<input class='collapsibleTitle collapsibleSelect' type="text" placeholder="Tab Title" />
					<a class="btn btn-danger btn-mini removeCollapsible" href="#">Remove Collapsible</a>
				</div>
			</div>
		</div>

		<a id='addCollapsible' class="btn btn-primary btn-mini" href="#">Add Collapsible</a>
	  </div>

	 <div class="tab-pane" id="tab6">
		<h4>Image Gallery</h4>

		<div class="control-group">
			<label class="control-label">Slider Type</label>
			<div class="controls controls-row">
				<select id="galleryStyle" class="galleryStyle">
					<option value=''>Select One</option>
					<option value='thumbnails'>Thumbnails</option>
					<option value='elastislide'>Elasislide</option>
<!-- 					<option value='wallofthumbs'>Wall of Thumbnails</option>  -->
				</select>
				<input type="hidden" id="hiddenField" class="galleryStyle" /> 
			</div>
		</div>

		<div class="control-group" id="thumbsStyle">
			<label class="control-label">Thumbnail Styles</label>
			<div class="controls controls-row">
				Size
				<select id="thumbsSize" class="galleryStyle">
					<option value=''>Select One</option>
					<option value='thumb75'>75px</option>
					<option value='thumb150'>150px</option> 
					<option value='thumbFull'>full size</option> 
				</select>
				Wrapper
				<select id="thumbsWrapper" class="galleryStyle">
					<option value=''>Select One</option>
					<option value='wrapper'>Yes</option>
					<option value='no-wrapper'>No</option> 
				</select>
			</div>
		</div>


		<div id="background-color" class="control-group">
			<label class="control-label">Background Color</label>
			<div class="controls controls-row">
				<input class="galleryStyle minicolors opacity" data-opacity="0.78" />

			</div>
		</div>
	  </div>

	  <div class="tab-pane" id="tab7">
	    <h4>Formatting</h4>
			<div class="control-group">
				<label class="control-label">Label</label>
				<div class="controls">
					<select class="labelSelect">
						<option value="">Browser Default</option>
						<option value='style="label-info"'>Blue</option>
						<option value='style="label-success"'>Green</option>
						<option value='style="label-warning"'>Yellow</option>
						<option value='style="label-important"'>Red</option>
						<option value='style="label-inverse"'>Black</option>
					</select>
				</div>
			</div>
			<hr />
			<div class="control-group">
				<label class="control-label">Badges</label>
				<div class="controls">
					<select class="badgesSelect">
						<option value="">Browser Default</option>
						<option value='style="badge-info"'>Blue</option>
						<option value='style="badge-success"'>Green</option>
						<option value='style="badge-warning"'>Yellow</option>
						<option value='style="badge-important"'>Red</option>
						<option value='style="badge-inverse"'>Black</option>
					</select>
				</div>
			</div>
	  </div>

	<div class="tab-pane" id="tab8">
		<h4>Tables</h4>

		<div class="control-group">
			<label class="control-label">Grow Table</label>
			<div class="controls controls-row">

				<a id='addTableRow' class="btn btn-primary btn-mini" href="#">Add Row</a>
				<a id='addCell' class="btn btn-primary btn-mini" href="#">Add Column</a>
			</div>
			<label class="control-label">Shrink Table</label>
			<div class="controls controls-row">
				
				<a id='removeTableRow' class="btn btn-danger btn-mini" href="#">Remove Row</a>
				<a id='removeTableColumn' class="btn btn-danger btn-mini" href="#">Remove Column</a>
			</div>
			<label class="control-label">Styles</label>
			<div class="controls controls-row">
				<label class="checkbox">
					<input type="checkbox" class="tableStyles" value="table-striped"> Striped
				</label>		
				<label class="checkbox">
					<input type="checkbox" class="tableStyles" value="table-bordered"> Border
				</label>		
				<label class="checkbox">
					<input type="checkbox" class="tableStyles" value="table-hover"> Hovered Rows
				</label>		
				<label class="checkbox">
					<input type="checkbox" class="tableStyles" value="table-condensed"> Condensed
				</label>		
			</div>
		</div>

		<!-- Column 1-->
		<div id="tableContainer">
			<table id="table" class="table">
				<thead>
					<tr>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>

	</div>

  	  <div class="tab-pane" id="tab9">
	    <h4>This is where the magic happens...</h4>

		<div class="control-group">
			<label class="control-label">Hide page title area</label>
			<div class="controls">
				<input id="hideTitle" type="checkbox"/>
			</div>
		</div>	

	  </div>

	</div><!-- end tabbed content -->
		<p>
			<span class="label">Code to insert:</span> <span id="selectedShortCodeName">&nbsp;</span>
			<textarea id="selectedShortCode" style="display:none;"></textarea>
		</p>
		<button id="insertCode" class="btn btn-primary" type="button">Insert</button>		
	</form>
</div>


</body>

</html>
