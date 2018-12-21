/*!
 * RT-Theme 19 WordPress Theme - Customizer
 * Copyright (C) 2014 RT-Themes
 * http://rtthemes.com
 *
 */

( function( $ ) {

	
	$.fn.rt_css_replace = function( css )
	{ 

		var search = new RegExp('\{(.*?)\}', 'g'),
			new_css = $(this).text().replace(search, "{"+css+"}");

			$(this).text( new_css );
	};



	/**
	 * content rows css replacer
	 */
	$.fn.runs = function( container )
	{  

		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_link_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_link_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );

		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_bg_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_bg_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );

		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_font_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_font_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );


		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_primary_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_primary_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );

		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_border_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_border_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );


		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_secondary_font_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_secondary_font_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );


		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_light_text_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_light_text_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );


		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_heading_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_heading_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );

		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_form_button_bg_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_form_button_bg_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} ); 


		wp.customize(rt_theme_params["theme_slug"]+'_'+ container +'_social_media_bg_color', function( value ) {
			value.bind( function( to ) {   
				$('[data-id="'+rt_theme_params["theme_slug"]+'_'+ container +'_social_media_bg_color"]').each(function(){
					$(this).rt_css_replace($(this).attr("data-color-for")+":"+to);
				});
			} );
		} );						 

	};
	
	containers = ["default","alt_style_1","alt_style_2","widgets","light_style","footer"]; 

	for (i = 0; i < containers.length; i++) { 
		$.fn.runs( containers[i] );
	};





	/**
	 * HEADER
	 */

	wp.customize(rt_theme_params["theme_slug"]+'_main_header_row_bg_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.top-header').css({
				"background-color": to
			});	
		} );
	} );	


	wp.customize(rt_theme_params["theme_slug"]+'_breadcrumb_font_color', function( value ) {
		value.bind( function( to ) {   
			$('[data-id="'+rt_theme_params["theme_slug"]+'_breadcrumb_font_color"]').each(function(){
				$(this).rt_css_replace( $(this).attr("data-color-for")+":"+to ) ;
			});
		} );
	} );	

	wp.customize(rt_theme_params["theme_slug"]+'_breadcrumb_link_color', function( value ) {
		value.bind( function( to ) {   
			$('[data-id="'+rt_theme_params["theme_slug"]+'_breadcrumb_link_color"]').each(function(){
				$(this).rt_css_replace( $(this).attr("data-color-for")+":"+to ) ;
			});
		} );
	} );	

	wp.customize(rt_theme_params["theme_slug"]+'_breadcrumb_bg_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.breadcrumb').css({
				"background-color": to
			});	
		} );
	} );

	wp.customize(rt_theme_params["theme_slug"]+'_header_row_font_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.sub_page_header h1').css({
				"color": to
			});	
		} );
	} );

	wp.customize(rt_theme_params["theme_slug"]+'_header_row_bg_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.sub_page_header').css({
				"background-color": to
			});	
		} );
	} );	



	/**
	 * native selectors
	 */
	wp.customize(rt_theme_params["theme_slug"]+'_body_background_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('#container').css({
				"background-color": to
			});	
		} );
	} );


	wp.customize(rt_theme_params["theme_slug"]+'_left_background_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.left-side-background').css({
				"background-color": to
			});	
		} );
	} );
  
  	wp.customize(rt_theme_params["theme_slug"]+'_right_background_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('#right_side').css({
				"background-color": to
			});	
		} );
	} );



  	wp.customize(rt_theme_params["theme_slug"]+'_nav_item_background_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li > a, .header-elements .menu > li > a > span').css({
				"background-color": to
			});	
		} );
	} );


  	wp.customize(rt_theme_params["theme_slug"]+'_nav_item_font_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li > a, .header-elements .menu > li > a > span').css({
				"color": to
			});	
		} );
	} );

  	wp.customize(rt_theme_params["theme_slug"]+'_nav_item_border_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li > a, .header-elements .menu > li > a > span').css({
				"border-color": to
			});	
		} );
	} );

  	wp.customize(rt_theme_params["theme_slug"]+'_nav_item_font_color_active', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li:hover > a, .header-elements .menu > li a:hover, .header-elements .menu > li.current-menu-ancestor > a,.header-elements .menu > li.current-menu-item > a, .header-elements .menu > li:hover > a > span, .header-elements .menu > li a:hover > span, .header-elements .menu > li.current-menu-ancestor > a > span,.header-elements .menu > li.current-menu-item > a > span').css({ 
				"color": to
			});	
		} );
	} );	

  	wp.customize(rt_theme_params["theme_slug"]+'_sub_nav_item_background_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li li > a').css({
				"background-color": to
			});	
		} );
	} );


  	wp.customize(rt_theme_params["theme_slug"]+'_sub_nav_item_font_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li li > a').css({
				"color": to
			});	
		} );
	} );

  	wp.customize(rt_theme_params["theme_slug"]+'_sub_nav_item_border_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li li > a, .header-elements .menu > li ul').css({
				"border-color": to
			});	
		} );
	} );

  	wp.customize(rt_theme_params["theme_slug"]+'_sub_nav_item_background_color_active', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li li:hover > a, .header-elements .menu > li li a:hover, .header-elements .menu > li li.current-menu-ancestor > a,.header-elements .menu > li li.current-menu-item > a').css({
				"background-color": to
			});	
		} );
	} );


  	wp.customize(rt_theme_params["theme_slug"]+'_sub_nav_item_font_color_active', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('.header-elements .menu > li li:hover > a, .header-elements .menu > li li a:hover, .header-elements .menu > li li.current-menu-ancestor > a,.header-elements .menu > li li.current-menu-item > a').css({
				"color": to
			});	
		} );
	} );	

  	wp.customize(rt_theme_params["theme_slug"]+'_logo_background_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('#logo').css({
				"background-color": to
			});	
		} );
	} );	

  	wp.customize(rt_theme_params["theme_slug"]+'_logo_bottom_border_color', function( value ) {
		value.bind( function( to ) {   

			if( ! to ) {
				to = "transparent";
			}

			$('#logo').css({
				"border-color": to
			});	
		} );
	} );	

} )( jQuery );