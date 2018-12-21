	/* ******************************************************************************* 

		STICKY HEADER

	********************************************************************************** */

		if( ! $.fn.rt_sticky_header ){

			$.fn.rt_sticky_header = function()
			{

					if( $(this).length == 0 ){
						return;
					}

					var header = $(this);
					var site_logo = $(".site-logo, .site-logo img");
					var site_name = $(".site-logo .sitename > a");
					var main_content = $("#container");

					if( Modernizr.touch || $.fn.is_mobile_menu() ){
						header.removeClass( "stuck" );
						main_content.removeAttr("style");
						site_logo.removeAttr("style");
						return;
					}

					var header_right = $(".header-right");
					var navigation_bar_height = header.outerHeight();
					var header_top_position = header.position().top;
					var wp_admin_bar_height = $("#wpadminbar").outerHeight();
					var top_distance = ( header.position().top - wp_admin_bar_height ) + navigation_bar_height ;

					if( header.length > 0 ){

						//scroll function
						$(window).scroll(function(event) {

							if( $.fn.is_mobile_menu() ){
								return;
							}

							var y = $(window).scrollTop();

							if( y > top_distance ){
								header.addClass( "stuck" );
								main_content.css({"padding-top":top_distance +"px"});
								site_logo.css({"max-height":header_right.height()+"px"});
								site_name.css({"line-height":header_right.height()+"px",padding:"0"});
							}else{
								header.removeClass( "stuck" );
								main_content.removeAttr("style");
								site_logo.removeAttr("style");
								site_name.removeAttr("style");
							}
						});
					}

			};

		}

		$(window).on('window_width_resize load', function() {
			$(".sticky.top-header").rt_sticky_header();
		});

