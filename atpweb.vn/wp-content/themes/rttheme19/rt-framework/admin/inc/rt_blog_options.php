<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * RT-Theme Blog Options
 */
		$this->options["rt_blog_options"] = array(

				'title' => __("Blog Options", "rt_theme_admin"), 
				'description' => "", 
				'priority' => 6,
				'sections' => array(

									array(
										'id'       => 'misc',
										'title'    => __("Global Layout Options", "rt_theme_admin"), 
										'controls' => array( 
															array(
																"id"          => RT_THEMESLUG."_blog_layout",															
																"label"       => __("Layout",'rt_theme_admin'),
																"description" => __("Select and set a default column layout for the blog category & archive listing pages for each of the (single) post items listed within those pages.",'rt_theme_admin'),
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
																'id'          => RT_THEMESLUG.'_blog_layout_style',
																'label'       => __("Layout Style",'rt_theme_admin'),
																"description" => __("Select and set a default layout style for the blog category & archive listing pages",'rt_theme_admin'),
																'type'        => 'select',
																'default'     => 'grid',
																"transport"   => "refresh",
																'choices'     => array(
																					"grid"    => __("Grid","rt_theme_admin"),
																					"masonry" => __("Masonry","rt_theme_admin"),
																				),
															),													
													),
									),							

									array(
										'id'          => 'featured_img',									
										'title'       => __("Featured Images", "rt_theme_admin"), 
										"description" => __('Enable "Image Resize" to resize or crop the featured images automatically. These settings will be used as globaly and you can change for each portfolio post individiually (via edit post screen). <br /> Please note, since the theme is reponsive the images cannot be wider than the column they are in. Leave values "0" to use theme defaults.','rt_theme_admin'),
										'controls'    => array( 

															array(
																"label"       => __("Featured Images in Lightbox",'rt_theme_admin'), 
																"description" => __("Enable/Disable lightbox preview option for the features images. This option is only availble for the standard post types.",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_use_lightbox",
																"default"     => "on",
																"transport"   => "postMessage",
																"type"        => "checkbox"
															),

															array(
																"label"       => __("Image Resize",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_blog_image_resize",
																"choices"     => array(
																					"false" => __("Disabled","rt_theme_admin"),						
																					"true" => __("Enabled","rt_theme_admin"),
																				),			
																"default"   => "true",
																"transport" => "postMessage", 
																"type"      => "select"
															),		

															array(
																"label"       => __("Featured Image Max Width",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_blog_image_width",
																"default"     => 0, 
																"type"        => "number",
																"transport"   => "postMessage",
																"input_attrs" => array("min"=>0,"max"=>3000, "data-depends-id" => RT_THEMESLUG."_blog_image_resize", "data-depends-values" => "true")
															),


															array(
																"label"       => __("Featured Image Max Height",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_blog_image_height",
																"default"     => 0, 
																"type"        => "number",
																"transport"   => "postMessage",
																"input_attrs" => array("min"=>0,"max"=>3000, "data-depends-id" => RT_THEMESLUG."_blog_image_resize", "data-depends-values" => "true")
															),

															array(
																"label"       => __("Crop Featured Image",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_blog_image_crop",
																"default"     => "",
																"transport"   => "postMessage",
																"type"        => "rt_checkbox",
																"input_attrs" => array("data-depends-id" => RT_THEMESLUG."_blog_image_resize", "data-depends-values" => "true")
															),


													),
									),		

									array(
										'id'          => 'excerpts',									
										'title'       => __("Excerpts", "rt_theme_admin"), 
										"description" => __("As default the full blog content will be displayed on the blog listing pages and blog categories.  Enable the <a href=\"http://en.support.wordpress.com/splitting-content/excerpts/\">Excerpts</a> ( check the 'Use excerpts..' box below ) to minify the content automatically by using WordPress's excerpt option.  You can keep disabled and split your content manually by using <a href=\"http://en.support.wordpress.com/splitting-content/more-tag/\">The More Tag</a>",'rt_theme_admin'),
										'controls'    => array( 

															array(
																"label"       => __("Use excerpts",'rt_theme_admin'), 
																"id"          => RT_THEMESLUG."_use_excerpts",
																"default"     => "on",
																"transport"   => "postMessage",
																"type"        => "checkbox"
															),

													),
									),		


									array(
										'id'          => 'meta',									
										'title'       => __("Post Meta", "rt_theme_admin"), 
										"description" => __("Customize the post meta info that displayed with posts.",'rt_theme_admin'),
										'controls'    => array( 


														array(
															"id"          => RT_THEMESLUG."_archive_post_meta",	
															"label"       => "",
															"description" => __('For Listing Pages (Categories, Archives, Search)','rt_theme_admin'),															
															"type"        => "rt_seperator"
														),

															array(
																"label"     => __("Show the Author Name",'rt_theme_admin'),
																"id"        => RT_THEMESLUG."_show_author",
																"type"      => "checkbox",
																"default"   => "on",
																"transport" => "refresh",
															),

															array(
																"label"     => __("Show Categories",'rt_theme_admin'),
																"id"        => RT_THEMESLUG."_show_categories",
																"type"      => "checkbox",
																"default"   => "on",
																"transport" => "refresh",
															), 		

															array(
																"label"     => __("Show Comment Numbers",'rt_theme_admin'),
																"id"        => RT_THEMESLUG."_show_comment_numbers",
																"type"      => "checkbox",
																"default"   => "",
																"transport" => "refresh",
															), 	

															array(
																"label"     => __("Show Post Dates",'rt_theme_admin'),
																"id"        => RT_THEMESLUG."_show_date",
																"default"   => "on",
																"type"      => "checkbox",
																"transport" => "refresh",
															), 	

														array(
															"id"          => RT_THEMESLUG."_single_post_meta",	
															"description" => __('For Single Post Pages','rt_theme_admin'),															
															"type"        => "rt_seperator"
														),

															array(
																"label"     => __("Show the Author Name",'rt_theme_admin'),
																"id"        => RT_THEMESLUG."_show_author_single",
																"type"      => "checkbox",
																"default"   => "on",
																"transport" => "refresh",
															),

															array(
																"label"     => __("Show Categories",'rt_theme_admin'),
																"id"        => RT_THEMESLUG."_show_categories_single",
																"type"      => "checkbox",
																"default"   => "on",
																"transport" => "refresh",
															), 

															array(
																"label"     => __("Show Post Dates",'rt_theme_admin'),
																"id"        => RT_THEMESLUG."_show_date_single",
																"default"   => "on",
																"type"      => "checkbox",
																"transport" => "refresh",
															), 	


													),
									),

									array(
										'id'          => 'single',									
										'title'       => __("Single Post Page", "rt_theme_admin"), 
										'controls'    => array( 

															array(
																"label"       => __("Blog Name",'rt_theme_admin'),
																"description" => __("The name that will be displayed as page title inside the header area of single post pages. Leave it blank to use the current post title.",'rt_theme_admin'),
																"id"          => RT_THEMESLUG."_blog_page_name",
																"type"        => "text",
																"default"     => __("Blog ",'rt_theme_admin'),
																"callback"    => "esc_html"
															),

															array(
																"label"   => __("Display author info box under posts",'rt_theme_admin'),
																"id"      => RT_THEMESLUG."_show_author_info",
																"type"    => "checkbox",
																"default" => "on",
																"transport" => "refresh"
															),		

															array(
																"label"       => __("Hide Share Buttons",'rt_theme_admin'), 
																"id"          => RT_THEMESLUG."_hide_share_buttons",
																"default"     => "",
																"transport"   => "refresh",
																"type"        => "checkbox"
															),								
													),
									),


							)
			);