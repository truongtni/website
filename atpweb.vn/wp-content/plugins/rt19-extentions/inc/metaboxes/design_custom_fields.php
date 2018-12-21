<?php
#-----------------------------------------
#	RT-Theme design_custom_fields.php
#	version: 1.0
#-----------------------------------------

//get nav list
$rt_nav_menu_list =rt_get_nav_menus();
$rt_nav_menu_list[""] = _x("Default",'Admin Panel','rt_theme_admin');
ksort($rt_nav_menu_list);

#
# 	Design Custom Fields
#

$customFields = array(

	array(
		"description" => __("Use these options to alter the global theme options for this page. ",'rt_theme_admin'),					
		"type"        => "info_text_only"
	),

/* ==========================================================================
    CUSTOM PAGE MENU
   ========================================================================== */
	array(
		"title" 		=> _x("CUSTOMIZE MENUS",'Admin Panel','rt_theme_admin'),
		"type" 			=> "heading"
	),

		array(
			"name"        => "_custom_main_menu",	
			"title"       => _x("Main Menu",'Admin Panel','rt_theme_admin'),
			"description" => "",
			"transport"   => "refresh",															
			"options"     => $rt_nav_menu_list,  
			"description" 	=> _x('You can change the main navigation menu for this page only.','Admin Panel','rt_theme_admin'),
			"default"     => "",
			"type"        => "select"
		), 

		array(
			"name"        => "_custom_side_panel_menu",	
			"title"       => _x("Side Panel Menu",'Admin Panel','rt_theme_admin'),
			"description" => "",
			"transport"   => "refresh",															
			"options"     => $rt_nav_menu_list,  
			"description" 	=> _x('You can change the side panel menu for this page only.','Admin Panel','rt_theme_admin'),
			"default"     => "",
			"type"        => "select"
		), 


/* ==========================================================================
   TOP HEADER 
   ========================================================================== */
	array(
		"title" 		=> __("HEADER",'rt_theme_admin'),
		"type" 			=> "heading"
	),

		array(
			"name"        => "_main_header_row_background_width",	
			"title"       => __("Header Bar Width",'rt_theme_admin'),
			"description" => "",
			"transport"   => "refresh",															
			"options"     => array(		 
									"global"   => __("Use the global value","rt_theme_admin"), 
									"fullwidth" => __("Full Width","rt_theme_admin"),
									"default"   => __("Content Width","rt_theme_admin"), 
							),  
			"type"    => "select"
		), 
);

		if( get_theme_mod(RT_THEMESLUG.'_layout') == "layout3" || get_theme_mod(RT_THEMESLUG.'_layout') == "layout4" ){
			$customFields = array_merge( $customFields ,array(
				array(
					"name"        => "_main_header_row_bg_color",	
					"title"       => __("Header Background Color",'rt_theme_admin'),
					"description" => "",
					"type"        => "colorpicker",
					"rt_skin"     => true
				),			

				array(
					"name"        => "_header_position",	
					"title"       => __("Header Position",'rt_theme_admin'),
					"description" => "",
					"transport"   => "refresh",															
					"options"     => array(		 
											"global"  => __("Use the global value","rt_theme_admin"), 
											"default" => __("Standard","rt_theme_admin"),
											"overlapped" => __("Overlapped","rt_theme_admin"), 
									),  
					"type"    => "select"
				), 
			));
		}




if( get_theme_mod(RT_THEMESLUG.'_layout') != "layout1" ){

	$customFields = array_merge( $customFields ,array(
	/* ==========================================================================
	    SIDEBARS
	   ========================================================================== */
		array(
			"title" 		=> __("PAGE LAYOUT",'rt_theme_admin'),
			"type" 			=> "heading"
		),

			array(
				"name"        => "_post_sidebar_position",	
				"title"       => __("Sidebar Position",'rt_theme_admin'),
				"description" => "",
				"transport"   => "refresh",															
				"options"     => array(		 
										"global"=> __("Use the global value","rt_theme_admin"), 
										""      => __("No Sidebar","rt_theme_admin"), 
										"left"  => __("Left","rt_theme_admin"),
										"right" => __("Right","rt_theme_admin"), 
								),  
				"default" => "global",
				"type"    => "select"
			), 

			array(
				"name"        => "_custom_sidebar_locations[]",	
				"title"       => _x("Customize Sidebar Locations",'Admin Panel','rt_theme_admin'),
				"description" => "",
				"transport"   => "refresh",															
				"options"     => rtframework_get_sidebar_list(),  
				"description" => _x("You can customize the sidebar locations and their order by using this select form. Leave blank for default settings.",'Admin Panel','rt_theme_admin'),
				"default"     => "",
				"type"        => "selectmultiple",
				"dependency" => array(
										"element" => "rttheme_post_sidebar_position",
										"value" => array("left","right")
									),					
			), 

	));
	
}

