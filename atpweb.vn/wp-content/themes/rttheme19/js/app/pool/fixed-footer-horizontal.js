	/* ******************************************************************************* 

		FIXED FOOOTERS

	********************************************************************************** */  

	if( ! $.fn.rt_fixed_footers ){

		$.fn.rt_fixed_footers = function()
		{ 

			var footer = $(this),
				header = $(".top-header"),
				main_content = $("#main_content"),
				sub_page_header = $(".sub_page_header"),
				wp_admin_bar = $("#wpadminbar"),
				footer_height = footer.outerHeight(true);

			if ( Modernizr.touch ) {
				footer.removeClass( "fixed_footer" );
				return ;
			}			

			if( 
				$(window).height() - ( header.outerHeight() + header.position().top + wp_admin_bar.outerHeight() + sub_page_header.outerHeight() ) < footer_height 
				|| main_content.height() - 160 < footer_height 
				|| $("body").outerHeight() - $(window).height() < footer_height
			){
				footer.removeClass( "fixed_footer" );
				main_content.css( { "margin-bottom" : "0px" });
			}else{
				footer.addClass( "fixed_footer" );
				main_content.css( { "margin-bottom" : footer_height +"px" });				
			}
		};
	}

	if ( $.fn.rt_fixed_footers ) {  

		$(window).on('rt_pace_done resize', function() {  	
			$('[data-footer="fixed_footer"]').rt_fixed_footers();
		}); 		
	}

