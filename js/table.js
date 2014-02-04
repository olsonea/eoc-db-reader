jQuery(document).ready(function($) {  
    
    //~ $("tr").on("click", function() {
		//~ $(this).addClass("highlight");
		//~ });
	//~ 
	//~ $("tr").off("blur", function() {
		//~ $(this).removeClass("highlight");
		//~ });
		
		//$("tr").toggle(function(){
			//$(this).addClass("highlight");
		//}, function(){
			//$(this).removeClass("highlight");
		//});
		
		var selected = [];
		$("tr").click(function() {
			$(this).parent("tbody").children("tr").removeClass("highlight");
			$(this).addClass("highlight");
			selected["row"] = $(this).parent("body").index();
		});
});
