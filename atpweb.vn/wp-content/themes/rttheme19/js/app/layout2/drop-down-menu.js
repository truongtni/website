	/* ******************************************************************************* 

		DROP DOWN MENU

	********************************************************************************** */

	if( ! $.fn.rt_drop_down ){

		$.fn.rt_drop_down = function()
		{ 

			if( $.fn.is_mobile_menu() ){
				return ;
			}

			var $this = $(this);				

			$this.each(function(){

					var menu_items_with_sub = $(this).find(".menu-item-has-children"),
						max_depth = 0;

					menu_items_with_sub.each(function(){
						max_depth = Math.max( max_depth, $(this).data("depth") ); 
					});

					if( ! is_rtl ){

						if( window_width < $(this).offset().left + ( ( max_depth + 1 ) * 240 ) ){
							$(this).addClass("o-direction");
						}					

					}else{

						if( 0 > ( $(this).offset().left - ( ( max_depth + 1 ) * 240 ) ) ){
							$(this).addClass("o-direction");
						}
					}
			});  

		};
	}

	$("#navigation > li:not(.multicolumn).menu-item-has-children").rt_drop_down();


	/* *******************************************************************************

		TABLET DROP-DOWN TOUCH FIX

	********************************************************************************** */

	$.fn.rt_menu_touch_fix = function()
	{

		$(this).on("touchstart",function(e){

			if( $("body").hasClass("mobile-menu") ){
				return ;
			}

			e.preventDefault();		

			var this_li = $(this).parent("li"); 
			var this_link = $(this).attr("href"); 
			
			if( this_li.hasClass("hover") ){
				window.location = this.href;
				return true;
			}	

			var hovered = $(this).parents("ul:eq(0)").find("> li.hover");

			if( ! hovered.is( $( this ) ) ){
				hovered.removeClass("hover");
			}

			this_li.addClass("hover");
 			
			return false;
 			
		})

	};
	
	if(  Modernizr.touch ){//check touch support	 
		$( '.header-elements .menu li:has(ul) > a').rt_menu_touch_fix(); 
	}