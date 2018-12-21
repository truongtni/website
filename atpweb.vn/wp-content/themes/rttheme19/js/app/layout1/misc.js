	/* ******************************************************************************* 

		RIGHT BACKGROUND HEIGHT 

	********************************************************************************** */  

	if( ! $.fn.rt_side_height ){

		$.fn.rt_side_height = function()
		{ 

			var right_side = $("#right_side"),
				left_side = $("#left_side"),
				reduce = 0,
				height = 0,
				wp_admin_bar = $("#wpadminbar");

			if( wp_admin_bar.length > 0 ){
				reduce = wp_admin_bar.outerHeight();
			}

			if($.fn.is_mobile_menu()){
				height = "";
			}else{
				height = Math.max($(window).innerHeight(),left_side.height(),right_side.height()) - reduce +"px";
			}

			left_side.css( { "min-height" : height });
			right_side.css( { "min-height" : height });

		};
	}

	if ( $.fn.rt_side_height ) {  

		$(window).on('resize', function() {     
			$.fn.rt_side_height();
		});	

		Pace.on('hide', function(){
			$.fn.rt_side_height();
		});
	}

	if( ! $.fn.rt_side_margin ){

		$.fn.rt_side_margin = function()
		{ 

			var right_side = $("#right_side"),
				left_side = $("#left_side");


			if($.fn.is_mobile_menu()){
				right_side.removeAttr("style");
			}else{

				if( is_rtl ){
					right_side.css( { "margin-right" : left_side[0].getBoundingClientRect().width });
				}else{
					right_side.css( { "margin-left" : left_side[0].getBoundingClientRect().width });
				}
			}
			
		};
	}

	if ( $.fn.rt_side_margin ) {  
		$(window).on('rt-loaded resize', function() {  
			$.fn.rt_side_margin();
		});	

		Pace.on('hide', function(){
			$.fn.rt_side_margin();
		});		
	}

	/* ******************************************************************************* 

		FIXED SIDEBAR POSITION

	***********************************************************************************/ 
	if( ! $.fn.rt_left_height ){

		$.fn.rt_left_height = function()
		{ 
			var left_side = $("#left_side");

			if( Modernizr.touch ){
				left_side.removeClass("fixed_position scroll");
				return ;
			}

			$(window).off(".rt_sidebar");

			if( ! left_side.hasClass("fixed_position")){
				return ;
			}

			var side_content = $("#side_content").removeAttr("style"),
				side_content_height = side_content.innerHeight(),
				content_height = $("body").height(),
				side_content_top_pos = side_content.offset().top,
				$window = $(window),
				window_height = $window.height(),
				window_scrollTop = $window.scrollTop(),
				diff = window_height - ( ( side_content_top_pos - window_scrollTop ) + side_content_height );			

				if( diff > 0 ){
					return false;
				} 

				//make two side heights are equal  
				if ( side_content_height > content_height ) {
					$("#right_side").css( { "min-height" : side_content_height+side_content_top_pos+"px"});
				}

				//scroll
				$(window).on("scroll.rt_sidebar", function( event ){

					var y = -1 * $window.scrollTop();

						y = Math.max( y, diff );

						$(side_content).css({ 
							"-webkit-transform": "translateY("+y+"px)",
							"-moz-transform": "translateY("+y+"px)",
							"-ms-transform": "translateY("+y+"px)",
							"-o-transform": "translateY("+y+"px)",
							"transform": "translateY("+y+"px)"
						});

						$(side_content).attr("data-position-y",y);		

				});
		};
	}

	if ( $.fn.rt_left_height ) {  

		$(window).on('rt_loaded resize', function() {  
			$.fn.rt_left_height();
		}); 		
	} 

	/* ******************************************************************************* 

		PARALLAX SIDEBAR BACKGROUND IMAGE

	***********************************************************************************/ 

	$.fn.rt_left_background = function()
	{

		var left_side =  $("#left_side");

		if( left_side.length == 0 ){
			return;
		}
		
	  	var parallax_effect = ! Modernizr.touch ? left_side.attr("data-parallax-effect") : false,
			$window = $(window),
			window_height =  $window.height(),
			side_width =  document.getElementById("left_side").getBoundingClientRect().width,
			side_content = $("#side_content"),
			side_content_width = side_content.innerWidth(),
			side_content_height = side_content.outerHeight(),
			padding_top = 50, //#left_side top padding
			side_background_holder = left_side.find(".left-side-background-holder");


			var parallax_height = parallax_effect ? 300 : 100,
				parallax_height = window_height + parallax_height; 		

			side_background_holder.find(".left-side-background").css({ 
							"width": side_width+100+"px",
							"height": parallax_height+"px"
						});

			//turn off parallax if it is not enabled
			if ( ! parallax_effect || Modernizr.touch ) {
				return false;
			}

			//parallax effect
			$(window).on("scroll.rt_left_background", function( event ){

				//for the side background image
				var y = Math.max ( -1 * ( $window.scrollTop() * 0.03 ), - ( parallax_height - window_height ) ) ; 

				side_background_holder.find(".left-side-background").css({  
						"-webkit-transform": "translateY("+y+"px)",
						"-moz-transform": "translateY("+y+"px)",
						"-ms-transform": "translateY("+y+"px)",
						"-o-transform": "translateY("+y+"px)",
						"transform": "translateY("+y+"px)"
				});  

			});		

		return false;	
	}


	$(window).on('rt_images_loaded resize', function() {  
		$.fn.rt_left_background();
	}); 