$customFields = array_merge( $customFields ,array(

/* ==========================================================================
    CONTENT WIDTH
   ========================================================================== */
	array(
		"title" 		=> __("CONTENT CONTAINER WIDTH",'rt_theme_admin'),
		"type" 			=> "heading"
	),

		array(
			"name"        => "_default_content_row_width",	
			"title"       => __("Content Container Width",'rt_theme_admin'),
			"description" => __("Control the content container width of the main content area. This option will be ignored if this page created with Visual Composer.",'rt_theme_admin'),
			"transport"   => "refresh",															
			"options"     => array(		 
									"global"   => __("Use the global value","rt_theme_admin"), 
									"fullwidth" => __("Full Width","rt_theme_admin"),
									"default"   => __("Content Width","rt_theme_admin"), 
							),  
			"type"    => "select"
		), 


/* ==========================================================================
    PAGE TITLE & BREADCRUMB MENU
   ========================================================================== */
	array(
		"title" 		=> __("PAGE TITLE & BREADCRUMB MENU",'rt_theme_admin'),
		"type" 			=> "heading"
	),

			array(
				"title" 		=> __("Hide The Page Title",'rt_theme_admin'),
				"name"			=> "_hide_page_title",
				"description" 	=> __('Control the visibility of the titles inside the page header bar.','rt_theme_admin'),
				"type" 			=> "checkbox"
			),	

			array(
				"title" 		=> __("Hide The Breadcrumb Menu",'rt_theme_admin'),
				"name"			=> "_hide_breadcrumb_menu",
				"description" 	=> __('Control the visibility of the breadcrumb menu inside the page header bar.','rt_theme_admin'),
				"type" 			=> "checkbox"
			),	

/* ==========================================================================
   SUB HEADER BAR STYLING
   ========================================================================== */
	array(
		"title" 		=> __("SUB HEADER BAR STYLING",'rt_theme_admin'),
		"type" 			=> "heading"
	),


));



if( get_theme_mod(RT_THEMESLUG.'_layout') != "layout1" || get_theme_mod(RT_THEMESLUG.'_layout') != "layout2" ){

	$customFields = array_merge( $customFields ,array(


		array(
			"name"        => "_sub_header_style",	
			"title"       => __("Sub Header Style",'rt_theme_admin'),
			"description" => "",
			"transport"   => "refresh",															
			"options"     => array(		 
									"global"  => __("Use the global value","rt_theme_admin"), 							
									"default-style" => __("Default","rt_theme_admin"), 
									"center-style"  => __("Centered","rt_theme_admin"),
								),  
			"type"    => "select",
			"hr" => true
		), 

	));
	
}

