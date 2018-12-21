
	/* ******************************************************************************* 

		TOGGLE MOBILE MENU

	***********************************************************************************/ 
	function rt_toggle_mobile_menu(menu_button){
		menu_button.toggleClass("icon-menu icon-menu-outline");
		$("body").toggleClass("mobile-menu-active");			
	}

	//on menu button click
	$(".mobile-menu-button").on("click",function() {
		rt_toggle_mobile_menu($(this));
		return false;
	});

	//on right side click
	$("#right_side").on('touchstart click', function(e) {
		if( $("body").hasClass("mobile-menu-active") ){
			rt_toggle_mobile_menu($(".mobile-menu-button"));
			return false;
		}
	});

	$(window).on('window_width_resize load', function() {     
		
		if($.fn.is_mobile_menu()){
			$("body").addClass("mobile-menu");
		}else{
			$("body").removeClass("mobile-menu");
			$("body").removeClass("mobile-menu-active");
		}
 
		if( Modernizr.touch && is_layout1 ){
			$("body").addClass("mobile-menu");
			return false;
		}

	});



	/* ******************************************************************************* 

		MOBILE DROP DOWN MENU

	********************************************************************************** */

	if( ! $.fn.rt_mobile_drop_down ){

		$.fn.rt_mobile_drop_down = function()
		{ 

			$(this).on("click",function(e){

				if( ! $("body").hasClass("mobile-menu") ){
					return ;
				}

				var $this = $(this).parent("li");		



				if( ! is_rtl ){

					if( ! $this.hasClass("menu-item-has-children") || e.pageX - $this.position().left < 225){
						return ;
					}

				}else{

					if( ! $this.hasClass("menu-item-has-children") || e.pageX - $("#left_side").position().left > 50 ){
						return ;
					}
				}
				
				e.preventDefault();
				
				$this.toggleClass("current-menu-item");

				return false;

			});

		};
	}

	$(window).on('load', function() {  
		$('#navigation li a').rt_mobile_drop_down();
	});

