	/* ******************************************************************************* 

		TOOLS MENU

	********************************************************************************** */  
	
	$("#tools > ul > li > span").on("click",function(e){


		var holder = $(this).parent("li"),
			 widget = holder.find("div:eq(0)");

		$("#tools > ul > li").each(function(){				

			if ( ! $(this).is(holder) ){
				$(this).removeClass("active");	
			}
			
		});


		if( holder.hasClass("active") ){ 
			holder.removeClass("active");	
		}else{
			holder.addClass("active");
			

			if( ! is_rtl ){
				widget.css({"margin-left": -1 * holder.position().left +"px"});
			}else{
				widget.css({"margin-right":"0"}).css({"margin-right":  widget.position().left + holder.position().left +"px"});
			}
				
		}

		$.fn.rt_left_height();
		$(window).trigger("scroll");  

	});

