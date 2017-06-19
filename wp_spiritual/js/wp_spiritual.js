/* 
 * Js for wp_spiritual plugin 
 * Author: Girish Vas
 * Plugin Version:1.1
 * Last Edit: 8-10-2016
 * Edited By:
 * Edit comments: $.noconflict added, converted $ to jQuery by BrSaket 8-10-2016 
*/
	jQuery.noConflict();
	

	jQuery(document).ready(function () {

		jQuery("#addevent").click(function(){

			jQuery("#l-event").show();
		});
	});


	jQuery(function() {
		jQuery( ".dater" ).datetimepicker(
		{ dateFormat: 'yy-mm-dd' });
	});

	jQuery(function() {
		jQuery( ".dateto" ).datetimepicker(

		{ dateFormat: 'yy-mm-dd' });
	});

	function gstate(abc) {
		print_state('state',abc);
	}
