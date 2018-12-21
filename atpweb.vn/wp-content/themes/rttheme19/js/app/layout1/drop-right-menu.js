	/* ******************************************************************************* 

		DROP RIGHT MENU

	********************************************************************************** */

	if( ! $.fn.rt_drop_right ){

		$.fn.rt_drop_right = function()
		{ 
			if ($(this).length == 0 ){
				return false;
			}

			$(this).on("mouseover",function(){

				if( $("body").hasClass("mobile-menu") ){
					return false;
				}

				if( $(this).prev() && $(this).parent().hasClass("sub-menu") ){
					var add = 0;
				}else{
					var add = 1;
				}

				var margin_top = -1 * ( $(this).outerHeight() + add );
				var sub_menu = $(this).find("ul:eq(0)").css({"margin-top":margin_top +"px"});

				if ( sub_menu.length == 0 ){
					return false;
				}

				var sub_menu_height = sub_menu.outerHeight(),
					sub_menu_position = $(sub_menu).offset().top,
					_window = $(window),
					window_height = _window.height()+margin_top,
					window_scrollTop = _window.scrollTop(),
					diff = window_height - ( ( sub_menu_position - window_scrollTop ) + sub_menu_height );

					if( diff < 0 ){ 
						sub_menu.css({"margin-top": margin_top + diff + "px"});
					} 

					if( sub_menu.offset().left + 250 > _window.width() ){ 
						sub_menu.css({"right": "250px"});
					} 
			});

		};
	}

	$('#navigation li').rt_drop_right();

