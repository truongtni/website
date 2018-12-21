<?php
/*
*
* Blog Carousel 
*
*/ 

vc_map(
	array(
		'base'        => 'blog_carousel',
		'name'        => __( 'Blog Carousel', 'rt_theme_admin' ),
		'icon'        => 'rt_theme carousel',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Displays blog posts within a carousel', 'rt_theme_admin' ),
		'params'      => array(

 
							array(
								'param_name'  => 'id',
								'heading'     => __('ID', 'rt_theme_admin' ),
								'description' => __('Unique ID', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => ''
							),

							array(
								'param_name'  => 'list_layout',
								'heading'     => __( 'Layout', 'rt_theme_admin' ),
								"description" => __("Column width of an item. Percent of the visible part.",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													"1/6" => "1/6", 
													"1/5" => "1/5", 
													"1/4" => "1/4",
													"1/3" => "1/3",
													"1/2" => "1/2",
													"1/1" => "1/1"
												),
								'save_always' => true
							),
 
							array(
								'param_name'  => 'tablet_layout',
								'heading'     => __( 'Carousel Layout (Tablet)', 'rt_theme_admin' ),
								"description" => __("Visible image count for each slide on medium screens.",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default","rt_theme_admin") => "",
													"1/1" => "1",
													"1/2" => "2",													
													"1/3" => "3",													
													"1/4" => "4",													
													"1/5" => "5",													
													"1/6" => "6"	
												),
							),


 							array(
								'param_name'  => 'mobile_layout',
								'heading'     => __( 'Carousel Layout (Mobile)', 'rt_theme_admin' ),
								"description" => __("Visible image count for each slide on small screens.",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default","rt_theme_admin") => "",
													"1/1" => "1",
													"1/2" => "2",													
													"1/3" => "3",													
													"1/4" => "4",													
													"1/5" => "5",													
													"1/6" => "6"	
												),
							),

							array(
								'param_name'  => 'max_item',
								'heading'     => __('Amount of item to display', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => '10',
								'save_always' => true
							),


							array(
								'param_name'  => 'excerpt_length',
								'heading'     => __('Excerpt Length', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => '100',
								'save_always' => true
							),

							array(
								'param_name'  => 'nav',
								'heading'     => __( 'Navigation Arrows', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Enabled","rt_theme_admin") => "true", 
													__("Disabled","rt_theme_admin") => "false"													
												),
												'save_always' => true						
							),

							array(
								'param_name'  => 'dots',
								'heading'     => __( 'Navigation Dots', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Enabled","rt_theme_admin") => "true", 
													__("Disabled","rt_theme_admin") => "false"												
												),
												'save_always' => true						
							),

							array(
								'param_name'  => 'autoplay',
								'heading'     => __( 'Auto Play', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(												
													__("Disabled","rt_theme_admin") => "false",
													__("Enabled","rt_theme_admin") => "true"
												),
												'save_always' => true						
							),

							array(
								'param_name'  => 'timeout',
								'heading'     => __('Auto Play Speed (ms)', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => "",
								"description" => __("Auto play speed value in milliseconds. For example; set 5000 for 5 seconds",'rt_theme_admin'),
								"dependency"  => array(
													"element" => "autoplay",
													"value" => array("true")
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'list_orderby',
								'heading'     => __( 'List Order By', 'rt_theme_admin' ),
								"description" => __("Sorts the posts by this parameter",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__('Date','rt_theme_admin') => 'date',
													__('Author','rt_theme_admin') => 'author',
													__('Title','rt_theme_admin') => 'title',
													__('Modified','rt_theme_admin') => 'modified',
													__('ID','rt_theme_admin') => 'ID',
													__('Randomized','rt_theme_admin') => 'rand',
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'list_order',
								'heading'     => __( 'List Order', 'rt_theme_admin' ),
								"description" => __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__('Descending','rt_theme_admin') => 'DESC',
													__('Ascending','rt_theme_admin') => 'ASC',
												),
								'save_always' => true
							),


							array(
								'param_name'  => 'categories',
								'heading'     => __( 'Categories', 'rt_theme_admin' ),
								"description" => __("List posts of selected categories only.",'rt_theme_admin'),
								'type'        => 'dropdown_multi',
								"value"       => array_merge(array(__('All Categories','rt_theme_admin')=>""),array_flip(rt_get_categories())),
								'save_always' => true
							),


							/* Post Meta */
							array(
								'param_name'  => 'show_date',
								'heading'     => __("Display Date", "rt_theme_admin"),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),
								'group'       => __('Post Meta', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'show_author',
								'heading'     => __("Display Post Author", "rt_theme_admin"),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),
								'group'       => __('Post Meta', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'show_categories',
								'heading'     => __("Display Categories", "rt_theme_admin"),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),
								'group'       => __('Post Meta', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'show_comment_numbers',
								'heading'     => __("Display Comment Numbers", "rt_theme_admin"),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),
								'group'       => __('Post Meta', 'rt_theme_admin'),
								'save_always' => true
							),


							/* Featured Images */
							array(
								'param_name'  => 'featured_image_resize',
								'heading'     => __( 'Resize Featured Images', 'rt_theme_admin' ),
								'description' => __('Enable "Image Resize" to resize or crop the featured images automatically. These settings will be overwrite the global settings. Please note, since the theme is reponsive the images cannot be wider than the column they are in. Leave values "0" to use theme defaults.', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Enabled","rt_theme_admin") => "true",
													__("Disabled","rt_theme_admin") => "false"
												),
								'group' => __('Featured Images', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'featured_image_max_width',
								'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => 0,
								"dependency"  => array(
													"element" => "featured_image_resize",
													"value" => array("true")
												),
								'group' => __('Featured Images', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'featured_image_max_height',
								'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => 0,
								"dependency"  => array(
													"element" => "featured_image_resize",
													"value" => array("true")
												),
								'group' => __('Featured Images', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'featured_image_crop',
								'heading'     => __( 'Crop Featured Images', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Disabled","rt_theme_admin") => "false",
													__("Enabled","rt_theme_admin") => "true"
												),
								"dependency"  => array(
													"element" => "featured_image_resize",
													"value" => array("true")
												),								
								'group' => __('Featured Images', 'rt_theme_admin'),
								'save_always' => true
							),
			
						)
	)
);	

?>