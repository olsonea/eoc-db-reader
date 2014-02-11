jQuery(document).ready(function($) { 
	//alert(ajaxurl); //Check to see the value of ajaxurl.
	//var oTable = $.("#data").dataTable();
	
	$(".click").editable(ajaxurl + '?action=writeValue', { 
		indicator 	: "Saving...",
		tooltip   	: "Click to edit...",
		cancel    	: 'Cancel',
		submit    	: 'OK',
		style  		: "inherit",
		callback	: function(value,settings){
			console.log(value);
		}
	});
});