$customFields = array_merge( $customFields ,array(
	array(
		"name"        => "_header_row_background_width",	
		"title"       => __("Sub Header Bar Width",'rt_theme_admin'),
		"description" => "",
		"transport"   => "refresh",															
		"options"     => array(		 
							"global"   => __("Use the global value","rt_theme_admin"), 
							"fullwidth" => __("Full Width","rt_theme_admin"),
							"default"   => __("Content Width","rt_theme_admin"), 
						),  
		"type"    => "select",
		"hr" => true
	), 


	array(
		"title"         => __("Sub Header Background Options",'rt_theme_admin'),
		"description"   => __('You can customize the header background settings for this post only','rt_theme_admin'),
		"name"          =>  "_header_options", 
		"options"       =>  array(
			"default"      => __("Use the global settings","rt_theme_admin"), 
			"new"          => __("Customize for this post","rt_theme_admin"),
			), 
		"type"          => "select", 
		"class"         => "div_controller",
	),	 

		array( 
			"div_class"  => "hidden_options_set",
			"name"       => "_header_options_hidden",
			"type"       => "div_start",
			"dependency" => array(
								"element" => "rttheme_header_options",
								"value" => array("new")
							),					
		),

					array(
						"name"        => "_header_row_font_color",	
						"title"       => __("Page Title Font Color",'rt_theme_admin'),
						"description" => "",
						"transport"   => "postMessage",
						"default"     => "",															
						"type"        => "colorpicker",
						"rt_skin"     => true
					),			

					array(
						"name"        => "_header_row_bg_color",	
						"title"       => __("Background Color",'rt_theme_admin'),
						"description" => "",
						"type"        => "colorpicker",
						"rt_skin"     => true
					),			

					array(
						"name"        => "_header_row_bg_image", 	
						"title"       => __("Background Image",'rt_theme_admin'),
						"description" => "",									
						"type"        => "upload", 
					), 

					array(
						"name"        => "_header_row_bg_effect", 	
						"title"       => __("Parallax Effect",'rt_theme_admin'),
						"description" => "", 										
						"options"     => array(		
											"parallax" => __("Enabled","rt_theme_admin"),
											""         => __("Disabled","rt_theme_admin"), 
										),  
						"type"        => "select",	
					),

					array(
						"name"        => "_header_row_bg_position",	
						"title"       => __("Position",'rt_theme_admin'),
						"description" => "",												
						"options"     => array(		
											"right top"     => __("Right Top","rt_theme_admin"),
											"right center"  => __("Right Center","rt_theme_admin"),
											"right bottom"  => __("Right Bottom","rt_theme_admin"),
											"left top"      => __("Left Top","rt_theme_admin"),
											"left center"   => __("Left Center","rt_theme_admin"),
											"left bottom"   => __("Left Bottom","rt_theme_admin"),
											"center top"    => __("Center Top","rt_theme_admin"),
											"center center" => __("Center Center","rt_theme_admin"),
											"center bottom" => __("Center Bottom","rt_theme_admin"),
										),  
						"type"    => "select", 
					), 

				
					array(
						"name"        => "_header_row_bg_attachment",	
						"title"       => __("Attachment",'rt_theme_admin'),
						"description" => "",												
						"options"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),  
						"type"        => "radio",
					),


					array(
						"name"        => "_header_row_bg_image_repeat",	
						"title"       => __("Repeat",'rt_theme_admin'),
						"description" => "",										
						"options"     => array(		
										"repeat"       => __("Tile","rt_theme_admin"),
										"repeat-x"     => __("Tile Horizontally","rt_theme_admin"),
										"repeat-y"     => __("Tile Vertically","rt_theme_admin"),
										"no-repeat"    => __("No Repeat","rt_theme_admin"),
										),  
						"type"    => "radio",
					),

					array(
						"name"        => "_header_row_bg_size",	
						"title"       => __("Background Size",'rt_theme_admin'),
						"description" => "",													
						"options"     => array(		
										"auto auto" => __("Auto","rt_theme_admin"),
										"cover" => __("Cover","rt_theme_admin"),
										"contain" => __("Contain","rt_theme_admin"),
										"100% auto" => __("100%","rt_theme_admin"),
										"50% auto" => __("50%","rt_theme_admin"),
										"25% auto" => __("25%","rt_theme_admin"),
										),  
						"type"    => "select",
					),  

	array(	 
		"type" => "div_end"
	),		

/* ==========================================================================
    BREADCRUMB MENU STYLING
   ========================================================================== */
	array(
		"title" 		=> __("BREADCRUMB MENU STYLING",'rt_theme_admin'),
		"type" 			=> "heading"
	),

	array(
		"title"         => __("Breadcrumb Colors",'rt_theme_admin'),
		"description"          => __('You can customize the breadcrumbs styling for this post only.','rt_theme_admin'),
		"name"          =>  "_breadcrumb_styling", 
		"options"       =>  array(
			"default"      => __("Use the global settings","rt_theme_admin"), 
			"new"          => __("Customize for this post","rt_theme_admin"),
			), 
		"type"          => "select", 
		"class"         => "div_controller",
	),	 

		array( 
			"div_class"  => "hidden_options_set",
			"name"       => "_breadcrumb_styling_hidden",
			"type"       => "div_start",
			"dependency" => array(
								"element" => "rttheme_breadcrumb_styling",
								"value" => array("new")
							),					
		),
					array(
						"name"        => "_breadcrumb_font_color",	
						"title"       => __("Breadcrumb Font Color",'rt_theme_admin'),
						"description" => "",
						"type"        => "colorpicker",
					),

					array(
						"name"        => "_breadcrumb_link_color",	
						"title"       => __("Breadcrumb Link Color",'rt_theme_admin'),
						"description" => "",
						"type"        => "colorpicker",
					),

					array(
						"name"        => "_breadcrumb_bg_color",	
						"title"       => __("Breadcrumb Background Color",'rt_theme_admin'),
						"description" => "",													
						"type"        => "colorpicker",
					),

	array(	 
		"type" => "div_end"
	),		

/* ==========================================================================
    BODY
   ========================================================================== */

	array(
		"title" 		=> __("BODY",'rt_theme_admin'),
		"type" 		=> "heading"
	),

	array(
		"title"         => __("Body Background",'rt_theme_admin'),
		"description"   => __('You can customize the body background settings for this post only.','rt_theme_admin'),
		"name"          =>  "_body_background_options", 
		"options"       =>  array(
			"default"      => __("Use the global settings","rt_theme_admin"), 
			"new"          => __("Customize for this post","rt_theme_admin"),
			), 
		"type"          => "select", 
		"class"         => "div_controller",
	),	 

		array( 
			"div_class"  => "hidden_options_set",
			"name"       => "_body_background_options_hidden",
			"type"       => "div_start",
			"dependency" => array(
								"element" => "rttheme_body_background_options",
								"value" => array("new")
							),					
		),


 					array(
					"title" => __("Background Video (MP4)",'rt_theme_admin'),
					"desc"  => "",
					"name"  => "_body_background_video_mp4", 
					"type"  => "upload"),

					array(
					"title" => __("Background Video (WEBM)",'rt_theme_admin'),
					"desc"  => "",
					"name"  => "_body_background_video_webm", 
					"type"  => "upload",
					"hr"    => true
					),					


					array(
					"title" => __("Background Image",'rt_theme_admin'),
					"desc"  => "",
					"name"  => "_body_background_image_url", 
					"type"  => "upload"),


					array(
					"title" => __("Background Color",'rt_theme_admin'),
					"desc"  => "",
					"name"  => "_body_background_color",
					"type"  => "colorpicker"
					),

					array(
					"name"        => "_body_background_attachment",	
					"title"       => __("Attachment",'rt_theme_admin'), 								
					"options"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),  
					"type"        => "radio",
					),

					array(
					"title"   => __("Position",'rt_theme_admin'),
					"desc"    => "",
					"name"    => "_body_background_position",
					"options" => array(		
										"right top"     => __("Right Top","rt_theme_admin"),
										"right center"  => __("Right Center","rt_theme_admin"),
										"right bottom"  => __("Right Bottom","rt_theme_admin"),
										"left top"      => __("Left Top","rt_theme_admin"),
										"left center"   => __("Left Center","rt_theme_admin"),
										"left bottom"   => __("Left Bottom","rt_theme_admin"),
										"center top"    => __("Center Top","rt_theme_admin"),
										"center center" => __("Center Center","rt_theme_admin"),
										"center bottom" => __("Center Bottom","rt_theme_admin"),
									),  
					"type" => "select"),

					array(
					"title"   => __("Repeat",'rt_theme_admin'),
					"desc"    => "",
					"name"    => "_body_background_repeat",
					"options" => array(		
									"repeat"       => __("Tile","rt_theme_admin"),
									"repeat-x"     => __("Tile Horizontally","rt_theme_admin"),
									"repeat-y"     => __("Tile Vertically","rt_theme_admin"),
									"no-repeat"    => __("No Repeat","rt_theme_admin"),
									),  
					"type"    => "radio",
					"default" => "repeat"
					),

					array(
					"title"   => __("Background Size",'rt_theme_admin'),
					"desc"    => "",
					"name"    => "_body_background_size",
					"options" => array(		
									"auto auto" => __("Auto","rt_theme_admin"),
									"cover" => __("Cover","rt_theme_admin"),
									"contain" => __("Contain","rt_theme_admin"),
									"100% auto" => __("100%","rt_theme_admin"),
									"50% auto" => __("50%","rt_theme_admin"),
									"25% auto" => __("25%","rt_theme_admin"),
									),  
					"default" => "auto auto",
					"type"    => "select"
					),  

	 
	array(	 
		"type" => "div_end"
	),			

));

