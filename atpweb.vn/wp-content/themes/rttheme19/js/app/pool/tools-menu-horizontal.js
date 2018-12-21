	/* ******************************************************************************* 

		TOOLS MENU

	********************************************************************************** */  
	
	$("#tools > ul:first-child > li > span").on("click",function(e){

		if( ! $(this).hasClass("active") ){
			$(this).addClass("active");
			$("#tools > ul:last-child").addClass("active");
		}else{
			$(this).removeClass("active");
			$("#tools > ul:last-child").removeClass("active");
		}

	});

