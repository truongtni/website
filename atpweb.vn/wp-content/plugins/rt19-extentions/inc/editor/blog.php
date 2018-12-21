<?php
/*
*
* Blog
* [blog_box]
*
*/ 

vc_map(
	array(
		'base'        => 'blog_box',
		'name'        => __( 'Blog Posts', 'rt_theme_admin' ),
		'icon'        => 'rt_theme blog',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Displays blog posts with selected parameters', 'rt_theme_admin' ),
		'params'      => array(

 
							array(
								'param_name'  => 'id',
								'heading'     => __('ID', 'rt_theme_admin' ),
								'description' => __('Unique ID', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => ''
							),

							array(
								'param_name'  => 'class',
								'heading'     => __('Class', 'rt_theme_admin' ),
								'description' => __('CSS Class Name', 'rt_theme_admin' ),
								'type'        => 'textfield'
							),


							array(
								'param_name'  => 'list_layout',
								'heading'     => __( 'Layout', 'rt_theme_admin' ),
								"description" => __("Column layout for the list",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													"1/6" => "1/6", 
													"1/4" => "1/4",
													"1/3" => "1/3",
													"1/2" => "1/2",
													"1/1" => "1/1"
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'layout_style',
								'heading'     => __( 'Layout Style', 'rt_theme_admin' ),
								"description" => __("Design of the layout",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__("Grid","rt_theme_admin") => "grid",
													__("Masonry","rt_theme_admin") => "masonry" 
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'use_excerpts',
								'heading'     => __("Excerpts", "rt_theme_admin"),
								"description" => __("As default the full blog content will be displayed for this list.  Enable this option to minify the content automatically by using WordPress's excerpt option.  You can keep disabled and split your content manually by using <a href=\"http://en.support.wordpress.com/splitting-content/more-tag/\">The More Tag</a>",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'pagination',
								'heading'     => __( 'Pagination', 'rt_theme_admin' ),
								"description" => __("Splits the list into pages",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),				
								'save_always' => true
							),

							array(
								'param_name'  => 'ajax_pagination',
								'description' => __( 'Works with Masonry layout only', 'rt_theme_admin' ),
								'type'        => 'checkbox',
								"value"       => array(
													__("Enable ajax pagination (load more)", "rt_theme_admin") => "true",
												),	
								"dependency"  => array(
													"element" => "pagination",
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
								'param_name'  => 'item_per_page',
								'heading'     => __('Amount of post per page', 'rt_theme_admin' ),
								'type'        => 'textfield'
							),


							array(
								'param_name'  => 'categories',
								'heading'     => __( 'Categories', 'rt_theme_admin' ),
								"description" => __("List posts of selected categories only.",'rt_theme_admin'),
								'type'        => 'dropdown_multi',
								"value"       => array_merge(array(__('All Categories','rt_theme_admin')=>""),array_flip(rt_get_categories())),
								'save_always' => true
							),


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
								'param_name'  => 'hide_featured_images',
								'heading'     => __("Hide Featured Images", "rt_theme_admin"),
								'type'        => 'dropdown',
								"value"       => array(
													__('Disabled','rt_theme_admin') => '',
													__('Enabled','rt_theme_admin') => 'true',													
												),
								'group' => __('Featured Images', 'rt_theme_admin'),
								'save_always' => true
							),

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