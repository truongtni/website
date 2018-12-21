	/* ******************************************************************************* 

		WOOCOMMERCE FLYING ADDED TO CART ITEM

	********************************************************************************** */  
 
	$.fn.rt_disableScroll = function() {
		$('body').on('mousewheel.rt touchmove.rt', function(e) {
			e.preventDefault();
		});
	};

	$.fn.rt_enableScroll = function() {
		$('body').off('mousewheel.rt touchmove.rt');
	};


	if ( ! $.fn.rt_flying_cart ) {  

		$.fn.rt_flying_cart = function()
		{ 

			if( typeof wc_cart_fragments_params == 'undefined' ){
				return ;
			}

			if( $(".product_holder.woocommerce").length == 0 || $("#tools").length == 0 ){
				return ;
			}

			var unfreeze = "";

			$( '.add_to_cart_button' ).on( 'click', function() {
				$("body").rt_disableScroll();
				unfreeze = setTimeout(function(){ $("body").rt_enableScroll(); }, 5000);				
			});


			//bind to added_to_cart
			$( document.body ).on( 'added_to_cart', function( event, fragments, cart_hash, $button ) {

				$button = typeof $button === 'undefined' ? false : $button;

				if( ! $button ){
					return;
				}

				var y = $button.offset().top,
					 x = $button.offset().left,
					 number = $("#tools .cart .number");

				if( number.length == 0 ){
					return;
				}

				var	 ty = number.offset().top,
					 tx = number.offset().left;

				var img_src = $button.parents(".product_item_holder").find(".featured_image img").attr("src"),
					img_holder = $('<div></div>');

					img_holder.css({
						"background-image" : "url("+img_src+")",
						"background-size" : "cover",
						"background-repeat" : "no-repeat",
						"background-position" : "center center",
						"border-radius" : "50%",
						"width" : "0px",
						"height" : "0px",
						"position" : "absolute",
						"z-index" : 9999999
					});

					img_holder.prependTo("body");		 				

					img_holder.css({
							"opacity": 0,
							"top": y+"px",
							"left": x+"px",
						}).animate({
							"opacity": 1,
							"width": "150px",
							"height": "150px"
						},500).animate({
							"top": +ty+"px",
							"left": +tx+"px",
							"padding": "0",
							"width": "18px",
							"height": "18px"		
						},700).animate({
							"opacity": 0
						},400,function(){
							img_holder.remove();


						$("body").rt_enableScroll();
						clearTimeout(unfreeze);
				
					});						 
			});

		}
	} 
 
	$.fn.rt_flying_cart();

