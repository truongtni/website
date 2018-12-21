
	/* ******************************************************************************* 

		MOBILE MENU

	***********************************************************************************/ 
	function rt_toggle_mobile_menu(menu_button){
		menu_button.toggleClass("icon-menu icon-menu-outline");
		$("body").toggleClass("mobile-menu-active");

		if( $("body").hasClass("mobile-menu-active") ){ 
			$.fn.rt_passive_close();
		}else{
			$("#main_content").off('touchstart click');
		}
	}

	//on menu button click
	$(".mobile-menu-button").on("click",function() {
		rt_toggle_mobile_menu($(this));
		return false;
	});

	//click outside of mobile menu
	$.fn.rt_passive_close = function(){
		$("#main_content").on('touchstart click', function(e) {
			if( $("body").hasClass("mobile-menu-active") ){
				rt_toggle_mobile_menu($(".mobile-menu-button"));
				return false;
			}
		});
	};

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

				var $this = $(this);				

				if( ! is_rtl ){

					if( ! $this.hasClass("menu-item-has-children") || e.pageX - $this.position().left < 225){
						return ;
					}

				}else{

					if( ! $this.hasClass("menu-item-has-children") ||  $(window).width() - e.pageX < 240 ){
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
		$('#navigation li').rt_mobile_drop_down();
	});

