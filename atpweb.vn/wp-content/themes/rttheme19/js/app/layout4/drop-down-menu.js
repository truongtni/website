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

	$(".header-elements .menu > li:not(.multicolumn).menu-item-has-children").rt_drop_down();

	/* ******************************************************************************* 

		TOP BAR DROP DOWN MENU

	********************************************************************************** */

	if( ! $.fn.rt_topbar_drop_down ){

		$.fn.rt_topbar_drop_down = function()
		{ 

			if( $.fn.is_mobile_menu() ){
				return ;
			}

			var $this = $(this);				


			$this.each(function(){

					var menu_items_with_sub = $(this).find(".menu-item-has-children"),
						max_depth = 0;

					menu_items_with_sub.each(function(){
						max_depth = Math.max( max_depth, $(this).parents("ul").length  ); 
					});

					if( ! is_rtl ){

						if( window_width < $(this).offset().left + ( max_depth + 1  * 180 ) ){
							$(this).addClass("o-direction");
						}					

					}else{

						if( 0 > ( $(this).offset().left - ( max_depth + 1 * 180 ) ) ){
							$(this).addClass("o-direction");
						}
					}
			});  

		};
	}

	$(".top-bar-right .topbar-widget .menu > li.menu-item-has-children").rt_topbar_drop_down();
	
	/* ******************************************************************************* 

		MEGA MENU

	********************************************************************************** */  
 
	$('.header-elements .menu .multicolumn > ul > li.menu-item-has-children > a').each(function(){

		if( $(this).attr("href") == "#" || $(this).attr("href") == "" ){
			var $this = $(this);
			$('<span class="">'+$(this).html()+'</span>').insertAfter($this); 
			$this.remove();
		}

	});


	if( ! $.fn.rt_mega_menu ){

		$.fn.rt_mega_menu = function()
		{ 

			if( $.fn.is_mobile_menu() ){
				return ;
			}

			var $this = $(this),
				header = $(".header-elements"),
				header_width = header[0].getBoundingClientRect().width;


			$this.each(function(){

				if( ! is_rtl ){

					var menu = $(this).find("> ul"),
						col_size = $(this).data("col-size"),
						leftPos  = $(this).offset().left,
						menu_width = Math.min( col_size * 300 , header_width ),
						leftMargin = Math.ceil( header_width + header.offset().left ) - ( leftPos + menu_width),
						menuid = $(this).parent(".menu").attr("id");

					menu.css({
						"width" : menu_width
					});

					if( menuid == "second-navigation" ){

						if( $(this).offset().left + $(this).outerWidth() < menu_width  ){
							menu.css({
							"margin-left" : - 1 * ( $(this).offset().left - header.offset().left )
							});
						}

					}

					if( menuid == "navigation" ){

						if( leftMargin > 0 ){
							menu.removeAttr("style");
							return;
						}
																					
						menu.css({
						"margin-left" : parseFloat(leftMargin)
						});
					}


				}else{

					var menu = $(this).find("> ul"),
						col_size = $(this).data("col-size"),
						menu_width = Math.min( col_size * 300 , header_width ),						
						item_width = $(this).outerWidth(),
						leftPos  = $(this).offset().left + item_width,
						menuid = $(this).parent(".menu").attr("id"),
						margin;


					menu.css({
						"width" : menu_width
					});

							
					if( menuid == "second-navigation" ){

					 	margin = leftPos - ( header_width + header.offset().left );
						menu.css({
							"margin-right" :  -1 * margin < menu_width ? margin : 0 
						});

					}else{

						menu.css({
							"margin-right" : Math.min(0, - 1 * (  header.offset().left - (leftPos - menu_width))  )
						});

					}
					 
				}


			});  

		};
	}

	var rt_mega_menu = $(".header-elements .menu > li.multicolumn.menu-item-has-children");

	$(window).on('window_width_resize', function() { 
		rt_mega_menu.rt_mega_menu();
	});

	rt_mega_menu.rt_mega_menu();


	/* ******************************************************************************* 

		MENU ANIMATIONS

	********************************************************************************** */  

	var rt_nav = $(".header-elements .menu > li.menu-item-has-children, .header-elements .menu > li:not(.multicolumn).menu-item-has-children li");

	function rt_menu_animate(element) {
		var m_anim = new TimelineLite();
		m_anim.from("", 0, {}, "=0.2");  											 
		m_anim.from($(element).find("> ul"), 0.4, { ease:  Power3.easeOutIn, y: 50, autoAlpha: 0 }, "=-0.2");  
		return m_anim;
	}										 	

	function rt_menu_item_over(){	
		if(!this.animation){
			this.animation = rt_menu_animate(this);
		}else{
			this.animation.play().timeScale(1);
		}
	}

	function rt_menu_item_out(){
		this.animation.reverse().timeScale(10); 
	}	

	if( !  Modernizr.touch ){
		rt_nav.hover(rt_menu_item_over, rt_menu_item_out);	
	}

	/* *******************************************************************************

		TABLET DROP-DOWN TOUCH FIX

	********************************************************************************** */

	$.fn.rt_menu_touch_fix = function()
	{

		$(this).on("touchstart",function(e){

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