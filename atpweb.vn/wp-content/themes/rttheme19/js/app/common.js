	/* ******************************************************************************* 

		RT Overlapped first row

	********************************************************************************** */
	
	if ( ! $.fn.rt_overlapped_row ) {  
		$.fn.rt_overlapped_row = function() {

			if( $(this).length == 0 ){
				return;
			} 

			if( $(this).hasClass("overlap") ){
				$('.sub_page_header > .content_row_wrapper').addClass("underlap"); 	
			}else{
				$('.sub_page_header > .content_row_wrapper').removeClass("underlap"); 	
			}

		}; 
	}

	$('#main_content .content_row:nth-child(2):not(.no-composer)').rt_overlapped_row(); 	

	/* ******************************************************************************* 

		RESPONSIVE HEADINGS

	********************************************************************************** */  
	$.fn.rt_font_resize = function() {

		$(this).each(function(){
			var $this = $(this),
				max_font_size = $this.data("maxfont-size"),
				min_font_size = $this.data("minfont-size");

				var resize_font_size = function(){

					var compress = 1;
					compress = window_width < 1290 ? 0.9 : compress;
					compress = window_width < 1100 ? 0.8 : compress;
					compress = window_width < 980 ? 0.7 : compress;
					compress = window_width < 768 ? 0.6 : compress;
					compress = window_width < 560 ? 0.5 : compress;
					compress = window_width < 480 ? 0.4 : compress;
					compress = window_width < 300 ? 0.35 : compress;

					if(compress == 1){
						$this.css('font-size', max_font_size +'px');
						return false;
					}

					 $this.css('font-size', Math.max( min_font_size, parseFloat( compress * max_font_size ) ) +'px');
				};

				resize_font_size();
				$(window).on('resize.rt_font_resize orientationchange.rt_font_resize', resize_font_size);
		});

	};

	$('[data-maxfont-size]').rt_font_resize();



	/* ******************************************************************************* 

		CUSTOM BUTTON HOVERS

	********************************************************************************** */  
	$.fn.rt_button_hovers = function() {

		var styles = "";

		$(this).each(function(){
			var $this = $(this),
				 unique_class_name = "button-" + Math.floor((Math.random() * 10000) + 1);
				$this.addClass(unique_class_name);
				styles += "."+unique_class_name+":hover{"+$this.data("hover-style")+"}";
				$this.removeAttr("data-hover-style");

		});

		$("<style>"+styles+"</style>").appendTo($("head"));

	};

	$('[data-hover-style]').rt_button_hovers();



	/* ******************************************************************************* 

		ON PAGE LOAD

	***********************************************************************************/ 
	$(window).on("rt_images_loaded",function(){
	
		$("body").removeClass("rt-loading");
		$("#loader-wrapper").css({"opacity":0});
		$(window).trigger("rt-loaded");

		if ( ! Modernizr.touch && ! window.location.hash) {
			$(window).scrollTop(0);
		}
	});

	$(window).on("rt_pace_done",function(){
		$('.pace').remove();   
		if( $("body").hasClass("rt-loading") ){
			$("body").removeClass("rt-loading");
			$("#loader-wrapper").css({"opacity":0});
			$(window).trigger("rt-loaded");
		}
	});

	/* ******************************************************************************* 

		ON LEAVE

	***********************************************************************************/ 

	if( ! $.fn.rt_on_leave ){

		$.fn.rt_on_leave = function()
		{ 

			$('a[href^="'+rt_theme_params["home_url"]+'"]').on("click", function(e){

				if( $.fn.is_mobile_menu() ){
					return;
				}

				if ( window.parent.location !== window.location ) {//check if customizer active
					return;
				}

				var cur_url = window.location.host + window.location.pathname + window.location.search;
				var target_url = this.host + this.pathname + this.search;
				var target_extension = this.pathname.split('.');
				var search = this.search;

				if( cur_url == target_url || search.indexOf("replytocom") == 1 ){
					return;
				}

				if( typeof target_extension[1] != "undefined" && typeof target_extension[1] != "php" && typeof target_extension[1] != "html"  ){
					return;
				}

				if ( e.ctrlKey || e.shiftKey || e.metaKey || (e.button && e.button == 1) ){
					return;
				}
			

				$("body").removeClass("pace-done");
				$("#loader-wrapper").css({"opacity":1});
			   $("body").addClass("rt-loading rt-leaving");

				if(is_layout1){
					$.fn.rt_side_margin();
				}

				var href = this.href;
				window.setTimeout(function() {
					window.location = href;
				}, 350);

				return false;

			});

		};
	}

	$(window).on("rt_pace_done",function(){
		if( $("#loader-wrapper").length > 0 && rt_theme_params["page_leaving"] ){
			$.fn.rt_on_leave();   	
		}		
	});

	/* ******************************************************************************* 

		RT ONE PAGE

	***********************************************************************************/ 
 
	if( ! $.fn.rt_one_page ){

		$.fn.rt_one_page = function()
		{ 

			var wp_admin_bar_height = $("#wpadminbar").outerHeight() - 1;

			if( window.location.hash ){ 

	 			var target = $(window.location.hash);

				if( target.length > 0 && $('#navigation a[href*="'+window.location.hash+'"]').length > 0 && ! target.hasClass("vc_tta-panel vc_active") ){ 		
					rt_scroll_to( target.offset().top - wp_admin_bar_height, window.location.hash );				
				}
			}

			$(this).on("click",function(e){
			
					var cur_url = window.location.host + window.location.pathname + window.location.search;
					var this_url = this.host + this.pathname + this.search;

					if( cur_url == this_url ){

						e.preventDefault();		

						if( this.hash == "#top" ){
							rt_scroll_to( 0, "");
							return ;
						}						
		 
						var target = $(this.hash);

						if( target.length == 0 ){
							window.location = this.href;
							return ;
						}
						
						if( $("body").hasClass("mobile-menu-active") ){
							$(".mobile-menu-button").trigger("click");
						}

						var sticky_menu_item = $(".sticky #navigation > li > a");
						var sticky_height = 0;

						if( sticky_menu_item.length > 0 ){
							sticky_height = sticky_menu_item.height() + 30;
						}
						
						var reduce = wp_admin_bar_height + sticky_height;
						
						rt_scroll_to( target.offset().top - reduce, this.hash);
					}
			});


			$(this).each(function(){

				var menu_item = $(this),
					hash = this.hash,
					section = $(hash);

				menu_item.parent("li").removeClass("current-menu-item current_page_item");

				section.waypoint(function(direction) { 
						if (direction === 'down') {
							rt_remove_active_menu_class();
							menu_item.parent("li").addClass("current-menu-item current_page_item");
						}
				}, { offset: '50%' });

				section.waypoint(function(direction) { 
						if (direction === 'up') {
							rt_remove_active_menu_class();
							menu_item.parent("li").addClass("current-menu-item current_page_item");
						}
				}, { 
					offset: function() { 
						return 0;
					}
				});

				section.waypoint(function(direction) { 
						if (direction === 'up') {
							menu_item.parent("li").removeClass("current-menu-item current_page_item");
						}
				}, { 
					offset: function() { 
						return $.waypoints('viewportHeight');
					}
				});

				section.waypoint(function(direction) { 
						if (direction === 'down') {
							menu_item.parent("li").removeClass("current-menu-item current_page_item");
						}
				}, { 
					offset: function() { 
						return -$(this).height();
					}
				});

			});


			function rt_remove_active_menu_class(){
				$("#navigation > li.current-menu-item, #navigation > li.current_page_item").removeClass("current-menu-item current_page_item"); 
			}

		};
	}

	
	if ( $.fn.rt_one_page ) {  
		$(window).on("rt_pace_done",function(){
			$($('#navigation a[href*="#"]:not([href="#"])')).rt_one_page();   
		});
	}



	/* ******************************************************************************* 

		SCROLLTO LINKS

	***********************************************************************************/ 
	$(".scroll").on("click",function(){

		if( this.hash == "#top" ){
			rt_scroll_to( 0, "");
			return ;
		}			

		var wp_admin_bar_height = $("#wpadminbar").outerHeight();
		var sticky_menu_item = $(".sticky #navigation > li > a");
		var sticky_height = 0;

		if( sticky_menu_item.length > 0 ){
			sticky_height = sticky_menu_item.height() + 30;
		}
		
		var reduce = wp_admin_bar_height + sticky_height;

		if( $(this.hash).length < 1 ){
			return ;
		}

		rt_scroll_to( $(this.hash).offset().top - reduce, this.hash);
	});


	/* ******************************************************************************* 

		GO TO TOP LINK

	***********************************************************************************/ 
 
	if( ! $.fn.rt_go_to_top ){

		$.fn.rt_go_to_top = function()
		{ 

			var $this = $(this);
			$(window).scroll(function(event) {

				var top_distance = 100;
				var y = $(window).scrollTop();
			
				if( y > top_distance ){							
					 $this.addClass("visible");
				}else{
					 $this.removeClass("visible");
				}

			});		

			$(this).on("click",function(e){
				rt_scroll_to( 0, "");
			});

		};
	}
	
	if ( $.fn.rt_go_to_top ) {  
		$('.go-to-top').rt_go_to_top();   
	}

	/* ******************************************************************************* 

		RT COUNTER

	***********************************************************************************/ 
 
	if( ! $.fn.rt_counter ){

		$.fn.rt_counter = function()
		{ 

			$(this).each(function(){
				var number_holder = $(this).find("> .number"),
					 number = number_holder.text();

				$(this).waypoint( { 
					triggerOnce: true,   
					offset: "100%",  
					handler: function() {    

						$({
							Counter: 0
						}).animate({
							Counter: number_holder.text()
						}, {
							duration: 1200,
							step: function () {
								number_holder.text(Math.ceil(this.Counter));
							},
							complete: function () {
								number_holder.text(number);
							}							
						});

					}
				});
			});
		};
	}
	
	if ( $.fn.rt_counter ) {  
		$(window).on("rt_pace_done",function(){
			$('.rt_counter').rt_counter();   
		});
	}

	/* ******************************************************************************* 

		RT SCROLL TO

	***********************************************************************************/ 

	function rt_scroll_to( to, hash, timeout ){

		timeout =  timeout || 900;
		
		$('html, body').stop().animate({
			'scrollTop': to
		}, timeout, 'swing', function() {
			window.location.hash = hash;
			$('html,body').scrollTop(to);
		});				
	
	}


	/* ******************************************************************************* 

		FIX FEATURES COLUMN POSITION OF COMPARE TABLES

	********************************************************************************** */  

	if( ! $.fn.rt_tables ){

		$.fn.rt_tables = function()
		{ 

			var features,
				table = $(this);


			//brings the features column position same with other columns
			function fix_compare_features( table ){

				$(table).each(function(i){

					var start_position_element = $(this).find(".start_position"),
					features_list = $(this).find(".table_wrap.features ul"), 
					new_offset =  start_position_element.offset().top - $(this).offset().top; 

					features_list.css("top",new_offset);
				});

			}


			//copy features to each column for mobile
			function copy_features( table ){

				$(table).each(function(){

					features=[];
					//createa features array from the first row
					$(this).find(".table_wrap.features li").each(function(){
						features.push( $(this).html() );
					});

				});

				$(table).find(".table_wrap").each(function(i){

					if( $(this).hasClass("features") == "" ){
						var i = 0;
						$(this).find("li").each(function(){
							if( features[i] ){
								$(this).prepend('<div class="visible-xs-block hidden-sm hidden-md hidden-lg">'+features[i]+'</div>'); 
							}
						i++;
						});
					} 
				}); 				
			}

			//bind to window resize
			$(window).bind("resize",table, function( ){
				fix_compare_features( table );   
			});

			//start functions
			fix_compare_features( table );
			copy_features( table );

		};
	}

	if ( $.fn.rt_tables ) {  
		$('.pricing_table.compare').rt_tables();   
	}

	/* ******************************************************************************* 

		TOGGLE - ACCORDION

	********************************************************************************** */  
	$(".rt-toggle .toggle-content").hide(); 
	$(".rt-toggle .open .toggle-content").show();  
	
	$(".rt-toggle ol li .toggle-head").click(function(){ 

		clearTimeout("accordion_timeout");
		
		var element = $(this).parent("li"),
			content = element.find(".toggle-content");

		if( element.hasClass("open")){ 
			element.removeClass("open");
			content.stop().slideUp(300);

		}else{

			$(this).parents("ol").find("li.open").removeClass("open").find(".toggle-content").stop().slideUp(300);  

			element.addClass("open");
			content.stop().slideDown(300,function(){
				fix_accordion_pos();
			});	

			//fixed heights 
			content.find('.fixed_heights').rt_fixed_rows("load"); 

			//fixed footers
			$('[data-footer="fixed_footer"]').rt_fixed_footers();

		} 

		function fix_accordion_pos(){
			if( $(window).scrollTop() > element.offset().top ){
				var accordion_timeout = setTimeout(function() {
					var add = $("#wpadminbar").outerHeight() + $(".top-header.stuck").outerHeight();
					rt_scroll_to( element.offset().top - add, "", 300);
				}, 30 );			
			}			
		}

	});


	/* ******************************************************************************* 

		TABS

	********************************************************************************** */  

	if( ! $.fn.rt_tabs ){

		$.fn.rt_tabs = function()
		{ 

			$(this).each(function () {

				var tabs = $(this),
					tab_nav = $(this).find("> .tab_nav"),
					desktop_nav_element = $(this).find("> .tab_nav > li"),
					mobile_nav_element = $(this).find("> .tab_contents > .tab_content_wrapper > .tab_title"),
					tab_wrappers =  $(this).find("> .tab_contents > .tab_content_wrapper"),
					tab_style = $(this).attr("data-tab-style");

				//nav height fix
				height_fix(1);

				//switcher tabs
				$(".tab-switcher").click(function( e ) {		
					e.preventDefault();		

					close_all();
					open_tab( $(this).attr("data-tab-number") );

					return;
				})

				//mobile nav clicks	
				mobile_nav_element.click(function() {		
					close_all();
					open_tab( $(this).attr("data-tab-number") );
				})

				//desktop nav clicks
				desktop_nav_element.click(function() {				
					close_all();
					open_tab( $(this).attr("data-tab-number") );
				})

				//close all tab_style
				function close_all(){
					tab_wrappers.each(function() {
						$(this).removeClass("active");
					});

					desktop_nav_element.each(function() {
						$(this).removeClass("active");
					});

				}

				//open a tab 
				function open_tab( tab_number ){

					var nav_item = tabs.find('[data-tab-number="'+tab_number+'"]'),
						tab_content_wrapper = tabs.find('[data-tab-content="'+tab_number+'"]');

						nav_item.addClass("active");
						tab_content_wrapper.addClass("active");
						height_fix( tab_number );

						//fixed heights 
						tab_content_wrapper.find('.fixed_heights').rt_fixed_rows("load");

 
						//fix custom select forms
						$.fn.rt_customized_selects( tab_content_wrapper );
						tab_content_wrapper.find('span.customselect').remove();
						tab_content_wrapper.find('select.hasCustomSelect').removeAttr("style");
						$.fn.rt_customized_selects( tab_content_wrapper );
 

						if( $(window).width() < 767 ){
							rt_scroll_to( tab_content_wrapper.offset().top, "" );
						}
				}

				//height fix -  vertical style
				function height_fix( tab_number ) {
					if( tab_style == "tab-style-2" ){						
						var current_tab_height = tabs.find('[data-tab-content="'+tab_number+'"]').outerHeight();
						tab_nav.css({"min-height":current_tab_height+"px"});
					}
				}

			});
 
		};
	}

	if ( $.fn.rt_tabs ) {  
		$('.rt_tabs').rt_tabs();   
	}

	/* ******************************************************************************* 

		START CAROUSELS

	********************************************************************************** */    

	$.fn.rt_start_carousels = function( callbacks ) {

		$(this).find(".rt-carousel").each(function(){

			var autoHeight_,
				margin = $(this).data("margin") !== "" ? $(this).data("margin") : 15, 
				carousel_holder = $(this),
				items = parseInt($(this).attr("data-item-width")),//number of items of each slides
				tablet_items = typeof $(this).data("tablet-item-width") != "undefined" && $(this).data("tablet-item-width") != "" ? parseInt($(this).attr("data-tablet-item-width")) : ( items == 1 ) ? 1 : 2 ,//number of items of each slides
				mobile_items = typeof $(this).data("mobile-item-width") != "undefined" && $(this).data("mobile-item-width") != "" ? parseInt($(this).attr("data-mobile-item-width")) : 1,//number of items of each slides
				nav = $(this).attr("data-nav") == "true" ? true : false,
				dots = $(this).attr("data-dots") == "true" ? true : false,
				timeout = typeof $(this).attr("data-timeout") != "undefined" ? $(this).data("timeout") : 5000,
				autoplay = $(this).data("autoplay") != "undefined" ? $(this).data("autoplay") : false,
				loop = $(this).data("loop") != "undefined" ? $(this).data("loop") : false, 
				autowidth = $(this).data("autowidth") != "undefined" ? $(this).data("autowidth") : false,
				carousel_id = $(this).attr("id");

			//margin 
			if( items == 1 ){
				margin = 0;
			}else{
				margin = margin;
			}

			//start carousel
			var carousel = carousel_holder.find(".owl-carousel"); 

				if( $(this).find('.item').size() == 1 ){
					nav = dots = false;
				} 
				
				var startover;
				carousel.on('changed.owl.carousel', function(e) {

					if( ! autoplay ){
						return;
					}

					clearTimeout(startover); 

					if (!e.namespace || e.type != 'initialized' && e.property.name != 'position') return;
 
		 			var items = $(this).find('.active').size(); 

					if( e.item.index == e.item.count - items ){

						var startover = setTimeout(function() {
							carousel.trigger('to.owl.carousel',  [0, 400, true]);
						}, timeout );			

					}

				});
				
				carousel.owlCarousel({
					rtl: is_rtl ? true : false, 
					autoplayTimeout : timeout,
					autoplay:autoplay,
					loop:loop,
					autoplayHoverPause:true,
					margin:margin,
					responsiveClass:true,	
					autoWidth:autowidth,				
					autoHeightClass: 'owl-height',
					navText: ["<span class=\"icon-left-open\"></span>","<span class=\"icon-right-open\"></span>"],
					navSpeed:700,
					dotsSpeed:500,					
					responsive:{
						0:{
							items:mobile_items,
							nav:nav,
							dots:dots,
							autoHeight:1,
							dotsContainer: "#"+carousel_id+"-dots"
						},
						768:{
							items: tablet_items,
							nav:nav,
							dots:dots,
							autoHeight:1,
							dotsContainer: "#"+carousel_id+"-dots"
						},						
						1025:{
							items:items,
							nav:nav,
							dots:dots,
							autoHeight:1,
							dotsContainer: "#"+carousel_id+"-dots",
						}
					},
					onInitialized: callbacks ? callbacks._onInitialized : isotope_layout,
					onChanged: callbacks ? callbacks._onChanged : "",
					onRefreshed: callbacks ? callbacks._onRefreshed : "",
					onTranslated: isotope_layout,

				});

				//cosmetic fix for content carousels				
				make_same_height(carousel,items, mobile_items, tablet_items, carousel_holder);
				$(window).on('resize', function() { 
					setTimeout(function() {
						reset_carousel_heights(carousel,items, mobile_items, tablet_items, carousel_holder);
						make_same_height(carousel,items, mobile_items, tablet_items, carousel_holder); 
					}, 500);			
				});				
		});

		//reset isotopes after carousel
		function isotope_layout(){

			var isotope_gallery = $(".masonry");

			if( isotope_gallery.length > 0 ){
				setTimeout(function() {					
					isotope_gallery.isotope('layout'); 
				}, 100);							
			}
		}

		//get highest item of the carousel
		function get_highest_item( carousel ){
			var heights = [];
			carousel.find(".owl-item").each(function(){  
				heights.push($(this).outerHeight());   
			});

			return Math.max.apply(null, heights);
		}

		//reset carousel item heights
		function reset_carousel_heights( carousel, items, mobile_items, tablet_items, carousel_holder ){

			var is_image_carousel = carousel_holder.hasClass("rt-image-carousel");

			if( mobile_items == 1 && window_width < 768 ){
				return false;
			} 

			if( tablet_items == 1 && window_width >= 768  &&  window_width <= 1025){
				return false;
			} 

			if( items == 1 && window_width > 1025 ){
				return false;
			} 

			carousel.find(".owl-item > div").each(function(){ 
				$(this).css({"min-height": ""});
			});
		}		 

		//make all carousel items in same height
		function make_same_height( carousel, items, mobile_items, tablet_items, carousel_holder ){

			var is_image_carousel = carousel_holder.hasClass("rt-image-carousel");

			if( mobile_items == 1 && window_width < 768 ){
				return false;
			} 

			if( tablet_items == 1 && window_width >= 768  &&  window_width <= 1025){
				return false;
			} 

			if( items == 1 && window_width > 1025 ){
				return false;
			} 

			var height = get_highest_item( carousel );			

			carousel.find(".owl-item > div").each(function(){ 
				$(this).css({"min-height": height +"px"});
			});

		 	carousel.trigger('refresh.owl.carousel');
		}

	}; 	

  	$(window).on('rt_loaded', function() {
		$("body").rt_start_carousels();  
	});

	/* ******************************************************************************* 

		PORTFOLIO ITEMS 

	********************************************************************************** */    

	$.fn.rt_portfolio_items = function() {
		$(this).each(function(){
			var text = $(this).find(".text"),
				holder_height = $(this).height(),
				text_height = text.height(),
				margin = ( text_height < holder_height ) ? ( holder_height - text_height ) / 2 : 0;

				text.css({
					"margin-top": margin + "px",
					"max-height": holder_height + "px"
				});
		}); 
	};

	$(window).on('rt_loaded resize', function() {
		$(".type-portfolio.loop > .overlay").rt_portfolio_items();
	});
	
 

	/* ******************************************************************************* 

		SEARCH WIDGET

	********************************************************************************** */  
	$(".wp-search-form span").on('click', function() {     
		$(this).parents("form:eq(0)").submit();
	});	

	/* ******************************************************************************* 

		SOCIAL SHARE 

	********************************************************************************** */
 
	$(".social_share_holder a").click(function( event ) {		

		//if email button clicked do nothing
		if( $(this).hasClass("icon-mail") ){
			return ;
		}

		//for other buttons open a popup window
		newwindow=window.open($(this).attr("data-url"),'name','height=400,width=400');

		if (newwindow == null || typeof(newwindow)=='undefined') {  
			alert( rt_theme_params["popup_blocker_message"] ); 
		}else{  
			newwindow.focus();
		}

		event.preventDefault();
	});

	/* ******************************************************************************* 

		Tooltips

	********************************************************************************** */
	$('[data-toggle="tooltip"]').tooltip();


	/* ******************************************************************************* 

		IMG effects

	********************************************************************************** */
	if( ! $.fn.rt_img_effect ){

		$.fn.rt_img_effect = function()
		{ 
			$(this).find('.imgeffect').each(function() {
				$('<div/>').append($(this).find("img")).appendTo($(this));
			});
		};
	}

	$("#container").rt_img_effect();


	/* ******************************************************************************* 

		TABLET NAVIGATION FIX FOR DEACTIVE STATE

	********************************************************************************** */    
	$("#container").on("click",function() { 
		$( '.header-elements .menu .hover').removeClass("hover"); 		
		return true;
	});


	/* ******************************************************************************* 

		LOAD MORE

	********************************************************************************** */    

	$(".load_more").on("click",function(e){
 
		e.preventDefault();	

		var button = $(this),
			listid = button.attr("data-listid"),
			page_count = parseInt(button.attr("data-page_count")) ,
			current_page = parseInt(button.attr("data-current_page")) ;

		//prevent multiple clicks before loading elements
		button.attr("disabled", "disabled");

		//check if there is more posts to display
		if( page_count == 1 ){
			return ;
		}

		//load more button classes
		button.children("span").removeClass("icon-angle-double-down").addClass("icon-spin1 animate-spin");
	
		//start ajax
		$.ajax({
			type: 'POST',
			url: rt_theme_params.ajax_url,
			data : {
				'action': 'rt_ajax_loader',
				'atts': $(this).attr("data-atts"),
				'wpml_lang': rt_theme_params.wpml_lang,
				'page': current_page + 1
			},		
			success: function(response, textStatus, XMLHttpRequest){

				var response = $(response), elems, wrapper, masonry;

					wrapper = $("#"+listid);	

					if( wrapper.hasClass("masonry") ){
						masonry = true;
					}	
					
					if( masonry ){
						elems = response.find(".isotope-item");	
					}else{
						elems = response.find("> div, > article");							
					}


				// wait the images 
				imagesLoaded( response ).on('done', function( instance ) {

					//append the elements and rebuild the masonry layout
					if( masonry ){
						wrapper.isotope().append( elems ).isotope( 'appended', elems );
					}else{
						wrapper.append( elems );					
					}

					//img effects for new loaded elements
					elems.rt_img_effect();

					//media player
					elems.rt_mediaelementplayer();

					//append isotope elements
					if( masonry ){ 
						wrapper.isotope('layout'); 
					}

					//lightboxes 
					elems.rt_lightbox(); 

					//start carousels
					elems.rt_start_carousels( { '_onRefreshed' : function _onRefreshed(){
											if( masonry ){ 
												wrapper.isotope('layout'); 
											}
										}});

					//portoflio items
					elems.find(".type-portfolio.loop > .overlay").rt_portfolio_items();

					//the load more button
					button.children("span").removeClass("icon-spin1 animate-spin").addClass("icon-angle-double-down");

					//decrease the page count
					button.attr("data-page_count",page_count-1);

					//increase the current page count
					button.attr("data-current_page", current_page+1 );

					//remove the button if there is no page left
					if( page_count -1 <= 1 ){
						button.attr("disabled", "disabled").hide();
					}else{
						button.removeAttr("disabled");
					}

					//fix left side
					if( $.fn.rt_left_height ){
						$.fn.rt_left_height();
					}
					$(window).trigger("scroll");  
				});

			},
			error: function( MLHttpRequest, textStatus, errorThrown ){
				console.log(errorThrown);
			}		
		});
 
	});

	/* ******************************************************************************* 

		CUSTOM DESIGNED SELECT FORMS

	********************************************************************************** */  
	if( ! $.fn.rt_customized_selects ){
		$.fn.rt_customized_selects = function( wrapper ) {
			if ( $.isFunction($.fn.customSelect) ) {

				var selectors = '.orderby, .variations select:not([multiple]), .widget .menu.dropdown-menu, .gfield:not(.notcustomselect) .ginput_container select:not([multiple]), .wpcf7-form select:not([multiple]):not(.notcustomselect)';
				if( wrapper ){
					wrapper.find(selectors).customSelect( { customClass: "customselect" } );
				}else{
					$(selectors).customSelect( { customClass: "customselect" } );
				}
				
			}
		};
	};

	$(window).load(function(){
		$.fn.rt_customized_selects();

		//bind to gravity ajax load
		$(document).bind('gform_post_render', function(){			
			$.fn.rt_customized_selects();
		});

	});


	/* ******************************************************************************* 

		WC REVIEWS

	********************************************************************************** */  

	$(".woocommerce-review-link").click(function( event ){  
		var review_tab = $("#reviews-title");
		review_tab.trigger("click"); 
	});


	/* ******************************************************************************* 

		FORM VALIDATION

	********************************************************************************** */  

	$.fn.rt_contact_form = function() {
		
		$(this).each(function(){

			var the_form = $(this);

			the_form.find(".submit").click(function( event ){  

				//vars
				var loading = the_form.find(".loading"),
					error = false;

				//check required fields
				the_form.find(".required").each(function(){
					if( $(this).val() == "" ){
						$(this).addClass("error");
						error = true;
					}else{
						$(this).removeClass("error");
					}
				});

				//there is an error
				if(error){
					return ;
				}

				//show loading icon
				loading.show();

				//searialize the form
				var serialize_form = $(the_form).serialize();

				//ajax form data 
				var data = serialize_form +'&action=rt_ajax_contact_form';

				//post
				$.post(rt_theme_params.ajax_url, data, function(response) {
					var response = $(response);
					response.prependTo(the_form);
					loading.hide();
				});

				//close warnings
				the_form.find(".info_box").remove();

			});
		});
	}; 

	$('.validate_form').rt_contact_form();
 

	/* ******************************************************************************* 

		INFO BOX CLOSE

	********************************************************************************** */  
	$(document.body).on("click",".info_box .icon-cancel",function() { 
		$(this).parent(".info_box").fadeOut();
	}); 

	/* ******************************************************************************* 

		LIGHTBOX PLUGIN

	***********************************************************************************/     

	$.fn.rt_lightbox = function() {
		if ($.fn.lightGallery){

				var carousel_atts= {
					selector: 'a.lightbox_',
					hash: false,
					downloadUrl: false,
					loop: false,
					thumbnail: false,
					index: 0,
					getCaptionFromTitleOrAlt: false

				};

				$(this).find(".rt-image-carousel,.photo_gallery,.post-carousel").lightGallery(carousel_atts);


				var carousel_atts= {
					selector: 'this',
					hash: false,
					downloadUrl: false,
					loop: false,
					thumbnail: false,
					index: 0,
					getCaptionFromTitleOrAlt: false

				};

				$(this).find(".lightbox_").lightGallery(carousel_atts);

		}

	};

	$(document).rt_lightbox("init");



	/* ******************************************************************************* 

		RT GOOGLE MAPS

	********************************************************************************** */  
	$.rt_maps = function(el, locations, zoom){

		var base = this; 
		base.init = function(){ 
			// initialize google map
			if(locations.length>0) google.maps.event.addDomListener(window, 'load', $.fn.rt_maps());  
		};
 
		if(locations.length>0) base.init();
	}; 

	$.fn.rt_maps = function(locations, zoom){		 

		var map_id = $(this).attr("id");  
 
		//holder height
		var height = $('[data-scope="#'+map_id+'"]').attr("data-height");   

		if ( height > 0 ){
			$(this).css({'height':height+"px"});
		}

		//api options
		var myOptions = {
			zoom: zoom,
			panControl: true,
			zoomControl: true,
			scaleControl: true,			
			streetViewControl: false,
			overviewMapControl: false,
			scrollwheel : false,
			navigationControl: true,
			center: new google.maps.LatLng(0, 0),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}			 
 
		var map = new google.maps.Map( document.getElementById(map_id), myOptions);	

		//B&W Map
		var bwmap = $('[data-scope="#'+map_id+'"]').attr("data-bw");   

		if ( typeof bwmap !== "undefined" && bwmap != "" ){
			// Create an array of styles.
			var styles = [
				{
					stylers: [
						{ hue: "#fff" },
						{ saturation: -100 },
						{ lightness: 0 },
						{ gamma: 1 }
					]
				} 
			];
			// Create a new StyledMapType object, passing it the array of styles,
			// as well as the name to be displayed on the map type control.
			var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});	

			//Associate the styled map with the MapTypeId and set it to display.
			map.mapTypes.set('map_style', styledMap);
			map.setMapTypeId('map_style');
		}

		$.fn.setMarkers(map, locations);

		$.fn.fixTabs(map,map_id,zoom);
		$.fn.fixAccordions(map,map_id,zoom);
	};

	$.fn.setMarkers = function (map, locations) {
		 

		if(locations.length>1){
			var bounds = new google.maps.LatLngBounds();	 
		}else{
			var center = new google.maps.LatLng(locations[0][1], locations[0][2]);
			map.panTo(center);			
		}


		for (var i = 0; i < locations.length; i++) {
			if (locations[i] instanceof Array) {
				var location = locations[i];
				var myLatLng = new google.maps.LatLng(location[1], location[2]);
				var marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					animation: google.maps.Animation.DROP,
					draggable: false,
					title: location[0]
				});

				$.fn.add_new_event(map,marker,location[4]);
				if(locations.length>1) bounds.extend(myLatLng);
			}
		}

		if(locations.length>1)  map.fitBounds(bounds);
	};
	 
	$.fn.add_new_event = function (map,marker,content) {

	  if(content){
			var infowindow = new google.maps.InfoWindow({
				content: content,
				maxWidth: 300
			});
			google.maps.event.addListener(marker, 'click', function() {;
			infowindow.open(map,marker);
		});
	  }
	}; 

	$.fn.fixTabs = function (map,map_id,zoom) {
		var tabs = $("#"+map_id).parents(".rt_tabs:eq(0)"),
			desktop_nav_element = tabs.find("> .tab_nav > li"),
			mobile_nav_element = tabs.find("> .tab_contents > .tab_content_wrapper > .tab_title");

		desktop_nav_element.on("click",  { map: map } , function() { 
			var c = map.getCenter();  
			google.maps.event.trigger(map, 'resize'); 
			map.setZoom(zoom); 
			map.setCenter(c);  
		});
 
		mobile_nav_element.on("click",  { map: map } , function() { 
			var c = map.getCenter();  
			google.maps.event.trigger(map, 'resize'); 
			map.setZoom(zoom); 
			map.setCenter(c);  
		});

	};	

	$.fn.fixAccordions = function (map,map_id,zoom) {
		var panes = $("#"+map_id).parents(".rt-toggle:eq(0) > ol > li");

		panes.on("click",  { map: map } , function() { 
			var c = map.getCenter();  
			google.maps.event.trigger(map, 'resize'); 
			map.setZoom(zoom); 
			map.setCenter(c);  
		}); 

	};	

	/* ******************************************************************************* 

		SLIDER PARALLAX EFFECT

	********************************************************************************** */  

	$.fn.rt_slider_position = function()
	{
		var slider =  $('#main_content > .content_row:first-child .main-carousel[data-parallax="true"]');

		if( slider.length == 0 || Modernizr.touch ){
			return ;
		}

		var	parallax_effect = ! Modernizr.touch ? true : false,		
			wp_admin_bar_height = $("#wpadminbar").outerHeight(),
			offsetTop = slider.offset().top,
			sliderHeight = slider.outerHeight(),
			gap = offsetTop - wp_admin_bar_height,
			carousel = slider.find(".owl-stage-outer"),
			$window = $(window);


			//parallax effect
			$(window).on("scroll", function( event ){

				var scrollTop = $window.scrollTop() - gap ;

				 
				if( sliderHeight < scrollTop ){
					return ;
				}

				var y = Math.max( 0, scrollTop ),
					cy = 0.4*y;

 
				carousel.css({ 
					"-webkit-transform": "translateY("+cy+"px)",
					"-moz-transform": "translateY("+cy+"px)",
					"-ms-transform": "translateY("+cy+"px)",
					"-o-transform": "translateY("+cy+"px)",
					"transform": "translateY("+cy+"px)"
				});


			});			
	}

	$(window).on('rt_loaded resize', function() {
		$.fn.rt_slider_position();
	}); 

	/* ******************************************************************************* 

		MEDIA PLAYER

	********************************************************************************** */  

	$.fn.rt_mediaelementplayer = function() {		
		var media_holders = $(this).find(".rt-hosted-media video, .rt-hosted-media audio");
		media_holders.mediaelementplayer(); 
	}; 

	$(document).rt_mediaelementplayer();


	/* ******************************************************************************* 

		PARALLAX BACKGROUNDS

	********************************************************************************** */  

	if( ! $.fn.rt_parallax_backgrounds ){

		$.fn.rt_parallax_backgrounds = function(options)
		{ 
			if( Modernizr.touch ){
				return ;
			}

			$(this).each(function(){
				
				var row = $(this).parents("div:eq(0)"),
					row_height = row.outerHeight() ,
					row_width = row.outerWidth() ,
					row_inheight = row.height(), 
					parallax_speed = $(this).data("rt-parallax-speed") != undefined ? $(this).data("rt-parallax-speed") : 6,
					row_paddings = row_height - row_inheight,
					speed = ( row_height / $(window).height() ) + 1, 
					holder_height = row_height * speed/(1+(6-parallax_speed)/10),
					holder_width = row_width * speed/(1+(6-parallax_speed)/10),
					effect = $(this).attr("data-rt-parallax-effect"), // vertical, horizontal
					direction = $(this).attr("data-rt-parallax-direction"); // -1 down/right , 1 up/left

					if( effect == "horizontal" ){
						$(this).css({ "height":row_height+4+"px", "width":holder_width+"px" });	
					}else{
						$(this).css({ "height":holder_height+"px", "width":row_width+4+"px" });	
					}
 

					if( effect == "horizontal" ){
						$(this).rt_horizontal_parallax_effect({ row: row, row_width: row_width, holder_width: holder_width, direction: direction });
					}else{
						$(this).rt_vertical_parallax_effect({ row: row, row_height: row_height, holder_height: holder_height, direction: direction });	
					}	 
 
			});
		} 
 
		$.fn.rt_horizontal_parallax_effect = function( options )
		{ 
			var $this = $(this),
				$window = $(window),
				invisible_part = options["holder_width"] - options["row_width"],
				posTop = options["row"].offset().top,
				start_position = options["direction"] == -1 ? -1 * invisible_part : 0;
 
			//start position of the parallax layer
			$this.rt_parallax_apply_css(start_position, 0 );

			//scroll function
			$(window).scroll(function(event) {

				if( ( posTop - $window.height() ) > $window.scrollTop() ){
					return ;
				}

				var move_rate  = ( $window.scrollTop() *  invisible_part ) / ( posTop + options["row_width"] ); 
				var xPos = options["direction"] == 1 ? -1 * move_rate :  -1 * invisible_part + move_rate ;

				if( xPos < -1 * invisible_part ) xPos = -1 * invisible_part; //max left position					
				if( xPos > 0 ) xPos = 0;  //max right position

				$this.rt_parallax_apply_css(xPos, 0);

			});
		}	


		$.fn.rt_vertical_parallax_effect = function( options )
		{ 
			var $this = $(this),
				$window = $(window),
				invisible_part = options["holder_height"] - options["row_height"],
				posTop = options["row"].offset().top,
				start_position = options["direction"] == -1 ? -1 * invisible_part : 0;
 
			//start position of the parallax layer
			$this.rt_parallax_apply_css(0, start_position );
  
			//scroll function
			$(window).scroll(function(event) {

				if( (posTop - $window.height() ) > $window.scrollTop()  ){
					return ;
				}

				var move_rate  = ( $window.scrollTop() *  invisible_part ) / ( posTop + options["row_height"] ); 
				var yPos = options["direction"] == 1 ? -1 * move_rate :  -1 * invisible_part + move_rate ;

				if( yPos < -1 * invisible_part ) yPos = -1 * invisible_part; //max bottom position					
				if( yPos > 0 ) yPos = 0;  //max top position	
			
				$this.rt_parallax_apply_css(0, yPos);	

				//sub page headers
				if( $this.parent(".content_row").hasClass("sub_page_header") ){
					if( is_layout1 || is_layout2){
						$this.next(".content_row_wrapper").find(".page-title").rt_parallax_apply_css( 0, $window.scrollTop() / 6 );	
					}
				}
 
			});
		}		


		$.fn.rt_parallax_apply_css = function( x, y )
		{ 

			var is_rtl = $("body").hasClass("rtl");

			//if it is rtl language make it reverse
			x = is_rtl ? -1 * x : x; 

			$(this).css({ 
				"-webkit-transform": "translate("+x+"px, "+y+"px)",
				"-moz-transform": "translate("+x+"px, "+y+"px)",
				"-ms-transform": "translate("+x+"px, "+y+"px)",
				"-o-transform": "translate("+x+"px, "+y+"px)",
				"transform": "translate("+x+"px, "+y+"px)" 
			});
 
		}		
	}


	if ( $.fn.rt_parallax_backgrounds ) {  
		//start first to get rid of white images
		$(window).on('rt_loaded resize', function() {
			$('.rt-parallax-background').rt_parallax_backgrounds();   	
		}); 
	}


	/* ******************************************************************************* 

		RT Fixed Rows  

	********************************************************************************** */

	$.fn.rt_fixed_rows = function( action ) {

		function fix_heights(row) {
			row.each(function(){

				var this_row_height = $(this).height();

				if( Modernizr.csstransforms3d ){
					$(this).find(" > .wpb_column,  > .col").css({'min-height': this_row_height });
				}else{//ie9 or before
					if(!$(this).hasClass("align-contents")){
						$(this).find(" > .wpb_column,  > .col").css({'height': this_row_height });
					}
				}

			});	
		}

		function reset_heights(row) {
			row.each(function(){

				var this_row_height = $(this).height();
				if( Modernizr.csstransforms3d ){
					$(this).find(" .wpb_column, .col").css({'min-height': "auto" });
				}else{//ie9 or before
					$(this).find(" .wpb_column, .col").css({'height': "auto" });
				}

			});	

			row.rt_fixed_rows("load");
		}
		
		if( action == "reset"){
			$(this).each(function(){
				if( $(this).children(".content_row_wrapper").length > 0 ){
					reset_heights( $(this).children(".content_row_wrapper") );
				}

				if( $(this).find(".content_row").length > 0 ){
					reset_heights( $(this).find(".content_row") );
				}

				if( $(this).find(".row").length > 0 ){
					reset_heights( $(this).find(".row") );
				}

				reset_heights( $(this) );
			}); 		
		}

		if( $(window).width() < 767 ){
			return false;
		} 

		if( action == "load"){
			$(this).each(function(){
				if( $(this).children(".content_row_wrapper").length > 0 ){
					fix_heights( $(this).children(".content_row_wrapper") );
				}

				if( $(this).find(".content_row").length > 0 ){
					fix_heights( $(this).find(".content_row") );
				}

				if( $(this).find(".row").length > 0 ){
					fix_heights( $(this).find(".row") );
				}

				fix_heights( $(this) );
			}); 
		}

	}; 

	//run the script
	$(window).on('rt_pace_done', function() {
		$('.fixed_heights').rt_fixed_rows("load");
	});

	$(window).on('resize', function() { 
		setTimeout(function() {
			$('.fixed_heights').rt_fixed_rows("reset"); 
		}, 700);			
	});		
   


	/* ******************************************************************************* 

		MASONRY LAYOUTS

	********************************************************************************** */  

	$.fn.rt_run_masonry_isotope = function(options) {
		
		$(this).each(function(){
			var $container = $(this);
 

		var $filter_navigation = $('[data-list-id="'+$(this).attr("id")+'"]'),
				isotope = function () {
					$container.isotope({
						resizable: true,
						itemSelector: '.isotope-item',
						layoutMode:'packery',
						percentPosition: true,
					});
				};
				isotope();
 
				//draw the lines			
				var w = $container.width(), 
					columnNum = $container.attr("data-column-width");

				$container.rt_vertical_lines({
					"w": w,
					"columnNum" : columnNum
				});

				//filter nativation
				$filter_navigation.rt_filter_nav( $container );				
		});

	}; 

	$.fn.rt_run_grid_isotope = function(options) {
		var $container = $(this),
			$filter_navigation = $(".filter-holder"),
			isotope = function () {
				$container.isotope({
					resizable: false,
					itemSelector: '.col',
					layoutMode:'packery'
				});
			};
		isotope();

		//filter nativation
		$filter_navigation.rt_filter_nav( $container );

	}; 

	//a function for drawing vertical lines to masonry layouts
	$.fn.rt_vertical_lines = function(options) {
 
		var options = $.extend({
			w: 980,
			columnNum: 3,
		}, options);


		if( $(this).find(".col:not(.col-sm-"+ 12/options["columnNum"] +")").length > 0 ){
			$(this).addClass("remove_borders");
			return;	
		}

		//clear newlines first for winresize
		$(this).find(".vertical_line").remove();

		//create new 
		var new_line = $('<div class="vertical_line"></div>');

		for (var i = 1; i < options["columnNum"]; i++) {
			new_line.clone().css({"left": ( options["w"] / options["columnNum"] ) * i + "px"}).prependTo( $(this) );
		};

	}; 

	//a function for filter navigation classes on click
	$.fn.rt_filter_nav = function( $container ) {
 
		var $optionLinks = $(this).find('a');

		$optionLinks.click(function(){
			var $this = $(this),
				selector = $(this).attr('data-filter'); 

			//filter items
			$container.isotope({ filter: selector });

			// add active class to the navigation item
			if ( $this.hasClass('active') ) {
				// don't proceed if the current item already selected
				return false;
			}

			var $optionSet = $this.parents('.filter_navigation');
			$optionSet.find('.active').removeClass('active');
			$this.addClass('active');

			return false;
		}); 

	}; 


	//start isotopes
	$(window).on('rt_images_loaded resize', function() {  
		$('.masonry').rt_run_masonry_isotope();
		$('.border_grid.filterable').rt_run_grid_isotope();
	}); 


	/* ******************************************************************************* 

		FIX IE FIXED BACKGROUND BUG

	********************************************************************************** */
		if(navigator.userAgent.match(/Trident\/7\./)) { // if IE
 
			$('body').on("mousewheel", function () {
				// remove default behavior
				event.preventDefault(); 

				//scroll without smoothing
				var wheelDelta = event.wheelDelta;
				var currentScrollPosition = window.pageYOffset;
				window.scrollTo(0, currentScrollPosition - wheelDelta);
			});
		}



	/* ******************************************************************************* 

		NO FLEXBOX
		flexbox fix for browsers like ie9

	********************************************************************************** */  

	$.fn.rt_no_flexbox_column_support = function( row )
	{

		//there are many bugs so we consider no flexbox support for IE11 also
		var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);
		if( isIE11 ){
			$(html).addClass("ie11-flexbox"); 
		}

		var column_alignments  =  $('.no-flexboxlegacy .content_row.full-height-row, .ie11-flexbox .content_row.full-height-row');

		//columns 		
		var $this       = row;
		var row_height  = $this.innerHeight();
		var item        = $this.find(".content_row_wrapper:eq(0)");
		var item_height = item.innerHeight();

		if( $this.hasClass("row-content-bottom") ){
			item.css({"margin-top":row_height-item_height+"px"});	
		}else if( $this.hasClass("row-content-middle") ){
			item.css({"margin-top":(row_height-item_height)/2+"px"});	
		}			
	 
	}

	$.fn.rt_no_flexbox_content_support = function()
	{

		var isIE9 = !!navigator.userAgent.match(/MSIE 9/);
		if( isIE9 ){
			return;
		}
 
		var content_alignments =  $('.no-flexbox .content_row_wrapper.align-contents');

		//contents
		content_alignments.each(function(){	

			var $this      = $(this);
			var row_height = window.getComputedStyle( $this[0] , null) ;
			row_height  = parseInt(row_height.getPropertyValue("height"));

			var columns    = $this.find("> .wpb_column"); 
			
			columns.each(function(){
				var $thiscol    = $(this);
				var item_height = $thiscol.outerHeight(); 

				if( $this.hasClass("content-align-bottom") ){
					$thiscol.css({"margin-top":row_height-item_height+"px"});	
				}else if( $this.hasClass("content-align-middle") ){
					$thiscol.css({"margin-top":(row_height-item_height)/2+"px"});	
				}	

			});

		});

	}

	$(window).on('rt_images_loaded resize', function() {    
		var s = setTimeout(function() {
		$.fn.rt_no_flexbox_content_support();
		}, 20 );		
	});	 


	/* ******************************************************************************* 

		RT Full Scrween Rows

	********************************************************************************** */

	$.fn.rt_full_screen_rows = function() {
 
		$(this).each(function(){
				var $this = $(this),
					window_height = $(window).height(),
					wp_admin_bar_height = $("#wpadminbar").outerHeight(),
					offset = $this.offset().top;	 

 				if( offset < window_height ){
 					$this.css({"min-height": window_height - offset +"px" }); 
 				}else{
 					$this.css({"min-height": window_height +"px" }); 
 				}

 				$.fn.rt_no_flexbox_column_support( $this );
		}); 

	}; 

	$('.full-height-row').rt_full_screen_rows(); 		 	
	$(window).on('window_width_resize', function() {  		 
		$('.full-height-row').rt_full_screen_rows(); 		 	
	});


	/* ******************************************************************************* 

		ANIMATE COLUMNS

	********************************************************************************** */ 
	$.fn.rt_col_animations = function()
	{
		$(this).each(function(){
			
			var $this = $(this);
			rt_animate_col($this);

			$(window).on("scroll", function( event ){

				if( $this.hasClass("animated") ){
					return;
				}

				rt_animate_col($this); 
			});

		});

		function rt_animate_col(wrapper){
			var timer = 0.1;
			if(wrapper.offset().top + 50 < $(window).scrollTop() + $(window).outerHeight()) {
			   wrapper.find(".wpb_column").each(function(){
						timer = timer+0.15;
						$(this).css({
							opacity:1,
							transition: 'opacity 0.4s ease-in '+timer+'s'
						});
			    });
			    wrapper.addClass("animated");
			}
		}

	}

	$(".animate-cols > .content_row_wrapper").rt_col_animations();  




	/* ******************************************************************************* 

		REVSLIDER PAUSE / RESUME

	***********************************************************************************/ 
 
	if( ! $.fn.rt_rev_control ){

		$.fn.rt_rev_control = function(action)
		{ 
			$(".rev_slider_wrapper").each(function(){							
				var $this = $(this);
				var id_array = $this.attr("id").split("_");
				var id = id_array[2];
				
				if(action == "pause"){
					$.globalEval( 'revapi'+id+'.revpause();' );
				}else{
				 	$.globalEval( 'revapi'+id+'.revresume();' );
				 	$.globalEval( 'revapi'+id+'.revredraw();' );
				}

			});	
		};
	}



	/* ******************************************************************************* 

		CATEGORY TREE

	***********************************************************************************/ 
 	if( ! $.fn.rt_category_tree ){

		$.fn.rt_category_tree = function()
		{ 
			var category = $(this);
			category.find('.cat-item:has(.children)').addClass('has-children');
			$('<span></span>').prependTo(category.find('.cat-item:has(.children)')); 

			category.find('.cat-item:has(.children) > span').on("click", function(){
			
				var parent = $(this).parent();

				if( parent.hasClass("current-cat") || parent.hasClass("current-cat-ancestor") ){
					parent.removeClass("current-cat current-cat-ancestor");	
					parent.addClass("active");	
				}
				
				parent.toggleClass("active");
			});

		};
	}

	$(".rt-category-tree").rt_category_tree();  

  	
 
