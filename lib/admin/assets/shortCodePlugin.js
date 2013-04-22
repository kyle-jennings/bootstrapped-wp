	var thisVal = "";
	var thisName = "";
	var thisNum = "";
	var shortCodeVal ="";
	var columnArray = new Array();
	var collapsibleArray = new Array();
	jQuery('#calloutSize').closest('.control-group').hide();
	jQuery('#calloutBG').closest('.control-group').hide();



function displayShortCode(elementArray){

	var display = elementArray.toString();
	display = display.replace(/,/g, '');
	if(elementArray[0]){
		if(elementArray[0]=='[row]'){
		display += '\n[/row]';		
		}
		if(elementArray[0].substring(0,5) == '[tabs' ){
			display += '\n[/tabs]';
		}
		if(elementArray[0]=='[collapsibles]'){
		display += '\n[/collapsibles]';		
		}
		if(elementArray[0]=='[thumbnails]'){
		display += '\n[/thumbnails]';		
		}
		if(elementArray[0]=='[buttonGroup]'){
		display += '\n[/buttonGroup]';		
		}		
	}
	
	jQuery('#selectedShortCodeName').text(display);
}
	jQuery(document).ready(function() { 
		
///////////////////////////
/// Columns
///////////////////////////		
		var i=1;

	// INSERT row
		jQuery("#addRow").change(function () {
			if(jQuery(this).is(':checked')){
				columnArray[0]='[row]';
			}else{
				columnArray[0]='';
			}
			displayShortCode(columnArray);

		});

	// ADD COLUMN
		jQuery('#addColumn').click(function(){
			i++;
			var cloned = jQuery('#spanBuilder > div').clone(true);
			cloned.find('.control-label span').text(i);
			cloned.attr('id','column'+i);
			cloned.insertBefore('#addColumn');
		});
	// REMOVE COLUMN
		jQuery('.removeColumn').click(function(){
			if(jQuery(this).closest('.control-group').attr('id') != 'column1'){
				var thisNum = jQuery(this).closest('.control-group').attr('id');
		        thisNum = parseInt(/column(\d+)/.exec(thisNum)[1], 10);
				var thisColumn = jQuery(this).closest('.control-group').remove();
				//columnArray.splice(thisNum,1);
				columnArray[thisNum]='';
				displayShortCode(columnArray);
			}else{
				alert('sorry, you need at least one column here');
			}
		});

	// GET WIDTH

		jQuery(".columnSelect select").change(function () {
			var thisWidthVal ='';
			var thisOffsetVal ='';
			var thisNum = jQuery(this).closest('.control-group').attr('id');
			thisNum = parseInt(/column(\d+)/.exec(thisNum)[1], 10);
	        jQuery(this).find("option:selected").each(function (){

	          	var thisClass = jQuery(this).parent().attr('class');
				if(thisClass =='width'){
					thisWidthVal = jQuery(this).val();
					thisOffsetVal = jQuery(this).parent().siblings('.offset').val();
				}else{
					thisWidthVal = jQuery(this).parent().siblings('.width').val();
					thisOffsetVal = jQuery(this).val();
				}
	        });
        	columnArray[thisNum] = '\n[column '+thisWidthVal+' '+thisOffsetVal+'] .. [/column]';
			displayShortCode(columnArray);
	    });



/////////////////////////
// buttons
/////////////////////////
	var buttonArray = new Array();
	buttonArray[0] = '[buttonGroup]';
	var b=1;
	jQuery("#buttonGroup").change(function () {
		
		if(jQuery(this).is(':checked')){
			buttonArray[0]='[buttonGroup]';
			jQuery('.buttonGroupSelect').show();
			jQuery('.buttonBlock').prop("checked", false);

		}else{
			buttonArray[0]='';
			jQuery('.buttonGroupSelect').hide();
		}
		
		displayShortCode(buttonArray);
	});

	// ADD Tab
		jQuery('#addButton').click(function(){
			b++;
			buttonArray[b] = '[button] .. [/button]';
			displayShortCode(buttonArray);
			var cloned = jQuery('#buttonBuilder > div').clone(true);
			cloned.find('.control-label span').text(b);
			cloned.attr('id','button'+b);
			cloned.find('input').val('');
			cloned.insertBefore('#addButton');
		});
	// REMOVE TAB
		jQuery('.removeButton').click(function(){
			if(jQuery(this).closest('.control-group').attr('id') != 'button1'){
				var thisNum = jQuery(this).closest('.control-group').attr('id');
		        thisNum = parseInt(/button(\d+)/.exec(thisNum)[1], 10);
				jQuery(this).closest('.control-group').remove();
				//buttonArray.splice(thisNum,1);
				buttonArray[thisNum]= '';
				displayShortCode(buttonArray);
			}else{
				alert('sorry, you need at least one button here');
			}
		});


	jQuery(".buttonSelect").change(function() {
			var buttonParent = jQuery(this).closest('.control-group');
			var thisNum = buttonParent.attr('id');
		    thisNum = parseInt(/button(\d+)/.exec(thisNum)[1], 10); // this line right here

			if(buttonParent.find('.buttonBlock').is(':checked')){
				var blockVal = 'block="btn-block"';
				jQuery('#buttonGroup').prop("checked", false);

				buttonArray[0]='';
				jQuery('.buttonGroupSelect').hide();
			}else{
				var blockVal = '';
			}
	        var sizeVal = buttonParent.find('.buttonSizeSelect').val();
	        var colorVal = buttonParent.find('.buttonColorSelect').val();
	        var targetVal = buttonParent.find('.buttonTarget').val();
	        buttonArray[thisNum] = '[button target="'+targetVal+'" '+sizeVal+' '+blockVal+' '+colorVal+'] .. [/button]';
	        displayShortCode(buttonArray);
	        
   }).trigger('change');



	

/////////////////////////
// badges
/////////////////////////
	jQuery(".badgesSelect").change(function () {

	        jQuery(".badgesSelect option:selected").each(function () {
	              badgeName = jQuery(this).text();
	              badgeVal = jQuery(this).val();
	              category = 'buttons';
	            });
			jQuery('#selectedShortCodeName').text('\n[badge '+badgeVal+'] .. [/badge]');
	  }).trigger('change');


/////////////////////////
// labels
/////////////////////////
	jQuery(".labelSelect").change(function () {

	        jQuery(".labelSelect option:selected").each(function () {
	              labelName = jQuery(this).text();
	              labelVal = jQuery(this).val();
	              category = 'buttons';
	            });
			jQuery('#selectedShortCodeName').text('\n[label '+labelVal+'] .. [/label]');
	  }).trigger('change');


	jQuery(".calloutSelect").change(function () {
	        var typeVal = jQuery('#calloutType').val();
	        var bgVal = jQuery('#calloutBG').val();
	        var sizeVal = jQuery('#calloutSize').val();

	        if(typeVal == 'type="hero-unit"'){
	        	jQuery('#calloutBG').closest('.control-group').fadeIn();
	        }else if(typeVal =='type="well"'){
	        	jQuery('#calloutBG').closest('.control-group').fadeIn();
				jQuery('#calloutSize').closest('.control-group').fadeIn();
	        }else{
	        	jQuery('#calloutSize').closest('.control-group').fadeOut();
	        	jQuery('#calloutBG').closest('.control-group').fadeOut();
	        }
			jQuery('#selectedShortCodeName').text('\n[callout '+typeVal+' '+bgVal+' '+sizeVal+'] .. [/callout]');
   }).trigger('change');

////////////////
// tabs
////////////////
	var tabsArray = new Array();
	tabsArray[0] = '[tabs]';
	var t=1;

	// ADD Tab
		jQuery('#addTab').click(function(){
			t++;

			var cloned = jQuery('#tabBuilder > div').clone(true);
			cloned.find('.control-label span').text(t);
			cloned.attr('id','tab'+t);
			cloned.find('input').val('');
			cloned.insertBefore('#addTab');
		});
	// REMOVE TAB
		jQuery('.removeTab').click(function(){
			if(jQuery(this).closest('.control-group').attr('id') != 'tab1'){
				var thisNum = jQuery(this).closest('.control-group').attr('id');
		        thisNum = parseInt(/tab(\d+)/.exec(thisNum)[1], 10);
				jQuery(this).closest('.control-group').remove();
				//tabsArray.splice(thisNum,1);
				tabsArray[thisNum]= '';
				displayShortCode(tabsArray);
			}else{
				alert('sorry, you need at least one column here');
			}
		});

		jQuery("#tabsType").change(function () {
			var tabsType = jQuery(this).val();
			tabsArray[0]='[tabs '+tabsType+']';
			displayShortCode(tabsArray);
		});

		jQuery(".tabTitle").change(function () {
			
			var thisNum = jQuery(this).closest('.control-group').attr('id');
			thisNum = parseInt(/tab(\d+)/.exec(thisNum)[1], 10);
	        
	        var tabTitleVal = jQuery(this).val();
	        
        	tabsArray[thisNum] = '\n[tab title="'+tabTitleVal+'"] .. [/tab]';
			displayShortCode(tabsArray);
	    });


///////////////
// collapsible
///////////////
	
	collapsibleArray[0] = '';
	var c=1;

	// ADD Tab
		jQuery('#addCollapsible').click(function(){
			c++;

			var cloned = jQuery('#collapsibleBuilder > div').clone(true);
			cloned.find('.control-label span').text(c);
			cloned.attr('id','collapsible'+c);
			cloned.find('input').val('');
			cloned.insertBefore('#addCollapsible');
		});
	// REMOVE TAB
		jQuery('.removeCollapsible').click(function(){
			if(jQuery(this).closest('.control-group').attr('id') != 'collapsible1'){
				var thisNum = jQuery(this).closest('.control-group').attr('id');
		        thisNum = parseInt(/collapsible(\d+)/.exec(thisNum)[1], 10);
				jQuery(this).closest('.control-group').remove();
				//collapsibleArray.splice(thisNum,1);
				collapsibleArray[thisNum]='';
				displayShortCode(collapsibleArray);
			}else{
				alert('sorry, you need at least one column here');
			}
		});


		jQuery("#collapsibleGroup").change(function () {
			
			if(jQuery(this).is(':checked')){
				collapsibleArray[0]='[collapsibles]';
			}else{
				collapsibleArray[0]='';
			}
			
			displayShortCode(collapsibleArray);
		});
		jQuery(".collapsibleTitle").change(function () {
			
			var thisNum = jQuery(this).closest('.control-group').attr('id');
			thisNum = parseInt(/collapsible(\d+)/.exec(thisNum)[1], 10);
	        //var collapsiblesType = jQuery('collapsibleGroup').val();
	        var collapsibleTitleVal = jQuery(this).val();
	        
        	collapsibleArray[thisNum] = '\n[collapsible title="'+collapsibleTitleVal+'"] .. [/collapsible]';
			displayShortCode(collapsibleArray);
	    });
////////////////////////
////// gallery

		jQuery('.galleryStyle').change(function(){
			var style = jQuery(this).val();
			var display = '[gallery style="'+style+'" ]';
			jQuery('#selectedShortCodeName').text(display);
		});



// tables
	jQuery("#addCell").on("click",function(){
		var firstColumn = jQuery('#table thead tr th:first-child');
		jQuery(firstColumn).clone(true).insertAfter(firstColumn);
		if(document.getElementById('table').rows.length > 1){
			updateCells();
		}else{
			var display = jQuery("#tableContainer").clone();
			display.find('.removeCell').remove(); display = display.html();
			jQuery('#selectedShortCodeName').text(display);
		}
	});

	jQuery("#addTableRow").on("click",function(){
		jQuery('#table tbody').append('<tr></tr>');
		updateCells();
	});

	function updateCells(){
		var cellsCount = document.getElementById('table').rows[0].cells.length;
		var cells = "";
		for(var c=1; c <= cellsCount; c++){
			cells += "<td />";
		}
		jQuery("#table tbody tr").each(function(){
			jQuery(this).html(cells);
		});
		var display = jQuery("#tableContainer").clone();
		display.find('.removeCell').remove(); display = display.html();
		jQuery('#selectedShortCodeName').text(display);

	}
/*	
	jQuery(".removeCell").on("click", function(){
		jQuery(this).parent('th').remove();
		updateCells();
	});*/
	jQuery("#removeTableColumn").on("click", function(){
		if(document.getElementById('table').rows[0].cells.length >1){
			jQuery("#table thead th:last-child").remove();
		}else{
			alert("Sorry, you need at least ONE column!");
		}
		
		updateCells();
	});
	jQuery("#removeTableRow").on("click", function(){
		jQuery("#table tbody tr:last-child").remove();
		updateCells();
	});


	jQuery(".tableStyles").change(function(){
		var thisClass = jQuery(this).val();
		if(jQuery(this).is(':checked')){		
			jQuery("#table").addClass(thisClass);
			updateCells();
		}else{
			jQuery("#table").removeClass(thisClass);
			updateCells();
		}

	});

// Magic
	jQuery('#hideTitle').change(function(){

		if(jQuery(this).is(':checked')){
			jQuery('#selectedShortCodeName').text('\n[hideTitle]');	
		}else{
			jQuery('#selectedShortCodeName').text('');
		}
		
	});

//////////////////////////
// Inserts Code into page
		jQuery('#selectedShortCodeName').text('');
		jQuery("#insertCode").click(function(){
//				getShortCode(category, thisVal);
				var shortCodeVal = jQuery('#selectedShortCodeName').text();
				window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.id, 'mceInsertContent', false, shortCodeVal);
				tinyMCEPopup.editor.execCommand('mceRepaint');
				tinyMCEPopup.close();
		});
	});