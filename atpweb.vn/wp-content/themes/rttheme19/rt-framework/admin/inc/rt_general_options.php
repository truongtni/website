<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * RT-Theme Options Without Panels
 */
$this->options["rt_single_options"] = array(

			array(
				'id'       => 'logo',
				'title' => __("Logo Options", "rt_theme_admin"), 
				'priority' => 1,
				"description" => '<ul><li class="icon-ok">'.__('Select image files to use as the website logo.','rt_theme_admin').'</li><li class="icon-ok">'.__('There is a "Logo Box" that holds the logo image. The box dimensions can be adjusted by using settings inside the "Styling Options / Logo Box" section. For the vertical header, it is 290px wide minus the logo box paddings.','rt_theme_admin').'</li><li class="icon-ok">'.__('Retina Devices: There are two ways to get a sharp looking logo on retina devices. You can either use 2x bigger images than the "Logo Box" dimensions for the "Standard Logo" or upload separate files by using the second form set below. Use the second option if your logo does not look good when resized by browser.','rt_theme_admin').'</li></ul>',
				'controls' => array( 



									array(
										"id"          => RT_THEMESLUG."_logo_seperator",
										"label"       => __('Standard Logo','rt_theme_admin'),
										"type"        => "rt_subsection_heading",
										"description" => __('The default logo set of your website.','rt_theme_admin'),
									),

									array(
										"id"          => RT_THEMESLUG."_logo_url", 	
										"label"       => __("Logo Image",'rt_theme_admin'),
										"transport"   => "refresh",															
										"type"        => get_theme_mod(RT_THEMESLUG."_logo_url") == "" || is_numeric( get_theme_mod(RT_THEMESLUG."_logo_url") )? "media" : "rt_media",
									), 

									array(
										"id"          => RT_THEMESLUG."_sticky_logo_url", 	
										"label"       => __("Logo Image for the Sticky Header (optional)",'rt_theme_admin'),
										"description" => __('Upload an alternative logo image for the sticky navigation bar.','rt_theme_admin'),
										"transport"   => "refresh",															
										"type"        => get_theme_mod(RT_THEMESLUG."_sticky_logo_url") == "" || is_numeric( get_theme_mod(RT_THEMESLUG."_sticky_logo_url") )? "media" : "rt_media",
									),


									array(
										"id"          => RT_THEMESLUG."_logo_seperator2",
										"label"       => __('Retina Logo (optional)','rt_theme_admin'),
										"description" => __('Use a bigger image than the standard logo like 2x to get a sharp look on retina devices. The retina and standard logo images must be in the same aspect ratio. For example; create 200x100px logo for 100x50px standard logo image.','rt_theme_admin'),
										"type"        => "rt_subsection_heading",
									),

									array(
										"id"          => RT_THEMESLUG."_logo_url_2x", 	
										"label"       => __("Retina Logo Image",'rt_theme_admin'),				
										"description" => "",
										"transport"   => "refresh",															
										"type"        => "media",
									), 

									array(
										"id"          => RT_THEMESLUG."_sticky_logo_url_2x", 	
										"label"       => __("Retina Logo Image for the Sticky Header (optional)",'rt_theme_admin'),
										"description" => __('Upload an alternative logo image for the sticky navigation bar.','rt_theme_admin'),
										"transport"   => "refresh",															
										"type"        => "media",
									)

							),
			), 


			array(
				'id'       => 'copyright',
				'title'    => __("Copyright Text", "rt_theme_admin"), 
				'controls' => array( 

									array(
										"id"          => RT_THEMESLUG."_copyright", 	
										"label"       => __("Copyright Text",'rt_theme_admin'),
										"description" => __('The copyright text will be displayed in the footer of your website.','rt_theme_admin'),
										"transport"   => "refresh",		
										"default"     =>  'Copyright &copy; Company Name, Inc.',													
										"type"        => "textarea",
										"sanitize_callback" => "rt_sanitize_basic_html"
									), 

							),
			), 

	);

/**
 * RT-Theme General Options
 */
