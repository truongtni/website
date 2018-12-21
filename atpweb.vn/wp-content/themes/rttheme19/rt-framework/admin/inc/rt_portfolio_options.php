<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
*  Portfolio Options
*/
$this->options["rt_portfolio_options"] = array(

	'title' => __("Portfolio Options", "rt_theme_admin"), 
	//'description' => "", 
	'priority' => 4,
	'sections' => array(

						array(
							'id'       => 'misc',
							'title'    => __("Global Layout Options", "rt_theme_admin"), 
							'controls' => array( 
												array(
													"id"          => RT_THEMESLUG."_portfolio_layout",															
													"label"       => __("Layout",'rt_theme_admin'),
													"description" => __("Select and set a default column layout for the Portfolio category & archive listing pages for each of the (single) post items listed within those pages.",'rt_theme_admin'),
													"choices"     =>  array(
																		"1/6" => "1/6", 
																		"1/4" => "1/4",
																		"1/3" => "1/3",
																		"1/2" => "1/2",
																		"1/1" => "1/1"
															  		),			
													"default"   => "1/2",
													"transport" => "refresh", 
													"type"      => "select"
												),										
												array(
													'id'          => RT_THEMESLUG.'_portfolio_layout_style',
													'label'       => __("Layout Style",'rt_theme_admin'),
													"description" => __("Select and set a default layout style for the Portfolio category & archive listing pages",'rt_theme_admin'),
													'type'        => 'select',
													'default'     => 'grid',
													"transport"   => "refresh",
													'choices'     => array(
																		"grid" => __("Grid","rt_theme_admin"),
																		"masonry" => __("Masonry","rt_theme_admin"),
																	),
												),
												array(
													"label"       => __("Item Style",'rt_theme_admin'),
													"description" => __("Select a style for the portfolio item in listing pages & categories.",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_portfolio_item_style",
													"choices"     =>  array(
																		"style-1" => __("Style 1 - Info under the featured image","rt_theme_admin"),						
																		"style-2" => __("Style 2 - Info embedded to the featured image ","rt_theme_admin"),
																	),			
													"default"   => "style-1",
													"transport" => "refresh", 
													"type"      => "select"
												),														
										),
						),							

						array(
							'id'       => 'style',
							'title'    => __("Listing Parameters", "rt_theme_admin"), 
							'controls' => array( 

												array(
													"label"       => __("Amount of portfolio items to show per page",'rt_theme_admin'),
													"description" => __("Set the amount of portfolio items to show per page before pagination kicks in.",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_portf_pager",
													"min"         => "1",
													"max"         => "200",
													"default"     => "9", 
													"type"        => "number",
													"transport"   => "postMessage",
													"input_attrs" => array("min"=>1,"max"=>201)
												),
									
												array(
													"label"       => __("OrderBy Parameter",'rt_theme_admin'),
													"description" => __("Select and set the sorting order for the portfolio items within the portfolio listing pages by this parameter.",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_portf_list_orderby",
													"choices"     => array('author'=>__('Author','rt_theme_admin'),'date'=>__('Date','rt_theme_admin'),'title'=>__('Title','rt_theme_admin'),'modified'=>__('Modified','rt_theme_admin'),'ID'=>__('ID','rt_theme_admin'),'rand'=>__('Randomized','rt_theme_admin')), 
													"default"     => "date",
													"transport"   => "postMessage",
													"type"        => "select"
												),
									
												array(
													"label"       => __("Order",'rt_theme_admin'),
													"description" => __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_portf_list_order",
													"choices"     => array('ASC'=>__('Ascending','rt_theme_admin'),'DESC'=>__('Descending','rt_theme_admin')),
													"default"     => "DESC",
													"transport"   => "postMessage",				
													"type"        => "select"
												),

										),
						),		

						array(
							'id'       => 'featured_img',									
							'title'    => __("Featured Images", "rt_theme_admin"), 
							"description" => __('Enable "Image Resize" to resize or crop the featured images automatically. These settings will be used as globaly and you can change for each portfolio post individiually (via edit post screen). <br />
												Please note, since the theme is reponsive the images cannot be wider than the column they are in. Leave these values "0" to use theme defaults.','rt_theme_admin'),

							'controls' => array( 

												array(
													"label"       => __("Image Resize",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_portfolio_image_resize",
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
													"id"          => RT_THEMESLUG."_portfolio_image_width",
													"default"     => 0, 
													"type"        => "number",
													"transport"   => "postMessage",
													"input_attrs" => array("min"=>0,"max"=>3000, "data-depends-id" => RT_THEMESLUG."_portfolio_image_resize", "data-depends-values" => "true")
												),


												array(
													"label"       => __("Featured Image Max Height",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_portfolio_image_height",
													"default"     => 0, 
													"type"        => "number",
													"transport"   => "postMessage",
													"input_attrs" => array("min"=>0,"max"=>3000, "data-depends-id" => RT_THEMESLUG."_portfolio_image_resize", "data-depends-values" => "true")
												),

												array(
													"label"       => __("Crop Featured Image",'rt_theme_admin'),
													"id"          => RT_THEMESLUG."_portfolio_image_crop",
													"default"     => "",
													"transport"   => "postMessage",
													"type"        => "rt_checkbox",
													"input_attrs" => array("data-depends-id" => RT_THEMESLUG."_portfolio_image_resize", "data-depends-values" => "true")
												),
									 

										),
						),		


						array(
							'id'       => 'comment',									
							'title'    => __("Comments", "rt_theme_admin"), 
							'controls' => array( 

												array(
													"label"       => __("Enable Commenting",'rt_theme_admin'),
													"description" => __('If enabled your website visitors will be able to leave a comment in the single portfolio item page while viewing that single portfolio page. If enabled in here you can still turn commenting off in the single portfolio item itself by unchecking the comments option in that post in the admin backend. If you don&#39;t see that option you can enable it by clicking on the screen options below the admin name while you are working in the single portfolio item.','rt_theme_admin'),
													"id"          => RT_THEMESLUG."_portfolio_comments",
													"default"     => "",
													"transport"   => "postMessage",
													"type"        => "checkbox"
												),
									 

										),
						),


				)
);