if( get_theme_mod(RT_THEMESLUG.'_layout') == "layout1" || get_theme_mod(RT_THEMESLUG.'_layout') == "" ){

	$customFields = array_merge( $customFields ,array(

	/* ==========================================================================
	    LEFT SIDE
	   ========================================================================== */

		array(
			"title" 		=> __("LEFT SIDE",'rt_theme_admin'),
			"type" 			=> "heading"
		),

		array(
			"title"         => __("Left Side",'rt_theme_admin'),
			"description"   => __('You can customize the left side background settings for this post only.','rt_theme_admin'),
			"name"          =>  "_left_background_options", 
			"options"       =>  array(
				"default"      => __("Use the global settings","rt_theme_admin"), 
				"new"          => __("Customize for this post","rt_theme_admin"),
				), 
			"type"          => "select", 
			"class"         => "div_controller",
		),	 

			array( 
				"div_class"  => "hidden_options_set",
				"name"       => "_left_background_options_hidden",
				"type"       => "div_start",
				"dependency" => array(
									"element" => "rttheme_left_background_options",
									"value" => array("new")
								),					
			),

						array(
						"title" => __("Background Image",'rt_theme_admin'),
						"desc"  => "",
						"name"  => "_left_background_image_url", 
						"type"  => "upload"),


						array(
						"title"   => __("Parallax Effect",'rt_theme_admin'),
						"desc"    => "",
						"name"    => "_left_background_parallax_effect", 
						"options" => array(
										"true" => __("Enabled", "rt_theme_admin"),
										"" => __("Disabled", "rt_theme_admin")
									),						
						"type" => "select"),


						array(
						"title" => __("Background Color",'rt_theme_admin'),
						"desc"  => "",
						"name"  => "_left_background_color",
						"type"  => "colorpicker"
						),
						 
						array(
						"title"   => __("Position",'rt_theme_admin'),
						"desc"    => "",
						"name"    => "_left_background_position",
						"options" => array(		
											"right top"     => __("Right Top","rt_theme_admin"),
											"right center"  => __("Right Center","rt_theme_admin"),
											"right bottom"  => __("Right Bottom","rt_theme_admin"),
											"left top"      => __("Left Top","rt_theme_admin"),
											"left center"   => __("Left Center","rt_theme_admin"),
											"left bottom"   => __("Left Bottom","rt_theme_admin"),
											"center top"    => __("Center Top","rt_theme_admin"),
											"center center" => __("Center Center","rt_theme_admin"),
											"center bottom" => __("Center Bottom","rt_theme_admin"),
										),  
						"type" => "select"),

						array(
						"title"   => __("Repeat",'rt_theme_admin'),
						"desc"    => "",
						"name"    => "_left_background_repeat",
						"options" => array(		
										"repeat"       => __("Tile","rt_theme_admin"),
										"repeat-x"     => __("Tile Horizontally","rt_theme_admin"),
										"repeat-y"     => __("Tile Vertically","rt_theme_admin"),
										"no-repeat"    => __("No Repeat","rt_theme_admin"),
										),  
						"type"    => "radio",
						"default" => "repeat"
						),

						array(
						"title"   => __("Background Size",'rt_theme_admin'),
						"desc"    => "",
						"name"    => "_left_background_size",
						"options" => array(		
										"auto auto" => __("Auto","rt_theme_admin"),
										"cover" => __("Cover","rt_theme_admin"),
										"contain" => __("Contain","rt_theme_admin"),
										"100% auto" => __("100%","rt_theme_admin"),
										"50% auto" => __("50%","rt_theme_admin"),
										"25% auto" => __("25%","rt_theme_admin"),
										),  
						"default" => "auto auto",
						"type"    => "select"
						),  

		 
		array(	 
			"type" => "div_end"
		),			

		array(
			"title"       => __("Top padding of the left side (px)",'rt_theme_admin'),
			"description" => __('Set a padding value in pixels for the left side top. Use only numbers and leave blank to use the global value.','rt_theme_admin'),
			"name"        => "_left_top_padding",
			"default"     => "",
			"type"        => "text"
		), 

	/* ==========================================================================
	    RIGHT SIDE
	   ========================================================================== */

		array(
			"title" 		=> __("RIGHT SIDE",'rt_theme_admin'),
			"type" 		=> "heading"
		),

		array(
			"title"         => __("Right Side Background",'rt_theme_admin'),
			"description"   => __('You can customize the right side background settings for this post only.','rt_theme_admin'),
			"name"          =>  "_right_background_options", 
			"options"       =>  array(
				"default"      => __("Use the global settings","rt_theme_admin"), 
				"new"          => __("Customize for this post","rt_theme_admin"),
				), 
			"type"          => "select", 
			"class"         => "div_controller",
		),	 


			array( 
				"div_class"  => "hidden_options_set",
				"name"       => "_right_background_options_hidden",
				"type"       => "div_start",
				"dependency" => array(
									"element" => "rttheme_right_background_options",
									"value" => array("new")
								),					
			),

						array(
						"title" => __("Background Image",'rt_theme_admin'),
						"name"  => "_right_background_image_url", 
						"type"  => "upload"),


						array(
						"title" => __("Background Color",'rt_theme_admin'),
						"name"  => "_right_background_color",
						"type"  => "colorpicker"
						),

						array(
						"name"        => "_right_background_attachment",	
						"title"       => __("Attachment",'rt_theme_admin'), 								
						"options"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),  
						"type"        => "radio",
						),

						array(
						"title"   => __("Position",'rt_theme_admin'),
						"name"    => "_right_background_position",
						"options" => array(		
											"right top"     => __("Right Top","rt_theme_admin"),
											"right center"  => __("Right Center","rt_theme_admin"),
											"right bottom"  => __("Right Bottom","rt_theme_admin"),
											"left top"      => __("Left Top","rt_theme_admin"),
											"left center"   => __("Left Center","rt_theme_admin"),
											"left bottom"   => __("Left Bottom","rt_theme_admin"),
											"center top"    => __("Center Top","rt_theme_admin"),
											"center center" => __("Center Center","rt_theme_admin"),
											"center bottom" => __("Center Bottom","rt_theme_admin"),
										),  
						"type" => "select"),

						array(
						"title"   => __("Repeat",'rt_theme_admin'),
						"name"    => "_right_background_repeat",
						"options" => array(		
										"repeat"       => __("Tile","rt_theme_admin"),
										"repeat-x"     => __("Tile Horizontally","rt_theme_admin"),
										"repeat-y"     => __("Tile Vertically","rt_theme_admin"),
										"no-repeat"    => __("No Repeat","rt_theme_admin"),
										),  
						"type"    => "radio",
						"default" => "repeat"
						),

						array(
						"title"   => __("Background Size",'rt_theme_admin'),
						"name"    => "_right_background_size",
						"options" => array(		
										"auto auto" => __("Auto","rt_theme_admin"),
										"cover" => __("Cover","rt_theme_admin"),
										"contain" => __("Contain","rt_theme_admin"),
										"100% auto" => __("100%","rt_theme_admin"),
										"50% auto" => __("50%","rt_theme_admin"),
										"25% auto" => __("25%","rt_theme_admin"),
										),  
						"default" => "auto auto",
						"type"    => "select"
						),  

		 
		array(	 
			"type" => "div_end"
		),			

		array(
			"title"       => __("Top padding of the right side (px)",'rt_theme_admin'),
			"description" => __('Set a padding value in pixels for the right side top. Use only numbers and leave blank to use the global value.','rt_theme_admin'),
			"name"        => "_right_top_padding",
			"default"     => "",
			"type"        => "text"
		), 
));
}

