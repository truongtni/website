	/* *******************************************************************************

		STICKY HEADER

	********************************************************************************** */


	if( ! $.fn.rt_sticky_header ){

		$.fn.rt_sticky_header = function()
		{
				if( $(this).length == 0 ){
					return;
				}

				var header = $(this),
					header_height = header.outerHeight(),
					body = $("body"),
					main_content = $("#main_content"),
					wp_admin_bar_height = $("#wpadminbar").outerHeight(),
					header_top_position = header.position().top,
					top_distance = ( header.position().top - header_height ) + (header_height*2) ;


				if( header.length > 0 ){

					//scroll function
					$(window).scroll(function(event) {

						if( $.fn.is_mobile_menu() ){
							return;
						}

						var y = $(window).scrollTop();

						if( y < 0 ){
							return;
						}

						if( y < top_distance ){
							header.removeClass( "stuck" );	
							main_content.css({"margin-top":""});						
						}

						if( y > top_distance && y < top_distance + 300  ){

							if( header.hasClass("stuck") ) {
								return;
							}

							header.addClass( "stuck" );

							if( ! body.hasClass("overlapped-header") ){
								main_content.css({"margin-top":header_height});
							}

							if( ! body.hasClass("header-stuck-before") ){
								body.addClass("header-stuck-before");
							}
						}

					});
				}
		};

	}

	$(window).on('window_width_resize load', function() {
		$(".sticky.top-header").rt_sticky_header();
	});

