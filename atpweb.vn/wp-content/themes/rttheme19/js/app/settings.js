
	/* ******************************************************************************* 

		GLOBAL VARS

	***********************************************************************************/ 	
	var is_rtl = $("body").hasClass("rtl");
	var window_width = $(window).width(); 
	var is_layout1 = $("body").hasClass("layout1");
	var is_layout2 = $("body").hasClass("layout2");
	var is_layout3 = $("body").hasClass("layout3");
	var is_layout4 = $("body").hasClass("layout4");

	/* ******************************************************************************* 

		LOADERS

	***********************************************************************************/ 

	$('html').imagesLoaded( { background: ".has-bg-image, body, .slide-background, .left-side-background, #right_side" }, function() {	//all images loaded
		$(window).trigger("rt_images_loaded");
	});

	$(window).on('rt_images_loaded', function() { //window and all images loaded
		if( document.readyState === "complete" ){
			$(window).trigger("rt_loaded");
		}else{
			$(window).on('load', function() {
				$(window).trigger("rt_loaded");
			});
		}
	});

	Pace.on('hide', function(){ //everything loaded including ajax
		$(window).trigger("rt_pace_done");
	});
 

	/* ******************************************************************************* 

		WINDOW WIDTH RESIZE ONLY

	***********************************************************************************/ 
	$(window).resize(function(){
		if($(this).width() != window_width){
			window_width = $(this).width();   
			$(window).trigger("window_width_resize");
		}
	});

	/* ******************************************************************************* 

		CHECK IF THE HIDDEN MOBILE MENU ACTIVE

	***********************************************************************************/ 
	if( ! $.fn.is_mobile_menu ){

		$.fn.is_mobile_menu = function()
		{ 
			return $(window).width() < 980;
		};
	}
