
	/* ******************************************************************************* 

		TOGGLE MOBILE MENU

	***********************************************************************************/ 


	var rt_menu_icon_animation = {};

	function rt_menu_icon_animate(){

		var menu_button = $(".mobile-menu-button");
		var span = menu_button.find("span");
		var span_top = menu_button.find("span:eq(0)");
		var span_center = menu_button.find("span:eq(1)");
		var span_bottom = menu_button.find("span:eq(2)");

		var anim = new TimelineLite();


		anim.to( span_center, 0.3, { ease: Power3.easeOut, y: 0, autoAlpha: 0 }, "=-0.2");  
		anim.to( span_top, 0.3, { ease: Circ.easeInOut, rotation: 45, y: 2, transformOrigin:"center center", autoAlpha: 1 }, "=-0.2");  
		anim.to( span_bottom, 0.3, { ease: Circ.easeInOut, rotation: -45, y: -2, transformOrigin:"center center", autoAlpha: 1 }, "=-0.2");  

		return anim;
	}


	function rt_toggle_mobile_menu(menu_button){
		

		if(!rt_menu_icon_animation.animation){
				rt_menu_icon_animation.animation = rt_menu_icon_animate();
		}else{
			if ( rt_menu_icon_animation.animation.reversed() ) {											
				rt_menu_icon_animation.animation.play();
			}else{
				rt_menu_icon_animation.animation.reverse();
			}
		}

		$("body").toggleClass("mobile-menu-active");

		$( ".mobile-nav" ).slideToggle( "fast", function() {

		});

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

					if( ! $this.hasClass("menu-item-has-children") || window_width - ( ( window_width - $("#mobile-navigation").width() ) / 2 + e.pageX ) > 55 ){
						return ;
					}

				}else{

					if( ! $this.hasClass("menu-item-has-children") || e.pageX > 65 ){
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
		$('#mobile-navigation li a,#mobile-navigation li > span').rt_mobile_drop_down();
	});


	/* ******************************************************************************* 

		MOBILE CLASSES

	***********************************************************************************/ 

	if( ! $.fn.rt_mobile_classes ){

		$.fn.rt_mobile_classes = function()
		{ 	
				
			var $this = $(this);

			//mobile menu
	 		if($.fn.is_mobile_menu()){
				$this.addClass("mobile-menu"); 
				
			}else{
				$this.removeClass("mobile-menu");
				$this.removeClass("mobile-menu-active"); 				
			}

 
		};

	}	

	$("body").rt_mobile_classes();
	$(window).on('resize', function() {     
		$("body").rt_mobile_classes();
	});	

