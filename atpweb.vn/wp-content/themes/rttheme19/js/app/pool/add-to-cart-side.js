	/* ******************************************************************************* 

		WOOCOMMERCE ADDED TO CART ITEM TO SIDE PANEL

	********************************************************************************** */  
 
	if ( ! $.fn.rt_add_to_cart ) {  

		$.fn.rt_add_to_cart = function()
		{ 

			if( typeof wc_cart_fragments_params == 'undefined' ){
				return ;
			}

			//bind to added_to_cart
			$( document.body ).on( 'added_to_cart', function() {
				$(".side-panel-contents > .widget_shopping_cart").css({"opacity":0});	
				$(".rt-cart-menu-button").trigger("click");	
			});

		}
	} 
 
	$.fn.rt_add_to_cart();

