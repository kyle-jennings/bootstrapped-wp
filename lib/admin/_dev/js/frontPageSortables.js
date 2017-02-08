
  /* -----------------------------------------------------------
  			Front Page Settings
  ----------------------------------------------------------- */

  if ( $('#frontpage-sortables').length ){
  // activates components
  	function setComponentNames(element, id) {
  		var newId = "componentOrder_" + id;
  		$(element).attr("id", newId);
         	$(".labelID", element).html(id);

  	 	$(".component", element).attr("name", "kjd_frontPage_layout_settings[kjd_frontPage_layout]["+id+"][component]");
  	 	$(".componentDisplay", element).attr("name", "kjd_frontPage_layout_settings[kjd_frontPage_layout]["+id+"][display]");
  	 	$(".componentDeviceView", element).attr("name", "kjd_frontPage_layout_settings[kjd_frontPage_layout]["+id+"][componentDeviceView]");
  	 	$(".componentDisplay", element).val('on');
  	}

  //	deactivates components
  	function removeComponentNames(element, id) {
  		var newId = "componentOrder_" + id;

  	 	$(".component", element).attr("name", "");
  	 	$(".componentDisplay", element).attr("name", "");
  	 	$(".componentDisplay", element).val('off');

  		$(".componentDeviceView", element).attr("name", "");
  	}

  //	Sets components as sortable
  	$("#activeComponents, #inactiveComponents").sortable({
  		placeholder: "ui-state-highlight",
  		connectWith: ".connectedSortable",
  		update: function(event, ui) {

  	    	var container = $(this).closest('.connectedSortable').attr('id');

  	    	if(container == 'activeComponents'){
  	    		var i = 0;
  			    $("li", this).each(function() {
  			        setComponentNames(this, i);
  			        i++;
  			    });
  	    	}else{
  	    		var i = 0;
  			    $("li", this).each(function() {
  			        removeComponentNames(this, i);
  			        i++;
  			    });
  	    	}

  		}, receive: function(e){

            // console.log(e.target, e.srcElement);
            var targetID = $(e.target).attr('id');
            var component = $(e.srcElement).data('component');


  	    	var container = $(this).closest('.connectedSortable').attr('id');

  	    	if(container == 'activeComponents'){
  	    		var i = 0;
  			    $("li", this).each(function() {
  			        setComponentNames(this, i);
  			        i++;
  			    });
  	    	}else{
  	    		var i = 0;
  			    $("li", this).each(function() {
  			        removeComponentNames(this, i);
  			        i++;
  			    });
  	    	}
  		}

  	});

  	$( "#activeComponenets" ).disableSelection();

  }
