jQuery(document).ready(function($) {  
	$(".click").editable('save.php', { 
		indicator 	: "<img src='<?php plugins_url('img/indicator.gif', __FILE__)'>",
		tooltip   	: "Click to edit...",
		cancel    	: 'Cancel',
		submit    	: 'OK',
		style  		: "inherit"
	});
 
});
