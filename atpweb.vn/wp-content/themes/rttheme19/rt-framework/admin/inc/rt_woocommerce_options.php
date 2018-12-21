<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * RT-Theme WooCommerce Options
 */

$this->options["woocommerce"] = array(

		'title' => __("WooCommerce", "rt_theme_admin"), 
		'description' => "", 
		'priority' => 10,
		'sections' => array(

						array(
							'id'       => 'product_lists',									
							'title'    => __("Product Listing Pages", "rt_theme_admin"), 
							"description" => "",

							'controls' => array( 


												array(
													"id"          => "rt-theme-19_woo_seperator_fi_0",	 
													"label"       => esc_html_x('Global Layout Options','Admin Panel','rt_theme_admin'),		
													"description" => "",
													"type"        => "rt_seperator"
												),


												array(
													"id"          => RT_THEMESLUG."_woo_layout",															
													"label"       => __("Layout",'rt_theme_admin'),
													"description" => __("Select and set a default column layout for the product category & archive listing pages for each of the (single) post items listed within those pages.",'rt_theme_admin'),
													"choices"     =>  array(
																		"1/6" => "1/6", 
																		"1/4" => "1/4",
																		"1/3" => "1/3",
																		"1/2" => "1/2",
																		"1/1" => "1/1"
															  		),			
													"default"   => "1/3",
													"transport" => "refresh", 
													"type"      => "select"
												),			

												array(
													"label"       => __("Amount of product items to show per page",'rt_theme_admin'),
													"description" => __("Set the amount of portfolio items to show per page before pagination kicks in.",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_woo_list_pager",
													"min"         => "1",
													"max"         => "200",
													"default"     => "9", 
													"type"        => "number",
													"transport"   => "refresh",
													"input_attrs" => array("min"=>1,"max"=>201),
													"callback"    => array(&$this, 'rt_sanitize_number')
												),


												array(
													"id"          => "rt-theme-19_woo_seperator_fi_1",	 
													"label"       => esc_html_x('Featured Images','Admin Panel','rt_theme_admin'),		
													"description" => __('Enable the "Image Resize" to resize or crop the featured images automatically. These settings will be used as globaly.<br /> Please note, since the theme is reponsive the images cannot be wider than the column they are in. Leave these values "0" to use theme defaults.','rt_theme_admin'),																										
													"type"        => "rt_seperator"
												),



												array(
													"label"       => __("Image Resize",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_woo_image_resize",
													"choices"     =>  array(
																		"false" => __("Disabled","rt_theme_admin"),						
																		"true" => __("Enabled","rt_theme_admin"),
																	),			
													"default"   => "true",
													"transport" => "postMessage", 
													"type"      => "select"
												),		

												array(
													"label"       => __("Featured Image Max Width",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_woo_image_width",
													"default"     => 0, 
													"type"        => "number",
													"transport"   => "postMessage",
													"input_attrs" => array("min"=>0,"max"=>3000, "data-depends-id" => RT_THEMESLUG."_woo_image_resize", "data-depends-values" => "true")
												),

												array(
													"label"       => __("Featured Image Max Height",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_woo_image_height",
													"default"     => 0, 
													"type"        => "number",
													"transport"   => "postMessage",
													"input_attrs" => array("min"=>0,"max"=>3000, "data-depends-id" => RT_THEMESLUG."_woo_image_resize", "data-depends-values" => "true")
												),

												array(
													"label"       => __("Crop Featured Image",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_woo_image_crop",
													"default"     => "",
													"transport"   => "postMessage",
													"type"        => "rt_checkbox",
													"input_attrs" => array("data-depends-id" => RT_THEMESLUG."_woo_image_resize", "data-depends-values" => "true")
												),
									 

										),
							),		
 	

							array(
								'id'       => 'related',									
								'title'    => __("Single Product Page", "rt_theme_admin"), 
								'controls' => array( 

 													array(
														"id"          => "rt-theme-19_woo_seperator0",	
														"label"       => "",
														"description" => esc_html_x('Single Product Layout','Admin Panel','rt_theme_admin'),															
														"type"        => "rt_seperator"
													),


													array(
														"id"          => RT_THEMESLUG."_woo_content_width",															
														"label"       => __("Product Info Width",'rt_theme_admin'),
														"description" => __("Select a width for the content block that contains product title, short info and the images.",'rt_theme_admin'),
														"choices"     =>  array(
																			"1/6" => "1/6",
																			"1/4" => "1/4",
																			"1/3" => "1/3",
																			"1/2" => "1/2",
																			"1/1" => "1/1"
																  		),			
														"default"   => "1/1",
														"transport" => "refresh", 
														"type"      => "select"
													),	
										
													array(
														"label"       => __("Tabular Content Style",'rt_theme_admin'),
														"description" => __('Select a style for the tabular content.','rt_theme_admin'),
														"id"          => RT_THEMESLUG."_woo_content_style",
														"choices"     =>  array(
																			"1" => __("Stlye 1 - Horizontal Tabs","rt_theme_admin"),
																			"2" => __("Stlye 2 - Left Vertical Tabs","rt_theme_admin"),
																			"3" => __("Stlye 3 - Right Vertical Tabs","rt_theme_admin"),
																  		),			
														"default"   => "1",
														"transport" => "refresh", 
														"type"      => "select"
													),

													array(
														"label"       => __("Hide Share Buttons",'rt_theme_admin'), 
														"id"          => RT_THEMESLUG."_hide_woo_share_buttons",
														"default"     => "",
														"transport"   => "refresh",
														"type"        => "checkbox"
													),	

 													array(
														"id"          => "rt-theme-19_woo_seperator1",	
														"label"       => "",
														"description" => esc_html_x('Product Images','Admin Panel','rt_theme_admin'),															
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_woo_image_style",
														"label"       => esc_html_x("Product Image Gallery Style",'Admin Panel','rt_theme_admin'),
														"description" => esc_html_x("Select a gallery style for the product images on the single page.",'Admin Panel','rt_theme_admin'),
														"choices"     =>  array(
																			"" => esc_html_x("Plugin's Default Gallery",'Admin Panel','rt_theme_admin'),
																			"theme" => esc_html_x("RT-Theme 19's Gallery",'Admin Panel','rt_theme_admin'),
																  		),
														"default"   => "default",
														"transport" => "refresh",
														"type"      => "select"
													),


													array(
														"label"       => esc_html_x("Disable Product Image Zoom",'Admin Panel','rt_theme_admin'),
														"description" => "",
														"id"          => RT_THEMESLUG."_woo_disable_zoom",
														"default"     => "",
														"transport"   => "refresh",
														"type"        => "rt_checkbox",
														"input_attrs" => array("data-depends-id" => RT_THEMESLUG."_woo_image_style", "data-depends-values" => "")
													),

 
 													array(
														"label"       => esc_html_x("Disable Lightbox",'Admin Panel','rt_theme_admin'),
														"description" => "",
														"id"          => RT_THEMESLUG."_woo_disable_lightbox",
														"default"     => "",
														"transport"   => "refresh",
														"type"        => "rt_checkbox",
														"input_attrs" => array("data-depends-id" => RT_THEMESLUG."_woo_image_style", "data-depends-values" => "")
													),

 													array(
														"id"          => "rt-theme-19_woo_seperator2",	
														"label"       => "",
														"description" => esc_html_x('Related Products','Admin Panel','rt_theme_admin'),															
														"type"        => "rt_seperator"
													),


													array(
														"id"          => RT_THEMESLUG."_woo_related_product_layout",															
														"label"       => __("Layout",'rt_theme_admin'),
														"description" => __("Select and set a default column layout for the related products list.",'rt_theme_admin'),
														"choices"     =>  array(
																			"1/6" => "1/6", 
																			"1/4" => "1/4",
																			"1/3" => "1/3",
																			"1/2" => "1/2",
																			"1/1" => "1/1"
																  		),			
														"default"   => "1/3",
														"transport" => "refresh", 
														"type"      => "select"
													),	
										
											),
							),		

					)
	);