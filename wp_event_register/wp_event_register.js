
$(document).ready(function(){ 

	$("#wpbody-content").css({ 
		// this is just for style       
		"overflow": "visible!important" 
	});
	var status = "";        
	$('button.reply').click( function() {
        	status = jQuery(this).attr('id');
        	loadPluginBox();
	});
	$('.pluginBoxClose').click( function() {           
        	unloadPluginBox();
	});

	function unloadPluginBox() {    
		// TO Unload the Popupbox
        	$('.plugin_box').fadeOut("slow");
        	$("#container").css({ // this is just for style       
                "opacity": "1" 
        });
	}    
	function loadPluginBox() {    
		// To Load the Popupbox
        	$('.plugin_box-'+status).fadeIn("slow");
        	$("#container").css({ // this is just for style
                "opacity": "0.3" 
        	});        
	}        
});

