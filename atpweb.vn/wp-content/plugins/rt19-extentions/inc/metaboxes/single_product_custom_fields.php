<?php
#-----------------------------------------
#	RT-Theme single_product_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Single Product Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/
 
	/**
	 * 
	 * 
	 * WooCommerce Single Content Layout
	 *
	 * 
	 */
	$customFields = array(


		array(
			"title"         => __("Single Product Layout",'rt_theme_admin'),
			"description"          => __('Use this options to overwrite to global single product layout. Select "new" to customize the single product page layout for this post only.','rt_theme_admin'),
			"name"          =>  "_product_content_layout_options", 
			"options"       =>  array(
				"default"      => __("Use the global settings","rt_theme_admin"), 
				"new"          => __("Customize for this post","rt_theme_admin"),
				), 
			"type"          => "select", 
			"class"         => "div_controller",
		),	 

			array( 
				"div_class"  => "hidden_options_set",
				"name"       => "_product_content_layout_hidden",
				"type"       => "div_start",
				"dependency" => array(
									"element" => "rttheme_product_content_layout_options",
									"value" => array("new")
								),					
			),
	 
						array(
							"name"        => "_product_content_width",	
							"title"       => __("Product Info Width",'rt_theme_admin'),
							"description" => __('Select a width for the content block that contains product title, short info and the images.','rt_theme_admin'),												
							"options"     => array(		
													"1/6" => "1/6",
													"1/4" => "1/4",
													"1/3" => "1/3",
													"1/2" => "1/2",
													"1/1" => "1/1"
											),  
							"type"    => "select", 
						), 


						array(
							"name"        => "_product_content_style",	
							"title"       => __("Product Info Width",'rt_theme_admin'),
							"description" => __('Select a width for the content block that contains product title, short info and the images.','rt_theme_admin'),												
							"options"     => array(		
													"1" => __("Stlye 1 - Horizontal Tabs","rt_theme_admin"),
													"2" => __("Stlye 2 - Left Vertical Tabs","rt_theme_admin"),
													"3" => __("Stlye 3 - Right Vertical Tabs","rt_theme_admin")
											),  
							"type"    => "select", 
						), 

		array(	 
			"type" => "div_end"
		),		 
	);

	$settings  = array( 
		"name"		 => __("Single Product Layout",'rt_theme_admin'),
		"scope"		 => array('product'),
		"slug"		 => "rt_single_product_custom_fields",
		"capability" => "edit_page",
		"context"	 => "side",
		"priority"	 => "" 
	);

	$rt_single_product_custom_fields = new rt_meta_boxes($settings,$customFields);


	/**
	 * 
	 * 
	 * Product Showcase Single Content Layout
	 *
	 * 
	 */

	$customFields = array(


		array(
			"title"         => __("Single Product Layout",'rt_theme_admin'),
			"description"          => __('Use this options to overwrite to global single product layout. Select "new" to customize the single product page layout for this post only.','rt_theme_admin'),
			"name"          =>  "_product_content_layout_options", 
			"options"       =>  array(
				"default"      => __("Use the global settings","rt_theme_admin"), 
				"new"          => __("Customize for this post","rt_theme_admin"),
				), 
			"type"          => "select", 
			"class"         => "div_controller",
		),	 

			array( 
				"div_class"  => "hidden_options_set",
				"name"       => "_product_content_layout_hidden",
				"type"       => "div_start",
				"dependency" => array(
									"element" => "rttheme_product_content_layout_options",
									"value" => array("new")
								),					
			),
	 
						array(
							"name"        => "_product_content_width",	
							"title"       => __("Product Info Width",'rt_theme_admin'),
							"description" => __('Select a width for the content block that contains product title, short info and the images.','rt_theme_admin'),												
							"options"     => array(		
													"1/6" => "1/6",
													"1/4" => "1/4",
													"1/3" => "1/3",
													"1/2" => "1/2",
													"1/1" => "1/1"
											),  
							"type"    => "select", 
						), 


						array(
							"name"        => "_product_content_style",	
							"title"       => __("Product Info Width",'rt_theme_admin'),
							"description" => __('Select a width for the content block that contains product title, short info and the images.','rt_theme_admin'),												
							"options"     => array(		
													"1" => __("Stlye 1 - Horizontal Tabs","rt_theme_admin"),
													"2" => __("Stlye 2 - Left Vertical Tabs","rt_theme_admin"),
													"3" => __("Stlye 3 - Right Vertical Tabs","rt_theme_admin"),
													"4" => __("Stlye 4 - Accordion","rt_theme_admin"),
											),  
							"type"    => "select", 
						), 

		array(	 
			"type" => "div_end"
		),		 
	);

	$settings  = array( 
		"name"		 => __("Single Product Layout",'rt_theme_admin'),
		"scope"		 => array('products'),
		"slug"		 => "rt_single_product_custom_fields",
		"capability" => "edit_page",
		"context"	 => "side",
		"priority"	 => "" 
	);

	$rt_single_product_custom_fields = new rt_meta_boxes($settings,$customFields);

?>