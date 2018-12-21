	/* ******************************************************************************* 

		HORIZONTAL HEADER ELEMENTS 

	***********************************************************************************/ 
	$(window).on('window_width_resize load', function() {    
		
		if( $.fn.is_mobile_menu() ){
			var nav_height = $(".header-right").outerHeight();
			$(".header-elements").css({"min-height":nav_height+"px"});
		}else{
			$(".header-elements").css({"min-height":"auto"});
		}
	});

