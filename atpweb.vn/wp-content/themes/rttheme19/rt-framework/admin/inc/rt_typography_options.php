<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * RT-Theme Blog Options
 */
		$this->options["typography"] = array(

				'title' => __("Typography Options", "rt_theme_admin"),
				'description' => "",
				'priority' => 3,
				'sections' => array(

									array(
										'id'       => 'body',
										'title'    => __("Body", "rt_theme_admin"),
										'controls' => array(
															array(
																"id"          => RT_THEMESLUG.'_body_font',
																"label"       => __("Font",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  $this->fonts,
																"input_attrs" => array("class"=>"rt_fonts", "data-variant-id"=> RT_THEMESLUG.'_body_font_variant', "data-subset-id"=> RT_THEMESLUG.'_body_font_subset'),
																"default"   => "google||Source Sans Pro",
																"transport" => "refresh",
																"type"      => "rt_select",
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG.'_body_font_subset',
																"label"       => __("Subsets",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     => array(),
																"default"     => array("latin","latin-ext"),
																"input_attrs" => array("multiple"=>"multiple"),
																"transport"   => "refresh",
																"type"        => "rt_select",
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG.'_body_font_variant',
																"label"       => __("Font Weight",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  array(),
																"default"     => "regular",
																"transport"   => "refresh",
																"type"        => "rt_select",
																"rt_skin"   => true
															),

															array(
																"label"       => __("Body Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_body_font_size",
																"default"     => "15",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

													),
									),

									array(
										'id'       => 'headings',
										'title'    => __("Headings", "rt_theme_admin"),
										'controls' => array(
															array(
																"id"          => RT_THEMESLUG.'_heading_font',
																"label"       => __("Font",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  $this->fonts,
																"input_attrs" => array("class"=>"rt_fonts", "data-variant-id"=> RT_THEMESLUG.'_heading_font_variant', "data-subset-id"=> RT_THEMESLUG.'_heading_font_subset'),
																"default"   => "google||Roboto",
																"transport" => "refresh",
																"type"      => "rt_select",
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG.'_heading_font_subset',
																"label"       => __("Subsets",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     => array(),
																"default"     => array("latin","latin-ext"),
																"input_attrs" => array("multiple"=>"multiple"),
																"transport"   => "refresh",
																"type"        => "rt_select",
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG.'_heading_font_variant',
																"label"       => __("Font Weight",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  array(),
																"default"     => "300",
																"transport"   => "refresh",
																"type"        => "rt_select",
																"rt_skin"   => true
															),


															array(
																"label"       => __("H1 Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_h1_font_size",
																"default"     => "44",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

															array(
																"label"       => __("H2 Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_h2_font_size",
																"default"     => "30",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),
															array(
																"label"       => __("H3 Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_h3_font_size",
																"default"     => "26",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),
															array(
																"label"       => __("H4 Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_h4_font_size",
																"default"     => "24",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),
															array(
																"label"       => __("H5 Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_h5_font_size",
																"default"     => "22",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),
															array(
																"label"       => __("H6 Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_h6_font_size",
																"default"     => "20",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

													),
									),

									array(
										'id'       => 'menu',
										'title'    => __("Main Menu", "rt_theme_admin"),
										'controls' => array(
															array(
																"id"          => RT_THEMESLUG.'_menu_font',
																"label"       => __("Font",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  $this->fonts,
																"input_attrs" => array("class"=>"rt_fonts", "data-variant-id"=> RT_THEMESLUG.'_menu_font_variant', "data-subset-id"=> RT_THEMESLUG.'_menu_font_subset'),
																"default"   => "google||Roboto Condensed",
																"transport" => "refresh",
																"type"      => "rt_select",
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG.'_menu_font_subset',
																"label"       => __("Subsets",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  array(),
																"default"     => array("latin","latin-ext"),
																"input_attrs" => array("multiple"=>"multiple"),
																"transport"   => "refresh",
																"type"        => "rt_select",
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG.'_menu_font_variant',
																"label"       => __("Font Weight",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  array(),
																"default"     => "regular",
																"transport"   => "refresh",
																"type"        => "rt_select",
																"rt_skin"   => true
															),

															array(
																"label"       => __("Top Level Item Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_menu_font_size",
																"default"     => "16",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

															array(
																"label"       => __("Mobile Menu - Top Level Item Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_mobile_menu_font_size",
																"default"     => "14",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

													),
									),

									array(
										'id'       => 'sub_menu',
										'title'    => __("Sub Menu", "rt_theme_admin"),
										'controls' => array(
															array(
																"id"          => RT_THEMESLUG.'_sub_menu_font',
																"label"       => __("Font",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  $this->fonts,
																"input_attrs" => array("class"=>"rt_fonts", "data-variant-id"=> RT_THEMESLUG.'_sub_menu_font_variant', "data-subset-id"=> RT_THEMESLUG.'_sub_menu_font_subset'),
																"default"   => "google||Roboto Condensed",
																"transport" => "refresh",
																"type"      => "rt_select",
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG.'_sub_menu_font_subset',
																"label"       => __("Subsets",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     => array(),
																"default"     => array("latin","latin-ext"),
																"input_attrs" => array("multiple"=>"multiple"),
																"transport"   => "refresh",
																"type"        => "rt_select",
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG.'_sub_menu_font_variant',
																"label"       => __("Font Weight",'rt_theme_admin'),
																//"description" => __("",'rt_theme_admin'),
																"choices"     =>  array(),
																"default"     => "regular",
																"transport"   => "refresh",
																"type"        => "rt_select",
																"rt_skin"   => true
															),

															array(
																"label"       => __("Sub Level Item Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_menu_sub_font_size",
																"default"     => "16",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

															array(
																"label"       => __("Mobile Menu - Sub Level Item Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_mobile_menu_sub_font_size",
																"default"     => "14",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

													),
									),

									array(
										'id'       => 'miscellaneous',
										'title'    => __("Miscellaneous", "rt_theme_admin"),
										'controls' => array(

															array(
																"id"          => RT_THEMESLUG."_sub_page_header_t_seperator",
																"label"       => __('Sub-Header Page Title','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"id"          => RT_THEMESLUG."_sub_page_header_title_font",
																"label"       => __("Sub-Header Page Title Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"),
																					"secondary" => __("Use the secondary font family","rt_theme_admin"),
																					"menu" => __("Use the menu font family","rt_theme_admin"), 
																					"sub_menu" => __("Use the sub menu font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "heading",
																"rt_skin" => true
															),

															array(
																"label"       => __("Sub-Header Page Title Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_sub_page_header_title_font_size",
																"default"     => "34",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

															array(
																"id"          => RT_THEMESLUG."_products_t_seperator",
																"label"       => __('Products','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"id"          => RT_THEMESLUG."_product_title_font",
																"label"       => __("Product Headings Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"),
																					"secondary" => __("Use the secondary font family","rt_theme_admin"),
																					"menu" => __("Use the menu font family","rt_theme_admin"), 
																					"sub_menu" => __("Use the sub menu font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "body",
																"rt_skin" => true
															),

															array(
																"label"       => __("Product Headings Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_product_title_font_size",
																"default"     => "18",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),
 
															array(
																"label"       => __("Product Carousel Headings Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_product_carousel_title_font_size",
																"default"     => "15",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),
 

															array(
																"id"          => RT_THEMESLUG."_portfolio_t_seperator",
																"label"       => __('Portfolio','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"id"          => RT_THEMESLUG."_portfolio_title_font",
																"label"       => __("Portfolio Headings Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"),
																					"secondary" => __("Use the secondary font family","rt_theme_admin"),
																					"menu" => __("Use the menu font family","rt_theme_admin"), 
																					"sub_menu" => __("Use the sub menu font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "body",
																"rt_skin" => true
															),

															array(
																"label"       => __("Portfolio Heading Font Size (Style 1)",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_portfolio_title_font_size_1",
																"default"     => "22",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

															array(
																"label"       => __("Portfolio Heading Font Size (Style 2)",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_portfolio_title_font_size_2",
																"default"     => "22",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"     => true
															),
 
															array(
																"label"       => __("Portfolio Carousel Headings Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_portfolio_carousel_title_font_size",
																"default"     => "22",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"     => true
															),
 
  															array(
																"id"          => RT_THEMESLUG."_blog_t_seperator",
																"label"       => __('Blog','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

 															array(
																"label"       => __("Blog Heading Font Size (Loop)",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_blog_title_font_size",
																"default"     => "26",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"     => true
															),

															array(
																"id"          => RT_THEMESLUG."_blog_carousel_title_font",
																"label"       => __("Blog Carousel Heading Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "body",
																"rt_skin" => true
															),
 
															array(
																"label"       => __("Blog Carousel Heading Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_blog_carousel_title_font_size",
																"default"     => "15",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"     => true
															),


 															array(
																"id"          => RT_THEMESLUG."_news_t_seperator",
																"label"       => __('Latest News','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"id"          => RT_THEMESLUG."_news_title_font",
																"label"       => __("Latest News Heading Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"), 
																					"secondary" => __("Use the secondary font family","rt_theme_admin"), 
																					"menu" => __("Use the menu font family","rt_theme_admin"), 
																					"sub_menu" => __("Use the sub menu font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "body",
																"rt_skin" => true
															),

															array(
																"label"       => __("Latest News Headings Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_news_title_font_size",
																"default"     => "17",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),


 															array(
																"id"          => RT_THEMESLUG."_widgets_t_seperator",
																"label"       => __('Widgets','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),
 
															array(
																"label"       => __("Widget Heading Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_widget_title_font_size",
																"default"     => "17",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),


 															array(
																"id"          => RT_THEMESLUG."_tabs_t_seperator",
																"label"       => __('Tabs','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"id"          => RT_THEMESLUG."_tabs_title_font",
																"label"       => __("Tabs Heading Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"),
																					"secondary" => __("Use the secondary font family","rt_theme_admin"),
																					"menu" => __("Use the menu font family","rt_theme_admin"), 
																					"sub_menu" => __("Use the sub menu font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "body",
																"rt_skin" => true
															),

															array(
																"label"       => __("Tabs Heading Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_tabs_title_font_size",
																"default"     => "15",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),


 															array(
																"id"          => RT_THEMESLUG."_accordions_t_seperator",
																"label"       => __('Accordions','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"id"          => RT_THEMESLUG."_accordion_title_font",
																"label"       => __("Accordions Heading Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"),
																					"secondary" => __("Use the secondary font family","rt_theme_admin"),
																					"menu" => __("Use the menu font family","rt_theme_admin"), 
																					"sub_menu" => __("Use the sub menu font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "body",
																"rt_skin" => true
															),

															array(
																"label"       => __("Accordions Heading Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_accordion_title_font_size",
																"default"     => "15",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),


 															array(
																"id"          => RT_THEMESLUG."_header_t_seperator",
																"label"       => __('Header Widgets','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"id"          => RT_THEMESLUG."_header_widget_font",
																"label"       => __("Header Widget Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"),
																					"secondary" => __("Use the secondary font family","rt_theme_admin"),
																					"menu" => __("Use the menu font family","rt_theme_admin"), 
																					"sub_menu" => __("Use the sub menu font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "body",
																"rt_skin" => true
															),

															array(
																"label"       => __("Header Widget Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_header_widget_font_size",
																"default"     => "12",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

 															array(
																"id"          => RT_THEMESLUG."_topbar_t_seperator",
																"label"       => __('Top Bar','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"id"          => RT_THEMESLUG."_topbar_font",
																"label"       => __("Top Bar Font",'rt_theme_admin'),
																"description" => "",
																"transport"   => "refresh",
																"choices"     => array(																					
																					"body" => __("Use the body font family","rt_theme_admin"), 
																					"heading" => __("Use the heading font family","rt_theme_admin"),
																					"secondary" => __("Use the secondary font family","rt_theme_admin"),
																					"menu" => __("Use the menu font family","rt_theme_admin"), 
																					"sub_menu" => __("Use the sub menu font family","rt_theme_admin"), 
																				),
																"type"    => "select",
																"default" => "body",
																"rt_skin" => true
															),

															array(
																"label"       => __("Top Bar Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_topbar_font_size",
																"default"     => "12",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

 															array(
																"id"          => RT_THEMESLUG."_breadcrumb_t_seperator",
																"label"       => __('Breadcrumb','rt_theme_admin'),
																"type"        => "rt_subsection_heading"
															),

															array(
																"label"       => __("Breadcrumb Menu Font Size",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_breadcrumb_font_size",
																"default"     => "11",
																"type"        => "number",
																"transport"   => "refresh",
																"input_attrs" => array("min"=>10,"max"=>100),
																"rt_skin"   => true
															),

													),
									),

									array(
												'id'          => 'secondary',
												'title'       => esc_html_x("Secondary Font",'Admin Panel','rt_theme_admin'),
												'description' => esc_html_x("You can select a font family to set as a secondary font. It is available to use within some modules as an option. You can also use it for any module by using 'secondary-font' class name or adding the text between &lt;em&gt;&lt;/em&gt; tags inside an heading.",'Admin Panel','rt_theme_admin'),
												'controls' => array( 

																	array(
																		"id"          => RT_THEMESLUG.'_secondary_font',															
																		"label"       => esc_html_x("Font",'Admin Panel','rt_theme_admin'),
																		"choices"     => $this->fonts,
																		"input_attrs" => array("class"=>"rt_fonts", "data-variant-id"=> RT_THEMESLUG.'_secondary_font_variant', "data-subset-id"=> RT_THEMESLUG.'_secondary_font_subset'),
																		"default"   => "",
																		"transport" => "refresh", 
																		"type"      => "rt_select",
																		"rt_skin"   => true
																	),

																	array(
																		"id"          => RT_THEMESLUG.'_secondary_font_subset',															
																		"label"       => esc_html_x("Subsets",'Admin Panel','rt_theme_admin'),
																		"choices"     => array(),			
																		"default"     => "",
																		"input_attrs" => array("multiple"=>"multiple"),
																		"transport"   => "refresh", 
																		"type"        => "rt_select",
																		"rt_skin"   => true
																	),

																	array(
																		"id"          => RT_THEMESLUG.'_secondary_font_variant',															
																		"label"       => esc_html_x("Font Weight",'Admin Panel','rt_theme_admin'),
																		"choices"     => "",			
																		"default"     => "italic",
																		"transport"   => "refresh", 
																		"type"        => "rt_select",
																		"rt_skin"   => true
																	),

															),
											),				
							)
			);