$customFields = array_merge( $customFields ,array(
/* ==========================================================================
    FOOTER
   ========================================================================== */
	array(
		"title" 		=> __("FOOTER STYLING",'rt_theme_admin'),
		"type" 			=> "heading"
	),


	array(
		"name"        => "_footer_background_width",	
		"title"       => __("Footer Container Width",'rt_theme_admin'),
		"description" => "",
		"transport"   => "refresh",															
		"options"     => array(		 
							"global"   => __("Use the global value","rt_theme_admin"), 
							"fullwidth" => __("Full Width","rt_theme_admin"),
							"default"   => __("Content Width","rt_theme_admin"), 
						),  
		"type"    => "select"
	), 

	array(
		"name"        => "_footer_content_width",	
		"title"       => __("Footer Content Width",'rt_theme_admin'),
		"description" => "",
		"transport"   => "refresh",															
		"options"     => array(		 
							"global"   => __("Use the global value","rt_theme_admin"), 
							"fullwidth" => __("Full Width","rt_theme_admin"),
							"default"   => __("Content Width","rt_theme_admin"), 
						),  
		"type"    => "select"
	), 

));

$settings  = array( 
	"name"		 => __("Design Options",'rt_theme_admin'),
	"scope"		 => array('page','post','product','portfolio','products','staff'),
	"slug"		 => "rt_design_custom_fields",
	"capability" => "edit_page",
	"context"	 => "normal",
	"priority"	 => "core" 
);

$rt_design_custom_fields = new rt_meta_boxes($settings,$customFields);


?>