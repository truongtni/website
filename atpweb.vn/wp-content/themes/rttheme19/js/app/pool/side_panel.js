
	/* ******************************************************************************* 

		FULLSCREEN MENU

	********************************************************************************** */  

	$('.side-panel-holder').perfectScrollbar({
		suppressScrollX: true
	});  

	var side_animation = {};

	$.fn.rt_toggle_side_panel = function()
	{

		//toggle body class
		$("body").toggleClass("side-panel-on");	 

 	
 		//animations
		function h_menu_icon_animation(el) {
			var menu_button = $(".rt-menu-button");
			var span_top = menu_button.find("span:eq(0)");
			var span_center = menu_button.find("span:eq(1)");
			var span_bottom = menu_button.find("span:eq(2)"); 
			var menu_cont = $(".side-panel-holder");
			var menu_cont_speed = 0;  


			var anim = new TimelineLite({

				onComplete:function(){
					//passive close		
					$("#content-overlay").on('touchstart click', function(e) {
						$(window).trigger("rt_side_panel");
					}); 

					$('side-panel-holder').perfectScrollbar('update');  
				},
				onReverseComplete:function(){
					//remove passive close		 
					$("#content-overlay").off('touchstart click');

					anim.clear();
					side_animation.animation = false; 

					$("body").removeClass("animate-icon");
				},				
			}); 


			if( $("body").hasClass("animate-icon") ){
				anim.to( span_center, 0.3, { ease: Power3.easeOut, y: 0, autoAlpha: 0 }, "=-0.2");  
				anim.to( span_top, 0.3, { ease: Circ.easeInOut, rotation: 45, y: 2, transformOrigin:"center center", autoAlpha: 1 }, "=-0.2");  
				anim.to( span_bottom, 0.3, { ease: Circ.easeInOut, rotation: -45, y: -2, transformOrigin:"center center", autoAlpha: 1 }, "=-0.2");  
				menu_cont_speed = -0.3;
			}

			anim.to( menu_cont, 0.5, { ease: Circ.easeInOut, x: 0 }, "="+menu_cont_speed);
					
			var class_list = ".rt-language-list.animate h5, .rt-language-list.animate li, .side-panel-contents .wp-search-form.animate, .side-panel-contents #rt-side-navigation.animate > li, .side-panel-contents .side-panel-widgets.animate > .widget, .side-panel-contents .widget.woocommerce.animate, .side-panel-contents .widget.rt_woocommerce_login.animate"; 			

			if( $.fn.is_mobile_menu() ){
				anim.to( class_list , 0.3, { ease: Circ.easeInOut, y:0, autoAlpha: 1 }, "0.04"); 
			}else{
				anim.staggerTo( class_list , 0.3, { ease: Circ.easeInOut, y:0, autoAlpha: 1 }, "0.04"); 
			}
 
			return anim;
		}

	
		if(!side_animation.animation){
				side_animation.animation = h_menu_icon_animation(side_animation); 
		}else{
			if ( side_animation.animation.reversed() ) {											
				side_animation.animation.play();
			}else{
				side_animation.animation.reverse();
			}
		}

	}

	$(window).on("rt_side_panel", function(){
		//toggle side panal
		$.fn.rt_toggle_side_panel();			
	});

	$(window).on('rt_side_panel resize', function() {
		if($("body").hasClass("side-panel-on")){
			$(".side-panel-holder").height( $(window).height() );		
		}
	});

	/* ******************************************************************************* 

		SIDE PANEL MENU

	********************************************************************************** */ 
	$("#rt-side-navigation a").on("click",function(e){
		var parent = $(this).parent("li:eq(0)");
		if( parent.hasClass("menu-item-has-children") ){

			if( $(this).attr("href") == "#" ){
				e.preventDefault();	
			}			
			
			parent.toggleClass("active");
			var submenu = parent.find(".sub-menu:eq(0)");
			submenu.slideToggle( 300 );
		}
	});

	/* ******************************************************************************* 

		SEARCH BUTTON MENU

	********************************************************************************** */ 

	$.fn.rt_header_search_button = function()
	{
		$(this).on("click",function(e){ 
			e.preventDefault();			

				$(".side-panel-contents > *:not(.wp-search-form)").removeClass("animate");
				$(".side-panel-contents > .wp-search-form").addClass("animate");

				setTimeout(function() {
					$('.side-panel-contents .search').focus();
				}, 810 );	 	 	


				if( ! $("body").hasClass("side-panel-on") ){
					$(window).trigger("rt_side_panel");		
					$("#content-overlay").off('touchstart click');
				}
		});
	}

	$(".rt-search-button").rt_header_search_button();

	

	/* ******************************************************************************* 

		SIDE PANEL OPEN / CLOSE BUTTON

	********************************************************************************** */  
	$.fn.rtframework_side_menu_button = function()
	{

		$(this).on("click",function(e){ 
			e.preventDefault();			

			$("body").addClass("animate-icon");			
			
			if($.fn.is_mobile_menu()){ 
				$(".side-panel-contents > *").addClass("animate");
			}else{
				$(".side-panel-contents > .rt-language-list, .side-panel-contents > .widget.woocommerce, .side-panel-contents > .widget.rt_woocommerce_login, .side-panel-contents > .wp-search-form").removeClass("animate");
				$(".side-panel-contents > *:not(.rt-language-list):not(.widget.woocommerce):not(.wp-search-form):not(.widget.rt_woocommerce_login)").addClass("animate");
			}

			if( ! $("body").hasClass("side-panel-on") ){
				$(window).trigger("rt_side_panel");		
				$("#content-overlay").off('touchstart click');
			}			
		});

	}
	
	$(".rt-menu-button").rtframework_side_menu_button();

	/* ******************************************************************************* 

		CART BUTTON MENU

	********************************************************************************** */  
	$.fn.rtframework_cart_menu_button = function()
	{

		$(this).on("click",function(e){ 
			e.preventDefault();			
			
			$(".side-panel-contents > *:not(.widget.woocommerce)").removeClass("animate");
			$(".side-panel-contents > .widget.woocommerce").addClass("animate");

			if( ! $("body").hasClass("side-panel-on") ){

				$(window).trigger("rt_side_panel");		

				$("#content-overlay").off('touchstart click');

			}
		});

	}
	
	$(".rt-cart-menu-button").rtframework_cart_menu_button();


	/* ******************************************************************************* 

		USER BUTTON MENU

	********************************************************************************** */  
	$.fn.rtframework_user_menu_button = function()
	{

		$(this).on("click",function(e){ 
			e.preventDefault();			
				
			$(".side-panel-contents > *:not(.widget.rt_woocommerce_login)").removeClass("animate");
			$(".side-panel-contents > .widget.rt_woocommerce_login").addClass("animate");

			if( ! $("body").hasClass("side-panel-on") ){

				$(window).trigger("rt_side_panel");		

				$("#content-overlay").off('touchstart click');

			}
		});

	}
	
	$(".rt-user-menu-button").rtframework_user_menu_button();
	
	/* ******************************************************************************* 

		LANGUAGE BUTTON MENU

	********************************************************************************** */  
	$.fn.rtframework_language_menu_button = function()
	{

		$(this).on("click",function(e){ 
			e.preventDefault();			
			
				if( $("body").hasClass("side-panel-on") ){
					return;
				}
			
				$(".side-panel-contents > *:not(.rt-language-list)").removeClass("animate");
				$(".side-panel-contents > .rt-language-list").addClass("animate");

				$(window).trigger("rt_side_panel");		

				$("#content-overlay").off('touchstart click');

		});

	}
	
	$(".rt-wpml-menu-button").rtframework_language_menu_button();



	/* ******************************************************************************* 

		CONTENT OVERLAY

	********************************************************************************** */ 		 

	$(".side-panel-holder").after('<div id="content-overlay"></div>');


	/* ******************************************************************************* 

		CURSOR CSS
		IE doesn't work with relative urls

	********************************************************************************** */ 		 
	$('<style>.side-panel-on  #content-overlay{ cursor: url("'+rt_theme_params["rttheme_template_dir"]+'/images/close.cur"), pointer;}</style>').appendTo($("head"));	 