$this->options["rt_general_options"] = array(

		'title' => __("General Options", "rt_theme_admin"), 
		'priority' => 1,
		//'description' => __("General Options Desc", "rt_theme_admin"), 
		'sections' => array(
			

							array(
								'id'       => 'performance',
								'title'    => __("Performance", "rt_theme_admin"), 
								"description" => __('Speed up your website by using minified and combined versions of the css/js files that used for the theme. ','rt_theme_admin'),								
								'controls' => array(

													array(
														"id"        => RT_THEMESLUG."_optimize_css",															
														"label"     => __("Combine & optimize CSS files of the theme",'rt_theme_admin'),														
														"default"   => "",
														"transport" => "refresh",
														"type"      => "checkbox",
													),	

													array(
														"id"        => RT_THEMESLUG."_optimize_js",															
														"label"     => __("Combine & optimize JS files of the theme",'rt_theme_admin'),														
														"default"   => "",
														"transport" => "refresh",
														"type"      => "checkbox",
													),	

											),
							),


							array(
								'id'       => 'breadcrumb',
								'title'    => __("Breadcrumb Menus", "rt_theme_admin"), 
								'controls' => array( 

													array(
														"id"          => RT_THEMESLUG."_blog_page",															
														"label"       => __("Blog Start Page",'rt_theme_admin'),
														"description" => __("Select blog start page to add after home link.",'rt_theme_admin'),
														"default"   => "0",
														"transport" => "refresh", 
														"type"      => "dropdown-pages"
													),														
													array(
														"id"          => RT_THEMESLUG."_product_list",															
														"label"       => __("Product Showcase Start Page",'rt_theme_admin'),
														"description" => __("Select product start page to add after the home link.",'rt_theme_admin'),
														"default"   => "0",
														"transport" => "refresh", 
														"type"      => "dropdown-pages"
													),												
													array(
														"id"          => RT_THEMESLUG."_portf_page",															
														"label"       => __("Portfolio Start Page",'rt_theme_admin'),
														"description" => __("Select portfolio start page to add after the home link.",'rt_theme_admin'),		
														"default"   => "0",
														"transport" => "refresh", 
														"type"      => "dropdown-pages"
													),	
													array(
														"id"          => RT_THEMESLUG."_staff_page",															
														"label"       => __("Team Start Page",'rt_theme_admin'),
														"description" => __("Select team/staff start page to add after the home link.",'rt_theme_admin'),		
														"default"   => "0",
														"transport" => "refresh", 
														"type"      => "dropdown-pages"
													),

													array(
														"id"          => RT_THEMESLUG."_shop_start_page",															
														"label"       => __("WooCommerce Shop Start Page",'rt_theme_admin'),
														"description" => __("Select shop start page to add after the home link for WooCommerce links. Note: When you define a start page by using this option, the default WooCommerce breadcrumb menu will be disabled.",'rt_theme_admin'),		
														"default"   => "0",
														"transport" => "refresh", 
														"type"      => "dropdown-pages"
													),													
											),
							),


							array(
								'id'       => 'sidebars',
								'title'    => __("Sidebar Options", "rt_theme_admin"), 
								'controls' => array( 
													
													array(
														"id"          => RT_THEMESLUG."_default_sidebar_position",	
														"label"       => __("Default Sidebar Position",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",															
														"choices"     => array(		
																			""      => __("No Sidebar","rt_theme_admin"),
																			"left"  => __("Left Sidebar","rt_theme_admin"),
																			"right" => __("Right Sidebar","rt_theme_admin"), 
																		),  
														"type" => "select",
														"default" => "",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_sidebar_blog_cats",	
														"label"       => __("Sidebar Position for Blog Categories",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",															
														"choices"     => array(		
																			""      => __("No Sidebar","rt_theme_admin"),
																			"left"  => __("Left Sidebar","rt_theme_admin"),
																			"right" => __("Right Sidebar","rt_theme_admin"), 
																		),  
														"type" => "select",
														"default" => "",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_sidebar_portfolio_cats",	
														"label"       => __("Sidebar Position for Portfolio Categories",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",															
														"choices"     => array(		
																			""      => __("No Sidebar","rt_theme_admin"),
																			"left"  => __("Left Sidebar","rt_theme_admin"),
																			"right" => __("Right Sidebar","rt_theme_admin"), 
																		),  
														"type" => "select",
														"default" => "",
														"rt_skin"   => true
													),												

													array(
														"id"          => RT_THEMESLUG."_sidebar_product_cats",	
														"label"       => __("Sidebar Position for Product Showcase Categories",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",															
														"choices"     => array(		
																			""      => __("No Sidebar","rt_theme_admin"),
																			"left"  => __("Left Sidebar","rt_theme_admin"),
																			"right" => __("Right Sidebar","rt_theme_admin"), 
																		),  
														"type" => "select",
														"default" => "",
														"rt_skin"   => true
													),	

													array(
														"id"          => RT_THEMESLUG."_sidebar_woo_cats",	
														"label"       => __("Sidebar Position for WooCommerce Categories",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",															
														"choices"     => array(		
																			""      => __("No Sidebar","rt_theme_admin"),
																			"left"  => __("Left Sidebar","rt_theme_admin"),
																			"right" => __("Right Sidebar","rt_theme_admin"), 
																		),  
														"type" => "select",
														"default" => "",
														"rt_skin"   => true
													),	
													
													/*
													array(
														"id"          => RT_THEMESLUG."_sidebar_test_cats",	
														"label"       => __("Sidebar Position for Testimonial Categories",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",															
														"choices"     => array(		
																			""      => __("No Sidebar","rt_theme_admin"),
																			"left"  => __("Left Sidebar","rt_theme_admin"),
																			"right" => __("Right Sidebar","rt_theme_admin"), 
																		),  
														"type" => "select",
														"default" => "",
														"rt_skin"   => true
													),	
													*/

											),
							),


							array(
								'id'          => 'page_comments',
								'title'       => __("Page Comments", "rt_theme_admin"), 
								"description" => __("Turn ON this option if you want to allow comments on regular pages. Make sure 'Allow Comments' box is also checked for individual pages. If you dont see that option in your pages make sure to turn on the &#39;discussions&#39; option in the screen options below the admin name while you are in that page editing the content.",'rt_theme_admin'),				
								'controls'    => array( 

													array(
														"id"        => RT_THEMESLUG."_allow_page_comments",															
														"label"     => __("Allow comments on pages",'rt_theme_admin'),														
														"default"   => 0,
														"transport" => "refresh",
														"type"      => "checkbox",
													),	

											),
							),
   

							array(
								'id'          => 'page_loading',
								'title'       => __("Page Loading Effect", "rt_theme_admin"), 
								"description" => __("Check this option to enable page loading effect",'rt_theme_admin'),				
								'controls'    => array( 

													array(
														"id"          => RT_THEMESLUG."_page_loading_effect",															
														"label"       => __("Page Loading Effect",'rt_theme_admin'),
														"description" => __("Displays the loading animation while the page loading.",'rt_theme_admin'),																		
														"default"     => 1,
														"transport"   => "refresh",
														"type"        => "checkbox",
													),	

													array(
														"id"          => RT_THEMESLUG."_page_leaving_effect",
														"label"       => __("Extend The Loading Effect",'rt_theme_admin'),
														"description" => __("Starts the loading animation the moment a local link clicked.",'rt_theme_admin'),																		
														"default"     => "",
														"transport"   => "refresh",
														"type"        => "checkbox",
													),	

											),
							),


							array(
								'id'          => 'go_to_top',
								'title'       => __("Go to Top Button", "rt_theme_admin"), 
								"description" => __("Check this option to display a 'go to top' button right bottom corner of your website",'rt_theme_admin'),				
								'controls'    => array( 

													array(
														"id"        => RT_THEMESLUG."_go_top_button",															
														"label"     => __("Display go to top button",'rt_theme_admin'),														
														"default"   => 0,
														"transport" => "refresh",
														"type"      => "checkbox",
													),	

											),
							),

							array(
								'id'          => 'google_maps',
								'title'       => __("Google Maps", "rt_theme_admin"), 
								"description" => __("Enter your Google API key. Refer online documentation of the theme to learn how to get your API key.",'rt_theme_admin'),				
								'controls'    => array( 

														array(
															"id"        => RT_THEMESLUG."_google_api_key",															
															"label"     => __("Google API Key",'rt_theme_admin'),														
															"default"   => "",
															"transport" => "refresh",
															"type"      => "text",
														),	

											),
							),							

					)
	);